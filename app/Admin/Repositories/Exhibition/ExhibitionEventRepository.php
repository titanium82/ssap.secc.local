<?php

namespace App\Admin\Repositories\Exhibition;
use App\Core\Repositories\EloquentRepository;
use App\Admin\Repositories\Exhibition\ExhibitionEventRepositoryInterface;
use App\Models\ExhibitionEvent;

class ExhibitionEventRepository extends EloquentRepository implements ExhibitionEventRepositoryInterface
{

    public function getModel(){
        return ExhibitionEvent::class;
    }

    public function searchSelect(string $keyword = '', int $limit = 10): array
    {
        $exhibitionevent = $this->model->select('id', 'name')
        ->whereAny($this->model->getFillable(), 'like', "%$keyword%")
        ->limit($limit)
        ->get()
        ->map(function($item) {
            return [
                'id' => $item->id,
                'text' => $item->name
            ];
        });

        return $exhibitionevent->toArray();
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
