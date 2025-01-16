<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Information;

class ViewHomeController extends Controller
{
    public function __invoke(Request $request)
    {
        $information = Information::first();

        return view('home', compact('information'));
    }
}
