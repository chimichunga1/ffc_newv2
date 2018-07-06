/*
SQLyog Community v12.4.3 (64 bit)
MySQL - 5.1.42-community 
*********************************************************************
*/
/*!40101 SET NAMES utf8 */;

create table `journal_dbcr` (
	`jv_id` int (255),
	`jv_no` int (255),
	`acc_no` int (255),
	`cd` int (255),
	`acc_code` int (255),
	`debit_amount` int (255),
	`credit_amount` int (255),
	`clnt_id` int (255),
	`isDeleted` tinyint (1)
); 
insert into `journal_dbcr` (`jv_id`, `jv_no`, `acc_no`, `cd`, `acc_code`, `debit_amount`, `credit_amount`, `clnt_id`, `isDeleted`) values('15','100010','0',NULL,'5','100000','0','1','0');
insert into `journal_dbcr` (`jv_id`, `jv_no`, `acc_no`, `cd`, `acc_code`, `debit_amount`, `credit_amount`, `clnt_id`, `isDeleted`) values('16','100010','0',NULL,'13','0','90000','7','0');
insert into `journal_dbcr` (`jv_id`, `jv_no`, `acc_no`, `cd`, `acc_code`, `debit_amount`, `credit_amount`, `clnt_id`, `isDeleted`) values('17','100010','0',NULL,'14','0','10000','2','0');
insert into `journal_dbcr` (`jv_id`, `jv_no`, `acc_no`, `cd`, `acc_code`, `debit_amount`, `credit_amount`, `clnt_id`, `isDeleted`) values('18','100013','0',NULL,'13','0','156800','1','0');
insert into `journal_dbcr` (`jv_id`, `jv_no`, `acc_no`, `cd`, `acc_code`, `debit_amount`, `credit_amount`, `clnt_id`, `isDeleted`) values('19','100013','0',NULL,'5','156800','0','1','0');
insert into `journal_dbcr` (`jv_id`, `jv_no`, `acc_no`, `cd`, `acc_code`, `debit_amount`, `credit_amount`, `clnt_id`, `isDeleted`) values('20','100014','0',NULL,'5','222410','0','2','0');
insert into `journal_dbcr` (`jv_id`, `jv_no`, `acc_no`, `cd`, `acc_code`, `debit_amount`, `credit_amount`, `clnt_id`, `isDeleted`) values('21','100014','0',NULL,'14','0','222410','2','0');
