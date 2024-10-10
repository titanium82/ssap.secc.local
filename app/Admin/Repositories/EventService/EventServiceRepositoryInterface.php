<?php

namespace App\Admin\Repositories\EventService;

use App\Core\Repositories\EloquentRepositoryInterface;

interface EventServiceRepositoryInterface extends EloquentRepositoryInterface
{
    public function searchSelect(string $keyword = '', int $limit = 10): array;
}
