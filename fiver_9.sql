-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2022 at 08:52 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fiver_9`
--

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `status` varchar(255) DEFAULT 'Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `user_id`, `category`, `subject`, `content`, `status`, `created_at`) VALUES
(1, '2', 'Software Engineering', 'HTML', 'HTML means Hyper Text Markup Language. ', 'Active', '2022-04-14 10:53:50'),
(3, '2', 'Biology', 'Biology', 'Biology', 'Active', '2022-04-14 12:12:43'),
(4, '2', 'Software Engineering', 'CSS', 'Css is used for web design', 'Active', '2022-04-14 12:13:45'),
(5, '2', 'Software Engineering', 'What is Lorem ipsum?', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Laborum quis minima iste, itaque quos saepe animi atque ut dicta cupiditate pariatur nemo aliquam beatae quo veniam? Consectetur, saepe vero minima repudiandae, facilis incidunt soluta quod dolores ducimus perferendis maiores nam consequuntur excepturi delectus eaque corrupti iure nihil doloribus numquam eius at exercitationem iusto ad? Corrupti, qui rem. Laudantium omnis rerum, voluptates blanditiis perferendis architecto optio sunt pariatur? Numquam sapiente adipisci beatae ut. Cum, suscipit dolor eveniet consequuntur ducimus, eaque optio quis rem alias quae enim modi velit voluptatum necessitatibus ab inventore quisquam harum nesciunt incidunt vero dolorum non eum fugiat. Tempore voluptate accusamus maiores commodi sit. Ea ratione, neque maiores dolor inventore doloremque natus soluta consectetur commodi impedit corrupti! Laborum numquam porro in vitae inventore neque vero. Minus quisquam dicta sed doloribus ut laudantium impedit repellat omnis alias corporis obcaecati totam, dolorum iste similique non placeat provident, illo temporibus quas, molestias recusandae excepturi? Aperiam suscipit corporis nisi reiciendis dolorum eos obcaecati quaerat, eaque quam maxime dignissimos quo. Quibusdam et voluptatibus incidunt dolorum exercitationem nemo fugiat consectetur ipsa. Delectus vero magnam qui ratione explicabo maxime quia, soluta, impedit architecto omnis voluptatibus eius cupiditate minus tempora voluptate voluptatum et quaerat dolorem. Eligendi!', 'Active', '2022-05-09 05:19:21');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`) VALUES
(1, 'Software Engineering', '2022-04-13 11:42:52'),
(2, 'Medical', '2022-04-13 11:51:57'),
(3, 'Biology', '2022-04-13 21:00:27');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `blog_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `user_id`, `blog_id`, `comment`, `created_at`) VALUES
(1, 4, 4, 'CSS is nice', '2022-05-10 05:26:00'),
(2, 3, 4, 'Test Comment', '2022-05-10 05:41:02'),
(3, 3, 1, 'Test Comment', '2022-05-10 05:50:11'),
(4, 3, 3, 'test', '2022-05-10 06:40:21');

-- --------------------------------------------------------

--
-- Table structure for table `comment_replays`
--

CREATE TABLE `comment_replays` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `replay` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comment_replays`
--

INSERT INTO `comment_replays` (`id`, `user_id`, `comment_id`, `replay`, `created_at`) VALUES
(1, 2, 3, 'test', '2022-05-10 12:03:45'),
(2, 2, 2, 'replay', '2022-05-10 12:04:27'),
(4, 2, 7, 'test', '2022-05-10 12:42:59');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `blog_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `user_id`, `blog_id`, `created_at`) VALUES
(28, 2, 3, '2022-05-10 06:36:05'),
(29, 2, 4, '2022-05-10 06:37:02');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `f_name` varchar(60) NOT NULL,
  `l_name` varchar(60) NOT NULL,
  `email` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `birth` date NOT NULL,
  `addr` longtext NOT NULL,
  `institute` text NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Active',
  `photo` varchar(255) NOT NULL DEFAULT 'usr.png',
  `user_type` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `f_name`, `l_name`, `email`, `city`, `country`, `gender`, `birth`, `addr`, `institute`, `password`, `status`, `photo`, `user_type`, `created_at`) VALUES
(1, 'Admin', 'Admin', 'admin@gmail.com', 'Narayanganj', 'Bangladesh', 'Male', '2000-06-15', 'Ekrampur Espahani Bazar', 'Govt. Graphics Arts Institue', '618e02fc80fa3a0bd41d65f5b54a11fc50426d12', 'Active', 'usr.png', 'Admin', '2022-04-13 19:18:26'),
(2, 'Mohammad', 'Sobuj', 'sobuj@gmail.com', 'Narayanganj', 'Bangladesh', 'Male', '2000-06-15', '130 Road', 'Graphics Arts Institue', '618e02fc80fa3a0bd41d65f5b54a11fc50426d12', 'Active', 'usr.png', 'None', '2022-04-13 19:19:33'),
(3, 'Test', 'Test', 'test@test.com', 'Narayanganj', 'Bangladesh', 'Male', '2022-04-12', 'Ekrampur Espahani Bazar ', 'Govt. Graphics Arts Institue', '618e02fc80fa3a0bd41d65f5b54a11fc50426d12', 'Active', 'usr.png', 'Teacher', '2022-04-13 20:20:58'),
(4, 'Test', 'Profile', 'test2@test.com', 'Dhaka', 'Bangladesh', 'Male', '2022-04-14', '130 Road', 'Test University', '618e02fc80fa3a0bd41d65f5b54a11fc50426d12', 'Active', 'usr.png', 'Student', '2022-04-13 21:01:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment_replays`
--
ALTER TABLE `comment_replays`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `comment_replays`
--
ALTER TABLE `comment_replays`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
