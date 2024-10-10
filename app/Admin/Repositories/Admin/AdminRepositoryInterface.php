<?php

namespace App\Admin\Repositories\Admin;

use App\Admin\Enums\Role\RoleManager;
use App\Core\Repositories\EloquentRepositoryInterface;

interface AdminRepositoryInterface extends EloquentRepositoryInterface
{
    public function searchSelect(string $keyword = '', int $limit = 10): array;

    public function updateHasRoleAndPermission($id, array $data, array $roles = [], array $permissions = []);
    
    public function createHasRoleAndPermission(array $data, array $roles = [], array $permissions = []);
    
    public function getManager(RoleManager $manager);
    
    public function getLazyByIdManager(RoleManager $manager, $size = 1000, array $relations = []);
}