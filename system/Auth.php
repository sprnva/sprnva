<?php

namespace App\Core;

class Auth
{
    public static function isAuthorized($uri, $skippedUri)
    {
        if (in_array($uri, $skippedUri)) {
            return 1;
        }

        return static::isAuthenticated();
    }

    public static function isAuthenticated()
    {
        return $_SESSION["AUTH"]['id'];
    }

    public static function authenticate($datas)
    {
        if (!$datas) {
            $_SESSION["VALIDATION_ERROR"] = "User not found.";
            redirect('login');
            exit();
        }

        $users = [];
        foreach ($datas as $key => $data) {
            $users[$key] = $data;
        }

        $_SESSION["AUTH"] = $users;
        redirect('home');
    }

    public static function user($record)
    {
        return $_SESSION['AUTH'][$record];
    }
}
