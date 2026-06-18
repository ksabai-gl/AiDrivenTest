<?php

namespace Extensions\CategoryProductThumbnail;

use Illuminate\Support\ServiceProvider;

class ExtensionServiceProvider extends ServiceProvider
{
    public function register()
    {
        // view 
        $this->app->tag(
            \Extensions\CategoryProductThumbnail\Hooks\ViewShowHook::class,
            'liteerp.hooks'
        );
        $this->app->tag(
            \Extensions\CategoryProductThumbnail\Hooks\IndexShowHook::class,
            'liteerp.hooks'
        );
        $this->app->tag(
            \Extensions\CategoryProductThumbnail\Hooks\SearchIndexHook::class,
            'liteerp.hooks'
        );
        // response 
        $this->app->tag(
            \Extensions\CategoryProductThumbnail\Hooks\IndexHook::class,
            'liteerp.hooks'
        );
        $this->app->tag(
            \Extensions\CategoryProductThumbnail\Hooks\CreateHook::class,
            'liteerp.hooks'
        );
        $this->app->tag(
            \Extensions\CategoryProductThumbnail\Hooks\UpdateHook::class,
            'liteerp.hooks'
        );
        // validate 
        $this->app->tag(
            \Extensions\CategoryProductThumbnail\Hooks\ValidateCreateHook::class,
            'liteerp.hooks'
        );
        $this->app->tag(
            \Extensions\CategoryProductThumbnail\Hooks\ValidateUpdateHook::class,
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