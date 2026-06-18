<?php

namespace Extensions\SupplierFax;

use Illuminate\Support\ServiceProvider;

class ExtensionServiceProvider extends ServiceProvider
{
    public function register()
    {
        // view 
        $this->app->tag(
            \Extensions\SupplierFax\Hooks\ViewShowHook::class,
            'liteerp.hooks'
        );
        $this->app->tag(
            \Extensions\SupplierFax\Hooks\IndexHook::class,
            'liteerp.hooks'
        );
        $this->app->tag(
            \Extensions\SupplierFax\Hooks\SearchIndexHook::class,
            'liteerp.hooks'
        );
        $this->app->tag(
            \Extensions\SupplierFax\Hooks\IndexShowHook::class,
            'liteerp.hooks'
        );
        // response  
        $this->app->tag(
            \Extensions\SupplierFax\Hooks\CreateHook::class,
            'liteerp.hooks'
        );
        $this->app->tag(
            \Extensions\SupplierFax\Hooks\UpdateHook::class,
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