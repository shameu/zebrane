<?php

/*
mysqli
prepare
[bind param]
execute

result_matadata
mysqli_fetch_field

call_user_func_array - wpisuje parametry do funkcji [Call a callback with an array of parameters] 
bind_result
fetch

// filtrowanie $query jako stringa - Strip tags, optionally strip or encode special characters.:
$this->_query = filter_var($query, FILTER_SANITIZE_STRING);
trigger_error('Problem preparing query', E_USER_ERROR);
*/

class MySQLiClass {
	protected $_conn;
	protected $_query;

	public $_where = '';

	public $_bindParamTypes;
	public $_bindParamValues = array();

	public function __construct($host, $username, $password, $db)
	{
		$this->_conn = new mysqli($host, $username, $password, $db) or die('Brak połączenia z bazą!');

		// exception przy wpisaniu błędnych danych
	}

	public function query($query)
	{
		$this->_query = filter_var($query, FILTER_SANITIZE_STRING);
		$stmt = $this->_prepareQuery();
		$stmt->execute(); // t/f
		return $this->_dynamicBindResults($stmt);
	}

	//-----------------------------------

	public function where($param, $value)
	{
		$type = $this->_getType($value);
		if( $type !== '' )
		{
			$this->_bindParamTypes .= $type;

			if( $this->_where !== '' )
				$this->_where .= ' &&';
			else
				$this->_where .= ' WHERE';

			$this->_where .= ' ' . $param .' = ? ';

			$this->_bindParamValues[] = $value;
		}
	}

	public function get($tableName, $numRows = NULL)
	{
		$limit = '';
		if( is_int($numRows) )
			$limit = ' LIMIT ' . $numRows;

		$this->_query = 'SELECT * FROM ' . $tableName . $this->_where . $limit;

// echo $this->_query;die;

		$stmt = $this->_prepareQuery();

		if( $this->_where !== '' )
			$this->_dynamicBindParams($stmt);

		$stmt->execute(); // t/f
		return $this->_dynamicBindResults($stmt);
	}

	public function insert($tableName, $insertValues)
	{
		$this->_query = 'INSERT INTO ' . $tableName . ' VALUES(';
		for($i = 0; $i < count($insertValues); $i++) {
			if( $i+1 ==  count($insertValues))
				$this->_query .= '?';
			else
				$this->_query .= '?, ';

			// uzupełnianie _bindParamTypes
			$type = $this->_getType($insertValues[$i]);
			$this->_bindParamTypes .= $type;

			// uzupełniania bindParamValues
			$this->_bindParamValues[] = $insertValues[$i];
		}
		$this->_query .= ')';

		$stmt = $this->_prepareQuery();
		$this->_dynamicBindParams($stmt);
		$stmt->execute(); // t/f
	}

	//-----------------------------------

	protected function _prepareQuery()
	{
		if( !$stmt = $this->_conn->prepare($this->_query) ) // t/f
		{
			// przy podaniu błędnych danych w query:
			trigger_error('Problem prepairing query!', E_USER_ERROR);
		}

		return $stmt;
	}

	protected function _getType($value)
	{
		$type = gettype($value);

		switch ($type) {
			case 'integer':
				$param = 'i';
				break;
			case 'double':
				$param = 'd';
				break;
			case 'string':
				$param = 's';
				break;
			case 'blob':
				$param = 'b';
				break;
			default:
				$param = '';
				break;
		}

		return $param;
	}

	protected function _dynamicBindParams($stmt)
	{
		$parameters = array();
		$parameters[] = $this->_bindParamTypes;

		$row = array();
		foreach ($this->_bindParamValues as $value) {
			$row[] = $value;
		}

		foreach ($row as $key => $value) {
			$parameters[] = &$row[$key];
		}

		// var_dump($parameters);die;

		call_user_func_array(array($stmt, 'bind_param'), $parameters);
	}

	protected function _dynamicBindResults($stmt)
	{
		$meta = $stmt->result_metadata();
		$fields = $meta->fetch_fields();

		$parameters = array();
		foreach($fields as $field)
		{
			// do bind_result trzeba przekazać referencję do zmiennych
			// tworzymy tablicę referecji z nazwami zmiennych
			$parameters[] = &$row[$field->name];
		}

		// $stmt->bind_result($id, $username); // t/f
		call_user_func_array(array($stmt, 'bind_result'), $parameters);

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

	    return $results;
	}
}