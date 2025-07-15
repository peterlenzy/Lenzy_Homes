@extends('dashboard')
@section('title', ' Deleted Users')

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
            <h1 class="mb-4">Trashed Users</h1>
            </div>
        </div>
        <form action="{{url('search_user')}}"method="get" align="centre">
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
                            <form action="/users/{{$user->id}}/restore"method="post"class="mt-2">
                                @csrf
                            <button class="btn btn-primary ">Restore</button>
                            </form>
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
            @endforeach
        </div>
    </div>
</div>
@endsection
