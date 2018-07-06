/*
SQLyog Community v12.4.3 (64 bit)
MySQL - 5.1.42-community 
*********************************************************************
*/
/*!40101 SET NAMES utf8 */;

create table `journal_vld` (
	`jv_id` int (255),
	`jv_no` int (255),
	`clnt_id` int (255),
	`bank_id` int (255),
	`dbcr_id` int (255),
	`isDeleted` tinyint (1)
); 
insert into `journal_vld` (`jv_id`, `jv_no`, `clnt_id`, `bank_id`, `dbcr_id`, `isDeleted`) values('5','100010','2','2','17','0');
insert into `journal_vld` (`jv_id`, `jv_no`, `clnt_id`, `bank_id`, `dbcr_id`, `isDeleted`) values('6','100010','7','2','16','0');
insert into `journal_vld` (`jv_id`, `jv_no`, `clnt_id`, `bank_id`, `dbcr_id`, `isDeleted`) values('7','100010','1','2','15','0');
insert into `journal_vld` (`jv_id`, `jv_no`, `clnt_id`, `bank_id`, `dbcr_id`, `isDeleted`) values('8','100014','2','2','21','0');
insert into `journal_vld` (`jv_id`, `jv_no`, `clnt_id`, `bank_id`, `dbcr_id`, `isDeleted`) values('9','100014','2','2','20','0');
insert into `journal_vld` (`jv_id`, `jv_no`, `clnt_id`, `bank_id`, `dbcr_id`, `isDeleted`) values('10','100013','1','2','18','0');
insert into `journal_vld` (`jv_id`, `jv_no`, `clnt_id`, `bank_id`, `dbcr_id`, `isDeleted`) values('11','100013','1','2','19','0');
