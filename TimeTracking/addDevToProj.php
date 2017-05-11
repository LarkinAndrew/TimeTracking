<?php 

require_once 'classes/Project.php';
require_once 'classes/Db.php';
require_once 'classes/User.php';
require_once 'navigation.php';

session_start();

if (isset($_POST['submit'])) {

	$projectId = $_POST['projectId'];
	$devs_id = $_POST['devs_id'];

	Project::addDevToProject($projectId, $devs_id);

}

$usersList = array();
$usersList = User::getUsersList();

$projectsNames = array();
$projectsNames = Project::getProjectsNames();

 ?>

<html>
<head>
	<meta charset="utf-8">
	<title>Добавить разработчика в проект</title>
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

			<p class="addProj-selecter-text">Выберете проект:</p>

			<select size="1" name="projectId" class="form">
				
				<?php foreach ($projectsNames as $current_proj): ?>
					<option value="<?php echo $current_proj['id']; ?>">
						<?php echo $current_proj['project']; ?>
					</option>
				<?php endforeach; ?>

			</select>

			<p class="addProj-selecter-text">Выберете сотрудников через ctrl:</p>

			<select size="5" multiple name="devs_id[]" class="addProj-selecter">

				<?php foreach ($usersList as $current_user): ?>
					<option value="<?php echo $current_user['id']; ?>">
						<?php echo $current_user['name']; ?>
					</option>
				<?php endforeach; ?>

			</select>

			<br>
			<input type="submit" name="submit" value="Добавить" class="form">
		</form>
	</div>

</body>
</html>