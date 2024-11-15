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
        $customer = $this->model->select('id', 'code')
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

        return $customers->toArray();
    }

    public function findOrFail($id, array $relations = [])
    {
        parent::findOrFail($id, $relations);

        $this->authorize('view', 'admin');

        return $this->instance;
    }
}
