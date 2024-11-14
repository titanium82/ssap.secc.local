<?php

namespace App\Observers;

use App\Core\Enums\DefaultStatus;
use App\Core\Enums\Gender;
use App\Models\Admin;

class AdminObserver
{
    /**
     * Handle the Job "creating" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function creating(Admin $admin)
    {
        $admin->username = $admin->email;
        $admin->avatar = config('core.images.avatar');
        $admin->status = DefaultStatus::Published;
        $admin->gender = Gender::Male;
    }

    /**
     * Handle the Admin "created" event.
     */
    public function created(Admin $admin): void
    {
        //
    }

    /**
     * Handle the Admin "updated" event.
     */
    public function updated(Admin $admin): void
    {
        //
    }

    /**
     * Handle the Admin "deleted" event.
     */
    public function deleted(Admin $admin): void
    {
        //
    }

    /**
     * Handle the Admin "restored" event.
     */
    public function restored(Admin $admin): void
    {
        //
    }

    /**
     * Handle the Admin "force deleted" event.
     */
    public function forceDeleted(Admin $admin): void
    {
        //
    }
}
