<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\UserIp as UserIpModel;

class UserIp
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $userIp=new UserIpModel();
        dd($userIp->test());
        return $next($request);
    }
}
