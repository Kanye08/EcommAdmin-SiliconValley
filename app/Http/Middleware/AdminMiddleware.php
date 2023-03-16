<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{

    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::user()->role_as == '1') {
            return redirect('/home')->with('status', 'Access Denied. You are not Admin');
        }
        return $next($request);
    }
}
