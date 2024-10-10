<?php

namespace App\Admin\Http\Controllers\Contract;

use App\Admin\DataTables\Contract\ContractPaymentDataTable;
use App\Admin\Enums\Contract\ContractPaymentStatus;
use App\Admin\Http\Controllers\Controller;
use App\Admin\Http\Requests\Contract\ContractPaymentRequest;
use App\Admin\Http\Requests\Contract\UploadLicenseRequest;
use App\Admin\Repositories\Contract\{ContractPaymentRepositoryInterface, ContractRepositoryInterface};
use App\Core\Services\File\FileUploadService;
use Illuminate\Http\{JsonResponse, Request, RedirectResponse};
use Illuminate\View\View;

class ContractPaymentController extends Controller
{


    public function __construct(
        protected ContractPaymentRepositoryInterface $repository,
        protected ContractRepositoryInterface $repoContract,
        public FileUploadService $fileUploadService
    )
    {
    }

    public function index(ContractPaymentDataTable $datatable): View|JsonResponse
    {
        return $datatable->render('admin.contracts.payments.index', [
            'breadcrums' => $this->breadcrums()->addByRouteName(trans('Contract'), 'admin.contract.index')->add(trans('Payment'))
        ]);
    }

    public function create(Request $request): View
    {
        if($request->ajax())
        {
            return view('admin.contracts.payments.quick')->with('ct_key', uniqid_real(5));
        }

        $contracts = $this->repoContract->getAll();

        return view('admin.contracts.payments.create')
        ->with('breadcrums', $this->breadcrums()->addByRouteName(trans('Contract'), 'admin.contract.index')
            ->addByRouteName(trans('Payment'), 'admin.contract_payment.index')
            ->add(trans('Add'))
        )
        ->with('contracts', $contracts);
    }

    public function store(ContractPaymentRequest $request): RedirectResponse
    {
        try {

            $data = $request->validated();

            if(isset($data['file_send_mail']) && $data['file_send_mail'])
            {
                $data['file_send_mail'] = $this->fileUploadService->setFolderForAdmin('contracts')
                ->setFile($data['file_send_mail'])
                ->uploadFilepondEncode()
                ->getInstance();
            }
            
            $contractPayment = $this->repository->create($data);
        
            if($contractPayment)
            {

                $routeName = 'admin.contract_payment.show';

                if(auth('admin')->user()->checkRouteNameAccessOrSuperAdmin('admin.contract_payment.edit'))
                {
                    $routeName = 'admin.contract_payment.edit';
                }

                logger()->info(trans('User ID :uid add contract payment ID :cid', [
                    'uid' => auth('admin')->id(),
                    'cid' => $contractPayment->id
                ]), [
                    'user' => auth('admin')->user()->toArray(), 
                    'request' => $request->all()
                ]);

                return $request->input('submitter') == 'save' 
                    ? to_route($routeName, $contractPayment->id)->with('success', __('notifySuccess')) 
                    : to_route('admin.contract_payment.index')->with('success', __('notifySuccess'));
            }
        } catch (\Throwable $th) {

            logger()->error(trans('Add contract payment has error :err', ['err' => $th->getMessage()]), [
                'user' => auth('admin')->user()->toArray(), 
                'request' => $request->all()
            ]);

            return back()->withInput()->withErrors(['errors' => $th->getMessage()]);
        }
    }

    public function edit($id): View
    {
        $contractPayment = $this->repository->findOrFail($id);
        $contracts = $this->repoContract->getAll();

        return view('admin.contracts.payments.edit')
        ->with('breadcrums', $this->breadcrums()->addByRouteName(trans('Contract'), 'admin.contract.index')
            ->addByRouteName(trans('Payment'), 'admin.contract_payment.index')
            ->add(trans('Edit'))
        )
        ->with('contract_payment', $contractPayment)
        ->with('contracts', $contracts)
        ->with('status', ContractPaymentStatus::asSelectArray());
    }

    public function show($id): View
    {
        $contractPayment = $this->repository->findOrFail($id, ['approvedBy']);
        $contracts = $this->repoContract->getAll();

        if(request()->ajax())
        {
            return view('admin.contracts.payments.modals.show')
            ->with('contract_payment', $contractPayment)
            ->with('contracts', $contracts);
        }

        return view('admin.contracts.payments.show')
        ->with('breadcrums', $this->breadcrums()->addByRouteName(trans('Contract'), 'admin.contract.index')
            ->addByRouteName(trans('Payment'), 'admin.contract_payment.index')
            ->add(trans('Show'))
        )
        ->with('contract_payment', $contractPayment)
        ->with('contracts', $contracts);
    }

    public function update(ContractPaymentRequest $request): RedirectResponse
    {
        try {

            $data = $request->validated();
            
            if(isset($data['file_send_mail']) && $data['file_send_mail'])
            {
                $data['file_send_mail'] = $this->fileUploadService->setFolderForAdmin('contracts')
                ->setFile($data['file_send_mail'])
                ->uploadFilepondEncode()
                ->getInstance();
            }

;            $contractPayment = $this->repository->update($request->id, $data);

            if($contractPayment)
            {

                logger()->info(trans('User ID :uid update contract payment ID :cid', [
                    'uid' => auth('admin')->id(),
                    'cid' => $contractPayment->id
                ]), [
                    'user' => auth('admin')->user()->toArray(), 
                    'request' => $request->all()
                ]);

                return $request->input('submitter') == 'save' 
                    ? back()->with('success', __('notifySuccess'))
                    : to_route('admin.contract_payment.index')->with('success', __('notifySuccess'));
            }
        } catch (\Throwable $th) {

            logger()->error(trans('Add contract payment has error :err', ['err' => $th->getMessage()]), [
                'user' => auth('admin')->user()->toArray(), 
                'request' => $request->all()
            ]);
            return back()->withInput()->withErrors(['errors' => $th->getMessage()]);
        }
    }

    public function accept($id): RedirectResponse
    {
        if($this->repository->accept($id))
        {
            logger()->info(trans('User ID :uid accept contract payment ID :cid', [
                'uid' => auth('admin')->id(),
                'cid' => $id
            ]), [
                'user' => auth('admin')->user()->toArray(), 
                'request' => request()->all()
            ]);

            return back()->with('success', trans('notifySuccess'));
        }
        return back()->with('error', trans('notifyFail'));
    }

    public function uploadLicense($id): View
    {
        $contractPayment = $this->repository->findOrFail($id);

        return view('admin.contracts.payments.modals.upload-license')
            ->with('contract_payment', $contractPayment);
    }

    public function handleUploadLicense(UploadLicenseRequest $request)
    {
        $contractPayment = $this->repository->uploadLicense($request->id, $request->validated('license'));
        
        if($contractPayment)
        {
            logger()->info(trans('User ID :uid upload license contract payment ID :cid', [
                'uid' => auth('admin')->id(),
                'cid' => $request->id
            ]), [
                'user' => auth('admin')->user()->toArray(), 
                'request' => $request->all()
            ]);

            return response()->json([
                'msg' => trans('notifySuccess')
            ]);
        }

        return response()->json([
            'status' => 400,
            'msg' => trans('notifyFail')
        ]);
    }

    public function delete($id, Request $request): RedirectResponse|JsonResponse
    {
        try {
            
            $this->repository->delete($id);

            logger()->info(trans('User ID :uid delete contract payment ID :cid', [
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
        
            return to_route('admin.contract_payment.index')->with('success', __('notifySuccess'));
        } catch (\Throwable $th) {

            logger()->error(trans('Delete contract payment has error :err', ['err' => $th->getMessage()]), [
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
}