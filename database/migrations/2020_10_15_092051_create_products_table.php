<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('fund_id')->unsigned();
            $table->foreign('fund_id')->references('id')->on('funds')->cascadeOnDelete()->cascadeOnUpdate();
            $table->bigInteger('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('medicament_categories')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('name');
            $table->integer('quantity');
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
        Schema::dropIfExists('products');
    }
}
