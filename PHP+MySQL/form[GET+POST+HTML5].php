<?php

include '../helpers.php';

// pp($GLOBALS);

//----------------------------------------------------------------
// GET POST
//----------------------------------------------------------------

// $_POST zwraca value="" tylko te z name=""
// $_SERVER[REQUEST_METHOD] => POST
/* [_REQUEST] => Array
        (
            [imie] => imie
            [tresc] => tresc
            [haslo] => haslo...*/

/*

Dane pobierane z GET/POST przefiltrować 

htmlspecialchars() - Convert special characters to HTML entities
'&' (ampersand) becomes '&amp;'
'"' (double quote) becomes '&quot;' when ENT_NOQUOTES is not set.
"'" (single quote) becomes '&#039;' (or &apos;) only when ENT_QUOTES is set.
'<' (less than) becomes '&lt;'
'>' (greater than) becomes '&gt;'

trim() - usuwa spacje

domyślna "method" w formularzu to "get"

if( !empty( $_REQUEST['<nazwa zmiennej>'] ) ) // $_REQUEST - obojętne czy POST czy GET
	$name = htmlspecialchars(trim( $_REQUEST['<nazwa zmiennej>'] ));

1)
	if( !empty($_POST) )
		print_r($_POST);

2)
	if(isset($_POST['contactForm'])) {}
	// contactForm - name dla input submit

3) stosować jeśli na stronie jest tylko jeden formularz
	echo $_SERVER['REQUEST_METHOD']; // wyświetla POST

if( $_SERVER['REQUEST_METHOD'] == "POST" )
{
	// print_r($_POST);
	if( mail('shameu@gmail.com', 'Wiadomość ze strony!', htmlspecialchars($_POST['message']) ))
	{
		$status = 'Wiadomość została wysłana!';
	}
}

*/

//-----------------------------------
// Sposób na wyświetlenie zawartości formularza, po odrzuceniu przez skrypt:
//-----------------------------------

function old($key)
{
	if( !empty($_REQUEST[$key]) ) /*$_REQUEST - obojętne czy POST czy GET*/
	{
		return htmlspecialchars($_REQUEST[$key]);
	}

	return ''; /*Jeffrey tak robi, żeby było przejrzyście, ale nie potrzeba*/
}

// w formularzu:
// <input type="text" name="email" id="email" value="<?= old('email'); ?>" />

?>

<!-- HTML5 - form możliwości:
	
label for <input name>

select > option value
textarea name id cols rows

input type
	text [placeholder="First name" - tekst przezroczysty w komórce],
	password,
	radio [name wiąże] [value],
	checkbox [name wiaże] [value],

	submit [value - bez value sam dobrze język]
	reset

	"image" src="img_submit.gif" alt="Submit" width="48" height="48"
	"file" name="img" multiple

	color
	date [min/max]
	datetime
	datetime-local
	email
	month
	number [step="3"]
	range
	search
	tel
	time
	url
	week

name id
[checked]
[autofocus]
[required]
-->

<!doctype html>
<html>
	<head>
		<meta charser="UTF-8">
		<title>Formularz</title>
	</head>
	<body>
		<h1>Contact form</h1>

		<!-- autocomplete="<on/off>" -->
		<!-- novalidate - nie sprawdza samdodzielnie email,  required etc. -->
		<form action="" method="post">
			<fieldset>
				<legend>Fieldset > legend</legend>
				<ul>
					<li>
						<label for="imie">Imie</label>
						<input type="text" name="imie" id="imie" />
					</li>
					<li>
						<label for="tresc">Treść</label>
						<textarea name="tresc" id="tresc" cols="25" rows="5"></textarea>
					</li>
					<li>
						<!-- multiple - można z ctrl zaznaczać kilka -->
						<!-- required - trzeba wybrać element z listy przed submitem -->
						<!-- size="5" - dla chrome minimum to 4 (jeśli jest jedna to 1) -->
						<!-- name="<name>" (JS), autofocus="autofocus", disabled="disabled", form="<form_id>" -->
						<select size="2">
							<optgroup label="optgroup 1">
								<option value="aa">a</option>
								<option value="bb">b</option>
								<option value="cc">c</option>
								<option value="dd">d</option>
							</optgroup>
							<!-- zrobi się <hr> pomiędzy -->
							<optgroup label="optgroup 2">
								<option value="ee">e</option>
								<option value="ff">f</option>
								<option value="gg">g</option>
							</optgroup>
						</select>
					</li>
					<li>
						<label for="haslo">Hasło</label>
						<input type="password" name="haslo" id="haslo" />
					</li>
					<li>
						<p><input type="radio" name="plec" value="K" />Kobieta</p>
						<p><input type="radio" name="plec" value="M" checked />Mężczyzna</p>
					</li>
					<li>
						<input type="checkbox" name="pojazd" value="samochod" />Samochód
						<input type="checkbox" name="pojazd" value="rower" checked />Rower
					</li>
					<li>
						<input type="reset" value="Reset" />
					</li>
					<li>
						<input type="submit" value="Wyślij" name="checkIfSent" />
					</li>
					<li>
						<!-- domyślnie submit -->
						<!-- formaction="<url>", tylko dla submit -->
						<!-- formtarget="_blank", tylko dla submit -->
						<!-- type: sumit, button, reset -->
						<!-- formmethod [get, post] -->
						<!-- formenctype
							application/x-www-form-urlencoded
							multipart/form-data
							text/plain -->
						<button name="przycisk" formtarget="_blank" type="submit" value="przycisk">PRZYCISK</button>
					</li>
					<li>
						<legend>datalist</legend>
						<input list="przegladarka" />
						<datalist id="przegladarka">
							<option value="ie" />
							<option value="ff" />
						</datalist>
					</li>
					<li>
						<keygen name="security">
					</li>
					<li>
						<input type="range" id="a" value="50">100
						+<input type="number" id="b" value="50">
						=<output name="x" for="a b"></output>
					</li>
				</ul>
			</fieldset>
		</form>
	</body>
</html>