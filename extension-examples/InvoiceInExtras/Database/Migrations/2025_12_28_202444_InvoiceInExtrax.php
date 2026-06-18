<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('InvoiceInExtras', function (Blueprint $table) {
            $table->id();
            $table->string('note');
            $table->bigInteger('invoicein_id');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('InvoiceInExtras');
    }
};