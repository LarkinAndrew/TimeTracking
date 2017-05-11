<?php 

class Db {

	public function getConnection() {

		$dsn = "mysql:host=localhost; dbname=ttdb";
		$user = 'root';
		$password = '';
		$db = new PDO($dsn, $user, $password);

		return $db;

	}

}

 ?>