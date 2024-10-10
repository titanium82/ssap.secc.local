<?php

namespace App\Admin\Supports\Authorization;

use App\Admin\Enums\Role\RoleManager;

trait Manager
{

    public function managerContract(): bool
    {
        return $this->isManager(RoleManager::Contract);
    }

    public function managerCustomer(): bool
    {
        return $this->isManager(RoleManager::Customer);
    }

    public function isManager(RoleManager $manager): bool
    {
        if(count($this->getRouteNamesAccess()) == 0)
        {
            return false;
        }
        return empty(array_diff($this->getConfigManager($manager), $this->getRouteNamesAccess()));
    }

    public function getConfigManager(RoleManager $manager): array
    {
        return config('admin.roles_permissions.' . RoleManager::class . '.' . $manager->name, []);
    }
}