<<<<<<< HEAD
/*
SQLyog Ultimate v10.00 Beta1
MySQL - 5.5.5-10.1.28-MariaDB : Database - fccl_system
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

/*Table structure for table `account_types` */

DROP TABLE IF EXISTS `account_types`;

CREATE TABLE `account_types` (
  `acc_types_id` bigint(20) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `inc_when_debit` int(2) NOT NULL,
  PRIMARY KEY (`acc_types_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `account_types` */

insert  into `account_types`(`acc_types_id`,`name`,`inc_when_debit`) values (1,'Revenue(Main)',0),(2,'Revenue(Side)',0),(3,'Expenses',1),(4,'Assets(Non-Current)',1),(5,'Assets(Current)',1),(6,'Liabilities(Current)',0),(7,'Liabilities(Non-Current)',0),(8,'Owner\'s Equity (Capital)',0),(9,'Owner\'s Equity (Drawing)',0),(10,'Contra (Current Assets)',0),(11,'Non-Current Asset',0);

/*Table structure for table `accounts` */

DROP TABLE IF EXISTS `accounts`;

CREATE TABLE `accounts` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `acc_id` varchar(255) NOT NULL,
  `account_name` longtext,
  `type` int(11) DEFAULT NULL,
  `is_deleted` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`acc_id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

/*Data for the table `accounts` */

insert  into `accounts`(`id`,`acc_id`,`account_name`,`type`,`is_deleted`) values (1,'0','wew',2,0),(2,'1001','Cash',5,0),(3,'1002','Petty Cash',5,0),(4,'1003','Accounts Recievable',5,0),(5,'1004','Notes Receivable',5,0),(6,'1005','Allowance for Bad Debts',5,0),(7,'1006','Merchandise Inventory',5,0),(8,'1007','Supplies Unused',5,0),(9,'1008','Prepaid Insurance',5,0),(10,'1009','Furnitures and Fixtures',4,0),(11,'1010','Accu. Depreciation-F&F',4,0),(12,'1011','Equipment',4,0),(13,'1012','Accu. deprecaition-Equip.',4,0),(14,'1013','Land',4,0),(15,'1014','Building',4,0),(16,'1015','Accu. Depreciation-Bldg',4,0),(17,'123','One',6,0),(18,'2001','Accounts Payable',6,0),(19,'222222','CJAY TEST',1,0),(20,'3001','Salaries Expenses',3,0),(21,'3002','Utilities Expenses',3,0),(22,'3003','Supplies Expense',3,0),(23,'3004','Rent Expense',3,0),(24,'3435','bully',7,0),(25,'34578','game',6,0),(26,'34fgg','sfdfds',6,0),(27,'4001','Accounts Payable',6,0),(28,'5001','Service',2,0),(29,'5002','Sales',5,0),(30,'6001','Mr. X Capital',8,0),(31,'6002','MrM',9,0),(32,'7900','Test',11,0),(33,'9999','Test Income',1,0),(34,'ASD','ASD',1,0),(38,'CJAY','xcvfb',7,0),(35,'CJAY CONOCONO','CJAY CONOCONO wew',2,0),(36,'CJAY1996','CJAY',2,0),(37,'qwdqd44546','fghfhg',3,1),(39,'`er','ert',3,0);

/*Table structure for table `additional_cash` */

DROP TABLE IF EXISTS `additional_cash`;

CREATE TABLE `additional_cash` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `amount` varchar(255) NOT NULL,
  `year` varchar(255) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `additional_cash` */

insert  into `additional_cash`(`id`,`amount`,`year`,`is_deleted`) values (1,'111','2017',0);

/*Table structure for table `approval_flow` */

DROP TABLE IF EXISTS `approval_flow`;

CREATE TABLE `approval_flow` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=325 DEFAULT CHARSET=latin1;

/*Data for the table `approval_flow` */

insert  into `approval_flow`(`id`,`user_id`) values (324,1);

/*Table structure for table `available_balance` */

DROP TABLE IF EXISTS `available_balance`;

CREATE TABLE `available_balance` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `amount` varchar(255) NOT NULL,
  `year` varchar(255) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `available_balance` */

insert  into `available_balance`(`id`,`amount`,`year`,`is_deleted`) values (1,'700','2017',0),(3,'354','2018',0),(4,'1','1',0);

/*Table structure for table `bank` */

DROP TABLE IF EXISTS `bank`;

CREATE TABLE `bank` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `is_deleted` smallint(1) DEFAULT '0',
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `bank` */

insert  into `bank`(`id`,`name`,`is_deleted`) values (1,'BDO',0),(2,'BPI',0),(3,'UnionBank',0);

/*Table structure for table `budget_per_week` */

DROP TABLE IF EXISTS `budget_per_week`;

CREATE TABLE `budget_per_week` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `budget` varchar(255) NOT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `budget_per_week` */

insert  into `budget_per_week`(`id`,`budget`) values (1,'1000003290');

/*Table structure for table `cash_request` */

DROP TABLE IF EXISTS `cash_request`;

CREATE TABLE `cash_request` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `request_by` bigint(20) NOT NULL,
  `journal_entry_no` bigint(20) DEFAULT NULL,
  `journal_id` bigint(20) DEFAULT NULL,
  `date_of_entry` date DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `status_id` bigint(20) DEFAULT '1',
  `approver_id` bigint(20) DEFAULT '0',
  `total_amount` varchar(255) DEFAULT NULL,
  `journal_details_id` varchar(255) DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `cash_request` */

insert  into `cash_request`(`id`,`request_by`,`journal_entry_no`,`journal_id`,`date_of_entry`,`description`,`status_id`,`approver_id`,`total_amount`,`journal_details_id`) values (2,1,17111,16,'2017-11-01','test',2,17,'123','250'),(3,1,17112,16,'2017-11-23','test',4,3,'100000000','252');

/*Table structure for table `collateral_code` */

DROP TABLE IF EXISTS `collateral_code`;

CREATE TABLE `collateral_code` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) NOT NULL,
  `desc` varchar(255) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `collateral_code` */

insert  into `collateral_code`(`id`,`code`,`desc`,`is_deleted`) values (1,'CC1','Collateral Code 1',0),(2,'CC2','Collateral Code 2',0),(3,'a','a',1);

/*Table structure for table `credit_facility` */

DROP TABLE IF EXISTS `credit_facility`;

CREATE TABLE `credit_facility` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `credit_facility` */

insert  into `credit_facility`(`id`,`code`,`name`,`is_deleted`) values (1,'CF1','CF1',0),(2,'CF2','CF2',0),(3,'a','a',1);

/*Table structure for table `department` */

DROP TABLE IF EXISTS `department`;

CREATE TABLE `department` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `department_name` varchar(255) NOT NULL,
  `allowance` varchar(255) DEFAULT NULL,
  `department_head_id` bigint(20) DEFAULT NULL,
  `is_deleted` smallint(2) DEFAULT '0',
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

/*Data for the table `department` */

insert  into `department`(`id`,`department_name`,`allowance`,`department_head_id`,`is_deleted`) values (1,'BA','5000',5,0),(2,'PRODCOM','4000',4,0),(3,'SALES','111',16,0),(4,'test3','12',4,1),(5,'test','1',17,1),(6,'test4','1223',4,1),(7,'HR','3000',3,0),(8,'16262526ss','213123',2,1),(9,'1','213123',3,1),(10,'1233','1223',4,1),(11,'we45','1223',2,1),(12,'sadsd','1223',5,1),(13,'jeje','.12',6,1),(14,'test1234','.9',6,1),(15,'wwq','2313',2,1),(16,'yu','678',6,1);

/*Table structure for table `finance_approver` */

DROP TABLE IF EXISTS `finance_approver`;

CREATE TABLE `finance_approver` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `finance_approver` */

insert  into `finance_approver`(`id`,`user_id`) values (1,17);

/*Table structure for table `journal_details` */

DROP TABLE IF EXISTS `journal_details`;

CREATE TABLE `journal_details` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `account_id` bigint(20) DEFAULT NULL,
  `journal_entry_no` bigint(20) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `is_debit` tinyint(4) DEFAULT NULL,
  `bank_name` varchar(255) DEFAULT NULL,
  `chq_number` varchar(255) DEFAULT NULL,
  `desc` varchar(255) DEFAULT NULL,
  `request_by` smallint(1) DEFAULT NULL,
  `date_of_entry` date DEFAULT NULL,
  `status_id` smallint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=253 DEFAULT CHARSET=latin1;

/*Data for the table `journal_details` */

insert  into `journal_details`(`id`,`account_id`,`journal_entry_no`,`amount`,`is_debit`,`bank_name`,`chq_number`,`desc`,`request_by`,`date_of_entry`,`status_id`) values (247,1001,17111,14111,1,'','','test',17,'2017-11-23',1),(248,1002,17111,14111,0,'','','TESt',17,'2017-11-23',2),(249,1005,17111,123,1,'','','test',1,'2017-11-01',1),(250,1002,17111,123,0,'','','rty',1,'2017-11-01',2),(251,1001,17112,100000000,1,'','','test',1,'2017-11-23',1),(252,1001,17112,100000000,0,'','','test',1,'2017-11-23',1);

/*Table structure for table `journal_entries` */

DROP TABLE IF EXISTS `journal_entries`;

CREATE TABLE `journal_entries` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `journal_entry_no` bigint(20) NOT NULL,
  `journal_id` int(11) NOT NULL,
  `date_of_entry` date NOT NULL,
  `description` varchar(100) NOT NULL,
  `request_by` smallint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=latin1;

/*Data for the table `journal_entries` */

insert  into `journal_entries`(`id`,`journal_entry_no`,`journal_id`,`date_of_entry`,`description`,`request_by`) values (50,17111,15,'2017-11-30','TEst',NULL),(51,17111,16,'2017-11-01','test',NULL);

/*Table structure for table `journals` */

DROP TABLE IF EXISTS `journals`;

CREATE TABLE `journals` (
  `journal_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `journal_date` date DEFAULT NULL,
  `description` longtext,
  `ledger_id` bigint(20) DEFAULT NULL,
  `is_archived` int(2) NOT NULL,
  PRIMARY KEY (`journal_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

/*Data for the table `journals` */

insert  into `journals`(`journal_id`,`journal_date`,`description`,`ledger_id`,`is_archived`) values (15,'1930-02-03','TEST JOURNAL 123',0,0),(16,'1901-02-03','test\r\nwest',0,0),(17,'2017-12-01','test234',0,0),(18,'2017-12-02','test567\r\n',0,0),(19,'2017-12-07','tesrtsjd',0,0);

/*Table structure for table `ledgers` */

DROP TABLE IF EXISTS `ledgers`;

CREATE TABLE `ledgers` (
  `ledger_id` bigint(20) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `is_archive` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`ledger_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `ledgers` */

/*Table structure for table `loan_approval_type` */

DROP TABLE IF EXISTS `loan_approval_type`;

CREATE TABLE `loan_approval_type` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `is_deleted` smallint(1) DEFAULT '0',
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `loan_approval_type` */

insert  into `loan_approval_type`(`id`,`code`,`name`,`is_deleted`) values (1,'AO','Add - On',0),(2,'IALS','In-Arrears Lump Sum',0),(3,'IAA','In-Arrears Annuity',0),(4,'TD','True Discount',0);

/*Table structure for table `loan_list` */

DROP TABLE IF EXISTS `loan_list`;

CREATE TABLE `loan_list` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `app_type` varchar(255) NOT NULL,
  `app_no` varchar(255) NOT NULL,
  `client_no` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `spouse` varchar(255) NOT NULL,
  `loan_type_id` bigint(20) NOT NULL,
  `credit_fac_id` bigint(20) NOT NULL,
  `prod_line_id` bigint(20) NOT NULL,
  `mark_type_id` bigint(20) NOT NULL,
  `coll_code_id` bigint(20) NOT NULL,
  `bus_add` varchar(255) NOT NULL,
  `home_add` varchar(255) NOT NULL,
  `email_add` varchar(255) NOT NULL,
  `bus_tel` varchar(255) NOT NULL,
  `home_tel` varchar(255) NOT NULL,
  `pri_con` varchar(255) NOT NULL,
  `sec_con` varchar(255) NOT NULL,
  `applied_by` bigint(20) NOT NULL,
  `date_applied` date NOT NULL,
  `date_modified` date NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  `loan_status_id` bigint(20) DEFAULT '1',
  `is_approve` smallint(1) DEFAULT '0',
  `current_approver_id` bigint(20) DEFAULT NULL,
  `approve_type` smallint(1) DEFAULT '0',
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `loan_list` */

insert  into `loan_list`(`id`,`app_type`,`app_no`,`client_no`,`last_name`,`first_name`,`spouse`,`loan_type_id`,`credit_fac_id`,`prod_line_id`,`mark_type_id`,`coll_code_id`,`bus_add`,`home_add`,`email_add`,`bus_tel`,`home_tel`,`pri_con`,`sec_con`,`applied_by`,`date_applied`,`date_modified`,`is_deleted`,`loan_status_id`,`is_approve`,`current_approver_id`,`approve_type`) values (1,'new','1','1','Tumanda','Jay','',1,1,1,1,1,'Makati','Taguig     ','jay@gmail.com','123','123','123','123',1,'2018-03-19','2018-03-19',0,1,0,NULL,0),(4,'','12321','213','wew','wew','wew',1,2,1,1,1,'wew','wwew','wew@gmail.com','wwew','qweqw','wqewq','wqe',1,'2018-03-31','2018-04-01',0,1,1,1,1);

/*Table structure for table `loan_status` */

DROP TABLE IF EXISTS `loan_status`;

CREATE TABLE `loan_status` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `is_deleted` smallint(1) DEFAULT '0',
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `loan_status` */

insert  into `loan_status`(`id`,`name`,`is_deleted`) values (1,'On-going',0),(2,'Marketing',0),(3,'For CI',0),(4,'Credit Checking',0),(5,'Checklist Update',0),(6,'Collateral Update',0),(7,'Instruction Sheet',0),(8,'Recommendation of Application',0),(9,'Legal',0),(10,'Collection',0),(11,'Accounting',0);

/*Table structure for table `loan_types` */

DROP TABLE IF EXISTS `loan_types`;

CREATE TABLE `loan_types` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `loan_types` */

insert  into `loan_types`(`id`,`code`,`name`,`is_deleted`) values (1,'L1','Salary Loan',0),(2,'L2','Student Loan',0),(4,'w','w',1),(5,'wew','wew',1),(6,'a','a',1);

/*Table structure for table `marketing_type` */

DROP TABLE IF EXISTS `marketing_type`;

CREATE TABLE `marketing_type` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `marketing_type` */

insert  into `marketing_type`(`id`,`code`,`name`,`is_deleted`) values (1,'MT1','Marketing Type 1',0),(2,'MT2','Marketing Type 2',0),(3,'a','a',1);

/*Table structure for table `official_receipt` */

DROP TABLE IF EXISTS `official_receipt`;

CREATE TABLE `official_receipt` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `client_id` bigint(20) DEFAULT NULL,
  `payment_type_id` bigint(20) DEFAULT NULL,
  `bank_id` bigint(20) DEFAULT NULL,
  `check_no` varchar(255) DEFAULT NULL,
  `details` varchar(255) DEFAULT NULL,
  `deposit_date` varchar(255) DEFAULT NULL,
  `cash` varchar(255) DEFAULT NULL,
  `cheque` varchar(255) DEFAULT NULL,
  `total` varchar(255) DEFAULT NULL,
  `is_deleted` smallint(1) DEFAULT '0',
  `date` varchar(255) DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

/*Data for the table `official_receipt` */

insert  into `official_receipt`(`id`,`client_id`,`payment_type_id`,`bank_id`,`check_no`,`details`,`deposit_date`,`cash`,`cheque`,`total`,`is_deleted`,`date`) values (23,4,1,1,'test','test','04/07/2018','22','22','44',0,'2018-04-05'),(24,4,2,2,'1234','test details','04/05/2018','4300','7000','11300 PHP',0,'2018-04-05'),(25,4,2,2,'1234','test details 2','04/05/2018','4300','3000','7300 PHP',0,'2018-04-05'),(26,4,1,3,'69','YAJ TUMANDA','04/05/2018','6969','6969','13938 PHP',0,'2018-04-05');

/*Table structure for table `payment_type` */

DROP TABLE IF EXISTS `payment_type`;

CREATE TABLE `payment_type` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `is_deleted` smallint(1) DEFAULT '0',
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `payment_type` */

insert  into `payment_type`(`id`,`name`,`is_deleted`) values (1,'Loan Receivables',0),(2,'Others',0);

/*Table structure for table `product_line` */

DROP TABLE IF EXISTS `product_line`;

CREATE TABLE `product_line` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `product_line` */

insert  into `product_line`(`id`,`code`,`name`,`is_deleted`) values (1,'PL1','Product Line 11',0),(2,'PL2','Product Line 2',0),(3,'a','a',1);

/*Table structure for table `query_message` */

DROP TABLE IF EXISTS `query_message`;

CREATE TABLE `query_message` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `sender_id` bigint(20) NOT NULL,
  `receiver_id` bigint(20) DEFAULT NULL,
  `date_sent` datetime DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `query_id` bigint(20) DEFAULT NULL,
  `read` smallint(1) DEFAULT '0',
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

/*Data for the table `query_message` */

insert  into `query_message`(`id`,`sender_id`,`receiver_id`,`date_sent`,`subject`,`message`,`query_id`,`read`) values (32,1,17,'2017-11-20 17:48:49',NULL,'wew',171,1),(33,5,17,'2017-11-20 17:49:05',NULL,'huyyyyyy',175,1),(34,17,1,'2017-11-20 17:49:17',NULL,'po',171,1),(35,5,17,'2017-11-20 22:33:51',NULL,'wew',175,1),(36,17,5,'2017-11-20 22:34:01',NULL,'oh?\r\n',175,0),(37,1,17,'2017-11-22 10:05:53',NULL,'Hahahha\r\n',171,1),(38,1,17,'2017-11-22 10:05:53',NULL,'Hahahha',171,1),(39,1,17,'2017-11-23 10:45:41',NULL,'huy',171,1),(40,1,17,'2017-11-23 10:45:47',NULL,'huy\r\n',171,1);

/*Table structure for table `request_status` */

DROP TABLE IF EXISTS `request_status`;

CREATE TABLE `request_status` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `request_name` varchar(255) NOT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `request_status` */

insert  into `request_status`(`id`,`request_name`) values (1,'Pending'),(2,'Approved'),(3,'Rejected'),(4,'Cancelled');

/*Table structure for table `security_question` */

DROP TABLE IF EXISTS `security_question`;

CREATE TABLE `security_question` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `security_question` varchar(255) DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `security_question` */

/*Table structure for table `user_type` */

DROP TABLE IF EXISTS `user_type`;

CREATE TABLE `user_type` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `is_deleted` smallint(1) DEFAULT '0',
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `user_type` */

insert  into `user_type`(`id`,`name`,`is_deleted`) values (1,'Administrator',0),(2,'Accounting',0),(3,'Executive',0),(4,'Department Head',0);

/*Table structure for table `user_types` */

DROP TABLE IF EXISTS `user_types`;

CREATE TABLE `user_types` (
  `user_type_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_type` varchar(255) DEFAULT NULL,
  `is_deleted` smallint(1) DEFAULT '0',
  KEY `id` (`user_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `user_types` */

insert  into `user_types`(`user_type_id`,`user_type`,`is_deleted`) values (1,'Administrator',0),(2,'Accounting',0);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `user_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) DEFAULT NULL,
  `middle_initial` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `password` longtext,
  `user_type_id` varchar(50) DEFAULT NULL,
  `is_active` smallint(1) DEFAULT '1',
  `is_login` smallint(1) NOT NULL DEFAULT '0',
  `department_id` smallint(1) DEFAULT '1',
  `question_id` smallint(1) DEFAULT NULL,
  `answer` varchar(255) DEFAULT NULL,
  `is_deleted` smallint(1) DEFAULT '0',
  `last_activity` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `users` */

insert  into `users`(`user_id`,`first_name`,`middle_initial`,`last_name`,`password`,`user_type_id`,`is_active`,`is_login`,`department_id`,`question_id`,`answer`,`is_deleted`,`last_activity`,`username`) values (1,'CJAY','D.','CONOCONO','TNTz0EXkSq4dC+kr8w8+UF14gOTFdx6RSEJpaGwQ7v4=','1',1,1,0,1,'test2',0,'2018-04-05 08:34:15','admin'),(2,'Yaj','','Adnamut','RiNRg2U/vFz+uMySogP8cHORVGXXIr5xcnXHJI9jYuY=','1',1,0,1,NULL,NULL,0,NULL,'yajadnamut');

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
=======
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

/*Table structure for table `account_types` */

DROP TABLE IF EXISTS `account_types`;

CREATE TABLE `account_types` (
  `acc_types_id` bigint(20) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `inc_when_debit` int(2) NOT NULL,
  PRIMARY KEY (`acc_types_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `account_types` */

insert  into `account_types`(`acc_types_id`,`name`,`inc_when_debit`) values 
(1,'Revenue(Main)',0),
(2,'Revenue(Side)',0),
(3,'Expenses',1),
(4,'Assets(Non-Current)',1),
(5,'Assets(Current)',1),
(6,'Liabilities(Current)',0),
(7,'Liabilities(Non-Current)',0),
(8,'Owner\'s Equity (Capital)',0),
(9,'Owner\'s Equity (Drawing)',0),
(10,'Contra (Current Assets)',0),
(11,'Non-Current Asset',0);

/*Table structure for table `accounts` */

DROP TABLE IF EXISTS `accounts`;

CREATE TABLE `accounts` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `acc_id` varchar(255) NOT NULL,
  `account_name` longtext,
  `type` int(11) DEFAULT NULL,
  `is_deleted` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`acc_id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

/*Data for the table `accounts` */

insert  into `accounts`(`id`,`acc_id`,`account_name`,`type`,`is_deleted`) values 
(1,'0','wew',2,0),
(2,'1001','Cash',5,0),
(3,'1002','Petty Cash',5,0),
(4,'1003','Accounts Recievable',5,0),
(5,'1004','Notes Receivable',5,0),
(6,'1005','Allowance for Bad Debts',5,0),
(7,'1006','Merchandise Inventory',5,0),
(8,'1007','Supplies Unused',5,0),
(9,'1008','Prepaid Insurance',5,0),
(10,'1009','Furnitures and Fixtures',4,0),
(11,'1010','Accu. Depreciation-F&F',4,0),
(12,'1011','Equipment',4,0),
(13,'1012','Accu. deprecaition-Equip.',4,0),
(14,'1013','Land',4,0),
(15,'1014','Building',4,0),
(16,'1015','Accu. Depreciation-Bldg',4,0),
(17,'123','One',6,0),
(18,'2001','Accounts Payable',6,0),
(19,'222222','CJAY TEST',1,0),
(20,'3001','Salaries Expenses',3,0),
(21,'3002','Utilities Expenses',3,0),
(22,'3003','Supplies Expense',3,0),
(23,'3004','Rent Expense',3,0),
(24,'3435','bully',7,0),
(25,'34578','game',6,0),
(26,'34fgg','sfdfds',6,0),
(27,'4001','Accounts Payable',6,0),
(28,'5001','Service',2,0),
(29,'5002','Sales',5,0),
(30,'6001','Mr. X Capital',8,0),
(31,'6002','MrM',9,0),
(32,'7900','Test',11,0),
(33,'9999','Test Income',1,0),
(34,'ASD','ASD',1,0),
(38,'CJAY','xcvfb',7,0),
(35,'CJAY CONOCONO','CJAY CONOCONO wew',2,0),
(36,'CJAY1996','CJAY',2,0),
(37,'qwdqd44546','fghfhg',3,1),
(39,'`er','ert',3,0);

/*Table structure for table `additional_cash` */

DROP TABLE IF EXISTS `additional_cash`;

CREATE TABLE `additional_cash` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `amount` varchar(255) NOT NULL,
  `year` varchar(255) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `additional_cash` */

insert  into `additional_cash`(`id`,`amount`,`year`,`is_deleted`) values 
(1,'111','2017',0);

/*Table structure for table `approval_flow` */

DROP TABLE IF EXISTS `approval_flow`;

CREATE TABLE `approval_flow` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=327 DEFAULT CHARSET=latin1;

/*Data for the table `approval_flow` */

insert  into `approval_flow`(`id`,`user_id`) values 
(324,1),
(325,3),
(326,13);

/*Table structure for table `available_balance` */

DROP TABLE IF EXISTS `available_balance`;

CREATE TABLE `available_balance` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `amount` varchar(255) NOT NULL,
  `year` varchar(255) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `available_balance` */

insert  into `available_balance`(`id`,`amount`,`year`,`is_deleted`) values 
(1,'700','2017',0),
(3,'354','2018',0),
(4,'1','1',0);

/*Table structure for table `budget_per_week` */

DROP TABLE IF EXISTS `budget_per_week`;

CREATE TABLE `budget_per_week` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `budget` varchar(255) NOT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `budget_per_week` */

insert  into `budget_per_week`(`id`,`budget`) values 
(1,'1000003290');

/*Table structure for table `cash_request` */

DROP TABLE IF EXISTS `cash_request`;

CREATE TABLE `cash_request` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `request_by` bigint(20) NOT NULL,
  `journal_entry_no` bigint(20) DEFAULT NULL,
  `journal_id` bigint(20) DEFAULT NULL,
  `date_of_entry` date DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `status_id` bigint(20) DEFAULT '1',
  `approver_id` bigint(20) DEFAULT '0',
  `total_amount` varchar(255) DEFAULT NULL,
  `journal_details_id` varchar(255) DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `cash_request` */

insert  into `cash_request`(`id`,`request_by`,`journal_entry_no`,`journal_id`,`date_of_entry`,`description`,`status_id`,`approver_id`,`total_amount`,`journal_details_id`) values 
(2,1,17111,16,'2017-11-01','test',2,17,'123','250'),
(3,1,17112,16,'2017-11-23','test',4,3,'100000000','252');

/*Table structure for table `collateral_code` */

DROP TABLE IF EXISTS `collateral_code`;

CREATE TABLE `collateral_code` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) NOT NULL,
  `desc` varchar(255) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `collateral_code` */

insert  into `collateral_code`(`id`,`code`,`desc`,`is_deleted`) values 
(1,'CC1','Collateral Code 1',0),
(2,'CC2','Collateral Code 2',0);

/*Table structure for table `credit_facility` */

DROP TABLE IF EXISTS `credit_facility`;

CREATE TABLE `credit_facility` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `credit_facility` */

insert  into `credit_facility`(`id`,`code`,`name`,`is_deleted`) values 
(1,'CF1','CF1',0),
(2,'CF2','CF2',0);

/*Table structure for table `department` */

DROP TABLE IF EXISTS `department`;

CREATE TABLE `department` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `department_name` varchar(255) NOT NULL,
  `allowance` varchar(255) DEFAULT NULL,
  `department_head_id` bigint(20) DEFAULT NULL,
  `is_deleted` smallint(2) DEFAULT '0',
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

/*Data for the table `department` */

insert  into `department`(`id`,`department_name`,`allowance`,`department_head_id`,`is_deleted`) values 
(1,'BA','5000',5,0),
(2,'PRODCOM','4000',4,0),
(3,'SALES','111',16,0),
(4,'test3','12',4,1),
(5,'test','1',17,1),
(6,'test4','1223',4,1),
(7,'HR','3000',3,0),
(8,'16262526ss','213123',2,1),
(9,'1','213123',3,1),
(10,'1233','1223',4,1),
(11,'we45','1223',2,1),
(12,'sadsd','1223',5,1),
(13,'jeje','.12',6,1),
(14,'test1234','.9',6,1),
(15,'wwq','2313',2,1),
(16,'yu','678',6,1);

/*Table structure for table `finance_approver` */

DROP TABLE IF EXISTS `finance_approver`;

CREATE TABLE `finance_approver` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `finance_approver` */

insert  into `finance_approver`(`id`,`user_id`) values 
(1,17);

/*Table structure for table `journal_details` */

DROP TABLE IF EXISTS `journal_details`;

CREATE TABLE `journal_details` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `account_id` bigint(20) DEFAULT NULL,
  `journal_entry_no` bigint(20) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `is_debit` tinyint(4) DEFAULT NULL,
  `bank_name` varchar(255) DEFAULT NULL,
  `chq_number` varchar(255) DEFAULT NULL,
  `desc` varchar(255) DEFAULT NULL,
  `request_by` smallint(1) DEFAULT NULL,
  `date_of_entry` date DEFAULT NULL,
  `status_id` smallint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=253 DEFAULT CHARSET=latin1;

/*Data for the table `journal_details` */

insert  into `journal_details`(`id`,`account_id`,`journal_entry_no`,`amount`,`is_debit`,`bank_name`,`chq_number`,`desc`,`request_by`,`date_of_entry`,`status_id`) values 
(247,1001,17111,14111,1,'','','test',17,'2017-11-23',1),
(248,1002,17111,14111,0,'','','TESt',17,'2017-11-23',2),
(249,1005,17111,123,1,'','','test',1,'2017-11-01',1),
(250,1002,17111,123,0,'','','rty',1,'2017-11-01',2),
(251,1001,17112,100000000,1,'','','test',1,'2017-11-23',1),
(252,1001,17112,100000000,0,'','','test',1,'2017-11-23',1);

/*Table structure for table `journal_entries` */

DROP TABLE IF EXISTS `journal_entries`;

CREATE TABLE `journal_entries` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `journal_entry_no` bigint(20) NOT NULL,
  `journal_id` int(11) NOT NULL,
  `date_of_entry` date NOT NULL,
  `description` varchar(100) NOT NULL,
  `request_by` smallint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=latin1;

/*Data for the table `journal_entries` */

insert  into `journal_entries`(`id`,`journal_entry_no`,`journal_id`,`date_of_entry`,`description`,`request_by`) values 
(50,17111,15,'2017-11-30','TEst',NULL),
(51,17111,16,'2017-11-01','test',NULL);

/*Table structure for table `journals` */

DROP TABLE IF EXISTS `journals`;

CREATE TABLE `journals` (
  `journal_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `journal_date` date DEFAULT NULL,
  `description` longtext,
  `ledger_id` bigint(20) DEFAULT NULL,
  `is_archived` int(2) NOT NULL,
  PRIMARY KEY (`journal_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

/*Data for the table `journals` */

insert  into `journals`(`journal_id`,`journal_date`,`description`,`ledger_id`,`is_archived`) values 
(15,'1930-02-03','TEST JOURNAL 123',0,0),
(16,'1901-02-03','test\r\nwest',0,0),
(17,'2017-12-01','test234',0,0),
(18,'2017-12-02','test567\r\n',0,0),
(19,'2017-12-07','tesrtsjd',0,0);

/*Table structure for table `ledgers` */

DROP TABLE IF EXISTS `ledgers`;

CREATE TABLE `ledgers` (
  `ledger_id` bigint(20) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `is_archive` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`ledger_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `ledgers` */

/*Table structure for table `loan_approval_type` */

DROP TABLE IF EXISTS `loan_approval_type`;

CREATE TABLE `loan_approval_type` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `is_deleted` smallint(1) DEFAULT '0',
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `loan_approval_type` */

insert  into `loan_approval_type`(`id`,`code`,`name`,`is_deleted`) values 
(1,'AO','Add - On',0),
(2,'IALS','In-Arrears Lump Sum',0),
(3,'IAA','In-Arrears Annuity',0),
(4,'TD','True Discount',0);

/*Table structure for table `loan_list` */

DROP TABLE IF EXISTS `loan_list`;

CREATE TABLE `loan_list` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `app_type` varchar(255) NOT NULL,
  `app_no` varchar(255) NOT NULL,
  `client_no` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `spouse` varchar(255) NOT NULL,
  `loan_type_id` bigint(20) NOT NULL,
  `credit_fac_id` bigint(20) NOT NULL,
  `prod_line_id` bigint(20) NOT NULL,
  `mark_type_id` bigint(20) NOT NULL,
  `coll_code_id` bigint(20) NOT NULL,
  `bus_add` varchar(255) NOT NULL,
  `home_add` varchar(255) NOT NULL,
  `email_add` varchar(255) NOT NULL,
  `bus_tel` varchar(255) NOT NULL,
  `home_tel` varchar(255) NOT NULL,
  `pri_con` varchar(255) NOT NULL,
  `sec_con` varchar(255) NOT NULL,
  `applied_by` bigint(20) NOT NULL,
  `date_applied` date NOT NULL,
  `date_modified` date NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  `loan_status_id` bigint(20) DEFAULT '1',
  `is_approve` smallint(1) DEFAULT '0',
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `loan_list` */

insert  into `loan_list`(`id`,`app_type`,`app_no`,`client_no`,`last_name`,`first_name`,`spouse`,`loan_type_id`,`credit_fac_id`,`prod_line_id`,`mark_type_id`,`coll_code_id`,`bus_add`,`home_add`,`email_add`,`bus_tel`,`home_tel`,`pri_con`,`sec_con`,`applied_by`,`date_applied`,`date_modified`,`is_deleted`,`loan_status_id`,`is_approve`) values 
(1,'new','1','1','Tumanda','Jay','',1,1,1,1,1,'Makati City','Taguig     ','jay@gmail.com','123','123','123','123',1,'2018-03-19','2018-04-01',0,2,0);

/*Table structure for table `loan_status` */

DROP TABLE IF EXISTS `loan_status`;

CREATE TABLE `loan_status` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `is_deleted` smallint(1) DEFAULT '0',
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `loan_status` */

insert  into `loan_status`(`id`,`name`,`is_deleted`) values 
(1,'On-going',0),
(2,'Marketing',0),
(3,'For CI',0),
(4,'Credit Checking',0),
(5,'Checklist Update',0),
(6,'Collateral Update',0),
(7,'Instruction Sheet',0),
(8,'Recommendation of Application',0),
(9,'Legal',0),
(10,'Collection',0),
(11,'Accounting',0);

/*Table structure for table `loan_types` */

DROP TABLE IF EXISTS `loan_types`;

CREATE TABLE `loan_types` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `loan_types` */

insert  into `loan_types`(`id`,`code`,`name`,`is_deleted`) values 
(1,'L1','Salary Loan',0),
(2,'L2','Student Loan',0);

/*Table structure for table `marketing_type` */

DROP TABLE IF EXISTS `marketing_type`;

CREATE TABLE `marketing_type` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `marketing_type` */

insert  into `marketing_type`(`id`,`code`,`name`,`is_deleted`) values 
(1,'MT1','Marketing Type 1',0),
(2,'MT2','Marketing Type 2',0);

/*Table structure for table `product_line` */

DROP TABLE IF EXISTS `product_line`;

CREATE TABLE `product_line` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `product_line` */

insert  into `product_line`(`id`,`code`,`name`,`is_deleted`) values 
(1,'PL1','Product Line 1',0),
(2,'PL2','Product Line 2',0);

/*Table structure for table `query_message` */

DROP TABLE IF EXISTS `query_message`;

CREATE TABLE `query_message` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `sender_id` bigint(20) NOT NULL,
  `receiver_id` bigint(20) DEFAULT NULL,
  `date_sent` datetime DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `query_id` bigint(20) DEFAULT NULL,
  `read` smallint(1) DEFAULT '0',
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

/*Data for the table `query_message` */

insert  into `query_message`(`id`,`sender_id`,`receiver_id`,`date_sent`,`subject`,`message`,`query_id`,`read`) values 
(32,1,17,'2017-11-20 17:48:49',NULL,'wew',171,1),
(33,5,17,'2017-11-20 17:49:05',NULL,'huyyyyyy',175,1),
(34,17,1,'2017-11-20 17:49:17',NULL,'po',171,1),
(35,5,17,'2017-11-20 22:33:51',NULL,'wew',175,1),
(36,17,5,'2017-11-20 22:34:01',NULL,'oh?\r\n',175,0),
(37,1,17,'2017-11-22 10:05:53',NULL,'Hahahha\r\n',171,1),
(38,1,17,'2017-11-22 10:05:53',NULL,'Hahahha',171,1),
(39,1,17,'2017-11-23 10:45:41',NULL,'huy',171,1),
(40,1,17,'2017-11-23 10:45:47',NULL,'huy\r\n',171,1);

/*Table structure for table `request_status` */

DROP TABLE IF EXISTS `request_status`;

CREATE TABLE `request_status` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `request_name` varchar(255) NOT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `request_status` */

insert  into `request_status`(`id`,`request_name`) values 
(1,'Pending'),
(2,'Approved'),
(3,'Rejected'),
(4,'Cancelled');

/*Table structure for table `security_question` */

DROP TABLE IF EXISTS `security_question`;

CREATE TABLE `security_question` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `security_question` varchar(255) DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `security_question` */

/*Table structure for table `user_type` */

DROP TABLE IF EXISTS `user_type`;

CREATE TABLE `user_type` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `is_deleted` smallint(1) DEFAULT '0',
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `user_type` */

insert  into `user_type`(`id`,`name`,`is_deleted`) values 
(1,'Administrator',0),
(2,'Accounting',0),
(3,'Executive',0),
(4,'Department Head',0);

/*Table structure for table `user_types` */

DROP TABLE IF EXISTS `user_types`;

CREATE TABLE `user_types` (
  `user_type_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_type` varchar(255) DEFAULT NULL,
  `is_deleted` smallint(1) DEFAULT '0',
  KEY `id` (`user_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `user_types` */

insert  into `user_types`(`user_type_id`,`user_type`,`is_deleted`) values 
(1,'Administrator',0),
(2,'Accounting',0),
(3,'Marketing',0),
(4,'CI',0);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `user_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) DEFAULT NULL,
  `middle_initial` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `password` longtext,
  `user_type_id` varchar(50) DEFAULT NULL,
  `is_active` smallint(1) DEFAULT '1',
  `is_login` smallint(1) NOT NULL DEFAULT '0',
  `department_id` smallint(1) DEFAULT '1',
  `question_id` smallint(1) DEFAULT NULL,
  `answer` varchar(255) DEFAULT NULL,
  `is_deleted` smallint(1) DEFAULT '0',
  `last_activity` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `users` */

insert  into `users`(`user_id`,`first_name`,`middle_initial`,`last_name`,`password`,`user_type_id`,`is_active`,`is_login`,`department_id`,`question_id`,`answer`,`is_deleted`,`last_activity`,`username`) values 
(1,'CJAY','D.','CONOCONO','TNTz0EXkSq4dC+kr8w8+UF14gOTFdx6RSEJpaGwQ7v4=','1',1,1,0,1,'test2',0,'2018-04-04 22:31:17','admin');

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
>>>>>>> dev-wilfred
