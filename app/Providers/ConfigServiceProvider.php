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
        try
        {
            config(Config::all()->pluck('value','name')->toArray());
        }
        catch(\Exception $e)
        {
            \Log::info("Database connection not established");
        } 

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
