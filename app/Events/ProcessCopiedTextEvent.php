<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use App\Service\StaticCache;

class ProcessCopiedTextEvent implements ShouldBroadcastNow
{    
    public function broadcastOn(): array
    {
        if (StaticCache::has('broadcasted')) {
            return [];
        }

        StaticCache::set('broadcasted', true);

        return [
            new Channel('nativephp'),
        ];
    }

}
