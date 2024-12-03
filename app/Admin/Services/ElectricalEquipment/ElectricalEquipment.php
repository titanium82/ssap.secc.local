<?php

namespace App\Admin\Services\ElectricalEquipment;

use App\Admin\Repositories\ElectricalEquipment\ElectricalEquipmentRepositoryInterface;
use App\Admin\Repositories\ElectricalEquipment\ElectricalEquipmentTypeRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ElectricalEquipment
{
    public function __construct(
        public ElectricalEquipmentRepositoryInterface $repository,
        public ElectricalEquipmentTypeRepositoryInterface $repoElectricalEquipmentType,
    )
    {

    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {

            $data = $request->validated();

            $electricalequipments = $this->repository->create($data);

            $adminId = auth('admin')->id();

            DB::commit();
            return $electricalequipments;

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

            $types = $data['electrical_equipment_type_id'];

            $electricalequipments = $this->repository->update($data['id'], $data);;
            // $eventservices->type()->sync($types);
            DB::commit();
            return $electricalequipments;
        } catch (\Throwable $th) {

            DB::rollBack();
            throw $th;
        }
    }
}
