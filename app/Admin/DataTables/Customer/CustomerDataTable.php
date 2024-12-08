<?php

namespace App\Admin\DataTables\Customer;

use App\Core\DataTables\DataTables;
use App\Admin\Repositories\Customer\CustomerRepositoryInterface;

class CustomerDataTable extends DataTables
{
    public function __construct(
        public CustomerRepositoryInterface $repository
    )
    {
    }

    protected function setViewColumns(): void
    {
        $this->viewColumns = [
            'action'    => 'admin.customers.datatable.action',
            'fullname'  => 'admin.customers.datatable.fullname',
            'type'      => 'admin.customers.datatable.type',
            'sectors'   => 'admin.customers.datatable.sectors',
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
        $this->columnHasSearch = ['fullname', 'short_name', 'email', 'phone', 'customer_type_id', 'sectors', 'admin_id', 'created_at'];
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
        return $this->repository->getByQueryBuilder([], ['type', 'sectors', 'admin']);
    }

    protected function setFilterColumns(): void
    {
        $this->filterColumns = [
            'customer_type_id'  => fn($q, $keyword) => $q->whereRelation('type', 'name', 'like', "%{$keyword}%"),
            'sectors'           => fn($q, $keyword) => $q->whereRelation('sectors', 'name', 'like', "%{$keyword}%"),
            'admin_id'          => fn($q, $k) => $q->whereRelation('admin', 'fullname', 'like', "%$k%")
        ];
    }

    protected function setEditColumns(): void
    {
        $this->editColumns = [
            'fullname'          => $this->viewColumns['fullname'],
            'customer_type_id'  => $this->viewColumns['type'],
            'sectors'           => $this->viewColumns['sectors'],
            'admin_id'          => fn($item) => $item->admin->fullname,
            'created_at'        => '{{ date(config("core.format.date"), strtotime($created_at)) }}'
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
        $this->rawColumns = ['fullname', 'customer_type_id', 'sectors', 'action'];
    }
}