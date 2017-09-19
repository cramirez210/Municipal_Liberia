<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    //
     protected $guarded = [];

     public function socio()
    {
    	return $this->belongsTo('App\Socio');
    }

    public function socios()
    {
    	return $this->hasMany('App\Socio');
    }
}
