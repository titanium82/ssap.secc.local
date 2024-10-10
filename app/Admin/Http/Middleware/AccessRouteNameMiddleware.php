<?php

namespace App\Admin\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AccessRouteNameMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Perform action
        if (Auth::guard('admin')->check())
        {
            if(Auth::guard('admin')->user()->checkRouteNameAccessOrSuperAdmin($request->route()->getName()))
            {
                return $next($request);
            }

            logger()->warning(trans('User intentionally accesses url'), [
                'url' => $request->fullUrl(),
                'user' => auth('admin')->user()->toArray() ?? []
            ]);
        }

        return abort(403);
    }
}