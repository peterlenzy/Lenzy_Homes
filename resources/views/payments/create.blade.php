@extends('dashboard')
@section('title', 'Create Payment')
@section('content')
<div id="app-content">
<div class="container">
    <h1>Create Payment</h1>
    <form action="{{ route('payments.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="amount" class="form-label">Amount</label>
            <input type="number" class="form-control" id="amount" name="amount" required>
        </div>
        <label for="Payment_method" class="form-label">Payment Method</label>
            <select class="form-select" id="payment_method" name="payment_method" required>
                <option value="credit_card">Credit Card</option>
                <option value="bank_transfer">Bank Transfer</option>
                <option value="cash">Cash</option>
            </select>
        <div class="mb-3">
            <label for="payment_date" class="form-label">Payment Date</label>
            <input type="date" class="form-control" id="date_of_payment" name="date_of_payment" required>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-select" id="status" name="status" required>
                <option value="pending">Pending</option>
                <option value="completed">Completed</option>
                <option value="failed">Failed</option>
            </select>
        </div>
        <div>
            <label for="Transaction_id"class="form-label">Transaction id</label>
            <input type="string"class="form-control" id="transaction_id"name="transaction_id" required>
        </div>
        <div>
        <button type="submit" class="btn btn-primary">Create Payment</button>
        </div>
    </form>
</div>
</div>
@endsection
