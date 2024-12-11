<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\ElectricalEquipmentOrder;
use Illuminate\Auth\Access\Response;

class ElectricalEquipmentOrderPolicy
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
    public function view(Admin $admin, ElectricalEquipmentOrder $electricalequipmentorder): bool
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
    public function update(Admin $admin, ElectricalEquipmentOrder $electricalequipmentorder): bool
    {
        //
        return $admin->id == $electricalequipmentorder->admin_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Admin $admin, ElectricalEquipmentOrder $electricalequipmentorder): bool
    {
        //
        return $admin->id == $electricalequipmentorder->admin_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Admin $admin, ElectricalEquipmentOrder $electricalequipment): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Admin $admin, ElectricalEquipmentOrder $electricalequipment): bool
    {
        //
    }
}
