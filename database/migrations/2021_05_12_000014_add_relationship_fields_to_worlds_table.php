<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToWorldsTable extends Migration
{
    public function up()
    {
        Schema::table('worlds', function (Blueprint $table) {
            $table->unsignedBigInteger('game_id')->nullable();
            $table->foreign('game_id', 'game_fk_3826574')->references('id')->on('games');
        });
    }
}
