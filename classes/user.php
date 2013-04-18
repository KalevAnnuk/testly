<?php
//Uue objekti tüüpi nimega user.
class user
{

	// Atribuut nimega $logged_in mis defaultis on false
	public $logged_in = FALSE;

	//Funktsioon, mis käivitatakse iga kord kui seda tüüpi objekt luuakse.
	function __construct()
	{
		//Alustab sessiooni, (server hoiab $_SESSION massiivi kasutaja info alles).
		session_start();
		//Küsitakse, kas $_SESSIONIS on olemas user_id, siis selle classi atribuut logged_id -le omistatakse väärtus TRUE
		if (isset($_SESSION['user_id'])) {
			$this->logged_in = TRUE;
		}
	}

	/**
	 * Kontrollib, kas kasutaja on siiselogitud, kui ei ole siis suunatakse auth lehele
	 */
	public function require_auth()
	{
		//Annab ligipääs request objektile.
		global $request;
		//Kontrollib, kas kasutaja pole sisse logitud.
		if ($this->logged_in !== TRUE) {
			//Kontrollin, kas päring tuli ajaxiga või otse brauserist.
			if (isset($_SERVER['HTTP_X_REQUESTED_WITH'])
				//Kontrollib, kas selle väärtus on XMLHttpRequest
				&& $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'
			) {
				//Vastuses brauserile lisatakse antud http error kood (mida javascript kontrollib).
				header('HTTP/1.0 401 Unauthorized');
				exit (json_encode(array('data' => 'session_expired')));
			} else {
				$_SESSION['session_expired'] = TRUE;
				$request->redirect('auth');
			}
		}
	}
}
//uus objekt, minu klassist
$_user = new user;