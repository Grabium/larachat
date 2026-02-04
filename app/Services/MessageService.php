<?php

namespace App\Services;

use App\Models\Message;

class MessageService
{
    public function getAllMessagesOfTalk(int $talkId)
    {
        return Message::select(
            'messages.*',
            'users.name as sender_name'
        )
            ->join('users', 'messages.sender_user_id', '=', 'users.id')
            ->where('talk_id', $talkId)
            ->orderBy('messages.created_at', 'asc')
            ->get();
    }

    public function createMessageAndNotifyUser(
        int $sender_user_id,
        int $talk_id,
        string $content
    )
    {
        $m = Message::create(
            [
                'sender_user_id' => $sender_user_id,
                'talk_id' => $talk_id,
                'content' => $content
            ]
        );
    }
}
