<?php

session_start();

use App\Core\App;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

/**
 * Require a view.
 *
 * @param  string $name
 * @param  array  $data
 */
function view($name, $data = [])
{
    extract($data);

    if (!file_exists("app/views/{$name}.view.php")) {
        throwException("View [{$name}] not found", new Exception());
    }

    return require "app/views/{$name}.view.php";
}

/**
 * Require a package view.
 *
 * @param  string $path
 * @param  array  $data
 */
function packageView($path, $data = [])
{
    extract($data);

    if (!file_exists("system/{$path}.view.php")) {
        throwException("A package view [{$path}] not found", new Exception());
    }

    return require "system/{$path}.view.php";
}

/**
 * Redirect to a new page.
 *
 * @param  string $path
 */
function redirect($path, $message = [])
{
    $path = App::get('base_url') . $path;
    if (!empty($message)) {
        $_SESSION["RESPONSE_MSG"] = $message;
    }

    header("Location: {$path}");
}

/**
 * set the public location
 * 
 * @param string $uri
 */
function public_url($uri = "")
{
    return App::get('base_url') . "public" . $uri;
}

/**
 * set a new route.
 *
 * @param  string $route
 * @param mixed $data
 */
function route($route, $data = "")
{
    if (!empty($data)) {
        $data = "/{$data}";
    }

    return App::get('base_url') . "{$route}" . $data;
}

/**
 * sanitize strings
 * 
 * @param string $data
 */
function sanitizeString($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);

    return $data;
}

/**
 * This will send an email to a specified email-address
 * 
 * @param mixed $subject
 * @param mixed $body
 * @param string $requestEmail
 */
function sendMail($subject, $body, $requestEmail)
{
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = App::get('config')['app']['smtp_host'];                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = App::get('config')['app']['smtp_sender'];                     //SMTP username
        $mail->Password   = App::get('config')['app']['smtp_password'];                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

        //Recipients
        $mail->setFrom('sprnva04@gmail.com', 'Sprnva');
        $mail->addAddress($requestEmail);

        //Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $body;
        $mail->send();

        $result_msg = [
            "Message has been sent",
            "success"
        ];
    } catch (Exception $e) {
        $result_msg = [
            "Message could not be sent. Mailer Error: {$mail->ErrorInfo}",
            "danger"
        ];
    }

    redirect('forgot/password', $result_msg);
}

/**
 * display session message then 
 * clear it instantly on refresh
 * 
 * @param string $errorSession
 * @param string $type
 */
function msg($errorSession)
{
    if (!empty($_SESSION[$errorSession])) {
        $msg = "<div class='alert alert-" . $_SESSION[$errorSession][1] . "' role='alert' style='border-left-width: 4px;'>" . $_SESSION[$errorSession][0] . "</div>";

        unset($_SESSION[$errorSession]);
    } else {
        $msg = "";
    }

    return $msg;
}

/**
 * generate random strings
 * 
 * @param int $length
 */
function randChar($length = 6)
{
    $str = "";
    $characters = array_merge(range('A', 'Z'), range('a', 'z'), range('0', '9'));
    $max = count($characters) - 1;
    for ($i = 0; $i < $length; $i++) {
        $rand = mt_rand(0, $max);
        $str .= $characters[$rand];
    }
    return $str;
}

/**
 * This will throw a exeption
 */
function throwException($message, $exeption = '')
{
    packageView('Exceptions/exception', compact('message', 'exeption'));
    exit();
}


// add additional helper functions from the users
require __DIR__ . '/../config/function.helpers.php';
