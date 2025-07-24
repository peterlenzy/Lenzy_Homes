<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public $selecteduser();
   public function index()
    {

        $users = User::where('id', '!=', Auth::id())->get();
       $this->selecteduser = $this->users->first();
        return view('chat', compact('users')); // Adjust the view name as needed

    }
}
