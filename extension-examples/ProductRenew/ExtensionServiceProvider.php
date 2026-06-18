<?php

namespace Extensions\ProductRenew;

use Illuminate\Support\ServiceProvider;

class ExtensionServiceProvider extends ServiceProvider
{
    public function register()
    {
        // view 
        $this->app->tag(
            \Extensions\ProductRenew\Hooks\ViewShowHook::class,
            'liteerp.hooks'
        );
        $this->app->tag(
            \Extensions\ProductRenew\Hooks\IndexShowHook::class,
            'liteerp.hooks'
        );
        $this->app->tag(
            \Extensions\ProductRenew\Hooks\SearchIndexShowHook::class,
            'liteerp.hooks'
        );
        $this->app->tag(
            \Extensions\ProductRenew\Hooks\ValidateSearchHook::class,
            'liteerp.hooks'
        );
        // validate 
        $this->app->tag(
            \Extensions\ProductRenew\Hooks\ValidateCreateHook::class,
            'liteerp.hooks'
        );
        // create 
        $this->app->tag(
            \Extensions\ProductRenew\Hooks\CreateHook::class,
            'liteerp.hooks'
        );
        // update 
        $this->app->tag(
            \Extensions\ProductRenew\Hooks\UpdateHook::class,
            'liteerp.hooks'
        );
        // index 
        $this->app->tag(
            \Extensions\ProductRenew\Hooks\IndexHook::class,
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