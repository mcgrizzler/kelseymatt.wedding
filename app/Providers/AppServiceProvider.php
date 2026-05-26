<?php

namespace App\Providers;

use App\Jobs\ExportCompletionWithEmail;
use Filament\Actions\Exports\Jobs\ExportCompletion;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ExportCompletion::class, ExportCompletionWithEmail::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
