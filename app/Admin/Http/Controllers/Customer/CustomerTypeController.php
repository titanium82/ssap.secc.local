<?php

namespace App\Admin\Http\Controllers\Customer;

use App\Admin\DataTables\Customer\CustomerTypeDataTable;
use App\Admin\Http\Controllers\Controller;
use App\Admin\Http\Requests\Customer\CustomerTypeRequest;
use App\Admin\Repositories\Customer\CustomerTypeRepositoryInterface;
use Illuminate\Http\{JsonResponse, RedirectResponse, Request};
use Illuminate\View\View;

class CustomerTypeController extends Controller
{

    public function __construct(
        public CustomerTypeRepositoryInterface $repository,
    )
    {
    }

    public function index(CustomerTypeDataTable $datatable): View|JsonResponse
    {
        return $datatable->render('admin.customers.types.index', [
            'breadcrums' => $this->breadcrums()->addByRouteName(trans('Customer'), 'admin.customer.index')->add(trans('Type'))
        ]);
    }

    public function create(Request $request): View
    {
        if($request->ajax())
        {
            return view('admin.customers.types.modals.modal-create');
        }

        return view('admin.customers.types.create')
        ->with('breadcrums', $this->breadcrums()->addByRouteName(trans('Customer'), 'admin.customer.index')
            ->addByRouteName(trans('Type'), 'admin.customer_type.index')
            ->add(trans('Add'))
        );
    }

    public function store(CustomerTypeRequest $request): RedirectResponse|JsonResponse
    {
        try {

            $data = $request->validated();
            
            $customerType = $this->repository->create($data);

            if($request->ajax())
            {
                return response()->json([
                    'msg' => trans('notifySuccess')
                ]);
            }
        
            if($customerType)
            {
                return $request->input('submitter') == 'save' 
                    ? to_route('admin.customer_type.edit', $customerType->id)->with('success', __('notifySuccess')) 
                    : to_route('admin.customer_type.index')->with('success', __('notifySuccess'));
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
        $customerType = $this->repository->findOrFail($id);

        if($request->ajax())
        {
            return view('admin.customers.types.modals.modal-edit')->with('customer_type', $customerType);
        }
        
        return view('admin.customers.types.edit')
        ->with('breadcrums', $this->breadcrums()->addByRouteName(trans('Customer'), 'admin.customer.index')
            ->addByRouteName(trans('Type'), 'admin.customer_type.index')
            ->add(trans('Edit')))
        ->with('customer_type', $customerType);
    }

    public function update(CustomerTypeRequest $request): RedirectResponse|JsonResponse
    {
        try {

            $customerType = $this->repository->update($request->id, $request->validated());

            if($request->ajax())
            {
                return response()->json([
                    'msg' => trans('notifySuccess')
                ]);
            }

            if($customerType)
            {
                return $request->input('submitter') == 'save' 
                    ? back()->with('success', __('notifySuccess'))
                    : to_route('admin.customer_type.index')->with('success', __('notifySuccess'));
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
        
            return to_route('admin.customer_type.index')->with('success', __('notifySuccess'));
        } catch (\Throwable $th) {

            if($request->ajax())
            {
                throw $th;
            }

            return back()->withErrors(['errors' => $th->getMessage()]);
        }
    }
}