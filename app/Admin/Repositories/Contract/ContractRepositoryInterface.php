<?php

namespace App\Admin\Repositories\Contract;

use App\Core\Repositories\EloquentRepositoryInterface;

interface ContractRepositoryInterface extends EloquentRepositoryInterface
{
    public function searchSelect(string $keyword = '', int $limit = 10): array;
}