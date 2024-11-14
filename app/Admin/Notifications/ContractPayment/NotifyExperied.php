<?php

namespace App\Admin\Notifications\ContractPayment;

use App\Admin\Notifications\Notify;
use App\Models\ContractPayment;

class NotifyExperied extends Notify
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

    public function via($notifiable): array
    {
        return ['database'];
    }

    protected function setTitle(): void
    {
        $this->title = trans('Contract payment period expired.');
    }

    protected function setSubTitle(): void
    {
        $this->subTitle = trans('Contract payment period :num expired.', ['num' => $this->contractPayment->period]);
    }

    protected function setUrl(): void
    {
        $this->url = route('admin.contract_payment.show', $this->contractPayment->id);
    }
}