-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: atrocity
-- ------------------------------------------------------
-- Server version	5.6.36

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `case_status_master`
--

DROP TABLE IF EXISTS `case_status_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `case_status_master` (
  `case_status_id` int(11) NOT NULL AUTO_INCREMENT,
  `case_status_name` varchar(45) NOT NULL,
  `case_status_shortname` varchar(5) NOT NULL,
  `case_status_display` varchar(1) DEFAULT 'Y',
  `createdby` varchar(45) DEFAULT NULL,
  `createdat` timestamp(2) NULL DEFAULT NULL,
  `createdip` varchar(45) DEFAULT NULL,
  `updatedby` varchar(45) DEFAULT NULL,
  `updatedat` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updatedip` varchar(45) DEFAULT NULL,
  `deletedby` varchar(45) DEFAULT NULL,
  `deletedat` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deletedip` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`case_status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COMMENT='This table contains case status master information';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `case_status_master`
--

LOCK TABLES `case_status_master` WRITE;
/*!40000 ALTER TABLE `case_status_master` DISABLE KEYS */;
INSERT INTO `case_status_master` VALUES (1,'Filed','F','Y','ADMIN',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2,'Solved','S','Y','ADMIN',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(3,'Police Verification Pending','PV','Y','ADMIN',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(4,'Police Verification Completed','PVC','Y','ADMIN',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `case_status_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `casehistory`
--

DROP TABLE IF EXISTS `casehistory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `casehistory` (
  `casehistoryid` int(10) unsigned NOT NULL,
  `caseid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `casehistorydesc` varchar(255) NOT NULL,
  `caseshow` varchar(1) NOT NULL DEFAULT 'Y',
  `createdby` varchar(45) DEFAULT NULL,
  `createdat` timestamp(2) NULL DEFAULT NULL,
  `createdip` varchar(45) DEFAULT NULL,
  `updatedby` varchar(45) DEFAULT NULL,
  `updatedat` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updatedip` varchar(45) DEFAULT NULL,
  `deletedby` varchar(45) DEFAULT NULL,
  `deletedat` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deletedip` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`casehistoryid`),
  KEY `case_ref_idx` (`caseid`),
  KEY `user_ref_idx` (`userid`),
  CONSTRAINT `case_ref` FOREIGN KEY (`caseid`) REFERENCES `cases` (`caseid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `user_ref` FOREIGN KEY (`userid`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='list contains all case history';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `casehistory`
--

LOCK TABLES `casehistory` WRITE;
/*!40000 ALTER TABLE `casehistory` DISABLE KEYS */;
/*!40000 ALTER TABLE `casehistory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cases`
--

DROP TABLE IF EXISTS `cases`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cases` (
  `caseid` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) DEFAULT NULL,
  `offid` int(11) NOT NULL,
  `policeassignedto` int(11) DEFAULT NULL,
  `organizationassignedto` int(11) DEFAULT NULL,
  `victimname` varchar(105) NOT NULL,
  `victimaddress` varchar(255) NOT NULL,
  `vicitmdob` varchar(45) NOT NULL,
  `victimgender` int(11) NOT NULL,
  `victimmobile` varchar(45) NOT NULL,
  `victimemail` varchar(45) NOT NULL,
  `victimaadhar` varchar(45) NOT NULL,
  `offendername` varchar(45) NOT NULL,
  `offenderaddress` varchar(45) NOT NULL,
  `offendergender` int(11) DEFAULT NULL,
  `offendermobile` int(11) DEFAULT NULL,
  `offendermail` varchar(45) DEFAULT NULL,
  `casedescription` varchar(255) NOT NULL,
  `caseimage` varchar(45) DEFAULT NULL,
  `casestatus` int(11) NOT NULL,
  `caseshow` varchar(1) NOT NULL DEFAULT 'Y',
  `otp` varchar(45) NOT NULL,
  `createdby` varchar(45) DEFAULT NULL,
  `createdat` timestamp(2) NULL DEFAULT NULL,
  `createdip` varchar(45) DEFAULT NULL,
  `updatedby` varchar(45) DEFAULT NULL,
  `updatedat` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updatedip` varchar(45) DEFAULT NULL,
  `deletedby` varchar(45) DEFAULT NULL,
  `deletedat` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deletedip` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`caseid`),
  KEY `off_ref_idx` (`offid`),
  KEY `user_ref_idx` (`userid`,`victimgender`),
  KEY `gender_ref_idx` (`victimgender`),
  KEY `cases_status_ref_idx` (`casestatus`),
  KEY `ploice_assigned_rf_idx` (`policeassignedto`),
  KEY `organization_assigned_rf_idx` (`organizationassignedto`),
  KEY `offender_gender_ref_idx` (`offendergender`),
  CONSTRAINT `case_user_ref` FOREIGN KEY (`userid`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `cases_status_ref` FOREIGN KEY (`casestatus`) REFERENCES `case_status_master` (`case_status_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `gender_ref` FOREIGN KEY (`victimgender`) REFERENCES `gender` (`gender_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `off_ref` FOREIGN KEY (`offid`) REFERENCES `offences` (`offid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `offender_gender_ref` FOREIGN KEY (`offendergender`) REFERENCES `gender` (`gender_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `organization_assigned_rf` FOREIGN KEY (`organizationassignedto`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ploice_assigned_rf` FOREIGN KEY (`policeassignedto`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Which contains all case details';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cases`
--

LOCK TABLES `cases` WRITE;
/*!40000 ALTER TABLE `cases` DISABLE KEYS */;
/*!40000 ALTER TABLE `cases` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gender`
--

DROP TABLE IF EXISTS `gender`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gender` (
  `gender_id` int(11) NOT NULL AUTO_INCREMENT,
  `gender_name` varchar(45) NOT NULL,
  `gender_shortname` varchar(5) NOT NULL,
  `gender_display` varchar(1) DEFAULT 'Y',
  `createdby` varchar(45) DEFAULT NULL,
  `createdat` timestamp(2) NULL DEFAULT NULL,
  `createdip` varchar(45) DEFAULT NULL,
  `updatedby` varchar(45) DEFAULT NULL,
  `updatedat` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updatedip` varchar(45) DEFAULT NULL,
  `deletedby` varchar(45) DEFAULT NULL,
  `deletedat` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deletedip` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`gender_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COMMENT='Master Table for Gender Details';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gender`
--

LOCK TABLES `gender` WRITE;
/*!40000 ALTER TABLE `gender` DISABLE KEYS */;
INSERT INTO `gender` VALUES (1,'Male','M','Y',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2,'Female','F','Y',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(3,'Others','O','Y',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `gender` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logs`
--

DROP TABLE IF EXISTS `logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(5) DEFAULT NULL,
  `usermachineinfo` varchar(255) DEFAULT NULL,
  `errno` int(2) NOT NULL,
  `errtype` varchar(32) NOT NULL,
  `errstr` text NOT NULL,
  `errfile` varchar(255) NOT NULL,
  `errline` int(4) NOT NULL,
  `user_agent` varchar(120) NOT NULL,
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=357 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logs`
--

LOCK TABLES `logs` WRITE;
/*!40000 ALTER TABLE `logs` DISABLE KEYS */;
INSERT INTO `logs` VALUES (335,NULL,NULL,8,'Error','Undefined index: search','G:\\ATMM\\application\\models\\Adminmodel.php',226,'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36','::1','2018-03-06 22:03:53'),(336,NULL,NULL,8,'Warning','Undefined index: search','G:\\ATMM\\application\\models\\Adminmodel.php',226,'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36','::1','2018-03-06 22:03:54'),(337,NULL,NULL,8,'Notice','Undefined index: search','G:\\ATMM\\application\\models\\Adminmodel.php',226,'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36','::1','2018-03-06 22:03:54'),(338,NULL,NULL,8,'Notice','Undefined index: length','G:\\ATMM\\application\\models\\Adminmodel.php',254,'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36','::1','2018-03-06 22:03:54'),(339,NULL,NULL,8,'Notice','Undefined index: length','G:\\ATMM\\application\\models\\Adminmodel.php',255,'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36','::1','2018-03-06 22:03:54'),(340,NULL,NULL,8,'Notice','Undefined index: start','G:\\ATMM\\application\\models\\Adminmodel.php',255,'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36','::1','2018-03-06 22:03:54'),(341,NULL,NULL,8,'Notice','Undefined index: start','G:\\ATMM\\application\\controllers\\Logs.php',47,'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36','::1','2018-03-06 22:03:54'),(342,NULL,NULL,8,'Notice','Undefined index: draw','G:\\ATMM\\application\\controllers\\Logs.php',63,'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36','::1','2018-03-06 22:03:54'),(343,NULL,NULL,8,'Notice','Undefined index: search','G:\\ATMM\\application\\models\\Adminmodel.php',226,'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36','::1','2018-03-06 22:03:54'),(344,NULL,NULL,8,'Notice','Undefined index: search','G:\\ATMM\\application\\models\\Adminmodel.php',226,'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36','::1','2018-03-06 22:03:54'),(345,NULL,NULL,8,'Notice','Undefined index: search','G:\\ATMM\\application\\models\\Adminmodel.php',226,'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36','::1','2018-03-06 22:03:54'),(346,NULL,NULL,8,'Notice','Undefined index: search','G:\\ATMM\\application\\models\\Adminmodel.php',226,'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36','::1','2018-03-06 22:06:39'),(347,NULL,NULL,8,'Notice','Undefined index: search','G:\\ATMM\\application\\models\\Adminmodel.php',226,'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36','::1','2018-03-06 22:06:39'),(348,NULL,NULL,8,'Notice','Undefined index: search','G:\\ATMM\\application\\models\\Adminmodel.php',226,'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36','::1','2018-03-06 22:06:39'),(349,NULL,NULL,8,'Notice','Undefined index: length','G:\\ATMM\\application\\models\\Adminmodel.php',254,'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36','::1','2018-03-06 22:06:39'),(350,NULL,NULL,8,'Notice','Undefined index: length','G:\\ATMM\\application\\models\\Adminmodel.php',255,'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36','::1','2018-03-06 22:06:40'),(351,NULL,NULL,8,'Notice','Undefined index: start','G:\\ATMM\\application\\models\\Adminmodel.php',255,'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36','::1','2018-03-06 22:06:40'),(352,NULL,NULL,8,'Notice','Undefined index: start','G:\\ATMM\\application\\controllers\\Logs.php',47,'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36','::1','2018-03-06 22:06:40'),(353,NULL,NULL,8,'Notice','Undefined index: draw','G:\\ATMM\\application\\controllers\\Logs.php',63,'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36','::1','2018-03-06 22:06:40'),(354,NULL,NULL,8,'Notice','Undefined index: search','G:\\ATMM\\application\\models\\Adminmodel.php',226,'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36','::1','2018-03-06 22:06:40'),(355,NULL,NULL,8,'Notice','Undefined index: search','G:\\ATMM\\application\\models\\Adminmodel.php',226,'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36','::1','2018-03-06 22:06:40'),(356,NULL,NULL,8,'Notice','Undefined index: search','G:\\ATMM\\application\\models\\Adminmodel.php',226,'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36','::1','2018-03-06 22:06:40');
/*!40000 ALTER TABLE `logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notifications` (
  `noty_id` int(11) NOT NULL AUTO_INCREMENT,
  `noty_title` varchar(95) NOT NULL,
  `notf_message` varchar(255) NOT NULL,
  `noty_status` varchar(1) NOT NULL DEFAULT 'N',
  `noty_show` varchar(1) NOT NULL DEFAULT 'Y',
  `createdby` varchar(45) DEFAULT NULL,
  `createdat` timestamp NULL DEFAULT NULL,
  `createdip` varchar(45) DEFAULT NULL,
  `updatedby` varchar(45) DEFAULT NULL,
  `updatedat` timestamp NULL DEFAULT NULL,
  `updatedip` varchar(45) DEFAULT NULL,
  `deletedby` varchar(45) DEFAULT NULL,
  `deletedat` timestamp NULL DEFAULT NULL,
  `deletedip` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`noty_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='This table stores all notifications';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `offences_master`
--

DROP TABLE IF EXISTS `offences_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `offences_master` (
  `offid` int(11) NOT NULL AUTO_INCREMENT,
  `offname` varchar(255) NOT NULL,
  `offdescription` varchar(255) NOT NULL,
  `offshow` varchar(1) NOT NULL,
  `createdby` varchar(45) DEFAULT 'Y',
  `createdat` timestamp(2) NULL DEFAULT NULL,
  `createdip` varchar(45) DEFAULT NULL,
  `updatedby` varchar(45) DEFAULT NULL,
  `updatedat` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updatedip` varchar(45) DEFAULT NULL,
  `deletedby` varchar(45) DEFAULT NULL,
  `deletedat` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deletedip` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`offid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Contains all offenses';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `offences_master`
--

LOCK TABLES `offences_master` WRITE;
/*!40000 ALTER TABLE `offences_master` DISABLE KEYS */;
/*!40000 ALTER TABLE `offences_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `privatemessages`
--

DROP TABLE IF EXISTS `privatemessages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `privatemessages` (
  `msgid` int(11) NOT NULL AUTO_INCREMENT,
  `msgfrom` int(11) NOT NULL,
  `msgto` int(11) NOT NULL,
  `msgdetails` varchar(255) DEFAULT NULL,
  `isread` varchar(1) NOT NULL DEFAULT 'N',
  `msgshow` varchar(1) DEFAULT 'Y',
  `createdby` varchar(45) DEFAULT NULL,
  `createdat` timestamp(2) NULL DEFAULT NULL,
  `createdip` varchar(45) DEFAULT NULL,
  `updatedby` varchar(45) DEFAULT NULL,
  `updatedat` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updatedip` varchar(45) DEFAULT NULL,
  `deletedby` varchar(45) DEFAULT NULL,
  `deletedat` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deletedip` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`msgid`),
  KEY `message_from_user_idx` (`msgfrom`),
  KEY `message_to_user_idx` (`msgto`),
  CONSTRAINT `message_from_user` FOREIGN KEY (`msgfrom`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `message_to_user` FOREIGN KEY (`msgto`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Contains all private messages in the forum';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `privatemessages`
--

LOCK TABLES `privatemessages` WRITE;
/*!40000 ALTER TABLE `privatemessages` DISABLE KEYS */;
/*!40000 ALTER TABLE `privatemessages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `roleid` int(11) NOT NULL AUTO_INCREMENT,
  `rolename` varchar(45) NOT NULL,
  `roleslug` varchar(45) NOT NULL,
  `roledescription` varchar(45) NOT NULL,
  `roleshow` varchar(45) NOT NULL,
  `createdby` varchar(45) DEFAULT NULL,
  `createdat` timestamp(2) NULL DEFAULT NULL,
  `createdip` varchar(15) DEFAULT NULL,
  `updatedby` varchar(45) DEFAULT NULL,
  `updatedat` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updatedip` varchar(45) DEFAULT NULL,
  `deletedby` varchar(45) DEFAULT NULL,
  `deletedat` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deletedip` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`roleid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'User','user','User Details','','ADMIN',NULL,NULL,NULL,'2018-03-04 12:36:37',NULL,NULL,'2018-03-04 12:36:37',NULL),(2,'Police','police','Police Role','','ADMIN',NULL,NULL,NULL,'2018-03-04 12:36:37',NULL,NULL,'2018-03-04 12:36:37',NULL),(3,'Organization','orgaanization','NGO','','ADMIN',NULL,NULL,NULL,'2018-03-04 12:36:37',NULL,NULL,'2018-03-04 12:36:37',NULL),(4,'Guest','guest','Guest','','ADMIN',NULL,NULL,NULL,'2018-03-04 12:36:37',NULL,NULL,'2018-03-04 12:36:37',NULL);
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `role` int(5) NOT NULL,
  `name` varchar(75) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `address1` varchar(75) NOT NULL,
  `address2` varchar(75) NOT NULL,
  `city` varchar(45) NOT NULL,
  `state` varchar(45) NOT NULL,
  `country` varchar(45) NOT NULL,
  `mobilenumber` varchar(45) NOT NULL,
  `email` varchar(45) DEFAULT NULL,
  `aadhar` varchar(45) DEFAULT NULL,
  `lastlogin` varchar(45) DEFAULT NULL,
  `isactive` varchar(1) DEFAULT 'Y',
  `verifiedaccount` varchar(5) DEFAULT 'N',
  `createdby` varchar(45) DEFAULT NULL,
  `createdat` timestamp(2) NULL DEFAULT NULL,
  `createdip` varchar(45) DEFAULT NULL,
  `updatedby` varchar(45) DEFAULT NULL,
  `updatedat` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updatedip` varchar(45) DEFAULT NULL,
  `deletedby` varchar(45) DEFAULT NULL,
  `deletedat` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deletedip` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  KEY `role_ref_idx` (`role`),
  CONSTRAINT `role_ref` FOREIGN KEY (`role`) REFERENCES `roles` (`roleid`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Contains List of Users';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-03-10 20:27:57
