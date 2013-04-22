<?php
// http://gskinner.com/RegExr/
// w pierwszym wpisujemy RegExr
// w drugim wyrazy i podświetlą się jeśli pasują do RegExr
// kilka wyrazów? - global

// parenthesis- nawias
// period - kropka

//----------------------------------------------------------------
// 1 - regExr
//----------------------------------------------------------------

. w regexr oznacza jakikolwiek znak, więc jeśli chcemy żeby potraktował ją jak kropke zwykłą musimy:
\.

? - znak lub znaki w nawiasie występujące przed ? są opcjonalne np:
\.?
(Hello )?

// reg:
(Hello )?Tuts Readers\.?

// pasujące
Hello Tuts Readers.
Hello Tuts Readers
Tuts Readers

//----------------------------------------------------------------
// 2 - regExr
//----------------------------------------------------------------
/*to samo:
gray = grey
practise = practice*/

// ignoreCase - ignoruje diuże/małe litery

[] - jakikolwiek znak z podanych

[gG]r[ae]y:
gray
Grey

+ (1 or more) - jakakolwiek ilość znaków występująca przed +

g+:
ggggggg

* (0 or more)

| - pipe refers to OR - bierze pod uwagę wszystko po lewej i po prawej stronie

gr(a|e)y:
gray
grey

//-----------------------------------
szukamu adresów:

http://net.tutsplus.com
https://net.tutsplus.com
ftp://net.tutsplus.com

# 1 - słaba metoda
(https?|ftp)://
# 2 - któtasza
(ht|f)tps?://.+

//----------------------------------------------------------------
// 3 - regExr  początek i koniec tringa
// multiline włączone
//----------------------------------------------------------------

^ - (carrot) - Początek stringa
$ - (dolar bo płacimy na koncu zakupów) - koniec stringa

// wszystkie pliki w formacie podanym
^.+(jpg|gif|png)$:
asd.jpg
zxc.png
qweqwe.gif
Anotherjpg.jpg
my.jpgimage.jpg

//----------------------------------------------------------------
// 4 - capturing values
//----------------------------------------------------------------

(^.+(jpg|gif|png)$)

$1 - wyswietla wszystko co znajduje się w () nazwiasie
$2 - kolejnym nawiasie etc.

update file name:
update.file.name.$2

jeśli nie chcemy aby wartości z nawiasów mogłby być wyciągane $2 etc. (?:) - ?: na początku nawiasu
(^.+(?:jpg|gif|png)$)

//----------------------------------------------------------------
// 5 - Greedy Matches +
//----------------------------------------------------------------

H.+H - greedy +
Hello how are You H | ello
Hello how are You Hello I am ok And H | ello to You too!

H.+?H - ? dont be greedy
Hello how are You H | ello I am ok And Hello to You too!

//----------------------------------------------------------------
// 6 - Rangers and Curly Brace Matching
//----------------------------------------------------------------

\d - Matches any digit character (0-9).

\d{3} - tylko gdzie są 3 cyfry
\d{3,4} - ... 3 lub 4 cyfry

^\d{3,4}
615| -555-3333
6151| -555-3333

//-----------------------------------

\w - Matches any word character (alphanumeric & underscore).

\w{5}
Hello| man

// można by używać . jako pojedynczego znaku, ale powinno się używać ktopki w OSTATECZNOŚCI
// zamiast ktopki lepiej: [a-zA-Z]

//-----------------------------------

\s - Matches any whitespace character (spaces, tabs, line breaks).
// spacja też zaznaczy "whitespace", ale lepiej \s


there\.\sHi
Hello <there.
Hi>

to samo:

there\.\rHi
Hello <there.
Hi>

\r - carriage return
\n - new lines
\s - space characters
\w - word characters
\d - digits 0-9

//----------------------------------------------------------------
// 7 - Practical Search and Replace Example
//----------------------------------------------------------------

[abc] - znajdx a, b lub c
^[abc] - ... na początku
[^abc] - negacja - wszystko oprócz a, b lub c

//----------------------------------------------------------------
// 8 - Porting the Previous Exercise
//----------------------------------------------------------------

