<?php

namespace App\Admin\DataTables\Customer;

use App\Core\DataTables\DataTables;
use App\Admin\Repositories\Customer\CustomerContactRepositoryInterface;

class CustomerContactDataTable extends DataTables
{

    // protected string $dataTableVariable = 'dataTable';

    public function __construct(
        public CustomerContactRepositoryInterface $repository
    ){
    }

    protected function setViewColumns(): void
    {
        $this->viewColumns = [
            'action' => 'admin.customers.contacts.datatable.action',
            'fullname' => 'admin.customers.contacts.datatable.fullname',
            'customer' => 'admin.customers.contacts.datatable.customer',
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
        $this->columnHasSearch = ['fullname', 'email', 'phone', 'customer_id', 'admin_id', 'created_at'];
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
        return $this->repository->getByQueryBuilder([], ['customer', 'admin']);
    }

    protected function setEditColumns(): void
    {
        $this->editColumns = [
            'fullname' => $this->viewColumns['fullname'],
            'customer_id' => $this->viewColumns['customer'],
            'admin_id' => fn($item) => $item->admin->fullname,
            'created_at' => '{{ date(config("core.format.date"), strtotime($created_at)) }}',
            'birthday' => '{{ date(config("core.format.date"), strtotime($birthday)) }}'
        ];
    }

    protected function setFilterColumns(): void
    {
        $this->filterColumns = [
            'customer_id' => fn($q, $k) => $q->whereRelation('customer', 'fullname', 'like', "%$k%"),
            'admin_id' => fn($q, $k) => $q->whereRelation('admin', 'fullname', 'like', "%$k%")
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
        $this->rawColumns = ['fullname', 'customer_id', 'action'];
    }
}