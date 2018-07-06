/*
SQLyog Community v12.4.3 (64 bit)
MySQL - 5.1.42-community 
*********************************************************************
*/
/*!40101 SET NAMES utf8 */;

create table `cheque_vld` (
	`cntrct_id` int (255),
	`cv_id` int (255),
	`clnt_id` int (255),
	`bank_id` int (255),
	`amount` varchar (765),
	`isDeleted` tinyint (1)
); 
insert into `cheque_vld` (`cntrct_id`, `cv_id`, `clnt_id`, `bank_id`, `amount`, `isDeleted`) values('11','200001','1','3','10000','0');
