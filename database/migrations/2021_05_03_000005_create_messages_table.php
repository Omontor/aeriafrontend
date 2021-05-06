<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('publish_date')->nullable();
            $table->string('expiration_date')->nullable();
            $table->string('subject')->nullable();
            $table->string('message')->nullable();
            $table->string('uri')->nullable();
            $table->string('data_type')->nullable();
            $table->string('country')->nullable();
            $table->string('custom_data')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
