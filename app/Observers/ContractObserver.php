<?php

namespace App\Observers;

use App\Admin\Enums\Contract\ContractStatus;
use App\Models\Contract;

class ContractObserver
{
    public function creating(Contract $contract): void
    {
        $contract->status = ContractStatus::Pending;
    }
    /**
     * Handle the Contract "created" event.
     */
    public function created(Contract $contract): void
    {
        //
    }

    /**
     * Handle the Contract "updated" event.
     */
    public function updated(Contract $contract): void
    {
        //
    }

    /**
     * Handle the Contract "deleted" event.
     */
    public function deleted(Contract $contract): void
    {
        //
    }

    /**
     * Handle the Contract "restored" event.
     */
    public function restored(Contract $contract): void
    {
        //
    }

    /**
     * Handle the Contract "force deleted" event.
     */
    public function forceDeleted(Contract $contract): void
    {
        //
    }
}
