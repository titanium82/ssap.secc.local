<?php

namespace App\Admin\Http\Controllers\ElectricalEquipment;

use App\Admin\DataTables\ElectricalEquipment\ElectricalEquipmentOrderDataTable;
use App\Admin\Enums\Contract\ContractPaymentMethod;
use App\Admin\Enums\Contract\ContractStatus;
use App\Admin\Enums\ElectricalEquipment\Surcharge;
use App\Admin\Http\Controllers\Controller;
use App\Admin\Http\Requests\ElectricalEquipment\ElectricalEquipmentOrderRequest;
use App\Admin\Repositories\ElectricalEquipment\ElectricalEquipmentOrderRepositoryInterface;
use Illuminate\Http\{JsonResponse, RedirectResponse, Request};
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use App\Admin\Enums\ElectricalEquipment\Unit;
use App\Admin\Http\Requests\ElectricalEquipment\ElectricalEquipmentRequest;
use App\Admin\Imports\ElectricalEquipmentOrderImport;
use App\Admin\Repositories\Customer\CustomerRepositoryInterface;
use App\Admin\Repositories\Customer\CustomerTypeRepositoryInterface;
use App\Admin\Repositories\Exhibition\ExhibitionEventRepositoryInterface;
use App\Admin\Repositories\Exhibition\ExhibitionLocationRepositoryInterface;
use App\Admin\Services\ElectricalEquipment\ElectricalEquipmentOrderService;

class ElectricalEquipmentOrderController extends Controller
{

    public function __construct(
        public ElectricalEquipmentOrderRepositoryInterface $repository,
        public CustomerRepositoryInterface $repoCustomer,
        public CustomerTypeRepositoryInterface $repoCustomerType,
        public ExhibitionEventRepositoryInterface $repoExhibitionEvent,
        public ExhibitionLocationRepositoryInterface $repoExhibitionLocation,
        public ElectricalEquipmentOrderService $service
    )
    {
    }

    public function index(ElectricalEquipmentOrderDataTable $datatable): View|JsonResponse
    {
        return $datatable->render('admin.electricalequipments.orders.index', [
            'breadcrums' => $this->breadcrums()->add(trans('Electrical Equipment Order'))
        ]);
    }
    public function show($id)
    {
        $electricalequipmentorder = $this->repository->findOrFail($id, ['type']);

        return view('admin.electricalequipments.orders.show')->with('breadcrums', $this->breadcrums()
            ->addByRouteName(trans('Electrical Equipment Order'), 'admin.electrical_equipment_order.index')
            ->add(trans('Show'))
        )
        ->with('electricalequipmentorders', $electricalequipmentorder);
    }
    public function create(Request $request): View
    {
        $exhibitionevent = $this ->repoExhibitionEvent->getAll();
        $exhibitionlocations = $this ->repoExhibitionLocation->getAll();

        if($customer_id = $request->route()->parameter('customer_id'))
        {
            $customer = $this->repoCustomer->findOrFail($customer_id);
        }
            $customertype = $this ->repoCustomerType->getAll();

        return view('admin.electricalequipments.orders.create')
        ->with('breadcrums', $this->breadcrums()->addByRouteName(trans('Electrical Equipment Order'), 'admin.electrical_equipment_order.index')->add(trans('Add')))
        ->with('status', ContractStatus::asSelectArray())
        ->with('payment_methods', ContractPaymentMethod::asSelectArray())
        ->with('surcharge', Surcharge::asSelectArray())
        ->with('customer',$customer ?? null)
        ->with('customertypes',$customertype)
        ->with('exhibitionevents',$exhibitionevent)
        ->with('exhibitionlocations',$exhibitionlocations);
    }

    public function store(ElectricalEquipmentOrderRequest $request): RedirectResponse
    {
        try {

            $electricalequipmentorder = $this->service->store($request);

            if($electricalequipmentorder)
            {

                $routeName = 'admin.electrical_equipment_order.show';

                if(auth('admin')->user()->checkRouteNameAccessOrSuperAdmin('admin.electricalequipment.edit'))
                {
                    $routeName = 'admin.electrical_equipment_order.edit';
                }

                return $request->input('submitter') == 'save'
                    ? to_route($routeName, $electricalequipmentorder->id)->with('success', __('notifySuccess'))
                    : to_route('admin.electrical_equipment_order.index')->with('success', __('notifySuccess'));
            }

            return back()->withInput()->withErrors(['errors' => trans('notifyFail')]);

        } catch (\Throwable $th) {

            return back()->withInput()->withErrors(['errors' => $th->getMessage()]);
        }
    }

    public function edit($id): View
    {
        $exhibitionevent = $this ->repoExhibitionEvent->getAll();
        $exhibitionlocations = $this ->repoExhibitionLocation->getAll();
        $customer = $this ->repoCustomer->getAll();
        $customertype = $this ->repoCustomerType->getAll();
        $electricalequipmentorder = $this->repository->findOrFail($id);

        return view('admin.electricalequipments.orders.edit')
        ->with('breadcrums', $this->breadcrums()->addByRouteName(trans('Electrical Equipment Order'), 'admin.electrical_equipment_order.index')->add(trans('Edit')))
        ->with('electricalequipment', $electricalequipmentorder)
        ->with('surcharge', Surcharge::asSelectArray())
        ->with('payment_methods', ContractPaymentMethod::asSelectArray())
        ->with('customer',$customer)
        ->with('customertypes',$customertype)
        ->with('exhibitionevent', $exhibitionevent)
        ->with('exhibitionlocations', $exhibitionlocations);
    }

    public function update(ElectricalEquipmentOrderRequest $request): RedirectResponse
    {
        {
            try {

                $electricalequipmentorder = $this->service->update($request);

                if($electricalequipmentorder)
                {
                    return $request->input('submitter') == 'save'
                        ? back()->with('success', __('notifySuccess'))
                        : to_route('admin.electrical_equipment_order.index')->with('success', __('notifySuccess'));
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

            return to_route('admin.electrical_equipment_order.index')->with('success', __('notifySuccess'));
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
    public function importExcel(ElectricalEquipmentRequest $request)
    {
        try {
            Excel::import(new ElectricalEquipmentOrderImport, $request->file('file'));

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
