<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportesController extends Controller
{
    public function index()
    {
        return view('/reportes/index');
    }

    public function home()
    {
        return view('/reportes/reporte');
    }
}
