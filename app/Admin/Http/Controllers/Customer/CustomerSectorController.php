<?php

namespace App\Admin\Http\Controllers\Customer;

use App\Admin\DataTables\Customer\CustomerSectorDataTable;
use App\Admin\Http\Controllers\Controller;
use App\Admin\Http\Requests\Customer\CustomerSectorRequest;
use App\Admin\Repositories\Customer\CustomerSectorRepositoryInterface;
use Illuminate\Http\{JsonResponse, RedirectResponse, Request};
use Illuminate\View\View;

class CustomerSectorController extends Controller
{

    public function __construct(
        public CustomerSectorRepositoryInterface $repository,
    )
    {
    }

    public function index(CustomerSectorDataTable $datatable): View|JsonResponse
    {
        return $datatable->render('admin.customers.sectors.index', [
            'breadcrums' => $this->breadcrums()->addByRouteName(trans('Customer'), 'admin.customer.index')->add(trans('Sector'))
        ]);
    }

    public function create(Request $request): View
    {
        if($request->ajax())
        {
            return view('admin.customers.sectors.modals.modal-create');
        }

        return view('admin.customers.sectors.create')
        ->with('breadcrums', $this->breadcrums()->addByRouteName(trans('Customer'), 'admin.customer.index')
            ->addByRouteName(trans('Sector'), 'admin.customer_sector.index')
            ->add(trans('Add'))
        );
    }

    public function store(CustomerSectorRequest $request): RedirectResponse|JsonResponse
    {
        try {

            $data = $request->validated();
            
            $customerSector = $this->repository->create($data);
        
            if($request->ajax())
            {
                return response()->json([
                    'msg' => trans('notifySuccess')
                ]);
            }

            if($customerSector)
            {
                return $request->input('submitter') == 'save' 
                    ? to_route('admin.customer_sector.edit', $customerSector->id)->with('success', __('notifySuccess')) 
                    : to_route('admin.customer_sector.index')->with('success', __('notifySuccess'));
            }

            return back()->withInput()->with('error', trans('notifyFail'));
        } catch (\Throwable $th) {

            if($request->ajax())
            {
                throw $th;
            }

            return back()->withInput()->withErrors(['errors' => $th->getMessage()]);
        }
    }

    public function edit($id, Request $request): View
    {
        $customerSector = $this->repository->findOrFail($id);

        if($request->ajax())
        {
            return view('admin.customers.sectors.modals.modal-edit')->with('customer_sector', $customerSector);
        }
        
        return view('admin.customers.sectors.edit')
        ->with('breadcrums', $this->breadcrums()->addByRouteName(trans('Customer'), 'admin.customer.index')
            ->addByRouteName(trans('Sector'), 'admin.customer_sector.index')
            ->add(trans('Edit'))
        )
        ->with('customer_sector', $customerSector);
    }

    public function update(CustomerSectorRequest $request): RedirectResponse|JsonResponse
    {
        try {

            $customerSector = $this->repository->update($request->id, $request->validated());

            if($request->ajax())
            {
                return response()->json([
                    'msg' => trans('notifySuccess')
                ]);
            }

            if($customerSector)
            {
                return $request->input('submitter') == 'save' 
                    ? back()->with('success', __('notifySuccess'))
                    : to_route('admin.customer_sector.index')->with('success', __('notifySuccess'));
            }
            return back()->withInput()->with('error', trans('notifyFail'));
        } catch (\Throwable $th) {

            if($request->ajax())
            {
                throw $th;
            }

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
        
            return to_route('admin.customer_sector.index')->with('success', __('notifySuccess'));

        } catch (\Throwable $th) {

            if($request->ajax())
            {
                throw $th;
            }
            
            return back()->withErrors(['errors' => $th->getMessage()]);
        }
    }

    public function searchSelect(Request $request)
    {
        return [
            'results' => $this->repository->searchSelect($request->input('term', ''))
        ];
    }
}