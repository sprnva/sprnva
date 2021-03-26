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
        $pageTitle = "Register";
        return view('auth/register', compact('pageTitle'));
    }

    public function store()
    {
        $request = Request::validate('register', [
            'r_email' => 'required',
            'r_username' => 'required',
            'r_password' => 'required',
        ]);

        $register_user = [
            'email' => $request['r_email'],
            'fullname' => $request['r_email'],
            'username' => $request['r_username'],
            'password' => md5($request['r_password']),
            'updated_at' => date("Y-m-d H:i:s"),
            'created_at' => date("Y-m-d H:i:s")
        ];

        App::get('database')->insert("users", $register_user);
        redirect('register', "Success register");
    }
}
