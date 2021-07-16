<?php

namespace App\Controllers;

use App\Core\App;
use App\Core\Auth;
use App\Core\Request;

class AuthController
{
    protected $pageTitle;

    public function index()
    {
        Auth::isAuthenticated();

        $pageTitle = "Login";
        return view('/auth/login', compact('pageTitle'));
    }

    public function store()
    {
        $request = Request::validate('/login', [
            'username' => ['required'],
            'password' => ['required']
        ]);

        Auth::authenticate($request);
    }

    public function logout()
    {
        $request = Request::validate();
        Auth::logout($request);
    }

    public function forgotPassword()
    {
        Auth::isAuthenticated();

        $pageTitle = "Forgot Password";
        return view('/auth/forgot-password', compact('pageTitle'));
    }

    public function sendResetLink()
    {
        $request = Request::validate('/forgot/password', [
            'email' => ['required'],
        ]);

        Request::passwordResetLink($request);
    }

    public function resetPassword($token)
    {
        $pageTitle = "Reset Password";
        return view('/auth/password-reset', compact('pageTitle', 'token'));
    }

    public function passwordStore()
    {
        $request = Request::validate('/reset/password/' . $_POST['token'], [
            'new_password' => ['required'],
            'confirm_password' => ['required']
        ]);

        Auth::resetPasswordWithToken($request);
    }
}
