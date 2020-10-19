<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnsInProductAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_answers', function (Blueprint $table) {
            $table->dropColumn('delivery_period');
            $table->dropColumn('comment');
            $table->dropColumn('qunatity');
            $table->dropColumn('name');
            $table->dropForeign(['inquiry_id']);
            $table->dropColumn('inquiry_id');
            $table->foreignId('product_id')->after('id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
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
            $table->string('name');
            $table->integer('qunatity');
            $table->text('comment')->nullable();
            $table->string('delivery_period');
            $table->dropForeign(['product_id']);
            $table->dropColumn('product_id');
            $table->foreignId('inquiry_id')->constrained('medicament_inquiries')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }
}
