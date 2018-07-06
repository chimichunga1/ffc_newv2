/*
SQLyog Community v13.0.1 (64 bit)
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

/*Table structure for table `bwu_files` */

DROP TABLE IF EXISTS `bwu_files`;

CREATE TABLE `bwu_files` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `file_name` varchar(255) DEFAULT NULL,
  `file_location` varchar(255) DEFAULT NULL,
  `loan_id` bigint(20) DEFAULT NULL,
  `date_modified` varchar(255) DEFAULT NULL,
  `is_deleted` tinyint(4) DEFAULT '0',
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `bwu_files` */

insert  into `bwu_files`(`id`,`file_name`,`file_location`,`loan_id`,`date_modified`,`is_deleted`) values 
(1,'DESPRO-appendices-final-na.docx','1.docx',21,'2018-05-14 16:43:47',0),
(2,'doc6.docx','2.docx',25,'2018-05-14 17:02:34',0);

/*Table structure for table `client_list` */

DROP TABLE IF EXISTS `client_list`;

CREATE TABLE `client_list` (
  `client_number` bigint(20) NOT NULL AUTO_INCREMENT,
  `lname` varchar(255) DEFAULT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `mname` varchar(255) DEFAULT NULL,
  `ename` varchar(255) NOT NULL,
  `ind_corp_id` bigint(20) DEFAULT NULL,
  `birthdate` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `civil_status_id` bigint(20) DEFAULT NULL,
  `spouse` varchar(255) DEFAULT NULL,
  `tin_no` varchar(255) DEFAULT NULL,
  `sss_no` varchar(255) DEFAULT NULL,
  `acr_no` varchar(255) DEFAULT NULL,
  `pagibig_no` varchar(255) DEFAULT NULL,
  `rescert_no` varchar(255) DEFAULT NULL,
  `rescert_date` varchar(255) DEFAULT NULL,
  `rescert_place` varchar(255) DEFAULT NULL,
  `bus_type_id` bigint(20) DEFAULT NULL,
  `ind_code_id` bigint(20) DEFAULT NULL,
  `client_type_id` bigint(20) DEFAULT NULL,
  `country_id` bigint(20) DEFAULT NULL,
  `region_id` bigint(20) DEFAULT NULL,
  `con_name` varchar(255) DEFAULT NULL,
  `con_rescert_no` varchar(255) DEFAULT NULL,
  `con_rescert_date` varchar(255) DEFAULT NULL,
  `con_rescert_place` varchar(255) DEFAULT NULL,
  `home_no` varchar(255) DEFAULT NULL,
  `home_brgy` varchar(255) DEFAULT NULL,
  `home_city` varchar(255) DEFAULT NULL,
  `home_zip` varchar(255) DEFAULT NULL,
  `bus_no` varchar(255) DEFAULT NULL,
  `bus_brgy` varchar(255) DEFAULT NULL,
  `bus_city` varchar(255) DEFAULT NULL,
  `bus_zip` varchar(255) DEFAULT NULL,
  `gar_no` varchar(255) DEFAULT NULL,
  `gar_brgy` varchar(255) DEFAULT NULL,
  `gar_city` varchar(255) DEFAULT NULL,
  `gar_zip` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `fax_no` varchar(255) DEFAULT NULL,
  `bus_tel` varchar(255) DEFAULT NULL,
  `home_tel` varchar(255) DEFAULT NULL,
  `pri_con` varchar(255) DEFAULT NULL,
  `sec_con` varchar(255) DEFAULT NULL,
  `applied_by` varchar(255) DEFAULT NULL,
  `applied_date` date DEFAULT NULL,
  `date_modified` date DEFAULT NULL,
  `same_add` varchar(255) DEFAULT NULL,
  `same_add1` varchar(255) DEFAULT NULL,
  `is_deleted` tinyint(4) DEFAULT '0',
  `status_id` tinyint(4) DEFAULT '0',
  `is_blacklisted` tinyint(4) DEFAULT '0',
  `is_dealer` varchar(255) DEFAULT NULL,
  `is_salesman` varchar(255) DEFAULT NULL,
  `is_borrower` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`client_number`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `client_list` */

insert  into `client_list`(`client_number`,`lname`,`fname`,`mname`,`ename`,`ind_corp_id`,`birthdate`,`gender`,`civil_status_id`,`spouse`,`tin_no`,`sss_no`,`acr_no`,`pagibig_no`,`rescert_no`,`rescert_date`,`rescert_place`,`bus_type_id`,`ind_code_id`,`client_type_id`,`country_id`,`region_id`,`con_name`,`con_rescert_no`,`con_rescert_date`,`con_rescert_place`,`home_no`,`home_brgy`,`home_city`,`home_zip`,`bus_no`,`bus_brgy`,`bus_city`,`bus_zip`,`gar_no`,`gar_brgy`,`gar_city`,`gar_zip`,`email`,`fax_no`,`bus_tel`,`home_tel`,`pri_con`,`sec_con`,`applied_by`,`applied_date`,`date_modified`,`same_add`,`same_add1`,`is_deleted`,`status_id`,`is_blacklisted`,`is_dealer`,`is_salesman`,`is_borrower`) values 
(1,'Tumanda','Jay','Esterado','',1,'04/09/2018','Male',1,'12345','123','13','123','123','123','04/05/2018','213',1,1,1,1,1,'1234','123','04/07/2018','213','123','2','3','4','123','2','3','4','123','2','3','4','jay@gmail.com','12123','123','12123','123','123','1','2018-04-05','2018-05-08','checked','checked',0,1,0,'0','0','checked'),
(2,'Ribleza','Wilfred','Magdaong','',1,'04/09/2018','Male',1,'12345','123','13','123','123','123','04/05/2018','213',1,1,1,1,1,'123','123','04/07/2018','213','123','2','3','4','123','2','3','4',NULL,NULL,NULL,NULL,'jay@gmail.com','12123','123','12123','123','123','1','2018-04-07','2018-04-11','checked',NULL,0,0,0,'0','0','checked'),
(3,'test','test','test','',1,'04/13/2018','Male',1,'test','123','123','123','123','123','04/13/2018','test',1,1,1,1,1,'test','123','04/13/2018','test','test','tet','test','test','test','tet','test','test',NULL,NULL,NULL,NULL,'test@gmail.com','test','test','test','test','test','1','2018-04-13',NULL,'checked',NULL,1,0,0,'0','0','checked'),
(4,'test2','test2','test2','',1,'04/13/2018','Male',1,'test','123','123','123','123','123','04/13/2018','test',1,1,1,1,1,'tes','123','04/13/2018','test','test','test','test','test','test','test','test','test',NULL,NULL,NULL,NULL,'test@gmail.com','test','test','test','test','test','1','2018-04-13','2018-04-13','checked',NULL,1,0,0,'0','0','checked'),
(5,'Chicano','Mhar','Vic','',1,'04/02/2018','Male',1,'uuuu','898098','8098098','8098','098098','98908098','04/02/2018','ii8098098',1,1,1,1,1,'Mhar Vic Chicano','8980980','03/05/2018','80989','4342 V. Baltazar St. Pinabuhatan Pasig City','pasig','Pasig','1602','4342 V. Baltazar St. Pinabuhatan Pasig City','pasig','Pasig','1602',NULL,NULL,NULL,NULL,'test@gmail.com','980-90-9','8989908','89098','98098','09809','1','2018-04-13',NULL,'checked',NULL,0,0,0,'0','0','checked'),
(6,'Drilon','Bugoy','Test','',1,'04/27/2018','Male',1,'','1231515213','123124415','123124421412','123124214','123124114123','12/31/2008','123141241',1,1,0,1,1,'Bugoy Drilon','1231442','04/16/2018','Buboy','dito doon','905','Manila','1009','dito doon','905','Manila','1009','dito doon','905','Manila','1009','bugoy@gmail.com','312635817546125','123615467','312635817546125','1265417541625','136851283532','1','2018-04-15','2018-05-14','checked','checked',0,1,0,'checked','checked','c'),
(7,'CONOCONO','CJAY','TEST','',1,'04/15/2018','Male',1,'TEST','123','123','123','12312','123','04/15/2018','TEST',1,1,1,1,1,'TEST','123','04/15/2018','TES','123','TEST','TEST','123','123','TEST','TEST','123',NULL,NULL,NULL,NULL,'test11@gmail.com','123','123','123','123','123','1','2018-04-15',NULL,'checked',NULL,0,0,0,'0','0','checked'),
(8,'tests','test','test','',1,'04/16/2018','Male',1,'','123','123','123','123','123','04/16/2018','test',1,1,0,1,1,'test','123','04/16/2018','test','test','test','test','test','test','test','test','test','test','test','test','test','test@gmail.com','test','test','test','test','test','1','2018-04-16','2018-05-14','checked','checked',0,0,1,'','','checked'),
(9,'Alingalan','Carl Dennis','M','popoy',1,'09/11/1997','Male',1,'','321312','312321','42423213','1231232','1312321','12/31/2031','321321312',1,1,0,1,1,'Majin Bu','4263278426','04/07/2082','Mars','2462 McKinley Hills','423','Tondo','1006','2462 McKinley Hills','423','Tondo','1006','2462 McKinley Hills','423','Tondo','1006','majin_bu@gmail.com','214123213','31214213123','214123213','312442131312','412413123','1','2018-05-08','2018-05-14','checked','checked',0,1,0,'checked','','checked');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
