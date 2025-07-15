@extends('dashboard')
@section('title', 'Available Houses')

@section('content')
<style>
    .main-content {
        flex: 1 1 auto;
        overflow-x: auto;
        width: 0;
    }
</style>
<div id="app-content">
    <div class="card">
        <h1 class="mb-4">Available Houses</h1>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 g-4">
            @foreach ($houses as $house)
                <div class="col">
                    <div class="card shadow-sm">
                        @if($house->images && $house->images->count())
    <div id="carousel-{{ $house->id }}" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach($house->images as $key => $image)
                <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                    <img src="{{ asset($image->img_path) }}" class="d-block w-100" alt="{{ $image->type }} image" style="height: 250px; object-fit: cover;">
                    <div class="carousel-caption d-none d-md-block">
                        <span class="badge bg-dark">{{ ucfirst($image->type) }}</span>
                    </div>
                </div>
            @endforeach
        </div>
        @if($house->images->count() > 1)
            <button class="carousel-control-prev" type="button" data-bs-target="#carousel-{{ $house->id }}" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carousel-{{ $house->id }}" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        @endif
    </div>
@else
    <img class="card-img-top" src="{{ asset('build/assets/images/default.jpg') }}" alt="No image available" style="height: 250px; object-fit: cover;">
@endif
                        <div class="card-body p-2">
                            <p class="mb-2"><strong>Name:</strong> {{ $house->name }}</p>
                            <p class="mb-2"><strong>City:</strong> {{ $house->city }}</p>
                            <p class="mb-2"><strong>Price:</strong> KES {{ number_format($house->price) }}</p>
                            <p class="mb-2"><strong>Location:</strong> {{ $house->location }}</p>
                            <p class="mb-2"><strong>Bedrooms:</strong> {{ $house->bedrooms }}</p>
                            <p class="mb-2"><strong>Status:</strong> {{ ucfirst($house->status) }}</p>
                            <p class="card-text mt-2">{{ Str::limit($house->description, 80) }}</p>
                        </div>
                        <div class="card-footer d-flex gap-2 flex-wrap">
                            <form action="/houses/{{$house->id}}/restore"method="post"class="mt-2">
                                @csrf
                            <button class="btn btn-primary ">Restore</button>
                            </form>
                            <form action="{{ route('houses.destroy', $house->id) }}" method="POST" class="mt-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this house?')">
                                    Delete House
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
