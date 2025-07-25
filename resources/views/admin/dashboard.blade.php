@extends('dashboard')
@section('title', 'Dashboard')
@section('content')

<div id="app-content">
    <div class="container-fluid">
        <div class="col-12">
            <div class="container-md border py-0">
                <div class="card mb-4 bg-primary">
                    <div class="card-header bg-primary ">
                        <h1>Admin Dashboard</h1>
                    </div>
                    <div class="card-body text-bold text-white">
                        <p>Welcome you are now loged in as an admin. Here you can manage users, houses, and payments.</p>
                    </div>

                </div>
                <!-- Summary Cards -->
                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="card text-dark text-bold bg-primary mb-3">
                            <div class="card-header"><i data-feather="users" class=" me-2 icon-xs"></i>Total Users Available</div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $stats['users_count'] }}</h5>
                                <p class="card-text">Registered Users</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-dark bg-success mb-3">
                            <div class="card-header"><i data-feather="home" class="nav-icon me-2 icon-xxs"></i>Total Houses Available</div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $stats['houses_count'] }}</h5>
                                <p class="card-text">Available Houses</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-dark bg-info mb-3">
                            <div class="card-header"><i data-feather="dollar-sign" class="nav-icon me-2 icon-xxs"></i>Total Payments Available</div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $stats['payments_count'] }}</h5>
                                <p class="card-text">Processed Payments</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            Payments Table
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Amount</th>
                            <th>Payment Method</th>
                            <th>Status</th>
                            <th>Transaction ID</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($payments as $payment)
                            <tr>
                                <td>{{ $payment->id }}</td>
                                <td>{{ number_format($payment->amount, 2) }}</td>
                                <td>{{ $payment->payment_method }}</td>
                                <td>{{ $payment->status }}</td>
                                <td>{{ $payment->transaction_id }}</td>
                                <td>{{ $payment->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <form action="{{ route('payments.destroy', $payment->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this payment?')">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">No payments found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                Users Table
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Email Verified At</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role }}</td>
                                <td>{{ $user->email_verified_at ? $user->email_verified_at->format('d/m/Y H:i') : 'Not Verified' }}</td>
                                <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No users found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
        </div>
    </div>
</div>

<style>
    .sidebar {
        width: 250px;
        transition: width 0.3s ease;
        overflow-y: auto;
    }

    .sidebar.collapsed {
        width: 0;
        overflow: hidden;
    }

    .container-md {
        max-width: 100%;
        margin-left: 0;
        margin-right: 0;
    }
</style>
@endsection
