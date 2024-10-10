<?php

namespace App\Observers;

use App\Models\Admin;
use App\Models\Permission;

class PermissionObserver
{
    /**
     * Handle the Permission "created" event.
     *
     * @param  \App\Models\Permission  $permission
     * @return void
     */
    public function created(Permission $permission)
    {
        //
    }

    /**
     * Handle the Permission "updated" event.
     *
     * @param  \App\Models\Permission  $permission
     * @return void
     */
    public function updated(Permission $permission)
    {
        //
        if($permission->wasChanged('route_names'))
        {
            $admins = Admin::whereRelation('permissions', 'id', $permission->id)->orWhereRelation('roles', fn($q) => $q->whereRelation('permissions', 'id', $permission->id))->get();

            $admins->map(function($admin) {
                $admin->update([
                    'access_route_names' => $admin->getRouteNamesAccessByPermissionAndRole()
                ]);
            });
        }
    }

    /**
     * Handle the Permission "deleted" event.
     *
     * @param  \App\Models\Permission  $permission
     * @return void
     */
    public function deleted(Permission $permission)
    {
        //
    }

    /**
     * Handle the Permission "restored" event.
     *
     * @param  \App\Models\Permission  $permission
     * @return void
     */
    public function restored(Permission $permission)
    {
        //
    }

    /**
     * Handle the Permission "force deleted" event.
     *
     * @param  \App\Models\Permission  $permission
     * @return void
     */
    public function forceDeleted(Permission $permission)
    {
        //
    }
}