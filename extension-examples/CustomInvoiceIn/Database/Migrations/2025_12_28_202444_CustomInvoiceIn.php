<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('CustomInvoiceInExtra', function (Blueprint $table) {
            $table->id();
            $table->string('note');
            $table->bigInteger('custom_invoice_in');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('CustomInvoiceInExtra');
    }
};