<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Process;
class NPMBuild extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:npmbuild';

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
        $result = Process::run('npm run build');
        echo $result->output();
        if($result->successful()) {
            echo $this->info(__('Sytem has been building successfully'));
        } else {
            echo $this->error(__('Sytem has been building failed'));
            echo $result->errorOutput();
        }
    }
}
