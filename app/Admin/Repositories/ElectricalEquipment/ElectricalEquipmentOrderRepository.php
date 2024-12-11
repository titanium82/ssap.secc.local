<?php

namespace App\Admin\Repositories\ElectricalEquipment;

use App\Core\Repositories\EloquentRepository;
use App\Admin\Repositories\ElectricalEquipment\ElectricalEquipmentOrderRepositoryInterface;
use App\Models\ElectricalEquipmentOrder;

class ElectricalEquipmentOrderRepository extends EloquentRepository implements ElectricalEquipmentOrderRepositoryInterface
{

    public function getModel(){
        return ElectricalEquipmentOrder::class;
    }
    public function searchSelect(string $keyword = '', int $limit = 10): array
    {
        $electricalequipmentorder = $this->model->select('id', 'code')
        ->currentAuth()
        ->whereAny($this->model->getFillable(), 'like', "%$keyword%")
        ->limit($limit)
        ->get()
        ->map(function($item) {
            return [
                'id' => $item->id,
                'text' => $item->code
            ];
        });
        return $electricalequipmentorder->toArray();
    }

    public function findOrFail($id, array $relations = [])
    {
        parent::findOrFail($id, $relations);

        $this->authorize('view', 'admin');

        return $this->instance;
    }
}
