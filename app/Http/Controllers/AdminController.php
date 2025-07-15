<?php

namespace App\Http\Controllers;
use App\Models\Houses;
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
        $stats = [
            'users_count' => User::count() ?? 0,
            'houses_count' => Houses::count() ?? 0,
            'payments_count' => Payments::count() ?? 0
        ];
        $users = User::all() ?? collect([]);
        $houses = Houses::all() ?? collect([]);
        $payments = Payments::all() ?? collect([]);
        return view('admin.dashboard',compact('stats', 'users', 'houses', 'payments'));
    }
}
