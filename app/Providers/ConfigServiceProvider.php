<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Config ;

class ConfigServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
       config(Config::all()->pluck('value','name')->toArray());

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
