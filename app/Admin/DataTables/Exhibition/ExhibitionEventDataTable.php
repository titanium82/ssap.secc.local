<?php

namespace App\Admin\DataTables\Exhibition;

use App\Admin\Repositories\Exhibition\ExhibitionEventRepositoryInterface;
use App\Core\DataTables\DataTables;

class ExhibitionEventDataTable extends DataTables
{

    // protected string $dataTableVariable = 'dataTable';

    public function __construct(
        public ExhibitionEventRepositoryInterface $repository
    )
    {
        $this->repository = $repository;
    }

    protected function setViewColumns(): void
    {
        $this->viewColumns = [
            'name'      => 'admin.exhibitions.events.datatable.name',
            'location'  => 'admin.exhibitions.events.datatable.location',
            'action'    => 'admin.exhibitions.events.datatable.action',
        ];
    }

    protected function setColumnHasSearch(): void
    {
        $this->columnHasSearch = ['name', 'created_at'];
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
        return $this->repository->getByQueryBuilder([], ['customer', 'admin'])->currentAuth();
    }

    protected function setEditColumns(): void
    {
        $this->editColumns = [
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
        $this->rawColumns = ['action'];
    }
}
