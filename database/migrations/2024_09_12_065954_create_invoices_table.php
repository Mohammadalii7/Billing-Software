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
        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('customer');
            $table->string('invoice_no');
            $table->decimal('subtotal',10,2);
            $table->boolean('status')->default(true); 
            $table->decimal('discount',5,2); 
            $table->decimal('discount_amount',10,2); 
            $table->decimal('paid_amount', 10,2);
            $table->date('invoice_date');
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
