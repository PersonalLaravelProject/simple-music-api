<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMusixTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('musics', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('album_id')->unsigned();
            $table->string('title');
            $table->uuid('uuid')->nullable();
            $table->string('artist');
            $table->string('album');        
            $table->string('year');
            $table->string('genre');
            $table->string('file_name')->nullable();
            $table->string('image_filename')->nullable();
            $table->string('image_url')->nullable();
            $table->timestamps();

            $table->foreign('album_id')->references('id')->on('albums')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('musix');
    }
}
