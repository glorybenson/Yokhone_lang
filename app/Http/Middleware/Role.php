<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Role
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
        //return $next($request);
        switch (Auth::user()->role) {
            case '1':
                return $next($request);
                break;
            case '2':
                return redirect('/home');
                break;
            case '3':
                return redirect('/clients');
                break;
            case '4':
                return redirect('/farms');
                break;
            case '5':
                return redirect('/employess');
                break;
            case '6':
                return redirect('/expenses');
                break;
            default:
                return $next($request);
                break;
        }
    }
}
