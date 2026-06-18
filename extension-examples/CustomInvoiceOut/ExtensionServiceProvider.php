<?php

namespace Extensions\CustomInvoiceOut;

use Illuminate\Support\ServiceProvider;

class ExtensionServiceProvider extends ServiceProvider
{
    public function register()
    {
        // view 
        $this->app->tag(
            \Extensions\CustomInvoiceOut\Hooks\ViewShowHook::class,
            'liteerp.hooks'
        );
        $this->app->tag(
            \Extensions\CustomInvoiceOut\Hooks\IndexShowHook::class,
            'liteerp.hooks'
        );
        $this->app->tag(
            \Extensions\CustomInvoiceOut\Hooks\SearchIndexShowHook::class,
            'liteerp.hooks'
        );
        $this->app->tag(
            \Extensions\CustomInvoiceOut\Hooks\ValidateSearchHook::class,
            'liteerp.hooks'
        );
        // validate 
        $this->app->tag(
            \Extensions\CustomInvoiceOut\Hooks\ValidateCreateHook::class,
            'liteerp.hooks'
        );
        $this->app->tag(
            \Extensions\CustomInvoiceOut\Hooks\ValidateUpdateHook::class,
            'liteerp.hooks'
        );
        // create 
        $this->app->tag(
            \Extensions\CustomInvoiceOut\Hooks\CreateHook::class,
            'liteerp.hooks'
        );
        // update 
        $this->app->tag(
            \Extensions\CustomInvoiceOut\Hooks\UpdateHook::class,
            'liteerp.hooks'
        );
        // index 
        $this->app->tag(
            \Extensions\CustomInvoiceOut\Hooks\IndexHook::class,
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