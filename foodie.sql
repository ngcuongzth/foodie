-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 14, 2023 at 05:38 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `foodie`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `fullname`, `user_name`, `password`) VALUES
(55, 'Administrator', 'admin', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `title`, `image_name`, `featured`, `active`) VALUES
(20, 'Drink', 'Foodie_category_758.jpg', 'true', 'true'),
(21, 'Bread And Sanwich', 'Foodie_category_507.jpg', 'true', 'true'),
(22, 'Noodle', 'Foodie_category_78.jpg', 'true', 'true'),
(23, 'Snack', 'Foodie_category_893.jpg', 'true', 'true');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_item`
--

CREATE TABLE `tbl_item` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_item`
--

INSERT INTO `tbl_item` (`id`, `title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES
(1, 'Humberger', 'A hamburger is a popular sandwich that consists of a grilled or fried ground beef patty, placed between two slices of a soft bun. It is typically garnished with various toppings such as lettuce, tomatoes, onions, pickles, and cheese. Hamburger is known for its savory flavor and juicy texture. It is a versatile fast food item that can be enjoyed on its own or customized with additional condiments and ingredients according to individual preferences. With its delicious taste and convenient nature, the hamburger has become a beloved staple in many cuisines worldwide.', 10.00, 'Foodie_menu_303.jpg', 21, 'true', 'true'),
(10, 'Snack Potato', 'Potato snacks are a popular and tasty choice for snacking. Made from potatoes, these snacks come in various forms such as chips, crisps, or fries. They are known for their crispy texture and savory flavors. Potato snacks are often seasoned with different seasonings like salt, cheese, barbecue, sour cream, or various herbs and spices to enhance their taste. They are a convenient and satisfying snack option that can be enjoyed on-the-go or as a part of a meal. Whether you prefer classic potato chips or more unique and gourmet flavors, potato snacks are a versatile and delicious treat that is enjoyed by people of all ages.', 5.00, 'Foodie_menu_27.jpg', 23, 'true', 'true'),
(12, 'Bread Pate Vietnam', 'Vietnamese Pate Banh Mi is a delicious and unique sandwich that originates from Vietnam. It features a crusty baguette filled with a variety of flavorful ingredients. The star of the show is the pate, a smooth and rich spread made from liver, usually pork or chicken, mixed with various seasonings. The pate is combined with thinly sliced Vietnamese ham, pickled carrots and daikon radish, fresh cucumber, cilantro, and sometimes chili peppers for added spice. This combination of ingredients creates a harmonious blend of flavors and textures. The crusty baguette provides the perfect crunch to balance out the creaminess of the pate. Vietnamese Pate Banh Mi is not only a popular street food in Vietnam but has gained international recognition for its unique taste and satisfying experience.                                ', 4.50, 'Foodie_menu_800.jpg', 21, 'true', 'true');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int(10) UNSIGNED NOT NULL,
  `item` varchar(150) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `order_date` datetime NOT NULL,
  `status` varchar(50) NOT NULL,
  `customer_name` varchar(150) NOT NULL,
  `customer_tel` varchar(20) NOT NULL,
  `customer_email` varchar(150) NOT NULL,
  `customer_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `item`, `price`, `qty`, `total`, `order_date`, `status`, `customer_name`, `customer_tel`, `customer_email`, `customer_address`) VALUES
(7, 'Bread Pate Vietnam', 4.50, 5, 22.50, '2023-07-14 16:57:01', 'Ordered', 'Customer 02', '0903245767', 'ngcuongcamp@gmail.com', 'Ngã Tư Làng Đồng, cạnh nhà Hải Linh bán xe đạp điện'),
(8, 'Snack Potato', 5.00, 2, 10.00, '2023-07-14 16:57:31', 'Ordered', 'Ng Cuong', '0903245767', 'ngcuongcamp@gmail.com', 'Ngã Tư Làng Đồng, cạnh nhà Hải Linh bán xe đạp điện'),
(9, 'Bread Pate Vietnam', 4.50, 25, 112.50, '2023-07-14 17:22:03', 'Ordered', 'Ng Cuong', '0903245767', 'ngcuongcamp@gmail.com', 'Ngã Tư Làng Đồng, cạnh nhà Hải Linh bán xe đạp điện');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_name` (`user_name`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_item`
--
ALTER TABLE `tbl_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tbl_item`
--
ALTER TABLE `tbl_item`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
