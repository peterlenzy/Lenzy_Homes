@extends('dashboard')
@section('title','create house')
@section('content')
<div id="app-content">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="container">
    <h1>Create House</h1>
    <form action="{{ route('houses.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
                <div class="mb-3">
    <label class="form-label">Front View</label>
    <input type="file" class="form-control" name="images[frontview]" accept="image/*">
</div>

<div class="mb-3">
    <label class="form-label">Back View</label>
    <input type="file" class="form-control" name="images[backview]" accept="image/*">
</div>

<div class="mb-3">
    <label class="form-label">Right Side View</label>
    <input type="file" class="form-control" name="images[rightview]" accept="image/*">
</div>

<div class="mb-3">
    <label class="form-label">Left Side View</label>
    <input type="file" class="form-control" name="images[leftview]" accept="image/*">
</div>

<div class="mb-3">
    <label class="form-label">Top View</label>
    <input type="file" class="form-control" name="images[topview]" accept="image/*">
</div>

<div class="mb-3">
    <label class="form-label">Interior</label>
    <input type="file" class="form-control" name="images[interior]" accept="image/*">
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="city" class="form-label">City</label>
            <input type="text" class="form-control" id="city" name="city" required>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" class="form-control" id="price" name="price" required>
        </div>
        <div class="mb-3">
            <label for="location" class="form-label">Location</label>
            <input type="text" class="form-control" id="location" name="location" required>
        </div>
        <div class="mb-3">
            <label for="bedrooms" class="form-label">Bedrooms</label>
            <input type="number" class="form-control" id="bedrooms" name="bedrooms" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-select" id="status" name="status" required>
                <option value="available">Available</option>
                <option value="sold">Sold</option>
                <option value="maintenance">Maintenance</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Create House</button>
    </form>
    <div id="uploadSuccess" class="text-success mt-3"></div>
    <div id="uploadError" class="text-danger mt-3"></div>
</div>
</div>
@endsection
