<?php

namespace App\Admin\Repositories\Customer;
use App\Core\Repositories\EloquentRepository;
use App\Admin\Repositories\Customer\CustomerSectorRepositoryInterface;
use App\Models\CustomerSector;

class CustomerSectorRepository extends EloquentRepository implements CustomerSectorRepositoryInterface
{

    public function getModel(){
        return CustomerSector::class;
    }

    public function searchSelect(string $keyword = '', int $limit = 10): array
    {
        $customers = $this->model->select('id', 'name')
        ->whereAny($this->model->getFillable(), 'like', "%$keyword%")
        ->limit($limit)
        ->get()
        ->map(function($item) {
            return [
                'id' => $item->id,
                'text' => $item->name
            ];
        });

        return $customers->toArray();
    }
}