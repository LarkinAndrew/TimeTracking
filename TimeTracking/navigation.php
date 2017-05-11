<?php 

if (isset($_POST['readTotal'])) {
	header('Location: cabinet.php');
}

if (isset($_POST['selectDev'])) {
	header('Location: selectDev.php');
}

if (isset($_POST['addUser'])) {
	header('Location: registration.php');
}

if (isset($_POST['addProj'])) {
	header('Location: addProject.php');
}

if (isset($_POST['addDev'])) {
	header('Location: addDevToProj.php');
}

if (isset($_POST['update'])) {
	header('Location: selectProject.php');
}

if (isset($_POST['logout'])) {
	User::logOut();
}

 ?>