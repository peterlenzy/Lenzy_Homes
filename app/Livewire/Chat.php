<?php

namespace App\Livewire;

use App\Events\MessageSent;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Chat extends Component
{
    public $users;
    public $selectedUser;
    public $newMessage;
    public $messages;
    public $loginId;
    public function mount()
    {
        $authUser = auth()->user();

    if ($authUser->role === 'admin') {
        // Admin sees all users except themselves
        $this->users = User::where('id', '!=', $authUser->id)->latest()->get();
    } else {
        // Non-admin sees only the admin
        $this->users = User::where('role', 'admin')->latest()->get();
    }
        $this->selectedUser = $this->users->first();
        $this->loadMessages();
        $this->loginId = Auth::id();


    }
    public function selectUser($user_id)
    {
        $this->selectedUser = User::find($user_id);
         $this->loadMessages();
    }
    public function submit()
    {


        if(!$this->newMessage) {
            return;
        }
        $message = Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $this->selectedUser->id,
            'message' => $this->newMessage,
        ]);
        $this->messages->push($message);
        $this->newMessage = '';

        broadcast(new MessageSent($message));
    }
    public function getListeners()
    {
        return
        [
           "echo-private:chat.{loginId}" => 'newMessageNotification',
        ];
    }
    public function newMessageNotification($message)
    {
        if($message['sender_id'] == $this->selectedUser->id){
            $messageObj = Message::find($message['id']);
            $this->messages->push($messageObj);
        }
    }
   public function updatednewMessage($value)
    {
        // Emit an event to notify the other user that the sender is typing
        $this->dispatch("userTyping", [
            'userId' => $this->loginId,
            'userName' => Auth::user()->name,
            'selectedUserID' => $this->selectedUser->id,
        ]);
    }

    public function loadMessages()
    {

        $this->messages = Message::query()
            ->where(function($q) {
                $q->where('sender_id', Auth::id())
                    ->where('receiver_id', $this->selectedUser->id);

            })
            ->orWhere(function ($q) {
                $q->where('sender_id', $this->selectedUser->id)
                    ->where('receiver_id', Auth::id());
            })
            ->get();
    }
    public function render()
    {
        return view('livewire.chat',[
            'users' => $this->users
        ]);



    }
}
