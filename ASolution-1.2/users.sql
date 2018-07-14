-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 14, 2015 at 09:58 AM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `asolution`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `phone` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `presentadd` varchar(200) NOT NULL,
  `permanentadd` varchar(200) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `phone`, `email`, `presentadd`, `permanentadd`) VALUES
(15, 'jaman', 'ahmed', '01719845856', 'jaman201152@yahoo.com', 'Mohakhali, Dhaka.', 'Mirzapur, Tangail.'),
(16, 'Maruf1', 'Ahmed1', '1234561', 'maruf@yahoo.com', 'Mohakhali, Dhaka.', 'Gaibandha,'),
(18, 'Hasem1', 'ahmed1', '01234567891', 'hasem@gmail1.com', 'nnn1', 'mmm1'),
(20, 'Hasan1', 'Robel1', '1234561', 'hasan@gmail1.com', 'aaa1', 'bbb1'),
(23, 'Joushita', 'Joly', '01719845856', 'joshita@gmail.com', 'Mirpur, Dhaka.', 'Khulna, Dhaka.'),
(24, 'Salam', 'ahmed', '01719845856', 'salam@yahoo.com', 'dhaka', 'Tangail'),
(25, 'Hossain', 'Khaer', '123456', 'hassain@gmail.com', 'mohakhali, Dhaka.', 'Tangail.'),
(26, 'morshed', 'Robel', '25849', 'morshed@yahoo.com', 'Banani, Dhaka.', 'Tangial.'),
(27, 'robel', 'jia', '01718456', 'robel@gmail.com', 'banani,Dhaka.', 'Patuakhali.'),
(28, 'Alom', 'hassan', '01546', 'alom@gmail.com', 'mohakhali, Dhaka.', 'Tangail'),
(29, 'sabbir', 'ahmed', '01719845856', 'sabbir@gmail.com', 'Banani, Dhaka.', 'Mirzapur, Tangail.'),
(30, 'Rahim', 'Ahmed', '01719845856', 'rahim@gmail.com', 'banani, Dhaka.', 'Mirzapur, angail.'),
(31, 'hasan', 'ahmed', '01719845856', 'hasan@gmail.com', 'Mirpur, Dhaka.', 'Mirzapur, Tangail.'),
(32, 'asdf', 'asdf', 'asdf', 'asdfa@yahoo.com', 'sdf', 'asdf');

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
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
