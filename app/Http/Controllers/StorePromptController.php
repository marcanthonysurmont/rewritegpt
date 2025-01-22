<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class StorePromptController extends Controller
{
    public function __invoke(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'prompt' => 'required|integer',
            'language' => 'nullable|string'
        ]);

        $prompt = '';
        $prompt_id = (int)$validated['prompt'];

        if ($prompt_id === 1) {
            $prompt = 'Rewrite the following sentence: ';
        } elseif ($prompt_id === 2 && isset($validated['language'])) {
            $prompt = 'In the ' . $validated['language'] . ' language, rewrite the following sentence: ';
        }

        $configPath = storage_path('app/config.json');

        if (!File::exists($configPath)) {
            return response()->json(['error' => 'Configuration file not found'], 404);
        }

        $config = json_decode(File::get($configPath), true);

        $config['prompt'] = $prompt;
        $config['prompt_id'] = $prompt_id;

        File::put($configPath, json_encode($config, JSON_PRETTY_PRINT));

        return response()->json(['success' => 'Processing option saved successfully!']);
    }
}

