<?php 

require_once 'Db.php';
require_once 'User.php';

//Класс для работы с проектами
class Project {

	public function __construct($project, $devs) {

		$this->project = $project;
		$this->developers = implode(', ', $devs);
		$this->developers_array = $devs;
		$this->date = strval(date('Y-m-d'));

	}

	//Сохранить проект в БД
	public function addProject() {

		$db = Db::getConnection();

		//Вносим данные в таблицу projects
		$sql = "INSERT INTO projects (id, project, developers_id, date)"
			. " VALUES (NULL, '$this->project', '$this->developers', '$this->date')";
		$result = $db->prepare($sql);
		$result->execute();

		//Определяем id добавляемого проекта
		$sql = "SELECT id FROM projects WHERE project='$this->project'";
		$result = $db->prepare($sql);
		$result->execute();
		$row = $result->fetch();
		$current_project_id = $row['id'];

		//Вносим данные в таблицу user_project
		foreach ($this->developers_array as $dev) {
			$sql = "INSERT INTO user_project (id, user_id, project_id, project,"
				. " mon, tue, wed, thu, fri, sat, sun, total, date) VALUES"
				. " (NULL, '$dev', '$current_project_id', '$this->project', '0', '0',"
				. " '0', '0', '0', '0', '0', '0', '$this->date')";
			$result = $db->prepare($sql);
			$result->execute();
		}

		header('Location: cabinet.php');

	}

	/*Добавить разработчиков в проект
	  $projectId - id проекта, в который добавляются разработчики
	  $devsId - массив, состоящий из id разработчиков
	*/
	public function addDevToProject($projectId, $devsId) {

		if (!isset($devsId) && !is_array($devsId))
			return false;

		$db = Db::getConnection();

		//Извлекаем данные об изменяемом проекте
		$sql = "SELECT * FROM projects WHERE id='$projectId'";
		$result = $db->prepare($sql);
		$result->execute();
		$currProject = array();
		$row = $result->fetch();
		$currProject_project = $row['project'];
		$currProject_devs_id = $row['developers_id'];
		$currProject_date = $row['date'];

		//Формируем строку из добавленных ранее разработчиков и добавляемых
		$devsStr = implode(', ', $devsId);
		$devsStr = $currProject_devs_id . ', ' . $devsStr;

		//Обнавляем таблицу projects полученной строкой
		$sql = "UPDATE projects SET developers_id='$devsStr'"
			. " WHERE projects.id='$projectId'";
		$result = $db->prepare($sql);
		$result->execute();

		//Добавляем данные в таблицу user_project
		foreach ($devsId as $id) {
			$sql = "INSERT INTO user_project (id, user_id, project_id, project,"
				. " mon, tue, wed, thu, fri, sat, sun, total, date) VALUES"
				. " (NULL, '$id', '$projectId', '$currProject_project', '0',"
				. " '0', '0', '0', '0', '0', '0', '0', '$currProject_date')";
			$result = $db->prepare($sql);
			$result->execute();
		}

		header('Location: cabinet.php');
		
	}

	//Получить список проектов для авторизированного разработчика
	public function getProjectsListById($userId) {

		$db = Db::getConnection();

		//Выбираем данные из таблицы user_project
		$sql = "SELECT * FROM user_project WHERE user_id='$userId' ORDER BY id DESC";
		$result = $db->prepare($sql);
		$result->execute();

		$i = 0;
		$projectsList = array();
		while ($row = $result->fetch()) {
			$projectsList[$i]['id'] = $row['id'];
			$projectsList[$i]['user_id'] = $row['user_id'];
			$projectsList[$i]['project_id'] = $row['project_id'];
			$projectsList[$i]['project'] = $row['project'];
			$projectsList[$i]['mon'] = $row['mon'];
			$projectsList[$i]['tue'] = $row['tue'];
			$projectsList[$i]['wed'] = $row['wed'];
			$projectsList[$i]['thu'] = $row['thu'];
			$projectsList[$i]['fri'] = $row['fri'];
			$projectsList[$i]['sat'] = $row['sat'];
			$projectsList[$i]['sun'] = $row['sun'];
			$projectsList[$i]['total'] = $row['total'];
			$projectsList[$i]['date'] = $row['date'];
			$i++;
		}

		return $projectsList;

	}

