<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('inquiry_id')->unsigned();
            $table->foreign('inquiry_id')->references('id')->on('medicament_inquiries')->cascadeOnDelete()->cascadeOnUpdate();
            $table->bigInteger('fund_id')->unsigned();
            $table->foreign('fund_id')->references('id')->on('funds')->cascadeOnDelete()->cascadeOnUpdate();
            $table->text('comment');
            $table->string('delivery_period');
            $table->string('quantity');
            $table->timestamps();
        });
      
        Schema::table('product_answers', function (Blueprint $table) {
            $table->bigInteger('answer_id')->unsigned()->after('product_id');
            $table->foreign('answer_id')->references('id')->on('answers')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_answers', function (Blueprint $table) {
            $table->dropForeign(['answer_id']);
            $table->dropColumn('answer_id');
        });
        Schema::dropIfExists('answers');
    }
}
