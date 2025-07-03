<?php

namespace App\Http\Controllers;
use App\Models\Payments;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payments = Payments::all();
        return view('payments.index', compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Payments $payment)
    {
        //
        return view('payments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $payments = new Payments();
        $payments->amount = $request->amount;
        $payments->payment_method = $request->payment_method;
        $payments->date_of_payment = $request->date_of_payment;
        $payments->status = $request->status;
        $payments->transaction_id = $request->transaction_id;

        $payments->save();

        return redirect()->route('houses.index')->with('success', 'payment made successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Payments $payment)
    {
        //
        return view('payments.index', compact('payments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payments $payment)
    {
        //
        return view('payments.edit', compact('payment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,Payments $payment)
    {
        $validated = $request->validate([
        'amount' => 'required|numeric|min:0',
        'payment_method' => 'required|string|max:255',
        'date_of_payment' => 'required|date',
        'status' => 'required|string|max:255',
        'transaction_id' => 'required|string|max:255',
    ]);
        $payment->update($validated);
        return redirect()->route('payments.index',)->with('success', 'Payment updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(payments $payment)
    {
        //
        $payment->delete();
        return redirect()->route('payments.index')->with('success', 'payment deleted successfully!');
    }
}
