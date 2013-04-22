<?php

/*
=== stosować jeśli zwracana zmienna z funkcji bądz zwykla funkcja może zamiast samych wartości true/false dostać np. jakiegoś stringa,
<string> == true 	// zwroci TRUE
$foo == true ) 		// zwróci TRUE, oprócz $foo = ['', false, 0]

Jednym słowem przy === aby było prawdą musi być ten sam typ zmiennych

//-----------------------------------

// if('hello' == true) 		// TRUE
// if('hello' === true)		// FALSE
// if('' == true) 			// FALSE
// if(true === true)		// TRUE
// if(1 == true)			// TRUE
// if(1 === true)			// FALSE

jeśli funkcja() zwraca TRUE to sprawdzamy tak:

if(funkcja() === true)
if(funkcja() !== true)

//----------------------------------------------------------------
// NULL, empty()
//----------------------------------------------------------------

przy używaniu == w porównaniach - empty() i NULL zachowuje się tak samo:
$zmienna = ''; 		// empty(), == NULL, == '', === ''
$zmienna2 = NULL; 	// empty(), == NULL, == '', === NULL

// !!!
$zmienna3 = 0; 		// empty(), == NULL, == ''
$zmienna4 = '0'; 	// empty()

if($zmienna5 == '')
	echo 'tak';die;

*/

//-----------------------------------
NULL = true

it has not been set to any value yet.
it has been unset().

//----------------------------------------------------------------
// Conditionals - if
// elseif() - w PHP razem pisane
//----------------------------------------------------------------

if($a xor $b)
if($a ^= $b)
	echo "tak!"; //zwraca jeśli $a jest TRUE albo $b jest TRUE, ale nie naraz

if( 2 == 3 ):
	echo("ok");
elseif( 3 == 3 ): // elseif - razem!
	echo("ok2");
else:
	echo("nie");
endif;

//----------------------------------------------------------------
// Conditionals - switch
//----------------------------------------------------------------

$answer = 0;
if(isset($_GET['answer']))
	$answer = $_GET['answer'];
	
switch($answer)
{
	default:
		echo "Wybierz 1, 2 lub 3 w \$_GET[\"answer\"]";
		break;
	case 1:
	case "one":
	case "uno":
		echo "jeden";
		break;
	case 2:
		echo "dwa";
		break;
	case 3:
		echo "trzy";
		break;
	case ($answer > 3):
		echo "powyzej 3!"
		break;
}

//----------------------------------------------------------------
// Conditionals - Ternary (potrójny) Operator
//----------------------------------------------------------------

$koszyk = 1;
$zdanie = "W Twoim koszyku ". (($koszyk > 0) ? "jest cos!" : "nie ma nic!");
// echo($zdanie);

$var = 5;
// $is_greater = ($var > 2) ? true : false;
// $is_greater = ($var > 2) ? 'tak' : 'nie';$is_greater = (1 > 2) ?: 'nie';
$is_greater = (1 > 2) ?: 'nie';
// echo $is_greater;

$isset = !isset($var) ?: true;
echo $isset; // 1

//-----------------------------------
// Zamiast if, switch
//-----------------------------------

$miesiace = array(
	'Styczen' 	=> 'Jest styczen!',
	'Luty'		=> 'Jest luty',
	'Marzec'	=> 'Jest marzec!'
);

$miesiac = 'Luty';
$miesiac2 = 'luty';

// echo $miesiace[$miesiac];

echo isset($miesiace[$miesiac2]) ? $miesiace[$miesiac2] : 'Nie ma takiego miesiąca!'; // - ta konstrukcja tylko przy echo isset() dziala, JESZCZE PRZY CZYMŚ
