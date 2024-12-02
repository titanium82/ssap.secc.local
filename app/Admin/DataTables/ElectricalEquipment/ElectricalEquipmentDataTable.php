<?php

namespace App\Admin\DataTables\ElectricalEquipment;

use App\Core\DataTables\DataTables;
use App\Admin\Repositories\ElectricalEquipment\ElectricalEquipmentRepositoryInterface;

class ElectricalEquipmentDataTable extends DataTables
{
    public function __construct(
        public ElectricalEquipmentRepositoryInterface $repository
    ){
    }

    protected function setViewColumns(): void
    {
        $this->viewColumns = [
            'action'    => 'admin.electricalequipments.datatable.action',
            'name'      => 'admin.electricalequipments.datatable.name',
            'type'      => 'admin.electricalequipments.datatable.type',
            'price'     => 'admin.electricalequipments.datatable.price',
            'desc'      => 'admin.electricalequipments.datatable.desc',

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
        $this->columnHasSearch = ['name','electrical_equipment_type_id','desc','admin_id','created_at'];
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
        return $this->repository->getByQueryBuilder([],['type', 'admin']); 
    }
    protected function setFilterColumns(): void
    {
        $this->filterColumns = [
            'electrical_equipment_type_id'   => fn($q, $keyword)    => $q->whereRelation('electrical_equipment_types', 'name', 'like', "%{$keyword}%"),
            'admin_id'                       => fn($q, $k)          => $q->whereRelation('admin', 'fullname', 'like', "%$k%")
        ];
    }
    protected function setEditColumns(): void
    {
        $this->editColumns = [
            'name'                          =>$this->viewColumns['name'],
            'electrical_equipment_type_id'  =>$this->viewColumns['type'],
            'price'                         =>fn($cp) =>format_price($cp->price, '', $cp->contract?->currency->name), //hiển thị dạng tiền tệ cho bảng datatable
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
        $this->rawColumns = ['name','electrical_equipment_type_id', 'action'];
    }
}
