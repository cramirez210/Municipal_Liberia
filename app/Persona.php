<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
	
   protected $guarded = [];


   public function user()
    {
        return $this->hasOne('App\User','cedula_persona');
    }
    
}




