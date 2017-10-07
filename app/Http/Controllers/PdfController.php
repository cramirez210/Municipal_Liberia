<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function factura($factura) 
    {
        $view =  \View::make('facturas.factura', compact('factura'))->render();
        $dompdf = \App::make('dompdf.wrapper');
        $dompdf->loadHTML($view);

        $pdf = $dompdf->output();
        file_put_contents("facturas/".$factura->id.".pdf", $pdf);

        //return $dompdf->stream('nombre_del_pdf'); generar y mostrar pdf en navegador
        //return $dompdf->download('nombre_del_pdf'); descargar pdf
    }
 
    public function getData() 
    {
        $data =  [
            'quantity'      => '1' ,
            'description'   => 'some ramdom text',
            'price'   => '500',
            'total'     => '500'
        ];
        return $data;
    }
}
