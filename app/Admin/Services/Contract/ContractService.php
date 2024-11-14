<?php

namespace App\Admin\Services\Contract;

use App\Admin\Mail\Contract\ContractPaymentPeriod;
use App\Admin\Repositories\Contract\{ContractPaymentRepositoryInterface, ContractRepositoryInterface};
use App\Core\Services\File\FileUploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ContractService
{
    public function __construct(
        public ContractRepositoryInterface $repository,
        public ContractPaymentRepositoryInterface $repoContractPayment,
        public FileUploadService $fileUploadService
    )
    {
        
    }
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();
            if(isset($data['contract']['annex']) && $data['contract']['annex'])
            {
                $data['contract']['annex'] = $this->fileUploadService->setFolderForAdmin('contracts')->uploadMultipleFilepondEncode($data['contract']['annex'])->getInstance();
            }

            if(isset($data['contract']['files']) && $data['contract']['files'])
            {
                $data['contract']['files'] = $this->fileUploadService->setFolderForAdmin('contracts')->uploadMultipleFilepondEncode($data['contract']['files'])->getInstance();
            }

            
            $contract = $this->repository->create($data['contract']);

            $contract->exhibitionLocations()->attach($data['exhibition_location_id']);

            $contract->sectors()->attach($data['sector_id']);

            $data['payment'] = array_values($data['payment']);
            
            $adminId = auth('admin')->id();
            
            foreach($data['payment'] as $key => $payment)
            {
                $data['payment'][$key]['period'] = $key + 1;
                $data['payment'][$key]['admin_id'] = $adminId;
                
                if(isset($payment['file_send_mail']) && $payment['file_send_mail'])
                {
                    $data['payment'][$key]['file_send_mail'] = $this->fileUploadService->setFolderForAdmin('contracts')
                    ->setFile($payment['file_send_mail'])
                    ->uploadFilepondEncode()
                    ->getInstance();
                }
            }
            
            $contract->payments()->createMany($data['payment']);

            DB::commit();

            return $contract;

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

            if(isset($data['contract']['annex']) && $data['contract']['annex'])
            {
                $data['contract']['annex'] = $this->fileUploadService->setFolderForAdmin('contracts')->uploadMultipleFilepondEncode($data['contract']['annex'])->getInstance();
            }

            if(isset($data['contract']['files']) && $data['contract']['files'])
            {
                $data['contract']['files'] = $this->fileUploadService->setFolderForAdmin('contracts')->uploadMultipleFilepondEncode($data['contract']['files'])->getInstance();
            }
            
            $contract = $this->repository->update($request->id, $data['contract']);

            $contract->exhibitionLocations()->sync($data['exhibition_location_id']);

            $contract->sectors()->sync($data['sector_id']);

            DB::commit();
            return $contract;
        } catch (\Throwable $th) {

            DB::rollBack();
            throw $th;
        }
    }

    public function sendMailPaymentPeriod(Request $request)
    {
        try {
            $data = $request->validated();

            $listEmail = empty($data['email']) ? [] : array_column(json_decode($data['email'], true), 'value');

            $files = $data['files'] ?? [];

            $contractPayment = $this->repoContractPayment->findOrFail($data['contract_payment_id'], ['contract.customer']);

            if($contractPayment->getEmailCustomer())
            {
                Mail::to($contractPayment->getEmailCustomer())->send(new ContractPaymentPeriod($data['title'], $data['content'], $listEmail, $files, $contractPayment));
            }
            
            return true;

        } catch (\Throwable $th) {
            throw $th;
        }
    }
}