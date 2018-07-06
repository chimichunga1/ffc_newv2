/*
SQLyog Community v12.4.3 (64 bit)
MySQL - 5.1.42-community 
*********************************************************************
*/
/*!40101 SET NAMES utf8 */;

create table `accounts` (
	`id` bigint (20),
	`acc_id` varchar (765),
	`account_name` text ,
	`type` int (11),
	`is_deleted` tinyint (4)
); 
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('0','--------------','--------------',NULL,'0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('1','101-00-00','CASH ON HAND',NULL,'0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('2','101-01-00','Cash on Hand',NULL,'0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('3','102-00-00','DEPOSIT IN BANKS',NULL,'0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('4','102-01-00','Deposit in Banks - Current',NULL,'0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('5','102-01-01','Deposit in Banks - Current BPI - CA#0321-00162-61',NULL,'0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('6','102-01-02','Deposit in Banks - Current BDO - CA#0321-92000-91',NULL,'0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('7','109-00-00','OTHER ASSETS',NULL,'0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('8','109-01-00','Petty Cash Fund',NULL,'0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('9','109-02-00','Accounts Recievable',NULL,'0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('10','109-02-01','Accounts Recievable Input-tax',NULL,'0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('11','109-02-02','Accounts Recievable Various',NULL,'0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('12','109-02-03','Accounts Recievable IIL/PD',NULL,'0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('13','510-00-00','OTHER EXPENSES',NULL,'0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('14','510-05-00','Repair and Maintenance',NULL,'0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('15','510-18-00','Miscellaneous Expenses',NULL,'0');
