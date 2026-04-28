-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Мар 30 2026 г., 20:28
-- Версия сервера: 10.4.32-MariaDB
-- Версия PHP: 8.2.12

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
-- Структура таблицы `booking_ticket`
--

CREATE TABLE `booking_ticket` (
  `ID_booking` int(11) NOT NULL,
  `ID_evant` int(11) DEFAULT NULL,
  `Familia` varchar(255) NOT NULL,
  `Imya` varchar(255) NOT NULL,
  `Otchectvo` varchar(255) DEFAULT NULL,
  `Email` varchar(255) NOT NULL,
  `Date` date NOT NULL,
  `Time` time NOT NULL,
  `Kolvo_ticket` int(11) NOT NULL,
  `Price` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `booking_ticket`
--

INSERT INTO `booking_ticket` (`ID_booking`, `ID_evant`, `Familia`, `Imya`, `Otchectvo`, `Email`, `Date`, `Time`, `Kolvo_ticket`, `Price`) VALUES
(2, 3, 'Piskareva', 'Sasha', '', 'sashapiskareva6@gmail.com', '2026-03-21', '14:00:00', 1, 150),
(3, 3, 'Piskareva', 'Sasha', '', 'sashapiskareva6@gmail.com', '2026-03-21', '14:00:00', 1, 150);

-- --------------------------------------------------------

--
-- Структура таблицы `events`
--

CREATE TABLE `events` (
  `ID_evant` int(11) NOT NULL,
  `Nazvanie` varchar(100) NOT NULL,
  `Opisanie` varchar(255) NOT NULL,
  `Price_min` decimal(10,0) NOT NULL,
  `Price_max` decimal(10,0) NOT NULL,
  `Date_start` date NOT NULL,
  `Date_end` date NOT NULL,
  `Time` time NOT NULL,
  `ID_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `events`
--

INSERT INTO `events` (`ID_evant`, `Nazvanie`, `Opisanie`, `Price_min`, `Price_max`, `Date_start`, `Date_end`, `Time`, `ID_type`) VALUES
(3, 'Экскурсия «Дом Кузнецова»', 'Узнай историю одного из красивейших купеческих особняков города Ярославля.', 150, 350, '2026-03-15', '2026-05-30', '13:00:00', 1),
(4, 'Экспозиция \"История Ярославля\"', 'Постоянная экспозиция: все времена в истории города — от основания до начала XXI века.', 100, 200, '2026-02-02', '2027-01-31', '14:00:00', 2),
(5, 'Из истории ярославской медицины', 'Постоянная экспозиция: все этапы развития местной медицины – от избы знахаря до больницы.', 100, 250, '2026-02-02', '2027-01-31', '12:00:00', 2),
(6, 'Ярославские Кузнецовы и дом на Волжской набережной', 'В билете: экспозиции «Ярославские Кузнецовы и дом на Волжской набережной» и «Стекло и хрусталь в собрании музея», выставка «Человек: версия художника»', 150, 300, '2026-02-02', '2027-01-31', '10:00:00', 1),
(7, 'Встреча с художниками Сергеем и Майей Гусариными', 'Майя Гусарина расскажет о проекте, о художниках, принявших участие в выставке, и о собственном опыте художественного осмысления городской среды', 300, 300, '2026-03-21', '2026-03-21', '15:00:00', 3),
(8, 'Выставка «Человек: версия художника»', 'В экспозиции показаны портреты актеров, журналистов, политиков, почетных граждан города Ярославля', 200, 300, '2026-01-29', '2026-12-07', '10:00:00', 4),
(9, 'Выставка «Субъективный реализм»', 'На выставке представлены произведения художника Александра Кравцова, позволяющие по-новому взглянуть на повседневные вещи', 150, 300, '2026-03-28', '2026-05-11', '10:00:00', 4),
(10, 'Экскурсия по экспозиции «История Ярославля»', 'Гости посетят экспозицию «История Ярославля», познакомятся с историей города Ярославля', 100, 150, '2026-02-07', '2026-06-28', '12:00:00', 1),
(11, 'Экскурсия по экспозиции «Из истории ярославской медицины»', 'Речь пойдет о развитии медицины от древности до начала XXI века', 150, 350, '2026-03-28', '2026-03-28', '10:00:00', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `otsiv`
--

CREATE TABLE `otsiv` (
  `ID_otsiv` int(11) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Text` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `otsiv`
--

INSERT INTO `otsiv` (`ID_otsiv`, `Email`, `Text`) VALUES
(1, 'sashapiskareva6@gmail.com', 'аааа'),
(2, 'sashapiskareva6@gmail.com', 'ррррр'),
(3, 'sashapiskareva6@gmail.com', 'мимиии'),
(4, 'sashapiskareva6@gmail.com', 'iiiiiiiii');

-- --------------------------------------------------------

--
-- Структура таблицы `type_events`
--

CREATE TABLE `type_events` (
  `ID_type` int(11) NOT NULL,
  `Nazvanie` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `type_events`
--

INSERT INTO `type_events` (`ID_type`, `Nazvanie`) VALUES
(1, 'Экскурсия'),
(2, 'Экспозиция'),
(3, 'Встреча'),
(4, 'Выставка');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `booking_ticket`
--
ALTER TABLE `booking_ticket`
  ADD PRIMARY KEY (`ID_booking`),
  ADD KEY `idx_ID_evant` (`ID_evant`);

--
-- Индексы таблицы `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`ID_evant`),
  ADD KEY `fk_events_type_events` (`ID_type`);

--
-- Индексы таблицы `otsiv`
--
ALTER TABLE `otsiv`
  ADD PRIMARY KEY (`ID_otsiv`);

--
-- Индексы таблицы `type_events`
--
ALTER TABLE `type_events`
  ADD PRIMARY KEY (`ID_type`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `booking_ticket`
--
ALTER TABLE `booking_ticket`
  MODIFY `ID_booking` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `events`
--
ALTER TABLE `events`
  MODIFY `ID_evant` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `otsiv`
--
ALTER TABLE `otsiv`
  MODIFY `ID_otsiv` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `type_events`
--
ALTER TABLE `type_events`
  MODIFY `ID_type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `booking_ticket`
--
ALTER TABLE `booking_ticket`
  ADD CONSTRAINT `fk_booking_ticket_events` FOREIGN KEY (`ID_evant`) REFERENCES `events` (`ID_evant`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `fk_events_type_events` FOREIGN KEY (`ID_type`) REFERENCES `type_events` (`ID_type`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
