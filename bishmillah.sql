/*
MySQL Data Transfer
Source Host: localhost
Source Database: bishmillah
Target Host: localhost
Target Database: bishmillah
Date: 2/12/2014 2:31:09 AM
*/


-- ----------------------------
-- Table structure for bank
-- ----------------------------
CREATE TABLE `bank` (
  `id` int(11) NOT NULL,
  `acname` varchar(100) NOT NULL,
  `acno` varchar(100) NOT NULL,
  `type` varchar(10) NOT NULL,
  `bname` varchar(100) NOT NULL,
  `balance` decimal(65,0) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for customer_info
-- ----------------------------
CREATE TABLE `customer_info` (
  `cust_id` int(50) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `cname` varchar(50) NOT NULL,
  `contact` varchar(11) NOT NULL,
  `addr` text NOT NULL,
  PRIMARY KEY (`cust_id`)
) ENGINE=InnoDB AUTO_INCREMENT=100055 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for daily_expense
-- ----------------------------
CREATE TABLE `daily_expense` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ename` varchar(50) NOT NULL,
  `etype` varchar(10) NOT NULL,
  `description` text NOT NULL,
  `dat` date NOT NULL,
  `eamount` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for daily_suppliers
-- ----------------------------
CREATE TABLE `daily_suppliers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sid` int(11) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for delivery_info
-- ----------------------------
CREATE TABLE `delivery_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hname` varchar(30) NOT NULL,
  `contact` varchar(11) NOT NULL,
  `pcode` varchar(10) NOT NULL,
  `addr` text NOT NULL,
  `invoice_no` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for employee_info
-- ----------------------------
CREATE TABLE `employee_info` (
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for ledger
-- ----------------------------
CREATE TABLE `ledger` (
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
) ENGINE=InnoDB AUTO_INCREMENT=299 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for payment
-- ----------------------------
CREATE TABLE `payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_no` varchar(255) NOT NULL,
  `payable_amount` decimal(10,0) NOT NULL,
  `due` decimal(10,0) NOT NULL,
  `paid_amount` decimal(10,0) NOT NULL,
  `payment_date` date NOT NULL,
  `payment_mode` varchar(10) NOT NULL,
  `cst_id` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=172 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for payment_log
-- ----------------------------
CREATE TABLE `payment_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_no` varchar(30) NOT NULL,
  `payment` varchar(10) NOT NULL,
  `due` varchar(10) NOT NULL,
  `date` date NOT NULL,
  `cst_id` varchar(10) NOT NULL,
  `payment_mode` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for stock_info
-- ----------------------------
CREATE TABLE `stock_info` (
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

-- ----------------------------
-- Table structure for stock_qty_log
-- ----------------------------
CREATE TABLE `stock_qty_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(10) NOT NULL,
  `up_date` date NOT NULL,
  `prev_qty` int(10) NOT NULL,
  `pres_qty` int(10) NOT NULL,
  `added_qty` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for suppliers
-- ----------------------------
CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sid` varchar(10) NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for suppliers_buying_ledger
-- ----------------------------
CREATE TABLE `suppliers_buying_ledger` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `product` varchar(50) NOT NULL,
  `purchase_date` date NOT NULL,
  `quantity` decimal(5,0) NOT NULL,
  `purchase_rate` decimal(5,0) NOT NULL,
  `suppliers_id` varchar(5) NOT NULL,
  `brand` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for suppliers_payment
-- ----------------------------
CREATE TABLE `suppliers_payment` (
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for transec
-- ----------------------------
CREATE TABLE `transec` (
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

-- ----------------------------
-- Table structure for user_auth
-- ----------------------------
CREATE TABLE `user_auth` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `emp_id` varchar(10) NOT NULL,
  `auth_type` varchar(50) NOT NULL,
  `state` char(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for voucher_list
-- ----------------------------
CREATE TABLE `voucher_list` (
  `id` int(11) NOT NULL,
  `invoice_no` varchar(50) NOT NULL,
  `g_total` decimal(10,0) NOT NULL,
  `date` date NOT NULL,
  `cust_id` int(50) NOT NULL,
  PRIMARY KEY (`id`,`invoice_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `bank` VALUES ('1', 'Software Solution Inc', '120120000001212', 'CA', 'IFIC Bank Ltd.', '3000');
INSERT INTO `bank` VALUES ('2', 'Didar Computer', '90909090905551', 'CA', 'BRAC Bank Ltd.', '10500');
INSERT INTO `bank` VALUES ('3', 'Bishmillah Paper', '120000001515', 'CA', 'Dutch Bangla Bank Ltd.', '89000');
INSERT INTO `customer_info` VALUES ('100054', 'Shahed Bhuiyan', 'SSI', '01821152983', 'Feni Sadar');
INSERT INTO `daily_expense` VALUES ('1', 'Tea Break', 'Nasta', 'lsakdjf', '2014-02-10', '100');
INSERT INTO `daily_suppliers` VALUES ('8', '1', '2014-02-08');
INSERT INTO `daily_suppliers` VALUES ('9', '2', '2014-02-08');
INSERT INTO `daily_suppliers` VALUES ('10', '1', '2014-02-10');
INSERT INTO `daily_suppliers` VALUES ('11', '3', '2014-02-10');
INSERT INTO `delivery_info` VALUES ('87', 'shahed ', '09080', '3900', 'dhaka', 'INV-BP-0000');
INSERT INTO `delivery_info` VALUES ('88', 'Didar Ahamed', '0239498', '3900', 'Dagonbhuiyan, Feni', 'INV-BP-0001');
INSERT INTO `employee_info` VALUES ('4', '1', 'Kiran', 'Ahmed', '0000-00-00', 'O+', 'M', 'Noakhali', 'turajsamir@gmail.com', '01813195151', '1.jpg', '', '12');
INSERT INTO `employee_info` VALUES ('5', '2', 'Shahed', 'Bhuiyan', '1991-01-01', 'B+', 'M', 'Feni Sadar', 'shahedbhuiyan@ssibd.com', '01821152983', '', '', '30000');
INSERT INTO `ledger` VALUES ('297', '2', 'Kiran Ahmed', '3', 'Lumia 520 15500', '15500', '1', '', '15500', '14999');
INSERT INTO `ledger` VALUES ('298', '2', 'Kiran Ahmed', '1', 'Mouse 400', '400', '2', '', '800', '350');
INSERT INTO `payment` VALUES ('170', 'INV-BP-0000', '10400', '10000', '400', '2014-02-08', 'Cash', '100053');
INSERT INTO `payment` VALUES ('171', 'INV-BP-0001', '16300', '300', '16000', '2014-02-10', 'Cash', '100054');
INSERT INTO `payment_log` VALUES ('44', 'INV-BP-0000', '400', '10000', '2014-02-08', '100053', 'Cash');
INSERT INTO `payment_log` VALUES ('45', 'INV-BP-0001', '16000', '300', '2014-02-10', '100054', 'Cash');
INSERT INTO `stock_info` VALUES ('1', 'Mouse', 'A4Tech', 't1', 'laskdjf', '350', '400', '2');
INSERT INTO `stock_info` VALUES ('2', 'CCTV', 'Nikon', 'NTR', 'asdkf', '4500', '5000', '0');
INSERT INTO `stock_info` VALUES ('3', 'Lumia 520', 'Nokai', 'T1', 'alsdkfj', '14999', '15500', '4');
INSERT INTO `stock_info` VALUES ('4', 'Keyboard', 'Asus', 'AST', 'alskdjf', '450', '500', '10');
INSERT INTO `stock_info` VALUES ('5', 'HDD', 'Segate', 'H1', 'asldkfj', '4500', '5500', '2');
INSERT INTO `stock_info` VALUES ('6', 'Processor - Core i3', 'Intel', 'L3 Cach', 'alskdfj', '8000', '8500', '3');
INSERT INTO `stock_qty_log` VALUES ('38', '1', '2014-02-08', '0', '5', '5');
INSERT INTO `stock_qty_log` VALUES ('39', '2', '2014-02-08', '0', '2', '2');
INSERT INTO `stock_qty_log` VALUES ('40', '3', '2014-02-10', '0', '5', '5');
INSERT INTO `stock_qty_log` VALUES ('41', '4', '2014-02-10', '0', '10', '10');
INSERT INTO `stock_qty_log` VALUES ('42', '5', '2014-02-10', '0', '2', '2');
INSERT INTO `stock_qty_log` VALUES ('43', '6', '2014-02-10', '0', '3', '3');
INSERT INTO `suppliers` VALUES ('1', '1', 'Software Solution Inc.', 'info@ssibd.com', '01821152983', 'Green Road, Dhaka', '01821152983', 'Shahed Bhuiyan', '01812119944', 'Didar Ahamed', '', '');
INSERT INTO `suppliers` VALUES ('2', '2', 'e-Soft', 'info@esoft.com.bd', '01717999990', 'Dhaka', '01836366377', 'Arshad Ali', '', '', '', '');
INSERT INTO `suppliers` VALUES ('3', '3', 'Computer Source Ltd.', 'info@sourcebd.com', '01725553535', 'Dhaka, IDB Bhaban', '01735475997', 'Setu', '', '', '', '');
INSERT INTO `suppliers_buying_ledger` VALUES ('38', '1', 'Mouse', '2014-02-08', '5', '350', '1', 'A4Tech');
INSERT INTO `suppliers_buying_ledger` VALUES ('39', '2', 'CCTV', '2014-02-08', '2', '4500', '2', 'Nikon');
INSERT INTO `suppliers_buying_ledger` VALUES ('40', '3', 'Lumia 520', '2014-02-10', '5', '14999', '1', 'Nokai');
INSERT INTO `suppliers_buying_ledger` VALUES ('41', '4', 'Keyboard', '2014-02-10', '10', '450', '1', 'Asus');
INSERT INTO `suppliers_buying_ledger` VALUES ('42', '5', 'HDD', '2014-02-10', '2', '4500', '3', 'Segate');
INSERT INTO `suppliers_buying_ledger` VALUES ('43', '6', 'Processor - Core i3', '2014-02-10', '3', '8000', '3', 'Intel');
INSERT INTO `suppliers_payment` VALUES ('1', '2', 'Bank', '9000', '8000', '1000', '1', '', '2014-02-09');
INSERT INTO `suppliers_payment` VALUES ('2', '1', 'Bank', '1750', '0', '1750', '3', '', '2014-02-09');
INSERT INTO `suppliers_payment` VALUES ('3', '2', 'Bank', '8000', '0', '8000', '1', '', '2014-02-10');
INSERT INTO `suppliers_payment` VALUES ('4', '1', 'Cash', '74995', '64995', '10000', '0', '', '2014-02-10');
INSERT INTO `suppliers_payment` VALUES ('5', '3', 'Cash', '33000', '31000', '2000', '0', '', '2014-02-10');
INSERT INTO `suppliers_payment` VALUES ('6', '3', 'Bank', '31000', '30000', '1000', '3', '', '2014-02-10');
INSERT INTO `suppliers_payment` VALUES ('7', '3', 'Bank', '30000', '20000', '10000', '2', '', '2014-02-10');
INSERT INTO `suppliers_payment` VALUES ('8', '3', 'Cash', '20000', '10000', '10000', '0', '', '2014-02-11');
INSERT INTO `suppliers_payment` VALUES ('9', '3', 'Bank', '10000', '0', '10000', '3', '', '2014-02-11');
INSERT INTO `transec` VALUES ('1', '1', '2014-02-09', '1000', '10000', '2', 'DR', '');
INSERT INTO `transec` VALUES ('2', '3', '2014-02-09', '1750', '97250', '1', 'DR', '');
INSERT INTO `transec` VALUES ('3', '2', '2014-02-09', '2000', '13000', 'didar', 'DR', '');
INSERT INTO `transec` VALUES ('4', '2', '2014-02-09', '12000', '25000', 'Tanvir', 'CR', '');
INSERT INTO `transec` VALUES ('5', '2', '2014-02-10', '4500', '20500', '', 'DR', '');
INSERT INTO `transec` VALUES ('6', '3', '2014-02-10', '2750', '100000', '', 'CR', '');
INSERT INTO `transec` VALUES ('7', '3', '2014-02-10', '1000', '99000', '3', 'DR', '');
INSERT INTO `transec` VALUES ('8', '1', '2014-02-10', '1000', '3000', '', 'CR', '2000');
INSERT INTO `transec` VALUES ('9', '2', '2014-02-10', '10000', '10500', '3', 'DR', '20500');
INSERT INTO `transec` VALUES ('10', '3', '2014-02-11', '10000', '89000', '3', 'DR', '99000');
INSERT INTO `user_auth` VALUES ('5', 'admin', 'admin', '1', 'Admin', '1');
INSERT INTO `user_auth` VALUES ('6', 'turaj ahmed', '01813195151', '3', 'User', '0');
INSERT INTO `user_auth` VALUES ('8', 'tuhin', '01785859498', '4', 'User', '0');
INSERT INTO `user_auth` VALUES ('9', 'osman', '01785859496', '5', 'User', '0');
INSERT INTO `voucher_list` VALUES ('2', 'INV-BP-0001', '16300', '2014-02-10', '100054');
