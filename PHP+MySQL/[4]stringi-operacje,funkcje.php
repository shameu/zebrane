<?php

var_filter($variable, $filter) - Filters a variable with a specified filter
http://pl1.php.net/manual/en/filter.filters.sanitize.php
FILTER_SANITIZE_EMAIL
FILTER_SANITIZE_NUMBER_INT - Remove all characters except digits, plus and minus sign.
FILTER_SANITIZE_NUMBER_FLOAT - Remove all characters except digits, +- and optionally .,eE.
FILTER_SANITIZE_STRING - Strip tags, optionally strip or encode special characters.
FILTER_VALIDATE_URL

//-----------------------------------

lcfirst($str) - lowerCaseFirst - pierwsza litera w stringu z małej
ucfirst($str) - upperCaseFirst - pirwsza litera w stringu z dużej
ucwords($str) - upperCaseWords - pierwsze litery wyrazów w stringu z dużej
strtolower($str) - stringToLower - wszystkie litery w stringu z małej
strtoupper($str) - stringToUpper - wszystkie litery w stringu z dużej

//-----------------------------------
strstr() - stringStrip [?] - zwraca stringa począwszy od ... 
strip -  pozbawiać, zabierać

$str = 'Ala Ma Kota';

strstr($str, 'Ma') - 'Ma Kota'
strstr($str, 'Ma', true) - 'Ala'
stristr() - Case-insensitive strstr() - nie zwraca uwagi na małe/duże litery

strchr() = strstr()
strrchr($str, 'o'); // ota - zwraca ostatnie wystąpienie znaku

//-----------------------------------

strlen($str) - stringLength - zwraca ilość znaków w stringu
mb_strlen($utf8_string, 'latin1'); - raczej rzadko używany

//-----------------------------------

$str = 'Ala Ma Ma Kota';

strpos($str, 'Ma', [offset]); - strPosition - // 4 - liczone od "0" | offset - od którego znaku ma zacząć szukać
stripos - case sensitive strpos()

strrpos($str, 'Ma' [offset]); - strRear(Right)Position - // 7 - znajduje pozycje szukanego wyrazu od tyłu stringa
strripos() - case sensitive strrpos()

//-----------------------------------

str_replace() - zamienia wyrazy stringa na podane:
http://www.php.net/manual/en/function.str-replace.php

str_ireplace - Case-insensitive version of str_replace().

//-----------------------------------

$str = 'Ala Ma Ma Kota';

substr($zdanie, strpos(), strlen()) - [$str, $start, $length] $start liczone od "0"
substr($str, 4, 4); // Ma M
mb_substr() - to samo co substr(), ale ostatni parametr to encoding

echo substr($str, 4); // zostawia tekst po 4 znaku (licząc od początku)
echo substr($str, -4); //zostawia tekst po 4 znaku od konca

//-----------------------------------

substr_replace(string, replacement, start, length) - zastępuje tekst w stringu na podany
start - dodatnia: zaczyna od lewej od podanej pozycji
		ujemna: zaczyna od prawej ...
length...
//---

$var = 'ABCDEFGH:/MNRPQR/';
echo "Original: $var<hr />\n";

// These two examples replace all of $var with 'bob'. 
echo substr_replace($var, 'bob', 0) . "<br />\n";
echo substr_replace($var, 'bob', 0, strlen($var)) . "<br />\n";

// Insert 'bob' right at the beginning of $var.
echo substr_replace($var, 'bob', 0, 0) . "<br />\n";

// These next two replace 'MNRPQR' in $var with 'bob'.
echo substr_replace($var, 'bob', 10, -1) . "<br />\n"; // liczone od poczatku stringa
echo substr_replace($var, 'bob', -7, -1) . "<br />\n"; // liczone od konca stringa

// Delete 'MNRPQR' from $var.
echo substr_replace($var, '', 10, -1) . "<br />\n";

//-----------------------------------

wordwrap(string, width, break, cut) - dzieli stringa na stringi o podanej długości | break "<br />\n" etc. | cut = true - dzieli nawet jeśli wyraz jest dłuższy

//-----------------------------------
void parse_str() — Parses the string ($_GET) into variables

$str = "first=value&arr[]=foo+bar&arr[]=baz";
parse_str($str);
echo $first;  // value
echo $arr[0]; // foo bar
echo $arr[1]; // baz

