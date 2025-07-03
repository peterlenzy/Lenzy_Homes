@extends('dashboard')
@section('title', 'Remove House')
@section('content')
<div id="app-content">
<div class="container">
    <h1>Remove House</h1>
    <form action="{{ route('houses.destroy', $house->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $house->name }}" readonly>
        </div>
        <div class="mb-3">
            <label for="city" class="form-label">City</label>
            <input type="text" class="form-control" id="city" name="city" value="{{ $house->city }}" readonly>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" class="form-control" id="price" name="price" value="{{ $house->price }}" readonly>
        </div>
        <div class="mb-3">
            <label for="location" class="form-label">Location</label>
            <input type="text" class="form-control" id="location" name="location" value="{{ $house->location }}" readonly>
        </div>
        <div class="mb-3">
            <label for="bedrooms" class="form-label">Bedrooms</label>
            <input type="number" class="form-control" id="bedrooms" name="bedrooms" value="{{ $house->bedrooms }}" readonly>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" readonly>{{ $house->description }}</textarea>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-select" id="status" name="status" disabled>
                <option value="{{ $house->status }}">{{ ucfirst($house->status) }}</option>
                <option value="available">Available</option>
                <option value="sold">Sold</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image URL</label>
            <input type="text" class="form-control" id="image" name="image" value="{{ $house->image }}" readonly>
        </div>
        <button type="submit" class="btn btn-danger">Remove House</button>
    </form>
</div>
</div>
@endsection
