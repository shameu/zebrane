<?php

/*
|----------------------------------------------------------------
| arrays
|----------------------------------------------------------------
*/
// array() = []

// array deferencing
// var_dump( getArray()['numbers'][2]);

/*
|----------------------------------------------------------------
| traits
|----------------------------------------------------------------
*/
/*trait Foo
{
	private $zmienna = 'asd';

	public function sayFoo()
	{
		return 'Foo!';
	}
}

trait FooBar
{
	use Foo, Bar;
}

class Some
{
	// use Foo, Bar; // można uzywać kilku traitsów - interfejsów też mozna kilka
	//ew.
	use FooBar;
}

$some = new Some;
echo $some->sayFoo();
*/
// metody o tej samej nazwie w trait i class:
// metoda z klasy zasłania metodę z trait
// metoda z trait o tej samej nazwie jest wazniejsza niz metoda z klasy dziedziczonej o tej samej nazwie

// traits part 2:

// jeśli mamy 2 traitsy i oba mają te same nazwy, to przy używaniu trait w bazie musimy określić, funkcje z którego chcemy użyć:
use Foo, Bar {
	Foo::sayBar insteadof Bar;
	// aliasy
	Foo::sayFoo as sayFooFromFoo;
	// zmieniać widocznosc metod
	Foo:sayBar as protected;
}

# $obiekt = new Klasa;
// var_dump($obiekt instance of Klasa); //true

//sprawdzanie jakich traitsow używa klasa:
// var_dump(class_uses($obietkt)); //zwraca tablicę
// var_dump(in_array('Foo', class_uses($obietkt))); //zwraca true/false
// var_dump(isset(class_uses('Nazwa_klasy')['Nazwa_trait']));

/*
|----------------------------------------------------------------
| closures
|----------------------------------------------------------------
*/

/*w PHP4 jeśli mamy zmienną, a poniżej funkcje w funkcji, to aby mieć z tej wewnętrznej funkcji
dostęp do zmiennej musialismy w niej napisać use ($nazwa_zmiennej)

innymi słowy $this w klasie (w PHP 5.4) odnosi się z każdego miejsca do el. klasy*/

// ?!:
// echo 'asd'. PHP_EOL;

//bindTo() - ee
//Closure::bind($fun, $b);

/*
|----------------------------------------------------------------
| UPLOAD progress
|----------------------------------------------------------------
*/

/*
|----------------------------------------------------------------
| Session handler
|----------------------------------------------------------------
*/
// PHP 5.3 session_set_save_handler

/*
|----------------------------------------------------------------
| W PHP4 MOŻNA otwierać strony z przeglądarki z wyłączonym Apache!
|----------------------------------------------------------------
*/
// z konsoli:
php -S localhost:8888
php -S localhost:8888 -t /document/root
// potem z przeglądarki:
localhost:8888

/*
|----------------------------------------------------------------
| JSON
|----------------------------------------------------------------
*/

 echo json_encode($obiekt); - wyświetlenie w postaci json
 //ale, nie wyświetli jeśli w klasie mamy prywatne metody
 //ew. można zrobić metodę zwracającą te zmienne i:
 echo json_encode($obiekt->metoda);
 //w PHP4:
 class Klasa implements JsonSerializable
 public function jsonSerialize()
 {
 	return $this->toArray();
 }
 //potem:
 echo json_encode($obiekt);

 /*
 |----------------------------------------------------------------
 | time float - $start = microtime(true);
 |----------------------------------------------------------------
 */
//sprawdzanie czasu wykonania:
$start = microtime(true);
sleep(1);
echo (microtime(true) - $start);
// w PHP4:
echo ($mictorime(true) - $_SERVER['REQUEST_TIME_FLOAT']); //czas rozpoczecia skryptu

/*
|----------------------------------------------------------------
| direct call
|----------------------------------------------------------------
*/
// w PHP 5.3:
$date = new DateTime();
echo $date->format('Y-m-d');
// w PHP 5.4
echo (new DateTime())->format(...)

//DateTime()->add(new DateInterval) ??

/*
|----------------------------------------------------------------
| binary format
|----------------------------------------------------------------
*/

$hex = 0x19;
$bin = 0b11001; //ten format

/*
|----------------------------------------------------------------
| callable
|----------------------------------------------------------------
*/

 /*
 |----------------------------------------------------------------
 | session status
 |----------------------------------------------------------------
 */

 echo session_status();

 PHP_SESSION_DISABLED;
 PHP_SESSION_NONE;
 PHP_SESSION_ACTIVE;

 if(session_status() == PHP_SESSION_DISABLED) //etc.