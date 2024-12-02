<?php

namespace App\Admin\Services\EventService;

use App\Admin\Repositories\EventService\EventServiceRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventService
{
    public function __construct(
        public EventServiceRepositoryInterface $repo
    )
    {

    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {

            $data = $request->validated();

            $types = $data['event_service_type_id'];

            $eventservices = $this->repo->create($data);

            logger()->info(trans('User ID :uid add customer ID :cid', [
                'uid' => auth('admin')->id(),
                'cid' => $eventservices->id
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
    }

    public function update(Request $request)
    {
        DB::beginTransaction();
        try {

            $data = $request->validated();

            $types = $data['event_service_type_id'];

            $eventservices = $this->repo->update($data['id'], $data);

            // $eventservices->type()->sync($types);

            logger()->info(trans('User ID :uid update customer ID :cid', [
                'uid' => auth('admin')->id(),
                'cid' => $eventservices->id
            ]), [
                'user' => auth('admin')->user()->toArray(),
                'request' => $request->all()
            ]);

            DB::commit();
            return $eventservices;

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
