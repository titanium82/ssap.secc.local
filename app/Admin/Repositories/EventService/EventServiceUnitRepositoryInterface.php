<?php

namespace App\Admin\Repositories\EventService;

use App\Core\Repositories\EloquentRepositoryInterface;

interface EventServiceUnitRepositoryInterface extends EloquentRepositoryInterface
{
    public function searchAllLimit($value = '', $meta = [], $limit = 10);
}
