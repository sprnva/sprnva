<?php

error_reporting(~E_NOTICE);

use App\Core\App;
use App\Core\Database\QueryBuilder;
use App\Core\Database\Connection;

require 'helpers.php';

App::bind('config', require 'config/config.php');

App::bind(
    'base_url',
    "/" . App::get('config')['app']['base_url']
);

App::bind('database', new QueryBuilder(
    Connection::make(App::get('config')['database'])
));
