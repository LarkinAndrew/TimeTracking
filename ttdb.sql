-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 11 2017 г., 19:43
-- Версия сервера: 5.5.53
-- Версия PHP: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `ttdb`
--

-- --------------------------------------------------------

--
-- Структура таблицы `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `project` varchar(50) NOT NULL,
  `developers_id` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `projects`
--

INSERT INTO `projects` (`id`, `project`, `developers_id`, `date`) VALUES
(1, 'FirstProject', '7, 8, 9, 1', '2017-05-10'),
(2, 'SecondProject', '11, 15', '2017-05-11'),
(3, 'ThirdProject', '7, 8', '2017-05-11');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(50) NOT NULL,
  `is_manager` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `is_manager`) VALUES
(1, 'admin', 'admin@mail.ru', '1234567', '1'),
(7, 'Andrey', 'andrey@mail.ru', '1234567', '0'),
(8, 'Larkin', 'fwf@aaw.ru', '12345', '0'),
(9, 'Viktor', 'mail@mail.ru', '123456778498', '1'),
(10, 'Ivan K', 'dev@dev.r', '9815118', '0'),
(11, 'Nikolay', 'nik@nik.ru', '7654321', '0'),
(13, 'qwe', 'qwe@wqe.ru', 'qweqweq', '1'),
(14, 'qwe', 'qwe@wqe.ru', 'qweqweq', '1'),
(15, 'Ivan Ivanov', 'ivan@mail.ru', '7654321', '0');

-- --------------------------------------------------------

--
-- Структура таблицы `user_project`
--

CREATE TABLE `user_project` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `project` varchar(50) NOT NULL,
  `mon` int(24) NOT NULL,
  `tue` int(24) NOT NULL,
  `wed` int(24) NOT NULL,
  `thu` int(24) NOT NULL,
  `fri` int(24) NOT NULL,
  `sat` int(24) NOT NULL,
  `sun` int(24) NOT NULL,
  `total` int(168) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user_project`
--

INSERT INTO `user_project` (`id`, `user_id`, `project_id`, `project`, `mon`, `tue`, `wed`, `thu`, `fri`, `sat`, `sun`, `total`, `date`) VALUES
(1, 7, 1, 'FirstProject', 7, 2, 1, 5, 1, 3, 0, 19, '2017-05-10'),
(2, 8, 1, 'FirstProject', 0, 0, 0, 0, 0, 0, 0, 0, '2017-05-10'),
(3, 9, 1, 'FirstProject', 0, 0, 0, 0, 0, 0, 0, 0, '2017-05-10'),
(4, 1, 1, 'FirstProject', 0, 0, 0, 0, 0, 0, 0, 0, '2017-05-10'),
(5, 11, 2, 'SecondProject', 0, 0, 0, 0, 0, 0, 0, 0, '2017-05-11'),
(6, 15, 2, 'SecondProject', 0, 0, 0, 0, 0, 0, 0, 0, '2017-05-11'),
(7, 7, 3, 'ThirdProject', 0, 0, 0, 0, 0, 0, 0, 0, '2017-05-11'),
(8, 8, 3, 'ThirdProject', 0, 0, 0, 0, 0, 0, 0, 0, '2017-05-11');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user_project`
--
ALTER TABLE `user_project`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT для таблицы `user_project`
--
ALTER TABLE `user_project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
