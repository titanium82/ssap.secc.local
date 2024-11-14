<?php

namespace App\Admin\Repositories\Role;

use App\Core\Repositories\EloquentRepositoryInterface;

interface RoleRepositoryInterface extends EloquentRepositoryInterface
{
    public function searchAllLimit($value = '', $meta = [], $limit = 10);
    public function createHasPermissions(array $data, array $permissions);
    public function updateHasPermissions($id, array $data, array $permissions);
}