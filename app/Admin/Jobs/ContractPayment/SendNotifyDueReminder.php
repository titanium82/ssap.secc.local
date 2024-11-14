<?php

namespace App\Admin\Jobs\ContractPayment;

use App\Admin\Mail\Contract\ContractPaymentPeriod;
use App\Admin\Notifications\ContractPayment\NotifyDueReminder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class SendNotifyDueReminder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public $managerContracts,
        public $contractPayments
    )
    {
        $this->managerContracts = $this->managerContracts->collect();
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        foreach($this->contractPayments as $contractPayment)
        {
            if($this->managerContracts->count() > 0)
            {
                Notification::send($this->managerContracts, new NotifyDueReminder($contractPayment));
            }

            if($email = $contractPayment->getEmailCustomer())
            {
                Mail::to($email)->send(
                    new ContractPaymentPeriod(
                        trans('Contract payment due reminder.'), 
                        trans('Contract payment period :num has :day left to expire.', ['num' => $contractPayment->period, 'day' => 15]), 
                        [], [], $contractPayment
                    )
                );
            }
        } 
    }
}
