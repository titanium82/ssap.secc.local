<?php

namespace App\Admin\DataTables\EventService;

use App\Admin\Repositories\EventService\EventServiceUnitRepositoryInterface;
use App\Core\DataTables\DataTables;

class EventServiceUnitDataTable extends DataTables
{
    public function __construct(
        public EventServiceUnitRepositoryInterface $repository
    )
    {
    }

    protected function setViewColumns(): void
    {
        $this->viewColumns = [
            'action'    => 'admin.eventservices.units.datatable.action',
            'unit'      => 'admin.eventservices.units.datatable.unit',
            'type'      => 'admin.eventservices.units.datatable.type',
            'desc'      => 'admin.eventservices.units.datatable.desc',

        ];
    }

    protected function setColumnHasSearch(): void
    {
        $this->columnHasSearch = ['unit', 'created_at'];
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
        return $this->repository->getByQueryBuilder([], ['type']);
    }

    protected function setEditColumns(): void
    {
        $this->editColumns = [
            'unit'                  => $this->viewColumns['unit'],
            'event_service_type_id' => $this->viewColumns['type'],
            'created_at'            => '{{ date(config("core.format.date"), strtotime($created_at)) }}'
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
        $this->rawColumns = ['unit','event_service_type_id','action'];
    }
}
