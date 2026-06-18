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
        Schema::create('custom_invoice_outs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('created_by'); 
            $table->unsignedBigInteger('business_id'); 
            $table->string('document_no')->nullable()->unique();
            $table->string('description');        
            $table->decimal('amount', 15, 2);     
            $table->date('invoice_date');      
            $table->boolean('approved')->default(false);  
            $table->enum('payment_status',['paid','partial_payment','pending'])->default('pending');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('business_id')->references('id')->on('business')->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custom_invoice_outs');
    }
};
