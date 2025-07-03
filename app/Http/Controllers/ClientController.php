<?php

namespace App\Http\Controllers;
use App\Models\Clients;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Clients $clients)
    {
        $clients = Clients::all();
        return view('clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Clients $clients)
    {
        //
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $client = new Clients();

        $client->id = $request->id;
        $client->name = $request->name;
        $client->email= $request->email;
        $client->phone = $request->phone;
        $client->address = $request->address;
        $client->status = $request->status;

        $client->save();

        return redirect()->route('clients.index')->with('success', 'client created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Clients $clients)
    {
        //
        return view('clients.index', compact('clients'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Clients $clients)
    {
        //
        return view('clients.edit', compact($clients));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,)
    {
        //
        return redirect()->route('clients.show',)->with('success', 'Client updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(clients $clients)
    {
        //
        return redirect()->route('clients.index')->with('success', 'client deleted successfully!');
    }
}
