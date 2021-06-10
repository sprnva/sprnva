<?php

use App\Core\App;
use App\Core\Auth;

// your routes goes here
$router->get('/', ['WelcomeController@home', 'auth']);
$router->get('/home', ['WelcomeController@home', 'auth']);

// file upload
$router->group(['prefix' => 'file/upload', 'middleware' => ['auth']], function ($router) {
    $router->post('/', ['FileUploadController@store']);
    $router->delete('/', ['FileUploadController@delete']);
});
