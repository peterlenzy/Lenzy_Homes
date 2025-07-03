@extends('starter')
@section('title', 'Delete Client')
@section('content')
<div id="app-content">
<div class="container">
    <h1>Delete Client</h1>
    <form action="{{ route('clients.destroy', $client->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $client->name }}" readonly>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $client->email }}" readonly>
        </div>
        <button type="submit" class="btn btn-danger">Delete Client</button>
    </form>
</div>
</div>
@endsection
