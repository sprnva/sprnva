<?php

namespace App\Controllers;

use App\Core\App;
use App\Core\Auth;
use App\Core\Request;

class RegisterController
{
    protected $pageTitle;

    public function index()
    {
        Auth::isAuthenticated();

        $pageTitle = "Register";
        return view('/auth/register', compact('pageTitle'));
    }

    public function store()
    {
        $request = Request::validate('/register', [
            'email' => 'required',
            'username' => 'required',
            'password' => 'required',
        ]);

        $register_user = [
            'email' => $request['email'],
            'fullname' => $request['name'],
            'username' => $request['username'],
            'password' => md5($request['password']),
            'updated_at' => date("Y-m-d H:i:s"),
            'created_at' => date("Y-m-d H:i:s")
        ];

        App::get('database')->insert("users", $register_user);
        redirect('/register', ["Success register", "success"]);
    }
}
