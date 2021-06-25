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

$router->get('/', ['WelcomeController@home', 'auth']);

$router->get('/home', function () {
    Auth::routeGuardian(['auth']);

    $pageTitle = "Home";
    return view('/home', compact('pageTitle'));
});
