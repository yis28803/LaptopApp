<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\GoogleDriveService;

class GoogleDriveServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(GoogleDriveService::class, function ($app) {
            return new GoogleDriveService();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
