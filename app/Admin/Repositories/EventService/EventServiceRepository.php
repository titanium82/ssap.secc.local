<?php

namespace App\Admin\Repositories\EventService;
use App\Core\Repositories\EloquentRepository;
use App\Admin\Repositories\EventService\EventServiceRepositoryInterface;
use App\Models\EventService;

class EventServiceRepository extends EloquentRepository implements EventServiceRepositoryInterface
{

    public function getModel(){
        return EventService::class;
    }
    public function searchSelect(string $keyword = '', int $limit = 10): array
    {
        $eventservice = $this->model->select('id', 'name')
        ->whereAny($this->model->getFillable(), 'like', "%$keyword%")
        ->limit($limit)
        ->get()
        ->map(function($item) {
            return [
                'id' => $item->id,
                'text' => $item->name
            ];
        });

        return $eventservice->toArray();
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
