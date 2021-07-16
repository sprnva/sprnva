<?php

/**
 * --------------------------------------------------------------------------
 * Routes
 * --------------------------------------------------------------------------
 * 
 * Here is where you can register routes for your application.
 * Now create something great!
 * 
 */

use App\Core\Auth;

$router->get('/', function () {
    $pageTitle = "Welcome";
    return view('/welcome', compact('pageTitle'));
});

$router->get('/home', ['WelcomeController@home', 'auth']);
