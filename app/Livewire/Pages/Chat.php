<?php

namespace App\Livewire\Pages;

use Livewire\Component;

class Chat extends Component
{
    public string $message = '';

    public function render()
    {
        return view('livewire.pages.chat');
    }

    public function sendMessage()
    {
        dd($this->message);
    }
}
