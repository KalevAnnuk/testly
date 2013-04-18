<?php
//võtab failide sisu kasutusele
require 'config.php';
require 'classes/database.php';
require 'classes/Request.php';
require 'classes/user.php';


//1. Võtame $request objekti controlleri väärtuse.
//2. Liidame saadud väärtuse kahe stringiga 'controllers/' ja '.php'
//3. Kontrollime, kas saadud nimega controllerit on olemas
if (file_exists('controllers/'.$request->controller.'.php')) {
	//võtab selle faili sisu kasutusele
	require 'controllers/'.$request->controller.'.php';

	// tee uus objekt $controller
	$controller = new $request->controller;
	//TODO: Henno, seleta!
	if (isset($controller->requires_auth)) {
		// Küsib autentimist
		$_user->require_auth();
	}
	// antud kontrollerile omistame $requestist  actioni
	$controller->{$request->action}();

} // kui tahetud kontrollerit ei leitud, siis kuva veateade
else {
	echo "The page '{$request->controller}' does not exist";

}
