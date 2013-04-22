<?php

include '../helpers.php';
require_once('PDOClass.php');

try {

	$pdo = new PDOClass();
	// $results = $pdo->query('id', '19');
	// $pdo->quote($id) // addslashed etc.

	//-----------------------------------

	$query = 'SELECT * FROM users';
	$stmt = $pdo->_conn->prepare($query);
	// $stmt->setFetchMode(PDO::FETCH_NUM); // tutaj albo w fetch()
	
	# 1
	// $stmt->execute();
	// tablica tablic zwróconych wierszy
	// $results = $stmt->fetchAll(); // PDO::FETCH_ASSOC ; PDO::FETCH_COLUMN, <numer> ; etc.
	// pp($results);die;

	# 2
	// $stmt->execute();
	// foreach ($stmt->fetch() as $result)
	// foreach nie działa! - pobierane są pojedyncze rekordy i nie ma z czego zrobić foreach!
	/*while($result = $stmt->fetch()) // PDO::FETCH_OBJ ; PDO::FETCH_LAZY - przechowuje wykonany query
	{
		pp($result);
	}*/



	//-----------------------------------

	$query2 = 'SELECT * FROM users WHERE id = :id';
	$stmt = $pdo->_conn->prepare($query2);

	# 3 - bind param - exectute()
	/*$param = array(':id' => 19);
	$stmt->execute($param);
	$result = $stmt->fetch(PDO::FETCH_ASSOC);
	pp($result);die;*/

	# 4 - bind param - functions to bind id
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

	//-----------------------------------
	// BIND_PARAM

	$id = 21; // id musi być przekazane jako referencja - stąd stworzenie zmiennej
	// $stmt->bindParam(':id', $id, PDO::PARAM_INT);
	// ew.
	// $stmt->bindValue(':id', $id, PDO::PARAM_INT);
	// $stmt->bindValue(':id', 21, PDO::PARAM_INT);

	//-----------------------------------
	// BIND VALUE

	$query3 = 'SELECT * FROM users WHERE id = ?';
	$stmt = $pdo->_conn->prepare($query3);

	$id = 21;
	/*$stmt->bindValue(1, 21, PDO::PARAM_INT);
	$stmt->execute();
	$result = $stmt->fetch(PDO::FETCH_NUM);
	pp($result);die;*/

	//-----------------------------------
	// BIND COLUMN

	$query4 = 'SELECT id, username from users';
	$stmt = $pdo->_conn->prepare($query4);

	/*$stmt->execute();
	$stmt->bindColumn(1, $id);
	$stmt->bindColumn(2, $username);

	while($result = $stmt->fetch(PDO::FETCH_BOUND))
	{
		echo $id . ' - ' . $username . '<br />';
	}*/

	//-----------------------------------
	// SELECT * FROM USERS WHERE USERNAME LIKE

	$letter1 = 'B%';
	$letter2 = 'B';

	$query5 = 'SELECT * FROM USERS WHERE USERNAME LIKE :letter1';
	$stmt = $pdo->_conn->prepare($query5);
	$stmt->setFetchMode(PDO::FETCH_NUM);

	# 1
	// $stmt->bindParam(':letter1', $letter1);
	// $stmt->execute();

	# 2 
	//$stmt->execute(array('letter1' => $letter2 . '%'));

	/*$results = $stmt->fetchAll();
	pp($results);*/

} catch (PDOException $e) {
	echo 'ERROR: ' . $e->getMessage();

	if(isset($conn)):
		echo '<p>errorCode: ' . $conn->errorCode() . '</p>';
		pp($conn->errorInfo(), 'errorInfo(): ');
	endif;
}


