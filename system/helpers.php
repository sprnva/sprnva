<?php

session_start();

use App\Core\App;

/**
 * Require a view.
 *
 * @param  string $name
 * @param  array  $data
 */
function view($name, $data = [])
{
    extract($data);

    return require "app/views/{$name}.view.php";
}

/**
 * Redirect to a new page.
 *
 * @param  string $path
 */
function redirect($path, $message = "")
{
    $path = App::get('base_url') . "/" . $path;
    $_SESSION["ALERT_MSG"] = $message;
    header("Location: {$path}");
}

/**
 * set the public location
 * 
 * @param string $uri
 */
function public_url($uri = "")
{
    return App::get('base_url') . "/public" . $uri;
}

/**
 * set a new route.
 *
 * @param  string $route
 * @param mixed $data
 */
function route($route, $data = "")
{
    if (!empty($data) || $data == 0) {
        $data = "/{$data}";
    }

    return App::get('base_url') . "/{$route}" . $data;
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

// add additional helper functions from the users
require __DIR__ . '/../config/function.helpers.php';
