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
        Schema::create('invoice_ins', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_id')->constrained('business')->onDelete('cascade');
            $table->string('document_no')->nullable();
            $table->string('image')->nullable();
            $table->foreignId('purchase_id')->constrained('purchases')->onDelete('cascade');
            $table->foreignId('approved_by')->nullable()->constrained('users')->onDelete('cascade');
            $table->decimal('subtotal',15,2)->default(0);
            $table->decimal('tax',15,2)->default(0);
            $table->decimal('discount',15,2)->default(0);
            $table->decimal('total',15,2)->default(0);
            $table->date('invoice_date')->nullable(); 
            $table->date('due_date')->nullable(); 
            $table->boolean('approved')->default(false);
            $table->enum('payment_status',['paid','partial_payment',
                'pending'])->default('pending');
            $table->decimal('amount_paid',15,0)->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_ins');
    }
};
