<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnalyticsTable extends Migration
{
    public function up()
    {
        Schema::create('analytics', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('remote_id');
            $table->string('name')->nullable();
            $table->string('game_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
