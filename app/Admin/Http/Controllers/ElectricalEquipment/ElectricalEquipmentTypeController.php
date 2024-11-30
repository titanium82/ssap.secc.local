<?php

namespace App\Admin\Http\Controllers\ElectricalEquipment;

use App\Admin\DataTables\ElectricalEquipment\ElectricalEquipmentTypeDataTable;
use App\Admin\Http\Controllers\Controller;
use App\Admin\Http\Requests\ElectricalEquipment\ElectricalEquipmentTypeRequest;
use App\Models\ElectricalEquipmentType;
use Illuminate\Http\{JsonResponse, RedirectResponse, Request};
use Illuminate\View\View;

class ElectricalEquipmentTypeController extends Controller
{

    public function __construct(
        public ElectricalEquipmentType $model,
    )
    {
    }

    public function index(ElectricalEquipmentTypeDataTable $datatable): View|JsonResponse
    {
        return $datatable->render('admin.electricalequipments.types.index', [
            'breadcrums' => $this->breadcrums()->add(trans('Electrical Equipment Type'))
        ]);
    }

    public function create(Request $request): View
    {
        if($request->ajax())
        {
            return view('admin.electricalequipments.types.modals.modal-create');
        }

        return view('admin.electrical_equipment_type.create')
        ->with('breadcrums', $this->breadcrums()
            ->addByRouteName(trans('Electrical Equipment Type'), 'admin.electrical_equipment_type.index')
            ->add(trans('Add'))
    );
    }

    public function store(ElectricalEquipmentTypeRequest $request): RedirectResponse|JsonResponse
    {
        try {

            $data = $request->validated();

            $electricalequipmenttype = $this->model->create($data);

            if($request->ajax())
            {
                return response()->json([
                    'msg' => trans('notifySuccess')
                ]);
            }

            if($electricalequipmenttype)
            {
                return $request->input('submitter') == 'save'
                    ? to_route('admin.electrical_equipment_type.edit', $electricalequipmenttype->id)->with('success', __('notifySuccess'))
                    : to_route('admin.electrical_equipment_type.index')->with('success', __('notifySuccess'));
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
        $electricalequipmenttype = $this->model->findOrFail($id);

        if($request->ajax())
        {
            return view('admin.electricalequipments.types.modals.modal-edit')
            ->with('electrical_equipment_type', $electricalequipmenttype);
        }

        return view('admin.electricalequipments.types.edit')
        ->with('breadcrums', $this->breadcrums()
            ->addByRouteName(trans('Electrical Equipment Type'), 'admin.electrical_equipment_type.index')
            ->add(trans('Edit'))
        )
        ->with('electrical_equipment_type', $electricalequipmenttype);
    }

    public function update(ElectricalEquipmentTypeRequest $request): RedirectResponse|JsonResponse
    {
        try {
            $electricalequipmenttype = $this->model->findOrFail($request->input('id'));

            $electricalequipmenttype->update($request->validated());

            if($request->ajax())
            {
                return response()->json([
                    'msg' => trans('notifySuccess')
                ]);
            }

            if($electricalequipmenttype)
            {
                return $request->input('submitter') == 'save'
                    ? back()->with('success', __('notifySuccess'))
                    : to_route('admin.electrical_equipment_type.index')->with('success', __('notifySuccess'));
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
    public function show($id): View
    {
        $electricalequipmenttype = $this->model->findOrFail($id);

        if(request()->ajax())
        {
            return view('admin.electricalequipments.types.modals.show')
            ->with('electrical_equipment_type', $electricalequipmenttype);
        }

        return view('admin.electrical_equipment_type.show')
        ->with('breadcrums', $this->breadcrums()->addByRouteName(trans('Electrical_Equipment_Type'), 'admin.electrical_equipment_type.index')
            ->addByRouteName(trans('Type'), 'admin.electrical_equipment_type.index')
            ->add(trans('Show'))
        )
        ->with('electrical_equipment_type', $electricalequipmenttype);
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

            return to_route('admin.electrical_equipment_type.index')
            ->with('success', __('notifySuccess'));
        } catch (\Throwable $th) {

            if($request->ajax())
            {
                throw $th;
            }

            return back()->with('error', $th->getMessage());
        }
    }

    public function searchSelect(Request $request)
    {
        $keyword = $request->input('term', '');

        $electricalequipmenttype = $this->model->select('id', 'name')
        ->whereAny($this->model->getFillable(), 'like', "%$keyword%")
        ->limit(10)
        ->get()
        ->map(function($item) {
            return [
                'id'    => $item->id,
                'text'  => $item->name
            ];
        });

        return [
            'results' => $electricalequipmenttype->toArray()
        ];
    }
}
