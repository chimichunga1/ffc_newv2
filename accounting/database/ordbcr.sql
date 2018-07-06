/*
SQLyog Community v12.4.3 (64 bit)
MySQL - 5.1.42-community 
*********************************************************************
*/
/*!40101 SET NAMES utf8 */;

create table `official_receipts_dbcr` (
	`or_id` int (255),
	`or_no` int (255),
	`acc_no` int (255),
	`acc_code` int (255),
	`debit_amount` varchar (765),
	`credit_amount` varchar (765),
	`or_r_id` int (255),
	`or_date` date ,
	`or_bank` int (255),
	`or_cheque_no` int (255),
	`isDeleted` tinyint (1)
); 
insert into `official_receipts_dbcr` (`or_id`, `or_no`, `acc_no`, `acc_code`, `debit_amount`, `credit_amount`, `or_r_id`, `or_date`, `or_bank`, `or_cheque_no`, `isDeleted`) values('15','100','1','22','0','1000.01','8','2018-05-27',NULL,NULL,'0');
insert into `official_receipts_dbcr` (`or_id`, `or_no`, `acc_no`, `acc_code`, `debit_amount`, `credit_amount`, `or_r_id`, `or_date`, `or_bank`, `or_cheque_no`, `isDeleted`) values('16','100','0','3','1000.01','0','8','2018-05-27',NULL,NULL,'0');
insert into `official_receipts_dbcr` (`or_id`, `or_no`, `acc_no`, `acc_code`, `debit_amount`, `credit_amount`, `or_r_id`, `or_date`, `or_bank`, `or_cheque_no`, `isDeleted`) values('17','101','1','22','0','1009.01','9','2018-05-28','2','123','0');
insert into `official_receipts_dbcr` (`or_id`, `or_no`, `acc_no`, `acc_code`, `debit_amount`, `credit_amount`, `or_r_id`, `or_date`, `or_bank`, `or_cheque_no`, `isDeleted`) values('18','101','0','3','1009.01','0','9','2018-05-27',NULL,NULL,'0');
insert into `official_receipts_dbcr` (`or_id`, `or_no`, `acc_no`, `acc_code`, `debit_amount`, `credit_amount`, `or_r_id`, `or_date`, `or_bank`, `or_cheque_no`, `isDeleted`) values('19','102','2','9','0','1000.010','10','2018-05-29','2','1231','0');
insert into `official_receipts_dbcr` (`or_id`, `or_no`, `acc_no`, `acc_code`, `debit_amount`, `credit_amount`, `or_r_id`, `or_date`, `or_bank`, `or_cheque_no`, `isDeleted`) values('20','102','2','5','0','1020.010','10','2018-05-16','2','13123','0');
insert into `official_receipts_dbcr` (`or_id`, `or_no`, `acc_no`, `acc_code`, `debit_amount`, `credit_amount`, `or_r_id`, `or_date`, `or_bank`, `or_cheque_no`, `isDeleted`) values('21','102','0','3','2020.02','0','10','2018-05-27',NULL,NULL,'0');
insert into `official_receipts_dbcr` (`or_id`, `or_no`, `acc_no`, `acc_code`, `debit_amount`, `credit_amount`, `or_r_id`, `or_date`, `or_bank`, `or_cheque_no`, `isDeleted`) values('22','1','0','3','','0','11','2018-05-29',NULL,NULL,'0');
insert into `official_receipts_dbcr` (`or_id`, `or_no`, `acc_no`, `acc_code`, `debit_amount`, `credit_amount`, `or_r_id`, `or_date`, `or_bank`, `or_cheque_no`, `isDeleted`) values('23','1','0','3','','0','12','2018-05-29',NULL,NULL,'0');
insert into `official_receipts_dbcr` (`or_id`, `or_no`, `acc_no`, `acc_code`, `debit_amount`, `credit_amount`, `or_r_id`, `or_date`, `or_bank`, `or_cheque_no`, `isDeleted`) values('24','1','0','3','','0','13','2018-05-29',NULL,NULL,'0');
insert into `official_receipts_dbcr` (`or_id`, `or_no`, `acc_no`, `acc_code`, `debit_amount`, `credit_amount`, `or_r_id`, `or_date`, `or_bank`, `or_cheque_no`, `isDeleted`) values('25','1','0','3','','0','14','2018-05-29',NULL,NULL,'0');
insert into `official_receipts_dbcr` (`or_id`, `or_no`, `acc_no`, `acc_code`, `debit_amount`, `credit_amount`, `or_r_id`, `or_date`, `or_bank`, `or_cheque_no`, `isDeleted`) values('26','1','0','3','NaN','0','15','2018-05-29',NULL,NULL,'0');
insert into `official_receipts_dbcr` (`or_id`, `or_no`, `acc_no`, `acc_code`, `debit_amount`, `credit_amount`, `or_r_id`, `or_date`, `or_bank`, `or_cheque_no`, `isDeleted`) values('27','1','0','3','inputs','0','16','2018-05-29',NULL,NULL,'0');
insert into `official_receipts_dbcr` (`or_id`, `or_no`, `acc_no`, `acc_code`, `debit_amount`, `credit_amount`, `or_r_id`, `or_date`, `or_bank`, `or_cheque_no`, `isDeleted`) values('28','1','0','3','NaN','0','17','2018-05-29',NULL,NULL,'0');
insert into `official_receipts_dbcr` (`or_id`, `or_no`, `acc_no`, `acc_code`, `debit_amount`, `credit_amount`, `or_r_id`, `or_date`, `or_bank`, `or_cheque_no`, `isDeleted`) values('29','1','0','3','NaN','0','18','2018-05-29',NULL,NULL,'0');
insert into `official_receipts_dbcr` (`or_id`, `or_no`, `acc_no`, `acc_code`, `debit_amount`, `credit_amount`, `or_r_id`, `or_date`, `or_bank`, `or_cheque_no`, `isDeleted`) values('30','1','0','3','NaN','0','19','2018-05-29',NULL,NULL,'0');
insert into `official_receipts_dbcr` (`or_id`, `or_no`, `acc_no`, `acc_code`, `debit_amount`, `credit_amount`, `or_r_id`, `or_date`, `or_bank`, `or_cheque_no`, `isDeleted`) values('31','1','0','3','NaN','0','20','2018-05-29',NULL,NULL,'0');
insert into `official_receipts_dbcr` (`or_id`, `or_no`, `acc_no`, `acc_code`, `debit_amount`, `credit_amount`, `or_r_id`, `or_date`, `or_bank`, `or_cheque_no`, `isDeleted`) values('32','1','0','3','NaN','0','21','2018-05-29',NULL,NULL,'0');
insert into `official_receipts_dbcr` (`or_id`, `or_no`, `acc_no`, `acc_code`, `debit_amount`, `credit_amount`, `or_r_id`, `or_date`, `or_bank`, `or_cheque_no`, `isDeleted`) values('33','1','0','3','NaN','0','22','2018-05-29',NULL,NULL,'0');
insert into `official_receipts_dbcr` (`or_id`, `or_no`, `acc_no`, `acc_code`, `debit_amount`, `credit_amount`, `or_r_id`, `or_date`, `or_bank`, `or_cheque_no`, `isDeleted`) values('34','1','0','3','NaN','0','23','2018-05-29',NULL,NULL,'0');
insert into `official_receipts_dbcr` (`or_id`, `or_no`, `acc_no`, `acc_code`, `debit_amount`, `credit_amount`, `or_r_id`, `or_date`, `or_bank`, `or_cheque_no`, `isDeleted`) values('35','1','0','3','NaN','0','24','2018-05-29',NULL,NULL,'0');
insert into `official_receipts_dbcr` (`or_id`, `or_no`, `acc_no`, `acc_code`, `debit_amount`, `credit_amount`, `or_r_id`, `or_date`, `or_bank`, `or_cheque_no`, `isDeleted`) values('36','1','0','3','NaN','0','25','2018-05-29',NULL,NULL,'0');
insert into `official_receipts_dbcr` (`or_id`, `or_no`, `acc_no`, `acc_code`, `debit_amount`, `credit_amount`, `or_r_id`, `or_date`, `or_bank`, `or_cheque_no`, `isDeleted`) values('37','1','0','3','NaN','0','26','2018-05-29',NULL,NULL,'0');
