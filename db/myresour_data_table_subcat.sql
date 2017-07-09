
-- --------------------------------------------------------

--
-- Table structure for table `subcat`
--

CREATE TABLE `subcat` (
  `subcat_ID` int(11) NOT NULL,
  `subcat_name` tinytext NOT NULL,
  `cat_ID` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subcat`
--

INSERT INTO `subcat` (`subcat_ID`, `subcat_name`, `cat_ID`) VALUES
(1, 'Lawyer', 3),
(2, 'Plumber', 3),
(3, 'Vehicles', 1),
(4, 'Clothes', 1),
(5, 'Computers', 1),
(6, 'Cell Phones', 1),
(7, 'Books', 1),
(8, 'Televisions', 1),
(9, 'Furniture', 1),
(10, 'Tools', 1),
(11, 'Temporary Office Space', 5),
(12, 'Event Help', 4),
(14, 'Prepared Food', 2),
(15, 'Fresh Produce', 2),
(16, 'Canned Goods', 2),
(17, 'Commercial Appliances', 1),
(18, 'Storage Space', 5),
(19, 'Appartments', 5),
(20, 'Rooms', 5),
(21, 'Electrician', 3),
(22, 'Carpenter', 3),
(23, 'Computer Tech', 3),
(24, '~Other', 1),
(25, '~Other', 2),
(26, '~Other', 4),
(27, '~Other', 3),
(28, '~Other', 5),
(29, 'Snacks', 2),
(30, 'Paint', 1),
(31, 'Catering', 3),
(32, 'Baked Goods', 2),
(33, 'Become A Volunteer', 4);
