<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;


class JsonResponseEvent implements ShouldBroadcastNow
{
    public $response;

    public function __construct($response)
    {
        $this->response = $response;
    }

    public function broadcastOn(): array
    {
        return [
            new Channel('nativephp'),
        ];
    }
}