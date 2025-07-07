-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 07, 2025 at 08:27 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mobileapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `posted_date` date NOT NULL,
  `author` text NOT NULL,
  `title` text NOT NULL,
  `review` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `image_dir` varchar(255) NOT NULL,
  `status` tinyint(1) DEFAULT 1,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`id`, `category_id`, `posted_date`, `author`, `title`, `review`, `image`, `image_dir`, `status`, `created`, `modified`) VALUES
(1, 1, '2024-06-01', 'Ali', 'MyFitness Pal Review', 'track meal easily', 'fitness.png', 'uploads', 1, '2025-07-07 05:43:24', '2025-07-07 05:43:24'),
(2, 2, '2024-05-15', 'Zara', 'Calm App Review', 'very relaxing', 'calm.jpeg', 'uploads', 1, '2025-07-07 05:45:36', '2025-07-07 05:45:36'),
(3, 3, '2024-07-01', 'Nina', 'Todoist App Review', 'great manage daily task', 'todoist.png', 'uploads', 1, '2025-07-07 05:47:57', '2025-07-07 05:47:57');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `status` text NOT NULL,
  `created` date NOT NULL,
  `modified` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`, `status`, `created`, `modified`) VALUES
(1, 'Fitness App', 'active', '2023-01-01', '2024-06-01'),
(2, 'Mental Health App', 'active', '2023-05-01', '2024-06-01'),
(3, 'Productivity App', 'inactive', '2022-08-15', '2024-05-01'),
(4, 'Health', 'active', '2022-03-31', '2024-02-02'),
(5, 'Games', 'active', '2023-03-01', '2024-01-01');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `application_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `comment` text NOT NULL,
  `rating` int(10) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `modified` timestamp NOT NULL DEFAULT current_timestamp(),
  `created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `application_id`, `name`, `comment`, `rating`, `status`, `modified`, `created`) VALUES
(1, 1, 'farah', 'easy to use and motivate me\r\n', 5, 1, '2025-07-07 05:43:58', '2025-07-07 05:43:58'),
(2, 2, 'John', 'I sleep better now', 4, 1, '2025-07-07 05:46:16', '2025-07-07 05:46:16'),
(3, 3, 'Lee', 'simple and clean design', 5, 1, '2025-07-07 05:48:23', '2025-07-07 05:48:23'),
(4, 1, 'aiman', 'good app', 5, 1, '2025-07-07 05:55:58', '2025-07-07 05:55:58'),
(5, 1, 'naqib', 'motivate me to run', 5, 1, '2025-07-07 05:58:53', '2025-07-07 05:58:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `application_id` (`application_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `applications`
--
ALTER TABLE `applications`
  ADD CONSTRAINT `applications_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`application_id`) REFERENCES `applications` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
