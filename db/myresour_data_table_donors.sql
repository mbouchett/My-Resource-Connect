
-- --------------------------------------------------------

--
-- Table structure for table `donors`
--

CREATE TABLE `donors` (
  `donor_ID` int(11) NOT NULL,
  `donor_name` tinytext NOT NULL,
  `donor_email` tinytext NOT NULL,
  `donor_telephone` tinytext NOT NULL,
  `donor_verified` tinyint(1) NOT NULL DEFAULT '0',
  `donor_pw` tinytext NOT NULL,
  `donor_code` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `donors`
--

INSERT INTO `donors` (`donor_ID`, `donor_name`, `donor_email`, `donor_telephone`, `donor_verified`, `donor_pw`, `donor_code`) VALUES
(2, 'Mark Bouchett', 'mark@markbouchett.com', '802-373-1035', 0, '$2a$07$theclockswerestrikinge7a7O9W6eO/FEVxzhGOS1nrq2fgKdhGq', 543543);
