<?php 

require_once 'classes/Project.php';
require_once 'classes/Db.php';
require_once 'classes/User.php';
require_once 'navigation.php';

session_start();

$projectsList = Project::getProjectsListById($_SESSION['dev_id']);

 ?>

<html>
<head>
	<meta charset="utf-8">
	<title>Time Tracking - Личный кабинет</title>
	<link rel="stylesheet" href="css/css.css" type="text/css">
</head>
<body>

	<a href="cabinet.php" class="cabinet" align="center">
		<img src="css/images/logo1.png" class="cabinet-logo">
	</a>

	<hr color="black" class="cabinet-line">

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

	<div class="working-space" align="center">

	<p><?php echo 'Разработчик: ', $_SESSION['dev_name']; ?></p>

	<form class="cabinet-row-head">
		
		<input type="text" value="Проект" disabled class="cabinet-row-elem">
		<input type="text" value="Пн" disabled class="cabinet-day-elem-head">
		<input type="text" value="Вт" disabled class="cabinet-day-elem-head">
		<input type="text" value="Ср" disabled class="cabinet-day-elem-head">
		<input type="text" value="Чт" disabled class="cabinet-day-elem-head">
		<input type="text" value="Пт" disabled class="cabinet-day-elem-head">
		<input type="text" value="Сб" disabled class="cabinet-day-elem-head">
		<input type="text" value="Вс" disabled class="cabinet-day-elem-head">
		<input type="text" value="Итого" disabled size="2" class="cabinet-row-elem">
		<input type="text" value="Дата" disabled size="7" class="cabinet-row-elem">

	</form>

	<?php foreach ($projectsList as $current_proj): ?>

		<form action="" method="post" class="cabinet-row">

			<input type="text" value="<?php echo $current_proj['project']; ?>" 
				disabled class="cabinet-elem">
			<input type="text" value="<?php echo $current_proj['mon']; ?>"
				class="cabinet-day-elem">
			<input type="text" value="<?php echo $current_proj['tue']; ?>"
				class="cabinet-day-elem">
			<input type="text" value="<?php echo $current_proj['wed']; ?>"
				class="cabinet-day-elem">
			<input type="text" value="<?php echo $current_proj['thu']; ?>"
				class="cabinet-day-elem">
			<input type="text" value="<?php echo $current_proj['fri']; ?>"
				class="cabinet-day-elem">
			<input type="text" value="<?php echo $current_proj['sat']; ?>"
				class="cabinet-day-elem">
			<input type="text" value="<?php echo $current_proj['sun']; ?>"
				class="cabinet-day-elem">
			<input type="text" value="<?php echo $current_proj['total']; ?>"
				size="2" class="cabinet-elem-center" disabled>
			<input type="text" value="<?php echo $current_proj['date']; ?>"
				size="7" class="cabinet-elem-center" disabled>

		</form>

	<?php endforeach; ?>

	</div>
	
</body>
</html>