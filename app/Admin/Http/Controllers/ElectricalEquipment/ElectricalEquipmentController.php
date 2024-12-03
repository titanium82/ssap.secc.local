<?php

namespace App\Admin\Http\Controllers\ElectricalEquipment;

use App\Admin\DataTables\ElectricalEquipment\ElectricalEquipmentDataTable;
use App\Admin\Http\Controllers\Controller;
use App\Admin\Http\Requests\ElectricalEquipment\ElectricalEquipmentRequest;
use App\Admin\Repositories\ElectricalEquipment\ElectricalEquipmentRepositoryInterface;
use App\Admin\Repositories\ElectricalEquipment\ElectricalEquipmentTypeRepositoryInterface;
use App\Admin\Repositories\Warehouse\WarehouseRepositoryInterface;
use App\Admin\Services\ElectricalEquipment\ElectricalEquipment;
use Illuminate\Http\{JsonResponse, RedirectResponse, Request};
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use App\Admin\Enums\ElectricalEquipment\Unit;

class ElectricalEquipmentController extends Controller
{

    public function __construct(
        public ElectricalEquipmentRepositoryInterface $repository,
        public ElectricalEquipmentTypeRepositoryInterface $repoElectricalEquipmentType,
        public WarehouseRepositoryInterface $repoWWarehouse,
        public ElectricalEquipment $service
    )
    {
    }

    public function index(ElectricalEquipmentDataTable $datatable): View|JsonResponse
    {
        return $datatable->render('admin.electricalequipments.index', [
            'breadcrums' => $this->breadcrums()->add(trans('Electrical Equipment'))
        ]);
    }
    public function show($id)
    {
        $electricalequipment = $this->repository->findOrFail($id, ['type']);

        return view('admin.electricalequipments.show')->with('breadcrums', $this->breadcrums()
            ->addByRouteName(trans('Electrical Equipment'), 'admin.electrical_equipment.index')
            ->add(trans('Show'))
        )
        ->with('electricalequipments', $electricalequipment);
    }
    public function create(): View
    {
        $types = $this ->repoElectricalEquipmentType->getAll();
        $warehouses = $this ->repoWWarehouse->getAll();

        return view('admin.electricalequipments.create')
        ->with('breadcrums', $this->breadcrums()->addByRouteName(trans('Electrical Equipment'), 'admin.electrical_equipment.index')->add(trans('Add')))
        ->with('unit', Unit::asSelectArray())
        ->with('warehouses',$warehouses)
        ->with('types',$types);
    }

    public function store(ElectricalEquipmentRequest $request): RedirectResponse
    {
        try {

            $electricalequipment = $this->service->store($request);

            if($electricalequipment)
            {

                $routeName = 'admin.electrical_equipment.show';

                if(auth('admin')->user()->checkRouteNameAccessOrSuperAdmin('admin.electricalequipment.edit'))
                {
                    $routeName = 'admin.electrical_equipment.edit';
                }

                return $request->input('submitter') == 'save'
                    ? to_route($routeName, $electricalequipment->id)->with('success', __('notifySuccess'))
                    : to_route('admin.electrical_equipment.index')->with('success', __('notifySuccess'));
            }

            return back()->withInput()->withErrors(['errors' => trans('notifyFail')]);

        } catch (\Throwable $th) {

            return back()->withInput()->withErrors(['errors' => $th->getMessage()]);
        }
    }

    public function edit($id): View
    {
        $types = $this->repoElectricalEquipmentType->getAll();
        $warehouses = $this ->repoWWarehouse->getAll();
        $electricalequipment = $this->repository->findOrFail($id);

        return view('admin.electricalequipments.edit')
        ->with('breadcrums', $this->breadcrums()->addByRouteName(trans('Electrical Equipment'), 'admin.electrical_equipment.index')->add(trans('Edit')))
        ->with('electricalequipment', $electricalequipment)
        ->with('unit', Unit::asSelectArray())
        ->with('warehouses',$warehouses)
        ->with('types', $types);
    }

    public function update(ElectricalEquipmentRequest $request): RedirectResponse
    {
        {
            try {

                $electricalequipment = $this->service->update($request);

                if($electricalequipment)
                {
                    return $request->input('submitter') == 'save'
                        ? back()->with('success', __('notifySuccess'))
                        : to_route('admin.electrical_equipment.index')->with('success', __('notifySuccess'));
                }

                return back()->withInput()->withErrors(['errors' => trans('notifyFail')]);
            } catch (\Throwable $th) {

                return back()->withInput()->withErrors(['errors' => $th->getMessage()]);
            }
        }
    }
    public function delete($id, Request $request): RedirectResponse|JsonResponse
    {
        try {

            $this->repository->delete(id: $id);

            logger()->info(trans('User ID :uid delete customer ID :cid', [
                'uid' => auth('admin')->id(),
                'cid' => $id
            ]), [
                'user' => auth('admin')->user()->toArray(),
                'request' => $request->all()
            ]);
            if($request->ajax())
            {
                return response()->json([
                    'msg' => trans('notifySuccess')
                ]);
            }

            return to_route('admin.electrical_equipment.index')->with('success', __('notifySuccess'));
        } catch (\Throwable $th) {

            logger()->error(trans('Delete customer has error :err', ['err' => $th->getMessage()]), [
                'user' => auth('admin')->user()->toArray(),
                'request' => $request->all()
            ]);

            if($request->ajax())
            {
                throw $th;
            }

            return back()->withErrors('error', $th->getMessage());
        }
    }
    public function importExcel(ElectricalEquipment $request)
    {
        try {
            Excel::import(new ElectricalEquipmentImport, $request->file('file'));

            return back()->with('success', __('importExcelSuccess'));

        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
    public function searchSelect(Request $request)
    {
        return [
            'results' => $this->repository->searchSelect($request->input('term', ''))
        ];
    }
}
