<?php

namespace App\Http\Middleware;
use App\Http\Controllers\Auth\AuthExtend as Auth;
use Closure;

class Rules
{
    /**
     *  first you must got Auth middleware
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next , $roleString)
    {
     if( Auth::ChekRulesby($roleString))

        return $next($request);
    else
    return response()->json(["error"=>true ,"data" =>"you don't have permation" ],401);

    }
}
