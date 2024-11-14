<?php

namespace App\Admin\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class GuestAdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        
        if (Auth::guard('admin')->guest()) {
            return $next($request);
        }

        return to_route('admin.dashboard');
    }
}