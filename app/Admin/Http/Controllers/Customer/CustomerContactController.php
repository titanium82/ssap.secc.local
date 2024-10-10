<?php

namespace App\Admin\Http\Controllers\Customer;

use App\Admin\DataTables\Customer\CustomerContactDataTable;
use App\Admin\Http\Controllers\Controller;
use App\Admin\Http\Requests\Customer\CustomerContactRequest;
use App\Admin\Repositories\Customer\{CustomerContactRepositoryInterface, CustomerRepositoryInterface};
use App\Core\Enums\Gender;
use Illuminate\Http\{JsonResponse, RedirectResponse, Request};
use Illuminate\View\View;

class CustomerContactController extends Controller
{
    public function __construct(
        public CustomerContactRepositoryInterface $repository,
        public CustomerRepositoryInterface $repoCustomer
    )
    {
    }

    public function index(CustomerContactDataTable $datatable): View|JsonResponse
    {
        return $datatable->render('admin.customers.contacts.index', [
            'breadcrums' => $this->breadcrums()->addByRouteName(trans('Customer'), 'admin.customer.index')->add(trans('Contact'))
        ]);
    }

    public function create(Request $request): View
    {
        if($customer_id = $request->route()->parameter('customer_id'))
        {
            $customer = $this->repoCustomer->findOrFail($customer_id);
        }

        $view = 'admin.customers.contacts.create';

        if($request->ajax())
        {
            $view = 'admin.customers.contacts.modals.modal-create';

        }

        return view($view)
        ->with('breadcrums', $this->breadcrums()->addByRouteName(trans('Customer'), 'admin.customer.index')
            ->addByRouteName(trans('Contact'), 'admin.customer_contact.index')
            ->add(trans('Add'))
        )
        ->with('customer', $customer ?? null)
        ->with('gender', Gender::asSelectArray());
    }

    public function store(CustomerContactRequest $request): RedirectResponse|JsonResponse
    {
        try {

            $customerContact = $this->repository->create($request->validated());
            
            if($request->ajax())
            {
                return response()->json([
                    'msg' => trans('notifySuccess')
                ]);
            }

            if($customerContact)
            {
                return $request->input('submitter') == 'save' 
                    ? to_route('admin.customer_contact.edit', $customerContact->id)->with('success', __('notifySuccess')) 
                    : to_route('admin.customer_contact.index')->with('success', __('notifySuccess'));
            }

            return back()->withInput()->withErrors(['errors' => trans('notifyFail')]);
        } catch (\Throwable $th) {

            if($request->ajax())
            {
                throw $th;
            }

            return back()->withInput()->withErrors(['errors' => $th->getMessage()]);
        }
    }

    public function edit($id): View
    {
        $customerContact = $this->repository->findOrFail($id);
        $customers = $this->repoCustomer->getAll();
        
        return view('admin.customers.contacts.edit')
        ->with('breadcrums', $this->breadcrums()->addByRouteName(trans('Customer'), 'admin.customer.index')
            ->addByRouteName(trans('Contact'), 'admin.customer_contact.index')
            ->add(trans('Edit'))
        )
        ->with('customer_contact', $customerContact)
        ->with('customers', $customers)
        ->with('gender', Gender::asSelectArray());
    }

    public function update(CustomerContactRequest $request): RedirectResponse
    {
        try {

            $customerContact = $this->repository->update($request->id, $request->validated());

            if($customerContact)
            {
                return $request->input('submitter') == 'save' 
                    ? back()->with('success', __('notifySuccess'))
                    : to_route('admin.customer_contact.index')->with('success', __('notifySuccess'));
            }
            return back()->withInput()->withErrors(['errors' => trans('notifyFail')]);
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
        
            return to_route('admin.customer_contact.index')->with('success', __('notifySuccess'));
        } catch (\Throwable $th) {

            if($request->ajax())
            {
                throw $th;
            }
            
            return back()->withErrors(['errors' => $th->getMessage()]);
        }
    }
}