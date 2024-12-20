<?php

namespace App\Admin\DataTables\ExhibitionLocation;

use App\Core\DataTables\DataTables;
use App\Models\ExhibitionLocation;

class ExhibitionLocationDataTable extends DataTables
{

    // protected string $dataTableVariable = 'dataTable';

    public function __construct(
        public ExhibitionLocation $model
    ){
    }

    protected function setViewColumns(): void
    {
        $this->viewColumns = [
            'name' => 'admin.exhibition_locations.datatable.name',
            'location' => 'admin.exhibition_locations.datatable.location',
            'action' => 'admin.exhibition_locations.datatable.action',
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
        return $this->model->orderBy('id', 'desc');
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
