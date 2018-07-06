/*
SQLyog Community v12.4.3 (64 bit)
MySQL - 5.1.42-community 
*********************************************************************
*/
/*!40101 SET NAMES utf8 */;

create table `cheque_dbcr` (
	`cv_id` int (255),
	`cv_no` int (255),
	`acc_no` int (255),
	`cd` int (255),
	`acc_code` int (255),
	`debit_amount` varchar (765),
	`credit_amount` varchar (765),
	`clnt_id` int (255),
	`isDeleted` tinyint (1)
); 
insert into `cheque_dbcr` (`cv_id`, `cv_no`, `acc_no`, `cd`, `acc_code`, `debit_amount`, `credit_amount`, `clnt_id`, `isDeleted`) values('181','100000','0',NULL,'14','3300','0','1','0');
insert into `cheque_dbcr` (`cv_id`, `cv_no`, `acc_no`, `cd`, `acc_code`, `debit_amount`, `credit_amount`, `clnt_id`, `isDeleted`) values('182','100000','0',NULL,'5','0','3300','2','0');
insert into `cheque_dbcr` (`cv_id`, `cv_no`, `acc_no`, `cd`, `acc_code`, `debit_amount`, `credit_amount`, `clnt_id`, `isDeleted`) values('183','100184','0',NULL,'10','248900','0','2','0');
insert into `cheque_dbcr` (`cv_id`, `cv_no`, `acc_no`, `cd`, `acc_code`, `debit_amount`, `credit_amount`, `clnt_id`, `isDeleted`) values('184','100184','0',NULL,'5','0','248900','7','0');
insert into `cheque_dbcr` (`cv_id`, `cv_no`, `acc_no`, `cd`, `acc_code`, `debit_amount`, `credit_amount`, `clnt_id`, `isDeleted`) values('185','100185','0',NULL,'13','7800','0','7','0');
insert into `cheque_dbcr` (`cv_id`, `cv_no`, `acc_no`, `cd`, `acc_code`, `debit_amount`, `credit_amount`, `clnt_id`, `isDeleted`) values('186','100185','0',NULL,'5','0','7800','2','0');
insert into `cheque_dbcr` (`cv_id`, `cv_no`, `acc_no`, `cd`, `acc_code`, `debit_amount`, `credit_amount`, `clnt_id`, `isDeleted`) values('187','100186','0',NULL,'0','90000','0','1','0');
insert into `cheque_dbcr` (`cv_id`, `cv_no`, `acc_no`, `cd`, `acc_code`, `debit_amount`, `credit_amount`, `clnt_id`, `isDeleted`) values('188','100186','0',NULL,'4','0','80000','2','0');
insert into `cheque_dbcr` (`cv_id`, `cv_no`, `acc_no`, `cd`, `acc_code`, `debit_amount`, `credit_amount`, `clnt_id`, `isDeleted`) values('189','100186','0',NULL,'4','0','10000','7','0');
