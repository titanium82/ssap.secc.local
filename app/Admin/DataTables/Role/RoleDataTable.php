<?php

namespace App\Admin\DataTables\Role;

use App\Core\DataTables\DataTables;
use App\Admin\Repositories\Role\RoleRepositoryInterface;

class RoleDataTable extends DataTables
{

    public function __construct(
        public RoleRepositoryInterface $repository
    ){
    }

    protected function setViewColumns(): void
    {
        $this->viewColumns = [
            'action' => 'admin.roles.datatable.action',
            'name' => 'admin.roles.datatable.name',
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