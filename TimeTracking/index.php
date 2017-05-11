<?php 

require_once 'classes/Db.php';
require_once 'classes/User.php';

if (isset($_POST['submit'])) {

	$name = '';
	$email = $_POST['email'];
	$password = $_POST['password'];
	$is_manager = '';

	$user = new User($name, $email, $password, $is_manager);

	$emailError = $user->checkEmail();
	$passError = $user->checkPassword();
	if ($emailError == false && $passError == false) {
		$user->login();
	}
	

}

?>

<html>
<head>

	<meta charset="utf-8">
	<title>Войти</title>
	<link rel="stylesheet" href="css/css.css" type="text/css">

</head>

<body>

	<div class="index-body">
	<img src="css/images/logo1.png" class="logo">

	<form action="" method="post" class="form-login">

		<input type="email" name="email" placeholder="E-Mail" 
			value="<?php echo $email; ?>" class="form">
		<?php if (isset($emailError)) echo $emailError; ?><br>
		<input type="password" name="password" placeholder="Пароль" class="form">
		<?php if (isset($passError)) echo $passError; ?><br>
		<input type="submit" name="submit" value="Войти" class="form">

	</form>
	</div>

</body>
</html>