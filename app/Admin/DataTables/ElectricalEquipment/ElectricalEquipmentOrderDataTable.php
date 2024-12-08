<?php

namespace App\Admin\DataTables\ElectricalEquipment;

use App\Core\DataTables\DataTables;
use App\Admin\Repositories\ElectricalEquipment\ElectricalEquipmentOrderRepositoryInterface;

class ElectricalEquipmentOrderDataTable extends DataTables
{
    public function __construct(
        public ElectricalEquipmentOrderRepositoryInterface $repository
    ){
    }

    protected function setViewColumns(): void
    {
        $this->viewColumns = [
            'action'                 => 'admin.electricalequipments.orders.datatable.action',
            'code'                   => 'admin.electricalequipments.orders.datatable.code',
            'exhibitionevent'        => 'admin.electricalequipments.orders.datatable.exhibitionevent',
            'customer'               => 'admin.electricalequipments.orders.datatable.customer',
            'booth_no'               => 'admin.electricalequipments.orders.datatable.booth',
            'contact_fullname'       => 'admin.electricalequipments.orders.datatable.contact_fullname',
            'contact_phone'          => 'admin.electricalequipments.orders.datatable.contact_phone',

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
        $this->columnHasSearch = ['code','contact_fullname','contact_phone','admin_id','customer_id','exhibition_event_id','created_at'];
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
        return $this->repository->getByQueryBuilder([],['customer', 'admin','exhibitionevent']); 
    }
    protected function setFilterColumns(): void
    {
        $this->filterColumns = [
            'customer_id'                    => fn($q, $keyword)    => $q->whereRelation('customer', 'name', 'like', "%{$keyword}%"),
            'exhibition_event_id'            => fn($q, $keyword)    => $q->whereRelation('exhibitionevent', 'name', 'like', "%{$keyword}%"),
            'admin_id'                       => fn($q, $k)          => $q->whereRelation('admin', 'fullname', 'like', "%$k%")
        ];
    }
    protected function setEditColumns(): void
    {
        $this->editColumns = [
            'code'                          =>$this->viewColumns['code'],
            'customer_id'                   =>$this->viewColumns['customer'],
            'exhibition_event_id'           =>$this->viewColumns['exhibitionevent'],
            'amount'                        =>fn($cp) =>format_price($cp->price, '', $cp->contract?->currency->name), //hiển thị dạng tiền tệ cho bảng datatable
            'total_amount'                  =>fn($cp) =>format_price($cp->price, '', $cp->contract?->currency->name), //hiển thị dạng tiền tệ cho bảng datatable
            'admin_id'                      => fn($item) => $item->admin->fullname,
            'created_at'                    => '{{ date(config("core.format.date"), strtotime($created_at)) }}'
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
        $this->rawColumns = ['code','customer_id','exhibition_event_id', 'action'];
    }
}
