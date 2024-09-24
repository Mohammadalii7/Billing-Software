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
            $table->string('phone');
            $table->string('invoice_no');
            $table->decimal('subtotal',10,2);
            $table->boolean('status')->default(true); 
            $table->decimal('discount',5,2)->nullable(); 
            $table->decimal('discount_amount',10,2)->nullable(); 
            $table->decimal('grand_total', 10,2)->nullable();
            $table->date('invoice_date');
            $table->date('due_date')->nullable();
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
