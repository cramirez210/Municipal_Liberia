<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\SociosController;
use App\Http\Controllers\PdfController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Factura;
use App\Socio;
use App\Cobro;
use App\Descuento;
use Carbon\Carbon;

class Facturas extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'facturas:generar';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generar las facturas de todos los socios activos.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $model_factura = new Factura;

        $socios_controller = new SociosController;
        $socios_activos = $socios_controller->sociosPorEstado(1);

        if(count($socios_activos)){

            foreach ($socios_activos as $socio) {

            $facturas_pendientes = $model_factura->ObtenerPorSocioEstado($socio->id, 3)
                                    ->get();

            if(count($facturas_pendientes) == 3){

                $model_factura->InactivarSocio($socio->id);
            }
            else{

         $factura = new Factura; 
         $ultima_factura = DB::table('facturas')
                   ->where('facturas.socio_id', $socio->id)
                   ->latest()
                   ->first();    

         $categoria = $model_factura->ObtenerCategoriaDeSocio($socio->id);

         if($ultima_factura == null){      

        $factura->socio_id = $socio->id;
        $factura->user_id = 1;
        $factura->meses_cancelados = 1;
        $factura->monto = $categoria->precio_categoria;
        $factura->forma_pago = '';
        $factura->transaccion_bancaria = null;
        $factura->periodo = Carbon::now();
        $factura->fecha_pago = null;
        $factura->estado_id = 3;

        $factura->save();
         }
         else{
         
         $fecha_ultima_factura = new Carbon($ultima_factura->created_at);
         $fecha_actual = Carbon::now();

         if($fecha_ultima_factura->month < $fecha_actual->month){

        $factura->socio_id = $socio->id;
        $factura->user_id = 1;
        $factura->meses_cancelados = 1;
        $factura->monto = $categoria->precio_categoria;
        $factura->forma_pago = '';
        $factura->transaccion_bancaria = null;
        $factura->periodo = Carbon::now();
        $factura->fecha_pago = null;
        $factura->estado_id = 3;

        $factura->save();
         }
         }
            }
        }
        }
    }
}
