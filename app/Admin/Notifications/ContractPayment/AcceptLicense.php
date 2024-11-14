<?php

namespace App\Admin\Notifications\ContractPayment;

use App\Admin\Notifications\Notify;
use App\Models\ContractPayment;

class AcceptLicense extends Notify
{
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(
        public ContractPayment $contractPayment
    )
    {
        //
    }

    protected function setTitle(): void
    {
        $this->title = trans('Contract payment period accept license.');
    }

    protected function setSubTitle(): void
    {
        $this->subTitle = trans('Contract payment period :num accept license.', ['num' => $this->contractPayment->period]);
    }

    protected function setUrl(): void
    {
        $this->url = route('admin.contract_payment.show', $this->contractPayment->id);
    }
}