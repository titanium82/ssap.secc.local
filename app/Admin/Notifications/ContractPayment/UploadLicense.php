<?php

namespace App\Admin\Notifications\ContractPayment;

use App\Admin\Notifications\Notify;
use App\Models\ContractPayment;

class UploadLicense extends Notify
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
        $this->title = trans('Contract payment period upload license.');
    }

    protected function setSubTitle(): void
    {
        $this->subTitle = trans('Contract payment period :num upload license.', ['num' => $this->contractPayment->period]);
    }

    protected function setUrl(): void
    {
        $this->url = route('admin.contract_payment.edit', $this->contractPayment->id);
    }
}