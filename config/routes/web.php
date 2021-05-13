<?php

// upload
$router->post('/file/upload', ['FileUploadController@store', 'auth']);

// your routes goes here
$router->get('/', ['WelcomeController@home', 'auth']);
$router->get('/home', ['WelcomeController@home', 'auth']);
