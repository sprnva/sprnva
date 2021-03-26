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
        if (Auth::isAuthenticated()) {
            redirect('home');
        }

        $pageTitle = "Login";
        return view('auth/login', compact('pageTitle'));
    }

    public function authenticate()
    {
        $request = Request::validate('login', [
            'username' => 'required',
            'password' => 'required'
        ]);

        $userDdata = App::get('database')->select("*", "users", "username = '$request[username]' AND password = md5('$request[password]')");

        Auth::authenticate($userDdata);
    }

    public function logout()
    {
        session_destroy();
        redirect('login');
    }
}
