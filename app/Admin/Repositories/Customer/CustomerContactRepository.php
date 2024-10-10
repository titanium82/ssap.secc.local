<?php

namespace App\Admin\Repositories\Customer;
use App\Core\Repositories\EloquentRepository;
use App\Admin\Repositories\Customer\CustomerContactRepositoryInterface;
use App\Models\CustomerContact;

class CustomerContactRepository extends EloquentRepository implements CustomerContactRepositoryInterface
{

    public function getModel(){
        return CustomerContact::class;
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

            $this->authorize('update', 'admin');

            $this->instance->update($data);

            return $this->instance;
        }

        return false;
    }

    public function delete($id)
    {
        $this->find($id);

        if ($this->instance){

            $this->authorize('delete', 'admin');

            $this->instance->delete();

            return true;
        }

        return false;
    }
}