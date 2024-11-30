<?php

namespace App\Admin\DataTables\Warehouse;

use App\Core\DataTables\DataTables;
use App\Models\Warehouse;

class WarehouseDataTable extends DataTables
{

    public function __construct(
        public Warehouse $model
    ){
    }

    protected function setViewColumns(): void
    {
        $this->viewColumns = [
            'action'    => 'admin.warehouses.datatable.action',
            'name'      => 'admin.warehouses.datatable.name',
            'shortname' => 'admin.warehouses.datatable.shortname',

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
