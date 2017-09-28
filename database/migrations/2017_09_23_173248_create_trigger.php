<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('CREATE TRIGGER insert_cobro AFTER INSERT ON facturas FOR EACH ROW
                BEGIN INSERT INTO cobros (user_id, factura_id, estado_id, created_at, updated_at) VALUES (NEW.user_id, NEW.id,4, now(), null); END');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER insert_cobro');
    }
}
