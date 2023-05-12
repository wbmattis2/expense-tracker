-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: May 04, 2023 at 08:07 PM
-- Server version: 5.7.39
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `expense_data`
--

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `expense_id` int(11) NOT NULL,
  `expense_date` date NOT NULL,
  `item_name` varchar(15) NOT NULL,
  `item_description` varchar(45) NOT NULL,
  `amount` decimal(14,2) NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `expense_categories`
--

CREATE TABLE `expense_categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(15) NOT NULL,
  `category_owner_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `expense_categories`
--

INSERT INTO `expense_categories` (`category_id`, `category_name`, `category_owner_id`) VALUES
(1, 'FOOD', NULL),
(2, 'GAS', NULL),
(3, 'MISC', NULL),
(4, 'TRAINING', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `registered_users`
--

CREATE TABLE `registered_users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `registered_users`
--

INSERT INTO `registered_users` (`user_id`, `username`, `password`) VALUES
(1, 'Mattis', 'fc1b40bd4900177ed97967e1bfbd0c69');

-- --------------------------------------------------------

--
-- Table structure for table `store_names`
--

CREATE TABLE `store_names` (
  `store_id` int(11) NOT NULL,
  `store_name` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `store_names`
--

INSERT INTO `store_names` (`store_id`, `store_name`) VALUES
(4, ''),
(1, 'Blockbuster'),
(2, 'JCPenney'),
(3, 'Toys R Us');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`expense_id`),
  ADD KEY `store_id` (`store_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `expense_categories`
--
ALTER TABLE `expense_categories`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `category_name` (`category_name`),
  ADD KEY `category_owner_id` (`category_owner_id`);

--
-- Indexes for table `registered_users`
--
ALTER TABLE `registered_users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `store_names`
--
ALTER TABLE `store_names`
  ADD PRIMARY KEY (`store_id`),
  ADD UNIQUE KEY `store_name` (`store_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `expense_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `expense_categories`
--
ALTER TABLE `expense_categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `registered_users`
--
ALTER TABLE `registered_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `store_names`
--
ALTER TABLE `store_names`
  MODIFY `store_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `expenses`
--
ALTER TABLE `expenses`
  ADD CONSTRAINT `expenses_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `registered_users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `expenses_ibfk_2` FOREIGN KEY (`store_id`) REFERENCES `store_names` (`store_id`),
  ADD CONSTRAINT `expenses_ibfk_3` FOREIGN KEY (`category_id`) REFERENCES `expense_categories` (`category_id`);

--
-- Constraints for table `expense_categories`
--
ALTER TABLE `expense_categories`
  ADD CONSTRAINT `expense_categories_ibfk_1` FOREIGN KEY (`category_owner_id`) REFERENCES `registered_users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;
