<?php

namespace App\Http\Controllers;

use App\Mail\Notification;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Mail;
use App\User;
use App\Persona;

class CorreoController extends Controller
{
    //
    public function notificar($request,$idUser)
    {
    	$ejecutivo = User::find($idUser);
    	$persona = Persona::find($ejecutivo->persona_id);
    	$imagen = $this->obtenerImagen($request);
        Mail::to($ejecutivo->email)->send(new Notification($request,$imagen,$persona));
    }


    public function obtenerImagen($request)
    {
    	$ruta ='';
        if($request->file('imagen')) 
        {
           $imagen = $request->file('imagen');
           $ruta = $imagen->store('socios','public');
        }else
        {
            $ruta = 'socios/default.jpg';
        }

        return $ruta;
    }

}
