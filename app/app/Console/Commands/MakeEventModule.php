<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class MakeEventModule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:make-event {module} {name}';

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
        $entityName = Str::singular($name);
        $basePath = base_path("core/{$module}");
        if (!File::exists($basePath)) {
            $this->error("❌ Module '{$module}' not found!");
            return Command::FAILURE;
        }
        if (!File::isDirectory("{$basePath}/Infrastructure/Events")) {
            File::makeDirectory("{$basePath}/Infrastructure/Events", 0777, true);
        }
        if (File::exists("{$basePath}/Infrastructure/Events/" . $name . "Event.php")) {
            $this->error("❌ File '{$name}' is exists!");
        }

        File::put("{$basePath}/Infrastructure/Events/" . $name . "Event.php", <<<PHP
        <?php

            namespace Core\\{$name}\\Infrastructure\Events;

            class {$name}Event
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
