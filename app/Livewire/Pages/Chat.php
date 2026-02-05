<?php

namespace App\Livewire\Pages;

use App\Services\UserService;
use App\Services\TalkService;
use Livewire\Component;
use \Illuminate\Database\Eloquent\Collection;
use App\Models\Talk;
use App\Models\User;

class Chat extends Component
{
    public string $highlightMessage = '';
    public string $newMessage = '';
    public $messages; //  Collection. type-hiting de Collection no Livewire gera erro.
    public $users;    // Collection. type-hiting de Collection no Livewire gera erro.
    public ?User $guestUser = null;
    public ?Talk $talk = null;

    public function render()
    {
        return view('livewire.pages.chat');
    }

    public function mount()
    {
        $this->messages = collect();
        $this->users = collect();
        $this->setTalk(null, null);
    }

    public function sendMessage()
    {
        if(is_null($this->guestUser) ){
            $this->highlightMessage = 'Você precisa selecionar um usuário para conversar';
            return;
        }

        if(empty(trim($this->newMessage)) ){
            $this->highlightMessage = 'Mensagem vazia';
            return;
        }

        app(\App\Services\MessageService::class)->createMessageAndNotifyUser(
            sender_user_id: auth()->id(),
            talk_id: $this->talk->id,
            content: $this->newMessage
        );

        $this->reset('newMessage');
        $this->setTalk(guestUserId: $this->guestUser->id);
    }

    public function setTalk(int|null $guestUserId)
    {   
        $this->users = app(UserService::class)->getOthrerUsers();

        if(is_null($guestUserId)){
            $this->highlightMessage = 'Click em algum usuário para iniciar o chat';
            $guestUserId = auth()->id();
        }else{
            $this->guestUser = $this->users->where('id', $guestUserId)->first();
            $this->highlightMessage = 'Conversando com ' . $this->guestUser->name;
            $guestUserId = $this->guestUser->id;
        }
        
     
        $this->talk = app(TalkService::class)->findOrCreateTalk(creatorUserId: auth()->id(), guestUserId: $guestUserId);
        $this->messages = app(\App\Services\MessageService::class)->getAllMessagesOfTalk(talkId: $this->talk->id);
    }


}
