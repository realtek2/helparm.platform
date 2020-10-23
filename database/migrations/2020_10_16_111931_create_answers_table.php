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
            $table->foreignId('inquiry_id')->nullable()->constrained('medicament_inquiries')->nullOnDelete()->cascadeOnUpdate();
            $table->foreignId('fund_id')->nullable()->constrained()->nullOnDelete()->cascadeOnUpdate();
            $table->text('comment');
            $table->string('delivery_period');
            $table->string('quantity');
            $table->timestamps();
        });
      
        Schema::table('product_answers', function (Blueprint $table) {
            $table->foreignId('answer_id')->constrained()->after('product_id')->cascadeOnDelete()->cascadeOnUpdate();
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
