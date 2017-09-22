<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
    	return $this->hasOne('App\Categoria');
    }

    public function categorias()
    {
    	return $this->belongsTo('App\Categoria');
    }
    // Obtener el usuario del socio
    public function usuario()
    {
    	return $this->hasOne('App\User');
    }

    public function usuarios()
    {
    	return $this->belongsTo('App\User');
    }
    // Obtener el estado del socio
    public function estado()
    {
    	return $this->hasOne('App\Estado');
    }
}
