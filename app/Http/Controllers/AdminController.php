<?php

namespace App\Http\Controllers;
use App\Models\Clients;
use App\Models\Payments;
use Illuminate\Http\Request;
use App\Models\User; // Assuming User model is in this namespace
use Illuminate\Support\Facades\Auth;
class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     * Apply the 'restrict.to.admin' middleware to all methods.
     */
    public function __construct()
    {
        $this->middleware(\App\Http\Middleware\RestrictToAdmin::class);
    }

    /**
     * Show the admin dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $payments = Payments::all();
        $users = User::all(); // Fetch all users
        $clients = Clients::all();
        return view('admin.dashboard',compact('payments','users','clients'));
    }
}
