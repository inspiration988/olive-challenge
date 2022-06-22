<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class CheckToken
{
    public function handle(Request $request, Closure $next)
    {
        if(Auth::guard('api')->check()){
            return $next($request);
        }else{
            return Response::failed(['error' => 'UnAuthorised Access'] , 401);
            //return abort(401);
        }
    }
}
