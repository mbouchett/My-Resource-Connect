
-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_ID` int(11) NOT NULL,
  `admin_name` tinytext NOT NULL,
  `admin_pw` text NOT NULL,
  `admin_level` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_ID`, `admin_name`, `admin_pw`, `admin_level`) VALUES
(1, 'mbouchett', '$2a$07$theclockswerestrikingeTBgGxwkCtREfiks/u8XOKQajcrOeVQO', 5);
