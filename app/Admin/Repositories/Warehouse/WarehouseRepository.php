<?php

namespace App\Admin\Repositories\Warehouse;
use App\Core\Repositories\EloquentRepository;
use App\Admin\Repositories\Warehouse\WarehouseRepositoryInterface;
use App\Models\Warehouse;

class WarehouseRepository extends EloquentRepository implements WarehouseRepositoryInterface
{

    public function getModel(){
        return Warehouse::class;
    }

    public function searchAllLimit($keySearch = '', $meta = [], $limit = 10)
    {
        $this->instance = $this->model;

        $this->instance = $this->instance->where('name', 'LIKE', '%'.$keySearch.'%');

        $this->applyFilters($meta);

        return $this->instance->limit($limit)->get();
    }
}
