<?php

// nie można zrobić conn->quote() na nazwę tabeli : SELECT * FROM 'users' ( SELECT * FROM 'users' jest OK )
// conn->quote() tylko dla wartości wprowadzanych przez użytkownika ( WHERE etc. )

class PDOClass {

	protected $_config = array(
		'dns' 		=> 'mysql:host=localhost;dbname=practise',
		'username' 	=> 'root',
		'password' 	=> 'mojwquad'
	);

	// protected $_conn;
	public $_conn;

	protected $_query_table = 'users';

	public function __construct()
	{
		$this->_conn = new PDO($this->_config['dns'], $this->_config['username'], $this->_config['password']);

		$this->_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // zwracanie błędów jako Exception
	}

	//----------------------------------------------------------------
	// Prosta funkcja zwracająca całą tablicę, bądx z jednym podzapytaniem
	// Nie powinna być używana przez użytkowników - statement bezpieczniejsza
	//----------------------------------------------------------------
	public function query($where = NULL, $where_condition = NULL)
	{
		// if($where == '') // NULL == '' - true ; empty(NULL) - true ; empty('') - true
		if(!empty($where) && !empty($where_condition))
		{
			$where_condition = $this->_conn->quote($where_condition);

			$where = ' WHERE ' . $where . ' = ' . $where_condition;
		}

		$query = 'SELECT * FROM ' . $this->_query_table . $where;

		// echo $query;die;

		# 1 - pojedynczy rekord
		return $result = $this->_conn->query($query)->fetch();

		# 2 - tablica tablic z wierszami wyników
		// $result = $this->_conn->query($query)->fetchAll();

		# 3 - pojedyncze tablice wyników
		/*$results = $this->_conn->query($query);
		foreach($results as $row)
		{
			echo pp($row);
		}*/

	}

}