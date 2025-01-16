<?php

namespace App\Providers;

use App\Events\ProcessCopiedTextEvent;
use App\Http\Controllers\ProcessCopiedTextController;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use App\Events\JsonResponseEvent;
use App\Listeners\JsonResponseListener;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Event::listen(ProcessCopiedTextEvent::class, ProcessCopiedTextController::class);
    }
}
