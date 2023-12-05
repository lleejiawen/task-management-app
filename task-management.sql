-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2023 at 07:11 AM
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
-- Database: `task-management`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `remarks` text NOT NULL,
  `created_at` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `name`, `email`, `phone`, `remarks`, `created_at`) VALUES
(1, 'Customer 1', 'customer1@email.com', '90000000', 'Whatsapp Referral', '1701579655'),
(2, 'Customer 2', 'customer2@email.com', '89999999', '', '1701579775'),
(3, 'Customer 3', 'customer3@email.com', '80000000', '', '1701579840');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `task_name` varchar(50) NOT NULL,
  `task_description` text NOT NULL,
  `assigned_to` int(11) DEFAULT NULL,
  `task_priority` int(11) DEFAULT NULL,
  `task_status` int(11) DEFAULT NULL,
  `completion_date` varchar(10) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `customer_info` int(11) DEFAULT NULL,
  `created_at` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `task_name`, `task_description`, `assigned_to`, `task_priority`, `task_status`, `completion_date`, `remarks`, `customer_info`, `created_at`) VALUES
(1, 'Delayed Shipment Complaint', 'Customer reported a delay in receiving their order. Check order status, communicate with the warehouse, and update the customer on the resolution progress.', 3, 2, 2, '', ' Investigate and resolve the customer complaint regarding a delayed shipment.', 2, '1701586831'),
(2, 'Follow-Up on Customer Feedback', 'Review recent customer feedback and follow up with customers to gather more details and ensure satisfaction.', 2, 1, 3, '1701752287', 'Analyze feedback from recent customer surveys. Contact customers who provided feedback, thank them for their input, and inquire about specific areas for improvement. Document responses for future analysis.', 2, '1701587119');

-- --------------------------------------------------------

--
-- Table structure for table `tasks_priority`
--

CREATE TABLE `tasks_priority` (
  `id` int(11) NOT NULL,
  `priority` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tasks_priority`
--

INSERT INTO `tasks_priority` (`id`, `priority`) VALUES
(1, 'Low'),
(2, 'Medium'),
(3, 'High');

-- --------------------------------------------------------

--
-- Table structure for table `tasks_status`
--

CREATE TABLE `tasks_status` (
  `id` int(11) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tasks_status`
--

INSERT INTO `tasks_status` (`id`, `status`) VALUES
(1, 'Open'),
(2, 'In Progress'),
(3, 'Completed');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` int(11) NOT NULL,
  `user_department` int(10) NOT NULL,
  `created_at` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `full_name`, `email`, `password`, `user_type`, `user_department`, `created_at`) VALUES
(1, 'master1', 'Master User', 'master@email.com', '$2y$10$hQDtSwKhRdp7wUt/K1SlaO/snA4XJdeiQ6oZkABZUSAv6tt.gRo92', 1, 1, '1701484209'),
(2, 'user1', 'Customer Feedback Team - User 1', 'user1@email.com', '$2y$10$0uuBmU6l563GnbI/wS8HjOHkVwzmudlN1vLv.StNjg9KcTY1moI/m', 2, 4, '1701578275'),
(3, 'user2', 'Customer Support Team - User 2', 'user2@email.com', '$2y$10$gCq3h.av5E1lHCP8ZzK.bOUdriRrOE6J82JHZfLTlWAuJT4qKX9o2', 2, 2, '1701752100'),
(4, 'support1', 'Support 1', 'support1@email.com', '$2y$10$keYwTvicsPg8sNrwT.UHcukBjLv6ONoudr8/sJn.Q6r.KjHzbnAf.', 2, 2, '1701755742');

-- --------------------------------------------------------

--
-- Table structure for table `user_department`
--

CREATE TABLE `user_department` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `remarks` text NOT NULL,
  `created_at` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_department`
--

INSERT INTO `user_department` (`id`, `name`, `remarks`, `created_at`) VALUES
(1, 'Management Team', '', '1701577819'),
(2, 'Customer Support Team', 'Remarks', '1701577846'),
(4, 'Customer Feedback Team', '', '1701577864');

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `id` int(11) NOT NULL,
  `user_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`id`, `user_type`) VALUES
(1, 'Administrator'),
(2, 'User');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `task_priority` (`task_priority`),
  ADD KEY `task_status` (`task_status`),
  ADD KEY `assigned_to` (`assigned_to`),
  ADD KEY `customer_info` (`customer_info`);

--
-- Indexes for table `tasks_priority`
--
ALTER TABLE `tasks_priority`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks_status`
--
ALTER TABLE `tasks_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userType` (`user_type`),
  ADD KEY `user_department` (`user_department`);

--
-- Indexes for table `user_department`
--
ALTER TABLE `user_department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tasks_priority`
--
ALTER TABLE `tasks_priority`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tasks_status`
--
ALTER TABLE `tasks_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_department`
--
ALTER TABLE `user_department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`task_priority`) REFERENCES `tasks_priority` (`id`),
  ADD CONSTRAINT `tasks_ibfk_2` FOREIGN KEY (`task_status`) REFERENCES `tasks_status` (`id`),
  ADD CONSTRAINT `tasks_ibfk_3` FOREIGN KEY (`assigned_to`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `tasks_ibfk_4` FOREIGN KEY (`customer_info`) REFERENCES `customer` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`user_type`) REFERENCES `user_type` (`id`),
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`user_department`) REFERENCES `user_department` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
