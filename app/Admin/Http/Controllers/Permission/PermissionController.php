<?php

namespace App\Admin\Http\Controllers\Permission;

use App\Admin\DataTables\Permission\PermissionDataTable;
use App\Admin\Http\Controllers\Controller;
use App\Admin\Http\Requests\Permission\PermissionRequest;
use App\Admin\Repositories\Permission\PermissionRepositoryInterface;
use App\Admin\Services\Route\RouteService;
use Illuminate\Http\{JsonResponse, RedirectResponse, Request};
use Illuminate\View\View;

class PermissionController extends Controller
{
    public function __construct(
        public PermissionRepositoryInterface $repository,
        public RouteService $routeService
    )
    {
    }

    public function index(PermissionDataTable $datatable): View|JsonResponse
    {
        return $datatable->render('admin.permissions.index', [
            'breadcrums' => $this->breadcrums()->addByRouteName(trans('Permission'), '')
        ]);
    }

    public function create(): View
    {
        $routeNames = $this->routeService->getRoutesByName(
            config('admin.roles_permissions.route_name_prefix'), 
            config('admin.roles_permissions.whitelist_routes_name')
        );

        return view('admin.permissions.create')
        ->with('breadcrums', $this->breadcrums()->addByRouteName(trans('Permission'), 'admin.permission.index')->addByRouteName(trans('Add')))
        ->with('route_names', $routeNames);
    }

    public function store(PermissionRequest $request): RedirectResponse
    {
        try {

            $permission = $this->repository->create($request->validated());
        
            if($permission)
            {
                return $request->input('submitter') == 'save' 
                    ? to_route('admin.permission.edit', $permission->id)->with('success', __('notifySuccess')) 
                    : to_route('admin.permission.index')->with('success', __('notifySuccess'));
            }
        } catch (\Throwable $th) {

            // throw $th;
            return back()->withInput()->withErrors(['errors' => $th->getMessage()]);
        }
    }

    public function edit($id): View
    {
        $routeNames = $this->routeService->getRoutesByName(
            config('admin.roles_permissions.route_name_prefix'), 
            config('admin.roles_permissions.whitelist_routes_name')
        );

        $permission = $this->repository->findOrFail($id);
        
        return view('admin.permissions.edit')
        ->with('breadcrums', $this->breadcrums()->addByRouteName(trans('Permission'), 'admin.permission.index')->addByRouteName(trans('Edit')))
        ->with('permission', $permission)
        ->with('route_names', $routeNames);
    }

    public function update(PermissionRequest $request): RedirectResponse
    {
        try {

            $permission = $this->repository->update($request->id, $request->validated());

            if($permission)
            {
                return $request->input('submitter') == 'save' 
                    ? back()->with('success', __('notifySuccess'))
                    : to_route('admin.permission.index')->with('success', __('notifySuccess'));
            }
        } catch (\Throwable $th) {

            // throw $th;
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
        
            return to_route('admin.permission.index')->with('success', __('notifySuccess'));
        } catch (\Throwable $th) {

            if($request->ajax())
            {
                throw $th;
            }
            
            return back()->withErrors(['errors' => $th->getMessage()]);
        }
    }
}