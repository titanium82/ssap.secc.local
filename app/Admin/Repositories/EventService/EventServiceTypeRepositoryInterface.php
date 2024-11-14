<?php

namespace App\Admin\Repositories\EventService;

use App\Core\Repositories\EloquentRepositoryInterface;

interface EventServiceTypeRepositoryInterface extends EloquentRepositoryInterface
{
    public function searchAllLimit($value = '', $meta = [], $limit = 10);
}
