<?php
class Request
{

	public $controller=DEFAULT_CONTROLLER;
	public $action = 'index';
	public $params = array();

	public function __construct()
	{
		if (isset($_SERVER['PATH_INFO'])) {
			if ($path_info = explode('/', $_SERVER['PATH_INFO'])) {
				array_shift($path_info);
				$this->controller = isset ($path_info[0]) ? array_shift($path_info) : 'welcome';
				var_dump($this->controller);
				$this->action = isset ($path_info[0]) && ! empty($path_info[0]) ? array_shift($path_info) : 'index';
				$this->params = isset ($path_info[0]) ? $path_info : NULL;
			}
		}
	}

	public function redirect($destionation)
	{
		header('Location: '.BASE_URL.$destionation);
	}
}

$request = new Request;