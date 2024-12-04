<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$params)
    {
        try {
            $authentication = service('authentication');
            if(in_array($authentication->user("role"), $params)) {
                return $next($request);
            } else {
                throw new \Exception("Role has no access!");  
            }
        } catch (\Throwable $e) {
            return redirect("page/notfound");
        }
    }
}
