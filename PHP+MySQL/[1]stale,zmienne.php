<?php

/*
STAŁE:
Define(..., ...) vs const ... = ...;

Until PHP 5.3, const could not be used in the global scope. You could only use this from within a class.
This should be used when you want to set some kind of constant option or setting that pertains to that class.
Or maybe you want to create some kind of enum.

define can be used for the same purpose, but it can only be used in the global scope.
It should only be used for global settings that affect the entire application.

An example of good const usage is to get rid of magic numbers.
Take a look at PDO's constants. When you need to specify a fetch type, you would type PDO::FETCH_ASSOC, for example.
If consts were not used, you'd end up typing something like 35 (or whatever FETCH_ASSOC is defined as). This makes no sense to the reader.

An example of good define usage is maybe specifying your application's root path or a library's version number.
*/

define('MIN_VALUE', '0.0');   // RIGHT - Works OUTSIDE of a class definition.
define('MAX_VALUE', '1.0');   // RIGHT - Works OUTSIDE of a class definition.

//const MIN_VALUE = 0.0;         WRONG - Works INSIDE of a class definition.
//const MAX_VALUE = 1.0;         WRONG - Works INSIDE of a class definition.

class Constants
{
  //define('MIN_VALUE', '0.0');  WRONG - Works OUTSIDE of a class definition.
  //define('MAX_VALUE', '1.0');  WRONG - Works OUTSIDE of a class definition.

  const MIN_VALUE = 0.0;      // RIGHT - Works INSIDE of a class definition.
  const MAX_VALUE = 1.0;      // RIGHT - Works INSIDE of a class definition.

//-----------------------------------

// var_export() - Outputs or returns a parsable string representation of a variable
// var_export( <zmienna / tablia> ); - wyświetli zmienną / tablicę w postaci stringa
// $b = var_export( <zmienna / tablia>, TRUE ); - zapisze zmienną / tablicę w postaci stringa w zmiennej $b

$a = 123;
var_export($a); // wyświetli 123

$b = var_export($a, true); // zapisze wartość zmiennej $a w zmiennej $b
echo $b;

//-----------------------------------

// zmienna globalna - każda zmienna zadeklarowana poza funkcjami, klasami itd.
$foo = 'foo';

function local()
{
	// wszystkie zmienne zadeklarowane w funkcji stają się zmiennymi lokalnymi
	// dostęp do zmiennych globalnych - spoza funkcji:

	# 1
	global $foo;
	$foo = 'bar';

	# 2
	$GLOBALS['foo'] = 'bar';
}

local();
echo $foo; // bar

//-----------------------------------

$GLOBALS - tablica ze zmiennymi globalnymi + wykaz tablic zmiennych

usuwanie zmiennej globalnej z funckcji:

unset($GLOBALS['zmienna']); // usuwanie zmiennej globalnej 
unset($zmienna); - użyte w funkcji usunie jedynie zmienną lokalną, poza funkcją usunie zmienną globalną

//-----------------------------------

$thumb_name = "{$filename}-thumb.{$extension}"; // zamiast "$filename-thumb.$extension" powinno się z {} oddzielać zmienne!

//-----------------------------------

$zwierze = "kota";
$zdanie = "Ala ma " . $zwierze . "\n Następna linijka.";
echo( nl2br($zdanie) );

//-----------------------------------

$foobar = 2;
$buff = "foo";
$buff .= "bar";
echo $$buff;

//-----------------------------------

// reszta z dzielenia
$wynik = 96%5;
echo $wynik;

$dou = 5.555555;
echo round($dou, 2); // zaokrąglenie do 2 miejsc po przecinku
echo("<br />");
echo ceil($dou); // w góre
echo("<br />");
echo floor($dou); // w dół

$i = 1;
echo($i++ . '<br />'); // 1
$i = 1;
echo(++$i . '<br />'); // 2

//----------------------------------------------------------------
// STAŁE
//----------------------------------------------------------------

#echo __FILE__;
#echo __LINE__;

define("HELLO", "witaj!");
#echo HELLO;

//-----------------------------------

# WAŻNE!!!
// define('MAILING_LIST', 'admin/mailing_list.php'); // ważne: ścieżka jest odpowiednia dla index.php, ale nie dla redistered_users.php, więc:
define('MAILING_LIST', $_SERVER['DOCUMENT_ROOT'].'/_tutsPlus - PHP/23-24-Email-Registration/admin/mailing_list.php');
// echo $_SERVER['DOCUMENT_ROOT'];die;
// echo $_SERVER['SERVER_ADDR'];die;

//----------------------------------------------------------------
// RZUTOWANIA
//----------------------------------------------------------------

# 1
(int), (integer) - rzutuj do typu całkowitego
(real), (double), (float) - rzutuj do typu rzeczywistego
(string) - rzutuj do ciągu
(array) - rzutuj do tablicy
(object) - rzutuj do obiektu

$zmiennoprzecinkowa = 5.4;
$calkowita = (int)$zmiennoprzecinkowa;
#echo $calkowita;

# 2
(dozwolone to "integer", "double", "string", "array", "object")*/

$liczba = 10.3; 
settype($liczba, "integer"); 
#echo $liczba;

//-----------------------------------
// Zwraca rodzaj zmiennej:

gettype();

//-----------------------------------

is_bool() - Finds out whether a variable is a boolean
is_float() - Finds whether the type of a variable is float
is_numeric() - Finds whether a variable is a number or a numeric string
is_string() - Find whether the type of a variable is string
is_array() - Finds whether a variable is an array
is_object() - Finds whether a variable is an object

//----------------------------------------------------------------
// Dodatkowe
//----------------------------------------------------------------+

//----------------------------------------------------------------
// list() - przerabia tablicę na zmienne
//----------------------------------------------------------------

list($month, $day, $year) = sscanf("June 7th, 2012", "%s %[^,], %d");
//to samo robi:
list($month, $day, $year) = array('June', '7th', 2012);

printf("%s %s %d", $month, $day, $year);

// ZAMIST list() można zrobić:

sscanf("June 7th, 2012", "%s %[^,], %d", $month, $day, $year);
printf("%s %s %d", $month, $day, $year);