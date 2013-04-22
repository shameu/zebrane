<?php
	include '../../helpers.php';
	require_once 'MySQLiClass_back.php';
	require_once 'MySQLiClass.php';

	$db = new MySQLiClass('localhost', 'root', 'mojwquad', 'practise');
	// $results = $db->query('SELECT * FROM users'); //

	// $db->where('number', 0);
	// $db->where('id', 19);
	// $db->where('username', 'Bartek');
	// $results = $db->get('users');

	$db->insert('users', array('NULL', 'asd', 6));

	// pp($results);
?>

<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	
</body>
</html>