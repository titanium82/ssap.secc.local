<?php

namespace App\Admin\Repositories\Warehouse;

use App\Core\Repositories\EloquentRepositoryInterface;

interface WarehouseRepositoryInterface extends EloquentRepositoryInterface
{
    public function searchAllLimit($value = '', $meta = [], $limit = 10);
}
