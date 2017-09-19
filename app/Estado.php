<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{

	 protected $guarded = [];

	 public function socio()
    {
    	return $this->belongsTo('App\Socio');
    }
}
