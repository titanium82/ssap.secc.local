<?php

namespace App\Admin\Repositories\Customer;
use App\Core\Repositories\EloquentRepository;
use App\Admin\Repositories\Customer\CustomerRepositoryInterface;
use App\Models\Customer;

class CustomerRepository extends EloquentRepository implements CustomerRepositoryInterface
{

    public function getModel(){
        return Customer::class;
    }

    public function searchSelect(string $keyword = '', int $limit = 10): array
    {
        $customers = $this->model->select('id', 'fullname')
        ->whereAny($this->model->getFillable(), 'like', "%$keyword%")
        ->limit($limit)
        ->get()
        ->map(function($item) {
            return [
                'id' => $item->id,
                'text' => $item->fullname
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