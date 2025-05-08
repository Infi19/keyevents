<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use App\View\Components\NoResult;
use App\View\Components\DropD;
use App\Services\GeminiService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(GeminiService::class, function ($app) {
            return new GeminiService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Blade::component('no-result', NoResult::class);
        Blade::component('drop-d', DropD::class);
        Blade::component('layouts.student', 'student-layout');
        Blade::component('layouts.organizer', 'organizer-layout');
        Blade::component('layouts.app', 'app-layout');
    }
}
