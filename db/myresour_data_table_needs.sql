
-- --------------------------------------------------------

--
-- Table structure for table `needs`
--

CREATE TABLE `needs` (
  `need_ID` tinyint(11) NOT NULL,
  `org_ID` tinyint(11) NOT NULL,
  `need_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `need_title` tinytext NOT NULL,
  `need_description` text NOT NULL,
  `need_by` tinytext,
  `pledge_by` int(11) DEFAULT NULL,
  `pledge_date` timestamp NULL DEFAULT NULL,
  `subcat_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `needs`
--

INSERT INTO `needs` (`need_ID`, `org_ID`, `need_date`, `need_title`, `need_description`, `need_by`, `pledge_by`, `pledge_date`, `subcat_ID`) VALUES
(7, 6, '2017-06-26 03:05:16', 'Lawyer needed to vet a lease', 'We are looking for a lawyer to look over a lease we are about to sign. It is for an office space everything seem okay with it but we would feel better about If a professional could take a look at it for us.', '07/14/2017', NULL, NULL, 1),
(8, 2, '2017-07-04 04:06:31', 'Tools Of Any Kind', 'We are trying to fill three large tool boxes with any and all tools. we are especially looking for Hammers, slot & Phillips screwdrivers, measuring tape, pliers, vice-grips, wrenches, and any others that would be found in a typical household tool box.', '07/04/2017', NULL, NULL, 10),
(9, 2, '2017-07-06 02:25:47', 'Electrical Inspection', 'we are looking for an electrician who is willing to donate their time to inspect the wiring in a newly constructed house. ', '08/15/2017', NULL, NULL, 21),
(10, 2, '2017-07-06 02:29:45', 'Temporary Storage', 'Green Mountain habitat for Humanity is looking for a place to store a large amount of construction materials for a short period of time Aug 1 2017 through September 10 2017. While we await permits to begin building.', '07/31/2017', NULL, NULL, 18),
(11, 1, '2017-07-06 02:49:43', 'Help us stock our shelves', 'right now we are making an an effort to replenish our food supplies if you have any canned fruits or vegetables that you can donate we would really appreciate it!', '12/01/2017', NULL, NULL, 16);
