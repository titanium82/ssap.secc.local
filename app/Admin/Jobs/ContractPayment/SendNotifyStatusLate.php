<?php

namespace App\Admin\Jobs\ContractPayment;

use App\Admin\Mail\Contract\ContractPaymentPeriod;
use App\Admin\Notifications\ContractPayment\NotifyExperied;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class SendNotifyStatusLate implements ShouldQueue
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
            Notification::send($this->managerContracts, new NotifyExperied($contractPayment));

            if($email = $contractPayment->getEmailCustomer())
            {
                Mail::to($email)->send(
                    new ContractPaymentPeriod(
                        trans('Contract payment Expired.'), 
                        trans('Contract payment period :num expired.', ['num' => $contractPayment->period]), 
                        [], [], $contractPayment
                    )
                );
            }
        }
        
    }
}
