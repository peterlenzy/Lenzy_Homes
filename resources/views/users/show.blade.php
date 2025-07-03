@extends('dashboard')
@section('title', 'User Details')
@section('content')
<div class="container my-5">
    <div class="card shadow p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">User Details</h2>
        </div>
        <form>
            @csrf
            <div class="mb-3">
                <label for="id" class="form-label">User ID</label>
                <input type="text" class="form-control" id="id" value="{{ $user->id }}" readonly>
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" value="{{ $user->name }}" readonly>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" class="form-control" id="email" value="{{ $user->email }}" readonly>
            </div>

            <div class="mb-3">
                <label for="email_verified_at" class="form-label">Email Verified At</label>
                <input type="text" class="form-control" id="email_verified_at" value="{{ $user->email_verified_at ?? 'Not Verified' }}" readonly>
            </div>

            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <input type="text" class="form-control" id="role" value="{{ $user->role}}" readonly>
            </div>

            <div class="mb-3">
                <label for="created_at" class="form-label">Created At</label>
                <input type="text" class="form-control" id="created_at" value="{{ $user->created_at->format('Y-m-d H:i') }}" readonly>
            </div>

            <div class="mb-3">
                <label for="updated_at" class="form-label">Updated At</label>
                <input type="text" class="form-control" id="updated_at" value="{{ $user->updated_at->format('Y-m-d H:i') }}" readonly>
            </div>

            <div class="d-flex justify-content-end">
                <a href="{{ route('users.index') }}" class="btn btn-secondary me-2">Close</a>
            </div>
        </form>
    </div>
</div>
@endsection
