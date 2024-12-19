<?php

namespace App\Admin\Services\ElectricalEquipment;

use App\Admin\Repositories\ElectricalEquipment\ElectricalEquipmentTypeRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ElectricalEquipmentTypeService
{
    public function __construct(
        public ElectricalEquipmentTypeRepositoryInterface $repo
    )
    {

    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {

            $data = $request->validated();

            $types = $data['event_service_type_id'];

            $electricalequipmenttypes = $this->repo->create($data);

            logger()->info(trans('User ID :uid add customer ID :cid', [
                'uid' => auth('admin')->id(),
                'cid' => $electricalequipmenttypes->id
            ]), [
                'user' => auth('admin')->user()->toArray(),
                'request' => $request->all()
            ]);

            DB::commit();
            return $electricalequipmenttypes;

        } catch (\Throwable $th) {

            logger()->error(trans('Add Event Services has error :err', ['err' => $th->getMessage()]), [
                'user' => auth('admin')->user()->toArray(),
                'request' => $request->all()
            ]);

            DB::rollBack();
            throw $th;
        }
        // DD();
    }

    public function update(Request $request)
    {
        DB::beginTransaction();
        try {

            $data = $request->validated();

            $types = $data['event_service_type_id'];

            $electricalequipmenttypes = $this->repo->update($data['id'], $data);

            // $eventservices->type()->sync($types);

            logger()->info(trans('User ID :uid update customer ID :cid', [
                'uid' => auth('admin')->id(),
                'cid' => $electricalequipmenttypes->id
            ]), [
                'user' => auth('admin')->user()->toArray(),
                'request' => $request->all()
            ]);

            DB::commit();
            return $electricalequipmenttypes;

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
