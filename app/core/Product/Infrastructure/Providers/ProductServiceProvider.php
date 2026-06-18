<?php

namespace Core\Product\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;
use Core\Product\Domain\Repositories\ProductRepositoryInterface;
use Core\Product\Infrastructure\Repositories\EloquentProductRepository;
use Core\Product\Domain\Services\ProductService;
use Core\Product\Infrastructure\Services\ProductServiceImpl;

class ProductServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(ProductRepositoryInterface::class, EloquentProductRepository::class);
        $this->app->bind(ProductService::class, ProductServiceImpl::class);
        $this->mergeModuleConfig();
    }

    public function boot()
    {
        $this->loadModuleRoutes();
        $this->loadModuleTranslations();
    }

    protected function mergeModuleConfig(): void
    {
        $path = __DIR__ . '/../config/' . strtolower('Product') . '.php';
        if (file_exists($path)) {
            $this->mergeConfigFrom($path, strtolower('Product'));
        }
    }

    protected function loadModuleTranslations(): void
    {
        $langPath = __DIR__ . '/../lang';
        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, strtolower('Product'));
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