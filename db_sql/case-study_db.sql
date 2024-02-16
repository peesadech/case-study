-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 16, 2024 at 10:30 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `case-study_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_phone_number` varchar(255) NOT NULL,
  `user_login_username` varchar(255) NOT NULL,
  `user_login_password` varchar(255) NOT NULL,
  `user_is_active` int(11) NOT NULL,
  `user_package_id` int(11) NOT NULL,
  `user_available_date` date NOT NULL,
  `user_image_path` varchar(255) NOT NULL,
  `user_access_type` int(11) NOT NULL DEFAULT 1 COMMENT '1=user,2=admin,99=root',
  `create_date` datetime NOT NULL,
  `create_by` int(11) NOT NULL,
  `update_date` datetime NOT NULL,
  `update_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`user_id`, `user_name`, `user_email`, `user_phone_number`, `user_login_username`, `user_login_password`, `user_is_active`, `user_package_id`, `user_available_date`, `user_image_path`, `user_access_type`, `create_date`, `create_by`, `update_date`, `update_by`) VALUES
(4, 'test01@gmail.com', 'test01@gmail.com', '', 'test01@gmail.com', '$2y$10$5hU8cQeESkKxUigJCzq9POHyJtRzeXYHXWWpih0./CIpUUEl1yHna', 2, 0, '0000-00-00', '', 1, '2024-02-16 15:50:20', 0, '0000-00-00 00:00:00', 0),
(5, 'admin01@gmail.com', 'admin01@gmail.com', '', 'admin01@gmail.com', '$2y$10$iV65L31pcFkgcaF468vWbuGBKR7ru0IrxTft8tea2Bl4KfINQh9pW', 2, 0, '0000-00-00', '', 1, '2024-02-16 16:20:18', 0, '0000-00-00 00:00:00', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
