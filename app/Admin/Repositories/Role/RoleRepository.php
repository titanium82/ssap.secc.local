<?php

namespace App\Admin\Repositories\Role;
use App\Core\Repositories\EloquentRepository;
use App\Admin\Repositories\Role\RoleRepositoryInterface;
use App\Models\Role;

class RoleRepository extends EloquentRepository implements RoleRepositoryInterface
{

    public function getModel(){
        return Role::class;
    }

    public function searchAllLimit($keySearch = '', $meta = [], $limit = 10)
    {
        $this->instance = $this->model;
        $this->instance = $this->instance->where('name', 'LIKE', '%'.$keySearch.'%');
        $this->applyFilters($meta);
        
        return $this->instance->limit($limit)->get();
    }

    public function createHasPermissions(array $data, array $permissions)
    {
        $instance = $this->create($data);

        $instance->permissions()->attach($permissions);

        return $instance;
    }

    public function updateHasPermissions($id, array $data, array $permissions)
    {
        $this->update($id, $data);

        $this->instance->permissions()->sync($permissions);

        //cap nhat field route name cua tat ca user phu thuoc vao role
        $this->instance->admins()->get()->map(function($admin) {
            $admin->update([
                'access_route_names' => $admin->getRouteNamesAccessByPermissionAndRole()
            ]);
        });

        return $this->instance;
    }
}