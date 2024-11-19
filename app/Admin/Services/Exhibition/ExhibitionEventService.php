<?php

namespace App\Admin\Services\Exhibition;

use App\Admin\Repositories\Customer\CustomerRepositoryInterface as CustomerCustomerRepositoryInterface;
use App\Admin\Repositories\Exhibition\{CustomerRepositoryInterface, ExhibitionEventRepositoryInterface, ExhibitionLocationRepositoryInterface};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ExhibitionEventService
{
    public function __construct(
        public ExhibitionEventRepositoryInterface $repository,
        public ExhibitionLocationRepositoryInterface $repoExhibitionLocation,
        public CustomerCustomerRepositoryInterface $repoCustomer,
    )
    {

    }
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();

            $exhibitionevent = $this->repository->create($data['exhibitionevent']);

            $exhibitionevent->exhibitionLocations()->attach($data['exhibition_location_id']);

            DB::commit();

            return $exhibitionevent;

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

            $exhibitionevent = $this->repository->update($request->id, $data['exhibitionevent']);

            $exhibitionevent->exhibitionLocations()->sync($data['exhibition_location_id']);

            $exhibitionevent->contract()->sync($data['contract_id']);

            DB::commit();
            return $exhibitionevent;
        } catch (\Throwable $th) {

            DB::rollBack();
            throw $th;
        }
    }
}
