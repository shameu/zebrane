<?php

//----------------------------------------------------------------
// Objekt stdClass
// OBJEKT - coś jak zwykła klasa, ale szybciej sie implementuje - pusta klasa, którą trzeba uzupełnić
//----------------------------------------------------------------

$person = new stdClass;
$person->first = "John";
$person->last = "Doe";
$person->job = "Teacher";

var_dump($person);
echo '<br /><br />';

//-----------------------------------

$person2 = array(
	'first' => 'John',
	'last' => 'Doe'
);

var_dump((object)$person2);

// Wyciąganie elementu tablicy:
echo $person2['first']; 

// Wyciąganie elementu objektu:
$o = (object)$person2;
echo $o->last;

/*
|----------------------------------------------------------------
| KLASY - INFO
|----------------------------------------------------------------
*/

// zmienna w klasie to atrybut (property)
// funkcja w klasie to metoda

// w klasie nie stosujemy "echo", powinna w miarę możliwości wszysto zwracać "return"

// różnice między klasą i obiektem - obiekt może się zmieniać, klasa zostaje ta sama

// /** + tab - PHPDoc

/**
 * My PHPDoc description for class Myclass
 *
 * @author Bartek
 * @copyright 2010
 * @license patch ...
 */
class Myclass {

/**
 *
 * @param string $stuff What you're doing!
 * @return Whatever You do
 */
function doSomething($stuff) {

// jeśli tworzy się obiekty klasy to przyjmuje się, że pierwsza powinna być z dużej.
$Myclass = new Myclass('Bartek');

// dostęp z obiektu do atrybutów w klasie powinien być zazwyczaj poprzez settery i gettery

// zmiennym zawsze należy nadać public, private albo protected
// WAŻNE!!! - zmienne i funkcje prywatne zawsze powinny mieć przed nazwą _
var $zmiennaWKlasie; // public
private $_myVar = 'my value';

// funkcje domyślnie są public, ale warto zawsze pisac

// fukcje statyczne są dobre jak dzieje się w nich coś co jest nie związane z obiektem, klasą
// $this-> odnosi się do obiektu, a nie klasy - dlatego nie możemy do zmiennej statycznej (którą odpalamy bez tworzenia obiektu) odwoływać się $this-> tylko self::
// self:: odnosi się do klasy z której korzystamy
// parent:: odnosi się do klasy dziecka

// zwracją nazwę klasy/funkcji
__CLASS__
__FUNCTION__

// extend odpala konstrutor klasy rodzica jeśli istnieje
// konstruktor klasy dziecka nadpisuje konstruktor klasy rodzica:
// czyli jeśli utworzymy konstruktor ChildClass, to konstruktor ParentClass nie zostanie odpalony
// dopiero jeśli sami go wywołamy "parent::__construct();"
// tak jest z każdą funkcją o tej samej nazwie

// zmienne i tablice można deklarować i od razu inicjalizować (przypisać wartość) w klasie (Inicjalizacja nie musi być w konstruktorze)
// WAŻNE!!! Nie można tworzyć obiektów przy deklaracji zmiennych:
// public $stdClass = new StdClass();

// zmienna static także może być protected/private - nie ma do niej dostępu z obiektu klasy

// klasa abstrakcyjna może implementować interfejs

// stałe mogą być zainicjowane w klasie abstrakcyjnej, ale nie da się ich użyć w klasach dziedziczących
// stałe powinno się deklarować z dużej litery, nie można zmieniać wartości, a dostęp jest do niej jak do zmiennej ale bez "$"
// WAŻNE!!! - stałe w klasie muszą być zapisane jako "const stala = 123;"

// w PHP 5.3 można dziedziczyć tylko jedną klasę - w PHP 5.4 są traitsy i można używać ich kilka

/*
|----------------------------------------------------------------
| KLASY
|----------------------------------------------------------------
*/

// w klasie, funkcji statycznej nie możemy się odwoływać $this-> (bo $this odnosi się do instancji klasy, a funkcja statyczna nie ma instancji)
// dlatego odnosimy się self::

// Dzieki słowu kluczowemu final, nie jest możliwe redefiniowanie metody w klasie pochodnej. Jeśli nastąpi próba redefiniowania metody finalnej, wyświetli się błąd.

// metody statyczne:

$zarowka = new zarowka(80);
$zarowka->wlacz();
$zarowkaOsram = new zarowkaOsram(80);
$zarowkaOsram->wylacz();

zarowkaOsram::napis(); //jeśli napis() nie jest static to wyświetla info o błędzie

/*
Klasa abstrakcyjna jest dość mocno związana logicznie z obiektami z niej dziedziczącymi. Interfejs natomiast jedynie narzuca klasie jakie metody powinna posiadać
Abstrakcyjne metody są to specjalne klasy, na podstawie, których nie można utworzyć obiektu, moga być natomiast dziedziczone i to jest właśnie ich podstawowe zadanie. Służą jako bazy, do tworzenia na ich podstawie klas pochodnych.
Abstrakcyjne metody to tylko ich deklaracje. Nie moga zawierać kodu do wykonania, muszą być natomiast rozbudowane w każdej z klas potomnych.

Interfejs definiuje pewne właściwości, które klasa musi spełniać.
Agreguje klasy obiektów na których można wykonać pewne operacje.
Sam w sobie nie definiuje logicznej zależności pomiędzy sobą a klasą go implementującą, definiuje natomiast powiązanie pomiędzy wszystkimi klasami go implementującymi. 

Klasa abstrakcyjna vs. interfejs:
-W klasie abs. można tworzyć funkcje z "body" - nie abstrakcyjne
-Można dziedziczyć kilka interfejsów, klasę jedną
-klasa abstrakcyjna może implementować interfejs, odwrotnie nie
*/

//----------------------------------------------------------------
// Automatyczne includowanie plików z klasami
//----------------------------------------------------------------

function __autoload($klasa)
{
	require_once('class_'.$klasa.'.php');
}

//----------------------------------------------------------------
// Referencje do obiektów
//----------------------------------------------------------------

$test = new test("test");
$test2 = new test("test2");

$test->wyswietl();

//$test2 = $test;		//tworzy referencje
$test2 = clone($test); 	//tworzy kopie a nie referencje
$test->asd = "test1";

$test2->wyswietl();

//----------------------------------------------------------------
// Dziedziczenie
//----------------------------------------------------------------

class zarowka
{
	var $jasnosc;
	var $wlaczona;
	var $moc;
	var $sprawnosc;
	
	function zarowka($_moc = 60)
	{
		$this->wlaczona = false;
		$this->moc = $_moc;
		$this->sprawnosc = 15;
		$this->jasnosc = $this->moc * $this->sprawnosc / 100;
		echo "Zarowka o mocy ".$this->moc." ma jasnosc ".$this->jasnosc."<br />";
	}
	
	function wlacz()
	{
		$this->wlaczona = true;
		echo("Zarowka on!<br />");
	}
	
	function wylacz()
	{
		$this->wlaczona = false;
		echo("Zarowka off!<br />");
	}
	
	static function napis() { 
      echo "funkcja napis() klasy A<br />"; 
    } 
}

class zarowkaOsram extends zarowka
{
	function zarowkaOsram($_moc = 80)
	{
		$this->wlaczona = false;
		$this->moc = $_moc;
		$this->sprawnosc = 25;
		$this->jasnosc = $this->moc * $this->sprawnosc / 100;
		echo "Zarowka OSRAM o mocy ".$this->moc." ma jasnosc ".$this->jasnosc."<br />";
	}
	
	static function napis() { 
		echo "funkcja napis() klasy B<br />";
		// WAŻNE!!!
		parent::napis();
    } 
}

//----------------------------------------------------------------
// Dziedziczenie + klasa abstrakcyjna, zmienna statyczna, konstruktor
//----------------------------------------------------------------

abstract class KlasaBazowa
{
	abstract function __construct();
	abstract protected function func();
	function func2()
	{
		echo("func2<br />");
	}
}

class dziedziczenie extends KlasaBazowa
{
	static $statyczna = "statyczna<br />";

	function __construct()
	{
		$this->func();
		$this->func2();
		echo(self::$statyczna); // dostęp do zmiennych statycznych w ten sposób, a nie ->
	}

	protected function func()
	{
		echo("func<br />");
	}
}

//----------------------------------------------------------------
// Interfejs, destruktor
//----------------------------------------------------------------

interface interfejs
{
	function wyswietl();
	//function asd();
}

class test implements interfejs
{
	public $asd; //var $asd domyslnie public
	
	function __construct($_asd)
	//function test($_asd)
	{
		$this->asd = $_asd;

		echo("konstruktor, ".$this->asd."<br />");
	}
	
	function wyswietl()
	{
		echo($this->asd.'<br />');
	}
	
	// function ~test() // nie działa
	function __destruct()
	{
		echo("destruktor");
	}
}