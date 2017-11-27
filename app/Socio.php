<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Socio extends Model
{
     protected $guarded = [];

     
    public function facturas()
    {
    	return $this->hasMany('App\Factura');
    }
    // Obterer la persona del socio 
    public function persona()
    {
    	return $this->belongsTo('App\Persona');
    }
    // Obtener la categoria del socio
    public function categoria()
    {
    	return $this->belongsTo('App\Categoria');
    }

    public function categorias()
    {
    	return $this->belongsTo('App\Categoria');
    }
    // Obtener el usuario del socio

    public function usuarios()
    {
    	return $this->belongsTo('App\User');
    }

    public function usuario()
    {
        return $this->hasOne('App\User');
    }
    // Obtener el estado del socio
    public function estado()
    {
    	return $this->belongsTo('App\Estado');
    }

    public function select()
    {
        return DB::table('socios')
            ->join('personas', 'socios.persona_id', '=', 'personas.id')
            ->join('categorias', 'socios.categoria_id', '=', 'categorias.id')
            ->join('users', 'socios.user_id', '=', 'users.id')
            ->join('estados', 'socios.estado_id', '=', 'estados.id')
            ->select('socios.*', 'personas.cedula','personas.primer_nombre', 'personas.primer_apellido', 'personas.segundo_apellido','personas.telefono','personas.email', 'categorias.categoria', 'users.nombre_usuario', 'estados.estado','categorias.id as categoriasId')
            ->orderBy('socios.id');

    }
}
