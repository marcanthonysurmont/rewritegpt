<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Information;
use Native\Laravel\Facades\Clipboard;
use Native\Laravel\Facades\Notification;
use OpenAI;
use App\Events\JsonResponseEvent;

class ProcessCopiedTextController extends Controller
{
    public function __invoke(){

        $information = Information::first();
        $prompt = $information->prompt;
        $copiedText = Clipboard::text();

        if(!$information){
            Notification::title('RewriteGPT')
            ->message('Please add your OpenAI API key in the settings.')
            ->show();

            $jsonResponse = ['error' => 'Please add your OpenAI API key in the settings.'];
            event(new JsonResponseEvent($jsonResponse));
        }

        try{
            $client = OpenAI::client($information->api_key);
            $result = $client->chat()->create([
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    ['role' => 'user', 'content' => $prompt . $copiedText],
                ],
            ]);
    
            $rewrittenText = $result->choices[0]->message->content;
            Clipboard::text($rewrittenText);
    
            Notification::title('RewriteGPT')
                ->message('Your text has been rewritten and copied to the clipboard.')
                ->show();
            $jsonResponse = ['success' => 'Your text has been rewritten and copied to the clipboard.'];
            event(new JsonResponseEvent($jsonResponse));

        } catch (\Exception $e) {
            Notification::title('RewriteGPT')
                ->message('Invalid API key or API error. Please check your settings.')
                ->show();
            
            $jsonResponse = ['error' => $e->getMessage()];   
            event(new JsonResponseEvent($jsonResponse));
        }
    }
}
