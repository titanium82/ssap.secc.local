<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Observers\ExhibitionEventObserver;
use App\Models\ExhibitionEvent;

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
        ExhibitionEvent::observe(ExhibitionEventObserver::class);
    }
}
