<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Farm
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
        if (Auth::user()->role == 4 || Auth::user()->role == 1) {
            return $next($request);
        } else {
            switch (Auth::user()->role) {
                case 2:
                    Session::flash('permission_warning', 'You no not have access to this page');
                    return redirect('/home');
                    break;
                case 3:
                    Session::flash('permission_warning', 'You no not have access to this page');
                    return redirect('/clients');
                    break;
                case 5:
                    Session::flash('permission_warning', 'You no not have access to this page');
                    return redirect('/employees');
                    break;
                case 6:
                    Session::flash('permission_warning', 'You no not have access to this page');
                    return redirect('/expenses');
                    break;
                default:
                    break;
            }
        }
    }
}
