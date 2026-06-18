<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class MakeListenerModule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:make-listener {module} {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $name = Str::studly(trim($this->argument('name')));
        $module = Str::studly(trim($this->argument('module')));
        $basePath = base_path("core/{$module}");
        if (!File::exists($basePath)) {
            $this->error("❌ Module '{$module}' not found!");
            return Command::FAILURE;
        }
        if (!File::isDirectory("{$basePath}/Infrastructure/Listeners")) {
            File::makeDirectory("{$basePath}/Infrastructure/Listeners", 0777, true);
        }
        if (File::exists("{$basePath}/Infrastructure/Listeners/" . $name . "Event.php")) {
            $this->error("❌ File '{$name}' is exists!");
        }

        File::put("{$basePath}/Infrastructure/Listeners/" . $name . "Listener.php", <<<PHP
        <?php

            namespace Core\\{$module}\\Infrastructure\Listeners;

            class {$name}Listener
            {
                public function __construct()
                {
                    //
                }

                public function handle(): array
                {
                    return [];
                }
            }

        PHP);
    }
}