parse_str($str, $output);
echo $output['first'];  // value
echo $output['arr'][0]; // foo bar
echo $output['arr'][1]; // baz

//-----------------------------------
htmlentities — Convert all applicable characters to HTML entities
html_entity_decode — Convert all HTML entities to their applicable characters

$orig = "I'll \"walk\" the <b>dog</b> now";
$a = htmlentities($orig);
$b = html_entity_decode($a);
echo $a; // I'll &quot;walk&quot; the &lt;b&gt;dog&lt;/b&gt; now
echo $b; // I'll "walk" the <b>dog</b> now

htmlspecialchars — Convert special characters to HTML entities
htmlspecialchars_decode — Convert special HTML entities back to characters

strip_tags — Strip HTML and PHP tags from a string

addslashes — Quote string with slashes
stripslashes — Un-quotes a quoted string

//-----------------------------------
str_repeat — Repeat a string
str_shuffle — Randomly shuffles a string
str_split — Convert a string to an array - rozbija litery w stringu na tablicę
str_word_count — Return information about words used in a string
strrev — Reverse a string

//----------------------------------------------------------------
// pozostałe
//----------------------------------------------------------------

chunk_split()

preg functions:
http://www.php.net/manual/en/ref.pcre.php

count_chars() — Return information about characters used in a string

setlocale — Set locale information

//----------------------------------------------------------------
// znane:
//----------------------------------------------------------------

nl2br() - newLineToBr
trim() - usuwa białe znaki z początku i konca stringa
ltrin() - usuwa białe znaki z początku stringa
rtrim() = chop() - usuwa białe znaki z konca stringa

array explode() — Split a string by string
string implode() = join() — Join array elements with a string

//----------------------------------------------------------------
// PRINTF - warto stosować jeśli nie wiemy jakie wartości przypisze użytkownik do zmiennej,
// a nie chcemy np. żeby liczba była stringiem itd.
// !!! printf zapisany w zmiennej zwraca liczbę znaków w zdaniu
//----------------------------------------------------------------
// %s - string, $d - numer/digit

printf("%d", "177.4"); // d - int
printf("%.2f", "2.156"); // .2 - 2 cyfry po przecinku, f - zmiennoprzecinkowe

// print('Ala ma kota');
// printf('Ala %s %d kotow', 'ma', 5);
// printf('Ala %s %.2f kotow', 'ma', 5.12345);

//----------------------------------------------------------------
// VPRINTF
//----------------------------------------------------------------

// vprintf("%03d-%02d-%02d", explode('-', '1988-8-1')); // 1988-08-01

//----------------------------------------------------------------
// SPRINTF - sprintf zapisany w zmiennej zwraca string
//----------------------------------------------------------------

$format = 'Ala ma %d %s';
$number = 5;
$animal = "psów";
echo sprintf($format, $number, $animal);

$greeting2 = sprintf("Nazywam sie %s i mam %d lat", $name, $age); // %s - string, $d - numer/digit

//----------------------------------------------------------------
// SSCANF - zwraca tablicę
//----------------------------------------------------------------

// print_r(resultsX); poniżej
// $results = sscanf("This post was made on June 7th, 2012", "%s"); 					// Array ( [0] => This )
// $results = sscanf("This post was made on June 7th, 2012", "%d");						// puste - nie ma liczb
// $results = sscanf("June 7th, 2012", "%s %s");										// Array ( [0] => June [1] => 7th, ) - z przecinkiem
// $results = sscanf("June 7th, 2012", "%s %[^,]"); // [^,] - anything not coma 		// Array ( [0] => June [1] => 7th )
// $results = sscanf("June 7th, 2012", "%s %[^,], %d"); // [^,] - anything not coma 	// Array ( [0] => June [1] => 7th [2] => 2012 )
// print_r($results);


/*$mandate = "January 01 2000";
list($month, $day, $year) = sscanf($mandate, "%s %d %d");*/
# $month = 'January' etc...

//----------------------------------------------------------------
// FSCANF
//----------------------------------------------------------------

/*$handle = fopen("users.txt", "r");
while ($userinfo = fscanf($handle, "%s\t%s\t%s\n")) {
    list ($name, $profession, $countrycode) = $userinfo;
    echo $name . ' - ' . $profession . ' - ' . $countrycode;
    echo '<br />';
}
fclose($handle);*/

