<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNomenclaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nomenclatures', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->unsignedBigInteger('name_id');
            $table->foreign('name_id')->references('id')->on('nomenclatures')->after('category_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nomenclatures');
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign('name_id');
            $table->string('name');
        });
    }
}
