<?php

namespace App\Livewire;

use App\Models\Message;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Chat extends Component
{
    public $receiver;        // User object of person you're chatting with
    public $message = '';    // Current message input
    public $messages = [];   // All loaded messages

    protected $rules = [
        'message' => 'required|string|max:1000',
    ];

    public function mount($receiverId)
    {
        $this->receiver = User::findOrFail($receiverId);
        $this->loadMessages();
    }

    public function loadMessages()
    {
        $this->messages = Message::where(function ($query) {
            $query->where('sender_id', Auth::id())
                  ->where('receiver_id', $this->receiver->id);
        })->orWhere(function ($query) {
            $query->where('sender_id', $this->receiver->id)
                  ->where('receiver_id', Auth::id());
        })->orderBy('created_at')->get()->toArray();  ;
    }

    public function sendMessage()
    {
        $this->validate();

        Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $this->receiver->id,
            'message' => $this->message,
        ]);

        $this->message = '';       // Clear input
        $this->loadMessages();     // Refresh messages
    }

    public function render()
    {
        return view('livewire.chat');
    }
}
