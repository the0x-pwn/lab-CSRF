<?php

namespace App\Controllers;

use Src\Authentication\Auth;

class LoginController
{
    public function index(): void
    {
        view('login');
    }

    public function login(): void
    {
        $email = request()->input('email');
        $password = request()->input('password');
        Auth::login($email, $password);
    }

    public static function logout(): void
    {
        session()->destroy();
        response()->redirect('/');
    }
}
