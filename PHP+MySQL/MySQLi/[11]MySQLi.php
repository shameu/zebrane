<?php

// mysqli:

/*
$conn = new mysqli($host, $username, $password, $db)
$stmt = $conn->prepare
[$stmt->bind_param()]
$stmt->execute()

// jeśli nie znamy nazw i ilości pól wynikowych:
[result_matadata()
mysqli_fetch_field()]

$stmt->bind_result()
$stmt->fetch()

$stmt->close();
$mysqli->close();

//-----------------------------------
dodatkowe:

// filtrowanie $query jako stringa - Strip tags, optionally strip or encode special characters.:
$this->_query = filter_var($query, FILTER_SANITIZE_STRING);
trigger_error('Problem preparing query', E_USER_ERROR);

// $stmt->bind_param()
// $stmt->bind_result()
call_user_func_array - wpisuje parametry do funkcji [Call a callback with an array of parameters] 
*/

//----------------------------------------------------------------
// Połączenie z mysqli
//----------------------------------------------------------------

$conn = new mysqli($host, $username, $password, $db) or die('Brak połączenia z bazą!');

$query = 'SELECT * FROM users';
$query2 = 'SELECT * FROM users WHERE id = ?'
$query3 = 'INSERT INTO users values(?, ?, ?, ?)'

$query = filter_var($query, FILTER_SANITIZE_STRING);

//----------------------------------------------------------------
// Prepare
//----------------------------------------------------------------

if( !$stmt = $conn->prepare($query) ) // t/f
// if( !$stmt = $conn->prepare($query2) ) // t/f
// if( !$stmt = $conn->prepare($query3) ) // t/f
{
	// przy podaniu błędnych danych w query:
	trigger_error('Problem prepairing query!', E_USER_ERROR);
}

//----------------------------------------------------------------
// BindParam
// dla $query2, $query3 - przy podanych parametrach w query ? etc.
//----------------------------------------------------------------
/*
	i	corresponding variable has type integer
	d	corresponding variable has type double
	s	corresponding variable has type string
	b	corresponding variable is a blob and will be sent in packets
*/

# 1
	$stmt->bind_param('sssd', $code, $language, $official, $percent);

# 2
	$parameters = array();
	$parameters[] = $this->_bindParamTypes; // _bindParamTypes - zmienna, w której są zapisane typy wstawianych zmiennych (ssssd) etc. 

	$row = array();
	foreach ($this->_bindParamValues as $value) {
		$row[] = $value;
	}

	foreach ($row as $key => $value) {
		$parameters[] = &$row[$key];
	}

	call_user_func_array(array($stmt, 'bind_param'), $parameters);

//----------------------------------------------------------------
// Execute
//----------------------------------------------------------------

$stmt->execute(); // t/f

/*
|----------------------------------------------------------------
| BindResults + Fetch
|----------------------------------------------------------------
*/

# 1
	//-----------------------------------
	// BindResults
	//-----------------------------------

	$stmt->bind_result($name, $code);

	//-----------------------------------
	// Fetch
	//-----------------------------------

	while ($stmt->fetch()) {
	    printf ("%s (%s)\n", $name, $code);
	}

# 2
	// metadata - zwraca nazwy pobranych z bazy pól
	$meta = $stmt->result_metadata();
	$fields = $meta->fetch_fields();

	// tworzenie tablicy z nazwami pól, które trzeba przekazać do bind_results
	$parameters = array();
	foreach($fields as $field)
	{
		// do bind_result trzeba przekazać referencję do zmiennych
		// tworzymy tablicę referecji z nazwami zmiennych
		$parameters[] = &$row[$field->name];
	}

	//-----------------------------------
	// BindResults
	//-----------------------------------

	// funkcja która sama odpala bind_result() dla wszystkich pobranych parametrów
	// $stmt->bind_result($id, $username); // t/f
	call_user_func_array(array($stmt, 'bind_result'), $parameters);

	//-----------------------------------
	// Fetch
	//-----------------------------------

	// tablica wynikowa
	$results = array();
	// $stmt->fetch(); // pobiera porcję danych - zmienne podane w bind_result()
	while($stmt->fetch())
	{
		$x = array();

		foreach ($row as $value) {
			$x[] = $value;
		}

		$results[] = $x;
	}

//----------------------------------------------------------------
// Close
//----------------------------------------------------------------

$stmt->close();
$mysqli->close();