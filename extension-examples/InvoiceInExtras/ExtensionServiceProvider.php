<?php

namespace Extensions\InvoiceInExtras;

use Illuminate\Support\ServiceProvider;

class ExtensionServiceProvider extends ServiceProvider
{
    public function register()
    {
        // view 
        $this->app->tag(
            \Extensions\InvoiceInExtras\Hooks\ViewShowHook::class,
            'liteerp.hooks'
        );
        $this->app->tag(
            \Extensions\InvoiceInExtras\Hooks\IndexShowHook::class,
            'liteerp.hooks'
        );
        $this->app->tag(
            \Extensions\InvoiceInExtras\Hooks\SearchIndexShowHook::class,
            'liteerp.hooks'
        );
        $this->app->tag(
            \Extensions\InvoiceInExtras\Hooks\ValidateSearchHook::class,
            'liteerp.hooks'
        );
        // validate 
        $this->app->tag(
            \Extensions\InvoiceInExtras\Hooks\ValidateCreateHook::class,
            'liteerp.hooks'
        );
        $this->app->tag(
            \Extensions\InvoiceInExtras\Hooks\ValidateUpdateHook::class,
            'liteerp.hooks'
        );
        // create 
        $this->app->tag(
            \Extensions\InvoiceInExtras\Hooks\CreateHook::class,
            'liteerp.hooks'
        );
        // update 
        $this->app->tag(
            \Extensions\InvoiceInExtras\Hooks\UpdateHook::class,
            'liteerp.hooks'
        );
        // show 
        $this->app->tag(
            \Extensions\InvoiceInExtras\Hooks\ShowHook::class,
            'liteerp.hooks'
        );
        // index 
        $this->app->tag(
            \Extensions\InvoiceInExtras\Hooks\IndexHook::class,
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