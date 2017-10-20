<?php

namespace App\Http\Controllers;

use App\Mail\Notification;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Mail;

class CorreoController extends Controller
{
    //
    public function notificar($request, $categoria, $idUser, $persona)
    {
    	
        Mail::to(
        	'c.and.95@outlook.es')->send(new Notification($request,$categoria,$idUser, $persona));

        return view('welcome');	
    }


}
