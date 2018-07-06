/*
SQLyog Community v12.5.1 (64 bit)
MySQL - 10.1.16-MariaDB : Database - fccl_system
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

/*Table structure for table `dealer` */

DROP TABLE IF EXISTS `dealer`;

CREATE TABLE `dealer` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `is_deleted` tinyint(4) DEFAULT '0',
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `dealer` */

insert  into `dealer`(`id`,`name`,`is_deleted`) values 
(1,'Dealer No. 1',0);

/*Table structure for table `loan_list` */

DROP TABLE IF EXISTS `loan_list`;

CREATE TABLE `loan_list` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `app_type` varchar(255) DEFAULT NULL,
  `app_no` varchar(255) DEFAULT NULL,
  `client_no` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `spouse` varchar(255) DEFAULT NULL,
  `dealer_id` bigint(20) DEFAULT NULL,
  `salesman_id` bigint(20) DEFAULT NULL,
  `loan_type_id` bigint(20) DEFAULT NULL,
  `credit_fac_id` bigint(20) DEFAULT NULL,
  `prod_line_id` bigint(20) DEFAULT NULL,
  `mark_type_id` bigint(20) DEFAULT NULL,
  `coll_code_id` bigint(20) DEFAULT NULL,
  `bus_add` varchar(255) DEFAULT NULL,
  `home_add` varchar(255) DEFAULT NULL,
  `email_add` varchar(255) DEFAULT NULL,
  `bus_tel` varchar(255) DEFAULT NULL,
  `home_tel` varchar(255) DEFAULT NULL,
  `pri_con` varchar(255) DEFAULT NULL,
  `sec_con` varchar(255) DEFAULT NULL,
  `applied_by` bigint(20) DEFAULT NULL,
  `ci_check_by` bigint(20) DEFAULT NULL,
  `date_applied` date DEFAULT NULL,
  `date_modified` date DEFAULT NULL,
  `is_deleted` tinyint(4) DEFAULT '0',
  `loan_status_id` bigint(20) DEFAULT '1',
  `is_approve` smallint(1) DEFAULT '0',
  `current_approver_id` bigint(20) DEFAULT NULL,
  `approve_type` smallint(1) DEFAULT '0',
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

/*Data for the table `loan_list` */

insert  into `loan_list`(`id`,`app_type`,`app_no`,`client_no`,`last_name`,`first_name`,`spouse`,`dealer_id`,`salesman_id`,`loan_type_id`,`credit_fac_id`,`prod_line_id`,`mark_type_id`,`coll_code_id`,`bus_add`,`home_add`,`email_add`,`bus_tel`,`home_tel`,`pri_con`,`sec_con`,`applied_by`,`ci_check_by`,`date_applied`,`date_modified`,`is_deleted`,`loan_status_id`,`is_approve`,`current_approver_id`,`approve_type`) values 
(1,'','1','1','Tumanda','Jay','',NULL,NULL,1,1,1,1,1,'Makati','Taguig','jay@gmail.com','123','123','123','123',1,NULL,'2018-03-19','2018-04-16',0,2,0,3,1),
(4,'','12321','213','wew','wew','wew',NULL,NULL,1,2,1,1,1,'wew','wwew','wew@gmail.com','wwew','qweqw','wqewq','wqe',1,NULL,'2018-03-31','2018-04-15',0,2,0,3,1),
(5,'new','','1','Tumanda','Jay','12345',NULL,NULL,1,2,1,1,1,'','','jay@gmail.com','123','12123','123','123',1,NULL,'2018-04-15','2018-04-16',0,2,0,1,0),
(6,'new','','5','Chicano','Mhar','uuuu',NULL,NULL,2,1,1,2,1,'','','test@gmail.com','8989908','89098','98098','09809',1,NULL,'2018-04-15','2018-04-15',0,2,0,1,0),
(7,'new','','6','Drilon','Bugoy','',NULL,NULL,2,1,2,2,2,'','','bugoy@gmail.com','123615467','312635817546125','1265417541625','136851283532',1,NULL,'2018-04-16','2018-04-16',0,2,0,NULL,0),
(8,'new','8','1','Tumanda','Jay','12345',NULL,NULL,2,1,1,2,2,'','','jay@gmail.com','123','12123','123','123',1,NULL,'2018-04-17','2018-04-17',0,2,0,NULL,0),
(9,'new','','1','Tumanda','Jay','12345',NULL,NULL,1,1,1,2,1,'','','jay@gmail.com','123','12123','123','123',1,NULL,'2018-04-17','2018-04-18',0,2,0,NULL,0),
(10,'new','','5','Chicano','Mhar','uuuu',NULL,NULL,2,2,1,1,2,'','','test@gmail.com','8989908','89098','98098','09809',1,NULL,'2018-04-18','2018-04-18',0,2,0,NULL,0),
(11,'new','','6','Drilon','Bugoy','',NULL,NULL,3,2,2,2,1,'','','bugoy@gmail.com','123615467','312635817546125','1265417541625','136851283532',1,NULL,'2018-04-18','2018-04-19',0,6,0,NULL,0),
(12,'new','','7','CONOCONO','CJAY','TEST',NULL,NULL,2,2,1,2,1,'','','test11@gmail.com','123','123','123','123',1,NULL,'2018-04-18','2018-04-21',0,6,0,NULL,0),
(13,'new','','2','Ribleza','Wilfred','12345',NULL,NULL,2,2,1,1,1,'','','jay@gmail.com','123','12123','123','123',1,NULL,'2018-04-18','2018-04-21',0,6,0,NULL,0),
(14,'new','','1','Tumanda','Jay','12345',NULL,NULL,2,1,2,1,1,'','','jay@gmail.com','123','12123','123','123',1,NULL,'2018-04-19','2018-04-21',0,6,0,NULL,0),
(15,'new','15','6','Drilon','Bugoy','',NULL,NULL,2,1,2,1,1,'','','bugoy@gmail.com','123615467','312635817546125','1265417541625','136851283532',1,1,'2018-04-21','2018-05-03',0,3,0,NULL,0),
(16,'new','','5','Chicano','Mhar','uuuu',NULL,NULL,3,1,1,1,1,'','','test@gmail.com','8989908','89098','98098','09809',1,NULL,'2018-04-25','2010-04-29',0,4,0,NULL,0),
(17,'new','','1','Tumanda','Jay','12345',NULL,NULL,1,3,4,1,1,'','','jay@gmail.com','123','12123','123','123',1,NULL,'2018-04-25','2018-04-26',0,5,0,NULL,0),
(18,'new','18','5','Chicano','Mhar','uuuu',1,0,1,1,3,1,2,'','','test@gmail.com','8989908','89098','98098','09809',1,NULL,'2018-05-01','2018-05-03',0,1,0,NULL,0);

/*Table structure for table `region` */

DROP TABLE IF EXISTS `region`;

CREATE TABLE `region` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `country_id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `region` */

insert  into `region`(`id`,`country_id`,`name`,`is_deleted`) values 
(1,1,'METRO MANILA',0),
(2,1,'test',1),
(3,1,'test',1),
(4,1,'OUT OF TOWN',0);

/*Table structure for table `salesman` */

DROP TABLE IF EXISTS `salesman`;

CREATE TABLE `salesman` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `is_deleted` tinyint(4) DEFAULT '0',
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `salesman` */

insert  into `salesman`(`id`,`name`,`is_deleted`) values 
(1,'Salesman No. 1',0);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
