<?php

namespace App\Admin\Http\Controllers\Customer;

use App\Admin\DataTables\Customer\{CustomerContractDataTable, CustomerDataTable, CustomerExhibitionEventDataTable, OneCustomerContactDataTable};
use App\Admin\Http\Controllers\Controller;
use App\Admin\Http\Requests\Customer\CustomerRequest;
use App\Admin\Imports\CustomerImport;
use App\Admin\Repositories\Customer\{CustomerRepositoryInterface, CustomerTypeRepositoryInterface, CustomerSectorRepositoryInterface};
use App\Admin\Services\Customer\CustomerService;
use App\Core\Enums\Gender;
use Illuminate\Http\{JsonResponse, RedirectResponse, Request};
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;

class CustomerController extends Controller
{
    public function __construct(
        public CustomerRepositoryInterface $repository,
        public CustomerTypeRepositoryInterface $repoCustomerType,
        public CustomerSectorRepositoryInterface $repoCustomerSector,
        public CustomerService $service
    )
    {
    }

    public function index(CustomerDataTable $datatable): View|JsonResponse
    {
        return $datatable->render('admin.customers.index', [
            'breadcrums' => $this->breadcrums()->add(trans('Customer'))
        ]);
    }

    public function show($id, OneCustomerContactDataTable $customerContactDataTable, CustomerContractDataTable $customerContractDataTable, CustomerExhibitionEventDataTable $customerExhibitionEventDataTable)
    {
        $customer = $this->repository->findOrFail($id, ['sectors']);

        $customerContactDataTable = $customerContactDataTable->with([
            'customer_id' => $id
        ])->html();

        $customerContractDataTable = $customerContractDataTable->with([
            'customer_id' => $id
        ])->html();
        $customerExhibitionEventDataTable = $customerExhibitionEventDataTable->with([
            'customer_id' => $id
        ])->html();

        return view('admin.customers.show')
        ->with('breadcrums', $this->breadcrums()->addByRouteName(trans('Customer'), 'admin.customer.index')->add(trans('Show')))
        ->with('customer_contact_datatable', $customerContactDataTable)
        ->with('customer_contract_datatable', $customerContractDataTable)
        ->with('customer_exhibitionevent_datatable', $customerExhibitionEventDataTable)
        ->with('customer', $customer);
    }

    public function renderContactDT($customer_id, OneCustomerContactDataTable $customerContactDataTable)
    {
        return $customerContactDataTable->with('customer_id', $customer_id)->render('admin.customers.show');
    }

    public function renderContractDT($customer_id, CustomerContractDataTable $customerContractDataTable)
    {
        return $customerContractDataTable->with('customer_id', $customer_id)->render('admin.customers.show');
    }
    public function renderExhibitionEventDT($customer_id, CustomerExhibitionEventDataTable $customerExhibitionEventDataTable)
    {
        return $customerExhibitionEventDataTable->with('customer_id', $customer_id)->render('admin.customers.show');
    }

    public function create(): View
    {
        $types = $this->repoCustomerType->getAll();

        $sectors = $this->repoCustomerSector->getAll();

        return view('admin.customers.create')
        ->with('breadcrums', $this->breadcrums()->addByRouteName(trans('Customer'), 'admin.customer.index')->add(trans('Add')))
        ->with('gender', Gender::asSelectArray())
        ->with('types', $types)
        ->with('sectors', $sectors);
    }

    public function store(CustomerRequest $request): RedirectResponse
    {
        try {

            $customer = $this->service->store($request);

            if($customer)
            {

                $routeName = 'admin.customer.show';

                if(auth('admin')->user()->checkRouteNameAccessOrSuperAdmin('admin.customer.edit'))
                {
                    $routeName = 'admin.customer.edit';
                }

                return $request->input('submitter') == 'save'
                    ? to_route($routeName, $customer->id)->with('success', __('notifySuccess'))
                    : to_route('admin.customer.index')->with('success', __('notifySuccess'));
            }

            return back()->withInput()->withErrors(['errors' => trans('notifyFail')]);

        } catch (\Throwable $th) {

            return back()->withInput()->withErrors(['errors' => $th->getMessage()]);
        }
    }

    public function edit($id): View
    {
        $types = $this->repoCustomerType->getAll();

        $sectors = $this->repoCustomerSector->getAll();

        $customer = $this->repository->findOrFail($id, ['sectors']);

        return view('admin.customers.edit')
        ->with('breadcrums', $this->breadcrums()->addByRouteName(trans('Customer'), 'admin.customer.index')->add(trans('Edit')))
        ->with('customer', $customer)
        ->with('gender', Gender::asSelectArray())
        ->with('types', $types)
        ->with('sectors', $sectors);
    }

    public function update(CustomerRequest $request): RedirectResponse
    {
        try {

            $customer = $this->service->update($request);

            if($customer)
            {
                return $request->input('submitter') == 'save'
                    ? back()->with('success', __('notifySuccess'))
                    : to_route('admin.customer.index')->with('success', __('notifySuccess'));
            }

            return back()->withInput()->withErrors(['errors' => trans('notifyFail')]);
        } catch (\Throwable $th) {

            return back()->withInput()->withErrors(['errors' => $th->getMessage()]);
        }
    }

    public function delete($id, Request $request): RedirectResponse|JsonResponse
    {
        try {

            $this->repository->delete($id);

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

            return to_route('admin.customer.index')->with('success', __('notifySuccess'));
        } catch (\Throwable $th) {

            logger()->error(trans('Delete customer has error :err', ['err' => $th->getMessage()]), [
                'user' => auth('admin')->user()->toArray(),
                'request' => $request->all()
            ]);

            if($request->ajax())
            {
                throw $th;
            }
            return back()->withErrors(['errors' => $th->getMessage()]);
        }
    }

    public function importExcel(CustomerRequest $request)
    {
        try {
            Excel::import(new CustomerImport, $request->file('file'));

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
