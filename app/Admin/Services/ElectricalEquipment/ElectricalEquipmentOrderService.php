<?php

namespace App\Admin\Services\ElectricalEquipment;

use App\Admin\Repositories\Customer\CustomerRepositoryInterface;
use App\Admin\Repositories\ElectricalEquipment\ElectricalEquipmentOrderRepositoryInterface;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ElectricalEquipmentOrderService
{
    public function __construct(
        public ElectricalEquipmentOrderRepositoryInterface $repository,
        public CustomerRepositoryInterface $repoCustomer,
    )
    {

    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {

            $data = $request->validated();

            $electricalequipmentorders = $this->repository->create($data['electricalequipment']);
            // $electricalequipmentorders->electricalequipments()->attach($data['electrical_equipment_id']);
            $adminId = auth('admin')->id();

            DB::commit();
            return $electricalequipmentorders;

        } catch (\Throwable $th) {

            DB::rollBack();
            throw $th;
        }
    }

    public function update(Request $request)
    {
        DB::beginTransaction();
        try {

            $data = $request->validated();

            $electricalequipmentorders = $this->repository->update($request->id, $data['electricalequipment']);

            $electricalequipmentorders->electricalequipments()->sync($data['electrical_equipment_id']);

            // $eventservices->type()->sync($types);
            DB::commit();
            return $electricalequipmentorders;
        } catch (\Throwable $th) {

            DB::rollBack();
            throw $th;
        }
    }
}
