<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;

class Notification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $request;
    public $imagen;
    public $persona;

    public function __construct($request,$imagen,$persona)
    {   
         $this->request = $request;
         $this->imagen = $imagen;
         $this->persona = $persona;
    }

    /**
     * Build the message.
     *
     * @return $this
     */ 
    public function build()
    {

          return $this->markdown('correos.notificacion');
    }
}
