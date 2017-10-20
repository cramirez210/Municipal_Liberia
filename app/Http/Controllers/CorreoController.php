<?php

namespace App\Http\Controllers;

use App\Mail\Notification;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Mail;

class CorreoController extends Controller
{
    //
    public function notificar($request,$idUser)
    {
    	 
        Mail::to(
        	'c.and.95@outlook.es')->send(new Notification($request,$idUser));

        return view('welcome');	
    }


}
