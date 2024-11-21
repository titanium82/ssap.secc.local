<?php

namespace App\Admin\DataTables\EventService;

use App\Admin\Repositories\EventService\EventServiceRepositoryInterface;
use App\Core\DataTables\DataTables;

class EventServiceDataTable extends DataTables
{
    public function __construct(
        public EventServiceRepositoryInterface $repository
    ){
    }

    protected function setViewColumns(): void
    {
        $this->viewColumns = [
            'action'     => 'admin.eventservices.datatable.action',
            'name'       => 'admin.eventservices.datatable.name',
            'type'       => 'admin.eventservices.datatable.type',

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
        $this->columnHasSearch = ['name','event_service_type_id', 'created_at'];
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
            'name'                  => $this->viewColumns['name'],
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
        $this->rawColumns = ['name','event_service_type_id', 'action'];
    }
}
