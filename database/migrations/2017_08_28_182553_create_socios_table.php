<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSociosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('socios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('persona_id')->unsigned();
            $table->string('estado_civil');
            $table->integer('categoria_id')->unsigned();
            $table->string('empresa');
            $table->integer('user_id')->unsigned();
            $table->integer('estado_id')->unsigned();
            $table->timestamps();

            $table->foreign('persona_id')->references('id')->on('personas');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::dropIfExists('socios');
    }
}
