<?php

namespace App\Admin\Repositories\Contract;
use App\Core\Repositories\EloquentRepository;
use App\Admin\Repositories\Contract\ContractTypeRepositoryInterface;
use App\Models\ContractType;

class ContractTypeRepository extends EloquentRepository implements ContractTypeRepositoryInterface
{

    public function getModel(){
        return ContractType::class;
    }
}