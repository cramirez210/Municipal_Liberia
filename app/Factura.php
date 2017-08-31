<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'meses_cancelados', 'monto', 'forma_pago', 'transaccion_bancaria',
    ];

    public function socio()
    {
    	return $this->belongsTo(App\Socio);
    }
}
