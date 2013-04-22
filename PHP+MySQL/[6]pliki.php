<?php

/*
fopen()
file_exist()
fclose()

fgetc()
fgets()

fread()
filesize()

file_get_contents()

file_put_contents()
fwrite()
fputs()

glob('pliki/*.{txt,docx}', GLOB_BRACE);
basename()
dirname()
substr()
pathinfo()
extract()

getimagesize('link'); - width, height obrazka

flock()
copy()
rename()
unlink() - Unlink is used to delete the file used in the context.
explode()

str_replace()
preg_replace()

nl2br()
*/

/*'r' - plik tylko do odczytu; wewnętrzny wskaźnik pliku umieszczany jest na początku pliku
'r+' - plik do odczytu i zapisu; wewnętrzny wskaźnik pliku umieszczany jest na początku pliku
'w' - plik tylko do zapisu; wewnętrzny wskaźnik pliku umieszczany jest na końcu pliku; zawartość pliku jest niszczona (długość pliku jest zmieniana na zero); jeśli plik nie istnieje PHP próbuje go stworzyć
'w+' - plik do odczytu i do zapisu; wewnętrzny wskaźnik pliku umieszczany jest na końcu pliku; zawartość pliku jest niszczona (długość pliku jest zmieniana na zero); jeśli plik nie istnieje PHP próbuje go stworzyć
'a' - dopisywanie do końca pliku - plik tylko do zapisu; wewnętrzny wskaźnik pliku umieszczany jest na końcu pliku; jeśli plik nie istnieje PHP próbuje go stworzyć*/

//wskaźnik pliku:
/*SEEK_SET- ustawia wskaźnik na pozycje określoną poprzezprzesuniecie(domyślne)
SEEK_CUR- ustawia wskaźnik na pozycję równą aktualnej +przesuniecie
SEEK_END- ustawia wskaźnik na koniec pliku +przesunięcie. Jeśli chce się, żeby ustawić na konkretną ilość znakó od końca toprzesunieciemusi być ujemne.*/

/*
|----------------------------------------------------------------
| ODCZYT
|----------------------------------------------------------------
*/

//-----------------------------------
// Odczyt v1 - fgetc
//-----------------------------------

if( file_exists("_test[6]plik.txt") ) {
	$handle = fopen('_test[6]plik.txt', 'r');

	$content = "";
	$i = 0;

	while( $char = fgetc($handle) ) {
		$content .= $char;

		echo $i . '<br />';
		$i++;
	}

	print_r( nl2br($content) );

	fclose($handle);
}

//-----------------------------------
// Odczyt v2 - fgets
// fread pobiera daną ilość znaków - można wpisać od razu ilość w całym pliku i pobrać wszystko
// fgets pobiera całą linię
//-----------------------------------
echo '<br />';
echo '<br />';

if( file_exists('_test[6]plik.txt') ) {
	$handle = fopen('_test[6]plik.txt', 'r');

	// $content = fread($handle, 5);

	$content = "";
	$i = 0;

	while($row = fgets($handle)) {
		$content .= $row;

		echo $i . '<br />';
		$i++;
	}

	print_r( nl2br($content) );

	fclose($handle);
}

//-----------------------------------
// Odczyt v3 - fread - Pobieranie wszystkiego
// fread pobiera daną ilość znaków - można wpisać od razu ilość w całym pliku i pobrać wszystko
//-----------------------------------
echo '<br />';
echo '<br />';

if( file_exists('_test[6]plik.txt') ) {
	$handle = fopen('_test[6]plik.txt', 'r');

	$content = fread($handle, filesize('_test[6]plik.txt'));
	print_r( nl2br($content) );

	fclose($handle);
}

//-----------------------------------
// Odczyt v4 - file_get_contents - Pobieranie wszystkiego
//-----------------------------------
echo '<br />';
echo '<br />';

if( file_exists('_test[6]plik.txt') ) {
	$content = file_get_contents('_test[6]plik.txt');
	print_r( nl2br($content) );
}

//-----------------------------------
// file() - Odczyt pliku - linii i zapisanie każdej jako element tablicy
//-----------------------------------

$content = file('pliki/inny.doc');
print_r($content);die;

/*
|----------------------------------------------------------------
| ZAPIS
|----------------------------------------------------------------
*/

