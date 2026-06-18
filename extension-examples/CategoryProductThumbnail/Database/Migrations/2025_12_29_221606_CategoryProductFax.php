<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('CategoryProductThumbnail', function (Blueprint $table) {
            $table->id();
            $table->string('thumbnail');
            $table->bigInteger('category_product_id');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('CategoryProductThumbnail');
    }
};