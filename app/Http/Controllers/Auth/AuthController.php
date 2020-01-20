<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    public function authenticate()
    {
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            // 認證通過...
            return redirect()->intended('dashboard');
        }
    }
}