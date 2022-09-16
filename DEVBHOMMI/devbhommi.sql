SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- --------------------------------------------------------
-- Table structure for table `regist`

CREATE TABLE IF NOT EXISTS `police` (
  `u_id` int(200) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `policeid` varchar(15) NOT NULL,
  `mobile_no` int(15) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `joiningdate` date NOT NULL,
  `office` text NOT NULL,
  `document` varchar(255) NOT NULL,
  PRIMARY KEY (`u_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;
--
-- Table structure for table `regist`
--

CREATE TABLE IF NOT EXISTS `regist` (
  `u_id` int(200) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) NOT NULL,
  `mobile_no` int(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `aadharno` int(12) NOT NULL,
  `pass` varchar(50) NOT NULL,
  PRIMARY KEY (`u_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;
