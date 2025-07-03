@extends('dashboard')
@section('title', 'Clients')

@section('content')
<style>
    .main-content {
        flex: 1 1 auto;
        overflow-x: auto;
        width: 0;
    }
</style>
<div id="app-content">
<div class="card px-4 py-4">
    <h1 class="mb-4">Clients</h1>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
        @foreach ($clients as $client)
            <div class="col d-flex">
                <div class="card flex-fill shadow-sm" style="min-width: 300px;">
                    <img src="{{ asset('build/assets/images/client.png') }}" class="card-img-top" alt="Client Image"
                        style="height: 180px; object-fit: cover;">
                    <div class="card-body">
                        <p class="mb-2"><strong>Name:</strong> {{ $client->name }}</p>
                        <p class="mb-2"><strong>Email:</strong> {{ $client->email }}</p>
                        <p class="mb-2"><strong>Phone:</strong> {{ $client->phone }}</p>
                        <p class="mb-2"><strong>Address:</strong> {{ $client->address }}</p>
                        <p class="mb-2"><strong>Status:</strong> {{ ucfirst($client->status) }}</p>
                        <p class="mb-2"><strong>Role:</strong> {{ ucfirst($client->role) }}</p>
                    </div>
                    <div class="card-footer d-flex gap-2">
                        <a href="{{ route('clients.show', $client->id) }}" class="btn btn-primary mt-3">View Details</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
</div>
@endsection
