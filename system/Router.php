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
	public function direct($uri, $requestType)
	{
		if (array_key_exists($uri, $this->routes[$requestType])) {

			Auth::routeGuardian($this->routes[$requestType][$uri][1]);

			$splat  = explode('@', $this->routes[$requestType][$uri][0]);
			return $this->callAction($splat[0], $splat[1]);
		} else {
			foreach ($this->routes[$requestType] as $key => $val) {
				$pattern = preg_replace('#\(/\)#', '/?', $key);
				$pattern = "@^" . preg_replace('/{([a-zA-Z0-9\_\-]+)}/', '(?<$1>[a-zA-Z0-9\_\-]+)', $pattern) . "$@D";
				preg_match($pattern, $uri, $matches);
				array_shift($matches);

				if ($matches) {

					Auth::routeGuardian($val[1]);

					$getAction = explode('@', $val[0]);
					return $this->callAction($getAction[0], $getAction[1], $matches);
				}
			}
		}

		throwException("No route defined for [{$uri}]", new Exception());
	}

	/**
	 * Load and call the relevant controller action.
	 *
	 * @param string $controller
	 * @param string $action
	 */
	protected function callAction($controller, $action, $paramerters = [])
	{
		if (class_exists($controller)) {
			throwException("Controller [{$controller}] already exist.", new Exception());
		}

		$useController = "App\\Controllers\\{$controller}";
		$controllerClass = new $useController;

		if (!method_exists($controllerClass, $action)) {

			throwException("{$controller} does not respond to the [{$action}] action.", new Exception());
		}

		return $controllerClass->$action($paramerters[0]);
	}
}
