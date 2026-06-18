<?php

namespace Core\CategoryProduct\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;
use Core\CategoryProduct\Domain\Repositories\CategoryProductRepositoryInterface;
use Core\CategoryProduct\Infrastructure\Repositories\EloquentCategoryProductRepository;
use Core\CategoryProduct\Domain\Services\CategoryProductService;
use Core\CategoryProduct\Infrastructure\Services\CategoryProductServiceImpl;

class CategoryProductServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(CategoryProductRepositoryInterface::class, EloquentCategoryProductRepository::class);
        $this->app->bind(CategoryProductService::class, CategoryProductServiceImpl::class);
        $this->mergeModuleConfig();
    }

    public function boot()
    {
        $this->loadModuleRoutes();
        $this->loadModuleTranslations();
    }

    protected function mergeModuleConfig(): void
    {
        $path = __DIR__ . '/../config/' . strtolower('CategoryProduct') . '.php';
        if (file_exists($path)) {
            $this->mergeConfigFrom($path, strtolower('CategoryProduct'));
        }
    }

    protected function loadModuleTranslations(): void
    {
        $langPath = __DIR__ . '/../lang';
        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, strtolower('CategoryProduct'));
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