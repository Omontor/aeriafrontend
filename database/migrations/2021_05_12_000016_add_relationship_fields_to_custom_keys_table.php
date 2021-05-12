<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCustomKeysTable extends Migration
{
    public function up()
    {
        Schema::table('custom_keys', function (Blueprint $table) {
            $table->unsignedBigInteger('analytic_id')->nullable();
            $table->foreign('analytic_id', 'analytic_fk_3826857')->references('id')->on('analytics');
        });
    }
}
