<?php

namespace App\Admin\Http\Controllers\Contract;

use App\Admin\DataTables\Contract\ContractTypeDataTable;
use App\Admin\Http\Controllers\Controller;
use App\Admin\Http\Requests\Contract\ContractTypeRequest;
use App\Admin\Repositories\Contract\ContractTypeRepositoryInterface;
use Illuminate\Http\{JsonResponse, RedirectResponse, Request};
use Illuminate\View\View;

class ContractTypeController extends Controller
{

    public function __construct(
        public ContractTypeRepositoryInterface $repository,
    )
    {
    }

    public function index(ContractTypeDataTable $datatable): View|JsonResponse
    {
        return $datatable->render('admin.contracts.types.index', [
            'breadcrums' => $this->breadcrums()->addByRouteName(trans('Contract'), 'admin.contract.index')->add(trans('Type'))
        ]);
    }

    public function create(Request $request): View
    {
        if($request->ajax())
        {
            return view('admin.contracts.types.modals.modal-create');
        }

        return view('admin.contracts.types.create')
        ->with('breadcrums', $this->breadcrums()->addByRouteName(trans('Contract'), 'admin.contract.index')
            ->addByRouteName(trans('Type'), 'admin.contract_type.index')
            ->add(trans('Add'))
        );
    }

    public function store(ContractTypeRequest $request): RedirectResponse|JsonResponse
    {
        try {

            $data = $request->validated();
            
            $contractType = $this->repository->create($data);

            if($request->ajax())
            {
                return response()->json([
                    'msg' => trans('notifySuccess')
                ]);
            }
        
            if($contractType)
            {
                return $request->input('submitter') == 'save' 
                    ? to_route('admin.contract_type.edit', $contractType->id)->with('success', __('notifySuccess')) 
                    : to_route('admin.contract_type.index')->with('success', __('notifySuccess'));
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
        $contractType = $this->repository->findOrFail($id);

        if($request->ajax())
        {
            return view('admin.contracts.types.modals.modal-edit')->with('contract_type', $contractType);
        }
        
        return view('admin.contracts.types.edit')
        ->with('breadcrums', $this->breadcrums()->addByRouteName(trans('Contract'), 'admin.contract.index')
            ->addByRouteName(trans('Type'), 'admin.contract_type.index')
            ->add(trans('Edit'))
        )
        ->with('contract_type', $contractType);
    }

    public function update(ContractTypeRequest $request): RedirectResponse|JsonResponse
    {
        try {

            $contractType = $this->repository->update($request->id, $request->validated());

            if($request->ajax())
            {
                return response()->json([
                    'msg' => trans('notifySuccess')
                ]);
            }

            if($contractType)
            {
                return $request->input('submitter') == 'save' 
                    ? back()->with('success', __('notifySuccess'))
                    : to_route('admin.contract_type.index')->with('success', __('notifySuccess'));
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
        
            return to_route('admin.contract_type.index')->with('success', __('notifySuccess'));
        } catch (\Throwable $th) {

            if($request->ajax())
            {
                throw $th;
            }

            return back()->withErrors(['errors' => $th->getMessage()]);
        }
    }
}