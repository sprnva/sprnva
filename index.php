<?php

use App\Core\Router;
use App\Core\Request;

/**
 * Register the auto loader
 * 
 */
require __DIR__ . '/vendor/autoload.php';

/**
 * direct the routes
 * 
 */
Router::load(__DIR__ . '/vendor/sprnva/framework/src/Routes.php')
	->direct(
		// request uri
		Request::uri(),

		// the method use of the uri
		Request::method()
	);
