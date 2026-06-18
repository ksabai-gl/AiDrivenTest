<?php

namespace Core\Shipping\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;
use Core\Shipping\Domain\Repositories\ShippingRepositoryInterface;
use Core\Shipping\Infrastructure\Repositories\EloquentShippingRepository;
use Core\Shipping\Domain\Services\ShippingService;
use Core\Shipping\Infrastructure\Services\ShippingServiceImpl;

class ShippingServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(ShippingRepositoryInterface::class, EloquentShippingRepository::class);
        $this->app->bind(ShippingService::class, ShippingServiceImpl::class);
        $this->mergeModuleConfig();
    }

    public function boot()
    {
        $this->loadModuleRoutes();
        $this->loadModuleTranslations();
    }

    protected function mergeModuleConfig(): void
    {
        $path = __DIR__ . '/../config/' . strtolower('Shippings') . '.php';
        if (file_exists($path)) {
            $this->mergeConfigFrom($path, strtolower('Shippings'));
        }
    }

    protected function loadModuleTranslations(): void
    {
        $langPath = __DIR__ . '/../lang';
        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, strtolower('Shippings'));
        }
    }

    protected function loadModuleRoutes(): void
    {
        $routePath = __DIR__ . '/../routes';
        if (file_exists("$routePath/api.php")) {
            $this->loadRoutesFrom("$routePath/api.php");
        }
        if (file_exists("$routePath/web.php")) {
            $this->loadRoutesFrom("$routePath/web.php");
        }
    }
}