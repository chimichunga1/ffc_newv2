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

/*Table structure for table `client_list` */

DROP TABLE IF EXISTS `client_list`;

CREATE TABLE `client_list` (
  `client_number` bigint(20) NOT NULL AUTO_INCREMENT,
  `lname` varchar(255) DEFAULT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `mname` varchar(255) DEFAULT NULL,
  `ename` varchar(255) DEFAULT NULL,
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
  `client_status` bigint(20) DEFAULT '0',
  `is_blacklisted` tinyint(4) DEFAULT '0',
  `is_deleted` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`client_number`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

/*Data for the table `client_list` */

insert  into `client_list`(`client_number`,`lname`,`fname`,`mname`,`ename`,`ind_corp_id`,`birthdate`,`gender`,`civil_status_id`,`spouse`,`tin_no`,`sss_no`,`acr_no`,`pagibig_no`,`rescert_no`,`rescert_date`,`rescert_place`,`bus_type_id`,`ind_code_id`,`client_type_id`,`country_id`,`region_id`,`con_name`,`con_rescert_no`,`con_rescert_date`,`con_rescert_place`,`home_no`,`home_brgy`,`home_city`,`home_zip`,`bus_no`,`bus_brgy`,`bus_city`,`bus_zip`,`gar_no`,`gar_brgy`,`gar_city`,`gar_zip`,`email`,`fax_no`,`bus_tel`,`home_tel`,`pri_con`,`sec_con`,`applied_by`,`applied_date`,`date_modified`,`same_add`,`same_add1`,`client_status`,`is_blacklisted`,`is_deleted`) values 
(1,'Tumanda','Jay','Esterado',NULL,1,'04/09/2018','Male',1,'12345','123','13','123','123','123','04/05/2018','213',1,1,1,1,1,'1234','123','04/07/2018','213','123','2','3','4','123','2','3','4',NULL,NULL,NULL,NULL,'jay@gmail.com','12123','123','12123','123','123','1','2018-04-05','2018-04-17','checked',NULL,2,0,0),
(2,'Ribleza','Wilfred','Magdaong',NULL,1,'04/09/2018','Male',1,'12345','123','13','123','123','123','04/05/2018','213',1,1,1,1,1,'123','123','04/07/2018','213','123','2','3','4','123','2','3','4','123','2','3','4','jay@gmail.com','12123','123','12123','123','123','1','2018-04-07','2018-04-21','checked','checked',2,0,0),
(3,'test','test','test',NULL,1,'04/13/2018','Male',1,'test','123','123','123','123','123','04/13/2018','test',1,1,1,1,1,'test','123','04/13/2018','test','test','tet','test','test','test','tet','test','test',NULL,NULL,NULL,NULL,'test@gmail.com','test','test','test','test','test','1','2018-04-13',NULL,'checked',NULL,2,0,0),
(4,'test2','test2','test2',NULL,1,'04/13/2018','Male',1,'test','123','123','123','123','123','04/13/2018','test',1,1,1,1,1,'tes','123','04/13/2018','test','test','test','test','test','test','test','test','test',NULL,NULL,NULL,NULL,'test@gmail.com','test','test','test','test','test','1','2018-04-13','2018-04-13','checked',NULL,2,0,0),
(5,'Chicano','Mhar','Vic',NULL,1,'04/02/2018','Male',1,'uuuu','898098','8098098','8098','098098','98908098','04/02/2018','ii8098098',1,1,1,1,1,'Mhar Vic Chicano','8980980','03/05/2018','80989','4342 V. Baltazar St. Pinabuhatan Pasig City','pasig','Pasig','1602','4342 V. Baltazar St. Pinabuhatan Pasig City','pasig','Pasig','1602',NULL,NULL,NULL,NULL,'test@gmail.com','980-90-9','8989908','89098','98098','09809','1','2018-04-13',NULL,'checked',NULL,2,0,0),
(6,'Drilon','Bugoy','Ets',NULL,1,'04/27/2018','Male',1,'','1231515213','123124415','123124421412','123124214','123124114123','12/31/2008','123141241',1,1,1,1,1,'Bugoy Drilon','1231442','04/16/2018','Buboy','dito doon','905','Manila','1009','dito doon','905','Manila','1009',NULL,NULL,NULL,NULL,'bugoy@gmail.com','12347','123615467','312635817546125','1265417541625','136851283532','1','2018-04-15',NULL,'checked',NULL,2,0,0),
(7,'CONOCONO','CJAY','TEST',NULL,1,'04/15/2018','Male',1,'TEST','123','123','123','12312','123','04/15/2018','TEST',1,1,1,1,1,'TEST','123','04/15/2018','TES','123','TEST','TEST','123','123','TEST','TEST','123',NULL,NULL,NULL,NULL,'test11@gmail.com','123','123','123','123','123','1','2018-04-15',NULL,'checked',NULL,2,0,0),
(8,'tests','test','test',NULL,1,'04/16/2018','Male',1,'','123','123','123','123','123','04/16/2018','test',1,1,1,1,1,'test','123','04/16/2018','test','test','test','test','test','test','test','test','test','test','test','test','test','test@gmail.com','test','test','test','test','test','1','2018-04-16','2018-04-21','checked','checked',2,0,0),
(9,'awdaw','wadwad','wadwad',NULL,1,'04/21/2018','Male',1,'awdwa','2332','23423','324','23432','234','04/21/2018','32432',1,1,1,1,1,'2132','12321','04/21/2018','2131','232','23','32432','324','232','23','32432','324','232','23','32432','324','jay@gmail.com','234','12345','32423','2423423','','1','2018-04-21',NULL,'checked','checked',2,1,0);

/*Table structure for table `credit_facility` */

DROP TABLE IF EXISTS `credit_facility`;

CREATE TABLE `credit_facility` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `credit_facility` */

insert  into `credit_facility`(`id`,`code`,`name`,`is_deleted`) values 
(1,'DL','Direct Loan',0),
(2,'LE','Lease Contracts Receivables',0),
(3,'RE','Real Estate Mortgage',0),
(4,'RF','Receivables Finance',0);

/*Table structure for table `industry_corp` */

DROP TABLE IF EXISTS `industry_corp`;

CREATE TABLE `industry_corp` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `industry_corp` */

insert  into `industry_corp`(`id`,`name`,`is_deleted`) values 
(1,'Individual',0),
(2,'FCC',1),
(3,'Single Proprietorship',0),
(4,'Partnership',0),
(5,'Corporation',0);

/*Table structure for table `loan_approval_type` */

DROP TABLE IF EXISTS `loan_approval_type`;

CREATE TABLE `loan_approval_type` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `is_deleted` smallint(1) DEFAULT '0',
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `loan_approval_type` */

insert  into `loan_approval_type`(`id`,`code`,`name`,`is_deleted`) values 
(1,'A1','Add-On - Salary Loan',0),
(2,'A3','Add-On - Leasing',0),
(3,'A2','Add-On - Truck Financing',0),
(4,'A4','Add-On Others',0),
(5,'AA','AA',0),
(6,'B1','True Discounts',0),
(7,'C1','In Arrears - Lump Sum',0),
(8,'C2','In Arrears - Annuity',0);

/*Table structure for table `product_line` */

DROP TABLE IF EXISTS `product_line`;

CREATE TABLE `product_line` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Data for the table `product_line` */

insert  into `product_line`(`id`,`code`,`name`,`is_deleted`) values 
(1,'A','C',0),
(2,'DB','DBP - Funded Loans',0),
(3,'DP','Discounting of PDC',0),
(4,'IL','Interim Loans - DBF Funds',0),
(5,'LS','Leasing - Equipment / Vehicle',0),
(6,'OT','Others',0),
(7,'RE','Loan Vs Rem',0),
(8,'SB','SBGCF - Funded Loans',0),
(9,'SL','Salary Loans',0),
(10,'SS','Loan Vs Shares of Stocks',0),
(11,'TF','Truck Financing',0),
(12,'VF','Vehicle Financing',0);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
