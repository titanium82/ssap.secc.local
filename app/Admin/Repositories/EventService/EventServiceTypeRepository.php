<?php

namespace App\Admin\Repositories\EventService;
use App\Core\Repositories\EloquentRepository;
use App\Admin\Repositories\EventService\EventServiceTypeRepositoryInterface;
use App\Models\EventServiceType;

class EventServiceTypeRepository extends EloquentRepository implements EventServiceTypeRepositoryInterface
{

    public function getModel(){
        return EventServiceType::class;
    }

    public function searchAllLimit($keySearch = '', $meta = [], $limit = 10)
    {
        $this->instance = $this->model;

        $this->instance = $this->instance->where('name', 'LIKE', '%'.$keySearch.'%');

        $this->applyFilters($meta);

        return $this->instance->limit($limit)->get();
    }
}
