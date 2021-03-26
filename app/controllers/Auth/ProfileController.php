<?php

namespace App\Controllers;

use App\Core\App;
use App\Core\Auth;
use App\Core\Request;

class ProfileController
{
    protected $pageTitle;

    public function index()
    {
        $pageTitle = "Profile";
        $user_id = Auth::user('id');
        $user_data = App::get('database')->select("*", 'users', "id='$user_id'");

        return view('auth/profile', compact('user_data', 'pageTitle'));
    }

    public function update()
    {
        $email = sanitizeString($_POST['email']);
        $name = sanitizeString($_POST['name']);

        $request = Request::validate('profile', [
            'email' => 'required'
        ]);

        $user_id = Auth::user('id');

        $update_data = [
            'email' => "$request[email]",
            'fullname' => "$request[name]"
        ];

        App::get('database')->update('users', $update_data, "id = '$user_id'");
        redirect("profile");
    }
}
