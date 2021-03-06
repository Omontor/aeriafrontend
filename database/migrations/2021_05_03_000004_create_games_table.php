<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamesTable extends Migration
{
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('appid');
            $table->string('secret')->nullable();
            $table->string('remote_id');
            $table->text('api_key')->nullable();
            $table->text('onesignal_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
