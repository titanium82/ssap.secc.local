<?php

namespace App\Admin\Repositories\Customer;
use App\Core\Repositories\EloquentRepository;
use App\Admin\Repositories\Customer\CustomerTypeRepositoryInterface;
use App\Models\CustomerType;

class CustomerTypeRepository extends EloquentRepository implements CustomerTypeRepositoryInterface
{

    public function getModel(){
        return CustomerType::class;
    }

    public function searchAllLimit($keySearch = '', $meta = [], $limit = 10)
    {
        $this->instance = $this->model;

        $this->instance = $this->instance->where('name', 'LIKE', '%'.$keySearch.'%');
        
        $this->applyFilters($meta);
        
        return $this->instance->limit($limit)->get();
    }
}