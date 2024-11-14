<?php

namespace App\Observers;

use App\Admin\Enums\Contract\ContractPaymentStatus;
use App\Admin\Enums\Contract\ContractStatus;
use App\Admin\Enums\Role\RoleManager;
use App\Admin\Notifications\ContractPayment\AcceptLicense;
use App\Admin\Notifications\ContractPayment\UploadLicense;
use App\Models\Admin;
use App\Models\ContractPayment;
use Illuminate\Support\Facades\Notification;

class ContractPaymentObserver
{
    public function creating(ContractPayment $contractPayment): void
    {
        //
        $contractPayment->status = ContractPaymentStatus::Unpaid;
    }
    /**
     * Handle the ContractPayment "created" event.
     */
    public function created(ContractPayment $contractPayment): void
    {
        //
        if($contractPayment->license?->count())
        {
            if(!auth('admin')->user()->checkIsSuperAdmin() && !auth('admin')->user()->managerContract())
            {
                $admin = Admin::manager(RoleManager::Contract)->get();
                
                Notification::send($admin, new UploadLicense($contractPayment));
            }
        }
    }

    /**
     * Handle the ContractPayment "updated" event.
     */
    public function updated(ContractPayment $contractPayment): void
    {
        if($contractPayment->wasChanged('license') && $contractPayment->unpaid() && $contractPayment->license?->count())
        {
            if(auth('admin')->user()->checkIsSuperAdmin() == false && auth('admin')->user()->managerContract() == false)
            {
                $admin = Admin::manager(RoleManager::Contract)->get();

                Notification::send($admin, new UploadLicense($contractPayment));
            }
        }

        if($contractPayment->wasChanged('status') && $contractPayment->paid())
        {
            $contractPayment->admin?->notify(new AcceptLicense($contractPayment));
            
            if($contractPayment->period == 1)
            {
                $contractPayment->contract()->update([
                    'status' => ContractStatus::Processing
                ]);
            }else if($contractPayment->period == ContractPayment::where('contract_id', $contractPayment->contract_id)->count()) {
                $contractPayment->contract()->update([
                    'status' => ContractStatus::Completed
                ]);
            }
        }
    }

    /**
     * Handle the ContractPayment "deleted" event.
     */
    public function deleted(ContractPayment $contractPayment): void
    {
        //
    }

    /**
     * Handle the ContractPayment "restored" event.
     */
    public function restored(ContractPayment $contractPayment): void
    {
        //
    }

    /**
     * Handle the ContractPayment "force deleted" event.
     */
    public function forceDeleted(ContractPayment $contractPayment): void
    {
        //
    }
}
