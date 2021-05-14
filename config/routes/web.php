<?php

// upload
$router->post('/file/upload', ['FileUploadController@store', 'auth']);
$router->delete('/file/upload', ['FileUploadController@delete', 'auth']);

// your routes goes here
$router->get('/', ['WelcomeController@home', 'auth']);
$router->get('/home', ['WelcomeController@home', 'auth']);
