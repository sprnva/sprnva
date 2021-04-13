<?php

namespace App\Core;

use App\Core\App;

class Request
{
	/**
	 * Fetch the request URI.
	 *
	 * @return string
	 */
	public static function uri()
	{
		$base_uri = (App::get('base_url') != "/") ?
			str_replace(App::get('base_url'), "", $_SERVER['REQUEST_URI'])
			: $_SERVER['REQUEST_URI'];

		return trim(parse_url($base_uri, PHP_URL_PATH),  '/');
	}

	/**
	 * Fetch the request method.
	 *
	 * @return string
	 */
	public static function method()
	{
		return $_SERVER['REQUEST_METHOD'];
	}

	/**
	 * Validates the POST method inputs
	 * 
	 */
	public static function validate($uri, $datas = [])
	{
		$errorList = "";
		foreach ($datas as $key => $data) {
			if (empty($_POST[$key])) {
				$errorList .= "&bull; {$key} is required but has no value.<br>";
			}
		}

		if (!empty($errorList)) {
			$_SESSION["VALIDATION_ERROR"] = $errorList;
			redirect($uri);
			exit();
		}

		foreach ($_POST as $key => $value) {
			$post_data[$key] = sanitizeString($value);
		}

		return $post_data;
	}

	/**
	 * this will protect routes for being access in the
	 * url without authentication
	 * 
	 */
	public static function authProtection($switch = false)
	{
		// skip checking this route for authentication
		return ($switch) ?
			[
				'login',
				'register',
				'welcome',
				'migration',
				'migrate-run'
			]
			: [];
	}
}
