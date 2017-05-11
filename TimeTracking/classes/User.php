<?php 
require_once 'Db.php';

class User {

	public function __construct($name, $email, $password, $is_manager) { //changed

		$this->name = $name;
		$this->email = $email;
		$this->password = $password;
		$this->is_manager = $is_manager;
		session_start();
	}

	//Регистрация
	public function register() {

		$db = Db::getConnection();
		$sql = "INSERT INTO users (id, name, email, password, is_manager) "
                . "VALUES (NULL, '$this->name', '$this->email', "
                . "'$this->password', '$this->is_manager')";
        $result = $db->prepare($sql);
        $result->execute();

        header('Location: cabinet.php');

	}

	public function login() {

		$db = Db::getConnection();
		$sql = "SELECT * from users WHERE email='$this->email'"
			. " AND password='$this->password'";
		$result = $db->prepare($sql);
		$result->execute();
		$user = $result->fetch();
		if (!$user) {
			return false;
		}

		$_SESSION["user"] = $user["id"];
		header('Location: cabinet.php');
		
	}

	public function checkEmail() {

		if (preg_match('~.*@.*\\.[a-z]*~', $this->email) == 0) {
			return 'Некорректный e-mail';
		}

		return false;

	}

	public function checkPassword() {

		if (strlen($this->password) < 5) {
			return 'Пароль должен быть не короче 5 символов';
		}

		return false;

	}

	public function logOut() {

		session_start();
		unset($_SESSION["user"]);
		header('Location: index.php');

	}

	public function isManager($userId) {

		$db = Db::getConnection();
		$sql = "SELECT * from users WHERE id=$userId";
		$result = $db->prepare($sql);
		$result->execute();
		$user = $result->fetch();

		if ($user['is_manager'] == 1)
			return true;

		return false;

	}

	public function getUsersList() {

		$db = Db::getConnection();
		$sql = "SELECT * from users";
		$result = $db->prepare($sql);
		$result->execute();

		$i = 0;
		$usersList = array();
		while($row = $result->fetch()) {
			$usersList[$i]['id'] = $row['id'];
			$usersList[$i]['name'] = $row['name'];
			$i++;
		}

		return $usersList;

	}

	public function getUsersNamesById($usersId) {

		$db = Db::getConnection();

		$namesList = array();

		foreach ($usersId as $id) {
			$sql = "SELECT name from users WHERE id='$id'";
			$result = $db->prepare($sql);
			$result->execute();

			$i = 0;
			while ($row = $result->fetch()) {
				array_push($namesList, $row['name']);
			}
		}

		return $namesList;

	}

	public function getUsernameById($userId) {

		$db = Db::getConnection();

		$sql = "SELECT name FROM users WHERE id='$userId'";
		$result = $db->prepare($sql);
		$result->execute();

		$row = $result->fetch();
		return $row['name'];

	}

}

 ?>