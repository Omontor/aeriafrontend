<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLevelImpressionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('level_impressions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('game_id')->default('1');
            $table->string('cohort_id');
            $table->string('user_id')->nullable();
            $table->string('last_activity'); 
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
        Schema::dropIfExists('level_impressions');
    }
}
