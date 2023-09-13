<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;

class AuthController extends Controller
{
    
    public function backendLogin()
    {
        return view('backend.login.main', [
            'layout' => 'login'
        ]);
    }

    
    public function login(LoginRequest $request)
    {
        try {
            if (!\Auth::attempt([
                'email' => $request->email,
                'password' => $request->password
            ])) {
                throw new \Exception('Wrong email or password.');
            }
        }
        catch (\Exception $e) {
            return dd($e->getMessage());
        }
    }

    
    public function logout()
    {
        \Auth::logout();
        return redirect(route('backendLogin'));
    }
}
