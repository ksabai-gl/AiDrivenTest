<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MakeModule extends Command
{
    protected $signature = 'app:make-module {name : The name of the module (e.g. Users)}';
    protected $description = 'Generate a full Clean Architecture module with Create feature, config, lang, and routes.';

    public function handle()
    {
        $name = Str::studly(trim($this->argument('name')));
        $entityName = Str::singular($name);
        $basePath = base_path("core/{$name}");

        if (File::exists($basePath)) {
            $this->error("❌ Module '{$name}' already exists!");
            return Command::FAILURE;
        }

        // Create directory structure
        $dirs = [
            "Application/DTOs",
            "Application/UseCases",
            "Domain/Entities",
            "Domain/Repositories",
            "Domain/Services",
            "Infrastructure/Providers",
            "Infrastructure/Repositories",
            "Infrastructure/Services",
            "Infrastructure/config",
            "Infrastructure/lang/en",
            "Infrastructure/lang/vi",
            "Infrastructure/routes",
            "Infrastructure/Events",
            "Infrastructure/Listeners",
            "Infrastructure/Boardcasts",
            "Http/Controllers",
            "Http/Requests",
            "Http/Resources",
        ];

        foreach ($dirs as $dir) {
            File::makeDirectory("{$basePath}/{$dir}", 0777, true);
        }

        /* ------------------------------
         * Infrastructure: Config / Lang / Routes
         * ------------------------------ */
        File::put("{$basePath}/Infrastructure/config/" . Str::lower($name) . ".php", <<<PHP
        <?php

        return [
            'enabled' => true,
            'default_role' => 'user',
        ];
        PHP);

        File::put("{$basePath}/Infrastructure/lang/en/messages.php", <<<PHP
        <?php

        return [
            'created' => '{$entityName} created successfully!',
            'deleted' => '{$entityName} deleted successfully!',
        ];
        PHP);

        File::put("{$basePath}/Infrastructure/lang/vi/messages.php", <<<PHP
        <?php

        return [
            'created' => 'Create {$entityName} successfully!',
            'deleted' => 'Delete {$entityName} successfully!',
        ];
        PHP);

        File::put("{$basePath}/Infrastructure/routes/api.php", <<<PHP
        <?php

        use Illuminate\Support\Facades\Route;
        use Core\\{$name}\\Http\\Controllers\\Create{$entityName}Controller;

        Route::prefix(strtolower('{$entityName}s'))->group(function () {
            Route::post('/', Create{$entityName}Controller::class)->name('{$entityName}.create');
        });
        PHP);

        File::put("{$basePath}/Infrastructure/routes/web.php", "<?php\n\n// Web routes for {$entityName}\n");

        /* ------------------------------
         * Domain
         * ------------------------------ */
        File::put("{$basePath}/Domain/Entities/{$entityName}.php", <<<PHP
        <?php

        namespace Core\\{$name}\\Domain\\Entities;

        class {$entityName}
        {
            public function __construct(
                public string \$name,
                public ?string \$description = null
            ) {}
        }
        PHP);

        File::put("{$basePath}/Domain/Repositories/{$entityName}RepositoryInterface.php", <<<PHP
        <?php

        namespace Core\\{$name}\\Domain\\Repositories;

        use Core\\{$name}\\Domain\\Entities\\{$entityName};

        interface {$entityName}RepositoryInterface
        {
            public function create({$entityName} \$entity): {$entityName};
        }
        PHP);

        File::put("{$basePath}/Domain/Services/{$entityName}Service.php", <<<PHP
        <?php

        namespace Core\\{$name}\\Domain\\Services;

        use Core\\{$name}\\Domain\\Entities\\{$entityName};

        interface {$entityName}Service
        {
            public function create(array \$data): {$entityName};
        }
        PHP);

        /* ------------------------------
         * Infrastructure Implementations
         * ------------------------------ */
        File::put("{$basePath}/Infrastructure/Repositories/Eloquent{$entityName}Repository.php", <<<PHP
        <?php

        namespace Core\\{$name}\\Infrastructure\\Repositories;

        use Core\\{$name}\\Domain\\Repositories\\{$entityName}RepositoryInterface;
        use Core\\{$name}\\Domain\\Entities\\{$entityName};

        class Eloquent{$entityName}Repository implements {$entityName}RepositoryInterface
        {
            public function create({$entityName} \$entity): {$entityName}
            {
                // TODO: Add actual database logic
                return \$entity;
            }
        }
        PHP);

        File::put("{$basePath}/Infrastructure/Services/{$entityName}ServiceImpl.php", <<<PHP
        <?php

        namespace Core\\{$name}\\Infrastructure\\Services;

        use Core\\{$name}\\Domain\\Services\\{$entityName}Service;
        use Core\\{$name}\\Domain\\Repositories\\{$entityName}RepositoryInterface;
        use Core\\{$name}\\Domain\\Entities\\{$entityName};

        class {$entityName}ServiceImpl implements {$entityName}Service
        {
            public function __construct(private {$entityName}RepositoryInterface \$repo) {}

            public function create(array \$data): {$entityName}
            {
                \$entity = new {$entityName}(
                    name: \$data['name'],
                    description: \$data['description'] ?? null
                );

                return \$this->repo->create(\$entity);
            }
        }
        PHP);

        File::put("{$basePath}/Infrastructure/Providers/{$name}ServiceProvider.php", <<<PHP
        <?php

        namespace Core\\{$name}\\Infrastructure\\Providers;

        use Illuminate\Support\ServiceProvider;
        use Core\\{$name}\\Domain\\Repositories\\{$entityName}RepositoryInterface;
        use Core\\{$name}\\Infrastructure\\Repositories\\Eloquent{$entityName}Repository;
        use Core\\{$name}\\Domain\\Services\\{$entityName}Service;
        use Core\\{$name}\\Infrastructure\\Services\\{$entityName}ServiceImpl;

        class {$name}ServiceProvider extends ServiceProvider
        {
            public function register()
            {
                \$this->app->bind({$entityName}RepositoryInterface::class, Eloquent{$entityName}Repository::class);
                \$this->app->bind({$entityName}Service::class, {$entityName}ServiceImpl::class);
                \$this->mergeModuleConfig();
            }

            public function boot()
            {
                \$this->loadModuleRoutes();
                \$this->loadModuleTranslations();
            }

            protected function mergeModuleConfig(): void
            {
                \$path = __DIR__ . '/../config/' . strtolower('{$name}') . '.php';
                if (file_exists(\$path)) {
                    \$this->mergeConfigFrom(\$path, strtolower('{$name}'));
                }
            }

            protected function loadModuleTranslations(): void
            {
                \$langPath = __DIR__ . '/../lang';
                if (is_dir(\$langPath)) {
                    \$this->loadTranslationsFrom(\$langPath, strtolower('{$name}'));
                }
            }

            protected function loadModuleRoutes(): void
            {
                \$routePath = __DIR__ . '/../routes';
                if (file_exists("\$routePath/api.php")) {
                    \$this->loadRoutesFrom("\$routePath/api.php");
                }
                if (file_exists("\$routePath/web.php")) {
                    \$this->loadRoutesFrom("\$routePath/web.php");
                }
            }
            protected function loadModuleCommands(): void
            {

                if (is_dir(base_path('core'))) {
                    \$commandFiles = glob(base_path('core') . '/*/Console/*.php');

                    if (!empty(\$commandFiles)) {
                        foreach (\$commandFiles as \$file) {
                            require_once \$file;
                        }

                        \$commandClasses = array_map(function (\$file) {
                            \$class = basename(\$file, '.php');
                            \$parts = explode(DIRECTORY_SEPARATOR, \$file);
                            \$moduleIndex = array_search('core', \$parts);
                            \$module = isset(\$parts[\$moduleIndex + 1]) ? \$parts[\$moduleIndex + 1] : null;
                            return \$module ? "Core\\{\$module}\\Console\\{\$class}" : null;
                        }, \$commandFiles);

                        \$commandClasses = array_values(array_filter(\$commandClasses));

                        if (!empty(\$commandClasses)) {
                            \$this->commands(\$commandClasses);
                        }
                    }
                }
            }
        }
        PHP);

        /* ------------------------------
         * Application Layer
         * ------------------------------ */
        File::put("{$basePath}/Application/DTOs/Create{$entityName}Request.php", <<<PHP
        <?php

        namespace Core\\{$name}\\Application\\DTOs;

        class Create{$entityName}Request
        {
            public function __construct(
                public string \$name,
                public ?string \$description = null
            ) {}

            public static function fromArray(array \$data): self
            {
                return new self(
                    name: \$data['name'],
                    description: \$data['description'] ?? null
                );
            }
        }
        PHP);

        File::put("{$basePath}/Application/UseCases/Create{$entityName}.php", <<<PHP
        <?php

        namespace Core\\{$name}\\Application\\UseCases;

        use Core\\{$name}\\Application\\DTOs\\Create{$entityName}Request;
        use Core\\{$name}\\Domain\\Services\\{$entityName}Service;

        class Create{$entityName}
        {
            public function __construct(private {$entityName}Service \$service) {}

            public function handle(Create{$entityName}Request \$dto)
            {
                return \$this->service->create([
                    'name' => \$dto->name,
                    'description' => \$dto->description,
                ]);
            }
        }
        PHP);

        /* ------------------------------
         * HTTP Layer
         * ------------------------------ */
        File::put("{$basePath}/Http/Controllers/Create{$entityName}Controller.php", <<<PHP
        <?php

        namespace Core\\{$name}\\Http\\Controllers;

        use Core\\{$name}\\Application\\UseCases\\Create{$entityName};
        use Core\\{$name}\\Application\\DTOs\\Create{$entityName}Request;
        use Core\\{$name}\\Http\\Requests\\Create{$entityName}Request as FormRequest;

        class Create{$entityName}Controller
        {
            public function __invoke(FormRequest \$request, Create{$entityName} \$useCase)
            {
                \$dto = Create{$entityName}Request::fromArray(\$request->validated());
                \$entity = \$useCase->handle(\$dto);
                return response()->json(['created' => \$entity]);
            }
        }
        PHP);

        File::put("{$basePath}/Http/Requests/Create{$entityName}Request.php", <<<PHP
        <?php

        namespace Core\\{$name}\\Http\\Requests;

        use Illuminate\Foundation\Http\FormRequest;

        class Create{$entityName}Request extends FormRequest
        {
            public function rules(): array
            {
                return [
                    'name' => 'required|string|max:255',
                    'description' => 'nullable|string|max:500',
                ];
            }

            public function authorize(): bool
            {
                return true;
            }
        }
        PHP);

        $this->info("✅ Module '{$name}' created successfully with full Clean Architecture structure!");
        return Command::SUCCESS;
    }
}
