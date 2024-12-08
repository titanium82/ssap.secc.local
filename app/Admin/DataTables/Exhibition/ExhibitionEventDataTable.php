<?php

namespace App\Admin\DataTables\Exhibition;

use App\Admin\Enums\ExhibitionEvent\EventStatus;
use App\Admin\Repositories\Exhibition\ExhibitionEventRepositoryInterface;
use App\Core\DataTables\DataTables;

class ExhibitionEventDataTable extends DataTables
{
    public function __construct(
        public ExhibitionEventRepositoryInterface $repository
    )
    {
    }

    protected function setViewColumns(): void
    {
        $this->viewColumns = [
            'name'      => 'admin.exhibitions.events.datatable.name',
            'location'  => 'admin.exhibitions.events.datatable.location',
            'customer'  => 'admin.exhibitions.events.datatable.customer',
            'action'    => 'admin.exhibitions.events.datatable.action',
            'status'    =>  'admin.exhibitions.events.datatable.status',
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
        $this->columnHasSearch = ['name','exhibitionlocations','customer_id','locations','status','admin_id','created_at'];
    }

    protected function setColumnSearchDate(): void
    {
        $this->columnSearchDate = ['created_at'];
    }
    protected function setColumnSearchSelect(): void
    {
        $this->columnSearchSelect = [
            'status' => [
                'data' => EventStatus::asSelectArray()
            ]
        ];
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
        return $this->repository->getByQueryBuilder([],['exhibitionlocations', 'customer', 'admin']); //khai báo từ model cho relationship one to many
    }
    protected function setFilterColumns(): void
    {
        $this->filterColumns = [
            'exhibitionlocations'    => fn($q, $keyword)    => $q->whereRelation('exhibitionlocations', 'fullname', 'like', "%{$keyword}%"),
            'customer_id'            => fn($q, $keyword)    => $q->whereRelation('customer', 'short_name', 'like', "%{$keyword}%"),
            'admin_id'               => fn($q, $k)          => $q->whereRelation('admin', 'fullname', 'like', "%$k%")
        ];
    }
    protected function setEditColumns(): void
    {
        $this->editColumns = [
            'name'                              =>$this->viewColumns['name'],
            'exhibitionlocations'               =>$this->viewColumns['location'],
            'customer_id'                       =>$this->viewColumns['customer'],
            'status'                            =>$this->viewColumns['status'],
            'admin_id'                          => fn($item) => $item->admin->fullname,
            'created_at'                        => '{{ date(config("core.format.date"), strtotime($created_at)) }}'
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
        $this->rawColumns = ['name','exhibitionlocations','customer_id','status','action'];
    }
}
