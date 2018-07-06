/*
SQLyog Community v12.4.3 (64 bit)
MySQL - 5.1.42-community 
*********************************************************************
*/
/*!40101 SET NAMES utf8 */;

create table `journal_voucher` (
	`jv_id` int (255),
	`jv_no` int (255),
	`clnt_id` int (255),
	`jv_date` date ,
	`details` text ,
	`isValidated` tinyint (1),
	`vldate` date ,
	`isDeleted` tinyint (1)
); 
insert into `journal_voucher` (`jv_id`, `jv_no`, `clnt_id`, `jv_date`, `details`, `isValidated`, `vldate`, `isDeleted`) values('13','100010','1','2018-05-17','for test','1','2018-05-20','0');
insert into `journal_voucher` (`jv_id`, `jv_no`, `clnt_id`, `jv_date`, `details`, `isValidated`, `vldate`, `isDeleted`) values('14','100013','1','2018-05-19','Jay','1','2018-05-20','0');
insert into `journal_voucher` (`jv_id`, `jv_no`, `clnt_id`, `jv_date`, `details`, `isValidated`, `vldate`, `isDeleted`) values('15','100014','2','2018-05-19','for tes','1','2018-05-20','0');
