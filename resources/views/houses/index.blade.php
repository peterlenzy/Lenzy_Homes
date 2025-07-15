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
        <div class="row">
            <div class="col">
            <h1 class="mb-4">Available Houses</h1>
            </div>
            @auth
            @if(auth()->user()->role === 'admin')
            <div class="col text-end mt-3">
                 <a href="{{route('houses.archived')}}"class="btn btn-primary">Trashed Houses</a>
            </div>
            @endif
            @endauth
        </div>
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
                            <a href="{{ route('payments.create',['house' => $house->id]) }}" class="btn btn-primary mt-2">Purchase House</a>
                            @auth
                                @if(auth()->user()->role === 'admin')
                                    <button class="btn btn-info mt-2" data-bs-toggle="modal" data-bs-target="#viewHouseModal{{ $house->id }}">
                                        View Details
                                    </button>

                                    <button class="btn btn-warning mt-2" data-bs-toggle="modal" data-bs-target="#editHouseModal{{ $house->id }}">
                                        Edit House
                                    </button>
                                    <form action="{{ route('houses.destroy', $house->id) }}" method="POST" class="mt-2">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this house?')">
                                            Delete House
                                        </button>
                                    </form>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>


                <!-- Edit Modal -->
                <div class="modal fade" id="editHouseModal{{ $house->id }}" tabindex="-1" aria-labelledby="editHouseModalLabel{{ $house->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <form action="{{ route('houses.update', ['house' => $house->id]) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editHouseModalLabel{{ $house->id }}">Edit House: {{ $house->name }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    @php
                                        $imageTypes = ['frontview', 'backview', 'rightview', 'leftview', 'topview', 'interior'];
                                    @endphp

                                    @foreach ($imageTypes as $type)
                                        <div class="mb-3">
                                        <label class="form-label text-capitalize">{{ $type }}</label><br>
                                        @php
                                            $image = $house->images->firstWhere('type', $type);
                                        @endphp
                                        @if ($image)
                                            <div class="mb-2">
                                                <img src="{{ asset($image->img_path) }}" alt="{{ $type }} image" class="img-thumbnail" style="height: 120px;">
                                            </div>
                                        @endif
                                        <input type="file" class="form-control" name="images[{{ $type }}]" accept="image/*">
                                        <small class="text-muted">Leave blank to keep current image</small>
                                        </div>
                                    @endforeach
                                    <div class="mb-3">
                                        <label for="name{{ $house->id }}" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="name{{ $house->id }}" name="name" value="{{ old('name', $house->name) }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="city{{ $house->id }}" class="form-label">City</label>
                                        <input type="text" class="form-control" id="city{{ $house->id }}" name="city" value="{{ old('city', $house->city) }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="price{{ $house->id }}" class="form-label">Price</label>
                                        <input type="number" class="form-control" id="price{{ $house->id }}" name="price" value="{{ old('price', $house->price) }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="location{{ $house->id }}" class="form-label">Location</label>
                                        <input type="text" class="form-control" id="location{{ $house->id }}" name="location" value="{{ old('location', $house->location) }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="bedrooms{{ $house->id }}" class="form-label">Bedrooms</label>
                                        <input type="number" class="form-control" id="bedrooms{{ $house->id }}" name="bedrooms" value="{{ old('bedrooms', $house->bedrooms) }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="description{{ $house->id }}" class="form-label">Description</label>
                                        <textarea class="form-control" id="description{{ $house->id }}" name="description" required>{{ old('description', $house->description) }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="status{{ $house->id }}" class="form-label">Status</label>
                                        <select class="form-control" id="status{{ $house->id }}" name="status" required>
                                            <option value="available" {{ old('status', $house->status) == 'available' ? 'selected' : '' }}>Available</option>
                                            <option value="booked" {{ old('status', $house->status) == 'booked' ? 'selected' : '' }}>Booked</option>
                                            <option value="maintenance" {{ old('status', $house->status) == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Update House</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- End Modal -->
                 <!-- View House Modal -->
<div class="modal fade" id="viewHouseModal{{ $house->id }}" tabindex="-1" aria-labelledby="viewHouseModalLabel{{ $house->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewHouseModalLabel{{ $house->id }}">House Details: {{ $house->name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">House ID</label>
                        <input type="text" class="form-control" value="{{ $house->id }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" value="{{ $house->name }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">City</label>
                        <input type="text" class="form-control" value="{{ $house->city }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Price</label>
                        <input type="text" class="form-control" value="KES {{ number_format($house->price, 2) }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Location</label>
                        <input type="text" class="form-control" value="{{ $house->location }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Bedrooms</label>
                        <input type="text" class="form-control" value="{{ $house->bedrooms }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" rows="3" readonly>{{ $house->description }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <input type="text" class="form-control" value="{{ ucfirst($house->status) }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Created At</label>
                        <input type="text" class="form-control" value="{{ $house->created_at->format('Y-m-d H:i') }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Updated At</label>
                        <input type="text" class="form-control" value="{{ $house->updated_at->format('Y-m-d H:i') }}" readonly>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- End View House Modal -->
            @endforeach
        </div>
    </div>
</div>

<!-- Bootstrap JS (required for modal functionality) -->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function () {
    $('.update-house-form').on('submit', function (e) {
        e.preventDefault();

        let form = $(this)[0];
        let houseId = $(this).data('house-id');
        let formData = new FormData(form);

        $.ajax({
            url: `/houses/${houseId}/update`,
            type: 'POST',
            data: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'X-HTTP-Method-Override': 'PATCH'
            },
            contentType: false,
            processData: false,
            success: function (response) {
                alert('House updated successfully!');
                location.reload(); // Or update the card content dynamically
            },
            error: function (xhr) {
                alert('Failed to update house. Check console for details.');
                console.error(xhr.responseText);
            }
        });
    });
});
</script>

@endsection
