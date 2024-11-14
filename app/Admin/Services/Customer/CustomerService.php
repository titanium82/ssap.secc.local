<?php

namespace App\Admin\Services\Customer;

use App\Admin\Repositories\Customer\CustomerRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerService
{
    public function __construct(
        public CustomerRepositoryInterface $repo
    )
    {
        
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {

            $data = $request->validated();
            
            $sectors = $data['customer_sector_id'];

            unset($data['customer_sector_id']);

            $customer = $this->repo->create($data);
        
            $customer->sectors()->attach($sectors);

            logger()->info(trans('User ID :uid add customer ID :cid', [
                'uid' => auth('admin')->id(),
                'cid' => $customer->id
            ]), [
                'user' => auth('admin')->user()->toArray(), 
                'request' => $request->all()
            ]);
            
            DB::commit();
            return $customer;

        } catch (\Throwable $th) {

            logger()->error(trans('Add customer has error :err', ['err' => $th->getMessage()]), [
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
            
            $sectors = $data['customer_sector_id'];

            unset($data['customer_sector_id']);

            $customer = $this->repo->update($data['id'], $data);
        
            $customer->sectors()->sync($sectors);

            logger()->info(trans('User ID :uid update customer ID :cid', [
                'uid' => auth('admin')->id(),
                'cid' => $customer->id
            ]), [
                'user' => auth('admin')->user()->toArray(), 
                'request' => $request->all()
            ]);

            DB::commit();
            return $customer;

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