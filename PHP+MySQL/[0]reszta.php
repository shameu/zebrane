<?php

//----------------------------------------------------------------
// INCLUDE
//----------------------------------------------------------------

// include(), include_once(), require() and require_once() ; (include 'plik.php';)
// _once - tylko raz w doku jest włączane

// include - warning jeśli nie ma pliku, require - Fatal error i przerwanie jeśli nie ma pliku (require - wymagany)

// require_once i include_once sprawdza czy wcześniej plik nie był już dołączany z _once
// jeśli ten sam plik jest dołączony jeszcze raz, ale bez _once to dołączy go ponownie

//----------------------------------------------------------------
// REFERENCJE
// credentials - referencje
//----------------------------------------------------------------

$zmienna = "NAPIS!";

function wypisz(&$tekst, $change = null)
{
	if($change)
		$tekst = "NAPIS PO ZMIANIE!";
		
	echo($tekst."<br/ >");
}

wypisz($zmienna);
wypisz($zmienna, true);
wypisz($zmienna);

//-----------------------------------

$a = 1;

//$b = $a; 	// BEZ REFERENCJI
$b = &$a; 	// REFERENCJA

$b = 2;

echo('$a: '.$a);
echo("<br />");
echo('$b: '.$b);

unset($a); 	// usuwanie referencji i zmiennej

//----------------------------------------------------------------
// SESJE
//----------------------------------------------------------------

session_start();

if(isset($_GET['unset']) && $_GET['unset'] == true)
	unset($_SESSION['licznik']);

if(isset($_SESSION['licznik'])):
	$_SESSION['licznik']++;
else:
	$_SESSION['licznik'] = 1;
endif;

echo("Byłeś na stronie już ".$_SESSION['licznik']." razy.<br />");
echo("unset licznik: <a href=\"?unset=true\">wyloguj</a>");*/

session_id() - returns the session id for the current session.

//-----------------------------------
// TutsPlus

// przed tym nie może nic być, ale można np. includować plik z funkcjami
session_start(); // tworzy się mni. cookie z sesją

$_SESSION['username'] = 'rregun';

session_destroy();
$_SESSION = array(); // dobry nawyk na całkowite wyczyszczenie
// przydałoby się jeszcze usunięcie cookie z sesją

var_dump($_SESSION); // po samym "session_destroy();" sesja zostaje w $_SESSION superglobal, dobry nawyk "$_SESSION = array();"

//----------------------------------------------------------------
// Przekierowanie
//----------------------------------------------------------------

define('USERNAME', 'rregun');
$username = $_POST['username'];

if($username === USERNAME){
	header("Location: admin.php");
	die(); // ważne - bo nie wyświetli żadnej innej zawartości
}

return ($username === USERNAME && $password === PASSWORD)

//----------------------------------------------------------------
// WYJĄTKI
//----------------------------------------------------------------

// nadpisana klasa Exception
	class extendedException extends Exception { 
    function __toString() { 
      echo "Błąd to: ".$this->getMessage()."<br />"; 
      echo "Wystąpił w linijce ".$this->getLine()."<br />"; 
      echo "i w pliku ".$this->getFile(); 
    } 
  } 

function dziel($a, $b)
{
	if($b == 0)
		// throw new Exception("Nie można dzielić przez \"0\"");
		throw new extendedException("Nie można dzielić przez \"0\"");
		
	return $a/$b;
}

try
{
	echo("Wynik: ".dziel(5,0));
}
// catch(Exception $e)
catch(extendedException $e)
{
	// echo("Błąd: $e");
	echo $e->__toString();
	echo("<br />");
	print_r($e->getTrace());
	//wyświetla dokładnie info co i gdzie wywaliło wyjątek - PLIK, LINIJKE, NAZWĘ FUNKCJI, ARGUMENTY FUNKCJI
}

//----------------------------------------------------------------
// COOKIES
//----------------------------------------------------------------

// cookies można przeglądać w Chrome - inspect -> resources
// Edit This Cookie Chrome Extension

