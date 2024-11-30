<?php

namespace App\Admin\Repositories\ElectricalEquipment;
use App\Core\Repositories\EloquentRepository;
use App\Admin\Repositories\ElectricalEquipment\ElectricalEquipmentTypeRepositoryInterface;
use App\Models\ElectricalEquipmentType;

class ElectricalEquipmentTypeRepository extends EloquentRepository implements ElectricalEquipmentTypeRepositoryInterface
{

    public function getModel(){
        return ElectricalEquipmentType::class;
    }

    public function searchSelect(string $keyword = '', int $limit = 10): array
    {
        $electricalequipmenttypes = $this->model->select('id', 'name')
        ->currentAuth()
        ->whereAny($this->model->getFillable(), 'like', "%$keyword%")
        ->limit($limit)
        ->get()
        ->map(function($item) {
            return [
                'id' => $item->id,
                'text' => $item->name
            ];
        });

        return $electricalequipmenttypes->toArray();
    }

    public function findOrFail($id, array $relations = [])
    {
        parent::findOrFail($id, $relations);

        $this->authorize('view', 'admin');

        return $this->instance;
    }
}
