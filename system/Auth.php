<?php

namespace App\Core;

class Auth
{
    /**
     * This will check if the uri
     * is authorized and can be displayed to user
     * 
     * @param string $uri
     * @param array $skippedUri
     */
    public static function isAuthorized($uri, $skippedUri)
    {
        if (in_array($uri, $skippedUri)) {
            return 1;
        }

        return static::isAuthenticated();
    }

    /**
     * This will check if authenticated
     * 
     */
    public static function isAuthenticated()
    {
        return (!empty($_SESSION["AUTH"]['id'])) ? 1 : 0;
    }

    /**
     * This will authenticate the users information
     * 
     * @param array $datas
     */
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

    /**
     * stores the authenticated user's data
     * 
     * @param string $record
     */
    public static function user($record)
    {
        return $_SESSION['AUTH'][$record];
    }
}
