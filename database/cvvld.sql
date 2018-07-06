/*
SQLyog Community v12.4.3 (64 bit)
MySQL - 5.1.42-community 
*********************************************************************
*/
/*!40101 SET NAMES utf8 */;

create table `cheque_vld` (
	`cv_id` int (255),
	`cv_no` int (255),
	`clnt_id` int (255),
	`bank_id` int (255),
	`cheque_no` int (255),
	`dbcr_id` int (255),
	`isDeleted` tinyint (1)
); 
insert into `cheque_vld` (`cv_id`, `cv_no`, `clnt_id`, `bank_id`, `cheque_no`, `dbcr_id`, `isDeleted`) values('38','100000','2','2','1113238','182','0');
insert into `cheque_vld` (`cv_id`, `cv_no`, `clnt_id`, `bank_id`, `cheque_no`, `dbcr_id`, `isDeleted`) values('39','100000','1',NULL,NULL,'181','0');
insert into `cheque_vld` (`cv_id`, `cv_no`, `clnt_id`, `bank_id`, `cheque_no`, `dbcr_id`, `isDeleted`) values('40','100184','7','2','1113239','184','0');
insert into `cheque_vld` (`cv_id`, `cv_no`, `clnt_id`, `bank_id`, `cheque_no`, `dbcr_id`, `isDeleted`) values('41','100184','2',NULL,NULL,'183','0');
insert into `cheque_vld` (`cv_id`, `cv_no`, `clnt_id`, `bank_id`, `cheque_no`, `dbcr_id`, `isDeleted`) values('42','100185','2','2','1113240','186','0');
insert into `cheque_vld` (`cv_id`, `cv_no`, `clnt_id`, `bank_id`, `cheque_no`, `dbcr_id`, `isDeleted`) values('43','100185','7',NULL,NULL,'185','0');
