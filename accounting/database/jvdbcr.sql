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
	`debit_amount` varchar (765),
	`credit_amount` varchar (765),
	`clnt_id` int (255),
	`jv_v_id` int (255),
	`isDeleted` tinyint (1)
); 
insert into `journal_dbcr` (`jv_id`, `jv_no`, `acc_no`, `cd`, `acc_code`, `debit_amount`, `credit_amount`, `clnt_id`, `jv_v_id`, `isDeleted`) values('15','100010','0',NULL,'5','100000','0','1',NULL,'0');
insert into `journal_dbcr` (`jv_id`, `jv_no`, `acc_no`, `cd`, `acc_code`, `debit_amount`, `credit_amount`, `clnt_id`, `jv_v_id`, `isDeleted`) values('16','100010','0',NULL,'13','0','90000','7',NULL,'0');
insert into `journal_dbcr` (`jv_id`, `jv_no`, `acc_no`, `cd`, `acc_code`, `debit_amount`, `credit_amount`, `clnt_id`, `jv_v_id`, `isDeleted`) values('17','100010','0',NULL,'14','0','10000','2',NULL,'0');
insert into `journal_dbcr` (`jv_id`, `jv_no`, `acc_no`, `cd`, `acc_code`, `debit_amount`, `credit_amount`, `clnt_id`, `jv_v_id`, `isDeleted`) values('18','100013','0',NULL,'13','0','156800','1',NULL,'0');
insert into `journal_dbcr` (`jv_id`, `jv_no`, `acc_no`, `cd`, `acc_code`, `debit_amount`, `credit_amount`, `clnt_id`, `jv_v_id`, `isDeleted`) values('19','100013','0',NULL,'5','156800','0','1',NULL,'0');
insert into `journal_dbcr` (`jv_id`, `jv_no`, `acc_no`, `cd`, `acc_code`, `debit_amount`, `credit_amount`, `clnt_id`, `jv_v_id`, `isDeleted`) values('20','100014','0',NULL,'5','222410','0','2',NULL,'0');
insert into `journal_dbcr` (`jv_id`, `jv_no`, `acc_no`, `cd`, `acc_code`, `debit_amount`, `credit_amount`, `clnt_id`, `jv_v_id`, `isDeleted`) values('21','100014','0',NULL,'14','0','222410','2',NULL,'0');
insert into `journal_dbcr` (`jv_id`, `jv_no`, `acc_no`, `cd`, `acc_code`, `debit_amount`, `credit_amount`, `clnt_id`, `jv_v_id`, `isDeleted`) values('22','100015','0',NULL,'14','22000','0','7',NULL,'0');
insert into `journal_dbcr` (`jv_id`, `jv_no`, `acc_no`, `cd`, `acc_code`, `debit_amount`, `credit_amount`, `clnt_id`, `jv_v_id`, `isDeleted`) values('23','100015','0',NULL,'5','0','22000','7',NULL,'0');
insert into `journal_dbcr` (`jv_id`, `jv_no`, `acc_no`, `cd`, `acc_code`, `debit_amount`, `credit_amount`, `clnt_id`, `jv_v_id`, `isDeleted`) values('24','902314','1',NULL,'14','1000','0','1','19','0');
insert into `journal_dbcr` (`jv_id`, `jv_no`, `acc_no`, `cd`, `acc_code`, `debit_amount`, `credit_amount`, `clnt_id`, `jv_v_id`, `isDeleted`) values('25','902314','0',NULL,'5','0','1000','1','19','0');
insert into `journal_dbcr` (`jv_id`, `jv_no`, `acc_no`, `cd`, `acc_code`, `debit_amount`, `credit_amount`, `clnt_id`, `jv_v_id`, `isDeleted`) values('26','91111003','2',NULL,'15','5001','0','2','20','0');
insert into `journal_dbcr` (`jv_id`, `jv_no`, `acc_no`, `cd`, `acc_code`, `debit_amount`, `credit_amount`, `clnt_id`, `jv_v_id`, `isDeleted`) values('27','91111003','1',NULL,'5','0','5001','2','20','0');
insert into `journal_dbcr` (`jv_id`, `jv_no`, `acc_no`, `cd`, `acc_code`, `debit_amount`, `credit_amount`, `clnt_id`, `jv_v_id`, `isDeleted`) values('28','12312312','0',NULL,'163','1000.5','0','1','21','0');
insert into `journal_dbcr` (`jv_id`, `jv_no`, `acc_no`, `cd`, `acc_code`, `debit_amount`, `credit_amount`, `clnt_id`, `jv_v_id`, `isDeleted`) values('29','12312312','0',NULL,'5','0','1000.5','1','21','0');
insert into `journal_dbcr` (`jv_id`, `jv_no`, `acc_no`, `cd`, `acc_code`, `debit_amount`, `credit_amount`, `clnt_id`, `jv_v_id`, `isDeleted`) values('30','12','0',NULL,'151','0','50','1','22','0');
insert into `journal_dbcr` (`jv_id`, `jv_no`, `acc_no`, `cd`, `acc_code`, `debit_amount`, `credit_amount`, `clnt_id`, `jv_v_id`, `isDeleted`) values('31','12','0',NULL,'165','50','0','1','22','0');
