<?php

namespace App\Admin\DataTables\Admin;

use App\Core\DataTables\DataTables;
use App\Models\Department;

class DepartmentDataTable extends DataTables
{

    public function __construct(
        public Department $model
    ){
    }

    protected function setViewColumns(): void
    {
        $this->viewColumns = [
            'action'    => 'admin.admins.departments.datatable.action',
            'name'      => 'admin.admins.departments.datatable.name',
            'shortname' => 'admin.admins.departments.datatable.shortname',

        ];
    }

    protected function setColumnHasSearch(): void
    {
        $this->columnHasSearch = ['name','created_at'];
    }

    protected function setColumnSearchDate(): void
    {
        $this->columnSearchDate = ['created_at'];
    }

    // protected function setColumnSearchSelect(): void
    // {
    //     $this->columnSearchSelect = [
    //         'gender' => [
    //             'data' => Gender::asSelectArray()
    //         ]
    //     ];
    // }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Admin $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return $this->model->orderBy('id', 'desc');
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
