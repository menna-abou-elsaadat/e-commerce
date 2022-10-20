<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_products', function (Blueprint $table) {
            $table->id();
            $table->integer('store_id')->nullable();
            $table->integer('product_id')->nullable();
            $table->integer('product_price')->nullable();
            $table->integer('product_quantity')->nullable();
            $table->string('vat_calculation_method')->nullable(); //added, percentage, value
            $table->float('vat_calculation_value')->nullable();
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
        Schema::dropIfExists('store_products');
    }
};
