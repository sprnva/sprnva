<?php

namespace App\Controllers;

use App\Core\App;
use App\Core\Auth;
use App\Core\Request;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

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
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'sprnva04@gmail.com';                     //SMTP username
            $mail->Password   = 'pirateking!';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mail->setFrom('sprnva04@gmail.com', 'Sprnva');
            $mail->addAddress($request['reset-email']);

            //Content
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $body;
            $result = $mail->send();

            if (!$result) {
                $result_msg = [
                    "Message was not sent <br />PHPMailer Error: " . $mail->ErrorInfo,
                    "danger"
                ];
            } else {
                $result_msg = [
                    "Message has been sent",
                    "success"
                ];
            }

            redirect('forgot/password', $result_msg);
        } catch (Exception $e) {
            die("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
        }
    }
}
