-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 05, 2022 at 06:55 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `us_data`
--
CREATE DATABASE IF NOT EXISTS `us_data` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `us_data`;

-- --------------------------------------------------------

--
-- Table structure for table `election`
--

CREATE TABLE `election` (
  `election_id` int(11) NOT NULL,
  `election_party` varchar(40) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `election`
--

INSERT INTO `election` (`election_id`, `election_party`, `description`) VALUES
(1, 'Democratic', 'The Democratic Party is one of the two major contemporary political parties in the United States. It was founded in 1828 by supporters of Andrew Jackson, making it the world\"s oldest active political party.'),
(2, 'Republican', 'The Republican Party, also referred to as the GOP, is one of the two major contemporary political parties in the United States, along with its main historic rival, the Democratic Party.');

-- --------------------------------------------------------

--
-- Table structure for table `geographic_region`
--

CREATE TABLE `geographic_region` (
  `region_id` int(11) NOT NULL,
  `region_name` varchar(30) NOT NULL,
  `region_climate_description` text NOT NULL,
  `geographical_features` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `geographic_region`
--

INSERT INTO `geographic_region` (`region_id`, `region_name`, `region_climate_description`, `geographical_features`) VALUES
(1, 'Northeast', 'Humid continental climate with cool summers in the northernmost areas. Snow falls during the winter as the temperatures are regularly below freezing.', 'Appalachian Mountains, Atlantic Ocean, Great Lakes, borders on Canada to the north'),
(2, 'Southeast', 'Humid subtropical climate with hot summers. Hurricanes can reach landfall in the summer and fall months along the Atlantic and Gulf coasts.', 'Appalachian Mountains, Atlantic Ocean, Gulf of Mexico, Mississippi River'),
(3, 'Midwest', 'Humid continental climate throughout most of the region. Snow is common during the winter, especially in the northern areas.', 'Great Lakes, Great Plains, Mississippi River, borders Canada to the north'),
(4, 'Southwest', 'Semiarid Steppe climate in the western area with a more humid climate to the east. Some of the far western areas of the region have an alpine or desert climate.', 'Rocky Mountains, Colorado River, Grand Canyon, Gulf of Mexico, borders Mexico to the south.'),
(5, 'West', 'A range of climates including semiarid and alpine along the Rocky and Sierra Mountains. The coastline in California is a Mediterranean climate. Desert climates can be found in Nevada and Southern California.', 'Rocky Mountains, Sierra Nevada Mountains, Mohave Desert, Pacific Ocean, borders Canada to the North and Mexico to the south.');

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `rating_id` int(11) NOT NULL,
  `rating_scale` varchar(20) NOT NULL,
  `rating_description` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`rating_id`, `rating_scale`, `rating_description`) VALUES
(1, 'Excellent', 'A place that is excellent to live with very less crime.'),
(2, 'Good', 'A place that is good to live.'),
(3, 'Average', 'A place that is okay to live, but not good.'),
(4, 'Poor', 'A place that is not good to live because of high crime.');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` tinyint(4) NOT NULL,
  `role` varchar(25) NOT NULL,
  `description` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`, `description`) VALUES
(1, 'System administrator', 'A system administrator has permissions to manage users and contents of the website.'),
(2, 'User manager', ' A user manager has permission to manage user accounts.'),
(3, 'Advanced user', 'In addition to the permission granted to the basic user role, an advanced user also has access to the search feature.'),
(4, 'Basic user', 'A basic user has access to the shopping cart feature.');

-- --------------------------------------------------------

--
-- Table structure for table `tokens`
--

CREATE TABLE `tokens` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `value` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tokens`
--

INSERT INTO `tokens` (`id`, `user`, `value`, `created_at`, `updated_at`) VALUES
(1, 2, 'bef8f45463c9df2208a652a30d8d3edfb68a0e6ce96368144433cbe7b8a887d0959c242981b3bf1403abdf212149f43154208512b7f2c99aaf50e845aecb25ce', '2022-06-05 16:38:45', '2022-06-05 16:38:45');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` smallint(6) DEFAULT 4,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `username`, `password`, `role`, `created_at`, `updated_at`) VALUES
(2, 'hieu', 'hihnguye@iu.edu', 'hieu', '$2y$10$pbSSTZ9k/O5EvEz/oszkDuDaYlIn54NsN17quiJYEGHV18d.rnCr2', 1, '2022-06-05 16:15:19', '2022-06-05 16:15:19'),
(3, 'hoa', 'hoa@iu.edu', 'hoa', '$2y$10$iodW11UzLNLBZoxoETXgoudFkT6eLaZZMsF5Clwc2qB8UVck.DoBC', 2, '2022-06-05 16:26:50', '2022-06-05 16:26:50');

-- --------------------------------------------------------

--
-- Table structure for table `us_city`
--

