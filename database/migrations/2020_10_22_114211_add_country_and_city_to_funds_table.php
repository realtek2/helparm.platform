<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCountryAndCityToFundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('funds', function (Blueprint $table) {
            $table->renameColumn('address', 'country');
            $table->string('city')->after('address');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('funds', function (Blueprint $table) {
            $table->renameColumn('country', 'address');
            $table->dropColumn('city');
        });
    }
}
