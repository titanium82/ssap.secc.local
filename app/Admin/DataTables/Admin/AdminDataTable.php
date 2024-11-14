<?php

namespace App\Admin\DataTables\Admin;

use App\Core\DataTables\DataTables;
use App\Core\Enums\Gender;
use App\Admin\Repositories\Admin\AdminRepositoryInterface;

class AdminDataTable extends DataTables
{

    public function __construct(
        public AdminRepositoryInterface $repository
    )
    {
    }

    protected function setViewColumns(): void
    {
        $this->viewColumns = [
            'action'        => 'admin.admins.datatable.action',
            'fullname'      => 'admin.admins.datatable.fullname',
            'department'    => 'admin.admins.datatable.department',
        ];
    }

    protected function setColumnHasSearch(): void
    {
        $this->columnHasSearch = ['fullname', 'phone', 'email', 'gender', 'created_at'];
    }

    protected function setColumnSearchDate(): void
    {
        $this->columnSearchDate = ['created_at'];
    }

    protected function setColumnSearchSelect(): void
    {
        $this->columnSearchSelect = [
            'gender' => [
                'data' => Gender::asSelectArray()
            ]
        ];
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
            'fullname' => $this->viewColumns['fullname'],
            'admin[department_id]'=>$this->viewColumns['department'],
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
        $this->rawColumns = ['fullname','department_id', 'action'];
    }
}
