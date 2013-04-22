<?php
// PDO - PHP Data Objects

$config = array(
	'DB_USERNAME' => 'nauka',
	'DB_PASSWORD' => 'symfony'
);

try {
	$conn = new PDO('mysql:host=localhost;dbname=practise', $config['DB_USERNAME'], $config['DB_PASSWORD']);

	// errCode, errInfo:
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	// $conn->errorCode();
	// $conn->errorInfo();

	//----------------------------------------------------------------
	// 1) Anti-pattern!
	// najprosztsze zapytanie - nie stosować:
	// zwraca tablicę
	//----------------------------------------------------------------
	
	$results = $conn->query('SELECT * FROM users');
	foreach ($results as $key => $row) {
		# 1
		// echo("<p>jako tablica: $key) ".print_r($row)."</p>");

		# 2
		// extract($row);
		// echo("<p>jako zmienna: $key) ".$username."</p>");
	}

	//----------------------------------------------------------------
	// 2) Anti-pattern!
	// Używać można jeśli użytkownik nie ma możliwości manipulacji parametrami
	// $conn->quote() - działa jak htmlspecialchars()
	//----------------------------------------------------------------

	$id = 17;
	$results = $conn->query('SELECT * FROM users WHERE id = ' . $conn->quote($id));
	foreach($results as $key => $row) {
		# 1
	 	// echo("<p>jako tablica: $key) ".print_r($row)."</p>");

		# 2
		// extract($row);
		// echo("<p>jako zmienna: $key) ".$username."</p>");
	}

	//----------------------------------------------------------------
	// 1) Dobra metoda - Najpierw zostaje wykonane query a potem sie przypisuje mu wartosci
	// $stmt - statement
	//----------------------------------------------------------------
	$id = 17;

	$stmt = $conn->prepare('SELECT * FROM users WHERE id = :id');

	# 1
	// $stmt->execute(array(
		// 'id' => $id
	// ));

	# 2 - dodatkowo dajemy znać, że musi być to INT
	$stmt->bindParam(':id', $id, PDO::PARAM_INT);
	$stmt->execute();

	// num + fetch
	while($row = $stmt->fetch()) {
		// print_r($row);
	}

	//-----------------------------------
	// To samo, ale z LIKE
	// + info jak zwrocic jako objekt
	//-----------------------------------

	$letter1 = 'J%';
	$letter2 = 'J';

	# 1 - MNIEJ PISANIA
	// ew. LIKE "_r%"' - _ oznacza dowolny znak
	$stmt = $conn->prepare('SELECT * FROM users WHERE username LIKE :letter1');

	// $stmt->bindParam(':letter1', $letter1, PDO::PARAM_STR);
	// $stmt->execute();

	# 2
	$stmt = $conn->prepare('SELECT * FROM users WHERE username LIKE :letter2');

	// WAŻNE!!!
	// dzięki temu wynik zawacany jest jako Objekt, lub: $stmt->fetch(PDO::FETCH_OBJ):
	// $stmt->setFetchMode(PDO::FETCH_OBJ); - FETCH_OBJ, FETCH_ARR, FETCH_NUM

	$stmt->execute(array(
		'letter2' => $letter2 . '%'
	));

	// num + fetch:
	// while($row = $stmt->fetch()) {
	// obj:
	while($row = $stmt->fetch(PDO::FETCH_OBJ)) {
		// print_r($row);
	}

	//----------------------------------------------------------------
	// !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
	// WERSJA DO UŻYTKU - SELECT z fetchAll()
	// Zwracanie jako całość, a nie tablica
	//----------------------------------------------------------------

	$id = 0;

	$stmt = $conn->prepare('SELECT * FROM users WHERE id > :id');
	$stmt->bindParam(':id', $id, PDO::PARAM_INT);
	$stmt->setFetchMode(PDO::FETCH_OBJ);
	$stmt->execute();

	$results = $stmt->fetchAll();
	// $result->rowCount()
	print_r($results);

	
/*
Array
(
    [0] => stdClass Object
        (
            [id] => 17
            [username] => JimDoe
        )

    [1] => stdClass Object
        (
            [id] => 18
            [username] => JaneDoe
        )

    [2] => stdClass Object
        (
            [id] => 19
            [username] => Bartek
        )
)
*/

	//----------------------------------------------------------------
	// WERSJA DO UŻYTKU - SELECT z while($row = $stmt->fetch(PDO::FETCH_OBJ))
	// Zwracanie jako całość, a nie tablica
	//----------------------------------------------------------------

	$id = 0;

	$stmt = $conn->prepare('SELECT * FROM users WHERE id > :id');
	$stmt->bindParam(':id', $id, PDO::PARAM_INT);
	$stmt->execute();

	while($row = $stmt->fetch(PDO::FETCH_OBJ)) {
		print_r($row);
	}

/*
stdClass Object
(
    [id] => 17
    [username] => JimDoe
)
stdClass Object
(
    [id] => 18
    [username] => JaneDoe
)
stdClass Object
(
    [id] => 19
    [username] => Bartek
)
*/

	//----------------------------------------------------------------
	// INSERTING
	//----------------------------------------------------------------

	$stmt = $conn->prepare('INSERT INTO users(username) VALUES(:username)');
	$stmt->bindParam('username', $username, PDO::PARAM_STR);

	# 1
	// $username = 'Max Kolonko';
	// $stmt->execute();

	#2
	// $users = array('MaxKolonko', "JerzyBuzek");
	// foreach ($users as $username) {
		// $stmt->execute();
	// }

} catch(ExceptionPDO $e) {
	echo 'ERROR: '.$e->getMessage();
}