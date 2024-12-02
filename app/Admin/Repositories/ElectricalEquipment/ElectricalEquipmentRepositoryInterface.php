<?php

namespace App\Admin\Repositories\ElectricalEquipment;

use App\Core\Repositories\EloquentRepositoryInterface;

interface ElectricalEquipmentRepositoryInterface extends EloquentRepositoryInterface
{
    public function searchSelect(string $keyword = '', int $limit = 10): array;
}
