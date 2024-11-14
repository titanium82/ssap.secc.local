<?php

namespace App\Admin\Http\Controllers\Auth;

use App\Admin\Http\Controllers\Controller;
use App\Admin\Http\Requests\Auth\ProfileRequest;
use App\Core\Enums\Gender;
use App\Core\Services\File\FileUploadService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function __construct(
        public FileUploadService $fileUploadService
    )
    {
        
    }
    public function index(): View
    {
        $auth = auth('admin')->user();

        return view('admin.auth.profile', [
            'auth' => $auth,
            'gender' => Gender::asSelectArray(),
            'breadcrums' => $this->breadcrums()->add(__('Profile'))
        ]);
    }

    public function update(ProfileRequest $request): RedirectResponse
    {
        $data = $request->validated();
        if($request->hasFile('avatar'))
        {
            $data['avatar'] = $this->fileUploadService->setFolderForAdmin()
            ->setFile($data['avatar'])
            ->upload($data['avatar'])
            ->getInstance();
        }

        auth('admin')->user()->update($data);

        return back()->with('success', __('notifySuccess'));
    }

}
