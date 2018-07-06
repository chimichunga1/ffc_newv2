/*
SQLyog Community v13.0.1 (64 bit)
MySQL - 10.1.16-MariaDB : Database - fccl_system
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`fccl_system` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `fccl_system`;

/*Table structure for table `interview_char` */

DROP TABLE IF EXISTS `interview_char`;

CREATE TABLE `interview_char` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `loan_id` bigint(20) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `interview_char` */

insert  into `interview_char`(`id`,`loan_id`,`name`,`contact`,`address`) values 
(1,19,'','','');

/*Table structure for table `interview_child` */

DROP TABLE IF EXISTS `interview_child`;

CREATE TABLE `interview_child` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `loan_id` bigint(20) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `age` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `affiliation` varchar(255) DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `interview_child` */

insert  into `interview_child`(`id`,`loan_id`,`name`,`age`,`status`,`affiliation`) values 
(1,19,'Wendy,Peter','12,8',',',',');

/*Table structure for table `interview_sheet` */

DROP TABLE IF EXISTS `interview_sheet`;

CREATE TABLE `interview_sheet` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `loan_id` bigint(20) DEFAULT NULL,
  `client_no` bigint(20) DEFAULT NULL,
  `nname` varchar(255) DEFAULT NULL,
  `age` varchar(255) DEFAULT NULL,
  `civil_status` bigint(20) DEFAULT NULL,
  `birthdate` varchar(255) DEFAULT NULL,
  `birthplace` varchar(255) DEFAULT NULL,
  `edu_att` varchar(255) DEFAULT NULL,
  `school` varchar(255) DEFAULT NULL,
  `gsis_sss` varchar(255) DEFAULT NULL,
  `dri_lic` varchar(255) DEFAULT NULL,
  `emp_name` varchar(255) DEFAULT NULL,
  `emp_leng` varchar(255) DEFAULT NULL,
  `emp_add` varchar(255) DEFAULT NULL,
  `emp_con` varchar(255) DEFAULT NULL,
  `emp_des` varchar(255) DEFAULT NULL,
  `emp_sal` varchar(255) DEFAULT NULL,
  `emp_prev` varchar(255) DEFAULT NULL,
  `spouse_name` varchar(255) DEFAULT NULL,
  `spouse_nname` varchar(255) DEFAULT NULL,
  `spouse_age` varchar(255) DEFAULT NULL,
  `spouse_civil_status` bigint(20) DEFAULT NULL,
  `spouse_birthdate` varchar(255) DEFAULT NULL,
  `spouse_birthplace` varbinary(255) DEFAULT NULL,
  `spouse_edu_att` varchar(255) DEFAULT NULL,
  `spouse_school` varchar(255) DEFAULT NULL,
  `spouse_gsis_sss` varchar(255) DEFAULT NULL,
  `spouse_dri_lic` varchar(255) DEFAULT NULL,
  `spouse_emp_name` varchar(255) DEFAULT NULL,
  `spouse_emp_leng` varchar(255) DEFAULT NULL,
  `spouse_emp_add` varchar(255) DEFAULT NULL,
  `spouse_emp_con` varchar(255) DEFAULT NULL,
  `spouse_emp_des` varchar(255) DEFAULT NULL,
  `spouse_emp_sal` varchar(255) DEFAULT NULL,
  `spouse_emp_prev` varchar(255) DEFAULT NULL,
  `no_child` varchar(255) DEFAULT NULL,
  `fat_name` varchar(255) DEFAULT NULL,
  `fat_age` varchar(255) DEFAULT NULL,
  `fat_add` varchar(255) DEFAULT NULL,
  `mom_name` varchar(255) DEFAULT NULL,
  `mom_age` varchar(255) DEFAULT NULL,
  `mom_add` varchar(255) DEFAULT NULL,
  `no_sib` varchar(255) DEFAULT NULL,
  `pres_add` varchar(255) DEFAULT NULL,
  `pres_tel_no` varchar(255) DEFAULT NULL,
  `pres_cel_no` varchar(255) DEFAULT NULL,
  `pres_leng_stay` varchar(255) DEFAULT NULL,
  `pres_acquire` varchar(255) DEFAULT NULL,
  `pres_free_name` varchar(255) DEFAULT NULL,
  `pres_free_tel` varchar(255) DEFAULT NULL,
  `pres_free_rel` varchar(255) DEFAULT NULL,
  `pres_rent_name` varchar(255) DEFAULT NULL,
  `pres_rent_pay` varchar(255) DEFAULT NULL,
  `pres_rent_tel` varchar(255) DEFAULT NULL,
  `pres_mort_name` varchar(255) DEFAULT NULL,
  `pres_mort_pay` varchar(255) DEFAULT NULL,
  `pres_mort_tel` varchar(255) DEFAULT NULL,
  `prev_add` varchar(255) DEFAULT NULL,
  `other_add` varchar(255) DEFAULT NULL,
  `other_tel_no` varchar(255) DEFAULT NULL,
  `other_cel_no` varchar(255) DEFAULT NULL,
  `other_leng_stay` varchar(255) DEFAULT NULL,
  `other_acquire` varchar(255) DEFAULT NULL,
  `other_free_name` varchar(255) DEFAULT NULL,
  `other_free_rel` varchar(255) DEFAULT NULL,
  `other_free_tel` varchar(255) DEFAULT NULL,
  `other_rent_name` varchar(255) DEFAULT NULL,
  `other_rent_pay` varchar(255) DEFAULT NULL,
  `other_rent_tel` varchar(255) DEFAULT NULL,
  `other_mort_name` varchar(255) DEFAULT NULL,
  `other_mort_pay` varchar(255) DEFAULT NULL,
  `other_mort_tel` varchar(255) DEFAULT NULL,
  `bus_name` varchar(255) DEFAULT NULL,
  `org_type` varchar(255) DEFAULT NULL,
  `date_est` varchar(255) DEFAULT NULL,
  `bus_nat` varchar(255) DEFAULT NULL,
  `sing_name` varchar(255) DEFAULT NULL,
  `part_name` varchar(255) DEFAULT NULL,
  `part_rel` varchar(255) DEFAULT NULL,
  `corp_man_name` varchar(255) DEFAULT NULL,
  `corp_maj_name` varchar(255) DEFAULT NULL,
  `off_add` varchar(255) DEFAULT NULL,
  `off_tel_no` varchar(255) DEFAULT NULL,
  `off_cel_no` varchar(255) DEFAULT NULL,
  `off_leng_stay` varchar(255) DEFAULT NULL,
  `off_acquire` varchar(255) DEFAULT NULL,
  `off_free_name` varchar(255) DEFAULT NULL,
  `off_free_rel` varchar(255) DEFAULT NULL,
  `off_free_tel` varchar(255) DEFAULT NULL,
  `off_rent_name` varchar(255) DEFAULT NULL,
  `off_rent_pay` varchar(255) DEFAULT NULL,
  `off_rent_tel` varchar(255) DEFAULT NULL,
  `off_mort_name` varchar(255) DEFAULT NULL,
  `off_mort_pay` varchar(255) DEFAULT NULL,
  `off_mort_tel` varchar(255) DEFAULT NULL,
  `off_prev_add` varchar(255) DEFAULT NULL,
  `gar_add` varchar(255) DEFAULT NULL,
  `gar_tel_no` varchar(255) DEFAULT NULL,
  `gar_cel_no` varchar(255) DEFAULT NULL,
  `gar_leng_stay` varchar(255) DEFAULT NULL,
  `gar_acquire` varchar(255) DEFAULT NULL,
  `gar_free_name` varchar(255) DEFAULT NULL,
  `gar_free_rel` varchar(255) DEFAULT NULL,
  `gar_free_tel` varchar(255) DEFAULT NULL,
  `gar_rent_name` varchar(255) DEFAULT NULL,
  `gar_rent_pay` varchar(255) DEFAULT NULL,
  `gar_rent_tel` varchar(255) DEFAULT NULL,
  `gar_mort_name` varchar(255) DEFAULT NULL,
  `gar_mort_pay` varchar(255) DEFAULT NULL,
  `gar_mort_tel` varchar(255) DEFAULT NULL,
  `gar_prev_add` varchar(255) DEFAULT NULL,
  `sour_pay` varchar(255) DEFAULT NULL,
  `loan_for` varchar(255) DEFAULT NULL,
  `court_case` varchar(255) DEFAULT NULL,
  `int_type` varchar(255) DEFAULT NULL,
  `informant` varchar(255) DEFAULT NULL,
  `bor_rel` varchar(255) DEFAULT NULL,
  `int_date` varchar(255) DEFAULT NULL,
  `corpo_name` varchar(255) DEFAULT NULL,
  `corpo_pos` varchar(255) DEFAULT NULL,
  `trade_comp` varchar(255) DEFAULT NULL,
  `trade_tel` varchar(255) DEFAULT NULL,
  `trade_con` varchar(255) DEFAULT NULL,
  `trade_deal` varchar(255) DEFAULT NULL,
  `trade_coll` varchar(255) DEFAULT NULL,
  `gas_name` varchar(255) DEFAULT NULL,
  `gas_tel` varchar(255) DEFAULT NULL,
  `gas_con` varchar(255) DEFAULT NULL,
  `gas_coll` varchar(255) DEFAULT NULL,
  `date_applied` varchar(255) DEFAULT NULL,
  `applied_by` varchar(255) DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `interview_sheet` */

