<?php

namespace App\Admin\Notifications\ContractPayment;

use App\Admin\Notifications\Notify;
use App\Models\ContractPayment;

class NotifyDueReminder extends Notify
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
        $this->title = trans('Contract payment due reminder.');
    }

    protected function setSubTitle(): void
    {
        $this->subTitle = trans('Contract payment period :num has :day left to expire.', ['num' => $this->contractPayment->period, 'day' => 15]);
    }

    protected function setUrl(): void
    {
        $this->url = route('admin.contract_payment.show', $this->contractPayment->id);
    }
}