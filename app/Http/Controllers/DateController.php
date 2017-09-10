<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DateController extends Controller
{
    function showDate(Request $request)
    {
 
       dd($request->date);
    }	
}
