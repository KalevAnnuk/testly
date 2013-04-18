<?php
/** Created by Jetbrains Phpstorm .... */
class Request
{

	public $controller = DEFAULT_CONTROLLER;
	public $action = 'index';
	public $params = array();

	public function __construct()

	{
		if (isset($_SERVER['PATH_INFO'])) {
			if ($path_info = explode('/', $_SERVER['PATH_INFO'])) { //remove first number of exploded array
				array_shift($path_info); // Kustutab 1. liikme ja reastab liikmed uuesti.
				//Kontrollitakse, kas PATH_INFO 1. liige on olemas, siis antud classi controlleri omaduse väärtuseks saab
				//PATH_INFO  massivi esimene liige. Juhul kui pole esimest liiget, pannakse controllerile väärtus welcome
				$this->controller = isset($path_info[0]) ? array_shift($path_info) : 'welcome';
				//Kontrollitakse, kas PATH_INFO 1. liige on olemas, siis antud classi action väärtuseks saab allesjäänud
				//pathinfo 1. liige. Juhul kui pathinfos pole esimest liiget pannakse antud classi omaduse väärtuseks index
				$this->action = isset($path_info[0]) && ! empty ($path_info[0]) ? array_shift($path_info) : 'index';
				//Kontrollitakse, kas pathinfo 1. liige on olemas, siis antakse classi params väärtuseks allesjäänud pathinfo 1
				//liige, juhul kui liige puudub antakse väärtuseks NULL.
				$this->params = isset($path_info[0]) ? $path_info : NULL;
			}
		}

	}
	//Funksioon ümbersuunamiseks. Parameetriks on $destination, mis saab oma väärtuse sellel hetkel kui ta välja kutsutakse.
	// nt! auth.php, $request->redirect('tests'); kus string test omistatakse $destination väärtuseks.
	// redirect meetod, mis omab parameetrit nimega $destination ja käivitab brauseri URL antud juhul BASE_URL /testly/. ja
	//liimib  sellele otsa $destination (tests)
	public function redirect($destination)
	{
		header('Location: '.BASE_URL.$destination);
	}
}
//Kui kuskil tehakse $request vastu päring, siis käivitatakse uuesti Request class
$request = new Request;