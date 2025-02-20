-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 05, 2024 at 03:08 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommercedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `Id` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Id`, `Name`, `Email`, `Password`) VALUES
(1, 'dipakvarma', 'dipakvarma1212@gmail.com', '1212');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `Id` int(11) NOT NULL,
  `ProductName` varchar(255) NOT NULL,
  `ProductPhoto` varchar(255) NOT NULL,
  `CostPrice` decimal(10,2) NOT NULL,
  `SellPrice` decimal(10,2) NOT NULL,
  `Profit` decimal(10,2) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Description` text NOT NULL,
  `Category` varchar(255) NOT NULL,
  `SupplierId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`Id`, `ProductName`, `ProductPhoto`, `CostPrice`, `SellPrice`, `Profit`, `Quantity`, `Description`, `Category`, `SupplierId`) VALUES
(2, 'Faber FT 900W BK 900-Watt 2-Slice Pop-up Toaster (Black)', 'https://m.media-amazon.com/images/I/51AGpVUfwuL._SX679_.jpg', 1999.00, 2999.00, 1000.00, 99, 'Capacity: 2 short slice; 220-240V 50-60Hz ; 900 WattControl type: Electronic ; Food grade elementFeatures: Reheat function , defrost function ; cancel function, 7 browing settings & have red indicatorEasy-clean slide-out crumb trayWarranty: 1 Year warranty on product', 'toaster', 1),
(3, 'V-Guard Brio 6 Litre Gas wall Water Geyser with 9-Layer Advanced Safety', 'https://m.media-amazon.com/images/I/71u3A029TAL._SY450_.jpg', 4999.00, 6999.00, 2000.00, 100, 'TYPE: Gas Geyser; WATER FLOW RATE: 6 Litre per Minute at inlet outlet pipe temperature difference of 25 Degree Celsius;; PRESSURE: 8 Bar; SUITABILITY: Well Ventilated Indoor/Outdoor Areas; GAS CONSUMPTION: 0.89 kg/hr<br>\r\nTECHNOLOGY USED: Heat Exchanger Technology, Water Controlled Automatic Ignition; SAFETY FEATURES: Adjustable Gas and Water Flow Control, Summer & Winter Modes, which helps in saving energy and cutting costs, Anti-Frost Protection, Overheat Protection, Flame out Protection, Child Safety Lock, Pressure Regulating Valve (PRV), 20 Minute Cut-off Timer<br>\r\nFREE ACCESSORY KIT: Mounting Screws, Gas inlet faucet(with rubber washer), Rawl plugs, Expansion bolts, Hose clamp<br>', 'gas Geyser', 2);

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `PurchaseId` int(11) NOT NULL,
  `PurchaseDate` date DEFAULT NULL,
  `PurchaseValue` int(11) DEFAULT NULL,
  `ProductName` varchar(255) DEFAULT NULL,
  `CustomerName` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `PhoneNumber` varchar(255) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `UserId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`PurchaseId`, `PurchaseDate`, `PurchaseValue`, `ProductName`, `CustomerName`, `Email`, `PhoneNumber`, `Address`, `UserId`) VALUES
(1, '2024-03-22', 2999, 'Faber FT 900W BK 900-Watt 2-Slice Pop-up Toaster (Black)', 'Raj Deepak Varma', 'varma123@gmail.com', '9689742816', 'Ramchandra nagar behind cotton market, dhule', 1),
(2, '2024-04-02', 2999, 'Faber FT 900W BK 900-Watt 2-Slice Pop-up Toaster (Black)', 'Raj Deepak Varma', 'varma123@gmail.com', '9689742816', 'ssvps college dhule', 1),
(3, '2024-04-02', 2999, 'Faber FT 900W BK 900-Watt 2-Slice Pop-up Toaster (Black)', 'Raj Deepak Varma', 'varma123@gmail.com', '9689742816', 'ssvps college diploma dhule', 1);

-- --------------------------------------------------------

--
-- Table structure for table `repair`
--

CREATE TABLE `repair` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phoneno` varchar(255) NOT NULL,
  `productname` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `request_date` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `repair`
--

INSERT INTO `repair` (`id`, `name`, `phoneno`, `productname`, `photo`, `description`, `request_date`, `status`, `user_id`) VALUES
(3, 'malik nadeem', '7894561230', 'Blender', '', 'not working', '2024-04-02', 'Pending', 1),
(4, 'Raj Deepak Varma', '7894561231', 'Dry Iron', '', 'not working', '2024-04-02', 'Completed', 1),
(5, 'xyz', '7894561231', 'Toaster', '', 'not working', '2024-04-02', 'In Progress', 1);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `SupplierId` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `ShopName` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `PhoneNo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`SupplierId`, `Name`, `ShopName`, `Email`, `PhoneNo`) VALUES
(1, 'Bharat Light Jalgaon', 'bharat light', 'bharat@7781', '9873512698'),
(2, 'power jet sangli', 'power jet', 'powerjet@1212', '8989764532'),
(3, 'spare king indore', 'spare King', 'spareking4343@gmail.com', '968912543');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `Id` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `PhoneNumber` int(11) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`Id`, `Name`, `Email`, `PhoneNumber`, `Address`, `password`) VALUES
(1, 'malik nadeem', 'malik@123', 2147483647, '80 fit road tiranga chawk dhule', '123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `SupplierId` (`SupplierId`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`PurchaseId`);

--
-- Indexes for table `repair`
--
ALTER TABLE `repair`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`SupplierId`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `PurchaseId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `repair`
--
ALTER TABLE `repair`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `SupplierId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`SupplierId`) REFERENCES `supplier` (`SupplierId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
