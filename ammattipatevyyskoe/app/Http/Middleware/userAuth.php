<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class userAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!$this ->userAuth()){
            return redirect("/koe/login");
        }
        return $next($request);
    }
    private function userAuth(){
        if(session("Tunnus") != null && session("Palautettu") == 0){
            return True;
        }else{
            return False;
        }
    }
}
