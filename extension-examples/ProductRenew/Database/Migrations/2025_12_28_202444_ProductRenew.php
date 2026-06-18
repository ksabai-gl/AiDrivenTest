<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ProductRenew', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_renew')->default(false);
            $table->bigInteger('product_id');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ProductRenew');
    }
};