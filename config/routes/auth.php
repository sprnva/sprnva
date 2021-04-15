<?php

// authentication
$router->get('login', ['AuthController@index']);
$router->post('login', ['AuthController@authenticate']);
$router->get('logout', ['AuthController@logout']);

$router->get("register", ['RegisterController@index']);
$router->post("register", ['RegisterController@store']);

$router->get("profile", ['ProfileController@index', 'auth']);
$router->post('profile', ['ProfileController@update', 'auth']);
$router->post('profile/changepass', ['ProfileController@changePass', 'auth']);
$router->post('profile/delete', ['ProfileController@delete', 'auth']);

$router->get("forgot/password", ['AuthController@forgotPassword']);
$router->post("forgot/password", ['AuthController@sendResetLink']);
$router->get("reset/password/{id}", ['AuthController@resetPassword']);
