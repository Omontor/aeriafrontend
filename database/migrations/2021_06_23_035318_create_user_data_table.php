<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_data', function (Blueprint $table) {
            $table->id();
            $table->string('remote_id');
            $table->string('cohort_id');
            $table->string('platform');  
            $table->string('last_activity');
            $table->string('days_playing');            
            $table->string('iap');  
            $table->string('watched_ads');
            $table->string('showed_ads');            
            $table->string('star_group');  
            $table->string('sessions_played');
            $table->string('days_played');
            $table->string('first_time');
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
        Schema::dropIfExists('user_data');
    }
}