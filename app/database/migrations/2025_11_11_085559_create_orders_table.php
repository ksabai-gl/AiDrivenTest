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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_id')->constrained('business')->onDelete('cascade');
            $table->string('order_no')->unique();
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
            $table->date('order_date')->default(now());           
            $table->date('expected_delivery_date')->nullable();         
            $table->enum('status', [
                'pending',    
                'approved',  
                'cancelled'    
            ])->default('pending');
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('approved_by')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('cascade');
            $table->text('note')->nullable();
            $table->enum('type', ['retail', 'wholesale']);
            $table->enum('payment_method', ['cash', 'bank', 'cod', 'other'])
            ->default('cash');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
