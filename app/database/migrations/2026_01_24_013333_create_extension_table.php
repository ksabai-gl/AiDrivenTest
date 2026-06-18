<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('extensions', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('version');
            $table->string('directory');
            $table->boolean('status')->default(false);
            $table->string('author')->nullable();
            $table->string('email')->nullable();
            $table->string('support_version')->nullable();
            $table->string('description')->default('');
            $table->boolean('verified')->default(false);
            $table->string('icon')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('extensions');
    }
};
