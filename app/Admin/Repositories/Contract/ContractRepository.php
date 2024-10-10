<?php

namespace App\Admin\Repositories\Contract;
use App\Core\Repositories\EloquentRepository;
use App\Admin\Repositories\Contract\ContractRepositoryInterface;
use App\Models\Contract;

class ContractRepository extends EloquentRepository implements ContractRepositoryInterface
{

    public function getModel(){
        return Contract::class;
    }

    public function searchSelect(string $keyword = '', int $limit = 10): array
    {
        $customers = $this->model->select('id', 'code')
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