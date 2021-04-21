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
        if (!empty(static::user('id'))) {
            redirect('/home');
        }
    }

    /**
     * This will authenticate the users information
     * 
     * @param array $datas
     */
    public static function authenticate($request)
    {
        $datas = App::get('database')->select("*", "users", "username = '$request[username]' AND password = md5('$request[password]')");

        if (!$datas) {
            redirect('/login', ["User not found.", 'danger']);
        }

        $users = [];
        foreach ($datas as $key => $data) {
            $users[$key] = $data;
        }

        $_SESSION["AUTH"] = $users;
        Request::renewCsrfToken();

        redirect('/home');
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
                if (empty(static::user('id'))) {
                    redirect('/login');
                }
            }
        }
    }

    /**
     * removed the authenticated information stored in session
     * 
     */
    public static function logout($request = '')
    {
        if (!empty($request)) {
            Request::verifyCsrfToken($request['_token']);
            static::sessionInvalidate();
            redirect('/login');
        } else {
            static::sessionInvalidate();
            redirect('/login');
        }
    }

    /**
     * reset users password
     * used in profile reset password
     * 
     */
    public static function resetPassword($request)
    {
        $user_id = Auth::user('id');

        if (md5($request["old-password"]) == Auth::user('password')) {
            if ($request["new-password"] == $request["confirm-password"]) {
                $update_pass = [
                    'password' => md5($request["new-password"]),
                    'updated_at' => date("Y-m-d H:i:s")
                ];
                App::get('database')->update('users', $update_pass, "id = '$user_id'");
                $response_message = ["Password has changed.", "success"];
            } else {
                $response_message = ["Passwords must match.", "danger"];
            }
        } else {
            $response_message = ["Old password did not match.", "danger"];
        }

        return $response_message;
    }

    /**
     * will reset password using a token
     * used in forgot-password module
     * 
     */
    public static function resetPasswordWithToken($request)
    {
        $isTokenLegit = App::get('database')->select("email", "password_resets", "token = '$request[token]'");

        if ($isTokenLegit) {

            if ($request["new_password"] == $request["confirm_password"]) {

                $reset_password = [
                    'password' => md5($request['new_password']),
                    'updated_at' => date("Y-m-d H:i:s")
                ];

                App::get('database')->update("users", $reset_password, "email = '$isTokenLegit[email]'");

                App::get('database')->delete("password_resets", "email = '$isTokenLegit[email]' AND token = '$request[token]'");

                redirect('/login', ["Success reset password", "success"]);
            } else {
                redirect('/reset/password/' . $request['token'], ["Passwords must match.", "danger"]);
            }
        } else {
            redirect('/reset/password/' . $request['token'], ["Token is not authorized.", "danger"]);
        }
    }

    /**
     * check if the user is allowed to 
     * access a page base on roles
     * 
     */
    public static function userIsAuthorized()
    {
        if (static::user('role_id') != 1) {
            redirect('/home');
        }
    }

    public static function sessionInvalidate()
    {
        session_destroy();
    }
}
