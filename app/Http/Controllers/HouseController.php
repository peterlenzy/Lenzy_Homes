<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Houses;
use App\Models\HouseImage;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ImageController;
use Illuminate\Support\Facades\DB;

class HouseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function search_house(Request $request)
    {
        $search_house=$request->search_house;
        $houses=Houses::where('name','like','%'.$search_house.'%')->orwhere('location','like','%'.$search_house.'%')->get();
        return view('houses.index',compact('houses'));

    }
    public function index(Houses $houses)
    {
        $houses = Houses::all();
        return view('houses.index', compact('houses'));
    }
    public function archived(Request $request)
    {
        $houses = Houses::onlyTrashed()->get();
        return view('houses.archived', compact('houses'));
    }
    public function restore(Request $request ,Houses $house)
    {
        $house->restore();
        return redirect()->route('houses.index');

    }
    public function Dimension_index(Request $request ,Houses $house)
    {
        return view('houses.Dimension_view');
    }
    public function create()
    {
        return view('houses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'price' => 'required|numeric|decimal:0,2',
            'location' => 'required|string|max:255',
            'bedrooms' => 'required|numeric',
            'description' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp',
        ]);

        // Save the house record first
        $house = new Houses();
        $house->name = $request->name;
        $house->city = $request->city;
        $house->price = $request->price;
        $house->location = $request->location;
        $house->bedrooms = $request->bedrooms;
        $house->description = $request->description;
        $house->status = $request->status;


        $house->save();

        // Upload each image using ImageController and save in pivot table
        $imageUploader = new ImageController();

        if ($request->hasFile('images')) {
            // dd('yyy');
            foreach ($request->file('images') as $label => $file) {
                // dd('6666');

                                    $uploadResult = $imageUploader->store($file);

                    if ($uploadResult['success']) {

                        HouseImage::create([
                            'house_id' => $house->id,
                            'type' => $label,
                            'img_path' => $uploadResult['image'],
                        ]);
                    }

            }
        }

        return redirect()->route('houses.index')->with('success', 'House created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Houses $houses)
    {
        return view('houses.index', compact('houses'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Houses $house)
    {
        return view('houses.edit', compact('house'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Houses $house)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'city' => 'required|string|max:255',
                'price' => 'required|numeric|decimal:0,2',
                'location' => 'required|string|max:255',
                'bedrooms' => 'required|numeric',
                'description' => 'required|string|max:255',
                'status' => 'required|string|max:255',
                'images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            ]);

            $house->update($validated);

            $imageUploader = new ImageController();

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $label => $file) {
                    if ($file instanceof \Illuminate\Http\UploadedFile) {
                        $uploadResult = $imageUploader->store($file);

                        if ($uploadResult['success']) {
                            HouseImage::updateOrCreate(
                                ['house_id' => $house->id, 'type' => $label],
                                ['img_path' => $uploadResult['image']]
                            );
                        }
                    }
                }
            }

            return redirect()->route('houses.index')->with('success', 'House updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($house)
    {
        $house_dtl = DB::table('houses')->where('id', $house)->first();
    if (!$house_dtl) {
        return redirect()->back()->with('error', 'User not found');
    }

    if ($house_dtl->deleted_at) {
        // Hard delete if trashed
        DB::table('houses')->where('id', $house)->delete();
        $message = 'House permanently deleted successfully';
    } else {
        // Soft delete if active
        $active_house=Houses::where('id', $house)->first();
        $active_house->delete();
        $message = 'House soft deleted successfully';
    }

     return redirect()->route('houses.index')->with('success', 'House soft deleted successfully!');
}
}
