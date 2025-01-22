<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Native\Laravel\Facades\Clipboard;
use Native\Laravel\Facades\Notification;
use OpenAI;
use Illuminate\Support\Facades\File;
use App\Events\JsonResponseEvent;

class ProcessCopiedTextController extends Controller
{
    public function __invoke()
    {
        // Path to the config file
        $configPath = storage_path('app/config.json');

        // Read current config
        $config = json_decode(File::get($configPath), true);

        $prompt = $config['prompt'];
        $apiKey = $config['api_key'];

        if (!$apiKey) {
            Notification::title('RewriteGPT')
                ->message('Please add your OpenAI API key in the settings.')
                ->show();

            $jsonResponse = ['error' => 'Please add your OpenAI API key in the settings.'];
            event(new JsonResponseEvent($jsonResponse));
            return;
        }

        try {
            $client = OpenAI::client($apiKey);
            $result = $client->chat()->create([
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    ['role' => 'user', 'content' => $prompt . Clipboard::text()],
                ],
            ]);

            $rewrittenText = $result->choices[0]->message->content;
            Clipboard::text($rewrittenText);

            Notification::title('RewriteGPT')
                ->message('Your text has been rewritten and copied to the clipboard.')
                ->show();

            $jsonResponse = ['success' => 'Your text has been rewritten and copied to the clipboard.'];
            event(new JsonResponseEvent($jsonResponse));

            // Example of saving any changes to the config (e.g., prompt update)
            $config['prompt'] = $rewrittenText; // Modify as needed
            File::put($configPath, json_encode($config, JSON_PRETTY_PRINT));

        } catch (\Exception $e) {
            Notification::title('RewriteGPT')
                ->message('Invalid API key or API error. Please check your settings.')
                ->show();

            $jsonResponse = ['error' => $e->getMessage()];
            event(new JsonResponseEvent($jsonResponse));
        }
    }
}

