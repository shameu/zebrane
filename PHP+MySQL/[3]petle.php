<?php

//-----------------------------------
// for

for($i = 5; $i < 20 ; $i++):
	echo(nl2br("<span style=\"font-size:$i\">napis roznej wielkosci</span>\n"));
endfor;

//-----------------------------------
// while

$a = 5;
while($a != 5)
	echo("while!");

//-----------------------------------
// while list()

$tablica = array('foo', 'bar', 'star');
while( list($key, $row) = each($tablica) )
{
	echo '<p>' . $key . ' - ' . $row . '</p>';
}

//-----------------------------------
// do while

do
{
	echo("do while!");
}while($a != 5); //średnik na końcu!

//-----------------------------------
// foreach

$zwierzeta = array("pies", "kot", "jeż");
foreach($zwierzeta as $zwierze)
{
	echo $zwierze."<br />";
}

$zwierzeta = array("pies", "kot", "surykatka", "tygrys");
$zwierzeta = array(1 => "pies", "kot", 5 => "surykatka", "tygrys"); //sam uzupelnia reszte jesli nie wie jaki numer!

foreach($zwierzeta as $key => $zwierze)
{
	echo("zwierze nr: ".$key." to ".$zwierze."<br />");
}