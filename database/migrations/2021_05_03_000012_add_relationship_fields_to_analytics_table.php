<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToAnalyticsTable extends Migration
{
    public function up()
    {
        Schema::table('analytics', function (Blueprint $table) {
            $table->unsignedBigInteger('game_id');
            $table->foreign('game_id', 'game_fk_3826849')->references('id')->on('games');
        });
    }
}
