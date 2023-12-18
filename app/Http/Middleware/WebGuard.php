<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WebGuard
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // if($request->age <18){
        //     echo "You are not eligible to access this resource";
        //     die();
        // }
        // echo "<pre>";
        // print_r(session()->all());
        // die;
        if (session()->has('email'))
            return $next($request);
        else
            return redirect('no-access');
    }
}
