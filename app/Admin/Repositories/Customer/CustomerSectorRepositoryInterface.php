<?php

namespace App\Admin\Repositories\Customer;

use App\Core\Repositories\EloquentRepositoryInterface;

interface CustomerSectorRepositoryInterface extends EloquentRepositoryInterface
{
    public function searchSelect(string $keyword = '', int $limit = 10): array;
}