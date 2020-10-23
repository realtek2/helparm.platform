<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddQunatityColumnToProductAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_answers', function (Blueprint $table) {
            $table->dropTimestamps();
            $table->integer('quantity');
        });
        Schema::table('answers', function (Blueprint $table) {
            $table->dropColumn('quantity');
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
            $table->timestamps();
            $table->dropColumn('quantity');
        });
        Schema::table('answers', function (Blueprint $table) {
            $table->integer('quantity');
        });
    }
}
