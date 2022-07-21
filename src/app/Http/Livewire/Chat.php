<?php

namespace App\Http\Livewire;

use App\Models\Message;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Chat extends Component
{
    const DEFAULT_AMOUNT_MESSAGES = 10;
    public $messageText;

    protected $rules = [
        'messageText' => 'required'
    ];

    public function render()
    {
        $messages = Message::with('user')
                            ->latest()
                            ->take(self::DEFAULT_AMOUNT_MESSAGES)
                            ->get()
                            ->sortBy('id');

        return view('livewire.chat', ['messages' => $messages]);
    }

    public function sendMessage()
    {
        $this->validate();

        Message::create([
            'user_id' => Auth::id(),
            'message_text' => $this->messageText,
        ]);

        $this->reset('messageText');
    }
}
