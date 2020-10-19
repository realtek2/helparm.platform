<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusesColumnsToAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('answers', function (Blueprint $table) {
            $table->integer('delivery_status')->default(0)->after('delivery_period');
            $table->dateTime('delivery_sent_date')->nullable()->after('quantity');
            $table->dateTime('date_of_receiving')->nullable()->after('delivery_sent_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('answers', function (Blueprint $table) {
            $table->dropColumn(['delivery_status', 'delivery_sent_date', 'date_of_receiving']);
        });
    }
}
