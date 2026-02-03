<?php

namespace App\Livewire\Pages;

use App\Services\UserService;
use App\Services\TalkService;
use Livewire\Component;

class Chat extends Component
{
    public string $message = '';
    public \Illuminate\Database\Eloquent\Collection $users;

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

    public function setTalk(int $guestUserId)
    {
        $talk = app(TalkService::class)->findOrCreateTalk(creatorUserId: auth()->id(), guestUserId: $guestUserId);
        dd($talk);
    }


}
