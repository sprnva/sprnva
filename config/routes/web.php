<?php

require __DIR__ . '/auth.php';
require __DIR__ . '/migration.php';

// your routes goes here
$router->get('', 'WelcomeController@home');
$router->get('home', 'WelcomeController@home');
