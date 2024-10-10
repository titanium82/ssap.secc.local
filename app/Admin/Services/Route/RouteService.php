<?php

namespace App\Admin\Services\Route;

use Illuminate\Support\Facades\Route;

class RouteService
{
    public static function getRoutesByName(string $startName = '', array $white_list = []): array
    {
        //lay toan bo name route
        $routes = Route::getRoutes()->getRoutesByName();
        
        //lọc ra các route.
        $routes = array_filter(array_keys($routes), fn ($value) => strpos($value, $startName) === 0 && !in_array($value, $white_list));

        $routes = array_values($routes);

        return $routes;
    }
}