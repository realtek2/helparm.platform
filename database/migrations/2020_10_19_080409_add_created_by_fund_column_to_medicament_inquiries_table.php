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
            $table->foreignId('created_by_fund')->nullable()->before('fund_id')->constrained('funds')->nullOnDelete()->after('fund_id');
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
