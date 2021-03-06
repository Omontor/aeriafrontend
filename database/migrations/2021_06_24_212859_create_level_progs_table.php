<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLevelProgsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('level_progs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('game_id')->default('1');
            $table->string('level_dif');
            $table->string('cohort_id');
            $table->string('interface_id');
            $table->string('date');
            $table->string('users');
            $table->string('stars');
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
        Schema::dropIfExists('level_progs');
    }
}
