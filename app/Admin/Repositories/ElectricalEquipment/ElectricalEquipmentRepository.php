<?php

namespace App\Admin\Repositories\ElectricalEquipment;
use App\Core\Repositories\EloquentRepository;
use App\Admin\Repositories\ElectricalEquipment\ElectricalEquipmentRepositoryInterface;
use App\Models\ElectricalEquipment;

class ElectricalEquipmentRepository extends EloquentRepository implements ElectricalEquipmentRepositoryInterface
{

    public function getModel(){
        return ElectricalEquipment::class;
    }

    public function searchSelect(string $keyword = '', int $limit = 10): array
    {
        $electricalequipment = $this->model->select('id', 'name')
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

        return $electricalequipment->toArray();
    }

    public function findOrFail($id, array $relations = [])
    {
        parent::findOrFail($id, $relations);

        $this->authorize('view', 'admin');

        return $this->instance;
    }
    public function update($id, array $data)
    {
        $this->find($id);

        if ($this->instance) {

            // $this->authorize('update', 'admin');

            $this->instance->update($data);

            return $this->instance;
        }

        return false;
    }

    public function delete($id)
    {
        $this->find($id);

        if ($this->instance){

/*             $this->authorize(action: 'delete', 'admin');
 */
            $this->instance->delete();

            return true;
        }

        return false;
    }
}
