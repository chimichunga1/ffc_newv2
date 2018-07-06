/*
SQLyog Community v12.4.3 (64 bit)
MySQL - 5.1.42-community 
*********************************************************************
*/
/*!40101 SET NAMES utf8 */;

create table `cheque_voucher` (
	`cv_id` int (255),
	`cv_no` int (255),
	`details` text ,
	`clnt_id` int (255),
	`isValidated` tinyint (1),
	`vldate` date ,
	`isDeleted` tinyint (1)
); 
insert into `cheque_voucher` (`cv_id`, `cv_no`, `details`, `clnt_id`, `isValidated`, `vldate`, `isDeleted`) values('184','100000','for test','1','1','2018-05-19','0');
insert into `cheque_voucher` (`cv_id`, `cv_no`, `details`, `clnt_id`, `isValidated`, `vldate`, `isDeleted`) values('185','100184','','2','1','2018-05-19','0');
insert into `cheque_voucher` (`cv_id`, `cv_no`, `details`, `clnt_id`, `isValidated`, `vldate`, `isDeleted`) values('186','100185','','7','1','2018-05-19','0');
insert into `cheque_voucher` (`cv_id`, `cv_no`, `details`, `clnt_id`, `isValidated`, `vldate`, `isDeleted`) values('187','100186','for test','1','0',NULL,'0');
