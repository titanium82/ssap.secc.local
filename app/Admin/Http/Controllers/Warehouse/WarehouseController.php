<?php

namespace App\Admin\Http\Controllers\Warehouse;

use App\Admin\DataTables\Warehouse\WarehouseDataTable;
use App\Admin\Http\Controllers\Controller;
use App\Admin\Http\Requests\Warehouse\WarehouseRequest;
use App\Models\Warehouse;
use Illuminate\Http\{JsonResponse, RedirectResponse, Request};
use Illuminate\View\View;

class WarehouseController extends Controller
{

    public function __construct(
        public Warehouse $model,
    )
    {
    }

    public function index(WarehouseDataTable $datatable): View|JsonResponse
    {
        return $datatable->render('admin.warehouses.index', [
            'breadcrums' => $this->breadcrums()->add(trans('Warehouse'))
        ]);
    }

    public function create(Request $request): View
    {
        if($request->ajax())
        {
            return view('admin.warehouses.modals.modal-create');
        }

        return view('admin.warehouses.create')
        ->with('breadcrums', $this->breadcrums()->addByRouteName(trans('Warehouse'), 'admin.warehouses.index')
        ->addByRouteName(trans('Warehouse'), 'admin.warehouse.index')
        ->add(trans('Add'))
    );
    }

    public function store(WarehouseRequest $request): RedirectResponse|JsonResponse
    {
        try {

            $data = $request->validated();

            $warehouse = $this->model->create($data);

            if($request->ajax())
            {
                return response()->json([
                    'msg' => trans('notifySuccess')
                ]);
            }

            if($warehouse)
            {
                return $request->input('submitter') == 'save'
                    ? to_route('admin.warehouses.edit', $warehouse->id)->with('success', __('notifySuccess'))
                    : to_route('admin.warehouses.index')->with('success', __('notifySuccess'));
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
        $warehouse = $this->model->findOrFail($id);

        if($request->ajax())
        {
            return view('admin.warehouses.modals.modal-edit')->with('warehouse', $warehouse);
        }

        return view('admin.warehouse.edit')
        ->with('breadcrums', $this->breadcrums()
            ->addByRouteName(trans('Warehouse'), 'admin.warehouses.index')
            ->add(trans('Edit'))
        )
        ->with('warehouse', $warehouse);
    }

    public function update(WarehouseRequest $request): RedirectResponse|JsonResponse
    {
        try {
            $warehouse = $this->model->findOrFail($request->input('id'));

            $warehouse->update($request->validated());

            if($request->ajax())
            {
                return response()->json([
                    'msg' => trans('notifySuccess')
                ]);
            }

            if($warehouse)
            {
                return $request->input('submitter') == 'save'
                    ? back()->with('success', __('notifySuccess'))
                    : to_route('admin.warehouses.index')->with('success', __('notifySuccess'));
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

            return to_route('admin.warehouses.index')->with('success', __('notifySuccess'));
        } catch (\Throwable $th) {

            if($request->ajax())
            {
                throw $th;
            }

            return back()->with('error', $th->getMessage());
        }
    }
}
