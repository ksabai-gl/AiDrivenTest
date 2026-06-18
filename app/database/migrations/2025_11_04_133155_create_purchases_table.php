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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_id')->constrained('business')->onDelete('cascade');
            $table->foreignId('supplier_id')->constrained('suppliers')->onDelete('cascade');
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('approved_by')->nullable()->constrained('users')->onDelete('cascade');
            $table->date('purchase_date')->nullable();
            $table->date('expected_date')->nullable();
            $table->text('note')->nullable();
            $table->enum('status', [
                'draft',       
                'requested',   
                'approved',  
                'cancelled'    
            ])->default('draft');
            $table->decimal('shipping_fee', 15, 2)->default(0);
            $table->enum('payment_method', ['cash', 'bank', 'cod', 'other'])
            ->default('cash');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
