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
        $user_data = DB()->select("*", 'users', "id='$user_id'")->get();

        return view('/auth/profile', compact('user_data', 'pageTitle'));
    }

    public function update()
    {
        $request = Request::validate('/profile', [
            'email' => ['required', 'email']
        ]);

        $user_id = Auth::user('id');

        $update_data = [
            'email' => "$request[email]",
            'fullname' => "$request[name]"
        ];

        DB()->update('users', $update_data, "id = '$user_id'");
        redirect("/profile", ["message" => "Profile information updated.", "status" => 'success']);
    }

    public function changePass()
    {
        $request = Request::validate('/profile', [
            'old-password' => ['required'],
            'new-password' => ['required'],
            'confirm-password' => ['required']
        ]);

        $response_message = Auth::resetPassword($request);
        redirect("/profile", $response_message);
    }

    public function destroy($user_id)
    {
        Request::validate();
        DB()->delete('users', "id = '$user_id'");

        Auth::logout();
    }
}
