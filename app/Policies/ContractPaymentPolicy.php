<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\ContractPayment;
use Illuminate\Auth\Access\Response;

class ContractPaymentPolicy
{
    public function before(Admin $admin, $ability): bool|null
    {
        if($admin->managerContract() || $admin->checkIsSuperAdmin())
        {
            return true;
        }
        return null;
    }
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Admin $admin): bool
    {
        //
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Admin $admin, ContractPayment $contractPayment): bool
    {
        //
        if($admin->id == $contractPayment->admin_id || $contractPayment->sharers()->where('id', $admin->id)->exists())
        {
            return true;
        }
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Admin $admin): bool
    {
        //
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Admin $admin, ContractPayment $contractPayment): bool
    {
        //
        return $admin->id == $contractPayment->admin_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Admin $admin, ContractPayment $contractPayment): bool
    {
        //
        return $admin->id == $contractPayment->admin_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Admin $admin, ContractPayment $contractPayment): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Admin $admin, ContractPayment $contractPayment): bool
    {
        //
    }
}
