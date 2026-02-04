<?php

namespace App\Services;

use App\Models\Talk;

class TalkService
{
    public function findOrCreateTalk(int $creatorUserId, int $guestUserId): Talk
    {
        $minor_major_user_ids = min($creatorUserId, $guestUserId).'-'.max($creatorUserId, $guestUserId);
        
        $talk = Talk::where('minor_major_user_ids', $minor_major_user_ids)->first();
        
        if(!$talk) {
            $talk = Talk::create([
                'creator_user_id' => $creatorUserId,
                'guest_user_id' => $guestUserId,
                'minor_major_user_ids' => $minor_major_user_ids,
            ]);
        }

        return $talk;
    }
}
