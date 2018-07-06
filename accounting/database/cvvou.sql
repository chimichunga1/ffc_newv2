/*
SQLyog Community v12.4.3 (64 bit)
MySQL - 5.1.42-community 
*********************************************************************
*/
/*!40101 SET NAMES utf8 */;

create table `cheque_voucher` (
	`cntrct_id` int (255),
	`cv_id` int (255),
	`amount` varchar (765),
	`details` text ,
	`clnt_id` int (255),
	`isValidated` tinyint (1),
	`isJournal` tinyint (1),
	`isDeleted` tinyint (1)
); 
insert into `cheque_voucher` (`cntrct_id`, `cv_id`, `amount`, `details`, `clnt_id`, `isValidated`, `isJournal`, `isDeleted`) values('166','200001','10000','For testing','1','1','1','0');
