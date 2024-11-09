<?php
//! Copyright Syahri Ramadhan Wiraasmara (ARI)
namespace App\Http\Middleware;

use Closure;
Use App\Libraries\myfunction;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckingCookie
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!myfunction::getRawCookie('islogin')) return response()->json(['message' => "You're Logout!"], 404);
        if(!myfunction::getRawCookie('mcr_x_aswq_1')) return response()->json(['message' => "You're Logout!!"], 404);
        if(!myfunction::getRawCookie('mcr_x_aswq_2')) return response()->json(['message' => "You're Logout!!!"], 404);
        if(!myfunction::getRawCookie('mcr_x_aswq_3')) return response()->json(['message' => "You're Logout!!!!"], 404);
        if(!myfunction::getRawCookie('mcr_x_aswq_4')) return response()->json(['message' => "You're Logout!!!!!"], 404);

        return $next($request);
    }
}
