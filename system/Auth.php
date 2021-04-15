<?php

namespace App\Core;

class Auth
{
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
            $_SESSION["RESPONSE_MSG"] = "User not found.";
            redirect('login');
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

    /**
     * This will protect the routes if not authenticated
     * 
     */
    public static function routeGuardian($middleware)
    {
        if (!empty($middleware)) {
            if ($middleware == 'auth') {
                if (!static::isAuthenticated()) {
                    redirect('login');
                }
            }
        }
    }
}
