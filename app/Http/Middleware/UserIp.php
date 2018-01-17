<?php

namespace App\Http\Middleware;

use Closure;
use DB;
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
        //dd($request);
        /*DB::table('user_ip')->insert([
            'ip'=>$request->ip(),
            'remember_token'=>$request->path(),
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),
        ]);*/
        return $next($request);
    }
}

