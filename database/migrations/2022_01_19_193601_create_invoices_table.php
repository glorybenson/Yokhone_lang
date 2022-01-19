<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('clients')->cascadeOnDelete();
            $table->foreignId('farm_id')->constrained('farms')->cascadeOnDelete();
            $table->date('date');
            $table->longText('desc');
            $table->integer('quantity');            
            $table->integer('unit_price');            
            $table->integer('total_price_before_discount');            
            $table->integer('discount');            
            $table->integer('total_price_after_discount');            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