// setcookie('fontSize', 25, time()+60*30);
// setcookie('fontSize', 25, time()+60*30, '/admin');

// '/admin' - widoczna w katalogu admin i potomnych
// '/' - cała domena

// setcookie('fontSize', 25, time()-60*30); // usuwanie cookie

//-----------------------------------
// przetrzymywanie cookie w tablicy:

setcookie('prefs[fontSize]', 25, time()+60*30);
setcookie('prefs[favoriteCategory]', 25, time()+60*30);
setcookie('prefs[screenWidth]', 25, time()+60*30);

// echo $_COOKIE['fontSize'];

?>

<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<style>
		/*body { font-size: <?php echo $_COOKIE['fontSize'] ?> }*/
	</style>
</head>
<body>

	This is something.

	<?php
	if(isset($_COOKIE['prefs'])):
		foreach($_COOKIE['prefs'] as $key => $val)
		{
			echo '<li>'.htmlspecialchars($key).' : '.htmlspecialchars($val).'</li>';
		}
	endif;
	?>

</body>
</html>

<?php

//----------------------------------------------------------------
// GET POST
// wszystko w "form[GET+POST+HTML5].php"
//----------------------------------------------------------------

//----------------------------------------------------------------
// HEREDOCS - przechowywanie treści emaila
//----------------------------------------------------------------

$post = array(
	'author'		=> 'Bartek',
	'title'			=> 'Moj post',
	'body'			=> 'Cialo!',
	'publish-date' 	=> '06-10-2012'
);

// $email = "<h1>$post['title']</h1>"; // - BŁĄD!
// $email = "<h1>{$post['title']}</h1>"; // - TAK JEST OK - Z {}

// ZŁY SPOSÓB PRZECHOWYWANIA INFO:
$email = "<h1>{$post['title']}</h1>";
$email .= "<p>By: {$post['author']}</p>";
$email .= "<div>{$post['body']}</div>"; // - TAK JEST OK! z {}

// LEPSZY:
$email = sprintf("<h1>%s</h1><p>By: %s</p><div>%s</div>", $post['title'], $post['author'], $post['body']);

// PRAWIDŁOWY:
$email = <<<EOT
<h1>{$post['title']}</h1>
<p>By: {$post['author']}</p>

<div>{$post['body']}</div>
EOT;
// MUSI BYĆ TU PRZEJŚCIE DO KOLEJNEJ LINII, bo wyskoczy błąd! - plik php nie może się konczyc Hearedocs'em
// echo $email;

// WAŻNE!!!
// DODATKOWO MOZNA SKORZYSTAĆ z funkcji extract()

extract($post); // - zaminia zmienne na tablice! mega fajna funkcja!
// echo $author;
//dzięki niej można:

// zamist EOT może być np. TXT, ale może być spacji przed/po TXT
$email = <<<TXT
<h1>$title</h1>
<p>By: $author</p>

<div>$body</div>
TXT;

echo $email;

//----------------------------------------------------------------
// NAMESPACES
//----------------------------------------------------------------

# 1 - functions.php
<?php namespace App\DB; 

function connect()
{
	echo 'connecting';
	echo '<br />';

	/*$conn = new PDO('mysql:host=localhost;dbname=practise', // Fatal error: Class 'App\DB\PDO' not found
					'nauka',
					'symfony');*/

	 $conn = new \PDO('mysql:host=localhost;dbname=practise', // Fatal error: Class 'App\DB\PDO' not found
					'nauka',
					'symfony');
}

//-----------------------------------
#2 - index.php
<?php

require 'functions.php';

# 1
// App\DB\connect(); // albo odwołujemy się w ten sposób do funkcji, albo u góry wpisujemy ten sam NAMESPACE

# 2
// namespace App\DB;
// connect(); // przy "<?php namespace App\DB;"

# 3
// use App\DB;
// DB\connect();

# 4
use App\DB as Database;
Database\connect();

