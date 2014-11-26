-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Ноя 15 2014 г., 14:32
-- Версия сервера: 5.6.20
-- Версия PHP: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `smartbullet`
--

-- --------------------------------------------------------

--
-- Структура таблицы `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
`id` int(11) NOT NULL,
  `author_id` int(11) DEFAULT NULL,
  `text` text,
  `post_id` int(11) DEFAULT NULL,
  `datetime` datetime DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Дамп данных таблицы `comment`
--

INSERT INTO `comment` (`id`, `author_id`, `text`, `post_id`, `datetime`) VALUES
(31, 2, 'dxgfchvhjbk', 10, '2014-11-12 19:02:44'),
(32, 2, 'etyu', 10, '2014-11-12 19:03:21'),
(33, 1, 'dd', 21, '2014-11-14 05:16:44'),
(34, 1, 'sdsd', 21, '2014-11-14 05:16:49');

-- --------------------------------------------------------

--
-- Структура таблицы `post`
--

CREATE TABLE IF NOT EXISTS `post` (
`id` int(11) NOT NULL,
  `author_id` int(11) DEFAULT NULL,
  `text` text,
  `wall_id` int(11) DEFAULT NULL,
  `datetime` datetime DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Дамп данных таблицы `post`
--

INSERT INTO `post` (`id`, `author_id`, `text`, `wall_id`, `datetime`) VALUES
(9, 1, 'HELLO!!', 2, '2014-11-12 16:10:01'),
(10, 1, 'How are you?)', 2, '2014-11-12 16:11:19'),
(21, 2, 'jkjkj', 1, '2014-11-12 18:37:41'),
(22, 1, 'aaa', 1, '2014-11-14 05:16:53');

-- --------------------------------------------------------

--
-- Структура таблицы `relationship`
--

CREATE TABLE IF NOT EXISTS `relationship` (
`id` int(11) NOT NULL,
  `user1` int(11) DEFAULT NULL,
  `user2` int(11) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `state` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=71 ;

--
-- Дамп данных таблицы `relationship`
--

INSERT INTO `relationship` (`id`, `user1`, `user2`, `type`, `state`) VALUES
(59, 4, 1, 0, 0),
(60, 1, 4, 0, 0),
(61, 4, 2, 1, 1),
(62, 2, 4, 2, 1),
(63, 3, 4, 1, 1),
(64, 4, 3, 2, 1),
(65, 3, 1, 1, 0),
(66, 1, 3, 2, 0),
(67, 2, 1, 0, 0),
(68, 1, 2, 0, 0),
(69, 2, 3, 1, 1),
(70, 3, 2, 2, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`id` int(11) NOT NULL,
  `login` varchar(32) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `brth` date DEFAULT NULL,
  `city` varchar(32) DEFAULT NULL,
  `email` varchar(32) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `photo` varchar(32) DEFAULT NULL,
  `data` datetime DEFAULT NULL,
  `first_name` varchar(32) DEFAULT NULL,
  `last_name` varchar(32) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `login`, `password`, `brth`, `city`, `email`, `rating`, `photo`, `data`, `first_name`, `last_name`) VALUES
(1, 'MyLogin', '123', '1990-10-15', 'Novosibirsk', 'login@mail.ru', 10000, 'photo.jpg', '2014-11-12 00:00:00', 'Ivan', 'Ivanov'),
(2, 'User2', '123', NULL, 'SPB', 'user@gmail.com', 5000, 'p.jpg', '2014-11-12 00:00:00', 'Petya', 'Petrov'),
(3, 'lala', '123', '0000-00-00', '', '', NULL, '', '0000-00-00 00:00:00', '', NULL),
(4, 'kto-to', '123', '0000-00-00', 'nsk', '', 400, '', '0000-00-00 00:00:00', 'Vasya', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
 ADD PRIMARY KEY (`id`), ADD KEY `post_id` (`post_id`), ADD KEY `author_id` (`author_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
 ADD PRIMARY KEY (`id`), ADD KEY `author_id` (`author_id`), ADD KEY `wall_id` (`wall_id`);

--
-- Indexes for table `relationship`
--
ALTER TABLE `relationship`
 ADD PRIMARY KEY (`id`), ADD KEY `user1` (`user1`), ADD KEY `user2` (`user2`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `relationship`
--
ALTER TABLE `relationship`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=71;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `comment`
--
ALTER TABLE `comment`
ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`),
ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`author_id`) REFERENCES `user` (`id`);

--
-- Ограничения внешнего ключа таблицы `post`
--
ALTER TABLE `post`
ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `user` (`id`),
ADD CONSTRAINT `post_ibfk_2` FOREIGN KEY (`wall_id`) REFERENCES `user` (`id`);

--
-- Ограничения внешнего ключа таблицы `relationship`
--
ALTER TABLE `relationship`
ADD CONSTRAINT `relationship_ibfk_1` FOREIGN KEY (`user1`) REFERENCES `user` (`id`),
ADD CONSTRAINT `relationship_ibfk_2` FOREIGN KEY (`user2`) REFERENCES `user` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
