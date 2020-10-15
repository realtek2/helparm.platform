<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_answers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('inquiry_id')->unsigned();
            $table->foreign('inquiry_id')->references('id')->on('medicament_inquiries')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('name');
            $table->integer('qunatity');
            $table->text('comment');
            $table->string('delivery_period');
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
        Schema::dropIfExists('product_answers');
    }
}
