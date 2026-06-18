<?php

namespace Extensions\InvoiceInPDF;

use Illuminate\Support\ServiceProvider;

class ExtensionServiceProvider extends ServiceProvider
{
    public function register()
    {
        // view 
        $this->app->tag(
            \Extensions\InvoiceInPDF\Hooks\IndexShowHook::class,
            'liteerp.hooks'
        );
        // index 
        $this->app->tag(
            \Extensions\InvoiceInPDF\Hooks\IndexHook::class,
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
        $this->loadViewsFrom(__DIR__ . '/Views','InvoiceInPDF');
        $this->loadTranslationsFrom(__DIR__.'/lang','invoiceinpdf');
    }
}