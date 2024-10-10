<?php

namespace App\Admin\Jobs\ContractPayment;

use App\Admin\Enums\Role\RoleManager;
use App\Admin\Notifications\ContractPayment\NotifyExperied;
use App\Models\Admin;
use App\Models\ContractPayment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ScanStatusLate implements ShouldQueue
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
        $managerContract = $this->repoAdmin->getLazyByIdManager(RoleManager::Contract, ScanStatusLate::SIZE_LAZY)->chunk(ScanStatusLate::SIZE_CHUNK);
        
        $wrongStatusLate = $this->repo->getLazyByIdWrongStatusLate(ScanStatusLate::SIZE_LAZY, ['admin'])->chunk(ScanStatusLate::SIZE_CHUNK);

        foreach($wrongStatusLate as $contractPayments)
        {
            foreach($managerContract as $mcs)
            {
                SendNotifyStatusLate::dispatch($mcs, $contractPayments);

                $this->handleDuplicateMC($contractPayments, $mcs);
            }
        }

        $this->repo->updateWrongStatusLate();

    }

    private function handleDuplicateMC($contractPayments, $mcs)
    {
        foreach($contractPayments as $cp)
        {
            if($cp->admin && !$mcs->contains($cp->admin))
            {
                $cp->admin->notify(new NotifyExperied($cp));
            }
        }
    }
}


//cursor: khi nao gọi tới nó thì nó sẽ lấy tất cả record ra.
//lazy: khi nào gọi tới nó thì nó sẽ lấy lần lượt số record config trên đó và nó lấy đến khi hết thì thôi và sau đó no merge thành 1 collection. Nó query bằng cách limit và offset
//lazyById: khi nào gọi tới nó thì nó sẽ lấy lần lượt số record config trên đó và nó lấy đến khi hết thì thôi và sau đó no merge thành 1 collection. Nó query bằng cách limit và lấy id lớn hơn trong collect trước đó
//ChunkById: Giống như lazy nhưng nó query theo limit và lấy id lớn hơn trong collect trước đó
//chunk: giống như lazy nhưng query theo limit và sắp xếp theo id.