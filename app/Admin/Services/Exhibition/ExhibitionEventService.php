<?php

namespace App\Admin\Services\Exhibition;

use App\Admin\Repositories\Customer\CustomerRepositoryInterface;
use App\Admin\Repositories\Exhibition\{ExhibitionEventRepositoryInterface, ExhibitionLocationRepositoryInterface};
use App\Core\Services\File\FileUploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ExhibitionEventService
{
    public function __construct(
        public ExhibitionEventRepositoryInterface $repository,
        public ExhibitionLocationRepositoryInterface $repoExhibitionLocation,
        public CustomerRepositoryInterface $repoCustomer,
        public FileUploadService $fileUploadService
    )
    {

    }
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();
            if(isset($data['exhibitionevent']['layouts']) && $data['exhibitionevent']['layouts'])
            {
                $data['exhibitionevent']['layouts'] = $this->fileUploadService->setFolderForAdmin('exhibitionevents')->uploadMultipleFilepondEncode($data['exhibitionevent']['layouts'])->getInstance();
            }

            $exhibitionevent = $this->repository->create($data['exhibitionevent']);

            $exhibitionevent->exhibitionlocations()->attach($data['exhibition_location_id']);

            $adminId = auth('admin')->id();

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

            if(isset($data['exhibitionevent']['layouts']) && $data['exhibitionevent']['layouts'])
            {
                $data['exhibitionevent']['layouts'] = $this->fileUploadService->setFolderForAdmin('exhibitionevents')->uploadMultipleFilepondEncode($data['exhibitionevent']['layouts'])->getInstance();
            }
            $exhibitionevent = $this->repository->update($request->id, $data['exhibitionevent']);

            $exhibitionevent->exhibitionLocations()->sync($data['exhibition_location_id']);

            // $exhibitionevent->contract()->sync($data['contract_id']);

            DB::commit();
            return $exhibitionevent;
        } catch (\Throwable $th) {

            DB::rollBack();
            throw $th;
        }
    }
}
