<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomKeysTable extends Migration
{
    public function up()
    {
        Schema::create('customkeys', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('remote_id');
            $table->string('name')->nullable();
            $table->string('analytic_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