CREATE TABLE `us_city` (
  `city_id` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `city_name` varchar(50) NOT NULL,
  `latitude` float NOT NULL,
  `longitude` float NOT NULL,
  `city_population` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `us_city`
--

INSERT INTO `us_city` (`city_id`, `state`, `rating`, `city_name`, `latitude`, `longitude`, `city_population`) VALUES
(1, 4, 2, 'San Jose', 37.3382, 121.886, 1029000),
(2, 3, 2, 'Anchorage', 61.2176, 149.9, 292090),
(3, 1, 3, 'Indianapolis', 39.7684, 86.1581, 869387),
(4, 2, 2, 'Scottsdale', 33.4942, 111.926, 254995),
(5, 6, 1, 'Fairfax', 38.8462, 77.3064, 23312),
(6, 6, 1, 'Annandale', 38.8304, 77.1964, 42240),
(7, 5, 3, 'Bangor', 44.8016, 68.7712, 32029),
(8, 7, 4, 'Rapid City', -20.842, -40.7357, 12317),
(9, 7, 1, 'Aberdeen', 57.1499, 2.0938, 213218),
(10, 8, 2, 'Colorado Springs', 36.6329, 107.288, 12329),
(11, 8, 3, 'Aurora', 12.0458, 124.161, 1123120),
(12, 9, 1, 'Seattle', 49.9451, 29.4561, 112331),
(13, 9, 2, 'Spokane', 7.7803, 125.012, 112312),
(14, 10, 3, 'Tulsa', 7.74303, 124.21, 131231),
(15, 10, 4, 'Norman', 34.6743, 36.3972, 14123),
(16, 11, 2, 'Dallas', -27.18, 25.9586, 15123),
(17, 11, 3, 'San Antonio', 41.4199, -8.59178, 11236),
(18, 12, 2, 'Miami', 35.0422, 136.957, 171212),
(19, 12, 2, 'Orlando', 16.7261, 95.6484, 18213),
(20, 13, 3, 'Buffalo', -6.76457, 108.45, 191231),
(21, 14, 4, 'Philadelphia', 8.99513, 124.883, 22310),
(22, 15, 2, 'Chicago', 8.99513, 124.883, 22310);

-- --------------------------------------------------------

--
-- Table structure for table `us_state`
--

CREATE TABLE `us_state` (
  `state_id` int(11) NOT NULL,
  `region` int(11) NOT NULL,
  `state_code` char(2) NOT NULL,
  `state_name` varchar(30) NOT NULL,
  `state_capital` varchar(30) NOT NULL,
  `state_population` int(11) NOT NULL,
  `election` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `us_state`
--

INSERT INTO `us_state` (`state_id`, `region`, `state_code`, `state_name`, `state_capital`, `state_population`, `election`) VALUES
(1, 3, 'IN', 'Indiana', 'Indianapolis', 6697000, 2),
(2, 4, 'AZ', 'Arizona', 'Phoenix', 7174000, 1),
(3, 5, 'AK', 'Alaska', 'Juneau', 736990, 2),
(4, 5, 'CA', 'California', 'Sacramento ', 39350000, 1),
(5, 1, 'ME', 'Maine', 'Augusta', 1341000, 1),
(6, 2, 'VA', 'Virginia', 'Richmond ', 8509000, 1),
(7, 3, 'SD', 'South Dakota', 'Pierre', 72131231, 2),
(8, 5, 'CO', 'Colorado', 'Denver', 221320, 1),
(9, 5, 'WA', 'Washington', 'Olympia', 12423238, 1),
(10, 4, 'OK', 'Oklahoma', 'Oklahoma City', 53242, 2),
(11, 4, 'TX', 'Texas', 'Austin', 242421, 2),
(12, 2, 'FL', 'Florida', 'Tallahassee', 1234324, 2),
(13, 1, 'NY', 'New York', 'Albany', 2342340, 1),
(14, 1, 'PA', 'Pennsylvania', 'Harrisburg', 2234236, 1),
(15, 3, 'IL', 'Illinois', 'Springfield', 234237, 1),
(17, 2, 'OR', 'Oregon', 'Salem', 123, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `election`
--
ALTER TABLE `election`
  ADD PRIMARY KEY (`election_id`);

--
-- Indexes for table `geographic_region`
--
ALTER TABLE `geographic_region`
  ADD PRIMARY KEY (`region_id`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`rating_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tokens`
--
ALTER TABLE `tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`user`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_uindex` (`username`);

--
-- Indexes for table `us_city`
--
ALTER TABLE `us_city`
  ADD PRIMARY KEY (`city_id`),
  ADD KEY `state_id` (`state`),
  ADD KEY `rating_id` (`rating`);

--
-- Indexes for table `us_state`
--
ALTER TABLE `us_state`
  ADD PRIMARY KEY (`state_id`),
  ADD KEY `region_id` (`region`),
  ADD KEY `election_id` (`election`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tokens`
--
ALTER TABLE `tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `us_state`
--
ALTER TABLE `us_state`
  MODIFY `state_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tokens`
--
ALTER TABLE `tokens`
  ADD CONSTRAINT `tokens_ibfk_1` FOREIGN KEY (`user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `us_city`
--
ALTER TABLE `us_city`
  ADD CONSTRAINT `us_city_ibfk_1` FOREIGN KEY (`state`) REFERENCES `us_state` (`state_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `us_city_ibfk_2` FOREIGN KEY (`rating`) REFERENCES `rating` (`rating_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `us_state`
--
ALTER TABLE `us_state`
  ADD CONSTRAINT `us_state_ibfk_1` FOREIGN KEY (`region`) REFERENCES `geographic_region` (`region_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `us_state_ibfk_2` FOREIGN KEY (`election`) REFERENCES `election` (`election_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
