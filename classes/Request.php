<?php
class Request
{
	public $controller;
	public $action = 'index';
	public $params = array();

	public function __construct()
	{
		if (isset($_SERVER['PATH_INFO'])) {
			if ($path_info = explode('/', $_SERVER['PATH_INFO'])) {
				//kill first member of exploded array (because its empty '/')
				array_shift($path_info);
				//set controller, action and params
				$this->controller = isset ($path_info[0]) ? array_shift($path_info[0]) : 'welcome';
				$this->action = isset ($path_info[0]) && ! empty($path_info[0]) ? array_shift($path_info) : 'index';
				$this->params = isset ($path_info[0]) ? $path_info : NULL;
			}
		}
	}
}
$request = new Request;
print_r($request);
die();