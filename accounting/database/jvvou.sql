/*
SQLyog Community v12.4.3 (64 bit)
MySQL - 5.1.42-community 
*********************************************************************
*/
/*!40101 SET NAMES utf8 */;

create table `journal_voucher` (
	`jv_primary` int (255),
	`jv_id` int (255),
	`clnt_id` int (255),
	`jv_date` date ,
	`details` text ,
	`isDeleted` tinyint (1)
); 
insert into `journal_voucher` (`jv_primary`, `jv_id`, `clnt_id`, `jv_date`, `details`, `isDeleted`) values('6','200001','1','2018-05-13','1124124','0');
