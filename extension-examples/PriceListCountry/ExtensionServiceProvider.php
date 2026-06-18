<?php

namespace Extensions\PriceListCountry;

use Illuminate\Support\ServiceProvider;

class ExtensionServiceProvider extends ServiceProvider
{
    public function register()
    {
        // view 
        $this->app->tag(
            \Extensions\PriceListCountry\Hooks\ViewShowHook::class,
            'liteerp.hooks'
        );
        $this->app->tag(
            \Extensions\PriceListCountry\Hooks\IndexShowHook::class,
            'liteerp.hooks'
        );
        $this->app->tag(
            \Extensions\PriceListCountry\Hooks\SearchIndexHook::class,
            'liteerp.hooks'
        );
        // response 
        $this->app->tag(
            \Extensions\PriceListCountry\Hooks\IndexHook::class,
            'liteerp.hooks'
        );
        $this->app->tag(
            \Extensions\PriceListCountry\Hooks\CreateHook::class,
            'liteerp.hooks'
        );
        $this->app->tag(
            \Extensions\PriceListCountry\Hooks\UpdateHook::class,
            'liteerp.hooks'
        );
        // validate 
        $this->app->tag(
            \Extensions\PriceListCountry\Hooks\ValidateCreateHook::class,
            'liteerp.hooks'
        );
        $this->app->tag(
            \Extensions\PriceListCountry\Hooks\ValidateUpdateHook::class,
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
        $this->mergeConfigFrom(__DIR__. '/Config/config.php', 
            strtolower('PriceListCountry'));
    }
}