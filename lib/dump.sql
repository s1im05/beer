-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Фев 20 2016 г., 14:17
-- Версия сервера: 5.5.25
-- Версия PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- База данных: `beer`
--

-- --------------------------------------------------------

--
-- Структура таблицы `beer__places`
--

CREATE TABLE IF NOT EXISTS `beer__places` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `text` text NOT NULL,
  `map` varchar(100) NOT NULL,
  `web` varchar(200) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `sort` smallint(6) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `beer__sort`
--

CREATE TABLE IF NOT EXISTS `beer__sort` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `title_sub` varchar(100) NOT NULL,
  `date_c` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_e` date NOT NULL,
  `text` text NOT NULL,
  `sort` smallint(6) NOT NULL DEFAULT '0',
  `color` varchar(6) NOT NULL,
  `image` varchar(250) NOT NULL,
  `type` enum('light','red','dark') NOT NULL DEFAULT 'light',
  `og` varchar(10) NOT NULL,
  `abv` varchar(10) NOT NULL,
  `ibu` varchar(10) NOT NULL,
  `available` tinyint(1) NOT NULL DEFAULT '1',
  `show` tinyint(1) NOT NULL DEFAULT '1',
  `text_color` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `title` (`title`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Дамп данных таблицы `beer__sort`
--

INSERT INTO `beer__sort` (`id`, `title`, `title_sub`, `date_c`, `date_e`, `text`, `sort`, `color`, `image`, `type`, `og`, `abv`, `ibu`, `available`, `show`, `text_color`) VALUES
(1, 'QUADRUPEL', 'BELGIAN STYLE', '2016-02-17 09:59:27', '0000-00-00', 'Плотное, крепкое темное пиво с ароматом жженной карамели. Маслянистое тело с лёгкой винной ноткой. Во вкусе шоколад, карамель, орех.', 0, '592c71', '/templates/default/img/label_bg_11.png', 'dark', '24', '9', '40', 1, 1, 1),
(2, 'BLACK RAY', 'IPA', '2016-02-17 10:50:56', '2016-03-31', 'В аромате борьба мультифрукта с шоколадом. Во вкусе чернослив, тропические фрукты, лёгкий шоколад.', 1, '2a2927', '/templates/default/img/label_bg_12.png', 'dark', '20', '8,5', '70', 0, 1, 1),
(3, 'EXTRA CITRA', 'IPA', '2016-02-17 11:16:03', '2016-03-31', 'Пиво в стиле IPA с упором на хмель Citra. Щедрое количество этого хмеля использовано на сухое охмеление, что придало яркий аромат тропических фруктов. Солодовая сладость умело скрывает 85IBU и раскрывает нотки тех же тропиков.', 2, 'ba5619', '/templates/default/img/label_bg_9.png', 'red', '16', '7', '85', 0, 1, 1),
(4, 'HOP&WOOD', 'STRONG LAGER', '2016-02-17 11:17:58', '0000-00-00', 'Экспериментальный сорт - хорошо охмеленный лагер, сброженный на щепе дуба. В итоге, получилось пиво янтарного цвета с ярким ароматом цветочного меда. Вкус вяленого яблока, груши с явственной горечью в завершении.', 3, '3b0300', '/templates/default/img/label_bg_10.png', 'light', '15', '6', '80', 1, 1, 1),
(5, 'GREENWICH', 'ENGLISH STRONG ALE', '2016-02-17 11:19:45', '0000-00-00', 'Рубиновый эль с ароматом красного вина и нотками черешни. Во вкусе продолжается винно-черешневая тема, переходящая в сухую умеренную горечь.', 4, '00514c', '/templates/default/img/label_bg_1.png', 'red', '17', '6', '50', 1, 1, 1),
(6, 'BELGIAN', 'BLONDE ALE', '2016-02-17 11:21:53', '0000-00-00', 'Крепкий светлый эль в Бельгийском стиле. Аромат цитрусово-хмелевой. Во вкусе, так же, различаются сладковато-цитрусовые нотки с легкой хмелевой горечью.', 5, '003282', '/templates/default/img/label_bg_2.png', 'red', '13,5', '5', '25', 1, 1, 1),
(7, 'APA', 'SINGLE HOP EQUINOX', '2016-02-17 11:27:46', '0000-00-00', 'Сварен с использованием благородного Американского хмеля Equinox. Аромат: цитрусово-хвойно-яблочный. Вкус легкий фруктово-хмелевой. Горечь средняя.', 6, '164c2a', '/templates/default/img/label_bg_4.png', 'light', '14', '5,5', '40', 1, 1, 1),
(8, 'AMBER', 'ALE', '2016-02-17 11:42:04', '2016-02-29', 'Рубиново-красный эль с карамельными нотками во вкусе, легкая хмелевая горечь.', 7, 'e0d8c8', '/templates/default/img/label_bg_5.png', 'red', '14', '6', '30', 0, 1, 0),
(9, 'HAWAII', 'PALE ALE', '2016-02-17 11:44:11', '2016-05-01', 'Легкий сезонный эль янтарного цвета. Во вкусе медово-солодовая сладость с небольшой горчинкой в завершении.', 8, '0d7239', '/templates/default/img/label_bg_6.png', 'light', '12', '4,5', '27', 0, 1, 1),
(10, 'CITRUS', 'BELGIAN WHEAT', '2016-02-17 11:45:23', '2016-03-31', 'Аромат тропических фруктов. Во вкусе преобладают манго-апельсиновые нотки. В завершении грейпфрутовая горечь.', 9, 'f57f24', '/templates/default/img/label_bg_7.png', 'red', '12', '4,5', '35', 0, 1, 1),
(11, 'PORTER', 'DARK BEER', '2016-02-17 11:46:30', '0000-00-00', 'Темное пиво с портвейно-ореховым ароматом. Солодовая сладость во вкусе со смесью чернослива, орехов и ликера.', 10, 'f2d5aa', '/templates/default/img/label_bg_8.png', 'dark', '16', '6', '30', 1, 1, 0);
