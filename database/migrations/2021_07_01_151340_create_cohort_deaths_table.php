<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCohortDeathsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cohort_deaths', function (Blueprint $table) {
            $table->id();
            $table->string('cohort_id');
            $table->string('game_id');
            $table->string('level_id')->nullable();
            $table->bigInteger('value');
            $table->bigInteger('entry');
            $table->string('date');
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
        Schema::dropIfExists('cohort_deaths');
    }
}
