<?php 

require_once 'classes/Project.php';
require_once 'classes/Db.php';
require_once 'classes/User.php';
require_once 'navigation.php';

session_start();

if (User::isManager($_SESSION['user'])) {
	$manager = true;
	$projectsList = Project::getProjectsList();
}
else {
	$manager = false;
	$projectsList = Project::getProjectsListById($_SESSION['user']);
}

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

	<?php if ($manager): ?>

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

	<?php if (!$manager): ?>

		<div align="center">
			<form action="" method="post">
				<input type="submit" name="update" value="Указать время" class="dev-menu">
				<input type="submit" name="logout" value="Выйти" class="dev-menu">
			</form>
		</div>

		<hr color="black" class="cabinet-line-second">

	<?php endif; ?>

	<div class="working-space" align="center">

	<form class="cabinet-row-head">
		
		<input type="text" value="Проект" disabled class="cabinet-row-elem">

		<?php if ($manager): ?>
			<input type="text" value="Разработчики" disabled 
				size="30" class="cabinet-row-elem">
		<?php endif; ?>

		<?php if (!$manager): ?>
			<input type="text" value="Пн" disabled class="cabinet-day-elem-head">
			<input type="text" value="Вт" disabled class="cabinet-day-elem-head">
			<input type="text" value="Ср" disabled class="cabinet-day-elem-head">
			<input type="text" value="Чт" disabled class="cabinet-day-elem-head">
			<input type="text" value="Пт" disabled class="cabinet-day-elem-head">
			<input type="text" value="Сб" disabled class="cabinet-day-elem-head">
			<input type="text" value="Вс" disabled class="cabinet-day-elem-head">
			<input type="text" value="Итого" disabled size="2" class="cabinet-row-elem">
		<?php endif; ?>

		<input type="text" value="Дата" disabled size="7" class="cabinet-row-elem">

	</form>

	<?php foreach ($projectsList as $current_proj): ?>

		<form action="" method="post" class="cabinet-row">

			<input type="text" value="<?php echo $current_proj['project']; ?>" 
				disabled class="cabinet-elem">

			<?php if ($manager): ?>
				<input type="text" 
					value="<?php echo $current_proj['developers']; ?>"
					disabled class="cabinet-elem" size="30">
			<?php endif; ?>

			<?php if (!$manager): ?>
				<input type="text" value="<?php echo $current_proj['mon']; ?>"
					name="mon" class="cabinet-day-elem">
				<input type="text" value="<?php echo $current_proj['tue']; ?>"
					name="tue" class="cabinet-day-elem">
				<input type="text" value="<?php echo $current_proj['wed']; ?>"
					name="wed" class="cabinet-day-elem">
				<input type="text" value="<?php echo $current_proj['thu']; ?>"
					name="thu" class="cabinet-day-elem">
				<input type="text" value="<?php echo $current_proj['fri']; ?>"
					name="fri" class="cabinet-day-elem">
				<input type="text" value="<?php echo $current_proj['sat']; ?>"
					name="sat" class="cabinet-day-elem">
				<input type="text" value="<?php echo $current_proj['sun']; ?>"
					name="sun" class="cabinet-day-elem">
				<input type="text" value="<?php echo $current_proj['total']; ?>"
					size="2" class="cabinet-elem-center" disabled>
			<?php endif; ?>

			<input type="text" value="<?php echo $current_proj['date']; ?>"
				size="7" class="cabinet-elem-center" disabled>

		</form>

	<?php endforeach; ?>

	</div>
	
</body>
</html>