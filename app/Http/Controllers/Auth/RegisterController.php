<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\StoreRegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function showRegisterView() 
    {
        return view('pages.register');
    }

    public function registerUser(StoreRegisterRequest $request)
    {

        $this->user->create($request->validated());

        return redirect('/')->with(
            ['registerMessage' => 'Registered Successfully']
        );
    }
}
