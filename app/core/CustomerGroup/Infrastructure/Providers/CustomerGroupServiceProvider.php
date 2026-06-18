<?php

namespace Core\CustomerGroup\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;
use Core\CustomerGroup\Domain\Repositories\CustomerGroupRepositoryInterface;
use Core\CustomerGroup\Infrastructure\Repositories\EloquentCustomerGroupRepository;
use Core\CustomerGroup\Domain\Services\CustomerGroupService;
use Core\CustomerGroup\Infrastructure\Services\CustomerGroupServiceImpl;

class CustomerGroupServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(CustomerGroupRepositoryInterface::class, EloquentCustomerGroupRepository::class);
        $this->app->bind(CustomerGroupService::class, CustomerGroupServiceImpl::class);
        $this->mergeModuleConfig();
    }

    public function boot()
    {
        $this->loadModuleRoutes();
        $this->loadModuleTranslations();
    }

    protected function mergeModuleConfig(): void
    {
        $path = __DIR__ . '/../config/' . strtolower('CustomerGroup') . '.php';
        if (file_exists($path)) {
            $this->mergeConfigFrom($path, strtolower('CustomerGroup'));
        }
    }

    protected function loadModuleTranslations(): void
    {
        $langPath = __DIR__ . '/../lang';
        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, strtolower('CustomerGroup'));
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