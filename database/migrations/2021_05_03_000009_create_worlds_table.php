<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorldsTable extends Migration
{
    public function up()
    {
        Schema::create('worlds', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('game_id');
            $table->string('name');
            $table->string('remote_id');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
