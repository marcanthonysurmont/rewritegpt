<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Information;
use Illuminate\Support\Facades\Log;

class StorePromptController extends Controller
{
    public function __invoke(Request $request){

        $validated = $request->validate([
            'prompt' => 'required|integer',
            'language' => 'string'
        ]);

        $prompt = '';
        $prompt_id = (int)$validated['prompt'];

        if($prompt_id === 1){
            $prompt = 'Rewrite the following sentence: ';
        }

        if($prompt_id === 2){
            $prompt = 'In the ' . $validated['language'] . ' language, rewrite the following sentence: ';
        }

        $information = Information::first();

        if($information){
            $information->update(['prompt' => $prompt, 'prompt_id' => $prompt_id]);
        }

        return response()->json(['success' => 'Processing option saved successfully!']);
    }
}
