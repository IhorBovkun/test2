<?php

/**
* 
*/
class Router
{
	private $routes;

	public function __construct()
	{
		$routesPath = ROOT.'/config/routes.php';
		$this->routes = include($routesPath);
	}

	/**
	*	Returns request string
	*/
	private function getURI()
	{
		if (!empty($_SERVER['REQUEST_URI'])) {
		return trim($_SERVER['REQUEST_URI'], '/');
		}
	}

	public function run()
	{
		// Get request string
		$uri = $this->getURI();


		// Is there such request string at routes.php
		foreach ($this->routes as $uriPattern => $path) {
			

			// Compare $uriPattern & $uri
			if (preg_match("~$uriPattern~", $uri)) {
				

				// Get internal path from extrenal path, according rules of regexp
				$internalRoute = preg_replace("~$uriPattern~", $path, $uri);


				// Define controller & action for request
				$segments = explode('/', $internalRoute);

				$controllerName = array_shift($segments).'Controller';
				$controllerName = ucfirst($controllerName);

				$actionName = 'action'.ucfirst(array_shift($segments));

				$parameters = $segments;


				// Include class-controller's file
				$controllerFile = ROOT.'/controllers/'.$controllerName.'.php';
				if (file_exists($controllerFile)) {
					include_once($controllerFile);
				}


				// Create Obj of Class-controller, call method (Action)
				$controllerObject = new $controllerName;

				$result = call_user_func_array(array($controllerObject, $actionName), $parameters);
				if ($result) break;
			}
		}
	}
}