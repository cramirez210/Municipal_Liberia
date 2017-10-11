<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class EjecutivoyAdministrador
{
   
    protected $auth;
    public function __construct(Guard $auth)
    {
        $this->auth = $auth; 
    }
    
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle($request, Closure $next)
    {

        switch ($this->auth->user()->rol_id) 
        {
            case '1':
                return $next($request);
                break;
            case '2':
           // $this->auth->logout();    
                    return back()->withSuccess('Usted no tiene acceso a realizar acciones en esta área');
            case '3':
                      return $next($request);   
                break;
        }
    }
}
