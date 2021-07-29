<?php

use App\Core\Request;
use App\Core\Routing\Route;

/**
 * Register the auto loader
 * 
 */
require __DIR__ . '/vendor/autoload.php';

/**
 * direct the routes
 * 
 */
Route::register(
	// request uri
	Request::uri(),

	// the method use of the uri
	Request::method()
);
