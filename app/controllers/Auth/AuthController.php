<?php

namespace App\Controllers;

use App\Core\App;
use App\Core\Auth;
use App\Core\Request;
use PHPMailer\PHPMailer\PHPMailer;

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

        $pageTitle = "Reset Password";
        return view('auth/forgot-password', compact('pageTitle'));
    }

    public function sendResetLink()
    {
        $request = Request::validate('forgot/password', [
            'reset-email' => 'required',
        ]);

        $subject = "Sprnva password reset link";
        $body = "test email";
        $mail = new PHPMailer();
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host = 'localhost';
        $mail->SMTPAuth = false;
        $mail->SMTPAutoTLS = false;
        $mail->Port = 25;

        //Recipients
        // $mail->setFrom('techsupport@bacolodprosperityfeedmill.com', 'Sprnva');
        $mail->addAddress($request['reset-email']);

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $body;
        $result = $mail->send();

        if (!$result) {
            $result_msg = "Message was not sent <br />PHPMailer Error: " . $mail->ErrorInfo;
        } else {
            $result_msg = "Message has been sent";
        }

        redirect('forgot/password', $result_msg);
    }
}
