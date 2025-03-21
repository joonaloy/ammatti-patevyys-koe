<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class opettajaAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$this->opettajaAuth()) {
            return redirect("/opettaja/login");
        }
        return $next($request);
    }
    //opettaja authentication
    private function opettajaAuth()
    {
        if (session("Opettaja") == True) {
            return True;
        } else {
            return False;
        }
    }
}
