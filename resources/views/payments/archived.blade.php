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
        <h1 class="mb-4">Trashed Payments</h1>
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
                            <form action="/payments/{{$payment->id}}/restore"method="post"class="mt-2">
                                @csrf
                            <button class="btn btn-primary ">Restore</button>
                            </form>
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
            @endforeach
        </div>
    </div>
</div>


@endsection
