<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('CustomInvoiceOut', function (Blueprint $table) {
            $table->id();
            $table->string('note');
            $table->bigInteger('custom_invoice_out');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('CustomInvoiceOut');
    }
};