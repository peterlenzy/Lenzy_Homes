@extends('dashboard')
@section('title', 'Dashboard')
@section('content')

    <div id="app-content">
    <div class="container-fluid">
    <div class="col-12">
    <div class="container-md border py-0">
        <h1 class="mb-4">Payments List</h1>
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
        <!-- Pagination links -->
    <title>Users List</title>
    <div class="container mt-5">
        <h1 class="mb-4">Users List</h1>
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
</div>
<style>
        .sidebar {
            width: 250px; /* Default sidebar width */
            transition: width 0.3s ease;
            overflow-y: auto;
        }

        .sidebar.collapsed {
            width: 0;
            overflow: hidden;
        }
        .container-md {
            max-width: 100%; /* Override Bootstrap's max-width */
            margin-left: 0; /* Remove default centering */
            margin-right: 0;
        }

</style>
@endsection


