<?php

namespace Extensions\TrackingNumberOrderShipping;

use Illuminate\Support\ServiceProvider;

class ExtensionServiceProvider extends ServiceProvider
{
    public function register()
    {
        // view 
        $this->app->tag(
            \Extensions\TrackingNumberOrderShipping\Hooks\ViewShowHook::class,
            'liteerp.hooks'
        );
        $this->app->tag(
            \Extensions\TrackingNumberOrderShipping\Hooks\IndexShowHook::class,
            'liteerp.hooks'
        );
        $this->app->tag(
            \Extensions\TrackingNumberOrderShipping\Hooks\SearchIndexShowHook::class,
            'liteerp.hooks'
        );
        $this->app->tag(
            \Extensions\TrackingNumberOrderShipping\Hooks\ValidateSearchHook::class,
            'liteerp.hooks'
        );
        // validate 
        $this->app->tag(
            \Extensions\TrackingNumberOrderShipping\Hooks\ValidateCreateHook::class,
            'liteerp.hooks'
        );
        $this->app->tag(
            \Extensions\TrackingNumberOrderShipping\Hooks\ValidateUpdateHook::class,
            'liteerp.hooks'
        );
        // create 
        // $this->app->tag(
        //     \Extensions\TrackingNumberOrderShipping\Hooks\CreateHook::class,
        //     'liteerp.hooks'
        // );
        // update 
        $this->app->tag(
            \Extensions\TrackingNumberOrderShipping\Hooks\UpdateHook::class,
            'liteerp.hooks'
        );
        // index 
        $this->app->tag(
            \Extensions\TrackingNumberOrderShipping\Hooks\IndexHook::class,
            'liteerp.hooks'
        );
        // show 
        $this->app->tag(
            \Extensions\TrackingNumberOrderShipping\Hooks\ShowHook::class,
            'liteerp.hooks'
        );
        $this->app->tag(
            \Extensions\TrackingNumberOrderShipping\Hooks\StockOutShipping::class,
            'liteerp.hooks'
        );
    }

    public function boot()
    {
        if(env('APP_ENV') !== 'production') {
            /**
             * Only support development 
             */
            $this->loadMigrationsFrom(__DIR__.'/Database/Migrations');
        }
        $this->loadRoutesFrom(__DIR__.'/Routes/web.php');
    }
}