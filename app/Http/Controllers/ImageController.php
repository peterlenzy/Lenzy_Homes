<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;

class ImageController extends Controller
{
    public function create()
    {
        return view('create');
    }

    public function store(UploadedFile $image)
    {

        if ($image) {
            $file = $image;
            // CUSTOMIZE HERE: Modify the filename format as needed
            // Example: Add user ID, custom prefix, or other data
            // e.g., $filename = 'user_' . auth()->id() . '_' . time() . '_' . $file->getClientOriginalName();
            $filename = time() . '_' . $file->getClientOriginalName();
            $directory = public_path('build/assets/images');

            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0755, true);
            }

            $file->move($directory, $filename);

            // CUSTOMIZE HERE: Add additional data to the JSON response if needed
            // e.g., return ['success' => true, 'image' => ..., 'custom_data' => 'value'];
            return [
                'success' => true,
                'image' => 'build/assets/images/' . $filename,
            ];
        }

        return response()->json([
            'success' => false,
            'error' => 'Image upload failed.',
        ], 400);
    }
    public function index()
    {
        return view('index');
    }

    public function getImages()
    {
        $imagePath = public_path('build/assets/images');
        $images = File::exists($imagePath) ? File::files($imagePath) : [];
        // CUSTOMIZE HERE: Modify how image paths or metadata are returned
        // e.g., Include file creation time or filter specific images
        // e.g., return array_map(function ($file) { return ['path' => ..., 'created' => $file->getCTime()]; }, $images);
        $imageNames = array_map(function ($file) {
            return 'build/assets/images/' . $file->getFilename();
        }, $images);

        return response()->json($imageNames);
    }
}
