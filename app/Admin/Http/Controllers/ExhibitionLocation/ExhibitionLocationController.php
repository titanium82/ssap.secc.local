<?php

namespace App\Admin\Http\Controllers\ExhibitionLocation;

use App\Admin\DataTables\ExhibitionLocation\ExhibitionLocationDataTable;
use App\Admin\Http\Controllers\Controller;
use App\Admin\Http\Requests\ExhibitionLocation\ExhibitionLocationRequest;
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
        return $datatable->render('admin.exhibition_locations.index', [
            'breadcrums' => $this->breadcrums()->add(trans('Exhibition location'))
        ]);
    }

    public function create(Request $request): View
    {
        if($request->ajax())
        {
            return view('admin.exhibition_locations.modals.modal-create');
        }

        return view('admin.exhibition_locations.create')
        ->with('breadcrums', $this->breadcrums()
            ->addByRouteName(trans('Exhibition location'), 'admin.exhibition_location.index')
            ->add(trans('Add'))
        );
    }

    public function store(ExhibitionLocationRequest $request): RedirectResponse|JsonResponse
    {
        try {

            $data = $request->validated();
            
            $exhibitionLocation = $this->model->create($data);

            if($request->ajax())
            {
                return response()->json([
                    'msg' => trans('notifySuccess')
                ]);
            }
        
            if($exhibitionLocation)
            {
                return $request->input('submitter') == 'save' 
                    ? to_route('admin.exhibition_location.edit', $exhibitionLocation->id)->with('success', __('notifySuccess')) 
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
        $exhibitionLocation = $this->model->findOrFail($id);

        if($request->ajax())
        {
            return view('admin.exhibition_locations.modals.modal-edit')->with('exhibition_location', $exhibitionLocation);
        }
        
        return view('admin.exhibition_locations.edit')
        ->with('breadcrums', $this->breadcrums()
            ->addByRouteName(trans('Exhibition location'), 'admin.exhibition_location.index')
            ->add(trans('Edit'))
        )
        ->with('exhibition_location', $exhibitionLocation);
    }

    public function update(ExhibitionLocationRequest $request): RedirectResponse|JsonResponse
    {
        try {
            $exhibitionLocation = $this->model->findOrFail($request->input('id'));

            $exhibitionLocation->update($request->validated());

            if($request->ajax())
            {
                return response()->json([
                    'msg' => trans('notifySuccess')
                ]);
            }

            if($exhibitionLocation)
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

        $exhibitionLocation = $this->model->select('id', 'name')
        ->whereAny($this->model->getFillable(), 'like', "%$keyword%")
        ->limit(10)
        ->get()
        ->map(function($item) {
            return [
                'id' => $item->id,
                'text' => $item->name
            ];
        });

        return [
            'results' => $exhibitionLocation->toArray()
        ];
    }
}