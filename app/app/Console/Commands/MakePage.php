<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakePage extends Command
{
    protected $signature = 'make:page {name}';
    protected $description = 'Create new page with ReactJS';

    public function handle()
    {
        $name = ucfirst($this->argument('name'));
        $reactPath = resource_path("js/react/pages/{$name}.jsx");
        if (!File::exists(dirname($reactPath))) {
            File::makeDirectory(dirname($reactPath), 0755, true);
        }

        $reactContent = <<<JSX
        import React from 'react'
        import DashboardLayout from '../layouts/DashboardLayout'
        export default function {$name}(){
            return <DashboardLayout>
                <div>
                    <h1>Hello {$name}</h1>
                </div>
            </DashboardLayout>
        }
        JSX;

        File::put($reactPath, $reactContent);
        $this->info("✅ Created React component: {$reactPath}");

        $this->info("🎉 Page '{$name}' created successfully!");
    }
}