insert  into `interview_sheet`(`id`,`loan_id`,`client_no`,`nname`,`age`,`civil_status`,`birthdate`,`birthplace`,`edu_att`,`school`,`gsis_sss`,`dri_lic`,`emp_name`,`emp_leng`,`emp_add`,`emp_con`,`emp_des`,`emp_sal`,`emp_prev`,`spouse_name`,`spouse_nname`,`spouse_age`,`spouse_civil_status`,`spouse_birthdate`,`spouse_birthplace`,`spouse_edu_att`,`spouse_school`,`spouse_gsis_sss`,`spouse_dri_lic`,`spouse_emp_name`,`spouse_emp_leng`,`spouse_emp_add`,`spouse_emp_con`,`spouse_emp_des`,`spouse_emp_sal`,`spouse_emp_prev`,`no_child`,`fat_name`,`fat_age`,`fat_add`,`mom_name`,`mom_age`,`mom_add`,`no_sib`,`pres_add`,`pres_tel_no`,`pres_cel_no`,`pres_leng_stay`,`pres_acquire`,`pres_free_name`,`pres_free_tel`,`pres_free_rel`,`pres_rent_name`,`pres_rent_pay`,`pres_rent_tel`,`pres_mort_name`,`pres_mort_pay`,`pres_mort_tel`,`prev_add`,`other_add`,`other_tel_no`,`other_cel_no`,`other_leng_stay`,`other_acquire`,`other_free_name`,`other_free_rel`,`other_free_tel`,`other_rent_name`,`other_rent_pay`,`other_rent_tel`,`other_mort_name`,`other_mort_pay`,`other_mort_tel`,`bus_name`,`org_type`,`date_est`,`bus_nat`,`sing_name`,`part_name`,`part_rel`,`corp_man_name`,`corp_maj_name`,`off_add`,`off_tel_no`,`off_cel_no`,`off_leng_stay`,`off_acquire`,`off_free_name`,`off_free_rel`,`off_free_tel`,`off_rent_name`,`off_rent_pay`,`off_rent_tel`,`off_mort_name`,`off_mort_pay`,`off_mort_tel`,`off_prev_add`,`gar_add`,`gar_tel_no`,`gar_cel_no`,`gar_leng_stay`,`gar_acquire`,`gar_free_name`,`gar_free_rel`,`gar_free_tel`,`gar_rent_name`,`gar_rent_pay`,`gar_rent_tel`,`gar_mort_name`,`gar_mort_pay`,`gar_mort_tel`,`gar_prev_add`,`sour_pay`,`loan_for`,`court_case`,`int_type`,`informant`,`bor_rel`,`int_date`,`corpo_name`,`corpo_pos`,`trade_comp`,`trade_tel`,`trade_con`,`trade_deal`,`trade_coll`,`gas_name`,`gas_tel`,`gas_con`,`gas_coll`,`date_applied`,`applied_by`) values 
(4,19,6,'Bogs','25',1,'05/28/2018','Pasig','College','','','','','','','','','','','','','',0,'','','','','','','','','','','','','','2','','','','','','','','','','447','','owned','','','','','','','','','','','','','549','','free','','','','','','','','','','','S','','','','','','','','','','745','','owned','','','','','','','','','','','','','847','','owned','','','','','','','','','','','','','','Personal','','','05/28/2018','Jay,Jetro','BA,Dev','','','','','','','','','','2018-05-28','');

