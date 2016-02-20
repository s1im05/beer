-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- ����: 127.0.0.1
-- ����� ��������: ��� 20 2016 �., 14:17
-- ������ �������: 5.5.25
-- ������ PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- ���� ������: `beer`
--

-- --------------------------------------------------------

--
-- ��������� ������� `beer__places`
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
-- ��������� ������� `beer__sort`
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
-- ���� ������ ������� `beer__sort`
--

INSERT INTO `beer__sort` (`id`, `title`, `title_sub`, `date_c`, `date_e`, `text`, `sort`, `color`, `image`, `type`, `og`, `abv`, `ibu`, `available`, `show`, `text_color`) VALUES
(1, 'QUADRUPEL', 'BELGIAN STYLE', '2016-02-17 09:59:27', '0000-00-00', '�������, ������� ������ ���� � �������� ������� ��������. ����������� ���� � ����� ������ ������. �� ����� �������, ��������, ����.', 0, '592c71', '/templates/default/img/label_bg_11.png', 'dark', '24', '9', '40', 1, 1, 1),
(2, 'BLACK RAY', 'IPA', '2016-02-17 10:50:56', '2016-03-31', '� ������� ������ ������������ � ���������. �� ����� ���������, ����������� ������, ����� �������.', 1, '2a2927', '/templates/default/img/label_bg_12.png', 'dark', '20', '8,5', '70', 0, 1, 1),
(3, 'EXTRA CITRA', 'IPA', '2016-02-17 11:16:03', '2016-03-31', '���� � ����� IPA � ������ �� ����� Citra. ������ ���������� ����� ����� ������������ �� ����� ���������, ��� ������� ����� ������ ����������� �������. ��������� �������� ����� �������� 85IBU � ���������� ����� ��� �� ��������.', 2, 'ba5619', '/templates/default/img/label_bg_9.png', 'red', '16', '7', '85', 0, 1, 1),
(4, 'HOP&WOOD', 'STRONG LAGER', '2016-02-17 11:17:58', '0000-00-00', '����������������� ���� - ������ ���������� �����, ���������� �� ���� ����. � �����, ���������� ���� ��������� ����� � ����� �������� ���������� ����. ���� �������� ������, ����� � ���������� ������� � ����������.', 3, '3b0300', '/templates/default/img/label_bg_10.png', 'light', '15', '6', '80', 1, 1, 1),
(5, 'GREENWICH', 'ENGLISH STRONG ALE', '2016-02-17 11:19:45', '0000-00-00', '��������� ��� � �������� �������� ���� � ������� �������. �� ����� ������������ �����-���������� ����, ����������� � ����� ��������� ������.', 4, '00514c', '/templates/default/img/label_bg_1.png', 'red', '17', '6', '50', 1, 1, 1),
(6, 'BELGIAN', 'BLONDE ALE', '2016-02-17 11:21:53', '0000-00-00', '������� ������� ��� � ����������� �����. ������ ���������-��������. �� �����, ��� ��, ����������� ����������-���������� ����� � ������ �������� �������.', 5, '003282', '/templates/default/img/label_bg_2.png', 'red', '13,5', '5', '25', 1, 1, 1),
(7, 'APA', 'SINGLE HOP EQUINOX', '2016-02-17 11:27:46', '0000-00-00', '������ � �������������� ������������ ������������� ����� Equinox. ������: ���������-������-��������. ���� ������ ��������-��������. ������ �������.', 6, '164c2a', '/templates/default/img/label_bg_4.png', 'light', '14', '5,5', '40', 1, 1, 1),
(8, 'AMBER', 'ALE', '2016-02-17 11:42:04', '2016-02-29', '��������-������� ��� � ������������ ������� �� �����, ������ �������� ������.', 7, 'e0d8c8', '/templates/default/img/label_bg_5.png', 'red', '14', '6', '30', 0, 1, 0),
(9, 'HAWAII', 'PALE ALE', '2016-02-17 11:44:11', '2016-05-01', '������ �������� ��� ��������� �����. �� ����� ������-��������� �������� � ��������� ��������� � ����������.', 8, '0d7239', '/templates/default/img/label_bg_6.png', 'light', '12', '4,5', '27', 0, 1, 1),
(10, 'CITRUS', 'BELGIAN WHEAT', '2016-02-17 11:45:23', '2016-03-31', '������ ����������� �������. �� ����� ����������� �����-������������ �����. � ���������� ������������� ������.', 9, 'f57f24', '/templates/default/img/label_bg_7.png', 'red', '12', '4,5', '35', 0, 1, 1),
(11, 'PORTER', 'DARK BEER', '2016-02-17 11:46:30', '0000-00-00', '������ ���� � ���������-�������� ��������. ��������� �������� �� ����� �� ������ ����������, ������ � ������.', 10, 'f2d5aa', '/templates/default/img/label_bg_8.png', 'dark', '16', '6', '30', 1, 1, 0);
