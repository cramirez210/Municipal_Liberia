<?php

namespace App\Http\Controllers;
use App\Mail;
use Illuminate\Http\Request;
use App\User;

class CorreoController extends Controller
{
    //

    public function enviar()
    {
    	$receivers = User::pluck('email');
		Mail::to($receivers)->send(new Notification($call));
    }
}
