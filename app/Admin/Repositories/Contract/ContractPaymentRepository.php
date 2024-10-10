<?php

namespace App\Admin\Repositories\Contract;

use App\Admin\Enums\Contract\ContractPaymentStatus;
use App\Core\Repositories\EloquentRepository;
use App\Admin\Repositories\Contract\ContractPaymentRepositoryInterface;
use App\Models\ContractPayment;

class ContractPaymentRepository extends EloquentRepository implements ContractPaymentRepositoryInterface
{
    public function getModel(){
        return ContractPayment::class;
    }

    public function accept($id)
    {
        $cp = $this->findOrFail($id);
        if($cp->canAccept())
        {
            $cp->update([
                'approved_by' => auth('admin')->id(),
                'status' => ContractPaymentStatus::Paid
            ]);
            return true;
        }
        
        return false;
    }
    
    public function uploadLicense($id, $license)
    {
        $cp = $this->findOrFail($id);

        if($cp->canUploadLicense())
        {
            $license = is_array($license) ? $license : explode(',', $license);

            $cp->update([
                'license' => $license
            ]);
            return true;
        }
        
        return false;
    }

    public function findOrFail($id, array $relations = [])
    {
        parent::findOrFail($id, $relations);

        $this->authorize('view', 'admin');

        return $this->instance;
    }

    public function getDueReminder(array $relations = [])
    {
        return $this->model->newQuery()->unpaid()
        ->whereDate('expired_at', now()->addDays(15))
        ->with($relations)
        ->get();
    }

    public function getWrongStatusLate(array $relations = [])
    {
        return $this->model->newQuery()->late(true)
        ->with($relations)
        ->get();
    }

    public function getLazyByIdWrongStatusLate($size = 1000, array $relations = [])
    {
        return $this->model->newQuery()->late(true)
        ->with($relations)
        ->lazyById($size);
    }

    public function getLazyByIdDueReminder($size = 1000, array $relations = [])
    {
        return $this->model->newQuery()->unpaid()
        ->whereDate('expired_at', now()->addDays(15))
        ->with($relations)
        ->lazyById($size);
    }

    public function updateWrongStatusLate()
    {
        $this->model->late(true)->update([
            'status' => ContractPaymentStatus::Late
        ]);
    }
}