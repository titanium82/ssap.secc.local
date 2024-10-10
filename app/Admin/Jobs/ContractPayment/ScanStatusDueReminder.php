<?php

namespace App\Admin\Jobs\ContractPayment;

use App\Admin\Enums\Role\RoleManager;
use App\Admin\Notifications\ContractPayment\NotifyDueReminder;
use App\Models\Admin;
use App\Models\ContractPayment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ScanStatusDueReminder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    const SIZE_LAZY = 200;

    const SIZE_CHUNK = 20;

    private $repo;
    private $repoAdmin;
    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        $this->repo = app()->make('App\Admin\Repositories\Contract\ContractPaymentRepositoryInterface');

        $this->repoAdmin = app()->make('App\Admin\Repositories\Admin\AdminRepositoryInterface');
    }

    /**
     * Execute the job.
     */

    public function handle(): void
    {
        $managerContract = $this->repoAdmin->getLazyByIdManager(RoleManager::Contract, ScanStatusDueReminder::SIZE_LAZY)->chunk(ScanStatusDueReminder::SIZE_CHUNK);
        
        $dueReminder = $this->repo->getLazyByIdDueReminder(ScanStatusDueReminder::SIZE_LAZY, ['admin', 'contract.customer'])
        ->chunk(ScanStatusDueReminder::SIZE_CHUNK);
        
        foreach($dueReminder as $contractPayments)
        {
            if($managerContract->count() == 0)
            {
                SendNotifyDueReminder::dispatch(collect([]), $contractPayments);

                $this->handleDuplicateMC($contractPayments, collect([]));
            }else {
                
                foreach($managerContract as $mcs)
                {
                    SendNotifyDueReminder::dispatch($mcs, $contractPayments);
    
                    $this->handleDuplicateMC($contractPayments, $mcs);
                }
            }
        }
    }

    private function handleDuplicateMC($contractPayments, $mcs)
    {
        foreach($contractPayments as $cp)
        {
            if($cp->admin && $mcs->contains($cp->admin) == false)
            {
                $cp->admin->notify(new NotifyDueReminder($cp));
            }
        }
    }
}


//cursor: khi nao gọi tới nó thì nó sẽ lấy tất cả record ra.
//lazy: khi nào gọi tới nó thì nó sẽ lấy lần lượt số record config trên đó và nó lấy đến khi hết thì thôi và sau đó no merge thành 1 collection. Nó query bằng cách limit và offset
//lazyById: khi nào gọi tới nó thì nó sẽ lấy lần lượt số record config trên đó và nó lấy đến khi hết thì thôi và sau đó no merge thành 1 collection. Nó query bằng cách limit và lấy id lớn hơn trong collect trước đó
//ChunkById: Giống như lazy nhưng nó query theo limit và lấy id lớn hơn trong collect trước đó
//chunk: giống như lazy nhưng query theo limit và sắp xếp theo id.