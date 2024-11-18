<?php

namespace App\Admin\Http\Controllers\Admin;

use App\Admin\DataTables\Admin\AdminDataTable;
use App\Admin\Http\Controllers\Controller;
use App\Admin\Http\Requests\Admin\AdminRequest;
use App\Admin\Repositories\{Role\RoleRepositoryInterface, Permission\PermissionRepositoryInterface, Admin\AdminRepositoryInterface};
use App\Admin\Repositories\Department\DepartmentRepositoryInterface;
use App\Core\Enums\Gender;
use Illuminate\Http\{JsonResponse, RedirectResponse, Request};
use Illuminate\View\View;

class AdminController extends Controller
{
    public function __construct(
        protected AdminRepositoryInterface $repository,
        protected RoleRepositoryInterface $repoRole,
        protected PermissionRepositoryInterface $repoPermission,
        protected DepartmentRepositoryInterface $repoDepartment,
    )
    {
    }

    public function index(AdminDataTable $dataTable): View|JsonResponse
    {
        return $dataTable->render('admin.admins.index', [
            'breadcrums' => $this->breadcrums()->addByRouteName(trans('Admin'))
        ]);
    }

    public function create(): View
    {
        $roles = $this->repoRole->getAll();

        $permissions = $this->repoPermission->getAll();

        $department = $this->repoDepartment->getAll();
;
        return view('admin.admins.create')
        ->with('breadcrums', $this->breadcrums()->addByRouteName(trans('Admin'), 'admin.admin.index')->addByRouteName(trans('Add')))
        ->with('roles', $roles)
        ->with('gender', Gender::asSelectArray())
        ->with('permissions', $permissions)
        ->with('department',$department);
    }

    public function store(AdminRequest $request): RedirectResponse
    {
        try {

            $data = $request->validated();

            $admin = $this->repository->createHasRoleAndPermission($data['admin'], $data['roles'] ?? [], $data['permissions'] ?? []);

            if($admin)
            {
                return $request->input('submitter') == 'save'
                    ? to_route('admin.admin.edit', $admin->id)->with('success', __('notifySuccess'))
                    : to_route('admin.admin.index')->with('success', __('notifySuccess'));
            }
        } catch (\Throwable $th) {

            // throw $th;
            return back()->withInput()->withErrors(['errors' => $th->getMessage()]);
        }
    }

    public function edit($id): View
    {
        $admin = $this->repository->findOrFail($id, ['roles', 'permissions']);

        $roles = $this->repoRole->getAll();

        $department = $this->repoDepartment->getAll();


        $permissions = $this->repoPermission->getAll();

        return view('admin.admins.edit')
        ->with('breadcrums', $this->breadcrums()->addByRouteName(trans('Admin'), 'admin.admin.index')->addByRouteName(trans('Edit')))
        ->with('admin', $admin)
        ->with('roles', $roles)
        ->with('gender', Gender::asSelectArray())
        ->with('permissions', $permissions)
        ->with('department',$department)
        ->with('admin_has_roles', $admin->roles->pluck('id')->toArray())
        ->with('admin_has_permissions', $admin->permissions->pluck('id')->toArray());
    }

    public function update(AdminRequest $request): RedirectResponse
    {
        try {

            $data = $request->validated();

            $admin = $this->repository->updateHasRoleAndPermission($request->id, $data['admin'], $data['roles'] ?? [], $data['permissions'] ?? []);

            if($admin)
            {
                return $request->input('submitter') == 'save'
                    ? back()->with('success', __('notifySuccess'))
                    : to_route('admin.admin.index')->with('success', __('notifySuccess'));
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

            return to_route('admin.admin.index')->with('success', __('notifySuccess'));
        } catch (\Throwable $th) {

            if($request->ajax())
            {
                throw $th;
            }
            return back()->withErrors(['errors' => $th->getMessage()]);
        }
    }

    public function searchSelect(Request $request): array
    {
        return [
            'results' => $this->repository->searchSelect($request->input('term', ''))
        ];
    }
}
