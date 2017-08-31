<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Socio extends Model
{
    
    public function facturas()
    {
    	return $this->hasMany('App\Factura');
    }
}
