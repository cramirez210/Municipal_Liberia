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

        $cobro = new Cobro;

        $user = $cobro->select_user()
                    ->where('users.id', $user_id)->first();

        $monto_recaudado = $monto;
        $monto_comision = $monto * ($comision / 100);
        
        return view('cobros.confirmar_pago_comision', 
            compact('user', 'desde', 'hasta', 'monto_recaudado', 'monto_comision'));   
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
