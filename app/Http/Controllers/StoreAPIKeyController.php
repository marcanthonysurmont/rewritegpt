<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Information;

class StoreAPIKeyController extends Controller
{
    public function __invoke(Request $request)
    {
        $validated = $request->validate([
            'api_key' => 'required|string'
        ]);

        $apiKey = $validated['api_key'];

        $information = Information::first();

        if ($information) {
            $information->update(['api_key' => $apiKey]);
        }

        return response()->json(['success' => 'API Key stored successfully']);
    }
}
