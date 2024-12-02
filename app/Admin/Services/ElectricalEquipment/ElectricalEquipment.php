<?php

namespace App\Admin\Services\ElectricalEquipment;

use App\Admin\Repositories\ElectricalEquipment\ElectricalEquipmentRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ElectricalEquipment
{
    public function __construct(
        public ElectricalEquipmentRepositoryInterface $repo
    )
    {

    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {

            $data = $request->validated();

            $types = $data['electrical_equipment_type_id'];

            $electricalequipments = $this->repo->create($data);

            logger()->info(trans('User ID :uid add customer ID :cid', [
                'uid' => auth('admin')->id(),
                'cid' => $electricalequipments->id
            ]), [
                'user' => auth('admin')->user()->toArray(),
                'request' => $request->all()
            ]);

            DB::commit();
            return $eventservices;

        } catch (\Throwable $th) {

            logger()->error(trans('Add Event Services has error :err', ['err' => $th->getMessage()]), [
                'user' => auth('admin')->user()->toArray(),
                'request' => $request->all()
            ]);

            DB::rollBack();
            throw $th;
        }
        DD();
    }

    public function update(Request $request)
    {
        DB::beginTransaction();
        try {

            $data = $request->validated();

            $types = $data['electrical_equipment_type_id'];

            $electricalequipments = $this->repo->update($data['id'], $data);

            // $eventservices->type()->sync($types);

            logger()->info(trans('User ID :uid update customer ID :cid', [
                'uid' => auth('admin')->id(),
                'cid' => $electricalequipments->id
            ]), [
                'user' => auth('admin')->user()->toArray(),
                'request' => $request->all()
            ]);

            DB::commit();
            return $electricalequipments;

        } catch (\Throwable $th) {

            logger()->error(trans('Update customer has error :err', ['err' => $th->getMessage()]), [
                'user' => auth('admin')->user()->toArray(),
                'request' => $request->all()
            ]);

            DB::rollBack();
            throw $th;
        }
    }
}
