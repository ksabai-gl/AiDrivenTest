<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Illuminate\Filesystem\Filesystem;

class MakeMigrationExtension extends Command
{
    protected $signature = 'extension:make-migration 
                            {extension : Extension name}
                            {name : Migration name}';

    protected $description = 'Create a migration file inside an extension Database folder';

    public function handle(Filesystem $files)
    {
        $extension = $this->argument('extension');
        $name = $this->argument('name');

        $basePath = base_path("extensions/{$extension}/Database/Migrations");

        if (! is_dir($basePath)) {
            $this->error("Extension [{$extension}] does not exist or has no Database/Migrations directory.");
            return Command::FAILURE;
        }

        $timestamp = date('Y_m_d_His');
        $className = Str::studly($name);
        $fileName = "{$timestamp}_{$name}.php";
        $filePath = "{$basePath}/{$fileName}";

        if ($files->exists($filePath)) {
            $this->error('Migration already exists!');
            return Command::FAILURE;
        }

        $stub = $this->getStub();

        $content = str_replace(
            ['{{table}}'],
            [$className],
            $stub
        );

        $files->put($filePath, $content);

        $this->info("Migration created: {$filePath}");

        return Command::SUCCESS;
    }

    protected function getStub(): string
    {
        return <<<'PHP'
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('{{table}}', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('{{table}}');
    }
};
PHP;
    }
}
