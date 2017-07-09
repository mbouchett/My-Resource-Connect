
-- --------------------------------------------------------

--
-- Table structure for table `orgs`
--

CREATE TABLE `orgs` (
  `org_ID` int(10) NOT NULL,
  `org_name` tinytext NOT NULL,
  `org_email` tinytext NOT NULL,
  `org_pw` tinytext NOT NULL,
  `org_EIN` tinytext NOT NULL,
  `org_verified` tinyint(1) NOT NULL DEFAULT '0',
  `org_website` tinytext,
  `org_mission` text,
  `org_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `org_last_login` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orgs`
--

INSERT INTO `orgs` (`org_ID`, `org_name`, `org_email`, `org_pw`, `org_EIN`, `org_verified`, `org_website`, `org_mission`, `org_added`, `org_last_login`) VALUES
(1, 'Committee on Temporary Shelter', 'info@cotsonline.org', '$2a$07$theclockswerestrikingeV3X/7forBMArLEpX2q110SUQTT7IorW', '03-0285606', 1, 'http://cotsonline.org/', 'The Committee on Temporary Shelter (COTS) is the largest Picture205service provider for the homeless and those at risk of becoming homeless in Vermont.  COTS offers emergency shelter, prevention assistance, support services, and transitional and permanent housing for those who are homeless and marginally housed.  We believe: in the value and dignity of every human life; that housing is a fundamental human right; and that emergency shelter is not the solution to homelessness.', '2017-06-22 03:10:40', NULL),
(2, 'GREEN MOUNTAIN HABITAT FOR HUMANITY', 'info@vermonthabitat.org', '$2a$07$theclockswerestrikingeV3X/7forBMArLEpX2q110SUQTT7IorW', '22-2558923', 1, NULL, NULL, '2017-06-22 00:33:48', NULL),
(3, 'Wuqu\' Kawoq - Maya Health Alliance', 'info@wuqukawoq.org', '$2a$07$theclockswerestrikingeV3X/7forBMArLEpX2q110SUQTT7IorW', '20-8741625', 0, NULL, NULL, '2017-06-25 16:14:31', NULL),
(4, 'NorthWoods Stewardship Center', 'info@northwoodscenter.org', '$2a$07$theclockswerestrikingeV3X/7forBMArLEpX2q110SUQTT7IorW', '03-0263394', 0, NULL, NULL, '2017-06-26 02:33:47', NULL),
(6, 'Vermont Mozart Festival', 'info@vtmozart.org', '$2a$07$theclockswerestrikingeV3X/7forBMArLEpX2q110SUQTT7IorW', '03-0263394', 0, NULL, NULL, '2017-06-26 03:03:07', NULL);
