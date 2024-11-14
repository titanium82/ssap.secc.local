<?php

namespace App\Admin\Http\Controllers\Contract;

use App\Admin\DataTables\Contract\ContractDataTable;
use App\Admin\Enums\Contract\ContractPaymentMethod;
use App\Admin\Http\Controllers\Controller;
use App\Admin\Http\Requests\Contract\{ContracShareRequest, ContractRequest, ContractSendMailRequest};
use App\Admin\Repositories\Contract\{ContractPaymentRepositoryInterface, ContractRepositoryInterface, ContractTypeRepositoryInterface};
use App\Admin\Repositories\Customer\CustomerRepositoryInterface;
use App\Admin\Services\Contract\ContractService;
use App\Models\Currency;
use Illuminate\Http\{JsonResponse, RedirectResponse, Request};
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ContractController extends Controller
{
    public function __construct(
        public ContractRepositoryInterface $repository,
        public ContractTypeRepositoryInterface $repoContractType,
        public ContractPaymentRepositoryInterface $repoContractPayment,
        public CustomerRepositoryInterface $repoCustomer,
        public Currency $currency,
        public ContractService $service
    )
    {
    }

    public function index(ContractDataTable $datatable): View|JsonResponse
    {
        return $datatable->render('admin.contracts.index', [
            'breadcrums' => $this->breadcrums()->add(trans('Contract'))
        ]);
    }

    public function show($id)
    {
        $contract = $this->repository->findOrFail($id, ['type', 'customer', 'currency', 'payments']);

        return view('admin.contracts.show')->with('breadcrums', $this->breadcrums()
            ->addByRouteName(trans('Contract'), 'admin.contract.index')
            ->add(trans('Show'))
        )
        ->with('contract', $contract);
    }

    public function create(Request $request): View
    {
        $contractTypes = $this->repoContractType->getAll();

        if($customer_id = $request->route()->parameter('customer_id'))
        {
            $customer = $this->repoCustomer->findOrFail($customer_id);
        }

        $currencies = $this->currency->all();

        return view('admin.contracts.create')
        ->with('breadcrums', $this->breadcrums()
            ->addByRouteName(trans('Contract'), 'admin.contract.index')
            ->add(trans('Add'))
        )
        ->with('contract_types', $contractTypes)
        ->with('payment_methods', ContractPaymentMethod::asSelectArray())
        ->with('currencies', $currencies)
        ->with('customer', $customer ?? null);
    }

    public function store(ContractRequest $request): RedirectResponse
    {
        try {
            $contract = $this->service->store($request);

            if($contract)
            {
                $routeName = 'admin.contract.show';

                if(auth('admin')->user()->checkRouteNameAccessOrSuperAdmin('admin.contract_payment.edit'))
                {
                    $routeName = 'admin.contract.edit';
                }

                logger()->info(trans('User ID :uid add contract ID :cid', [
                    'uid' => auth('admin')->id(),
                    'cid' => $contract->id
                ]), [
                    'user' => auth('admin')->user()->toArray(), 
                    'request' => $request->all()
                ]);

                return $request->input('submitter') == 'save' 
                    ? to_route($routeName, $contract->id)->with('success', __('notifySuccess')) 
                    : to_route('admin.contract.index')->with('success', __('notifySuccess'));
            }

            return back()->withInput()->with(['error' => trans('notifyFail')]);

        } catch (\Throwable $th) {
            // throw $th;
            
            logger()->error(trans('Add contract has error :err', ['err' => $th->getMessage()]), [
                'user' => auth('admin')->user()->toArray(), 
                'request' => $request->all()
            ]);

            return back()->withInput()->with('error', $th->getMessage());
        }
    }

    public function edit($id): View
    {
        $contract = $this->repository->findOrFail($id, ['customer', 'type', 'currency', 'payments', 'exhibitionLocations', 'sectors']);
        
        return view('admin.contracts.edit')
        ->with('breadcrums', $this->breadcrums()
            ->addByRouteName(trans('Contract'), 'admin.contract.index')
            ->add(trans('Edit'))
        )
        ->with('contract', $contract)
        ->with('payment_methods', ContractPaymentMethod::asSelectArray());
    }

    public function update(ContractRequest $request): RedirectResponse
    {
        try {

            $contract = $this->service->update($request);

            if($contract)
            {
                logger()->info(trans('User ID :uid update contract ID :cid', [
                    'uid' => auth('admin')->id(),
                    'cid' => $contract->id
                ]), [
                    'user' => auth('admin')->user()->toArray(), 
                    'request' => $request->all()
                ]);

                return $request->input('submitter') == 'save' 
                    ? back()->with('success', __('notifySuccess'))
                    : to_route('admin.contract.index')->with('success', __('notifySuccess'));
            }
        } catch (\Throwable $th) {
            logger()->error(trans('Update contract has error :err', ['err' => $th->getMessage()]), [
                'user' => auth('admin')->user()->toArray(), 
                'request' => $request->all()
            ]);

            return back()->withInput()->with('error', $th->getMessage());
        }
    }

    public function delete($id, Request $request): RedirectResponse|JsonResponse
    {
        try {
            
            $this->repository->delete($id);

            if($request->ajax())
            {
                logger()->info(trans('User ID :uid delete contract ID :cid', [
                    'uid' => auth('admin')->id(),
                    'cid' => $id
                ]), [
                    'user' => auth('admin')->user()->toArray(), 
                    'request' => $request->all()
                ]);

                return response()->json([
                    'msg' => trans('notifySuccess')
                ]);
            }
        
            return to_route('admin.contract.index')->with('success', __('notifySuccess'));
        } catch (\Throwable $th) {

            logger()->error(trans('Delete contract has error :err', ['err' => $th->getMessage()]), [
                'user' => auth('admin')->user()->toArray(), 
                'request' => $request->all()
            ]);

            if($request->ajax())
            {
                throw $th;
            }
            return back()->with('error', $th->getMessage());
        }
    }

    public function searchSelect(Request $request): array
    {
        return [
            'results' => $this->repository->searchSelect($request->input('term', ''))
        ];
    }

    public function paymentSendMail($id): View
    {
        $contract = $this->repository->findOrFail($id, ['payments']);
        
        return view('admin.contracts.modals.payment-send-email')->with('contract', $contract);
    }

    public function handlePaymentSendMail(ContractSendMailRequest $request): JsonResponse
    {
        try {
            
            $this->service->sendMailPaymentPeriod($request);

            return response()->json([
                'msg' => trans('notifySuccess')
            ]);

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function share($id): View
    {
        $contract = $this->repository->findOrFail($id, ['sharers']);

        if($contract->canShare() == false)
        {
            return response()->json([
                'status' => 403,
                'msg' => trans('This contract unavailable share.')
            ], 403);
        }

        return view('admin.contracts.modals.share')->with('contract', $contract);
    }

    public function handleShare(ContracShareRequest $request): JsonResponse
    {
        $r = $request->validated();

        DB::beginTransaction();

        try {
            $contract = $this->repository->findOrFail($r['contract_id'], ['payments']);

            if($contract->canShare() == false)
            {
                return response()->json([
                    'status' => 403,
                    'msg' => trans('This contract unavailable share.')
                ], 403);
            }

            $contract->sharers()->sync($r['admin_id']);

            foreach($contract->payments as $payment)
            {
                $payment->sharers()->sync($r['admin_id']);
            }

            DB::commit();

            return response()->json([
                'msg' => trans('notifySuccess')
            ]);

        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
}