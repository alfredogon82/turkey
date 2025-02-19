-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 19, 2025 at 05:27 AM
-- Server version: 8.2.0
-- PHP Version: 8.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `turkey_challenge`
--

-- --------------------------------------------------------

--
-- Table structure for table `turkeys`
--

DROP TABLE IF EXISTS `turkeys`;
CREATE TABLE IF NOT EXISTS `turkeys` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `weight` decimal(5,2) DEFAULT NULL,
  `age` int DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `color` varchar(30) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `visible` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `turkeys`
--

INSERT INTO `turkeys` (`id`, `name`, `weight`, `age`, `status`, `color`, `created_at`, `visible`) VALUES
(1, 'funny turkey', 10.00, 10, 'alive', 'green', '2024-07-29 13:34:17', 1),
(2, 'hello turkey', 0.01, 2, 'alive', '#d8cfcf', '2025-02-18 22:18:00', 1),
(3, 'test turkey', 10.00, 2, 'cooked', '#691c1c', '2025-02-18 22:19:50', 1),
(4, 'another turkey test', 34.00, 43, 'alive', '#a44141', '2025-02-18 22:21:20', 1),
(5, 'turkey again', 34.00, 2, 'frozen', '#792915', '2025-02-18 22:22:35', 1),
(6, 'ttt', 23.00, 1, 'alive', '#822626', '2025-02-18 23:15:00', 1),
(7, 'test frozen', 23.00, 1, 'alive', '#000000', '2025-02-18 23:38:02', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
