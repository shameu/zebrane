<?php

/** MYSQL 
mysql_connect- łączy z bazą danych
mysql_pconnect- łączy trwale z bazą danych
mysql_create_db- tworzy bazę danych
mysql_select_db- wybiera bazę danych
mysql_close- kończy połączenie z bazą danych
mysql_query- wysyła zapytanie do bazy danych

mysql_create_db("xxx"); 
mysql_select_db("xxx"); 

mysql_num_rows()
mysql_fetch_object($query)
mysql_fetch_array($query, ???) //MYSQL_ASSOC - tylko tabl asocjacyjna, MYSQL_NUM - zwykła tablica, MYSQL_BOTH - tablicy indeksowanej asocjacyjnie i numerycznie.
mysql_fetch_assoc($query)
mysql_insert_id() - mysql_insert_id();
mysql_result(rezultat ,wiersz [,kolumna])- Bardzo przydatna funkcja, gdy trzeba się odwołać do konkretnego pola w konkretnym rzędzie wyniku. Wystarczy podać jako pierwszy argument zmienną z rezultatem zapytania, jako drugi wiersz, a jako trzeci (opcjonalnie)pole w danym wierszu (domyślne to 0).
*/

//-----------------------------------
// PRZECIW MYSQL INJECTION!
// mysql_real_escape_string()
// http://php.net/manual/pl/function.mysql-real-escape-string.php
//-----------------------------------

$conn = mysql_connect('localhost', 'wapi', 'mojwquad');
$selectDB = mysql_select_db('symfony');

if($conn && $selectDB)
{
	echo('Polaczono z baza danych!<br />');
	
	//---
	
	$query = mysql_query('SELECT * from `subs` where `id` < 4');
	$ile = mysql_num_rows($query);
	
	echo('wierszy: '.$ile.'<br />');
	
	while($res = mysql_fetch_array($query, MYSQL_ASSOC))
	{
		print_r($res);
		echo("<br />");
	}
	
	//---
	
	$query = mysql_query('SELECT * from `subs`');
	echo mysql_result($query,0,1); //wiersz "0" wyników, pole 1 - wiersze i pola liczone od "0"
	echo "<br />";
	
	//---
	
	$query = mysql_query('SELECT * from `subss`');
	echo mysql_error();
	
	mysql_close($conn);
}
else
	die();

//----------------------------------------------------------------
// TutsPlus
//----------------------------------------------------------------

$config = array(
	'DB_HOST' => 'localhost',
	'DB_USERNAME' => 'nauka',
	'DB_PASSWORD' => 'symfony'
);

/* USING THE OLD mysql_connect API IS AN ANTI-PATTERN! */

function connect($host = 'localhost', $username, $password, $db = '') // $db = '' - wartość opcjonalna
{
	$conn = mysql_connect($host, $username, $password);
	// jeśli nie łączy mimo dobrych danych to znajdujemy w php.ini "mysql.sock" i wklejamy wartość np. //tmp/mysql.sock przy:
	// mysql_connect('localhost://tmp/mysql.sock', 'nauka', 'symfony') or die('Brak połączenia z MySQL');

	// if(!$conn) die('Brak połączenia z bazą!');

	// mysql_select_db('practise');
	// można wstawić tez:
	if(!empty($db))
		mysql_select_db($db, $conn);

	return $conn;
}

function query($query, $conn)
{
	$results = mysql_query($query, $conn); // $conn żeby potwierdzić, że przyjmuje połączenie

	if($results)
	{
		$rows = array();

		while($row = mysql_fetch_object($results)) {
			$rows[] = $row;
		}

		// zwraca tablicę obiektów
		return $rows;
	}	

	return false;
}

//-----------------------------------
// używanie:

$conn = connect($config['DB_HOST'],
				$config['DB_USERNAME'],
				$config['DB_PASSWORD'],
				'practise');

$results = query('SELECT * from users', $conn);