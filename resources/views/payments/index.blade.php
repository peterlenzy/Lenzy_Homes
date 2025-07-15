@extends('dashboard')
@section('title', 'Payments')

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
        <h1 class="mb-4">Payments</h1>
        </div>
        <div class="col text-end">
            <a href="{{route('payments.archived')}}"class="btn btn-primary">Trashed Payments</a>
        </div>
        </div>
        <form action="{{url('search_payment')}}"method="get">
            <input type="search"name="search_payment"placeholder="search_payment"></input>
            <input type="submit"value="search_payment"></input>
        </form>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
            @foreach ($payments as $payment)
                <div class="col d-flex">
                    <div class="card flex-fill shadow-sm" style="min-width: 300px;">
                        <div class="card-body">
                            <p class="mb-2"><strong>Amount:</strong> KES {{ number_format($payment->amount, 2) }}</p>
                            <p class="mb-2"><strong>Payment Method:</strong> {{ ucfirst($payment->payment_method) }}</p>
                            <p class="mb-2"><strong>Payment Date:</strong> {{ $payment->date_of_payment }}</p>
                            <p class="mb-2"><strong>Status:</strong> {{ ucfirst($payment->status) }}</p>
                            <p class="mb-2"><strong>Transaction ID:</strong> {{ $payment->transaction_id }}</p>
                        </div>
                        <div class="card-footer d-flex gap-2 flex-wrap">
                           <button class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#viewPaymentModal{{ $payment->id }}">
                                View Details
                           </button>
                            <button class="btn btn-warning mt-2" data-bs-toggle="modal" data-bs-target="#editPaymentModal{{ $payment->id }}">
                                Edit Payment
                            </button>

                            <form action="{{ route('payments.destroy', $payment->id) }}" method="POST" class="mt-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this payment?')">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Edit Payment Modal -->
                <div class="modal fade" id="editPaymentModal{{ $payment->id }}" tabindex="-1" aria-labelledby="editPaymentModalLabel{{ $payment->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{ route('payments.update', ['payment' => $payment->id]) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editPaymentModalLabel{{ $payment->id }}">Edit Payment</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="amount{{ $payment->id }}" class="form-label">Amount</label>
                                        <input type="number" class="form-control" id="amount{{ $payment->id }}" name="amount" value="{{ $payment->amount }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="payment_method{{ $payment->id }}" class="form-label">Payment Method</label>
                                        <select class="form-select" id="payment_method{{ $payment->id }}" name="payment_method" required>
                                            <option value="credit_card" {{ $payment->payment_method == 'credit_card' ? 'selected' : '' }}>Credit Card</option>
                                            <option value="bank_transfer" {{ $payment->payment_method == 'bank_transfer' ? 'selected' : '' }}>Bank Transfer</option>
                                            <option value="cash" {{ $payment->payment_method == 'cash' ? 'selected' : '' }}>Cash</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="date_of_payment{{ $payment->id }}" class="form-label">Payment Date</label>
                                        <input type="date" class="form-control" id="date_of_payment{{ $payment->id }}" name="date_of_payment" value="{{ $payment->date_of_payment }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="status{{ $payment->id }}" class="form-label">Status</label>
                                        <select class="form-select" id="status{{ $payment->id }}" name="status" required>
                                            <option value="pending" {{ $payment->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="completed" {{ $payment->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                            <option value="failed" {{ $payment->status == 'failed' ? 'selected' : '' }}>Failed</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="transaction_id{{ $payment->id }}" class="form-label">Transaction ID</label>
                                        <input type="text" class="form-control" id="transaction_id{{ $payment->id }}" name="transaction_id" value="{{ $payment->transaction_id }}" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Update Payment</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- End Modal -->
                 <!-- View Payment Modal -->
<div class="modal fade" id="viewPaymentModal{{ $payment->id }}" tabindex="-1" aria-labelledby="viewPaymentModalLabel{{ $payment->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <h5 class="modal-title" id="viewPaymentModalLabel{{ $payment->id }}">Payment Details (ID: {{ $payment->id }})</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Payment ID</label>
                        <input type="text" class="form-control" value="{{ $payment->id }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Amount</label>
                        <input type="text" class="form-control" value="KES {{ number_format($payment->amount, 2) }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Payment Method</label>
                        <input type="text" class="form-control" value="{{ ucfirst($payment->payment_method) }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Date of Payment</label>
                        <input type="text" class="form-control" value="{{ $payment->date_of_payment }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <input type="text" class="form-control" value="{{ ucfirst($payment->status) }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Transaction ID</label>
                        <input type="text" class="form-control" value="{{ $payment->transaction_id }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Created At</label>
                        <input type="text" class="form-control" value="{{ $payment->created_at->format('Y-m-d H:i') }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Updated At</label>
                        <input type="text" class="form-control" value="{{ $payment->updated_at->format('Y-m-d H:i') }}" readonly>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End View Modal -->

            @endforeach
        </div>
    </div>
</div>

<!-- Bootstrap JS (for modal functionality) -->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function () {
    $('.update-payment-form').on('submit', function (e) {
        e.preventDefault();

        let $form = $(this);
        let paymentId = $form.data('payment-id');
        let formData = new FormData(this);

        $.ajax({
            url: `/payments/${paymentId}`,
            method: 'POST', // Laravel requires method override for PATCH
            data: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'X-HTTP-Method-Override': 'PATCH'
            },
            processData: false,
            contentType: false,
            success: function (response) {
                alert('Payment updated successfully!');
                location.reload(); // OR update DOM without reloading
            },
            error: function (xhr) {
                console.error(xhr.responseText);
                alert('Failed to update payment. Check the form for errors.');
            }
        });
    });
});
</script>
@endsection
