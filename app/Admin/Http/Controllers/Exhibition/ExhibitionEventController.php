<?php

namespace App\Admin\Http\Controllers\Exhibition;

use App\Admin\DataTables\Exhibition\ExhibitionEventDataTable;
use App\Admin\Enums\ExhibitionLocation\EventManager;
use App\Admin\Http\Controllers\Controller;
use App\Admin\Http\Requests\Exhibition\ExhibitionEventRequest;
use App\Admin\Repositories\Exhibition\{ExhibitionLocationRepositoryInterface,ExhibitionEventRepositoryInterface};
use Illuminate\Http\{JsonResponse, RedirectResponse, Request};
use App\Admin\Repositories\Customer\CustomerRepositoryInterface;
use App\Admin\Services\Exhibition\ExhibitionEventService;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ExhibitionEventController extends Controller
{

    public function __construct(
        public ExhibitionEventRepositoryInterface $repository,
        public ExhibitionLocationRepositoryInterface $repoExhibitionLocation,
        public CustomerRepositoryInterface $repoCustomer,
        public ExhibitionEventService $service
    )
    {
    }

    public function index(ExhibitionEventDataTable $datatable): View|JsonResponse
    {
        return $datatable->render('admin.exhibitions.events.index', [
            'breadcrums' => $this->breadcrums()->add(trans('Exhibition Event'))
        ]);
    }
    public function show($id)
    {
        $exhibitionevent = $this->repository->findOrFail($id, ['exhibitionlocation', 'customer']);

        return view('admin.exhibitions.events.show')->with('breadcrums', $this->breadcrums()
            ->addByRouteName(trans('Exhibition Event'), 'admin.exhibition_event.index')
            ->add(trans('Show'))
        )
        ->with('exhibitionevent', $exhibitionevent);
    }
    public function create(Request $request): View
    {
        $customer = $this ->repoCustomer->getAll();
        if($customer_id = $request->route()->parameter('customer_id'))
        {
            $customer = $this->repoCustomer->findOrFail($customer_id);
        }
        return view('admin.exhibitions.events.create')
        ->with('breadcrums', $this->breadcrums()
            ->addByRouteName(trans('Exhibition Event'), 'admin.exhibition_event.index')
            ->add(trans('Add'))
        )
        ->with('eventmanager', EventManager::asSelectArray())
        ->with('customer', $customer ?? null);
    }

    public function store(ExhibitionEventRequest $request): RedirectResponse|JsonResponse
    {
        try {
            $exhibitionevent = $this->service->store($request);

            if($exhibitionevent)
            {
                $routeName = 'admin.exhibition_event.show';

                if(auth('admin')->user()->checkRouteNameAccessOrSuperAdmin('admin.contract_payment.edit'))
                {
                    $routeName = 'admin.exhibition_event.edit';
                }

                logger()->info(trans('User ID :uid add contract ID :cid', [
                    'uid' => auth('admin')->id(),
                    'cid' => $exhibitionevent->id
                ]), [
                    'user' => auth('admin')->user()->toArray(),
                    'request' => $request->all()
                ]);

                return $request->input('submitter') == 'save'
                    ? to_route($routeName, $exhibitionevent->id)->with('success', __('notifySuccess'))
                    : to_route('admin.exhibition_event.index')->with('success', __('notifySuccess'));
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

    public function edit($id, Request $request): View
    {
        $exhibitionevent = $this->repository->findOrFail($id,['customer','exhibition_location']);

        return view('admin.exhibitions.events.edit')
        ->with('breadcrums', $this->breadcrums()
            ->addByRouteName(trans('Exhibition Event'), 'admin.exhibition_event.index')
            ->add(trans('Edit'))
        )
        ->with('exhibition_events', $exhibitionevent)
        ->with('event_manager', EventManager::asSelectArray())
        ->with('customer', $customer ?? null);
    }

    public function update(ExhibitionEventRequest $request): RedirectResponse|JsonResponse
    {
        try {
            $exhibitionevent = $this->service->update($request);

            $exhibitionevent->update($request->validated());

            if($request->ajax())
            {
                return response()->json([
                    'msg' => trans('notifySuccess')
                ]);
            }

            if($exhibitionevent)
            {
                return $request->input('submitter') == 'save'
                    ? back()->with('success', __('notifySuccess'))
                    : to_route('admin.exhibition_event.index')->with('success', __('notifySuccess'));
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
}
