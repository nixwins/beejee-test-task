-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 24, 2020 at 04:18 AM
-- Server version: 8.0.15
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `beejeetask`
--

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

DROP TABLE IF EXISTS `tasks`;
CREATE TABLE IF NOT EXISTS `tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(60) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(60) COLLATE utf8mb4_general_ci NOT NULL,
  `text` tinytext COLLATE utf8mb4_general_ci NOT NULL,
  `status` enum('done','progress') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'progress',
  `modified_by` int(11) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `username`, `email`, `text`, `status`, `modified_by`) VALUES
(1, 'дос', 'halaulilau@gmail.com', 'задча 1', 'done', 0),
(2, 'никнаейм 2', 'newlifenewgoal@gmail.com', 'задча 2', 'done', 0),
(3, 'никнаейм3', 'pokrovka_sh@mail.ru', 'задча 3', 'progress', 0),
(4, 'никнаейм 4', 'pokrovka_sh@mail.ru', 'задача 4', 'progress', 0),
(5, 'никнаейм 5', 'pokrovka_sh@mail.ru', 'задача 5', 'progress', 0),
(6, 'никнаейм 6', 'test@mail.ru', 'задача 6', 'progress', 0),
(7, 'никнаейм 7', 'tes77t@mail.ru', 'задача 7', 'done', 0),
(8, 'никнаейм 8', 'tes8t@mail.ru', 'задача 8', 'progress', 0),
(9, 'test2222', 'a@a.aa', 'sdfds sdfsdfsd f sdfdsf ', 'progress', 1),
(10, '11111111111', 'a@a.aa', 'admin admin                                                                                                                                                      ', 'progress', 1),
(11, 'rrrrrrrrrrr', 'a@a.aa', '                                sdfds sdfsdfsd f sdfdsf                             ', 'done', 0),
(12, 'rrrrrrrrrrr23432423', 'a@a.aa', '                                sdfds sdfsdfsd f sdfdsf                             ', 'done', 0),
(13, 'sfsfsd', 'halaulilau@gmail.com', 'sdfsdf fsdfsdf', 'progress', 0),
(14, 'sfsfsd', 's@dr.r', 'sdfsdf fsdfsdf', 'progress', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `name`) VALUES
(1, 'admin', '$2y$10$Hai6Vz5YTiuedUd.dXoVeO8YgtzRnpKFDu0JWHa8n.3UedCTRi/Zu', 'Администратор');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
