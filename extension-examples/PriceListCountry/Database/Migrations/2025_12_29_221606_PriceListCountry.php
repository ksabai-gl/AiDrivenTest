<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('PriceListCountry', function (Blueprint $table) {
            $table->id();
            $table->string('country');
            $table->bigInteger('price_list_id');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('PriceListCountry');
    }
};