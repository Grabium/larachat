<?php

namespace App\Services\Supports;

use Illuminate\Support\Str;

class HashChannelGenerator
{
    /**
     * Create a new class instance.
     */
    public function generateChannelHash()
    {
        $hash = md5(Str::uuid()->toString());
        if (strlen($hash) > 32) {
            $hash = substr($hash, 0, 32);
        }

        return 'channel_' . $hash;
    }
}
