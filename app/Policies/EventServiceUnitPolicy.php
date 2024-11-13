<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\EventServiceUnit;
use Illuminate\Auth\Access\Response;

class EventServiceUnitPolicy
{
    public function before(Admin $admin, $ability): bool|null
    {
        if($admin->managerCustomer() || $admin->checkIsSuperAdmin())
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
    public function view(Admin $admin, EventServiceUnit $EventServiceUnit): bool
    {
        //
        return true;
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
    public function update(Admin $admin, EventServiceUnit $EventServiceUnit): bool
    {
        //
        return $admin->id == $EventServiceUnit->admin_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Admin $admin, EventServiceUnit $EventServiceUnit): bool
    {
        //
        return $admin->id == $EventServiceUnit->admin_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Admin $admin, EventServiceUnit $EventServiceUnit): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Admin $admin, EventServiceUnit $EventServiceUnit): bool
    {
        //
    }
}
