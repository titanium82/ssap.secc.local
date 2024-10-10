<?php

namespace App\Admin\Http\Controllers\EventService;

use App\Admin\DataTables\EventService\EventServiceDataTable;
use App\Admin\Http\Controllers\Controller;
use App\Admin\Http\Requests\EventService\EventServiceRequest;
use App\Admin\Repositories\EventService\EventServiceRepositoryInterface;
use App\Admin\Repositories\EventService\EventServiceTypeRepositoryInterface;
use App\Admin\Services\EventService\EventService;
use Illuminate\Http\{JsonResponse, RedirectResponse, Request};
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use App\Admin\Enums\EventService\Unit;

class EventServiceController extends Controller
{

    public function __construct(
        public EventServiceRepositoryInterface $repository,
        public EventServiceTypeRepositoryInterface $repoEventServiceType,
        public EventService $service
    )
    {
    }

    public function index(EventServiceDataTable $datatable): View|JsonResponse
    {
        return $datatable->render('admin.eventservices.index', [
            'breadcrums' => $this->breadcrums()->add(trans('Event Service'))
        ]);
    }
    public function show($id)
    {
        $eventservice = $this->repository->findOrFail($id, ['type']);

        return view('admin.eventservices.show')->with('breadcrums', $this->breadcrums()
            ->addByRouteName(trans('Event Service'), 'admin.eventservices.index')
            ->add(trans('Show'))
        )
        ->with('eventservice', $eventservice);
    }
    public function create(): View
    {
        $types = $this ->repoEventServiceType->getAll();

        return view('admin.eventservices.create')
        ->with('breadcrums', $this->breadcrums()->addByRouteName(trans('Event Service'), 'admin.event_service.index')->add(trans('Add')))
        ->with('unit', Unit::asSelectArray())
        ->with('types',$types);
    }

    public function store(EventServiceRequest $request): RedirectResponse
    {
        try {

            $eventservice = $this->service->store($request);

            if($eventservice)
            {

                $routeName = 'admin.eventservices.show';

                if(auth('admin')->user()->checkRouteNameAccessOrSuperAdmin('admin.eventservices.edit'))
                {
                    $routeName = 'admin.event_service.edit';
                }

                return $request->input('submitter') == 'save'
                    ? to_route($routeName, $eventservice->id)->with('success', __('notifySuccess'))
                    : to_route('admin.event_service.index')->with('success', __('notifySuccess'));
            }

            return back()->withInput()->withErrors(['errors' => trans('notifyFail')]);

        } catch (\Throwable $th) {

            return back()->withInput()->withErrors(['errors' => $th->getMessage()]);
        }
    }

    public function edit($id): View
    {
        $types = $this->repoEventServiceType->getAll();
        $eventservice = $this->repository->findOrFail($id);

        return view('admin.eventservices.edit')
        ->with('breadcrums', $this->breadcrums()->addByRouteName(trans('Event Service'), 'admin.event_service.index')->add(trans('Edit')))
        ->with('eventservice', $eventservice)
        ->with('unit', Unit::asSelectArray())
        ->with('types', $types);
    }

    public function update(EventServiceRequest $request): RedirectResponse
    {
        {
            try {

                $eventservice = $this->service->update($request);

                if($eventservice)
                {
                    return $request->input('submitter') == 'save'
                        ? back()->with('success', __('notifySuccess'))
                        : to_route('admin.event_service.index')->with('success', __('notifySuccess'));
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

            return to_route('admin.event_service.index')->with('success', __('notifySuccess'));
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
