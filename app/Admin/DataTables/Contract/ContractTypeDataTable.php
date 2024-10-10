<?php

namespace App\Admin\DataTables\Contract;

use App\Core\DataTables\DataTables;
use App\Admin\Repositories\Contract\ContractTypeRepositoryInterface;

class ContractTypeDataTable extends DataTables
{

    // protected string $dataTableVariable = 'dataTable';

    public function __construct(
        public ContractTypeRepositoryInterface $repository
    ){
    }

    protected function setViewColumns(): void
    {
        $this->viewColumns = [
            'action' => 'admin.contracts.types.datatable.action',
            'name' => 'admin.contracts.types.datatable.name',
        ];
    }

    protected function setColumnHasSearch(): void
    {
        $this->columnHasSearch = ['name', 'short_name', 'created_at'];
    }

    protected function setColumnSearchDate(): void
    {
        $this->columnSearchDate = ['created_at'];
    }

    // protected function urlFetchData(): void
    // {
    //     $this->urlFetchData = route('admin.admin.index');
    // }
    
    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Admin $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return $this->repository->orderBy('id', 'desc');
    }

    protected function setEditColumns(): void
    {
        $this->editColumns = [
            'name' => $this->viewColumns['name'],
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
        $this->rawColumns = ['name', 'action'];
    }
}