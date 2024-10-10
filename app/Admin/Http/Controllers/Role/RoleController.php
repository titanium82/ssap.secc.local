<?php

namespace App\Admin\Http\Controllers\Role;

use App\Admin\DataTables\Role\RoleDataTable;
use App\Admin\Http\Controllers\Controller;
use App\Admin\Http\Requests\Role\RoleRequest;
use App\Admin\Repositories\{Permission\PermissionRepositoryInterface, Role\RoleRepositoryInterface};
use App\Admin\Services\Route\RouteService;
use Illuminate\Http\{JsonResponse, RedirectResponse, Request};
use Illuminate\View\View;

class RoleController extends Controller
{
    public function __construct(
        public RoleRepositoryInterface $repository,
        public PermissionRepositoryInterface $repoPermission,
        public RouteService $routeService
    )
    {
    }

    public function index(RoleDataTable $datatable): View|JsonResponse
    {
        return $datatable->render('admin.roles.index', [
            'breadcrums' => $this->breadcrums()->addByRouteName(trans('Role'))
        ]);
    }

    public function create(): View
    {
        $permissions = $this->repoPermission->getAll();

        return view('admin.roles.create')
        ->with('breadcrums', $this->breadcrums()->addByRouteName(trans('Role'), 'admin.role.index')->addByRouteName(trans('Add')))
        ->with('permissions', $permissions);
    }

    public function store(RoleRequest $request): RedirectResponse
    {
        try {

            $data = $request->validated();

            $role = $this->repository->createHasPermissions($data['role'], $data['permissions']);
        
            if($role)
            {
                return $request->input('submitter') == 'save' 
                    ? to_route('admin.role.edit', $role->id)->with('success', __('notifySuccess')) 
                    : to_route('admin.role.index')->with('success', __('notifySuccess'));
            }
        } catch (\Throwable $th) {

            // throw $th;
            return back()->withInput()->withErrors(['errors' => $th->getMessage()]);
        }
    }

    public function edit($id): View
    {
        $role = $this->repository->findOrFail($id, ['permissions']);

        $permissions = $this->repoPermission->getAll();
        
        return view('admin.roles.edit')
        ->with('breadcrums', $this->breadcrums()->addByRouteName(trans('Role'), 'admin.role.index')->addByRouteName(trans('Edit')))
        ->with('role', $role)
        ->with('permissions', $permissions)
        ->with('role_has_permissions', $role->permissions->pluck('id')->toArray());
    }

    public function update(RoleRequest $request): RedirectResponse
    {
        try {

            $data = $request->validated();

            $role = $this->repository->updateHasPermissions($request->id, $data['role'], $data['permissions']);

            if($role)
            {
                return $request->input('submitter') == 'save' 
                    ? back()->with('success', __('notifySuccess'))
                    : to_route('admin.role.index')->with('success', __('notifySuccess'));
            }
        } catch (\Throwable $th) {

            throw $th;
            return back()->withInput()->withErrors(['errors' => $th->getMessage()]);
        }
    }

    public function delete($id, Request $request): RedirectResponse|JsonResponse
    {
        try {
            
            $this->repository->delete($id);

            if($request->ajax())
            {
                return response()->json([
                    'msg' => trans('notifySuccess')
                ]);
            }
        
            return to_route('admin.role.index')->with('success', __('notifySuccess'));
        } catch (\Throwable $th) {

            if($request->ajax())
            {
                throw $th;
            }
            
            return back()->withErrors(['errors' => $th->getMessage()]);
        }
    }
}