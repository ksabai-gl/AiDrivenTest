<?php

namespace App\Console\Commands;

use Core\Authencation\Application\DTOs\CreateAuthencationRequest;
use Core\Authencation\Application\UseCases\CreateAdminAuthencation;
use Illuminate\Console\Command;

class CreateAdminCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-admin {email} {password} {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(CreateAdminAuthencation $CreateAdminAuthencation)
    {
        $CreateAdminAuthencation->handle(CreateAuthencationRequest::fromArray([
            'email' => $this->argument('email'),
            'password' => $this->argument('password'),
            'name' => $this->argument('name')
        ]));
        $this->info("Create admin successfully");
        //
    }
}