//----------------------------------------------------------------
// goto
// The goto operator can be used to jump to another section in the program.
//----------------------------------------------------------------

goto a;
echo 'Foo';
 
a:
echo 'Bar';

//----------------------------------------------------------------
// declare - encoding
//----------------------------------------------------------------

// The encoding declare value is ignored in PHP 5.3 unless php is compiled with --enable-zend-multibyte.
declare(encoding='ISO-8859-1');

//----------------------------------------------------------------
// declare - TICK [wykorzystywane np. do sprawdzania użycia pamięci]:
// http://stackoverflow.com/questions/3656257/what-are-ticks-used-for-in-php
// http://forum.junowebdesign.com/php-articles/22319-ticks-php-construct-youve-never-used.html
// declare(tick/encoding)
// <statement>
//----------------------------------------------------------------

// funkcja zarejestrowana jako obsługująca tick'i (rejestracja poniżej)
function tick_handlera()
{
    echo nl2br("tick_handler() called\n");
}

// rejestracja funkcji dla tick'a
register_tick_function('tick_handlera'); 									// ticks=1 - wywołuje tick_handlera()
// Od której linii (w poniżej rejestracji/deklaracji) ma zostać wykonana
declare(ticks=2)
{
	$a = '';		// wywołuje dla ticks = 1
	print_r($a); 	// wywołuje dla ticks = 1 , 2
	echo $a; 		// wywołuje dla ticks = 1 , 2, 3
}

//----------------------------------------------------------------
// trigger_error() - wywalanie notice/fatal error z daną treścią
//----------------------------------------------------------------

trigger_error('WIADOMOSC', E_USER_NOTICE); 	// Notice: WIADOMOSC, nie przerywa wykonywania skryptu
trigger_error('WIADOMOSC', E_USER_ERROR); 	// Fatal error: WIADOMOSC, przerywa wykonywanie wkryptu

//----------------------------------------------------------------
// ENUM - typ wyliczeniowy - nie ma w PHP ale można stworzyć klasę ze zmiennymi const
// Jest to zwyczajna lista wartości stałych całkowitych const int.
//----------------------------------------------------------------

class DaysOfWeek
{
    const Sunday = 0;
    const Monday = 1;
    // etc.
}

var $today = DaysOfWeek::Sunday;

//-----------------------------------
// WERSJA PRZYGOTOWANA DLA PHP:
// The SplEnum class
// SplEnum gives the ability to emulate and create enumeration objects natively in PHP.

<?php
class Month extends SplEnum {
    const __default = self::January;
    
    const January = 1;
    const February = 2;
    const March = 3;
    const April = 4;
    const May = 5;
    const June = 6;
    const July = 7;
    const August = 8;
    const September = 9;
    const October = 10;
    const November = 11;
    const December = 12;
}

echo new Month(Month::June) . PHP_EOL;

try {
    new Month(13);
} catch (UnexpectedValueException $uve) {
    echo $uve->getMessage() . PHP_EOL;
}

//----------------------------------------------------------------
// Predefined Constants
// http://php.net/manual/en/reserved.constants.php
//----------------------------------------------------------------

PHP_VERSION
PHP_OS
// max integer - ~2.1 biliona ?
PHP_INT_MAX - The largest integer supported in this build of PHP. Usually int(2147483647). Available since PHP 4.4.0 and PHP 5.0.5
PHP_EOL - The correct 'End Of Line' symbol for this platform. Available since PHP 4.3.10 and PHP 5.0.2

// skrypt w php odpalony z konsoli: PHP_EOL - przejście do nowej linii (tak jak <br /> w HTML)

/*
You use PHP_EOL when you want a new line, and you want to be cross-platform.
This could be when you are writing files to the filesystem (logs, exports, other).
You could use it if you want your generated HTML to be readable. So you might follow your <br> with a PHP_EOL.
You would use it if you where running php as a script from cron and you needed to output something and have it be formated for a screen.
You might use it if you where building up anemail to send that needed some formatting.
*/