/*Table structure for table `interview_sibling` */

DROP TABLE IF EXISTS `interview_sibling`;

CREATE TABLE `interview_sibling` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `loan_id` bigint(20) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `interview_sibling` */

insert  into `interview_sibling`(`id`,`loan_id`,`name`,`contact`,`address`) values 
(1,19,'Wilfred,One',',',',');

/*Table structure for table `neighbor_check` */

DROP TABLE IF EXISTS `neighbor_check`;

CREATE TABLE `neighbor_check` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `loan_id` bigint(20) DEFAULT NULL,
  `client_no` bigint(20) DEFAULT NULL,
  `tel_no` varchar(255) DEFAULT NULL,
  `cel_no` varchar(255) DEFAULT NULL,
  `leng_stay` varchar(255) DEFAULT NULL,
  `acquire` varchar(255) DEFAULT NULL,
  `free_name` varchar(255) DEFAULT NULL,
  `free_rel` varchar(255) DEFAULT NULL,
  `free_tel` varchar(255) DEFAULT NULL,
  `rent_name` varchar(255) DEFAULT NULL,
  `rent_pay` varchar(255) DEFAULT NULL,
  `rent_tel` varchar(255) DEFAULT NULL,
  `mort_name` varchar(255) DEFAULT NULL,
  `mort_pay` varchar(255) DEFAULT NULL,
  `mort_tel` varchar(255) DEFAULT NULL,
  `prev_add` varchar(255) DEFAULT NULL,
  `other_add` varchar(255) DEFAULT NULL,
  `other_tel` varchar(255) DEFAULT NULL,
  `desc_imp` varchar(255) DEFAULT NULL,
  `equip_with` varchar(255) DEFAULT NULL,
  `liv_con` varchar(255) DEFAULT NULL,
  `liv_con_oth` varchar(255) DEFAULT NULL,
  `neigh_spec` varchar(255) DEFAULT NULL,
  `neigh_spec_oth` varchar(255) DEFAULT NULL,
  `access_to` varchar(255) DEFAULT NULL,
  `subj_rep` varchar(255) DEFAULT NULL,
  `direction` varchar(255) DEFAULT NULL,
  `date_applied` varchar(255) DEFAULT NULL,
  `applied_by` bigint(20) DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `neighbor_check` */

insert  into `neighbor_check`(`id`,`loan_id`,`client_no`,`tel_no`,`cel_no`,`leng_stay`,`acquire`,`free_name`,`free_rel`,`free_tel`,`rent_name`,`rent_pay`,`rent_tel`,`mort_name`,`mort_pay`,`mort_tel`,`prev_add`,`other_add`,`other_tel`,`desc_imp`,`equip_with`,`liv_con`,`liv_con_oth`,`neigh_spec`,`neigh_spec_oth`,`access_to`,`subj_rep`,`direction`,`date_applied`,`applied_by`) values 
(1,19,6,'1234','1234','12','owned','','','','','','','','','','','','','','','good',NULL,'subdivision',NULL,'bus','','','2018-05-28',0);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
