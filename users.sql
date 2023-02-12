-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 12, 2023 at 03:56 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myapi`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `surname` varchar(20) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `passport` varchar(255) NOT NULL,
  `deleted` int(1) NOT NULL DEFAULT 0,
  `created_at` varchar(20) DEFAULT NULL,
  `updated_at` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `surname`, `firstname`, `email`, `password`, `phone`, `passport`, `deleted`, `created_at`, `updated_at`) VALUES
(1, 'demo', 'malolo', 'demo@gmail.com', '', '0905678654', '', 1, NULL, '2023-02-12 08:46:30'),
(2, 'kamoru', 'jolani', 'email@g.com', '', '09087987856', 'http://localhost/myapi/public/uploads/f4c1d6299f533cd.png', 0, NULL, '2023-02-12 03:18:55'),
(3, 'kolade', 'kolade', 'kolade@gmail.com', '', '09056780978', 'http://localhost/myapi/public/uploads/b6a695b7643520a.jpg', 0, '2023-02-11 08:56:19', '2023-02-12 03:48:30'),
(4, 'demo', 'malolo', 'demo@gmail.com', '', '0905678654', '', 0, '2023-02-11 08:58:27', '2023-02-11 08:58:27'),
(5, 'abdulafeez', 'faheemah', 'f.aheem@gmail.com', '', '09058097856', '', 0, '2023-02-12 08:51:12', '2023-02-12 08:51:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
