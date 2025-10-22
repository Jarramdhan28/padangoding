<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('pages.auth.login');
    }

    public function store(LoginRequest $request)
    {
        $credentials = $request->validated();

        if(Auth::attempt($credentials, true)){
            $request->session()->regenerate();

            $user = auth()->user();
            $user->last_login = now();
            $user->save();

            $intendedUrl = session()->get('url.intended');
            if($intendedUrl){
                $redirectUrl = $intendedUrl;
            }else{
                if($user->hasRole('admin')){
                    $redirectUrl = route('admin.dashboard');
                }if($user->hasRole('creator')){
                    $redirectUrl = route('creator.dashboard');
                }if($user->hasRole('user')){
                    $redirectUrl = route('landing-page');
                }
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Berhasil Masuk',
                'redirect' => $redirectUrl,
            ]);
        }else{
            return response()->json([
                'status' => 'error',
                'message' => 'Silakan cek kembali username dan password',
            ]);
        }
    }
}
