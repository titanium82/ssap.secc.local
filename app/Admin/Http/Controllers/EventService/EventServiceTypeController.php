<?php

namespace App\Admin\Http\Controllers\EventService;

use App\Admin\DataTables\EventService\EventServiceTypeDataTable;
use App\Admin\Http\Controllers\Controller;
use App\Admin\Http\Requests\EventService\EventServiceTypeRequest;
use App\Models\EventServiceType;
use Illuminate\Http\{JsonResponse, RedirectResponse, Request};
use Illuminate\View\View;

class EventServiceTypeController extends Controller
{

    public function __construct(
        public EventServiceType $model,
    )
    {
    }

    public function index(EventServiceTypeDataTable $datatable): View|JsonResponse
    {
        return $datatable->render('admin.eventservices.types.index', [
            'breadcrums' => $this->breadcrums()->add(trans('Event Service Types'))
        ]);
    }

    public function create(Request $request): View
    {
        if($request->ajax())
        {
            return view('admin.eventservices.types.modals.modal-create');
        }

        return view('admin.eventservices.types.create')
        ->with('breadcrums', $this->breadcrums()->addByRouteName(trans('Event Service Type'), 'admin.event_service_type.index')
        ->addByRouteName(trans('Event Services Types'), 'admin.event_service_type.index')
        ->add(trans('Add'))
    );
    }

    public function store(EventServiceTypeRequest $request): RedirectResponse|JsonResponse
    {
        try {

            $data = $request->validated();

            $eventservicetype = $this->model->create($data);

            if($request->ajax())
            {
                return response()->json([
                    'msg' => trans('notifySuccess')
                ]);
            }

            if($eventservicetype)
            {
                return $request->input('submitter') == 'save'
                    ? to_route('admin.event_service_type.edit', $eventservicetype->id)->with('success', __('notifySuccess'))
                    : to_route('admin.event_service_type.index')->with('success', __('notifySuccess'));
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

    public function edit($id, Request $request): View
    {
        $eventservicetype = $this->model->findOrFail($id);

        if($request->ajax())
        {
            return view('admin.eventservices.types.modals.modal-edit')->with('event_service_type', $eventservicetype);
        }

        return view('admin.eventservices.types.edit')
        ->with('breadcrums', $this->breadcrums()
            ->addByRouteName(trans('Service Type'), 'admin.event_service_type.index')
            ->add(trans('Edit'))
        )
        ->with('event_service_type', $eventservicetype);
    }

    public function update(EventServiceTypeRequest $request): RedirectResponse|JsonResponse
    {
        try {
            $eventservicetype = $this->model->findOrFail($request->input('id'));

            $eventservicetype->update($request->validated());

            if($request->ajax())
            {
                return response()->json([
                    'msg' => trans('notifySuccess')
                ]);
            }

            if($eventservicetype)
            {
                return $request->input('submitter') == 'save'
                    ? back()->with('success', __('notifySuccess'))
                    : to_route('admin.event_service_type.index')->with('success', __('notifySuccess'));
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

            $this->model->findOrFail($id)->delete();

            if($request->ajax())
            {
                return response()->json([
                    'msg' => trans('notifySuccess')
                ]);
            }

            return to_route('admin.event_service_type.index')->with('success', __('notifySuccess'));
        } catch (\Throwable $th) {

            if($request->ajax())
            {
                throw $th;
            }

            return back()->with('error', $th->getMessage());
        }
    }
}
