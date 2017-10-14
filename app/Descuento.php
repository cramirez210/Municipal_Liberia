<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Descuento extends Model
{
    protected $fillable = [
        'semestral', 'anual',
    ];

    public function ObtenerMontoDescuento($categoria_id, $meses_cancelar){

    	$descuento = DB::table('descuentos')
                ->join('categorias', 'descuentos.categoria_id', 'categorias.id')
                ->select('descuentos.*')
                ->where('descuentos.categoria_id', $categoria_id)
                ->first();

        $monto_descuento = 0;

        if($meses_cancelar == 6)
            $monto_descuento = $descuento->semestral;
        elseif ($meses_cancelar == 12)
            $monto_descuento = $descuento->anual;

        return $monto_descuento;
    }
}
