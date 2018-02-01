<?php

/**
 * @Author: worldzb
 * @Date:   2018-02-01 09:41:59
 * @Last Modified by:   worldzb
 * @Last Modified time: 2018-02-01 10:10:33
 */

/**
 *  api 门卫
 */

namespace App\Http\Middleware;

use Closure;

class ApiAuth
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
        if(true){
            
        }
        return $next($request);
    }
}
