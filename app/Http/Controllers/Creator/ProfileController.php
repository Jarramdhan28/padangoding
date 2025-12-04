<?php

namespace App\Http\Controllers\Creator;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Http\Resources\Creator\AuthorResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Profiler\Profile;

class ProfileController extends Controller
{
    public function index()
    {
        return view('pages.creator.profile.index');
    }

    public function accountSettings()
    {
        return view('pages.creator.profile.account-settings');
    }

    public function getData()
    {
        $user = Auth::user();
        return ResponseHelper::fetchResponse((bool) $user, new AuthorResource($user));
    }

    public function update(ProfileRequest $request)
    {
        $user = Auth::user();
        $data = $request->validated();
        $user->update($data);

        return ResponseHelper::sendResponse((bool) $user, 'update', 'Profile');
    }

    public function uploadProfile(Request $request)
    {
        dd($request->all());
    }
}
