<?php

namespace App\Admin\Http\Controllers\EventService;

use App\Admin\DataTables\EventService\EventServiceUnitDataTable;
use App\Admin\Http\Controllers\Controller;
use App\Admin\Http\Requests\EventService\EventServiceUnitRequest;
use App\Admin\Repositories\EventService\EventServiceUnitRepositoryInterface;
use App\Admin\Repositories\EventService\EventServiceTypeRepositoryInterface;
use App\Admin\Services\EventService\EventServiceUnit;
use Illuminate\Http\{JsonResponse, RedirectResponse, Request};
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use App\Admin\Enums\EventService\Unit;

class EventServiceUnitController extends Controller
{

    public function __construct(
        public EventServiceUnitRepositoryInterface $repository,
        public EventServiceTypeRepositoryInterface $repoEventServiceType,
        public EventServiceUnit $service
    )
    {
    }

    public function index(EventServiceUnitDataTable $datatable): View|JsonResponse
    {
        return $datatable->render('admin.eventservices.units.index', [
            'breadcrums' => $this->breadcrums()->add(trans('Event Service Unit'))
        ]);
    }
    public function show($id)
    {
        $eventserviceunit = $this->repository->findOrFail($id, ['type']);

        return view('admin.eventservices.units.show')->with('breadcrums', $this->breadcrums()
            ->addByRouteName(trans('Event Service'), 'admin.event_service_unit.index')
            ->add(trans('Show'))
        )
        ->with('eventservice', $eventserviceunit);
    }
    public function create(Request $request): View
    {
        $types = $this ->repoEventServiceType->getAll();
        if($request->ajax())
        {
            return view('admin.eventservices.units.modals.modal-create')
            ->with('types',$types)
            ->with('unit',Unit::asSelectArray());
        }

        return view('admin.eventservices.units.create')
        ->with('breadcrums', $this->breadcrums()->addByRouteName(trans('Event Service Unit'), 'admin.event_service_unit.index')
        ->addByRouteName(trans('Event Services Unit'), 'admin.event_service_unit.index')
        ->add(trans('Add'))

    );
    }

    public function store(EventServiceUnitRequest $request): RedirectResponse
    {
        try {

            $eventserviceunit = $this->service->store($request);

            if($eventserviceunit)
            {

                $routeName = 'admin.event_service_unit.show';

                if(auth('admin')->user()->checkRouteNameAccessOrSuperAdmin('admin.event_service_unit.edit'))
                {
                    $routeName = 'admin.event_service_unit.edit';
                }

                return $request->input('submitter') == 'save'
                    ? to_route($routeName, $eventserviceunit->id)->with('success', __('notifySuccess'))
                    : to_route('admin.event_service_unit.index')->with('success', __('notifySuccess'));
            }

            return back()->withInput()->withErrors(['errors' => trans('notifyFail')]);

        } catch (\Throwable $th) {

            return back()->withInput()->withErrors(['errors' => $th->getMessage()]);
        }
    }

    public function edit($id, Request $request): View
    {
        $types = $this->repoEventServiceType->getAll();
        $event_service_unit = $this->repository->findOrFail($id);
        if($request->ajax())
        {
            return view('admin.eventservices.units.modals.modal-edit')
            ->with('event_service_unit', $event_service_unit)
            ->with('types', $types)
            ->with('unit', Unit::asSelectArray());
        }
        return view('admin.eventservices.units.edit')
        ->with('breadcrums', $this->breadcrums()->addByRouteName(trans('Event Service Unit'), 'admin.event_service_unit.index')->add(trans('Edit')))
        ->with('event_service_unit', $event_service_unit)
        ->with('unit', Unit::asSelectArray())
        ->with('types', $types);
    }

    public function update(EventServiceUnitRequest $request): RedirectResponse
    {
        {
            try {

                $event_service_unit = $this->service->update($request);

                if($event_service_unit)
                {
                    return $request->input('submitter') == 'save'
                        ? back()->with('success', __('notifySuccess'))
                        : to_route('admin.event_service_unit.index')->with('success', __('notifySuccess'));
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

            return to_route('admin.event_service_unit.index')->with('success', __('notifySuccess'));
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
    public function searchSelect(Request $request)
    {
        return [
            'results' => $this->repository->searchSelect($request->input('term', ''))
        ];
    }
}
