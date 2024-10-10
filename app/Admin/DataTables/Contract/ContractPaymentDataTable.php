<?php

namespace App\Admin\DataTables\Contract;

use App\Admin\Enums\Contract\ContractPaymentStatus;
use App\Core\DataTables\DataTables;
use App\Admin\Repositories\Contract\ContractPaymentRepositoryInterface;

class ContractPaymentDataTable extends DataTables
{

    // protected string $dataTableVariable = 'dataTable';

    public function __construct(
        public ContractPaymentRepositoryInterface $repository
    ){
    }

    protected function setViewColumns(): void
    {
        $this->viewColumns = [
            'action' => 'admin.contracts.payments.datatable.action',
            'code_contract' => 'admin.contracts.payments.datatable.code-contract',
            'status' => 'admin.contracts.payments.datatable.status',
        ];
    }

    protected function setRemoveColumns(): void
    {
        if(auth('admin')->user()->checkIsSuperAdmin() == false || auth('admin')->user()->managerContract())
        {
            $this->removeColumns = ['admin_id'];
        }
    }

    protected function setColumnHasSearch(): void
    {
        $this->columnHasSearch = ['contract_id', 'period', 'expired_at', 'status', 'admin_id', 'created_at'];
    }

    protected function setColumnSearchDate(): void
    {
        $this->columnSearchDate = ['expired_at', 'created_at'];
    }

    protected function setColumnSearchSelect(): void
    {
        $this->columnSearchSelect = [
            'status' => [
                'data' => ContractPaymentStatus::asSelectArray()
            ]
        ];
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Admin $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return $this->repository->getByQueryBuilder([], ['contract.currency', 'admin'])->currentAuth();
    }

    protected function setFilterColumns(): void
    {
        $this->filterColumns = [
            'contract_id' => fn($q, $k) => $q->whereRelation('contract', 'code', 'like', "%$k%"),
            'admin_id' => fn($q, $k) => $q->whereRelation('admin', 'fullname', 'like', "%$k%")
        ];
    }

    protected function setEditColumns(): void
    {
        $this->editColumns = [
            'contract_id' => $this->viewColumns['code_contract'],
            'status' => $this->viewColumns['status'],
            'amount' => fn($cp) => format_price($cp->amount, '', $cp->contract?->currency->name),
            'admin_id' => fn($item) => $item->admin->fullname,
            'expired_at' => fn($cp) => $cp->expired_at->format(config('core.format.date')),
            'created_at' => fn($cp) => $cp->created_at->format(config('core.format.date'))
        ];
    }

    protected function setAddColumns(): void
    {
        $this->addColumns = [
            'action' => fn($contract_payment) => view($this->viewColumns['action'])->with('contract_payment', $contract_payment),
        ];
    }

    protected function setRawColumns(): void
    {
        $this->rawColumns = ['contract_id', 'status', 'action'];
    }
}