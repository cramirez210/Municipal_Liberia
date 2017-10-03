<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{

	 protected $guarded = [];

	 public function socio()
    {
    	return $this->hasMany('App\Socio');
    }
    public function usuario()
    {
    	return $this->hasOne('App\User');
    }
}
