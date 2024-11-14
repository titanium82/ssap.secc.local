<?php

namespace App\Admin\Repositories\EventService;
use App\Core\Repositories\EloquentRepository;
use App\Admin\Repositories\EventService\EventServiceUnitRepositoryInterface;
use App\Models\EventServiceUnit;

class EventServiceUnitRepository extends EloquentRepository implements EventServiceUnitRepositoryInterface
{

    public function getModel(){
        return EventServiceUnit::class;
    }

    public function searchAllLimit($keySearch = '', $meta = [], $limit = 10)
    {
        $this->instance = $this->model;

        $this->instance = $this->instance->where('name', 'LIKE', '%'.$keySearch.'%');

        $this->applyFilters($meta);

        return $this->instance->limit($limit)->get();
    }
}
