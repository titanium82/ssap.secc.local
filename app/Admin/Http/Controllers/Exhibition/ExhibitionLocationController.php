<?php

namespace App\Admin\Http\Controllers\Exhibition;

use App\Admin\DataTables\Exhibition\ExhibitionLocationDataTable;
use App\Admin\Http\Controllers\Controller;
use App\Admin\Http\Requests\Exhibition\ExhibitionLocationRequest;
use App\Models\ExhibitionLocation;
use Illuminate\Http\{JsonResponse, RedirectResponse, Request};
use Illuminate\View\View;

class ExhibitionLocationController extends Controller
{

    public function __construct(
        public ExhibitionLocation $model,
    )
    {
    }

    public function index(ExhibitionLocationDataTable $datatable): View|JsonResponse
    {
        return $datatable->render('admin.exhibitions.locations.index', [
            'breadcrums' => $this->breadcrums()->add(trans('Exhibition location'))
        ]);
    }

    public function create(Request $request): View
    {
        if($request->ajax())
        {
            return view('admin.exhibitions.locations.modals.modal-create');
        }

        return view('admin.exhibition_location.create')
        ->with('breadcrums', $this->breadcrums()
            ->addByRouteName(trans('Exhibition location'), 'admin.exhibition_location.index')
            ->add(trans('Add'))
    );
    }

    public function store(ExhibitionLocationRequest $request): RedirectResponse|JsonResponse
    {
        try {

            $data = $request->validated();

            $exhibitionlocation = $this->model->create($data);

            if($request->ajax())
            {
                return response()->json([
                    'msg' => trans('notifySuccess')
                ]);
            }

            if($exhibitionlocation)
            {
                return $request->input('submitter') == 'save'
                    ? to_route('admin.exhibition_location.edit', $exhibitionlocation->id)->with('success', __('notifySuccess'))
                    : to_route('admin.exhibition_location.index')->with('success', __('notifySuccess'));
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
        $exhibitionlocation = $this->model->findOrFail($id);

        if($request->ajax())
        {
            return view('admin.exhibitions.locations.modals.modal-edit')->with('exhibition_location', $exhibitionlocation);
        }

        return view('admin.exhibitions.locations.edit')
        ->with('breadcrums', $this->breadcrums()
            ->addByRouteName(trans('Exhibition location'), 'admin.exhibition_location.index')
            ->add(trans('Edit'))
        )
        ->with('exhibition_location', $exhibitionlocation);
    }

    public function update(ExhibitionLocationRequest $request): RedirectResponse|JsonResponse
    {
        try {
            $exhibitionlocation = $this->model->findOrFail($request->input('id'));

            $exhibitionlocation->update($request->validated());

            if($request->ajax())
            {
                return response()->json([
                    'msg' => trans('notifySuccess')
                ]);
            }

            if($exhibitionlocation)
            {
                return $request->input('submitter') == 'save'
                    ? back()->with('success', __('notifySuccess'))
                    : to_route('admin.exhibition_location.index')->with('success', __('notifySuccess'));
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
    public function show($id): View
    {
        $exhibitionlocation = $this->model->findOrFail($id);

        if(request()->ajax())
        {
            return view('admin.exhibition_location.modals.show')
            ->with('exhibition_location', $exhibitionlocation);
        }

        return view('admin.exhibition_locations.show')
        ->with('breadcrums', $this->breadcrums()->addByRouteName(trans('Exhibition_Locaiton'), 'admin.exhibition_location.index')
            ->addByRouteName(trans('Location'), 'admin.exhibition_location.index')
            ->add(trans('Show'))
        )
        ->with('exhibition_location', $exhibitionlocation);
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

            return to_route('admin.exhibition_location.index')->with('success', __('notifySuccess'));
        } catch (\Throwable $th) {

            if($request->ajax())
            {
                throw $th;
            }

            return back()->with('error', $th->getMessage());
        }
    }

    public function searchSelect(Request $request)
    {
        $keyword = $request->input('term', '');

        $exhibitionlocation = $this->model->select('id', 'fullname')
        ->whereAny($this->model->getFillable(), 'like', "%$keyword%")
        ->limit(10)
        ->get()
        ->map(function($item) {
            return [
                'id' => $item->id,
                'text' => $item->fullname
            ];
        });

        return [
            'results' => $exhibitionlocation->toArray()
        ];
    }
}
