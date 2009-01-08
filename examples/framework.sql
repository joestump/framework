-- MySQL dump 10.9
--
-- Host: localhost    Database: framework
-- ------------------------------------------------------
-- Server version	4.1.13-standard

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `framework_users`
--

DROP TABLE IF EXISTS `framework_users`;
CREATE TABLE `framework_users` (
  `userID` int(11) unsigned NOT NULL auto_increment,
  `email` char(45) NOT NULL default '',
  `password` char(15) NOT NULL default '',
  `fname` char(30) NOT NULL default '',
  `lname` char(30) NOT NULL default '',
  `posted` datetime NOT NULL default '0000-00-00 00:00:00',
  `status` enum('active','disabled') default 'active',
  PRIMARY KEY  (`userID`),
  UNIQUE KEY `email` (`email`),
  KEY `posted` (`posted`),
  KEY `status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `framework_users`
--


/*!40000 ALTER TABLE `framework_users` DISABLE KEYS */;
LOCK TABLES `framework_users` WRITE;
INSERT INTO `framework_users` VALUES (1,'anon@example.com','','Anonymous','Coward','2005-08-20 17:07:40','disabled');
UNLOCK TABLES;
/*!40000 ALTER TABLE `framework_users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

