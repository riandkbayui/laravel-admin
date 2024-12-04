<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Authentication
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            $authentication = service('authentication');
            if($authentication->session()) {
                return $next($request);
            } else {
                throw new \Exception("Session not found!");  
            }
        } catch (\Throwable $e) {
            return redirect("auth/login");
        }
    }
}
