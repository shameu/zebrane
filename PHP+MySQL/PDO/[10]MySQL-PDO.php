<?php
// PDO - PHP Data Object

// nie można zrobić conn->quote() na nazwę tabeli : SELECT * FROM 'users' ( SELECT * FROM 'users' jest OK )
// conn->quote() tylko dla wartości wprowadzanych przez użytkownika ( WHERE etc. )

$config = array(
	'DB_USERNAME' => 'nauka',
	'DB_PASSWORD' => 'symfony'
);

/*
|----------------------------------------------------------------
| TRY
|----------------------------------------------------------------
*/

try {

	$conn = new PDO('mysql:host=localhost;dbname=practise', $config['DB_USERNAME'], $config['DB_PASSWORD']);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // zwracanie błędów jako Exception

	//----------------------------------------------------------------
	// PDO CLASS - query(), quote() - htmlspecialchars()
	//----------------------------------------------------------------

	$id = 19;
	$query = 'SELECT * FROM users WHERE id = ' . $conn->quote($id);

	# 1 - pojedynczy rekord
	//return $result = $conn->query($query)->fetch();

	# 2 - tablica tablic z wierszami wyników
	// $result = $conn->query($query)->fetchAll();

	# 3 - pojedyncze tablice wyników
	/*$results = $conn->query($query);
	foreach($results as $row)
	{
		echo pp($row);
	}*/

	//----------------------------------------------------------------
	// Statement - bezpieczna wersja
	//----------------------------------------------------------------

	# 1 - $query()
	$query 	= 'SELECT * FROM users';
	$query2 = 'SELECT * FROM users WHERE id = :id';
	$query3 = 'SELECT * FROM users WHERE id = ?';
	$query4 = 'SELECT id, username from users';
	$letter1 = 'B%';
	$letter2 = 'B';
	$query5 = 'SELECT * FROM USERS WHERE USERNAME LIKE :letter1';

	# 2 - prepare($query)
	$stmt = $conn->prepare($queryX);

	# [3 - $stmt->setFetchMode()]
	/*
	PDO::FETCH_BOTH - domyślnie
	PDO::FETCH_NUM
	PDO::FETCH_ASSOC
	PDO::FETCH_OBJ
	PDO::FETCH_COLUMN
	PDO::FETCH_LAZY - w tablicy ze zwrotem z bazy będzie string z $query
	PDO::FETCH_BOUND - Specifies that the fetch method shall return TRUE and assign the values of the columns in the result set to the PHP variables
	 to which they were bound with the PDOStatement::bindParam() or PDOStatement::bindColumn() methods.
	*/

	# 4 - $stmt->bindParam(), $stmt->bindValue(), $stmt->bindColumn()
	/*
	PDO::PARAM_BOOL (integer)
	Represents a boolean data type.
	PDO::PARAM_NULL (integer)
	Represents the SQL NULL data type.
	PDO::PARAM_INT (integer)
	Represents the SQL INTEGER data type.
	PDO::PARAM_STR (integer)
	Represents the SQL CHAR, VARCHAR, or other string data type.
	PDO::PARAM_LOB (integer)
	Represents the SQL large object data type.
	PDO::PARAM_STMT (integer)
	Represents a recordset type. Not currently supported by any drivers.
	PDO::PARAM_INPUT_OUTPUT (integer)
	Specifies that the parameter is an INOUT parameter for a stored procedure. You must bitwise-OR this value with an explicit PDO::PARAM_* data type.
	*/

		# 4.1 - [$query2] - $stmt->bindParam()
			$id = 21; // id musi być przekazane w bindParam() jako referencja - stąd stworzenie zmiennej
			$stmt->bindParam(':id', $id, PDO::PARAM_INT);

		# 4.2 - [$query2, $query3] - $stmt->bindValue()
			$stmt->bindValue(':id', $id, PDO::PARAM_INT);
			$stmt->bindValue(':id', 21, PDO::PARAM_INT);
			$stmt->bindValue(1, 21, PDO::PARAM_INT); // dla "$query" - id = ?

		# 4.3 - [$query4] - $stmt->bindColumn()
			// dla bindColunt() execute() musi być przed bindColumn() ?
			$stmt->execute()

			$stmt->bindColumn(1, $id);
			$stmt->bindColumn(2, $username);

			while($result = $stmt->fetch(PDO::FETCH_BOUND))
			{
				echo $id . ' - ' . $username . '<br />';
			}

		# 4.4 - [$query5] - $stmt->bindParam - LIKE 'B%'
			# 1
			$stmt->bindParam(':letter1', $letter1);
			$stmt->execute();

			# 2 
			$stmt->execute(array('letter1' => $letter2 . '%'));

	# 5 - $stmt->execute()

		# 5.1 - jeśli skorzystano uprzednio z bindPadam()/bindValue() lub nie podano parametrów
		$stmt->execute();

		# 5.2 - [$query2] - poddawanie parametrów - zamiast w bindParam()/bindValue()
		$param = array(':id' => 19);
		$stmt->execute($param);

	# 6 - $stmt->fetch( [setFetchMode] )/fetchAll( [setFetchMode] )

		# 6.1
		while($result = $stmt->fetch()) {}

		# 6.2
		$results = $stmt->fetchAll(); // tablica tablic zwróconych wierszy

	//----------------------------------------------------------------
	// Statement - dodawanie rekordów
	//----------------------------------------------------------------

	$stmt = $conn->prepare('INSERT INTO users(username) VALUES(:username)');
	$stmt->bindParam('username', $username, PDO::PARAM_STR);

	# 1 - pojedynczy rekord
	$username = 'Max Kolonko';
	$stmt->execute();

	# 2 - jeśli mamy tablicę wartości, które chcemy dodać
	$users = array('MaxKolonko', "JerzyBuzek");
	foreach ($users as $username) {
		$stmt->execute();
	}

/*
|----------------------------------------------------------------
| CATCH
|----------------------------------------------------------------
*/

} catch (PDOException $e) {
	echo 'ERROR: ' . $e->getMessage();

	// można odczytać kod błędu i info, ale musimy być połączeni z PDO
	if(isset($conn)):
		echo '<p>errorCode: ' . $conn->errorCode() . '</p>';
		pp($conn->errorInfo(), 'errorInfo(): ');
	endif;
}