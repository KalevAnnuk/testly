<?php
//Loome ühenduse MySQL serveriga, kasutan configis loodud konstante või kui ühendust ei saa annan errori.
mysql_connect(DATABASE_HOSTNAME, DATABASE_USERNAME) or mysql_error();
//valin andmebaasi või annan errori
mysql_select_db(DATABASE_DATABASE) or mysql_error();
//need päringud, mille saadan serverisse, on kodeeritud utf8
mysql_query("SET NAMES 'utf8'");
mysql_query("SET CHARACTER 'utf8'");


function q($sql, $debug = FALSE)
{
	if ($debug) {
		print "<pre>$sql</pre>";
	}
}

function get_all($sql)
{
	$q = mysql_query($sql) or mysql_error();
	while (($result[]=mysql_fetch_assoc($q)) || array_pop($result)){
		;
	}
	return $result;
}

// meetod get_one kutsutatakse välja näiteks auth.php-s. Kus antakse parameetriks $sql(päring).
function get_one($sql, $debug = FALSE)
{
	//Juhul kui debug väärtus on TRUE siis läbitakse if sisu
	if ($debug) {
		print "<pre>$sql</pre>";
	}
	//loome muutuja q, mille väärtuseks on, kas päring($sql) või failimise puhul väljub funktsioonist ja annab errori.
	$q = mysql_query($sql)or exit(mysql_error());
	//Juhul kui mysql_num_rows($q) tagastab väärtuse FALSE siis väljub funktsioonist ja annab $sql sisalduva info.
	if (mysql_num_rows($q) === FALSE) {
		exit($sql);
	}
	//Loon muutuja $result, millesse salvestan päringu tulemuse massiivi.
	$result = mysql_fetch_row($q);
	//kontrollime, kas $result on massiiv ja ja kui meil on elemente rohkem kui 0, siis tagastame $result 1. elemendi vastasel
	//juhul tagastame NULL -i
	return is_array($result) && count($result) > 0 ? $result[0] : NULL;
}

