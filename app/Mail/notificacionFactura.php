<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class notificacionFactura extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $factura;
    public $socio;
    public $persona;
    public $periodo;
    public $categoria;

    public function __construct($factura,$socio,$persona,$periodo,$categoria)
    {
        $this->factura = $factura;
        $this->socio = $socio;
        $this->persona = $persona;
        $this->periodo = $periodo;
        $this->categoria = $categoria;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('correos.notificacionFactura');
    }
}
