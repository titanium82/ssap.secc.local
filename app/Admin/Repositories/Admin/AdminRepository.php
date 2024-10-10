<?php

namespace App\Admin\Repositories\Admin;

use App\Admin\Enums\Role\RoleManager;
use App\Core\Repositories\EloquentRepository;
use App\Admin\Repositories\Admin\AdminRepositoryInterface;
use App\Models\Admin;
use Illuminate\Support\Facades\DB;

class AdminRepository extends EloquentRepository implements AdminRepositoryInterface
{

    public function getModel(){
        return Admin::class;
    }

    public function searchSelect(string $keyword = '', int $limit = 10): array
    {
        $customers = $this->model->select('id', 'fullname')
        ->where('is_superadmin', false)
        ->whereAny($this->model->getFillable(), 'like', "%$keyword%")
        ->limit($limit)
        ->get()
        ->map(function($item) {
            return [
                'id' => $item->id,
                'text' => $item->fullname
            ];
        });

        return $customers->toArray();
    }

    public function getLazyByIdManager(RoleManager $manager, $size = 1000, array $relations = [])
    {
        return $this->model->newQuery()->manager($manager)
        ->with($relations)
        ->lazyById($size);
    }

    public function getManager(RoleManager $manager)
    {
        return $this->model->newQuery()->manager($manager)->get();
    }

    public function updateHasRoleAndPermission($id, array $data, array $roles = [], array $permissions = [])
    {
        DB::beginTransaction();
        try {
            $this->update($id, $data);

            $this->instance->roles()->sync($roles);

            $this->instance->permissions()->sync($permissions);

            $this->instance->access_route_names = array_values($this->instance->getRouteNamesAccessByPermissionAndRole());
            
            $this->instance->save();

            DB::commit();
            
            return $this->instance;
        } catch (\Throwable $th) {

            DB::rollBack();

            throw $th;
        }
    }

    public function createHasRoleAndPermission(array $data, array $roles = [], array $permissions = [])
    {
        DB::beginTransaction();
        try {
            $admin = $this->create($data);

            if(count($roles) > 0)
            {
                $admin->roles()->attach($roles);
            }

            if(count($permissions) > 0)
            {
                $admin->permissions()->attach($permissions);
            }

            $admin->access_route_names = array_values($admin->getRouteNamesAccessByPermissionAndRole());
            
            $admin->save();

            DB::commit();

            return $admin;
        } catch (\Throwable $th) {

            DB::rollBack();

            throw $th;
        }     
    }

    public function searchAllLimit($keySearch = '', $meta = [], $limit = 10){
        $this->instance = $this->model;
        $this->getQueryBuilderFindByKey($keySearch);
        
        $this->applyFilters($meta);
        
        return $this->instance->limit($limit)->get();
    }

    protected function getQueryBuilderFindByKey($key){
        $this->instance = $this->instance->whereAny([
            'username',
            'phone',
            'fullname',
            'email'
        ], 'LIKE', '%'.$key.'%');
    }
}