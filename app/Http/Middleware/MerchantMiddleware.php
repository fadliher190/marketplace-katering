<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class MerchantMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!Auth::check()){
            return redirect()->to(route('auth.sign-in'));
        }

        if(is_null(Auth::user()->hasMerchant)){
            return redirect()->to(route('merchant.register'));
        }
        return $next($request);
    }
}
