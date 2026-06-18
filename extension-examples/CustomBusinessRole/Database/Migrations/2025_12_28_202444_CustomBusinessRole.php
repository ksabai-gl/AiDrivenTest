<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('CustomBusinessRole', function (Blueprint $table) {
            $table->id();
            $table->string('role');
            $table->bigInteger('business_role_id');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('CustomBusinessRole');
    }
};