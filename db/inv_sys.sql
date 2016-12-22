-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 23, 2016 at 12:09 AM
-- Server version: 5.5.53-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `inv_sys`
--

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE IF NOT EXISTS `bank` (
  `id` int(11) NOT NULL,
  `acname` varchar(100) NOT NULL,
  `acno` varchar(100) NOT NULL,
  `type` varchar(10) NOT NULL,
  `bname` varchar(100) NOT NULL,
  `balance` decimal(65,0) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bank`
--

INSERT INTO `bank` (`id`, `acname`, `acno`, `type`, `bname`, `balance`) VALUES
(1, 'Software Solution Inc', '120120000001212', 'CA', 'IFIC Bank Ltd.', 6000),
(2, 'Didar Computer', '90909090905551', 'SA', 'BRAC Bank Ltd.', 2500),
(3, 'Bishmillah Paper', '120000001515', 'FD', 'Dutch Bangla Bank Ltd.', 80000);

-- --------------------------------------------------------

--
-- Table structure for table `customer_info`
--

CREATE TABLE IF NOT EXISTS `customer_info` (
  `cust_id` int(50) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `cname` varchar(50) NOT NULL,
  `contact` varchar(11) NOT NULL,
  `addr` text NOT NULL,
  PRIMARY KEY (`cust_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=100057 ;

--
-- Dumping data for table `customer_info`
--

INSERT INTO `customer_info` (`cust_id`, `name`, `cname`, `contact`, `addr`) VALUES
(100054, 'Shahed Bhuiyan', 'SSI', '01821152983', 'Feni Sadar'),
(100055, '', '', '', ''),
(100056, '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `daily_expense`
--

CREATE TABLE IF NOT EXISTS `daily_expense` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ename` varchar(50) NOT NULL,
  `etype` varchar(10) NOT NULL,
  `description` text NOT NULL,
  `dat` date NOT NULL,
  `eamount` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `daily_expense`
--

INSERT INTO `daily_expense` (`id`, `ename`, `etype`, `description`, `dat`, `eamount`) VALUES
(1, 'Tea Break', 'Nasta', 'lsakdjf', '2014-02-10', '100');

-- --------------------------------------------------------

--
-- Table structure for table `daily_suppliers`
--

CREATE TABLE IF NOT EXISTS `daily_suppliers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sid` int(11) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `daily_suppliers`
--

INSERT INTO `daily_suppliers` (`id`, `sid`, `date`) VALUES
(8, 1, '2014-02-08'),
(9, 2, '2014-02-08'),
(10, 1, '2014-02-10'),
(11, 3, '2014-02-10'),
(12, 1, '2014-03-03'),
(13, 2, '2014-03-03'),
(14, 1, '2014-12-24'),
(15, 2, '2014-12-24'),
(16, 1, '2015-01-17'),
(17, 1, '2015-09-14');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_info`
--

CREATE TABLE IF NOT EXISTS `delivery_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hname` varchar(30) NOT NULL,
  `contact` varchar(11) NOT NULL,
  `pcode` varchar(10) NOT NULL,
  `addr` text NOT NULL,
  `invoice_no` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=93 ;

--
-- Dumping data for table `delivery_info`
--

INSERT INTO `delivery_info` (`id`, `hname`, `contact`, `pcode`, `addr`, `invoice_no`) VALUES
(87, 'shahed ', '09080', '3900', 'dhaka', 'INV-BP-0000'),
(88, 'Didar Ahamed', '0239498', '3900', 'Dagonbhuiyan, Feni', 'INV-BP-0001'),
(89, 'tareq mahmud', '01821152983', '3900', 'feni', 'INV-BP-0014'),
(90, 'name', '9879', '987', 'feni', 'INV-BP-0015'),
(91, '', '', '', '', 'INV-BP-0017'),
(92, '', '', '', '', 'INV-BP-0018');

-- --------------------------------------------------------

--
-- Table structure for table `employee_info`
--

CREATE TABLE IF NOT EXISTS `employee_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_id` varchar(20) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `blood` varchar(3) NOT NULL,
  `gender` varchar(2) NOT NULL,
  `addr` text NOT NULL,
  `email` varchar(70) NOT NULL,
  `contact` varchar(11) NOT NULL,
  `pic` varchar(10) NOT NULL,
  `auth_type` varchar(50) NOT NULL,
  `salary` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `employee_info`
--

INSERT INTO `employee_info` (`id`, `emp_id`, `fname`, `lname`, `dob`, `blood`, `gender`, `addr`, `email`, `contact`, `pic`, `auth_type`, `salary`) VALUES
(4, '1', 'Shahed', 'Bhuiyan', '0000-00-00', 'O+', 'M', 'Noakhali', 'turajsamir@gmail.com', '01813195151', '1.jpg', '', '12'),
(5, '2', 'Shahed', 'Bhuiyan', '1991-01-01', 'B+', 'M', 'Feni Sadar', 'shahedbhuiyan@ssibd.com', '01821152983', '', '', '30000');

-- --------------------------------------------------------

--
-- Table structure for table `ledger`
--

CREATE TABLE IF NOT EXISTS `ledger` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `inv_sl` int(50) NOT NULL,
  `sold_by` varchar(50) NOT NULL,
  `item_id` int(10) NOT NULL,
  `product` varchar(50) NOT NULL,
  `unit_price` varchar(10) NOT NULL,
  `quantity` varchar(10) NOT NULL,
  `warrenty` varchar(10) NOT NULL,
  `total` varchar(10) NOT NULL,
  `purchase` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=339 ;

--
-- Dumping data for table `ledger`
--

INSERT INTO `ledger` (`id`, `inv_sl`, `sold_by`, `item_id`, `product`, `unit_price`, `quantity`, `warrenty`, `total`, `purchase`) VALUES
(297, 2, 'Kiran Ahmed', 3, 'Lumia 520 15500', '15500', '1', '', '15500', '14999'),
(298, 2, 'Kiran Ahmed', 1, 'Mouse 400', '400', '2', '', '800', '350'),
(299, 3, 'Kiran Ahmed', 1, 'Mouse 400', '400.67', '2', '', '801', '350'),
(300, 4, 'Kiran Ahmed', 1, 'Mouse 400', '10.5', '3', '', '31.5', '350'),
(301, 5, 'Kiran Ahmed', 1, 'Mouse 400', '400', '2', '', '800', '350'),
(302, 6, 'Kiran Ahmed', 1, 'Mouse -> A4Tech', '400', '4', '', '1600', '350'),
(303, 7, 'Kiran Ahmed', 1, 'Mouse -> A4Tech', '400.78', '3', '', '1202.34', '350'),
(304, 8, 'Kiran Ahmed', 1, 'Mouse -> A4Tech', '400.67', '2', '', '801.34', '350'),
(305, 9, 'Kiran Ahmed', 5, 'HDD -> Segate', '5500.89', '2', '', '11001.78', '4500'),
(306, 10, 'Kiran Ahmed', 1, 'Mouse -> A4Tech', '400', '3', '', '1200', '350'),
(307, 10, 'Kiran Ahmed', 4, 'Keyboard -> Asus', '49.78', '3', '', '149.34', '450'),
(308, 11, 'Kiran Ahmed', 6, 'Processor - Core i3 8500', '8500', '1', '', '8500', '8000'),
(309, 12, 'Kiran Ahmed', 6, 'Processor - Core i3 8500', '8500', '1', '', '8500', '8000'),
(310, 12, 'Kiran Ahmed', 1, 'Mouse 400', '400', '2', '', '800', '350'),
(311, 12, 'Kiran Ahmed', 5, 'HDD 5500', '5500', '2', '', '11000', '4500'),
(312, 13, 'Kiran Ahmed', 6, 'Processor - Core i3 8500', '8500', '2', '', '17000', '8000'),
(313, 13, 'Kiran Ahmed', 4, 'Keyboard 500', '500', '4', '', '2000', '450'),
(314, 13, 'Kiran Ahmed', 1, 'Mouse 400', '400', '3', '', '1200', '350'),
(315, 14, 'Shahed Bhuiyan', 6, 'Processor - Core i3 8500', '8500', '2', '', '17000', '8000'),
(316, 14, 'Shahed Bhuiyan', 1, 'Mouse 400', '400', '2', '', '800', '350'),
(317, 14, 'Shahed Bhuiyan', 5, 'HDD 5500', '5500', '4', '', '22000', '4500'),
(318, 15, 'Shahed Bhuiyan', 1, 'Mouse 400', '400', '3', '', '1200', '350'),
(319, 15, 'Shahed Bhuiyan', 6, 'Processor - Core i3 8500', '8500', '2', '', '17000', '8000'),
(320, 15, 'Shahed Bhuiyan', 4, 'Keyboard 500', '500', '3', '', '1500', '450'),
(321, 15, 'Shahed Bhuiyan', 5, 'HDD 5500', '5500', '4', '', '22000', '4500'),
(322, 16, 'Shahed Bhuiyan', 6, 'Processor - Core i3 8500', '8500', '2', '', '17000', '8000'),
(323, 16, 'Shahed Bhuiyan', 5, 'HDD 5500', '5500', '2', '', '11000', '4500'),
(324, 16, 'Shahed Bhuiyan', 4, 'Keyboard 500', '500', '1', '', '500', '450'),
(325, 17, 'Shahed Bhuiyan', 1, 'Mouse 400', '400', '2', '', '800', '350'),
(326, 17, 'Shahed Bhuiyan', 4, 'Keyboard 500', '500', '2', '', '1000', '450'),
(327, 17, 'Shahed Bhuiyan', 5, 'HDD 5500', '5500', '1', '', '5500', '4500'),
(328, 18, 'Shahed Bhuiyan', 8, 'RAM 3200', '3200', '1', '', '3200', '3000'),
(329, 18, 'Shahed Bhuiyan', 4, 'Keyboard 500', '500', '3', '', '1500', '450'),
(330, 18, 'Shahed Bhuiyan', 6, 'Processor - Core i3 8500', '8500', '1', '', '8500', '8000'),
(331, 19, 'Shahed Bhuiyan', 6, 'Processor - Core i3 8500', '8500', '2', '', '17000', '8000'),
(332, 19, 'Shahed Bhuiyan', 1, 'Mouse 400', '400', '4', '', '1600', '350'),
(333, 19, 'Shahed Bhuiyan', 8, 'RAM 3200', '3200', '1', '', '3200', '3000'),
(334, 20, 'Shahed Bhuiyan', 8, 'RAM -> Transecd', '3200', '4', '', '12800', '3000'),
(335, 20, 'Shahed Bhuiyan', 7, 'Pendrve 4GB -> Transcend', '1000', '5', '', '5000', '800'),
(336, 21, 'Shahed Bhuiyan', 8, 'RAM -> Transecd', '3200', '12', '', '38400', '3000'),
(337, 21, 'Shahed Bhuiyan', 6, 'Processor - Core i3 -> Intel', '8500', '12', '', '102000', '8000'),
(338, 21, 'Shahed Bhuiyan', 5, 'HDD -> Segate', '5500', '10', '', '55000', '4500');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE IF NOT EXISTS `payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_no` varchar(255) NOT NULL,
  `payable_amount` varchar(10) NOT NULL,
  `due` varchar(10) NOT NULL,
  `paid_amount` varchar(10) NOT NULL,
  `payment_date` date NOT NULL,
  `payment_mode` varchar(10) NOT NULL,
  `cst_id` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=191 ;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `invoice_no`, `payable_amount`, `due`, `paid_amount`, `payment_date`, `payment_mode`, `cst_id`) VALUES
(170, 'INV-BP-0000', '10400', '10000', '400', '2014-02-08', 'Cash', '100053'),
(171, 'INV-BP-0001', '16300', '300', '16000', '2014-02-10', 'Cash', '100054'),
(172, 'INV-BP-0002', '801', '801', '0', '2014-02-15', '', '100055'),
(173, 'INV-BP-0003', '46', '32', '0', '2014-02-15', '', '100056'),
(174, 'INV-BP-0004', '800', '100', '700', '2014-02-16', 'Cash', '100055'),
(175, 'INV-BP-0005', '1600', '1600', '0', '2014-02-28', '', '100056'),
(176, 'INV-BP-0006', '1202', '1202', '0', '2014-02-28', '', '100057'),
(177, 'INV-BP-0007', '801', '801', '0', '2014-02-28', '', '100058'),
(178, 'INV-BP-0008', '11001.78', '0', '11001.78', '2014-02-28', 'Cash', '100059'),
(179, 'INV-BP-0009', '1349.34', '0.99999900', '1348.34', '2014-03-03', 'Cash', '100060'),
(180, 'INV-BP-0010', '8500', '8500', '', '2014-12-02', '', '100055'),
(181, 'INV-BP-0011', '20300', '20300', '', '2014-12-02', '', '100056'),
(182, 'INV-BP-0012', '20200', '20200', '', '2014-12-02', '', '100057'),
(183, 'INV-BP-0013', '39800', '39800', '', '2014-12-03', '', '100058'),
(184, 'INV-BP-0014', '41700', '41700', '', '2014-12-03', '', '100054'),
(185, 'INV-BP-0015', '28500', '28500', '', '2014-12-03', '', '100054'),
(186, 'INV-BP-0016', '7300', '7300', '', '2014-12-03', '', '100059'),
(187, 'INV-BP-0017', '13200', '1200', '12000', '2014-12-03', 'Cash', '100054'),
(188, 'INV-BP-0018', '21800', '21800', '', '2015-01-25', '', '100054'),
(189, 'INV-BP-0019', '17800', '17800', '', '2015-09-14', '', '100055'),
(190, 'INV-BP-0020', '195400', '95400', '100000', '2016-12-22', 'Cash', '100056');

-- --------------------------------------------------------

--
-- Table structure for table `payment_log`
--

CREATE TABLE IF NOT EXISTS `payment_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_no` varchar(30) NOT NULL,
  `payment` varchar(10) NOT NULL,
  `due` varchar(10) NOT NULL,
  `date` date NOT NULL,
  `cst_id` varchar(10) NOT NULL,
  `payment_mode` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=53 ;

--
-- Dumping data for table `payment_log`
--

INSERT INTO `payment_log` (`id`, `invoice_no`, `payment`, `due`, `date`, `cst_id`, `payment_mode`) VALUES
(44, 'INV-BP-0000', '400', '10000', '2014-02-08', '100053', 'Cash'),
(45, 'INV-BP-0001', '16000', '300', '2014-02-10', '100054', 'Cash'),
(46, 'INV-BP-0004', '700', '100', '2014-02-16', '100055', 'Cash'),
(47, 'INV-BP-0008', '10000', '1001.78000', '2014-02-28', '100059', 'Cash'),
(48, 'INV-BP-0008', '1001.78000', '0', '2014-02-28', '100059', 'Cash'),
(49, 'INV-BP-0009', '1000.34', '348.999999', '2014-03-03', '100060', 'Cash'),
(50, 'INV-BP-0009', '348', '0.99999900', '2014-03-03', '100060\r\n', 'Cash'),
(51, 'INV-BP-0017', '12000', '1200', '2014-12-23', '100054', 'Cash'),
(52, 'INV-BP-0020', '100000', '95400', '2016-12-22', '100056', 'Cash');

-- --------------------------------------------------------

--
-- Table structure for table `stock_info`
--

CREATE TABLE IF NOT EXISTS `stock_info` (
  `id` int(11) NOT NULL,
  `product` varchar(50) NOT NULL,
  `brand` varchar(30) NOT NULL,
  `cata` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `purchase` decimal(20,0) NOT NULL,
  `sales` decimal(20,0) NOT NULL,
  `quantity` decimal(10,0) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock_info`
--

INSERT INTO `stock_info` (`id`, `product`, `brand`, `cata`, `description`, `purchase`, `sales`, `quantity`) VALUES
(1, 'Mouse', 'A4Tech', 't1', 'laskdjf skaldjf alskdjf', 350, 400, 3),
(2, 'CCTV', 'Nikon', 'NTR', 'skladl  l  l l', 4500, 5000, 3),
(3, 'Lumia 520', 'Nokai', 'T1', 'lsakdjf laskdjf lkasdjf lk lsakdjf', 14999, 15500, 4),
(4, 'Keyboard', 'Asus', 'AST', 'aslkdjf lskadjf', 450, 500, 2),
(5, 'HDD', 'Segate', 'H1', 'op3;sadkjfd', 4500, 5500, 0),
(6, 'Processor - Core i3', 'Intel', 'L3 Cach', 'lk4s.,fa,dnf,', 8000, 8500, 2),
(7, 'Pendrve 4GB', 'Transcend', '4GB', 'lkjsadf', 800, 1000, 3),
(8, 'RAM', 'Transecd', '3GB', '', 3000, 3200, 3),
(9, 'Laptop', 'Acer', 'A5', 'laskdf', 30000, 32000, 3);

-- --------------------------------------------------------

--
-- Table structure for table `stock_qty_log`
--

CREATE TABLE IF NOT EXISTS `stock_qty_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(10) NOT NULL,
  `up_date` date NOT NULL,
  `prev_qty` int(10) NOT NULL,
  `pres_qty` int(10) NOT NULL,
  `added_qty` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=50 ;

--
-- Dumping data for table `stock_qty_log`
--

INSERT INTO `stock_qty_log` (`id`, `pid`, `up_date`, `prev_qty`, `pres_qty`, `added_qty`) VALUES
(38, 1, '2014-02-08', 0, 5, 5),
(39, 2, '2014-02-08', 0, 2, 2),
(40, 3, '2014-02-10', 0, 5, 5),
(41, 4, '2014-02-10', 0, 10, 10),
(42, 5, '2014-02-10', 0, 2, 2),
(43, 6, '2014-02-10', 0, 3, 3),
(44, 7, '2014-03-03', 0, 3, 3),
(45, 1, '2014-03-03', 0, 2, 2),
(46, 9, '2014-12-24', 0, 3, 3),
(47, 6, '2014-12-24', 0, 4, 4),
(48, 2, '2015-01-17', 0, 3, 3),
(49, 4, '2015-09-14', 0, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE IF NOT EXISTS `suppliers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sid` decimal(10,0) NOT NULL,
  `sname` varchar(50) NOT NULL,
  `semail` varchar(50) NOT NULL,
  `scontact` varchar(13) NOT NULL,
  `saddress` text NOT NULL,
  `contact1` varchar(13) NOT NULL,
  `name1` varchar(50) NOT NULL,
  `contact2` varchar(13) NOT NULL,
  `name2` varchar(50) NOT NULL,
  `contact3` varchar(13) NOT NULL,
  `name3` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `sid`, `sname`, `semail`, `scontact`, `saddress`, `contact1`, `name1`, `contact2`, `name2`, `contact3`, `name3`) VALUES
(1, 1, 'Software Solution Inc.', 'info@ssibd.com', '01821152983', 'Green Road, Dhaka', '01821152983', 'Shahed Bhuiyan', '01812119944', 'Didar Ahamed', '', ''),
(2, 2, 'e-Soft', 'info@esoft.com.bd', '01717999990', 'Dhaka', '01836366377', 'Arshad Ali', '', '', '', ''),
(3, 3, 'Computer Source Ltd.', 'info@sourcebd.com', '01725553535', 'Dhaka, IDB Bhaban', '01735475997', 'Setu', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers_buying_ledger`
--

CREATE TABLE IF NOT EXISTS `suppliers_buying_ledger` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `product` varchar(50) NOT NULL,
  `purchase_date` date NOT NULL,
  `quantity` decimal(5,0) NOT NULL,
  `purchase_rate` decimal(5,0) NOT NULL,
  `suppliers_id` varchar(5) NOT NULL,
  `brand` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=50 ;

--
-- Dumping data for table `suppliers_buying_ledger`
--

INSERT INTO `suppliers_buying_ledger` (`id`, `pid`, `product`, `purchase_date`, `quantity`, `purchase_rate`, `suppliers_id`, `brand`) VALUES
(38, 1, 'Mouse', '2014-02-08', 5, 350, '1', 'A4Tech'),
(39, 2, 'CCTV', '2014-02-08', 2, 4500, '2', 'Nikon'),
(40, 3, 'Lumia 520', '2014-02-10', 5, 14999, '1', 'Nokai'),
(41, 4, 'Keyboard', '2014-02-10', 10, 450, '1', 'Asus'),
(42, 5, 'HDD', '2014-02-10', 2, 4500, '3', 'Segate'),
(43, 6, 'Processor - Core i3', '2014-02-10', 3, 8000, '3', 'Intel'),
(44, 7, 'laksdfj', '2014-03-03', 3, 800, '1', 'lkadjsf'),
(45, 1, 'Mouse', '2014-03-03', 2, 350, '2', 'A4Tech'),
(46, 9, 'Laptop', '2014-12-24', 3, 30000, '1', 'Asus'),
(47, 6, 'Processor - Core i3', '2014-12-24', 4, 8000, '2', 'Intel'),
(48, 2, 'CCTV', '2015-01-17', 3, 4500, '1', 'Nikon'),
(49, 4, 'Keyboard', '2015-09-14', 2, 450, '1', 'Asus');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers_payment`
--

CREATE TABLE IF NOT EXISTS `suppliers_payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `suppliers_id` varchar(255) NOT NULL,
  `payment_mode` varchar(5) NOT NULL,
  `total_payable` decimal(5,0) NOT NULL,
  `due` decimal(5,0) NOT NULL,
  `paid_amount` decimal(5,0) NOT NULL,
  `bank_id` int(11) NOT NULL,
  `check_no` varchar(50) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `suppliers_payment`
--

INSERT INTO `suppliers_payment` (`id`, `suppliers_id`, `payment_mode`, `total_payable`, `due`, `paid_amount`, `bank_id`, `check_no`, `date`) VALUES
(1, '2', 'Bank', 9000, 8000, 1000, 1, '', '2014-02-09'),
(2, '1', 'Bank', 1750, 0, 1750, 3, '', '2014-02-09'),
(3, '2', 'Bank', 8000, 0, 8000, 1, '', '2014-02-10'),
(4, '1', 'Cash', 74995, 64995, 10000, 0, '', '2014-02-10'),
(5, '3', 'Cash', 33000, 31000, 2000, 0, '', '2014-02-10'),
(6, '3', 'Bank', 31000, 30000, 1000, 3, '', '2014-02-10'),
(7, '3', 'Bank', 30000, 20000, 10000, 2, '', '2014-02-10'),
(8, '3', 'Cash', 20000, 10000, 10000, 0, '', '2014-02-11'),
(9, '3', 'Bank', 10000, 0, 10000, 3, '', '2014-02-11'),
(10, '1', 'Bank', 71895, 62895, 9000, 3, '', '2014-03-03'),
(11, '1', 'Bank', 62895, 50895, 12000, 2, '', '2014-03-05'),
(12, '1', 'Bank', 50895, 49895, 1000, 1, '', '2014-03-13');

-- --------------------------------------------------------

--
-- Table structure for table `transec`
--

CREATE TABLE IF NOT EXISTS `transec` (
  `id` int(11) NOT NULL,
  `acc_id` varchar(11) NOT NULL,
  `trns_date` date NOT NULL,
  `trnsection_taka` decimal(50,0) NOT NULL,
  `balance` decimal(50,0) NOT NULL,
  `paid_to` varchar(40) NOT NULL,
  `trns_type` varchar(10) NOT NULL,
  `prev_balance` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transec`
--

INSERT INTO `transec` (`id`, `acc_id`, `trns_date`, `trnsection_taka`, `balance`, `paid_to`, `trns_type`, `prev_balance`) VALUES
(1, '1', '2014-02-09', 1000, 10000, '2', 'DR', ''),
(2, '3', '2014-02-09', 1750, 97250, '1', 'DR', ''),
(3, '2', '2014-02-09', 2000, 13000, 'didar', 'DR', ''),
(4, '2', '2014-02-09', 12000, 25000, 'Tanvir', 'CR', ''),
(5, '2', '2014-02-10', 4500, 20500, '', 'DR', ''),
(6, '3', '2014-02-10', 2750, 100000, '', 'CR', ''),
(7, '3', '2014-02-10', 1000, 99000, '3', 'DR', ''),
(8, '1', '2014-02-10', 1000, 3000, '', 'CR', '2000'),
(9, '2', '2014-02-10', 10000, 10500, '3', 'DR', '20500'),
(10, '3', '2014-02-11', 10000, 89000, '3', 'DR', '99000'),
(11, '2', '2014-02-16', 5000, 5500, '', 'DR', '10500'),
(12, '1', '2014-03-03', 4000, 7000, '', 'CR', '3000'),
(13, '3', '2014-03-03', 9000, 80000, '1', 'DR', '89000'),
(14, '2', '2014-03-05', 9000, 14500, '', 'CR', '5500'),
(15, '2', '2014-03-05', 12000, 2500, '1', 'DR', '14500'),
(16, '1', '2014-03-13', 1000, 6000, '1', 'DR', '7000');

-- --------------------------------------------------------

--
-- Table structure for table `user_auth`
--

CREATE TABLE IF NOT EXISTS `user_auth` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `emp_id` varchar(10) NOT NULL,
  `auth_type` varchar(50) NOT NULL,
  `state` char(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `user_auth`
--

INSERT INTO `user_auth` (`id`, `user`, `pass`, `emp_id`, `auth_type`, `state`) VALUES
(5, 'admin', 'admin', '1', 'Admin', '1'),
(6, 'turaj ahmed', '01813195151', '3', 'User', '1'),
(8, 'tuhin', '01785859498', '4', 'User', '0'),
(9, 'osman', '01785859496', '5', 'User', '0');

-- --------------------------------------------------------

--
-- Table structure for table `voucher_list`
--

CREATE TABLE IF NOT EXISTS `voucher_list` (
  `id` int(11) NOT NULL,
  `invoice_no` varchar(50) NOT NULL,
  `g_total` decimal(10,0) NOT NULL,
  `date` date NOT NULL,
  `cust_id` int(50) NOT NULL,
  PRIMARY KEY (`id`,`invoice_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `voucher_list`
--

INSERT INTO `voucher_list` (`id`, `invoice_no`, `g_total`, `date`, `cust_id`) VALUES
(2, 'INV-BP-0001', 16300, '2014-02-10', 100054),
(3, 'INV-BP-0002', 801, '2014-02-15', 100055),
(4, 'INV-BP-0003', 32, '2014-02-15', 100056),
(5, 'INV-BP-0004', 800, '2014-02-16', 100055),
(6, 'INV-BP-0005', 1600, '2014-02-28', 100056),
(7, 'INV-BP-0006', 1202, '2014-02-28', 100057),
(8, 'INV-BP-0007', 801, '2014-02-28', 100058),
(9, 'INV-BP-0008', 11002, '2014-02-28', 100059),
(10, 'INV-BP-0009', 1349, '2014-03-03', 100060),
(11, 'INV-BP-0010', 8500, '2014-12-02', 100055),
(12, 'INV-BP-0011', 20300, '2014-12-02', 100056),
(13, 'INV-BP-0012', 20200, '2014-12-02', 100057),
(14, 'INV-BP-0013', 39800, '2014-12-03', 100058),
(15, 'INV-BP-0014', 41700, '2014-12-03', 100054),
(16, 'INV-BP-0015', 28500, '2014-12-03', 100054),
(17, 'INV-BP-0016', 7300, '2014-12-03', 100059),
(18, 'INV-BP-0017', 13200, '2014-12-03', 100054),
(19, 'INV-BP-0018', 21800, '2015-01-25', 100054),
(20, 'INV-BP-0019', 17800, '2015-09-14', 100055),
(21, 'INV-BP-0020', 195400, '2016-12-22', 100056);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
