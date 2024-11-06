<?php

namespace App\Admin\DataTables\Contract;

use App\Admin\Enums\Contract\ContractStatus;
use App\Core\DataTables\DataTables;
use App\Admin\Repositories\Contract\ContractRepositoryInterface;

class ContractDataTable extends DataTables
{

    // protected string $dataTableVariable = 'dataTable';

    public function __construct(
        public ContractRepositoryInterface $repository
    ){
        $this->repository = $repository;
    }

    protected function setViewColumns(): void
    {
        $this->viewColumns = [
            'action'            => 'admin.contracts.datatable.action',
            'code'              => 'admin.contracts.datatable.code',
            'contract_type'     => 'admin.contracts.datatable.contract-type',
            'customer'          => 'admin.contracts.datatable.customer',
            'short_name'        =>  'admin.contracts.datable.short-name',
            'status'            => 'admin.contracts.datatable.status',
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
        $this->columnHasSearch = ['code', 'name', 'short_name','contract_type_id', 'customer_id', 'status', 'admin_id', 'created_at'];
    }

    protected function setColumnSearchDate(): void
    {
        $this->columnSearchDate = ['created_at'];
    }

    protected function setColumnSearchSelect(): void
    {
        $this->columnSearchSelect = [
            'status' => [
                'data' => ContractStatus::asSelectArray()
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
        return $this->repository->getByQueryBuilder([], ['type', 'customer', 'sharers', 'admin'])->currentAuth();
    }

    protected function setFilterColumns(): void
    {
        $this->filterColumns = [
            'admin_id' => fn($q, $k) => $q->whereRelation('admin', 'fullname', 'like', "%$k%")
        ];
    }

    protected function setEditColumns(): void
    {
        $this->editColumns = [
            'code' => $this->viewColumns['code'],
            'contract_type_id' => $this->viewColumns['contract_type'],
            'customer_id' => $this->viewColumns['customer'],
            'admin_id' => fn($item) => $item->admin->fullname,
            'status' => $this->viewColumns['status'],
            'created_at' => '{{ date(config("core.format.date"), strtotime($created_at)) }}'
        ];
    }

    protected function setAddColumns(): void
    {
        $this->addColumns = [
            'action' => $this->viewColumns['action'],
        ];
    }

    protected function setRawColumns(): void
    {
        $this->rawColumns = ['code', 'contract_type_id', 'customer_id', 'status', 'action'];
    }
}
