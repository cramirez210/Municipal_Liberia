<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Notification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    // public $notification; 

    // public function __construct(Notification $notification)
    // {
    //     //
    //      $this->notification = $notification;
    // }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build($request,$categoria,$idUser, $persona)
    {
        dd($request);
          return $this->markdown('correos.notificacion',[
                'request' => $request,
                'categoria' => $categoria,
                'persona' => $persona,  
          ]);
    }
}
