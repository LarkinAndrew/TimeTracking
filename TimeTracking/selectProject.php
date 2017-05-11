<?php 

require_once 'navigation.php';
require_once 'classes/Project.php';
require_once 'classes/Db.php';
require_once 'classes/User.php';

session_start();

if (isset($_POST['submit'])) {

	$_SESSION['project_id'] = $_POST['projectId'];

	header('Location: update.php');

}

$projectsNames = array();
$projectsNames = Project::getProjectsListById($_SESSION['user']);

?>

<html>
<head>
	<meta charset="utf-8">
	<title>Указать время</title>
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
				<input type="submit" name="readMore"
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

	<div align="center">
		<form action="" method="post">
			<input type="submit" name="update" value="Указать время" class="dev-menu">
			<input type="submit" name="logout" value="Выйти" class="dev-menu">
		</form>
	</div>

	<div class="index-body">

		<form action="" method="post" class="form-login">

			<p class="addProj-selecter-text">Выберете проект:</p>

			<select size="1" name="projectId" class="form">
				
				<?php foreach ($projectsNames as $current_proj): ?>
					<option value="<?php echo $current_proj['id']; ?>">
						<?php echo $current_proj['project']; ?>
					</option>
				<?php endforeach; ?>

			</select>

			<br>

			<input type="submit" name="submit" value="Далее" class="form">

		</form>
	</div>

</body>
</html>