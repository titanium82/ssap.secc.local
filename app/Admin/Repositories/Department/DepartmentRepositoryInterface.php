<?php

namespace App\Admin\Repositories\Department;

use App\Core\Repositories\EloquentRepositoryInterface;

interface DepartmentRepositoryInterface extends EloquentRepositoryInterface
{
    public function searchAllLimit($value = '', $meta = [], $limit = 10);
}
