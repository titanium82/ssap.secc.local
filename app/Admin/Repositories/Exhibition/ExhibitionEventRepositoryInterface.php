<?php

namespace App\Admin\Repositories\Exhibition;

use App\Core\Repositories\EloquentRepositoryInterface;

interface ExhibitionEventRepositoryInterface extends EloquentRepositoryInterface
{
    public function searchSelect(string $keyword = '', int $limit = 10): array;
}
