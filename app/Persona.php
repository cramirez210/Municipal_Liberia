<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
	
   protected $guarded = [];


   public function usuario()
    {
        return $this->hasOne('App\User');
    }
    

}




