<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginView()
    
    {
        return view('pages.login');
    }

    public function loginUser(LoginRequest $request)
    {
        $credential = filter_var($request->validated()['credentials'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $request->merge([$credential => $request->validated()['credentials']]);

        if(Auth::attempt($request->only($credential, 'password')))
        {
            return redirect('/');
        }

        return back()->withErrors([
            'loginError' =>'Incorrect credentials.'
        ]);
    }
}