//-----------------------------------
// Zapis v1 - fle_put_contents() Dopisywanie do konca pliku
//-----------------------------------
echo '<br />';
echo '<br />';

if( file_exists('_test[6]plik.txt') ) {
	// file_put_contents('_test[6]plik.txt', "\ntrzecia linijka"); // \n musi być w "\n" żeby zadziałało
	// file_put_contents('_test[6]plik.txt', "\ntrzecia linijka", FILE_APPEND); // - FILE_APPEND dopisuje do konca, inaczej nadpisze
}

//-----------------------------------
// Zapis v2 - fwrite, fputs Dopisywanie do konca pliku
// fwrite, fputs robi to samo
//-----------------------------------
echo '<br />';
echo '<br />';

if( file_exists('_test[6]plik.txt') ) {
	$handle = fopen('_test[6]plik.txt', 'a');
	
	$dane = "\nZapisana nowa linijka!";

	fwrite($handle, $dane);
	// fputs($handle, $dane);
	fclose($handle);
}

/*
|----------------------------------------------------------------
| INFORMACJE O PLIKACH
|----------------------------------------------------------------
*/

//-----------------------------------
// Sprawdzanie plików w katalogu
//-----------------------------------

# 1
// $files = glob('*.txt');
// print_r($files);

/*Array
(
    [0] => _test[6]plik_.txt
)*/

# 2
$files = glob('pliki/*.{txt,docx}', GLOB_BRACE); // WAŻNE!!! nie może być spacji pomiędzy "{jpg,png}"
// print_r($files);

/*Array
(
    [0] => _test[6]plik_.txt
    [1] => inny.doc
)*/

//-----------------------------------
// Informacje o plikach
//-----------------------------------

foreach ($files as $file) {
	// echo $file; 						// nazwa pliku ze scieżką

	// echo basename($file); 			// nazwa pliku bez ścieżki
	// echo basename($file, '.txt');	// w nazwia nie będzie ".txt"

	// echo dirname($file);				// nazwa katalogu

	// echo substr($file, 4);			// ucina piersze 4 znaki
	// echo substr($file, -4);			// zostawia ostatnie 4 znaki

	//-----------------------------------
	// pathinfo() - informacje o pliku
	//-----------------------------------

	// print_r(pathinfo($file));
	/*
	Array
	(
	    [dirname] => pliki
	    [basename] => _test[6]plik_.txt
	    [extension] => txt
	    [filename] => _test[6]plik_
	)*/

	// extract(pathinfo($file)); // extract - zamienia tablicę na zmienne
	// echo $filename;

	// echo pathinfo($file, PATHINFO_EXTENSION); // PATHINFO_FILENAME etc.
}

/*
|----------------------------------------------------------------
| RESZTA
|----------------------------------------------------------------
*/

//----------------------------------------------------------------
// Blokowanie pliku
//----------------------------------------------------------------

/*LOCK_SH- zakłada blokadę dzieloną (do odczytu)
LOCK_EX- zakłada blokadę wyłączną (do zapisu)
LOCK_UN- zdejmuje blokadę z pliku

$plik = fopen("plik.txt", "a");
if(flock($plik, LOCK_EX))
{
	//fwrite
	flock($plik, LOCK_UN);
}
else
	echo("PLIK JEST ZABLOKOWANY");
fclose($plik);

//----------------------------------------------------------------
// Kopiowanie pliku
//----------------------------------------------------------------

if(!copy("plik.txt", "plik_copy.txt"))
	echo("błąd kopiowania");
	
//----------------------------------------------------------------
// Zmiana nazwy pliku
//----------------------------------------------------------------

if(!rename("plik_copy.txt", "plik_copy_rename.txt"))
	echo("błąd kopiowania");
	
//----------------------------------------------------------------
// Usuwanie pliku
//----------------------------------------------------------------

unlink("plik_copy_rename.txt");

//----------------------------------------------------------------
// Wydobycie nazwy pliku 
//----------------------------------------------------------------
*/

$file_path = 'img/logo.png';
$file_name = explode('/', $file_path);

# 1
// $file_name = str_replace('.png', '', end($file_name));
# 2
$file_name = preg_replace('/\.png$/i', '', $file_name[1]); //i - case insensitivity, look for \.txt, $ on the end

echo $file_name;
