<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;

class ViewHomeController extends Controller
{
    public function __invoke()
    {
        $configPath = storage_path('app/config.json');

        if (File::exists($configPath)) {
            $config = json_decode(File::get($configPath), true);
        } else {
            $config = [];
        }

        return view('home', ['config' => $config]);
    }
}
