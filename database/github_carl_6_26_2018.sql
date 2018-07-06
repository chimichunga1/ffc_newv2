/*
SQLyog Ultimate v10.00 Beta1
MySQL - 5.5.5-10.1.24-MariaDB : Database - fccl_system
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`fccl_system` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `fccl_system`;

/*Table structure for table `caf_info` */

DROP TABLE IF EXISTS `caf_info`;

CREATE TABLE `caf_info` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `client_no` bigint(20) NOT NULL,
  `app_no` bigint(20) NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `spouse` varchar(255) NOT NULL,
  `co_maker` varchar(255) NOT NULL,
  `pri_con` bigint(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `dealer_id` bigint(20) NOT NULL,
  `salesman_id` bigint(20) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `lcp` decimal(10,2) NOT NULL,
  `av` decimal(10,2) NOT NULL,
  `downpayment` decimal(10,2) NOT NULL,
  `amount_fin` decimal(10,2) NOT NULL,
  `term` bigint(20) NOT NULL,
  `int_rate` decimal(10,2) NOT NULL,
  `mon_first` decimal(10,2) NOT NULL,
  `mon_second` decimal(10,2) NOT NULL,
  `prepared_by` varchar(255) NOT NULL,
  `noted_by` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_deleted` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

/*Data for the table `caf_info` */

insert  into `caf_info`(`id`,`client_no`,`app_no`,`client_name`,`spouse`,`co_maker`,`pri_con`,`address`,`dealer_id`,`salesman_id`,`unit`,`lcp`,`av`,`downpayment`,`amount_fin`,`term`,`int_rate`,`mon_first`,`mon_second`,`prepared_by`,`noted_by`,`created_at`,`is_deleted`) values (18,11,201806002,'ATASKA M, YABSON','Ang','asdasd',3123123,'31231231',9,6,'asd','2500.34','21321.29','321321.43','321321.23',24,'78.34','321321.34','312312.28','CJAY D. CONOCONO','RAMON R. RAMOS','2018-06-07 17:01:13',0),(19,7,0,'CJAY T, CONOCONO','TEST','',123,'1231',0,0,'','0.00','0.00','0.00','0.00',0,'0.00','0.00','0.00','CJAY D. CONOCONO','RAMON R. RAMOS','2018-06-10 12:23:56',0),(20,9,201805004,'CARL DENNIS M, ALINGALAN','','Wala po',312442131312,'2462 McKinley Hills1',11,6,'Makati','20000.00','500000.00','250000.00','23000.00',23,'21.01','3423.32','23444.20','CJAY D. CONOCONO','RAMON R. RAMOS','2018-06-11 10:00:46',0),(21,1,201805003,'JAY E, TUMANDA','12345','',123,'1231',6,0,'','0.00','0.00','0.00','0.00',0,'21.00','0.00','0.00','CJAY D. CONOCONO','RAMON R. RAMOS','2018-06-22 13:45:25',0),(22,9,201805007,'CARL DENNIS M, ALINGALAN','','213',312442131312,'2462 McKinley Hills1',0,6,'21','2000.00','2000.00','50000.00','40000.00',23,'15.32','25000.00','240000.00','CJAY D. CONOCONO','RAMON R. RAMOS','2018-06-24 20:11:10',0);

/*Table structure for table `client_requirements_caf` */

DROP TABLE IF EXISTS `client_requirements_caf`;

CREATE TABLE `client_requirements_caf` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `requirement_name` varchar(255) NOT NULL,
  `requirement_code` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `client_no` bigint(20) NOT NULL,
  `app_no` bigint(20) NOT NULL,
  `is_deleted` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=latin1;

/*Data for the table `client_requirements_caf` */

insert  into `client_requirements_caf`(`id`,`requirement_name`,`requirement_code`,`status`,`client_no`,`app_no`,`is_deleted`) values (3,'2 Valid ID','2val','pending',6,15,0),(4,'Baranggay Clearance','BRCL','pending',6,15,0),(5,'Baranggay Clearance','BRCL','received',5,16,0),(6,'2x2 Picture ID','2x2','received',1,17,0),(7,'2 Valid ID','2val','pending',1,17,0),(8,'Baranggay Clearance','BRCL','received',1,17,0),(9,'2x2 Picture ID','2x2','pending',1,5,0),(10,'2 Valid ID','2val','pending',1,5,0),(11,'Baranggay Clearance','BRCL','pending',1,5,0),(12,'2x2 Picture ID','2x2','pending',213,4,0),(13,'2 Valid ID','2val','pending',213,4,0),(14,'Baranggay Clearance','BRCL','pending',213,4,0),(15,'2 Valid ID','2VAL','pending',6,19,0),(16,'Baranggay Clearance','BRCL','pending',6,19,0),(17,'2x2 Picture ID','2X2','pending',5,18,0),(18,'2 Valid ID','2VAL','pending',5,18,0),(19,'Baranggay Clearance','BRCL','pending',5,18,0),(20,'2x2 Picture ID','2X2','pending',1,20,0),(21,'2 Valid ID','2VAL','pending',1,20,0),(22,'Baranggay Clearance','BRCL','pending',1,20,0),(23,'2x2 Picture ID','2X2','pending',9,21,0),(24,'2 Valid ID','2VAL','pending',9,21,0),(25,'Baranggay Clearance','BRCL','pending',9,21,0),(26,'2x2 Picture ID','2X2','pending',9,22,0),(27,'2 Valid ID','2VAL','pending',9,22,0),(28,'Baranggay Clearance','BRCL','pending',9,22,0),(29,'2 Valid ID','2VAL','pending',9,25,0),(30,'Baranggay Clearance','BRCL','pending',9,25,0),(31,'2x2 Picture ID','2X2','pending',9,28,0),(32,'2 Valid ID','2VAL','pending',9,28,0),(33,'Baranggay Clearance','BRCL','pending',9,28,0),(34,'2x2 Picture ID','2X2','pending',1,29,0),(35,'2 Valid ID','2VAL','pending',1,29,0),(36,'Baranggay Clearance','BRCL','pending',1,29,0),(37,'2x2 Picture ID','2X2','pending',10,30,0),(38,'2 Valid ID','2VAL','pending',10,30,0),(39,'Baranggay Clearance','BRCL','pending',10,30,0),(40,'2x2 Picture ID','2X2','pending',9,31,0),(41,'2 Valid ID','2VAL','pending',9,31,0),(42,'Baranggay Clearance','BRCL','pending',9,31,0),(43,'2x2 Picture ID','2X2','pending',10,32,0),(44,'2 Valid ID','2VAL','pending',10,32,0),(45,'Baranggay Clearance','BRCL','pending',10,32,0),(46,'2x2 Picture ID','2X2','pending',10,33,0),(47,'2 Valid ID','2VAL','pending',10,33,0),(48,'Baranggay Clearance','BRCL','pending',10,33,0),(49,'2 Valid ID','2VAL','pending',1,8,0),(50,'Baranggay Clearance','BRCL','pending',1,8,0),(51,'2x2 Picture ID','2X2','pending',10,39,0),(52,'2 Valid ID','2VAL','pending',10,39,0),(53,'Baranggay Clearance','BRCL','pending',10,39,0),(54,'2x2 Picture ID','2X2','pending',1,0,0),(55,'2 Valid ID','2VAL','pending',1,0,0),(56,'Baranggay Clearance','BRCL','pending',1,0,0),(57,'2x2 Picture ID','2X2','pending',9,201805006,0),(58,'2 Valid ID','2VAL','pending',9,201805006,0),(59,'Baranggay Clearance','BRCL','pending',9,201805006,0),(60,'2x2 Picture ID','2X2','pending',9,201805008,0),(61,'2 Valid ID','2VAL','pending',9,201805008,0),(62,'Baranggay Clearance','BRCL','pending',9,201805008,0),(63,'2x2 Picture ID','2X2','pending',9,201805009,0),(64,'2 Valid ID','2VAL','pending',9,201805009,0),(65,'Baranggay Clearance','BRCL','pending',9,201805009,0),(66,'2 Valid ID','2VAL','pending',7,0,1),(67,'Baranggay Clearance','BRCL','pending',7,0,1),(68,'2 Valid ID','2VAL','pending',2,0,0),(69,'Baranggay Clearance','BRCL','pending',2,0,0),(70,'2 Valid ID','2VAL','pending',9,201805005,0),(71,'Baranggay Clearance','BRCL','pending',9,201805005,0),(72,'Baranggay Clearance','BRCL','pending',6,0,0),(73,'Baranggay Clearance','BRCL','pending',5,0,0),(74,'2 Valid ID','2VAL','to_follow',11,201806002,0),(75,'Baranggay Clearance','BRCL','to_follow',11,201806002,0),(77,'2x2 Picture ID','2X2','to_follow',11,201806002,0),(78,'Tax Income','BIR','to_follow',11,201806002,0),(79,'2x2 Picture ID','2X2','to_follow',9,201805004,0),(80,'Baranggay Clearance','BRCL','received',9,201805004,0),(81,'2x2 Picture ID','2X2','received',1,201805003,0),(82,'2 Valid ID','2VAL','to_follow',1,201805003,0),(83,'Baranggay Clearance','BRCL','pending',1,201805003,0),(84,'Tax Income','BIR','pending',1,201805003,0),(85,'2x2 Picture ID','2X2','pending',9,201805007,0),(86,'2 Valid ID','2VAL','pending',9,201805007,0),(87,'Baranggay Clearance','BRCL','pending',9,201805007,0),(88,'Tax Income','BIR','pending',9,201805007,0);

/*Table structure for table `instruction_sheet` */

DROP TABLE IF EXISTS `instruction_sheet`;

CREATE TABLE `instruction_sheet` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `ll_id` bigint(20) DEFAULT NULL,
  `app_no` bigint(20) DEFAULT NULL,
  `acc_no` bigint(20) DEFAULT NULL,
  `bor_name` varchar(255) DEFAULT NULL,
  `client_no` bigint(20) DEFAULT NULL,
  `spouse` varchar(255) DEFAULT NULL,
  `client_stat` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `pri_con` bigint(20) DEFAULT NULL,
  `unit_desc` varchar(255) DEFAULT NULL,
  `tie_up_account` varchar(255) DEFAULT NULL,
  `tu_lname` varchar(255) DEFAULT NULL,
  `tu_fname` varchar(255) DEFAULT NULL,
  `tu_unit_desc` varchar(255) DEFAULT NULL,
  `term` bigint(20) DEFAULT NULL,
  `list_cash_price` decimal(10,2) DEFAULT NULL,
  `addon_rate` decimal(10,2) DEFAULT NULL,
  `appraised_value` decimal(10,2) DEFAULT NULL,
  `mon_first_payment` decimal(10,2) DEFAULT NULL,
  `dp_gd_rv` decimal(10,2) DEFAULT NULL,
  `mon_second_payment` decimal(10,2) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `maturity_date` date DEFAULT NULL,
  `due_date` varchar(255) DEFAULT NULL,
  `value_date` date DEFAULT NULL,
  `amount_fin` decimal(10,2) DEFAULT NULL,
  `amount_pn` decimal(10,2) DEFAULT NULL,
  `rcf` decimal(10,2) DEFAULT NULL,
  `rebate_rcf` decimal(10,2) DEFAULT NULL,
  `TLV` decimal(10,2) DEFAULT NULL,
  `manner_payment` bigint(20) DEFAULT NULL,
  `less_udi_percent` decimal(10,2) DEFAULT NULL,
  `less_total` decimal(10,2) DEFAULT NULL,
  `udi_bal` decimal(10,2) DEFAULT NULL,
  `mort_fee` decimal(10,2) DEFAULT NULL,
  `mort_or` decimal(10,2) DEFAULT NULL,
  `mort_total` decimal(10,2) DEFAULT NULL,
  `proc_fee` decimal(10,2) DEFAULT NULL,
  `proc_or` decimal(10,2) DEFAULT NULL,
  `proc_total` decimal(10,2) DEFAULT NULL,
  `apprais_fee` decimal(10,2) DEFAULT NULL,
  `apprais_or` decimal(10,2) DEFAULT NULL,
  `apprais_total` decimal(10,2) DEFAULT NULL,
  `comm_fee` decimal(10,2) DEFAULT NULL,
  `comm_or` decimal(10,2) DEFAULT NULL,
  `comm_total` decimal(10,2) DEFAULT NULL,
  `front_fee` decimal(10,2) DEFAULT NULL,
  `front_or` decimal(10,2) DEFAULT NULL,
  `front_total` decimal(10,2) DEFAULT NULL,
  `sm_fee` decimal(10,2) DEFAULT NULL,
  `salesman_id` bigint(20) DEFAULT NULL,
  `sm_total` decimal(10,2) DEFAULT NULL,
  `dealer_fee` decimal(10,2) DEFAULT NULL,
  `dealer_id` bigint(20) DEFAULT NULL,
  `dealer_total` decimal(10,2) DEFAULT NULL,
  `real_estate_fee` decimal(10,2) DEFAULT NULL,
  `real_estate_or` decimal(10,2) DEFAULT NULL,
  `real_estate_total` decimal(10,2) DEFAULT NULL,
  `insur_prem_fee` decimal(10,2) DEFAULT NULL,
  `insur_prem_or` decimal(10,2) DEFAULT NULL,
  `insur_prem_total` decimal(10,2) DEFAULT NULL,
  `handling_fee` decimal(10,2) DEFAULT NULL,
  `handling_or` decimal(10,2) DEFAULT NULL,
  `handling_total` decimal(10,2) DEFAULT NULL,
  `dpb_fee` decimal(10,2) DEFAULT NULL,
  `dpb_or` decimal(10,2) DEFAULT NULL,
  `dpb_total` decimal(10,2) DEFAULT NULL,
  `doc_fee` decimal(10,2) DEFAULT NULL,
  `doc_or` decimal(10,2) DEFAULT NULL,
  `doc_total` decimal(10,2) DEFAULT NULL,
  `sbgfc_fee` decimal(10,2) DEFAULT NULL,
  `sbgfc_or` decimal(10,2) DEFAULT NULL,
  `sbgfc_total` decimal(10,2) DEFAULT NULL,
  `other_one_fee` decimal(10,2) DEFAULT NULL,
  `other_one_or` decimal(10,2) DEFAULT NULL,
  `other_one_total` decimal(10,2) DEFAULT NULL,
  `other_two_fee` decimal(10,2) DEFAULT NULL,
  `other_two_or` decimal(10,2) DEFAULT NULL,
  `other_two_total` decimal(10,2) DEFAULT NULL,
  `amount_deduct` decimal(10,2) DEFAULT NULL,
  `amount_due` decimal(10,2) DEFAULT NULL,
  `or_no` bigint(20) DEFAULT NULL,
  `or_date` date DEFAULT NULL,
  `or_amount` decimal(10,2) DEFAULT NULL,
  `payee1` varchar(255) DEFAULT NULL,
  `amount_payee1` decimal(10,2) DEFAULT NULL,
  `payee2` varchar(255) DEFAULT NULL,
  `amount_payee2` decimal(10,2) DEFAULT NULL,
  `payee3` varchar(255) DEFAULT NULL,
  `amount_payee3` decimal(10,2) DEFAULT NULL,
  `payee4` varchar(255) DEFAULT NULL,
  `amount_payee4` decimal(10,2) DEFAULT NULL,
  `payee5` varchar(255) DEFAULT NULL,
  `amount_payee5` decimal(10,2) DEFAULT NULL,
  `is_deleted` bigint(20) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

/*Data for the table `instruction_sheet` */

insert  into `instruction_sheet`(`id`,`ll_id`,`app_no`,`acc_no`,`bor_name`,`client_no`,`spouse`,`client_stat`,`address`,`pri_con`,`unit_desc`,`tie_up_account`,`tu_lname`,`tu_fname`,`tu_unit_desc`,`term`,`list_cash_price`,`addon_rate`,`appraised_value`,`mon_first_payment`,`dp_gd_rv`,`mon_second_payment`,`start_date`,`maturity_date`,`due_date`,`value_date`,`amount_fin`,`amount_pn`,`rcf`,`rebate_rcf`,`TLV`,`manner_payment`,`less_udi_percent`,`less_total`,`udi_bal`,`mort_fee`,`mort_or`,`mort_total`,`proc_fee`,`proc_or`,`proc_total`,`apprais_fee`,`apprais_or`,`apprais_total`,`comm_fee`,`comm_or`,`comm_total`,`front_fee`,`front_or`,`front_total`,`sm_fee`,`salesman_id`,`sm_total`,`dealer_fee`,`dealer_id`,`dealer_total`,`real_estate_fee`,`real_estate_or`,`real_estate_total`,`insur_prem_fee`,`insur_prem_or`,`insur_prem_total`,`handling_fee`,`handling_or`,`handling_total`,`dpb_fee`,`dpb_or`,`dpb_total`,`doc_fee`,`doc_or`,`doc_total`,`sbgfc_fee`,`sbgfc_or`,`sbgfc_total`,`other_one_fee`,`other_one_or`,`other_one_total`,`other_two_fee`,`other_two_or`,`other_two_total`,`amount_deduct`,`amount_due`,`or_no`,`or_date`,`or_amount`,`payee1`,`amount_payee1`,`payee2`,`amount_payee2`,`payee3`,`amount_payee3`,`payee4`,`amount_payee4`,`payee5`,`amount_payee5`,`is_deleted`) values (7,30,30,0,'Pacquiao, Manny J',10,'Jinkey Pacquiao','','666 The Money Streey, Brgy. 666, Jensan',32412445285,'Sabungan sa Jensan','0','','','',26,'500000.00','32.28','0.00','49166.50','25000.00','49166.50','2018-05-28','2020-06-28','28','2018-04-28','475000.00','628330.00','650000.00','25000.00','1278330.00',1,'24.35','152998.00','475332.00','5000.00','500.00','4500.00','32131.00','2131.00','30000.00','50000.00','50000.00','0.00','25000.00','5000.00','20000.00','3500.00','1500.00','2000.00','2500.00',0,'2500.00','500.00',0,'500.00','5600.00','1600.00','4000.00','2000.00','1000.00','1000.00','15000.00','2500.00','12500.00','5000.00','5000.00','0.00','8000.00','0.00','8000.00','700.00','0.00','700.00','5000.00','1500.00','3500.00','50000.00','250.00','49750.00','138950.00','336382.00',23441233,'2018-05-29','70981.00','Sige Talon una ulo','5000.00','Agik','56000.00','Ginagawa Mu','25000.00','Pang Empi','2000.00','Talon mo bessy','20000.00',0),(8,29,29,0,'Tumanda, Jay E',1,'12345',NULL,'123, Brgy. 2, 3',123,'Makati','','','','',24,'25000.00','25.00','0.00','52794.00','0.00','52783.00','2018-05-15','2020-05-15','2020-05-15','2020-05-15','1000000.00','1250000.00','16800.00','700.00','1266800.00',0,'25.00','312500.00','937500.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','20000.00',NULL,NULL,'5000.00',NULL,NULL,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00',NULL,'912500.00',0,'0000-00-00','0.00','','0.00','','0.00','','0.00','','0.00','','0.00',0),(9,28,28,0,'Alingalan, Carl Dennis M',9,'',NULL,'2462 McKinley Hills, Brgy. 423, Tondo',312442131312,'Makati Sedeno','','','','',24,'70000.00','30.00','0.00','542377.00','0.00','542367.00','2018-05-17','2020-05-17','2020-05-17','2020-05-17','10000000.00','13000000.00','16800.00','700.00','13016800.00',1,'35.00','4375000.00','8125000.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','25000.00',NULL,NULL,'45000.00',NULL,NULL,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00',NULL,'8055000.00',0,'0000-00-00','0.00','','0.00','','0.00','','0.00','','0.00','','0.00',0),(10,31,31,0,'Alingalan, Carl Dennis M',9,'','','2462 McKinley Hills, Brgy. 423, Tondo',312442131312,'Punta sta.ana manila','0','','','',12,'125000.00','0.12','0.00','6757.50','50000.00','6757.50','2018-05-14','2019-05-14','2019-05-14','2019-05-14','75000.00','75090.00','6000.00','500.00','81090.00',2,'12.45','9348.71','65741.30','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','1222.00',0,NULL,'4322.00',0,NULL,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','608041.00',0,'2000-11-30','0.00','','0.00','','0.00','','0.00','','0.00','','0.00',0),(13,33,33,0,'Pacquiao, Manny J',10,'Jinkey Pacquiao','New','666 The Money Streey, Brgy. 666, Jensan',32412445285,'Magsasay','0','','','',24,'500000.00','31.25','0.00','11249.00','300000.54','11237.00','2018-05-28','2020-04-28','28','2018-04-28','199999.46','262499.29','7200.00','300.00','269699.29',1,'21.19','55623.60','206875.69','2500.00','0.00','2500.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00',0,'0.00','50000.00',0,'50000.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','50000.00','30000.00','20000.00','0.00','0.00','0.00','72500.00','134375.69',1234213,'2018-05-02','30000.00','Na Trucking','50000.00','','0.00','','0.00','','0.00','','0.00',0),(14,39,201805017,0,'Pacquiao, Manny J',10,'Jinkey Pacquiao','New','666 The Money Streey, Brgy. 666, Jensan',32412445285,'Mandaluyong Mental','0','','','',24,'1500000.00','32.56','0.00','81594.00','30000.00','81593.00','2018-05-28','2020-04-28','28','2018-04-28','1470000.00','1948632.00','9600.00','400.00','1958232.00',1,'23.43','456564.48','1492067.52','0.00','0.00','0.00','50000.00','0.00','50000.00','0.00','0.00','0.00','50000.00','40000.00','10000.00','0.00','0.00','0.00','23444.00',0,'23444.00','0.00',0,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','83444.00','1408623.52',12321321,'2018-05-30','40000.00','NA TRUCKING SERVICES','40000.00','','0.00','','0.00','','0.00','','0.00',0),(15,27,201805009,0,'Alingalan, Carl Dennis M',9,'','Old','2462 McKinley Hills, Brgy. 423, Tondo',312442131312,'','0','','','',24,'4000000.00','31.38','0.00','191875.00','500450.65','191871.00','2018-06-25','2020-05-25','25','2018-05-25','3499549.35','4597707.94','7200.00','300.00','4604907.94',1,'21.00','965518.67','3632189.27','10000.00','5000.00','5000.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00',0,'0.00','0.00',0,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','5000.00','960518.67',0,'0000-00-00','5000.00','','0.00','','0.00','','0.00','','0.00','','0.00',0),(18,45,201806002,0,'Yabson, Ataska M',11,'Ang','New','3123123, Brgy. 312323, 3123123',3123123,'asdad','0','','','',24,'400000.00','21.00','0.00','19212.00','25000.00','19206.00','2018-06-19','2020-05-19','19','2018-05-19','375000.00','453750.00','7200.00','300.00','460950.00',1,'31.00','140662.50','313087.50','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','50000.00',6,'50000.00','25000.00',9,'25000.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','75000.00','238087.50',0,'0000-00-00','0.00','','0.00','','0.00','','0.00','','0.00','','0.00',0),(19,26,201805008,0,'Alingalan, Carl Dennis M',9,'','Old','2462 McKinley Hills, Brgy. 423, Tondo',312442131312,'','0','','','',24,'5000000.00','21.32','0.00','240624.00','250000.00','240612.00','2018-09-24','2020-08-24','24','2018-08-24','4750000.00','5762700.00','12000.00','500.00','5774700.00',1,'31.09','1791623.43','3971076.57','25000.00','0.00','25000.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00',0,'0.00','0.00',0,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','25000.00','3946076.57',0,'0000-00-00','0.00','','0.00','','0.00','','0.00','','0.00','','0.00',0),(20,21,201805004,0,'Alingalan, Carl Dennis M',9,'','Old','2462 McKinley Hills, Brgy. 423, Tondo',312442131312,'','0','','','',24,'2000000.00','21.00','0.00','98624.00','50000.00','98612.00','2018-06-28','2020-05-28','28','2018-05-28','1950000.00','2359500.00','7200.00','300.00','2366700.00',1,'31.00','731445.00','1628055.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','3000.00',6,'3000.00','0.00',0,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','3000.00','1625055.00',0,'0000-00-00','0.00','','0.00','','0.00','','0.00','','0.00','','0.00',0);

/*Table structure for table `instruction_sheet_td` */

DROP TABLE IF EXISTS `instruction_sheet_td`;

CREATE TABLE `instruction_sheet_td` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `ll_id` bigint(20) DEFAULT NULL,
  `app_no` bigint(20) DEFAULT NULL,
  `acc_no` bigint(20) DEFAULT NULL,
  `bor_name` varchar(255) DEFAULT NULL,
  `client_no` bigint(20) DEFAULT NULL,
  `spouse` varchar(255) DEFAULT NULL,
  `client_stat` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `pri_con` bigint(20) DEFAULT NULL,
  `unit_desc` varchar(255) DEFAULT NULL,
  `tie_up_account` varchar(255) DEFAULT NULL,
  `tu_lname` varchar(255) DEFAULT NULL,
  `tu_fname` varchar(255) DEFAULT NULL,
  `tu_unit_desc` varchar(255) DEFAULT NULL,
  `amount_line` decimal(10,2) DEFAULT NULL,
  `avail_bal` decimal(10,2) DEFAULT NULL,
  `outstanding_avail` decimal(10,2) DEFAULT NULL,
  `prop_avail` decimal(10,2) DEFAULT NULL,
  `date_approved` date DEFAULT NULL,
  `term` bigint(20) DEFAULT NULL,
  `max_term` bigint(20) DEFAULT NULL,
  `int_rate` decimal(10,2) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `maturity_date` date DEFAULT NULL,
  `value_date` date DEFAULT NULL,
  `amount_pn` decimal(10,2) DEFAULT NULL,
  `discount` decimal(10,2) DEFAULT NULL,
  `net_proceeds` decimal(10,2) DEFAULT NULL,
  `manner_payment` bigint(20) DEFAULT NULL,
  `mort_fee` decimal(10,2) DEFAULT NULL,
  `mort_or` decimal(10,2) DEFAULT NULL,
  `mort_total` decimal(10,2) DEFAULT NULL,
  `proc_fee` decimal(10,2) DEFAULT NULL,
  `proc_or` decimal(10,2) DEFAULT NULL,
  `proc_total` decimal(10,2) DEFAULT NULL,
  `apprais_fee` decimal(10,2) DEFAULT NULL,
  `apprais_or` decimal(10,2) DEFAULT NULL,
  `apprais_total` decimal(10,2) DEFAULT NULL,
  `comm_fee` decimal(10,2) DEFAULT NULL,
  `comm_or` decimal(10,2) DEFAULT NULL,
  `comm_total` decimal(10,2) DEFAULT NULL,
  `front_fee` decimal(10,2) DEFAULT NULL,
  `front_or` decimal(10,2) DEFAULT NULL,
  `front_total` decimal(10,2) DEFAULT NULL,
  `sm_fee` decimal(10,2) DEFAULT NULL,
  `salesman_id` bigint(20) DEFAULT NULL,
  `sm_total` decimal(10,2) DEFAULT NULL,
  `dealer_fee` decimal(10,2) DEFAULT NULL,
  `dealer_id` bigint(20) DEFAULT NULL,
  `dealer_total` decimal(10,2) DEFAULT NULL,
  `real_estate_fee` decimal(10,2) DEFAULT NULL,
  `real_estate_or` decimal(10,2) DEFAULT NULL,
  `real_estate_total` decimal(10,2) DEFAULT NULL,
  `insur_prem_fee` decimal(10,2) DEFAULT NULL,
  `insur_prem_or` decimal(10,2) DEFAULT NULL,
  `insur_prem_total` decimal(10,2) DEFAULT NULL,
  `handling_fee` decimal(10,2) DEFAULT NULL,
  `handling_or` decimal(10,2) DEFAULT NULL,
  `handling_total` decimal(10,2) DEFAULT NULL,
  `dpb_fee` decimal(10,2) DEFAULT NULL,
  `dpb_or` decimal(10,2) DEFAULT NULL,
  `dpb_total` decimal(10,2) DEFAULT NULL,
  `doc_fee` decimal(10,2) DEFAULT NULL,
  `doc_or` decimal(10,2) DEFAULT NULL,
  `doc_total` decimal(10,2) DEFAULT NULL,
  `sbgfc_fee` decimal(10,2) DEFAULT NULL,
  `sbgfc_or` decimal(10,2) DEFAULT NULL,
  `sbgfc_total` decimal(10,2) DEFAULT NULL,
  `other_one_fee` decimal(10,2) DEFAULT NULL,
  `other_one_or` decimal(10,2) DEFAULT NULL,
  `other_one_total` decimal(10,2) DEFAULT NULL,
  `other_two_fee` decimal(10,2) DEFAULT NULL,
  `other_two_or` decimal(10,2) DEFAULT NULL,
  `other_two_total` decimal(10,2) DEFAULT NULL,
  `amount_deduct` decimal(10,2) DEFAULT NULL,
  `amount_due` decimal(10,2) DEFAULT NULL,
  `or_no` bigint(20) DEFAULT NULL,
  `or_date` date DEFAULT NULL,
  `or_amount` decimal(10,2) DEFAULT NULL,
  `payee1` varchar(255) DEFAULT NULL,
  `amount_payee1` decimal(10,2) DEFAULT NULL,
  `payee2` varchar(255) DEFAULT NULL,
  `amount_payee2` decimal(10,2) DEFAULT NULL,
  `payee3` varchar(255) DEFAULT NULL,
  `amount_payee3` decimal(10,2) DEFAULT NULL,
  `payee4` varchar(255) DEFAULT NULL,
  `amount_payee4` decimal(10,2) DEFAULT NULL,
  `payee5` varchar(255) DEFAULT NULL,
  `amount_payee5` decimal(10,2) DEFAULT NULL,
  `is_deleted` bigint(20) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

/*Data for the table `instruction_sheet_td` */

insert  into `instruction_sheet_td`(`id`,`ll_id`,`app_no`,`acc_no`,`bor_name`,`client_no`,`spouse`,`client_stat`,`address`,`pri_con`,`unit_desc`,`tie_up_account`,`tu_lname`,`tu_fname`,`tu_unit_desc`,`amount_line`,`avail_bal`,`outstanding_avail`,`prop_avail`,`date_approved`,`term`,`max_term`,`int_rate`,`start_date`,`maturity_date`,`value_date`,`amount_pn`,`discount`,`net_proceeds`,`manner_payment`,`mort_fee`,`mort_or`,`mort_total`,`proc_fee`,`proc_or`,`proc_total`,`apprais_fee`,`apprais_or`,`apprais_total`,`comm_fee`,`comm_or`,`comm_total`,`front_fee`,`front_or`,`front_total`,`sm_fee`,`salesman_id`,`sm_total`,`dealer_fee`,`dealer_id`,`dealer_total`,`real_estate_fee`,`real_estate_or`,`real_estate_total`,`insur_prem_fee`,`insur_prem_or`,`insur_prem_total`,`handling_fee`,`handling_or`,`handling_total`,`dpb_fee`,`dpb_or`,`dpb_total`,`doc_fee`,`doc_or`,`doc_total`,`sbgfc_fee`,`sbgfc_or`,`sbgfc_total`,`other_one_fee`,`other_one_or`,`other_one_total`,`other_two_fee`,`other_two_or`,`other_two_total`,`amount_deduct`,`amount_due`,`or_no`,`or_date`,`or_amount`,`payee1`,`amount_payee1`,`payee2`,`amount_payee2`,`payee3`,`amount_payee3`,`payee4`,`amount_payee4`,`payee5`,`amount_payee5`,`is_deleted`) values (5,38,201805020,0,'Alingalan, Carl Dennis M',9,'Mia Khalifa','Old','2462 McKinley Hills, Brgy. 423, Tondo',312442131312,'Makati Circuit','0','','','','5400000.00','2000000.00','3400000.00','2000000.00','2018-05-01',356,0,'26.00','2018-05-04','2019-04-25','2018-04-04','2000000.00','248527.69','1751472.31',1,'33183.03','0.00','33183.03','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00',0,'0.00','0.00',0,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','33183.03','1718289.28',21312321,'2018-05-17','0.00','','0.00','','0.00','','0.00','','0.00','','0.00',0),(6,40,201805018,0,'Alingalan, Carl Dennis M',9,'Mia Khalifa','Old','2462 McKinley Hills, Brgy. 423, Tondo',312442131312,'Hello','0','','','','540000.00','20000.00','520000.00','20000.00','2018-05-19',24,0,'26.00','2018-05-28','2018-06-21','2018-04-28','183340.00','644.35','182695.65',1,'33183.00','0.00','33183.00','0.00','0.00','0.00','0.00','0.00','0.00','3244122.00','2544122.00','700000.00','0.00','0.00','0.00','0.00',0,'0.00','0.00',0,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','733183.00','-550487.35',321442,'2018-05-31','2544122.00','','0.00','','0.00','','0.00','','0.00','','0.00',0),(16,41,201805019,0,'Alingalan, Carl Dennis M',9,'Mia Khalifa','Old','2462 McKinley Hills, Brgy. 423, Tondo',312442131312,'Makati Mandaluyong','0','','','','5400000.00','2000000.00','3400000.00','2000000.00','2018-04-30',356,0,'26.00','2016-07-04','2017-06-25','2016-06-04','2000000.00','248528.11','1751471.89',1,'22000.00','0.00','22000.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00',0,'0.00','0.00',0,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','22000.00','1729471.89',0,'0000-00-00','0.00','','0.00','','0.00','','0.00','','0.00','','0.00',0),(17,44,201806001,0,'Carcedo, Chris',10,'Mystic','New','3123213, Brgy. 3123123, 3213213',3123123,'Makati Ave','0','','','','5400000.00','2000000.00','3400000.00','2000000.00','2018-01-17',356,0,'26.00','2016-07-04','2017-06-25','2016-06-04','2000000.00','248528.11','1751471.89',1,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','40000.00',6,'40000.00','0.00',0,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','40000.00','1711471.89',0,'0000-00-00','0.00','','0.00','','0.00','','0.00','','0.00','','0.00',0),(18,46,201806003,0,'Gantan, Charles Dave R',12,'','New','QC, Brgy. 999, QC',234421,'Quezon City','0','','','','5000000.00','2000000.00','3000000.00','2000000.00','2019-09-23',61,0,'21.00','2018-06-14','2018-08-14','2018-05-14','333340.00','8593.33','324746.67',1,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00',0,'0.00','0.00',0,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','324746.67',0,'0000-00-00','0.00','','0.00','','0.00','','0.00','','0.00','','0.00',0);

/*Table structure for table `manner_of_payment` */

DROP TABLE IF EXISTS `manner_of_payment`;

CREATE TABLE `manner_of_payment` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `is_deleted` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `manner_of_payment` */

insert  into `manner_of_payment`(`id`,`code`,`name`,`is_deleted`) values (1,'PDC','PostDated Checks',0),(2,'COL','Collection',0),(3,'SALDUC','Salary Deduct',0);

/*Table structure for table `requirements` */

DROP TABLE IF EXISTS `requirements`;

CREATE TABLE `requirements` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `requirement_code` varchar(255) NOT NULL,
  `loan_type_id` varchar(255) NOT NULL,
  `caf` varchar(255) NOT NULL,
  `cf` varchar(255) NOT NULL,
  `is_deleted` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `requirements` */

insert  into `requirements`(`id`,`name`,`requirement_code`,`loan_type_id`,`caf`,`cf`,`is_deleted`) values (1,'2x2 Picture ID','2X2','','1,','1,3,',0),(2,'2 Valid ID','2VAL','','2,8,1,','1,3,2,',0),(3,'Baranggay Clearance','BRCL','','3,2,5,1,','1,2,',0),(4,'Tax Income','BIR','','','1,2,',0);

/*Table structure for table `vw_chartacc` */

DROP TABLE IF EXISTS `vw_chartacc`;

/*!50001 DROP VIEW IF EXISTS `vw_chartacc` */;
/*!50001 DROP TABLE IF EXISTS `vw_chartacc` */;

/*!50001 CREATE TABLE  `vw_chartacc`(
 `id` bigint(20) ,
 `acc_id` varchar(255) ,
 `account_name` longtext ,
 `name` varchar(50) ,
 `is_deleted` tinyint(4) 
)*/;

/*Table structure for table `vw_journals` */

DROP TABLE IF EXISTS `vw_journals`;

/*!50001 DROP VIEW IF EXISTS `vw_journals` */;
/*!50001 DROP TABLE IF EXISTS `vw_journals` */;

/*!50001 CREATE TABLE  `vw_journals`(
 `journal_id` bigint(20) ,
 `journal_date` date ,
 `description` longtext ,
 `is_archived` int(2) 
)*/;

/*View structure for view vw_chartacc */

/*!50001 DROP TABLE IF EXISTS `vw_chartacc` */;
/*!50001 DROP VIEW IF EXISTS `vw_chartacc` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_chartacc` AS select `accounts`.`id` AS `id`,`accounts`.`acc_id` AS `acc_id`,`accounts`.`account_name` AS `account_name`,`account_types`.`name` AS `name`,`accounts`.`is_deleted` AS `is_deleted` from (`accounts` join `account_types` on((`accounts`.`type` = `account_types`.`acc_types_id`))) */;

/*View structure for view vw_journals */

/*!50001 DROP TABLE IF EXISTS `vw_journals` */;
/*!50001 DROP VIEW IF EXISTS `vw_journals` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_journals` AS select `journals`.`journal_id` AS `journal_id`,`journals`.`journal_date` AS `journal_date`,`journals`.`description` AS `description`,`journals`.`is_archived` AS `is_archived` from `journals` */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
