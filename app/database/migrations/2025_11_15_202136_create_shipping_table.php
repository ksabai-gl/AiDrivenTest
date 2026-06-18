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
        Schema::create('shippings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->unique()->constrained('orders')->onDelete('cascade');
            $table->string('receiver_name')->nullable();
            $table->string('receiver_phone')->nullable();
            $table->string('receiver_address')->nullable();
            $table->text('receiver_note')->nullable();
            $table->foreignId('preferred_unit')->nullable()->constrained('shipping_providers')->onDelete('cascade');
            $table->integer('shipping_fee_estimated')->default(0);
            $table->string('shipping_unit')->nullable();        
            $table->string('shipping_code')->nullable();        
            $table->integer('shipping_fee_actual')->default(0);  
            $table->enum('status', [
                'pending',    
                'packing',     
                'shipping',    
                'delivered',   
                'failed',      
                'cancelled'    
            ])->default('pending');

            $table->dateTime('shipped_at')->nullable();
            $table->dateTime('delivered_at')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipping');
    }
};
