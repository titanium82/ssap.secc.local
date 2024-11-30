<?php

namespace App\Admin\DataTables\ElectricalEquipment;

use App\Core\DataTables\DataTables;
use App\Models\ElectricalEquipmentType;

class ElectricalEquipmentTypeDataTable extends DataTables
{
    public function __construct(
        public ElectricalEquipmentType $model
    ){
    }

    protected function setViewColumns(): void
    {
        $this->viewColumns = [
            'action'    => 'admin.electricalequipments.types.datatable.action',
            'name'      => 'admin.electricalequipments.types.datatable.name',
            'desc'      => 'admin.electricalequipments.types.datatable.desc',

        ];
    }

    protected function setColumnHasSearch(): void
    {
        $this->columnHasSearch = ['name','desc', 'created_at'];
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
