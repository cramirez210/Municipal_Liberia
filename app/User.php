<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use App\Notifications\MyResetPassword;


class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        
        'nombre_usuario', 'password','cedula','persona_id','rol_id','email','estado_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function persona()
    {
       return $this->belongsTo('App\Persona');
    }

    public function role()
    {
        return $this->belongsTo('App\Role','rol_id');
    }

    //Listar Socios de un Usuario
    public function socios()
    {
        return $this->hasMany('App\Socio');
    }

    public function socio()
    {
        return $this->belongsTo('App\User');
    }
    
    public function estado()
    {
        return $this->belongsTo('App\Estado');
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new MyResetPassword($token));
    }


}
