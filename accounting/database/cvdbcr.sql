/*
SQLyog Community v12.4.3 (64 bit)
MySQL - 5.1.42-community 
*********************************************************************
*/
/*!40101 SET NAMES utf8 */;

create table `cheque_dbcr` (
	`cntrct_id` int (255),
	`cv_id` int (255),
	`cd` int (255),
	`acc_code` int (255),
	`debit_amount` varchar (765),
	`credit_amount` varchar (765),
	`clnt_id` int (255),
	`isDeleted` tinyint (1)
); 
insert into `cheque_dbcr` (`cntrct_id`, `cv_id`, `cd`, `acc_code`, `debit_amount`, `credit_amount`, `clnt_id`, `isDeleted`) values('140','200001',NULL,'123','10000','0','1','0');
insert into `cheque_dbcr` (`cntrct_id`, `cv_id`, `cd`, `acc_code`, `debit_amount`, `credit_amount`, `clnt_id`, `isDeleted`) values('141','200001',NULL,'123','0','5000','7','0');
insert into `cheque_dbcr` (`cntrct_id`, `cv_id`, `cd`, `acc_code`, `debit_amount`, `credit_amount`, `clnt_id`, `isDeleted`) values('142','200001',NULL,'123','0','5000','2','0');
