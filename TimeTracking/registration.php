<?php 

require_once 'classes/Db.php';
require_once 'classes/User.php';
require_once 'navigation.php';

if (isset($_POST['submit'])) {

	$name = $_POST['name'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$is_manager = $_POST['is_manager'];

	$user = new User($name, $email, $password, $is_manager);
	
	$emailError = $user->checkEmail();
	$passError = $user->checkPassword();
	if ($emailError == false && $passError == false) {
		$user->register();
	}
}

session_start();

 ?>

<html>
<head>
	<meta charset="utf-8">
	<title>Добавить сотрудника</title>
	<link rel="stylesheet" href="css/css.css" type="text/css">
</head>
<body>

	<a href="cabinet.php" class="cabinet">
		<img src="css/images/logo1.png" class="cabinet-logo">
	</a>

	<hr color="black" class="cabinet-line">

	<?php if (User::isManager($_SESSION['user'])): ?>

		<div align="center">
			<form action="" method="post">
				<input type="submit" name="readTotal"
					value="Все проекты" class="dev-menu">
				<input type="submit" name="selectDev"
					value="Отчеты разработчиков" class="dev-menu">
				<input type="submit" name="addUser" 
					value="Добавить сотрудника" class="dev-menu">
				<input type="submit" name="addProj" 
					value="Добавить проект" class="dev-menu">
				<input type="submit" name="addDev" 
					value="Добавить разработчика в проект" class="dev-menu">
				<input type="submit" name="logout" value="Выйти" class="dev-menu">
			</form>
		</div>

		<hr color="black" class="cabinet-line-second">

	<?php endif; ?>

	<div class="index-body">
	<form action="" method="post" class="form-login">
			<input type="text" name="name" placeholder="Имя" 
			value="<?php echo $name; ?>" class="form"><br>
			<input type="email" name="email" placeholder="E-Mail"
				value="<?php echo $email; ?>" class="form">
			<?php if (isset($emailError)) echo $emailError; ?><br>
			<input type="password" name="password" placeholder="Пароль" class="form">
			<?php if (isset($passError)) echo $passError; ?><br>
			<input type="radio" name="is_manager" value="1">Менеджер
			<input type="radio" name="is_manager" value="0">Разработчик<br>
			<input type="submit" name="submit" value="Зарегестрировать" class="form">
	</form>
	</div>

</body>
</html>