	//Получить список всех проектов (для менеджеров)
	public function getProjectsList() {

		$db = Db::getConnection();

		$sql = "SELECT * FROM projects ORDER BY id DESC";
		$result = $db->prepare($sql);
		$result->execute();

		$i = 0;
		$projectsList = array();
		while ($row = $result->fetch()) {
			$projectsList[$i]['id'] = $row['id'];
			$projectsList[$i]['project'] = $row['project'];
			$projectsList[$i]['developers_id'] = explode(', ', $row['developers_id']);
			$namesList[$i] = User::getUsersNamesById($projectsList[$i]['developers_id']);
			$projectsList[$i]['developers'] = implode(', ', $namesList[$i]);
			$projectsList[$i]['date'] = $row['date'];
			$i++;
		}

		return $projectsList;

	}

	//Получить информацию об одном проекте для изменения
	public function getProjectById($userId, $projectId) {

		$db = Db::getConnection();

		$sql = "SELECT * FROM user_project WHERE user_id='$userId' AND"
			. " project_id='$projectId'";
		$result = $db->prepare($sql);
		$result->execute();
		$row = $result->fetch();

		$currentProject = array();
		$currentProject['project'] = $row['project'];
		$currentProject['mon'] = $row['mon'];
		$currentProject['tue'] = $row['tue'];
		$currentProject['wed'] = $row['wed'];
		$currentProject['thu'] = $row['thu'];
		$currentProject['fri'] = $row['fri'];
		$currentProject['sat'] = $row['sat'];
		$currentProject['sun'] = $row['sun'];
		$currentProject['total'] = $row['total'];
		$currentProject['date'] = $row['date'];

		return $currentProject;

	}


	/*
		Делает практически то же самое, что и метод getProjectsList,
		но занимает меньше времени на выполнение,
		почему и используется в функции добавить разработчиков в проект
		UPD: этот метод был добавлен до того момента, как был изменен
		метод getProjectsList, поэтому теперь этот метод не сильно
		ускоряет работу и может не использоваться
	*/
	public function getProjectsNames() {

		$db = Db::getConnection();

		$sql = "SELECT * FROM projects";
		$result = $db->prepare($sql);
		$result->execute();

		$projectsNames = array();
		$i = 0;
		while ($row = $result->fetch()) {
			$projectsNames[$i]['id'] = $row['id'];
			$projectsNames[$i]['project'] = $row['project'];
			$i++;
		}

		return $projectsNames;

	}

	//Обновление затраченного времени на проекты
	public function updateTime($userId, $projectId, $day, $hours) {

		$db = Db::getConnection();

		//Обновляем время в заданном дне недели
		$sql = "UPDATE user_project SET $day='$hours' "
			. "WHERE user_id='$userId' AND project_id='$projectId'";
		$result = $db->prepare($sql);
		$result->execute();

		//Подсчитываем суммарное время (total)
		$total = 0;
		$days = array('mon', 'tue', 'wed', 'thu', 'fri', 'sat', 'sun');
		foreach ($days as $d) {
			$sql = "SELECT $d FROM user_project"
				. " WHERE user_id='$userId' AND project_id='$projectId'";
			$result = $db->prepare($sql);
			$result->execute();
			$row = $result->fetch();
			$total += $row[$d];
		}

		//Обновляем поле total
		$sql = "UPDATE user_project SET total='$total'"
			. " WHERE user_id='$userId' AND project_id='$projectId'";
		$result = $db->prepare($sql);
		$result->execute();

	}

}

 ?>