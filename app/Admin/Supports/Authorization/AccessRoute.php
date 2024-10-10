<?php

namespace App\Admin\Supports\Authorization;

trait AccessRoute
{

    public function checkIsSuperAdmin(): bool
    {
        return $this->is_superadmin;
    }

    public function checkRouteNamesAccessOrSuperAdmin(array $route_names, bool $empty = false): bool
    {
        return $this->checkIsSuperAdmin() || $this->checkRouteNamesAccess($route_names, $empty);
    }

    public function checkEmptyRouteNameAccessOrSuperAdmin(string $route_name = '', bool $empty = false, bool $current = true): bool
    {
        return $this->checkIsSuperAdmin() || $this->checkEmptyRouteNameAccess($route_name, $empty, $current);
    }

    public function checkRouteNameAccessOrSuperAdmin(string $route_name): bool
    {
        return $this->checkIsSuperAdmin() || $this->checkRouteNameAccess($route_name);
    }

    public function checkRouteNamesAccess(array $route_names, bool $empty = false): bool
    {
        if(count($route_names) == 0)
        {
            return $empty;
        }
        
        if(count(array_intersect($route_names, config('admin.roles_permissions.whitelist_routes_name', []))) > 0)
        {
            return true;
        }

        return count(array_intersect($route_names, $this->getRouteNamesAccess())) > 0;
    }

    public function checkEmptyRouteNameAccess(string $route_name = '', bool $empty = false, bool $current = true): bool
    {
        if($route_name == '')
        {
            if($empty)
            {
                return true;
            }elseif($current) {
                $route_name = request()->route()->getName();
            }else {
                return false;
            }
        }
        
        return $this->checkRouteNameAccess($route_name);
    }

    public function checkRouteNameAccess(string $route_name)
    {
        if(in_array($route_name, config('admin.roles_permissions.whitelist_routes_name', [])))
        {
            return true;
        }

        return in_array($route_name, $this->getRouteNamesAccess());
    }

    public function getRouteNamesAccess(): array
    {
        if($this->access_route_names?->count())
        {
            return $this->access_route_names->toArray();
        }

        return [];
    }

    public function getRouteNamesAccessByPermissionAndRole(): array
    {
        $auth = $this->loadMissing(['permissions', 'roles.permissions']);

        $listUrls = [];

        foreach($auth->roles as $role)
        {
            foreach($role->permissions as $permission)
            {
                $listUrls = array_merge($listUrls, $permission->route_names->toArray());
            }
        }

        foreach($auth->permissions as $permission){
            $listUrls = array_merge($listUrls, $permission->route_names->toArray());
        }
        return array_unique($listUrls);
    }
}