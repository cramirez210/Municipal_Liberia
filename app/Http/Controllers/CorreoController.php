<?php

namespace App\Http\Controllers;

use App\Mail\Notification;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Mail;

class CorreoController extends Controller
{
    //
    public function notificar()
    {
        // $order = Order::findOrFail($orderId);

        // Ship order...

        Mail::to(
        	'c.and.95@outlook.es')->send(new Notification());

        return view('welcome');	
    }


}
