<?php

namespace App\Admin\Repositories\Department;
use App\Core\Repositories\EloquentRepository;
use App\Admin\Repositories\Department\DepartmentRepositoryInterface;
use App\Models\Department;

class DepartmentRepository extends EloquentRepository implements DepartmentRepositoryInterface
{

    public function getModel(){
        return Department::class;
    }

    public function searchAllLimit($keySearch = '', $meta = [], $limit = 10)
    {
        $this->instance = $this->model;

        $this->instance = $this->instance->where('name', 'LIKE', '%'.$keySearch.'%');

        $this->applyFilters($meta);

        return $this->instance->limit($limit)->get();
    }
}
