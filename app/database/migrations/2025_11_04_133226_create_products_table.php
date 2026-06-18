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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_id')->constrained('business')->onDelete('cascade');
            $table->foreignId('category_id')->constrained('category_product')->onDelete('cascade');
            $table->string('sku', 100);
            $table->string('name');

            $table->enum('unit',['pcs','set','box','carton','bag','pack','roll'])->default('pcs');

            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    } 

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
