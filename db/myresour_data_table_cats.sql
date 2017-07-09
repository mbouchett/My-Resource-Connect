
-- --------------------------------------------------------

--
-- Table structure for table `cats`
--

CREATE TABLE `cats` (
  `cat_ID` int(11) NOT NULL,
  `cat_name` tinytext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cats`
--

INSERT INTO `cats` (`cat_ID`, `cat_name`) VALUES
(1, 'Dry Goods'),
(2, 'Food'),
(3, 'Services'),
(4, 'Labor'),
(5, 'Space');
