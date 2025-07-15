@extends('dashboard')
@section('title', 'Users')

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
        <div class="row">
            <div class="col">
            <h1 class="mb-4">Users</h1>
            </div>
            <div class="col text-end">
                <a href="{{route('users.archived')}}"class="btn btn-primary">Trashed Users</a>
            </div>
        </div>
        <form action="{{url('search')}}"method="get" align="centre">
            <input type="search"name="search"placeholder="search by name or email"></input>
            <input type="submit"value="search">
        </form>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
            @foreach ($users as $user)
                <div class="col d-flex user-card">
                    <div class="card flex-fill shadow-sm" style="min-width: 300px;">
                        <div class="card-body">
                            <p class="mb-2 user-name"><strong>Name:</strong> {{ $user->name }}</p>
                            <p class="mb-2 user-email"><strong>Email:</strong> {{ $user->email }}</p>
                            <p class="mb-2"><strong>Role:</strong> {{ ucfirst($user->role) }}</p>
                            <p class="mb-2"><strong>Email Verified:</strong> {{ $user->email_verified_at ? 'Yes' : 'No' }}</p>
                        </div>
                        <div class="card-footer d-flex gap-2 flex-wrap">
                           <!-- View Details Button -->
                            <button class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#viewUserModal{{ $user->id }}">
                                View Details
                            </button>

                            <button class="btn btn-warning mt-2" data-bs-toggle="modal" data-bs-target="#editUserModal{{ $user->id }}">
                                Edit User
                            </button>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="mt-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">
                                    Delete User
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Modal: Edit User -->
                <div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1" aria-labelledby="editUserModalLabel{{ $user->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{ route('users.update', ['user' => $user->id]) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editUserModalLabel{{ $user->id }}">Edit User: {{ $user->name }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="name{{ $user->id }}" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="name{{ $user->id }}" name="name" value="{{ $user->name }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email{{ $user->id }}" class="form-label">Email address</label>
                                        <input type="email" class="form-control" id="email{{ $user->id }}" name="email" value="{{ $user->email }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="role{{ $user->id }}" class="form-label">Role</label>
                                        <select class="form-select" id="role{{ $user->id }}" name="role" required>
                                            <option disabled>Select Role</option>
                                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                            <option value="editor" {{ $user->role == 'editor' ? 'selected' : '' }}>Editor</option>
                                            <option value="viewer" {{ $user->role == 'viewer' ? 'selected' : '' }}>Viewer</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Update User</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- End Modal -->
                 <!-- Modal: View User Details -->
<div class="modal fade" id="viewUserModal{{ $user->id }}" tabindex="-1" aria-labelledby="viewUserModalLabel{{ $user->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewUserModalLabel{{ $user->id }}">User Details: {{ $user->name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    @csrf
                    <div class="mb-3">
                        <label for="id{{ $user->id }}" class="form-label">User ID</label>
                        <input type="text" class="form-control" id="id{{ $user->id }}" value="{{ $user->id }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="name{{ $user->id }}" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name{{ $user->id }}" value="{{ $user->name }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="email{{ $user->id }}" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="email{{ $user->id }}" value="{{ $user->email }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="email_verified_at{{ $user->id }}" class="form-label">Email Verified At</label>
                        <input type="text" class="form-control" id="email_verified_at{{ $user->id }}" value="{{ $user->email_verified_at ?? 'Not Verified' }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="role{{ $user->id }}" class="form-label">Role</label>
                        <input type="text" class="form-control" id="role{{ $user->id }}" value="{{ $user->role }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="created_at{{ $user->id }}" class="form-label">Created At</label>
                        <input type="text" class="form-control" id="created_at{{ $user->id }}" value="{{ $user->created_at->format('Y-m-d H:i') }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="updated_at{{ $user->id }}" class="form-label">Updated At</label>
                        <input type="text" class="form-control" id="updated_at{{ $user->id }}" value="{{ $user->updated_at->format('Y-m-d H:i') }}" readonly>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- End View Details Modal -->

            @endforeach
        </div>
    </div>
</div>

<!-- Bootstrap JS (for modal functionality) -->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function () {
    $('.update-user-form').on('submit', function (e) {
        e.preventDefault();

        let $form = $(this);
        let userId = $form.data('user-id');
        let formData = new FormData(this);

        $.ajax({
            url: `/users/${userId}`,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'X-HTTP-Method-Override': 'PATCH'
            },
            success: function (response) {
                alert('User updated successfully!');
                // Optional: Reload the page or update the card content directly
                location.reload();
            },
            error: function (xhr) {
                console.error(xhr.responseText);
                alert('Failed to update user. Please check your input.');
            }
        });
    });
});
</script>



@endsection
