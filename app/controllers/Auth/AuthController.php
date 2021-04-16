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

    public function forgotPassword()
    {
        if (Auth::isAuthenticated()) {
            redirect('home');
        }

        $pageTitle = "Forgot Password";
        return view('auth/forgot-password', compact('pageTitle'));
    }

    public function sendResetLink()
    {
        $request = Request::validate('forgot/password', [
            'reset-email' => 'required',
        ]);

        $isEmailExist = App::get('database')->select("*", "users", "email = '" . $request['reset-email'] . "'");

        if (!$isEmailExist) {
            redirect('forgot/password', ['E-mail not found in the server.', 'danger']);
        } else {

            $token = md5(randChar('10'));

            $subject = "Sprnva password reset link";
            $emailTemplate = file_get_contents(__DIR__ . '/../../../system/Email/stubs/email.stubs');

            $app_name = ["{{app_name}}", "{{username}}", "{{link_token}}", "{{year}}"];
            $values = [App::get('config')['app']['name'], $isEmailExist['fullname'], "localhost/sprnva/" . $token, date('Y')];
            $body_content = str_replace($app_name, $values, $emailTemplate);

            $body = $body_content;
            sendMail($subject, $body, $request['reset-email'], 'forgot/password');

            $insertData = [
                'email' => $request['reset-email'],
                'token' => $token,
                'created_at' => date("Y-m-d H:i:s")
            ];
            App::get('database')->insert('password_resets', $insertData);
        }
    }

    public function resetPassword()
    {
        $pageTitle = "Reset Password";
        return view('auth/password-reset', compact('pageTitle'));
    }
}
