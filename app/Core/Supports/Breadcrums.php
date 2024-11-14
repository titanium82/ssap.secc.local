<?php

namespace App\Core\Supports;

class Breadcrums
{
        /**
     * Mảng chứa breadcrums
     *
     * @var array
     */
    public array $breadcrums = [];

    public function getBreadcrums(): array{
        return $this->breadcrums;
    }

    public function add(string $label, string $url = ''): Breadcrums
    {
        $this->breadcrums[] = [
            'label' => $label,
            'url' => $url
        ];
        return $this;
    }

    public function addByRouteName(string $label, string $route_name = ''): Breadcrums
    {
        $this->breadcrums[] = [
            'label' => $label,
            'url' => $route_name != '' && auth('admin')->user()->checkRouteNameAccessOrSuperAdmin($route_name) ? route($route_name) : ''
        ];
        return $this;
    }
}