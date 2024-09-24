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
        Schema::create('invoiceitems', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('item_name');
            $table->string('description')->nullable();
            $table->integer('quantity');
            $table->decimal('price', 10, 2);
            $table->decimal('totalprice', 10, 2);
            $table->unsignedBigInteger('invoice_id');

            $table->foreign('invoice_id')
                ->references('id')->on('invoices')
                ->onDelete('cascade');


            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoiceitems');
    }
};
