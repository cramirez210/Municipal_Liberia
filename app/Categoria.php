<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    //
     protected $guarded = [];

     public function socio()
    {
    	return $this->hasOne('App\socio');
    }

    public function socios()
    {
    	return $this->hasMany('App\Socio');
    }
}
