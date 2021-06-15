<?php

// authentication

$router->post('/logout', ['AuthController@logout']);

$router->group(['prefix' => 'login'], function ($router) {
    $router->get('/', ['AuthController@index']);
    $router->post('/', ['AuthController@authenticate']);
});

$router->group(['prefix' => 'register'], function ($router) {
    $router->get("/", ['RegisterController@index']);
    $router->post("/", ['RegisterController@store']);
});

$router->group(['prefix' => 'profile', 'middleware' => ['auth']], function ($router) {
    $router->get("/", ['ProfileController@index']);
    $router->post('/', ['ProfileController@update']);
    $router->post('/changepass', ['ProfileController@changePass']);
    $router->post('/delete', ['ProfileController@delete']);
});

$router->group(['prefix' => 'forgot/password'], function ($router) {
    $router->get("/", ['AuthController@forgotPassword']);
    $router->post("/", ['AuthController@sendResetLink']);
});

$router->group(['prefix' => 'reset/password'], function ($router) {
    $router->get("/{id}", ['AuthController@resetPassword']);
    $router->post("/", ['AuthController@passwordStore']);
});
