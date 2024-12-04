<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SessionCheck
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
            helper("text");
            service("configs")->write_officedata();
            $authentication = service('authentication');
            if($authentication->session()) {
                $user_id = $authentication->session()->userId;
                $profile = service('users')->findOne([
                    ["where", "id", $user_id]
                ]);
                $authentication->set_userdata( $profile );
            }
        } catch (\Throwable $e) {
            // do nothing
        }
        return $next($request);
    }
}
