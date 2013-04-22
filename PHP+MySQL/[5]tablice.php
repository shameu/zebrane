<?php

/*
array_slice()
array_splice()
array_filter()
array_push()
array_unshift()
array_pop()
array_shift()
array_map()
array_walk()

explode()
implode()

count() == length()

array_reverse()
array_uniqie()
array_rand()

array_keys($tablica) - zwraca tablicę kluczy tablicy
*/

//----------------------------------------------------------------
// TABLICE
//----------------------------------------------------------------

$tablica = array(); // PHP 5.3
$tablica = []; // PHP 5.4

$tablica[0][0] = 2;
$tablica[0][1] = 4;
$tablica[0][] = 6;
$tablica[0][] = 8;
$tablica[0]["tekst"] = 9;

//-----------------------------------

$tablica2 = array(
	'raz' => 'uno',
	'dwa' => 'due',
	'trzy' => 'tre'
);

foreach($tablica2 as $pierwszy => $drugi)
{
	echo '<li>'.ucwords($pierwszy).' - '.$drugi.'</li>';
}

//----------------------------------------------------------------
// foreach:
//----------------------------------------------------------------

foreach($tablica[0] as $key => $row):
	echo('<p>' . $key . " : " . $row . '</p'); // <p> zamiast <br />
endforeach;

//----------------------------------------------------------------
// list() - przerabia tablicę na zmienne
// np.:
// list($raz, $dwa) = array('raz', 'dwa');;
// echo($raz . ' - ' . $dwa);
//----------------------------------------------------------------

//----------------------------------------------------------------
// each() — Return the current key and value pair from an array and advance the array cursor
// np.:
// $foo = array('raz', 'dwa', 'trzy');
// $bar = each($foo);
// pp($bar);
/*Array
(
    [1] => raz
    [value] => raz
    [0] => 0
    [key] => 0
)*/
//----------------------------------------------------------------

//----------------------------------------------------------------
// list() = each()
//----------------------------------------------------------------

while(list($key, $row) = each($tablica[0])):
	echo($key." - ".$row.'<br />');
endwhile;

//----------------------------------------------------------------
// array_map() - każdy element tablicy zostanie wysłany do funkcji
//----------------------------------------------------------------

$array = file('pliki/inny.doc'); // zapisanie wszystkich linii pliku do tablicy

if( count($array) ) {
	array_map(function($row) {
		echo(strtoupper($row) . '<br />'); // każda linia z dużej litery
	}, $array);
}

//----------------------------------------------------------------
// funkcje
//----------------------------------------------------------------

$input = array("red", "green", "blue", "yellow");

$output = array_slice($input, 2, <ile wybrać z tablicy>);  // $input is now array("blue", "yellow")
$output = array_splice($input, 2); // $input is now array("red", "green")

$output = array_filter($tablica, function($item) { return strlen($item) == 3; }); // wynik tablicy $output: "red"

array_push($tablica, 'wartosc'); // dodaje do tablicy - na koniec
array_pop($tablica); // usuwa ostatni el.

array_unshift($tablica, 'pierwszy el!'); //dodaje do tablicy pierwszy el.
array_shift($tablica); // usuwa pierwszy el.

??? array_map(), array_walk()

count() i sizeof() to samo robi

#for($i=0; $i<sizeof($tablica[0]); $i++):
for($i=0; $i<count($tablica[0]); $i++):
	echo($tablica[0][$i]."<br />");
endfor;

//----------------------------------------------------------------
// string na tablice i odwrotnie 
//----------------------------------------------------------------

$odczytDoExplode = "ala|ma|kota|a|kot|ma|ale";
$poExplode = explode("|", $odczytDoExplode);

foreach($poExplode as $row):
	echo($row.'<br />');
endforeach;

echo($poExplode); //echo pokazuje tylko info, że to tablica
print_r($poExplode); //wyświetla tablicę wraz z zawartością w niej

$poImplode = implode(":", $poExplode);
echo($poImplode);

//-----------------------------------
// extract - rozbija tablicę na zmienne:

$tablica = array(
	'imie' => 'Bartek',
	'nazwisko' => 'Szypula');

extract($tablica); // tworzy zmienne $imie, $nazwisko

//-----------------------------------
// compact - przeciwienstwo extract

//----------------------------------------------------------------
// sortowanie tablicy
//----------------------------------------------------------------

/*  sortowanie tablicy 
asort()- sortuje rosnąco tablice asocjacyjne według wartości kluczy zachowując przypisanie kluczy do wartości
arsort()- sortuje malejąco tablice asocjacyjne według wartości kluczy zachowując przypisanie kluczy do wartości
ksort()- sortuje rosnąco tablice asocjacyjne według kluczy zachowując przypisanie kluczy do wartości
krsort()- sortuje rosnąco tablice asocjacyjne według kluczy zachowując przypisanie kluczy do wartości
sort()- sortuje rosnąco zwykłe tablice
rsort()- sortuje malejąco zwykłe tablice
uasort()- funkcja sortująca tablice asocjacyjne za pomocą zdefiniowanej przez użytkownika funkcji porównującej elementy (nazwa funkcji jest podawana za pomocą drugiego parametru)
usort()- funkcja sortująca zwykłe tablice za pomocą funkcji zdefiniowanej przez użytkownika
uksort()- funkcja sortująca tablice asocjacyjne według klucza za pomocą funkcji zdefiniowanej przez użytkownika
*/

$tabl = array("pies", "kot", "swinia", "sum", "kot");

echo("nieposortowane: " . implode(", ", $tabl));
echo("<br />");
sort($tabl);
echo("posortowane: " . implode(", ", $tabl));
echo("<br />");
$tabl = array_reverse($tabl);
echo("odwrocone: " . implode(", ", $tabl));

//----------------------------------------------------------------
// usuwa powtarzające się pola
//----------------------------------------------------------------

$tabl = array_unique($tabl);

//----------------------------------------------------------------
// random
//----------------------------------------------------------------

$randomAnimal = $tabl[array_rand($tabl, 1)];
echo($randomAnimal);*/

//----------------------------------------------------------------
// end() - zwraca ostatni el. tablicy - nie stosować
//----------------------------------------------------------------

//----------------------------------------------------------------
// tak też można tworzyć tablice:
//----------------------------------------------------------------

$array1 = array("a" => "green", "red", "blue", "red");

// Array
// (
    // [a] => green
    // [0] => red
    // [1] => blue
    // [2] => red
// )