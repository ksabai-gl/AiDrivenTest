<?php

namespace Core\User\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;
use Core\User\Domain\Repositories\UserRepositoryInterface;
use Core\User\Domain\Services\AuthenToken;
use Core\User\Infrastructure\Repositories\EloquentUserRepository;
use Core\User\Domain\Services\UserService;
use Core\User\Infrastructure\Services\AuthenTokenImpl;
use Core\User\Infrastructure\Services\UserServiceImpl;

class UserServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(UserRepositoryInterface::class, EloquentUserRepository::class);
        $this->app->bind(UserService::class, UserServiceImpl::class);
        $this->mergeModuleConfig();
    }

    public function boot()
    {
        $this->loadModuleRoutes();
        $this->loadModuleTranslations();
    }

    protected function mergeModuleConfig(): void
    {
        $path = __DIR__ . '/../config/' . strtolower('User') . '.php';
        if (file_exists($path)) {
            $this->mergeConfigFrom($path, strtolower('User'));
        }
    }

    protected function loadModuleTranslations(): void
    {
        $langPath = __DIR__ . '/../lang';
        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, strtolower('User'));
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