@extends('dashboard')
@section('title', 'Create Payment')
@section('content')
<div id="app-content">
<div class="card">
    <div class="row">
        <div class="col">
    <div class="card mb-3">
                <div class="card-header">House Details</div>
                <div class="card-body">
                    <p class="mb-4"><strong>Name:</strong>{{ $house->name }}</p>
                    <p class="mb-4"> <strong>City:</strong>{{ $house->city }}</p>
                    <p class="mb-4"><strong>Price:</strong>KES {{ number_format($house->price, 2) }}</p>
                    <p class="mb-4"><strong>Location:</strong>{{ $house->location }}</p>
                    <p class="mb-4"><strong>Bedrooms:</strong>{{ $house->bedrooms }}</p>
                    <p class="mb-4"><strong>Description:</strong>{{ $house->description }}</p>
                    <p class="mb-6"><strong>Status:</strong>{{ ucfirst($house->status) }}</p>
                </div>
            </div>
</div>
<div class="col">
    <div class="card">
    <div class="card-body">
    <form action="{{ route('payments.store') }}" method="POST">
        @csrf
        <div class="mb-0">
            <label for="amount" class="form-label">Amount</label>
            <input type="number" class="form-control" id="amount" name="amount" value="{{$house->price}}" required>
        </div>
        <div class="mb-0">
            <label for="Payment_method" class="form-label">Payment Method</label>
            <select class="form-select" id="payment_method" name="payment_method" required>
                <option value="credit_card">Credit Card</option>
                <option value="bank_transfer">Bank Transfer</option>
                <option value="cash">Cash</option>
            </select>
        </div>
        <div class="mb-0">
            <label for="payment_date" class="form-label">Payment Date</label>
            <input type="date" class="form-control" id="date_of_payment" name="date_of_payment" required>
        </div>
        <div class="mb-0">
            <label for="status" class="form-label">Status</label>
            <select class="form-select" id="status" name="status" required>
                <option value="pending">Pending</option>
                <option value="completed">Completed</option>
                <option value="failed">Failed</option>
            </select>
        </div>
        <div class="mb-0">
            <label for="Transaction_id"class="form-label">Transaction id</label>
            <input type="string"class="form-control" id="transaction_id"name="transaction_id" required>
        </div>
        <div class="mt-3">
        <button type="submit" class="btn btn-primary mb-2">Create Payment</button>
        </div>
    </form>
    </div>
    </div>
</div>
</div>
</div>
</div>
@endsection
