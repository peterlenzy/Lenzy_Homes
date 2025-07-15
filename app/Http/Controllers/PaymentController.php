<?php

namespace App\Http\Controllers;
use App\Models\Payments;
use Illuminate\Http\Request;
use App\Models\Houses;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     public function archived(Request $request)
    {
        $payments = Payments::onlyTrashed()->get();
        return view('payments.archived', compact('payments'));
    }
     public function restore(Request $request,Payments $payment)
    {

        $payment->restore();
        return redirect()->route('payments.index');
    }
    public function search_payment(Request $request)
    {
        $search_payment =$request->search_payment;
        $payments=Payments::where('transaction_id','like','%'.$search_payment.'%')->orwhere('date_of_payment','like','%'.$search_payment.'%')->get();
        return view('payments.index',compact('payments'));
    }
    public function index()
    {

        $payments = Payments::all();
        // $payments = DB::table('payments')->whereNull('deleted_at')->get();
        // dd($payments);
        return view('payments.index',compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Payments $payment,Houses $house)
    {
        $house = Houses::findOrFail($house->id);
        return view('payments.create',compact('house'));
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

    public function destroy($payment)
    {
        $payment_dtl = DB::table('payments')->where('id', $payment)->first();
    if (!$payment_dtl) {
        return redirect()->back()->with('error', 'User not found');
    }

    if ($payment_dtl->deleted_at) {
        // Hard delete if trashed
        DB::table('payments')->where('id', $payment)->delete();
        $message = 'Payment permanently deleted successfully';
    } else {
        // Soft delete if active
        $active_payment=Payments::where('id', $payment)->first();
        $active_payment->delete();
        $message = 'Payment soft deleted successfully';
    }

     return redirect()->route('payments.index')->with('success', 'Payment deleted successfully!');
}

}
