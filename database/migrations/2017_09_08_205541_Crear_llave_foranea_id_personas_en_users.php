<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearLlaveForaneaIdPersonasEnUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->integer('id_persona')->unsigned();
            $table->foreign('id_persona')->references('id')->on('personas');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            
            $table->dropForeign('users_id_persona_foreign'); //Nombre de la tabla_ nombre de la columna _ forein 
            $table->dropColumn(['id_persona']);

        });
    }
}
