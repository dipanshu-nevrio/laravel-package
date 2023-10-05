<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJourensTable extends Migration
{
    public function up()
    {
        Schema::create('jourens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->time('start_time');
            $table->time('end_time');
            $table->integer('phone_number');
            $table->timestamps();
        });
    }
}
