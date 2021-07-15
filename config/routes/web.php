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

$router->get('/test', function () {
    $hashed = '$2y$10$WUxsrnqvHMwCboDDLd0H8OHvD0/aM19EWPk3q6IHYq3qKyqHwpUPq';
    $base = '12de5a6528646c5a6ada478cd5929d9b';
    echo $hashed;
    echo '<br>';
    echo $base;
    echo '<br>';
    var_dump(checkHash($base, $hashed));
});
