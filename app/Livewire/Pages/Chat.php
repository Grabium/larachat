<?php

namespace App\Livewire\Pages;

use App\Services\UserService;
use Livewire\Component;

class Chat extends Component
{
    public string $message = '';
    public $users = [];

    public function render()
    {
        return view('livewire.pages.chat');
    }

    public function mount()
    {
        $this->users = app(UserService::class)->getOthrerUsers();
    }

    public function sendMessage()
    {
        dd($this->message);
    }


}
