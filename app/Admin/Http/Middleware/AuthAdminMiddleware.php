<?php

namespace App\Admin\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthAdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Perform action
        if (Auth::guard('admin')->check()) {
            return $next($request);
        }

        return redirect()->guest(route('admin.login.index'))->with('error', __('pleaseLoginHandle'));
    }
}