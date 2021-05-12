<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToLevelsTable extends Migration
{
    public function up()
    {
        Schema::table('levels', function (Blueprint $table) {
            $table->unsignedBigInteger('world_id')->nullable();
            $table->foreign('world_id', 'world_fk_3826580')->references('id')->on('worlds');
        });
    }
}
