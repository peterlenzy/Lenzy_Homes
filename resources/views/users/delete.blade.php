@extends('dashboard')
@section('title', 'Delete User')
@section('content')
<div id="app-content">
<div class="container">
    <h1>Delete User</h1>
    <form action="{{ route('users.destroy', $user->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required readonly>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required readonly>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Leave blank to keep current password">
        </div>
        <button type="submit" class="btn btn-danger">Delete User</button>
    </form>
</div>
</div>
@endsection
