<?php

namespace App\Listeners;

use App\Events\JsonResponseEvent;

class JsonResponseListener
{
    /**
     * Handle the event.
     */
    public function handle(JsonResponseEvent $event): void
    {
        $response = $event->response;
        
        $response = json_encode($response);
    }
}