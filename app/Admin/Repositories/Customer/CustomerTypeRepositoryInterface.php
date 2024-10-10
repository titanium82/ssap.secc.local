<?php

namespace App\Admin\Repositories\Customer;

use App\Core\Repositories\EloquentRepositoryInterface;

interface CustomerTypeRepositoryInterface extends EloquentRepositoryInterface
{
    public function searchAllLimit($value = '', $meta = [], $limit = 10);
}