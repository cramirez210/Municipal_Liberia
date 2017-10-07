<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\CreateFacturaRequest;
use App\Http\Controllers\SociosController;
use App\Http\Controllers\CobroController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Factura;
use App\Socio;
use Carbon\Carbon;

class Factura extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'meses_cancelados', 'monto', 'forma_pago', 'transaccion_bancaria',
    ];

    public function socio()
    {
    	return $this->belongsTo(App\Socio);
    }

    public function store($factura, $socio_id, $meses_cancelados, $precio_categoria, $forma_pago, $transaccion_bancaria, $fecha_factura, $fecha_pago, $estado_id){

        $user_id = Auth::user()->id;

        $factura->socio_id = $socio_id;
        $factura->user_id = $user_id;
        $factura->meses_cancelados = $meses_cancelados;
        $factura->monto = $precio_categoria;
        $factura->forma_pago = $forma_pago;
        $factura->transaccion_bancaria = $transaccion_bancaria;
        $factura->created_at = $fecha_factura;
        $factura->updated_at = Carbon::now();
        if($factura->fecha_pago == null)
        $factura->fecha_pago = $fecha_pago;
        $factura->estado_id = $estado_id;

        $factura->save();
    }

    public function PagarPendientes($facturas, $forma_pago){

        foreach ($facturas as $factura) {
            $facturaBD = Factura::find($factura->id);

            $fecha = Carbon::now();
            $cobro_controller = new CobroController;

            $this->store($facturaBD, $factura->socio_id, $factura->meses_cancelados, $factura->precio_categoria, $forma_pago, null, $factura->created_at, $fecha, 4);

            $cobro_controller->GenerarCobroUsuario($factura->id, 3);
        }
    }

    public function PagarAdelantado($socio_id, $meses_cancelar, $forma_pago){

        $categoria = DB::table('socios')
                     ->join('categorias', 'socios.categoria_id', 'categorias.id')
                     ->select('categorias.precio_categoria')
                     ->where('socios.id', $socio_id)
                     ->first();

        for($i = 0; $i < $meses_cancelar; $i++){

        $ultima_factura = DB::table('facturas')
                   ->where('facturas.socio_id', $socio_id)
                   ->latest()
                   ->first();

         $factura = new Factura;       
         
         $fecha = new Carbon($ultima_factura->created_at);
         $fecha->addMonth();

         $this->store($factura, $socio_id, 1, $categoria->precio_categoria, $forma_pago, null, $fecha, Carbon::now(), 4);
        }
    }

    public function select(){

        return DB::table('socios')
            ->join('personas', 'socios.persona_id', 'personas.id')
            ->join('categorias', 'socios.categoria_id', 'categorias.id')
            ->join('facturas', 'facturas.socio_id', 'socios.id')
            ->join('users', 'facturas.user_id', 'users.id')
            ->join('estados', 'facturas.estado_id', 'estados.id')
            ->select('socios.id as socio_id', 'personas.primer_nombre', 'personas.primer_apellido', 'personas.segundo_apellido', 'facturas.*', 'categorias.categoria', 'categorias.precio_categoria', 'users.nombre_usuario', 'estados.estado')
            ->orderBy('facturas.id');
    }

    public function select_socio(){
        return DB::table('socios')
           ->join('personas', 'socios.persona_id', 'personas.id')
           ->join('categorias', 'socios.categoria_id', 'categorias.id')
         ->select('socios.id as socio_id', 'personas.primer_nombre', 'personas.primer_apellido', 'personas.segundo_apellido', 'categorias.categoria', 'categorias.precio_categoria')
         ->orderBy('socios.id');
    }

    public function ObtenerPorCriterio($columna, $valor)
    {
            $facturas = $this->select()
            ->where($columna, $valor)
            ->get();

        return $facturas;
    }

    public function ObtenerPorId($id){

        $factura = $this->ObtenerPorCriterio('facturas.id', $id);

        return $factura[0];
    }

    public function ObtenerPorSocioEstado($socio_id, $estado_id){

           $facturas = $this->select()
            ->where('facturas.socio_id', $socio_id)
            ->whereIn('facturas.estado_id', [$estado_id])
            ->get();

        return $facturas;
    }

    public function ObtenerPorFecha($fecha_inicio, $fecha_fin){
     
     $facturas = $this->select()
            ->whereBetween('facturas.created_at', array($fecha_inicio, $fecha_fin))
            ->get();

        return $facturas;   
    }

    public function ObtenerPorFechaCriterio($fecha_inicio, $fecha_fin, $columna, $valor){
   
    $select = $this->select();
    
         $facturas = $select
            ->whereBetween('facturas.created_at', array($fecha_inicio, $fecha_fin))
            ->where($columna, $valor)
            ->get();

        return $facturas;   
    }

    public function ObtenerSocioPorCriterio($criterio, $valor){
        if($criterio == 2){
            $socio = $this->select_socio()
            ->where('personas.cedula', $valor)
            ->first();
        }else{
            $socio = DB::table('socios')
            ->select('socios.id as socio_id')
            ->where('socios.id', $valor)
            ->first();
        }

        return $socio;
    }

    public function InactivarSocio($id){

        $socio = Socio::find($id);

                $socio->estado_id = 2;
                $socio->save();
    }

    public function ObtenerCategoriaDeSocio($socio){
        return DB::table('categorias')
         ->select('precio_categoria')
         ->where('categorias.id', $socio->categoria_id)
         ->first();
    }
}
