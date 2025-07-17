<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;


class HelpCenterController extends Controller
{
    //
    public function index()
{
    $conversations = Conversation::where('user_id', auth()->id())->latest()->get();
    return view('help_center.index', compact('conversations'));
}
public function show($id)
{
    $conversation = Conversation::with('messages.sender')->findOrFail($id);

    if (!auth()->user()->hasAnyRole(['admin', 'editor']) && $conversation->user_id !== auth()->id()) {
        abort(403);
    }

    return view('help_center.show', compact('conversation'));
}
public function reply(Request $request, $id)
{
    $conversation = Conversation::findOrFail($id);

    if (!auth()->user()->hasAnyRole(['admin', 'editor']) && $conversation->user_id !== auth()->id()) {
        abort(403);
    }

    $message = Message::create([
        'conversation_id' => $conversation->id,
        'sender_id' => auth()->id(),
        'content' => $request->input('content'),
    ]);

    return back()->with('success', 'Reply sent.');
}
public function start(Request $request)
{
    $request->validate([
        'user_id' => 'required|exists:users,id',
        'content' => 'required|string',
    ]);

    $conversation = Conversation::firstOrCreate([
        'user_id' => $request->user_id,
    ]);

    Message::create([
        'conversation_id' => $conversation->id,
        'sender_id' => auth()->id(),
        'content' => $request->input('content'),
    ]);

    return redirect()->route('conversation.show', $conversation->id);
}
public function recentMessages()
{
    $user = auth()->user();

    $messages = $user->hasAnyRole(['admin', 'editor'])
        ? Message::with('sender')->latest()->take(10)->get()
        : Message::whereHas('conversation', fn($q) => $q->where('user_id', $user->id))
            ->with('sender')
            ->latest()->take(10)->get();

    return response()->json($messages);
}


}
