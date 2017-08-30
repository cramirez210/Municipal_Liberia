<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistrosMedicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registros_medicos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_persona');
            $table->integer('id_usuario');
            $table->string('tipo_lesion');
            $table->date('fecha_lesion');
            $table->date('fecha_atencion');
            $table->string('estado_lesion');
            $table->string('tiempo_recuperacion');
            $table->string('observaciones');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
