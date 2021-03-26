<?php

namespace App\Core;

use Exception;

class Router
{
	/**
	 * All registered routes.
	 *
	 * @var array
	 */
	public $routes = [
		'GET' => [],
		'POST' => []
	];

	/**
	 * Load a user's routes file.
	 *
	 * @param string $file
	 */
	public static function load($file)
	{
		$router = new static;
		require $file;

		return $router;
	}

	/**
	 * Register a GET route.
	 *
	 * @param string $uri
	 * @param string $controller
	 */
	public function get($uri, $controller)
	{
		$this->routes['GET'][$uri] = $controller;
	}

	/**
	 * Register a POST route.
	 *
	 * @param string $uri
	 * @param string $controller
	 */
	public function post($uri, $controller)
	{
		$this->routes['POST'][$uri] = $controller;
	}

	/**
	 * Load the requested URI's associated controller method.
	 *
	 * @param string $uri
	 * @param string $requestType
	 */
	public function direct($uri, $requestType, $skipAuth = [])
	{
		if (Auth::isAuthorized($uri, $skipAuth)) {
			if (array_key_exists($uri, $this->routes[$requestType])) {
				return $this->callAction(
					...explode('@', $this->routes[$requestType][$uri])
				);
			} else {
				foreach ($this->routes[$requestType] as $key => $val) {
					$pattern = preg_replace('#\(/\)#', '/?', $key);
					$pattern = "@^" . preg_replace('/{([a-zA-Z0-9\_\-]+)}/', '(?<$1>[a-zA-Z0-9\_\-]+)', $pattern) . "$@D";
					preg_match($pattern, $uri, $matches);
					array_shift($matches);

					if ($matches) {
						$getAction = explode('@', $val);
						return $this->callAction($getAction[0], $getAction[1], $matches);
					}
				}
			}

			throw new Exception('No route defined for this URI');
		}

		redirect('login');
	}

	/**
	 * Load and call the relevant controller action.
	 *
	 * @param string $controller
	 * @param string $action
	 */
	protected function callAction($controller, $action, $paramerters = [])
	{
		$useController = "App\\Controllers\\{$controller}";
		$controllerClass = new $useController;

		if (!method_exists($controllerClass, $action)) {

			throw new Exception(
				"{$controller} does not respond to the {$action} action."
			);
		}

		return $controllerClass->$action($paramerters);
	}
}
