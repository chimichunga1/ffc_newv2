/*
SQLyog Trial v13.0.0 (64 bit)
MySQL - 10.1.24-MariaDB : Database - fccl_system
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
  `application_no` bigint(20) NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `spouse` varchar(255) NOT NULL,
  `co_maker` varchar(255) NOT NULL,
  `contact_no` bigint(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `dealer` varchar(255) NOT NULL,
  `salesman` varchar(255) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `list_cash_price` bigint(20) NOT NULL,
  `appraised_value` bigint(20) NOT NULL,
  `downpayment` bigint(20) NOT NULL,
  `amount_financed` bigint(20) NOT NULL,
  `term` bigint(20) NOT NULL,
  `interest_rate` bigint(20) NOT NULL,
  `monthly_payment` bigint(20) NOT NULL,
  `second_payment` bigint(20) NOT NULL,
  `prepared_by` varchar(255) NOT NULL,
  `noted_by` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_deleted` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

/*Data for the table `caf_info` */

insert  into `caf_info`(`id`,`client_no`,`application_no`,`client_name`,`spouse`,`co_maker`,`contact_no`,`address`,`dealer`,`salesman`,`unit`,`list_cash_price`,`appraised_value`,`downpayment`,`amount_financed`,`term`,`interest_rate`,`monthly_payment`,`second_payment`,`prepared_by`,`noted_by`,`created_at`,`is_deleted`) values 
(14,1,17,'Jay Esterado Tumanda','12345','Carl Dennis Alingalan',123,'123 Brgy. 2 3','Test T. Test','Test T. Test','123',123,115,123,123,123,123,123,123,'CJAY Dadivas CONOCONO','RAMON R. RAMOS','2018-04-25 22:19:32',0),
(15,5,16,'Mhar Vic Chicano','uuuu','Dennis Matias',98098,'4342 V. Baltazar St. Pinabuhatan Pasig City Brgy. pasig Pasig','Juan De Cruz','Juan Tuw Tre','123',123,123,123,123,123,123,123,123,'CJAY Dadivas CONOCONO','RAMON R. RAMOS','2018-04-25 22:52:48',0);

/*Table structure for table `client_requirements_caf` */

DROP TABLE IF EXISTS `client_requirements_caf`;

CREATE TABLE `client_requirements_caf` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `requirement_name` varchar(255) NOT NULL,
  `requirement_code` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `client_no` bigint(20) NOT NULL,
  `application_no` bigint(20) NOT NULL,
  `is_deleted` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `client_requirements_caf` */

insert  into `client_requirements_caf`(`id`,`requirement_name`,`requirement_code`,`status`,`client_no`,`application_no`,`is_deleted`) values 
(3,'2 Valid ID','2val','pending',6,15,0),
(4,'Baranggay Clearance','BRCL','pending',6,15,0),
(5,'Baranggay Clearance','BRCL','received',5,16,0),
(6,'2x2 Picture ID','2x2','received',1,17,0),
(7,'2 Valid ID','2val','pending',1,17,0),
(8,'Baranggay Clearance','BRCL','received',1,17,0);

/*Table structure for table `client_requirements_cf` */

DROP TABLE IF EXISTS `client_requirements_cf`;

CREATE TABLE `client_requirements_cf` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `requirement_name` varchar(255) NOT NULL,
  `requirement_code` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `client_no` bigint(20) NOT NULL,
  `application_no` bigint(20) NOT NULL,
  `is_deleted` bigint(200) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `client_requirements_cf` */

insert  into `client_requirements_cf`(`id`,`requirement_name`,`requirement_code`,`status`,`client_no`,`application_no`,`is_deleted`) values 
(1,'2x2 Picture ID','2x2','pending',1,17,0),
(2,'2 Valid ID','2val','received',1,17,0),
(3,'Baranggay Clearance','BRCL','received',1,17,0),
(4,'Tax Income','BIR','received',1,17,0);

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

insert  into `requirements`(`id`,`name`,`requirement_code`,`loan_type_id`,`caf`,`cf`,`is_deleted`) values 
(1,'2x2 Picture ID','2x2','','8,1,','1,',0),
(2,'2 Valid ID','2val','','2,8,1,','1,',0),
(3,'Baranggay Clearance','BRCL','','3,2,5,1,','1,',0),
(4,'Tax Income','BIR','','','1,',0);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
