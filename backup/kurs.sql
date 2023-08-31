-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Авг 31 2023 г., 13:34
-- Версия сервера: 8.0.30
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `kurs`
--

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE `news` (
  `id` int NOT NULL,
  `header` varchar(500) DEFAULT NULL,
  `img` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `news`
--

INSERT INTO `news` (`id`, `header`, `img`) VALUES
(19, 'SIE Santa Monica Studio анонсировала разработку продолжения франшизы God of War\r\nРелиз запланирован на 2025 год.', 'O:20:\"yii\\web\\UploadedFile\":7:{s:4:\"name\";s:10:\"Kratos.png\";s:8:\"tempName\";s:43:\"C:\\OSPanel\\userdata\\temp\\upload\\phpEB75.tmp\";s:4:\"type\";s:9:\"image/png\";s:4:\"size\";i:700203;s:5:\"error\";i:0;s:8:\"fullPath\";s:10:\"Kratos.png\";s:35:\"\0yii\\web\\UploadedFile\0_tempResource\";N;}'),
(20, 'Prox Dynamics анонсировал разработку новейшего дрона размером в спичечный коробок. Предполагается что он сможет работать до 12 часов без подзарядки.', 'O:20:\"yii\\web\\UploadedFile\":7:{s:4:\"name\";s:9:\"drone.png\";s:8:\"tempName\";s:42:\"C:\\OSPanel\\userdata\\temp\\upload\\phpEB2.tmp\";s:4:\"type\";s:9:\"image/png\";s:4:\"size\";i:557394;s:5:\"error\";i:0;s:8:\"fullPath\";s:9:\"drone.png\";s:35:\"\0yii\\web\\UploadedFile\0_tempResource\";N;}');

-- --------------------------------------------------------

--
-- Структура таблицы `tickets_buy`
--

CREATE TABLE `tickets_buy` (
  `id` int NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `card_number` varchar(45) DEFAULT NULL,
  `date_buy` date DEFAULT NULL,
  `type_tickets_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `tickets_buy`
--

INSERT INTO `tickets_buy` (`id`, `name`, `email`, `card_number`, `date_buy`, `type_tickets_id`) VALUES
(13, 'Даниил', 'ggtitovgg@gmail.com', '323', '2023-08-31', 1),
(14, 'Сергей', 'titovymisaisereza@gmail.com', '5345', '2023-08-31', 3),
(15, 'Даниил', 'dan.korpukov@yandex.ru', '464654', '2023-08-31', 3),
(16, 'Дарья', 'ggtitovgg@gmail.com', '983274098', '2023-08-31', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `type_tickets`
--

CREATE TABLE `type_tickets` (
  `id` int NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `info` varchar(1000) DEFAULT NULL,
  `price` decimal(9,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `type_tickets`
--

INSERT INTO `type_tickets` (`id`, `name`, `info`, `price`) VALUES
(1, 'Базовый', '{ \"1\":\"Бесплатные напитки\", \"2\":\"Фотографии со знаменитостями\", \"3\":\"Сувенир при входе на Electronic Entertainment Expo\"}', '1490.00'),
(2, 'Люкс', '{ \"1\":\"Преимущества билета A\", \"2\":\"Тест-драйв нового оборудования, VR шлемов, компьютеров и т.д.\", \"3\":\"Доступ к зоне отдыха\"}', '2490.00'),
(3, 'Премиум', '{ \"1\":\"Преимущества билета В\", \"2\":\"Отдельный вход без очереди\", \"3\":\"VIP зона для отдыха\",\"4\":\"Участие в розыгрыше игрового компьютера\"}', '3490.00');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `login` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`) VALUES
(1, 'admin', 'Jordan');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tickets_buy`
--
ALTER TABLE `tickets_buy`
  ADD PRIMARY KEY (`id`,`type_tickets_id`),
  ADD KEY `fk_tickets_type_tickets_idx` (`type_tickets_id`);

--
-- Индексы таблицы `type_tickets`
--
ALTER TABLE `type_tickets`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `news`
--
ALTER TABLE `news`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT для таблицы `tickets_buy`
--
ALTER TABLE `tickets_buy`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT для таблицы `type_tickets`
--
ALTER TABLE `type_tickets`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `tickets_buy`
--
ALTER TABLE `tickets_buy`
  ADD CONSTRAINT `fk_tickets_type_tickets` FOREIGN KEY (`type_tickets_id`) REFERENCES `type_tickets` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
