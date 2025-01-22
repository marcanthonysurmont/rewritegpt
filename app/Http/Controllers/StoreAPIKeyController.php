<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class StoreAPIKeyController extends Controller
{
    public function __invoke(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'api_key' => 'required|string'
        ]);

        // Get the API key from the request
        $apiKey = $validated['api_key'];

        // Path to the config file
        $configPath = storage_path('app/config.json');

        // Check if the file exists
        if (File::exists($configPath)) {
            // Read the existing configuration
            $config = json_decode(File::get($configPath), true);
            
            // Update the API key in the config
            $config['api_key'] = $apiKey;

            // Write the updated config back to the file
            File::put($configPath, json_encode($config, JSON_PRETTY_PRINT));

            return response()->json(['success' => 'API Key stored successfully']);
        } else {
            return response()->json(['error' => 'Configuration file not found'], 404);
        }
    }
}

