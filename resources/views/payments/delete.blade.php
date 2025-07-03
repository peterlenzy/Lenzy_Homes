@extends('dashboard')
@section('title', 'Delete Payment')
@section('content')
<div id="app-content">
<div class="container">
    <h1>Delete Payment</h1>
    <form action="{{ route('payments.destroy', $payment->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <div class="mb-3">
            <label for="amount" class="form-label">Amount</label>
            <input type="number" class="form-control" id="amount" name="amount" value="{{ $payment->amount }}" readonly>
        </div>
        <div class="mb-3">
            <label for="payment_date" class="form-label">Payment Date</label>
            <input type="date" class="form-control" id="payment_date" name="payment_date" value="{{ $payment->payment_date }}" readonly>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-select" id="status" name="status" disabled>
                <option value="pending" {{ $payment->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="completed" {{ $payment->status == 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="failed" {{ $payment->status == 'failed' ? 'selected' : '' }}>Failed</option>
            </select>
        </div>
        <button type="submit" class="btn btn-danger">Delete Payment</button>
    </form>
</div>
</div>
@endsection
