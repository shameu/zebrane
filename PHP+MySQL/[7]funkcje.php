<?php

// funkcje - krótkie (można je łatwo modyfikować) w zwracające wartości (return) - UNIKAĆ echo w funkcji
// powinny robić tylko i wyłącznie jedną rzecz

//----------------------------------------------------------------
// Nieznana liczba argumentów
// foreach(func_get_args() as $val)
//----------------------------------------------------------------

// func_num_args() - zwraca tablicę wszystkich elementów
// func_get_arg($i) - zwraca pojedynczy el. $i
// func_get_num() - zwraca ilosc argumentow

function sumaMulti()
{
	$suma = 0;

	foreach(func_get_args() as $val)
	{
		$suma+=$val;
	}
	
	return $suma;
}

echo("suma: ".sumaMulti(1,1,2,2,3,3));
echo("<br /><br />");

//----------------------------------------------------------------
// Funkcje ze zmiennymi statycznymi
// jesli zmienna jest static to jej wartość się nie zmienia na domyślną po ponownym użyciu
// JEJ WARTOŚĆ ZMIENIA SIĘ DLA FUNKCJI na stałe - przed ponownym użyciem w skrypcie będzie zmieniona
//----------------------------------------------------------------

function foo()
{
	static $a = 0;
	echo($a.'<br />');
	$a++;
}

foo();
foo();
foo();
echo("<br /><br />");

//----------------------------------------------------------------
// Funkcje zmienne - używanie zmiennych jako nazw funkcji
//----------------------------------------------------------------

function foo($liczba)
{
	echo('liczba to: '.$liczba);
}

$bar = 'foo';
$bar(15);

//----------------------------------------------------------------
// Zmienne globalne
// global $liczba_nie_globalna;
//----------------------------------------------------------------

$liczba_nie_globalna = 10;

function suma($liczba1, $liczba2=0)
{
	global $liczba_nie_globalna;
	$liczba3 = $liczba_nie_globalna;

	if($liczba1 == '')
		echo("nie podano 1szej liczby");
	else
		return $liczba1+$liczba2+$liczba3;
}

echo("suma liczb: ".suma(5));
echo("<br /><br />");

//----------------------------------------------------------------
// Funkcja PrettyPrint - łane wyświetlanie wartości z tablicy
//----------------------------------------------------------------

function pp($value) // pretty print
{
	echo '<pre>';
	print_r($value); // z <pre> przejrzyste wyświetlenie
	echo '</pre>';
}

//----------------------------------------------------------------
// Wyciąganie zminnej z tablicy - Pluck
//----------------------------------------------------------------

# 1
function array_pluck($toPluck, $arr)
{
	// $ret = []; // PHP 5.4, ret = return
	$ret = array();

	foreach ($arr as $item) {
		$ret[] = $item[$toPluck];
	}

	return $ret;
}

$people = array(
	array('name' => 'Jeffrey', 'age' => 27, 'occupation' => 'Web developer'),
	array('name' => 'Tom', 'age' => 50, 'occupation' => 'SEO'),
	array('name' => 'Dick', 'age' => 30, 'occupation' => 'Marketing')
);

// pp($people);
// pluck - wyszarpać

$plucked = array_pluck('occupation', $people); // czasem warto najpierw napisać to, a potem stworzyć funkcję - lepiej zorientujemy się co chcemy osiągnąć
// print_r($plucked);

//----------------------------------------------------------------
// Funckcje anonimowe - bez nazwy - używane najczęściej w callback() (array_map() etc.)
// array_pluck z użyciem array map:
//----------------------------------------------------------------

# 2
function array_pluck2($toPluck, $arr)
{
	return array_map(function($item) use($toPluck) { // funkcja zostanie uruchomiona dla każdego el. w $arr
		// return 'jeff'; // Array ( [0] => jeff [1] => jeff [2] => jeff )

		/*$item['name'] = 'changed'; // zmienia we wszystkich tablicach ['name'] na 'changed'
 		return $item;*/

		// WAŻNE!!!
 		return $item[$toPluck]; // błąd, bo $toPluck jest zmienną lokalną i nie widzi jej tu
 		// ABY TEMU ZARADZIĆ:
 		// można zmodyfikować "$ret = array_map(function($item) use($toPluck) {" - dodając use($toPluck), ew.
 		// zrobić zmienną globalną

	}, $arr);
}

$people = array(
	array('name' => 'Jeffrey', 'age' => 27, 'occupation' => 'Web developer'),
	array('name' => 'Tom', 'age' => 50, 'occupation' => 'SEO'),
	array('name' => 'Dick', 'age' => 30, 'occupation' => 'Marketing')
);

$plucked = array_pluck2('occupation', $people);

pp($plucked);