<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Cobro;
use App\User;
use App\Comision;
use Carbon\Carbon;

class ComisionController extends Controller
{

    public function comision($user_id, $desde, $hasta, $monto, $comision){

        $comisions = DB::table('comisions')
                ->select('hasta', 'desde')
                ->where('user_id', $user_id)->get();

        foreach ($comisions as $comisionDB) {
                if ($this->check_in_range($desde, $hasta, $comisionDB->desde) || $this->check_in_range($desde, $hasta, $comisionDB->hasta)) {
         return with("<div class='alert alert-warning text-warning'>"."<b>Ya se han pagado comisiones de cobros realizados en el rango de fechas ingresado</b></div>");
}
        }


        $cobro = new Cobro;

        $user = $cobro->select_user()
                    ->where('users.id', $user_id)->first();

        $monto_recaudado = $monto;
        $monto_comision = $monto * ($comision / 100);
        
        return view('cobros.confirmar_pago_comision', 
            compact('user', 'desde', 'hasta', 'monto_recaudado', 'monto_comision'));   
    }

    public function check_in_range($fecha_inicio, $fecha_fin, $fecha){

     $fecha_inicio = strtotime($fecha_inicio);
     $fecha_fin = strtotime($fecha_fin);
     $fecha = strtotime($fecha);

     if(($fecha >= $fecha_inicio) && ($fecha <= $fecha_fin)) {

         return true;

     } else {

         return false;

     }
 }

    public function pagar_comision(){

        $comision = new Comision;

        $comision->user_id = request('user');
        $comision->desde = request('desde');
        $comision->hasta = request('hasta');
        $comision->monto = request('monto_recaudado');
        $comision->comision = request('monto_comision');

        $comision->save();

        return redirect('/facturas/index')->with('info', 'Operación realizada con éxito');
    }
}
