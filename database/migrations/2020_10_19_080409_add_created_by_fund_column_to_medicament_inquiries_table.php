<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCreatedByFundColumnToMedicamentInquiriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('medicament_inquiries', function (Blueprint $table) {
            $table->bigInteger('created_by_fund')->unsigned()->before('fund_id');
            $table->foreign('created_by_fund')->references('id')->on('funds')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('medicament_inquiries', function (Blueprint $table) {
            $table->dropForeign(['created_by_fund']);
            $table->dropColumn('created_by_fund');
        });
    }
}
