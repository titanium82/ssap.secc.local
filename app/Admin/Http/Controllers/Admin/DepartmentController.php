<?php

namespace App\Admin\Http\Controllers\Admin;

use App\Admin\DataTables\Admin\DepartmentDataTable;
use App\Admin\Http\Controllers\Controller;
use App\Admin\Http\Requests\Admin\DepartmentRequest;
use App\Models\Department;
use Illuminate\Http\{JsonResponse, RedirectResponse, Request};
use Illuminate\View\View;

class DepartmentController extends Controller
{

    public function __construct(
        public Department $model,
    )
    {
    }

    public function index(DepartmentDataTable $datatable): View|JsonResponse
    {
        return $datatable->render('admin.department.index', [
            'breadcrums' => $this->breadcrums()->add(trans('Department'))
        ]);
    }

    public function create(Request $request): View
    {
        if($request->ajax())
        {
            return view('admin.department.modals.modal-create');
        }

        return view('admin.department.create')
        ->with('breadcrums', $this->breadcrums()->addByRouteName(trans('Department'), 'admin.department.index')
        ->addByRouteName(trans('Department'), 'admin.department.index')
        ->add(trans('Add'))
    );
    }

    public function store(DepartmentRequest $request): RedirectResponse|JsonResponse
    {
        try {

            $data = $request->validated();

            $department = $this->model->create($data);

            if($request->ajax())
            {
                return response()->json([
                    'msg' => trans('notifySuccess')
                ]);
            }

            if($department)
            {
                return $request->input('submitter') == 'save'
                    ? to_route('admin.department.edit', $department->id)->with('success', __('notifySuccess'))
                    : to_route('admin.department.index')->with('success', __('notifySuccess'));
            }
            return back()->withInput()->with('error', trans('notifyFail'));
        } catch (\Throwable $th) {

            if($request->ajax())
            {
                throw $th;
            }

            return back()->withInput()->with('error', $th->getMessage());
        }
    }

    public function edit($id, Request $request): View
    {
        $department = $this->model->findOrFail($id);

        if($request->ajax())
        {
            return view('admin.department.modals.modal-edit')->with('department', $department);
        }

        return view('admin.department.edit')
        ->with('breadcrums', $this->breadcrums()
            ->addByRouteName(trans('Department'), 'admin.department.index')
            ->add(trans('Edit'))
        )
        ->with('department', $department);
    }

    public function update(DepartmentRequest $request): RedirectResponse|JsonResponse
    {
        try {
            $department = $this->model->findOrFail($request->input('id'));

            $department->update($request->validated());

            if($request->ajax())
            {
                return response()->json([
                    'msg' => trans('notifySuccess')
                ]);
            }

            if($department)
            {
                return $request->input('submitter') == 'save'
                    ? back()->with('success', __('notifySuccess'))
                    : to_route('admin.department.index')->with('success', __('notifySuccess'));
            }
            return back()->withInput()->with('error', trans('notifyFail'));
        } catch (\Throwable $th) {

            if($request->ajax())
            {
                throw $th;
            }

            return back()->withInput()->with('error', $th->getMessage());
        }
    }
    public function delete($id, Request $request): RedirectResponse|JsonResponse
    {
        try {

            $this->model->findOrFail($id)->delete();

            if($request->ajax())
            {
                return response()->json([
                    'msg' => trans('notifySuccess')
                ]);
            }

            return to_route('admin.department.index')->with('success', __('notifySuccess'));
        } catch (\Throwable $th) {

            if($request->ajax())
            {
                throw $th;
            }

            return back()->with('error', $th->getMessage());
        }
    }
}
