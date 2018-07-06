/*
SQLyog Ultimate v10.00 Beta1
MySQL - 5.5.5-10.1.24-MariaDB : Database - fccl_system
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

/*Table structure for table `account_types` */

DROP TABLE IF EXISTS `account_types`;

CREATE TABLE `account_types` (
  `acc_types_id` bigint(20) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `inc_when_debit` int(2) NOT NULL,
  PRIMARY KEY (`acc_types_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `account_types` */

insert  into `account_types`(`acc_types_id`,`name`,`inc_when_debit`) values (1,'Revenue(Main)',0),(2,'Revenue(Side)',0),(3,'Expenses',1),(4,'Assets(Non-Current)',1),(5,'Assets(Current)',1),(6,'Liabilities(Current)',0),(7,'Liabilities(Non-Current)',0),(8,'Owner\'s Equity (Capital)',0),(9,'Owner\'s Equity (Drawing)',0),(10,'Contra (Current Assets)',0),(11,'Non-Current Asset',0);

/*Table structure for table `accounts` */

DROP TABLE IF EXISTS `accounts`;

CREATE TABLE `accounts` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `acc_id` varchar(255) NOT NULL,
  `account_name` longtext,
  `type` int(11) DEFAULT NULL,
  `is_deleted` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`acc_id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

/*Data for the table `accounts` */

insert  into `accounts`(`id`,`acc_id`,`account_name`,`type`,`is_deleted`) values (1,'0','wew',2,0),(2,'1001','Cash',5,0),(3,'1002','Petty Cash',5,0),(4,'1003','Accounts Recievable',5,0),(5,'1004','Notes Receivable',5,0),(6,'1005','Allowance for Bad Debts',5,0),(7,'1006','Merchandise Inventory',5,0),(8,'1007','Supplies Unused',5,0),(9,'1008','Prepaid Insurance',5,0),(10,'1009','Furnitures and Fixtures',4,0),(11,'1010','Accu. Depreciation-F&F',4,0),(12,'1011','Equipment',4,0),(13,'1012','Accu. deprecaition-Equip.',4,0),(14,'1013','Land',4,0),(15,'1014','Building',4,0),(16,'1015','Accu. Depreciation-Bldg',4,0),(17,'123','One',6,0),(18,'2001','Accounts Payable',6,0),(19,'222222','CJAY TEST',1,0),(20,'3001','Salaries Expenses',3,0),(21,'3002','Utilities Expenses',3,0),(22,'3003','Supplies Expense',3,0),(23,'3004','Rent Expense',3,0),(24,'3435','bully',7,0),(25,'34578','game',6,0),(26,'34fgg','sfdfds',6,0),(27,'4001','Accounts Payable',6,0),(28,'5001','Service',2,0),(29,'5002','Sales',5,0),(30,'6001','Mr. X Capital',8,0),(31,'6002','MrM',9,0),(32,'7900','Test',11,0),(33,'9999','Test Income',1,0),(34,'ASD','ASD',1,0),(38,'CJAY','xcvfb',7,0),(35,'CJAY CONOCONO','CJAY CONOCONO wew',2,0),(36,'CJAY1996','CJAY',2,0),(37,'qwdqd44546','fghfhg',3,1),(39,'`er','ert',3,0);

/*Table structure for table `additional_cash` */

DROP TABLE IF EXISTS `additional_cash`;

CREATE TABLE `additional_cash` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `amount` varchar(255) NOT NULL,
  `year` varchar(255) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `additional_cash` */

insert  into `additional_cash`(`id`,`amount`,`year`,`is_deleted`) values (1,'111','2017',0);

/*Table structure for table `approval_flow` */

DROP TABLE IF EXISTS `approval_flow`;

CREATE TABLE `approval_flow` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=327 DEFAULT CHARSET=latin1;

/*Data for the table `approval_flow` */

insert  into `approval_flow`(`id`,`user_id`) values (324,1),(325,3),(326,13);

/*Table structure for table `available_balance` */

DROP TABLE IF EXISTS `available_balance`;

CREATE TABLE `available_balance` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `amount` varchar(255) NOT NULL,
  `year` varchar(255) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `available_balance` */

insert  into `available_balance`(`id`,`amount`,`year`,`is_deleted`) values (1,'700','2017',0),(3,'354','2018',0),(4,'1','1',0);

/*Table structure for table `bank` */

DROP TABLE IF EXISTS `bank`;

CREATE TABLE `bank` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `is_deleted` smallint(1) DEFAULT '0',
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `bank` */

insert  into `bank`(`id`,`name`,`is_deleted`) values (1,'BDO',0),(2,'BPI',0),(3,'UnionBank',0),(4,'AUB',0);

/*Table structure for table `budget_per_week` */

DROP TABLE IF EXISTS `budget_per_week`;

CREATE TABLE `budget_per_week` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `budget` varchar(255) NOT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `budget_per_week` */

insert  into `budget_per_week`(`id`,`budget`) values (1,'1000003290');

/*Table structure for table `business_type` */

DROP TABLE IF EXISTS `business_type`;

CREATE TABLE `business_type` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `business_type` */

insert  into `business_type`(`id`,`name`,`is_deleted`) values (1,'Business Solutions Company',0),(2,'test',1);

/*Table structure for table `bwu_files` */

DROP TABLE IF EXISTS `bwu_files`;

CREATE TABLE `bwu_files` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `file_name` varchar(255) DEFAULT NULL,
  `file_location` varchar(255) DEFAULT NULL,
  `loan_id` bigint(20) DEFAULT NULL,
  `date_modified` varchar(255) DEFAULT NULL,
  `is_deleted` tinyint(4) DEFAULT '0',
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

/*Data for the table `bwu_files` */

insert  into `bwu_files`(`id`,`file_name`,`file_location`,`loan_id`,`date_modified`,`is_deleted`) values (1,'DESPRO-appendices-final-na.docx','1.docx',21,'2018-05-14 16:43:47',0),(2,'doc6.docx','2.docx',25,'2018-05-14 17:02:34',0),(3,'business-writup.rtf','3.rtf',28,'2018-05-15 12:09:49',0),(4,'business-writup (2).rtf','4.rtf',29,'2018-05-15 15:10:39',0),(5,'business-writup (3).rtf','5.rtf',20,'2018-05-15 20:57:33',0),(6,'business-writup (4).rtf','6.rtf',30,'2018-05-16 13:36:55',0),(7,'business-writup (4).rtf','7.rtf',31,'2018-05-20 14:12:24',0),(8,'business-writup (4).rtf','8.rtf',33,'2018-05-22 19:18:35',0),(9,'business-writup (4).rtf','9.rtf',8,'2018-05-24 14:43:38',0),(10,'business-writup (5).rtf','10.rtf',38,'2018-05-27 20:35:28',0),(11,'business-writup (6).rtf','11.rtf',39,'2018-05-28 23:52:13',0),(12,'business-writup (7).rtf','12.rtf',40,'2018-05-29 00:16:09',0),(13,'business-writup (8).rtf','13.rtf',41,'2018-05-29 10:16:58',0),(14,'business-writup (9).rtf','14.rtf',44,'2018-06-01 00:09:16',0),(15,'business-writup (10).rtf','15.rtf',45,'2018-06-06 20:58:29',0),(16,'business-writup (11).rtf','16.rtf',46,'2018-06-20 22:15:35',0);

/*Table structure for table `caf_info` */

DROP TABLE IF EXISTS `caf_info`;

CREATE TABLE `caf_info` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `client_no` bigint(20) NOT NULL,
  `app_no` bigint(20) NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `spouse` varchar(255) NOT NULL,
  `co_maker` varchar(255) NOT NULL,
  `pri_con` bigint(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `dealer_id` bigint(20) NOT NULL,
  `salesman_id` bigint(20) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `lcp` decimal(10,2) NOT NULL,
  `av` decimal(10,2) NOT NULL,
  `downpayment` decimal(10,2) NOT NULL,
  `amount_fin` decimal(10,2) NOT NULL,
  `term` bigint(20) NOT NULL,
  `int_rate` decimal(10,2) NOT NULL,
  `mon_first` decimal(10,2) NOT NULL,
  `mon_second` decimal(10,2) NOT NULL,
  `prepared_by` varchar(255) NOT NULL,
  `noted_by` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_deleted` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

/*Data for the table `caf_info` */

insert  into `caf_info`(`id`,`client_no`,`app_no`,`client_name`,`spouse`,`co_maker`,`pri_con`,`address`,`dealer_id`,`salesman_id`,`unit`,`lcp`,`av`,`downpayment`,`amount_fin`,`term`,`int_rate`,`mon_first`,`mon_second`,`prepared_by`,`noted_by`,`created_at`,`is_deleted`) values (18,11,201806002,'ATASKA M, YABSON','Ang','asdasd',3123123,'31231231',9,6,'asd','2500.34','21321.29','321321.43','321321.23',24,'78.34','321321.34','312312.28','CJAY D. CONOCONO','RAMON R. RAMOS','2018-06-07 17:01:13',0),(19,7,0,'CJAY T, CONOCONO','TEST','',123,'1231',0,0,'','0.00','0.00','0.00','0.00',0,'0.00','0.00','0.00','CJAY D. CONOCONO','RAMON R. RAMOS','2018-06-10 12:23:56',0),(20,9,201805004,'CARL DENNIS M, ALINGALAN','','Wala po',312442131312,'2462 McKinley Hills1',11,6,'Makati','20000.00','500000.00','250000.00','23000.00',23,'21.01','3423.32','23444.20','CJAY D. CONOCONO','RAMON R. RAMOS','2018-06-11 10:00:46',0),(21,1,201805003,'JAY E, TUMANDA','12345','',123,'1231',6,0,'','0.00','0.00','0.00','0.00',0,'21.00','0.00','0.00','CJAY D. CONOCONO','RAMON R. RAMOS','2018-06-22 13:45:25',0),(22,9,201805007,'CARL DENNIS M, ALINGALAN','','213',312442131312,'2462 McKinley Hills1',0,6,'21','2000.00','2000.00','50000.00','40000.00',23,'15.32','25000.00','240000.00','CJAY D. CONOCONO','RAMON R. RAMOS','2018-06-24 20:11:10',0);

/*Table structure for table `cash_request` */

DROP TABLE IF EXISTS `cash_request`;

CREATE TABLE `cash_request` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `request_by` bigint(20) NOT NULL,
  `journal_entry_no` bigint(20) DEFAULT NULL,
  `journal_id` bigint(20) DEFAULT NULL,
  `date_of_entry` date DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `status_id` bigint(20) DEFAULT '1',
  `approver_id` bigint(20) DEFAULT '0',
  `total_amount` varchar(255) DEFAULT NULL,
  `journal_details_id` varchar(255) DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `cash_request` */

insert  into `cash_request`(`id`,`request_by`,`journal_entry_no`,`journal_id`,`date_of_entry`,`description`,`status_id`,`approver_id`,`total_amount`,`journal_details_id`) values (2,1,17111,16,'2017-11-01','test',2,17,'123','250'),(3,1,17112,16,'2017-11-23','test',4,3,'100000000','252');

/*Table structure for table `cheque_dbcr` */

DROP TABLE IF EXISTS `cheque_dbcr`;

CREATE TABLE `cheque_dbcr` (
  `cntrct_id` int(255) DEFAULT NULL,
  `cv_id` int(255) DEFAULT NULL,
  `cd` int(255) DEFAULT NULL,
  `acc_code` int(255) DEFAULT NULL,
  `debit_amount` varchar(765) DEFAULT NULL,
  `credit_amount` varchar(765) DEFAULT NULL,
  `clnt_id` int(255) DEFAULT NULL,
  `isDeleted` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `cheque_dbcr` */

insert  into `cheque_dbcr`(`cntrct_id`,`cv_id`,`cd`,`acc_code`,`debit_amount`,`credit_amount`,`clnt_id`,`isDeleted`) values (140,200001,NULL,123,'10000','0',1,0),(141,200001,NULL,123,'0','5000',7,0),(142,200001,NULL,123,'0','5000',2,0),(NULL,200167,NULL,123,'300',NULL,1,NULL),(NULL,200167,NULL,123,NULL,'300',2,NULL);

/*Table structure for table `cheque_vld` */

DROP TABLE IF EXISTS `cheque_vld`;

CREATE TABLE `cheque_vld` (
  `cntrct_id` int(255) DEFAULT NULL,
  `cv_id` int(255) DEFAULT NULL,
  `clnt_id` int(255) DEFAULT NULL,
  `bank_id` int(255) DEFAULT NULL,
  `amount` varchar(765) DEFAULT NULL,
  `isDeleted` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `cheque_vld` */

insert  into `cheque_vld`(`cntrct_id`,`cv_id`,`clnt_id`,`bank_id`,`amount`,`isDeleted`) values (11,200001,1,3,'10000',0);

/*Table structure for table `cheque_voucher` */

DROP TABLE IF EXISTS `cheque_voucher`;

CREATE TABLE `cheque_voucher` (
  `cntrct_id` int(255) DEFAULT NULL,
  `cv_id` int(255) DEFAULT NULL,
  `amount` varchar(765) DEFAULT NULL,
  `details` text,
  `clnt_id` int(255) DEFAULT NULL,
  `isValidated` tinyint(1) DEFAULT NULL,
  `isJournal` tinyint(1) DEFAULT NULL,
  `isDeleted` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `cheque_voucher` */

insert  into `cheque_voucher`(`cntrct_id`,`cv_id`,`amount`,`details`,`clnt_id`,`isValidated`,`isJournal`,`isDeleted`) values (166,200001,'10000','For testing',1,1,1,0),(NULL,200167,'300','Payment for the payment',1,NULL,NULL,NULL),(NULL,200167,'300','Payment for the payment',1,NULL,NULL,NULL),(NULL,200167,NULL,NULL,NULL,NULL,NULL,NULL),(NULL,200167,NULL,NULL,NULL,NULL,NULL,NULL),(NULL,200167,NULL,NULL,NULL,NULL,NULL,NULL);

/*Table structure for table `cities` */

DROP TABLE IF EXISTS `cities`;

CREATE TABLE `cities` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(300) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `province_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1637 DEFAULT CHARSET=latin1;

/*Data for the table `cities` */

insert  into `cities`(`id`,`name`,`province_id`) values (1,'Bangued',1),(2,'Boliney',1),(3,'Bucay',1),(4,'Bucloc',1),(5,'Daguioman',1),(6,'Danglas',1),(7,'Dolores',1),(8,'La Paz',1),(9,'Lacub',1),(10,'Lagangilang',1),(11,'Lagayan',1),(12,'Langiden',1),(13,'Licuan-Baay',1),(14,'Luba',1),(15,'Malibcong',1),(16,'Manabo',1),(17,'Peñarrubia',1),(18,'Pidigan',1),(19,'Pilar',1),(20,'Sallapadan',1),(21,'San Isidro',1),(22,'San Juan',1),(23,'San Quintin',1),(24,'Tayum',1),(25,'Tineg',1),(26,'Tubo',1),(27,'Villaviciosa',1),(28,'Butuan City',2),(29,'Buenavista',2),(30,'Cabadbaran',2),(31,'Carmen',2),(32,'Jabonga',2),(33,'Kitcharao',2),(34,'Las Nieves',2),(35,'Magallanes',2),(36,'Nasipit',2),(37,'Remedios T. Romualdez',2),(38,'Santiago',2),(39,'Tubay',2),(40,'Bayugan',3),(41,'Bunawan',3),(42,'Esperanza',3),(43,'La Paz',3),(44,'Loreto',3),(45,'Prosperidad',3),(46,'Rosario',3),(47,'San Francisco',3),(48,'San Luis',3),(49,'Santa Josefa',3),(50,'Sibagat',3),(51,'Talacogon',3),(52,'Trento',3),(53,'Veruela',3),(54,'Altavas',4),(55,'Balete',4),(56,'Banga',4),(57,'Batan',4),(58,'Buruanga',4),(59,'Ibajay',4),(60,'Kalibo',4),(61,'Lezo',4),(62,'Libacao',4),(63,'Madalag',4),(64,'Makato',4),(65,'Malay',4),(66,'Malinao',4),(67,'Nabas',4),(68,'New Washington',4),(69,'Numancia',4),(70,'Tangalan',4),(71,'Legazpi City',5),(72,'Ligao City',5),(73,'Tabaco City',5),(74,'Bacacay',5),(75,'Camalig',5),(76,'Daraga',5),(77,'Guinobatan',5),(78,'Jovellar',5),(79,'Libon',5),(80,'Malilipot',5),(81,'Malinao',5),(82,'Manito',5),(83,'Oas',5),(84,'Pio Duran',5),(85,'Polangui',5),(86,'Rapu-Rapu',5),(87,'Santo Domingo',5),(88,'Tiwi',5),(89,'Anini-y',6),(90,'Barbaza',6),(91,'Belison',6),(92,'Bugasong',6),(93,'Caluya',6),(94,'Culasi',6),(95,'Hamtic',6),(96,'Laua-an',6),(97,'Libertad',6),(98,'Pandan',6),(99,'Patnongon',6),(100,'San Jose',6),(101,'San Remigio',6),(102,'Sebaste',6),(103,'Sibalom',6),(104,'Tibiao',6),(105,'Tobias Fornier',6),(106,'Valderrama',6),(107,'Calanasan',7),(108,'Conner',7),(109,'Flora',7),(110,'Kabugao',7),(111,'Luna',7),(112,'Pudtol',7),(113,'Santa Marcela',7),(114,'Baler',8),(115,'Casiguran',8),(116,'Dilasag',8),(117,'Dinalungan',8),(118,'Dingalan',8),(119,'Dipaculao',8),(120,'Maria Aurora',8),(121,'San Luis',8),(122,'Isabela City',9),(123,'Akbar',9),(124,'Al-Barka',9),(125,'Hadji Mohammad Ajul',9),(126,'Hadji Muhtamad',9),(127,'Lamitan',9),(128,'Lantawan',9),(129,'Maluso',9),(130,'Sumisip',9),(131,'Tabuan-Lasa',9),(132,'Tipo-Tipo',9),(133,'Tuburan',9),(134,'Ungkaya Pukan',9),(135,'Balanga City',10),(136,'Abucay',10),(137,'Bagac',10),(138,'Dinalupihan',10),(139,'Hermosa',10),(140,'Limay',10),(141,'Mariveles',10),(142,'Morong',10),(143,'Orani',10),(144,'Orion',10),(145,'Pilar',10),(146,'Samal',10),(147,'Basco',11),(148,'Itbayat',11),(149,'Ivana',11),(150,'Mahatao',11),(151,'Sabtang',11),(152,'Uyugan',11),(153,'Batangas City',12),(154,'Lipa City',12),(155,'Tanauan City',12),(156,'Agoncillo',12),(157,'Alitagtag',12),(158,'Balayan',12),(159,'Balete',12),(160,'Bauan',12),(161,'Calaca',12),(162,'Calatagan',12),(163,'Cuenca',12),(164,'Ibaan',12),(165,'Laurel',12),(166,'Lemery',12),(167,'Lian',12),(168,'Lobo',12),(169,'Mabini',12),(170,'Malvar',12),(171,'Mataas na Kahoy',12),(172,'Nasugbu',12),(173,'Padre Garcia',12),(174,'Rosario',12),(175,'San Jose',12),(176,'San Juan',12),(177,'San Luis',12),(178,'San Nicolas',12),(179,'San Pascual',12),(180,'Santa Teresita',12),(181,'Santo Tomas',12),(182,'Taal',12),(183,'Talisay',12),(184,'Taysan',12),(185,'Tingloy',12),(186,'Tuy',12),(187,'Baguio City',13),(188,'Atok',13),(189,'Bakun',13),(190,'Bokod',13),(191,'Buguias',13),(192,'Itogon',13),(193,'Kabayan',13),(194,'Kapangan',13),(195,'Kibungan',13),(196,'La Trinidad',13),(197,'Mankayan',13),(198,'Sablan',13),(199,'Tuba',13),(200,'Tublay',13),(201,'Almeria',14),(202,'Biliran',14),(203,'Cabucgayan',14),(204,'Caibiran',14),(205,'Culaba',14),(206,'Kawayan',14),(207,'Maripipi',14),(208,'Naval',14),(209,'Tagbilaran City',15),(210,'Alburquerque',15),(211,'Alicia',15),(212,'Anda',15),(213,'Antequera',15),(214,'Baclayon',15),(215,'Balilihan',15),(216,'Batuan',15),(217,'Bien Unido',15),(218,'Bilar',15),(219,'Buenavista',15),(220,'Calape',15),(221,'Candijay',15),(222,'Carmen',15),(223,'Catigbian',15),(224,'Clarin',15),(225,'Corella',15),(226,'Cortes',15),(227,'Dagohoy',15),(228,'Danao',15),(229,'Dauis',15),(230,'Dimiao',15),(231,'Duero',15),(232,'Garcia Hernandez',15),(233,'Getafe',15),(234,'Guindulman',15),(235,'Inabanga',15),(236,'Jagna',15),(237,'Lila',15),(238,'Loay',15),(239,'Loboc',15),(240,'Loon',15),(241,'Mabini',15),(242,'Maribojoc',15),(243,'Panglao',15),(244,'Pilar',15),(245,'President Carlos P. Garcia',15),(246,'Sagbayan',15),(247,'San Isidro',15),(248,'San Miguel',15),(249,'Sevilla',15),(250,'Sierra Bullones',15),(251,'Sikatuna',15),(252,'Talibon',15),(253,'Trinidad',15),(254,'Tubigon',15),(255,'Ubay',15),(256,'Valencia',15),(257,'Malaybalay City',16),(258,'Valencia City',16),(259,'Baungon',16),(260,'Cabanglasan',16),(261,'Damulog',16),(262,'Dangcagan',16),(263,'Don Carlos',16),(264,'Impasug-ong',16),(265,'Kadingilan',16),(266,'Kalilangan',16),(267,'Kibawe',16),(268,'Kitaotao',16),(269,'Lantapan',16),(270,'Libona',16),(271,'Malitbog',16),(272,'Manolo Fortich',16),(273,'Maramag',16),(274,'Pangantucan',16),(275,'Quezon',16),(276,'San Fernando',16),(277,'Sumilao',16),(278,'Talakag',16),(279,'Malolos City',17),(280,'Meycauayan City',17),(281,'San Jose del Monte City',17),(282,'Angat',17),(283,'Balagtas',17),(284,'Baliuag',17),(285,'Bocaue',17),(286,'Bulacan',17),(287,'Bustos',17),(288,'Calumpit',17),(289,'Doña Remedios Trinidad',17),(290,'Guiguinto',17),(291,'Hagonoy',17),(292,'Marilao',17),(293,'Norzagaray',17),(294,'Obando',17),(295,'Pandi',17),(296,'Paombong',17),(297,'Plaridel',17),(298,'Pulilan',17),(299,'San Ildefonso',17),(300,'San Miguel',17),(301,'San Rafael',17),(302,'Santa Maria',17),(303,'Tuguegarao City',18),(304,'Abulug',18),(305,'Alcala',18),(306,'Allacapan',18),(307,'Amulung',18),(308,'Aparri',18),(309,'Baggao',18),(310,'Ballesteros',18),(311,'Buguey',18),(312,'Calayan',18),(313,'Camalaniugan',18),(314,'Claveria',18),(315,'Enrile',18),(316,'Gattaran',18),(317,'Gonzaga',18),(318,'Iguig',18),(319,'Lal-lo',18),(320,'Lasam',18),(321,'Pamplona',18),(322,'Peñablanca',18),(323,'Piat',18),(324,'Rizal',18),(325,'Sanchez-Mira',18),(326,'Santa Ana',18),(327,'Santa Praxedes',18),(328,'Santa Teresita',18),(329,'Santo Niño',18),(330,'Solana',18),(331,'Tuao',18),(332,'Basud',19),(333,'Capalonga',19),(334,'Daet',19),(335,'Jose Panganiban',19),(336,'Labo',19),(337,'Mercedes',19),(338,'Paracale',19),(339,'San Lorenzo Ruiz',19),(340,'San Vicente',19),(341,'Santa Elena',19),(342,'Talisay',19),(343,'Vinzons',19),(344,'Iriga City',20),(345,'Naga City',20),(346,'Baao',20),(347,'Balatan',20),(348,'Bato',20),(349,'Bombon',20),(350,'Buhi',20),(351,'Bula',20),(352,'Cabusao',20),(353,'Calabanga',20),(354,'Camaligan',20),(355,'Canaman',20),(356,'Caramoan',20),(357,'Del Gallego',20),(358,'Gainza',20),(359,'Garchitorena',20),(360,'Goa',20),(361,'Lagonoy',20),(362,'Libmanan',20),(363,'Lupi',20),(364,'Magarao',20),(365,'Milaor',20),(366,'Minalabac',20),(367,'Nabua',20),(368,'Ocampo',20),(369,'Pamplona',20),(370,'Pasacao',20),(371,'Pili',20),(372,'Presentacion',20),(373,'Ragay',20),(374,'Sagñay',20),(375,'San Fernando',20),(376,'San Jose',20),(377,'Sipocot',20),(378,'Siruma',20),(379,'Tigaon',20),(380,'Tinambac',20),(381,'Catarman',21),(382,'Guinsiliban',21),(383,'Mahinog',21),(384,'Mambajao',21),(385,'Sagay',21),(386,'Roxas City',22),(387,'Cuartero',22),(388,'Dao',22),(389,'Dumalag',22),(390,'Dumarao',22),(391,'Ivisan',22),(392,'Jamindan',22),(393,'Ma-ayon',22),(394,'Mambusao',22),(395,'Panay',22),(396,'Panitan',22),(397,'Pilar',22),(398,'Pontevedra',22),(399,'President Roxas',22),(400,'Sapi-an',22),(401,'Sigma',22),(402,'Tapaz',22),(403,'Bagamanoc',23),(404,'Baras',23),(405,'Bato',23),(406,'Caramoran',23),(407,'Gigmoto',23),(408,'Pandan',23),(409,'Panganiban',23),(410,'San Andres',23),(411,'San Miguel',23),(412,'Viga',23),(413,'Virac',23),(414,'Cavite City',24),(415,'Dasmariñas City',24),(416,'Tagaytay City',24),(417,'Trece Martires City',24),(418,'Alfonso',24),(419,'Amadeo',24),(420,'Bacoor',24),(421,'Carmona',24),(422,'General Mariano Alvarez',24),(423,'General Emilio Aguinaldo',24),(424,'General Trias',24),(425,'Imus',24),(426,'Indang',24),(427,'Kawit',24),(428,'Magallanes',24),(429,'Maragondon',24),(430,'Mendez',24),(431,'Naic',24),(432,'Noveleta',24),(433,'Rosario',24),(434,'Silang',24),(435,'Tanza',24),(436,'Ternate',24),(437,'Bogo City',25),(438,'Cebu City',25),(439,'Carcar City',25),(440,'Danao City',25),(441,'Lapu-Lapu City',25),(442,'Mandaue City',25),(443,'Naga City',25),(444,'Talisay City',25),(445,'Toledo City',25),(446,'Alcantara',25),(447,'Alcoy',25),(448,'Alegria',25),(449,'Aloguinsan',25),(450,'Argao',25),(451,'Asturias',25),(452,'Badian',25),(453,'Balamban',25),(454,'Bantayan',25),(455,'Barili',25),(456,'Boljoon',25),(457,'Borbon',25),(458,'Carmen',25),(459,'Catmon',25),(460,'Compostela',25),(461,'Consolacion',25),(462,'Cordoba',25),(463,'Daanbantayan',25),(464,'Dalaguete',25),(465,'Dumanjug',25),(466,'Ginatilan',25),(467,'Liloan',25),(468,'Madridejos',25),(469,'Malabuyoc',25),(470,'Medellin',25),(471,'Minglanilla',25),(472,'Moalboal',25),(473,'Oslob',25),(474,'Pilar',25),(475,'Pinamungahan',25),(476,'Poro',25),(477,'Ronda',25),(478,'Samboan',25),(479,'San Fernando',25),(480,'San Francisco',25),(481,'San Remigio',25),(482,'Santa Fe',25),(483,'Santander',25),(484,'Sibonga',25),(485,'Sogod',25),(486,'Tabogon',25),(487,'Tabuelan',25),(488,'Tuburan',25),(489,'Tudela',25),(490,'Compostela',26),(491,'Laak',26),(492,'Mabini',26),(493,'Maco',26),(494,'Maragusan',26),(495,'Mawab',26),(496,'Monkayo',26),(497,'Montevista',26),(498,'Nabunturan',26),(499,'New Bataan',26),(500,'Pantukan',26),(501,'Kidapawan City',27),(502,'Alamada',27),(503,'Aleosan',27),(504,'Antipas',27),(505,'Arakan',27),(506,'Banisilan',27),(507,'Carmen',27),(508,'Kabacan',27),(509,'Libungan',27),(510,'M\'lang',27),(511,'Magpet',27),(512,'Makilala',27),(513,'Matalam',27),(514,'Midsayap',27),(515,'Pigkawayan',27),(516,'Pikit',27),(517,'President Roxas',27),(518,'Tulunan',27),(519,'Panabo City',28),(520,'Island Garden City of Samal',28),(521,'Tagum City',28),(522,'Asuncion',28),(523,'Braulio E. Dujali',28),(524,'Carmen',28),(525,'Kapalong',28),(526,'New Corella',28),(527,'San Isidro',28),(528,'Santo Tomas',28),(529,'Talaingod',28),(530,'Davao City',29),(531,'Digos City',29),(532,'Bansalan',29),(533,'Don Marcelino',29),(534,'Hagonoy',29),(535,'Jose Abad Santos',29),(536,'Kiblawan',29),(537,'Magsaysay',29),(538,'Malalag',29),(539,'Malita',29),(540,'Matanao',29),(541,'Padada',29),(542,'Santa Cruz',29),(543,'Santa Maria',29),(544,'Sarangani',29),(545,'Sulop',29),(546,'Mati City',30),(547,'Baganga',30),(548,'Banaybanay',30),(549,'Boston',30),(550,'Caraga',30),(551,'Cateel',30),(552,'Governor Generoso',30),(553,'Lupon',30),(554,'Manay',30),(555,'San Isidro',30),(556,'Tarragona',30),(557,'Arteche',31),(558,'Balangiga',31),(559,'Balangkayan',31),(560,'Borongan',31),(561,'Can-avid',31),(562,'Dolores',31),(563,'General MacArthur',31),(564,'Giporlos',31),(565,'Guiuan',31),(566,'Hernani',31),(567,'Jipapad',31),(568,'Lawaan',31),(569,'Llorente',31),(570,'Maslog',31),(571,'Maydolong',31),(572,'Mercedes',31),(573,'Oras',31),(574,'Quinapondan',31),(575,'Salcedo',31),(576,'San Julian',31),(577,'San Policarpo',31),(578,'Sulat',31),(579,'Taft',31),(580,'Buenavista',32),(581,'Jordan',32),(582,'Nueva Valencia',32),(583,'San Lorenzo',32),(584,'Sibunag',32),(585,'Aguinaldo',33),(586,'Alfonso Lista',33),(587,'Asipulo',33),(588,'Banaue',33),(589,'Hingyon',33),(590,'Hungduan',33),(591,'Kiangan',33),(592,'Lagawe',33),(593,'Lamut',33),(594,'Mayoyao',33),(595,'Tinoc',33),(596,'Batac City',34),(597,'Laoag City',34),(598,'Adams',34),(599,'Bacarra',34),(600,'Badoc',34),(601,'Bangui',34),(602,'Banna',34),(603,'Burgos',34),(604,'Carasi',34),(605,'Currimao',34),(606,'Dingras',34),(607,'Dumalneg',34),(608,'Marcos',34),(609,'Nueva Era',34),(610,'Pagudpud',34),(611,'Paoay',34),(612,'Pasuquin',34),(613,'Piddig',34),(614,'Pinili',34),(615,'San Nicolas',34),(616,'Sarrat',34),(617,'Solsona',34),(618,'Vintar',34),(619,'Candon City',35),(620,'Vigan City',35),(621,'Alilem',35),(622,'Banayoyo',35),(623,'Bantay',35),(624,'Burgos',35),(625,'Cabugao',35),(626,'Caoayan',35),(627,'Cervantes',35),(628,'Galimuyod',35),(629,'Gregorio Del Pilar',35),(630,'Lidlidda',35),(631,'Magsingal',35),(632,'Nagbukel',35),(633,'Narvacan',35),(634,'Quirino',35),(635,'Salcedo',35),(636,'San Emilio',35),(637,'San Esteban',35),(638,'San Ildefonso',35),(639,'San Juan',35),(640,'San Vicente',35),(641,'Santa',35),(642,'Santa Catalina',35),(643,'Santa Cruz',35),(644,'Santa Lucia',35),(645,'Santa Maria',35),(646,'Santiago',35),(647,'Santo Domingo',35),(648,'Sigay',35),(649,'Sinait',35),(650,'Sugpon',35),(651,'Suyo',35),(652,'Tagudin',35),(653,'Iloilo City',36),(654,'Passi City',36),(655,'Ajuy',36),(656,'Alimodian',36),(657,'Anilao',36),(658,'Badiangan',36),(659,'Balasan',36),(660,'Banate',36),(661,'Barotac Nuevo',36),(662,'Barotac Viejo',36),(663,'Batad',36),(664,'Bingawan',36),(665,'Cabatuan',36),(666,'Calinog',36),(667,'Carles',36),(668,'Concepcion',36),(669,'Dingle',36),(670,'Dueñas',36),(671,'Dumangas',36),(672,'Estancia',36),(673,'Guimbal',36),(674,'Igbaras',36),(675,'Janiuay',36),(676,'Lambunao',36),(677,'Leganes',36),(678,'Lemery',36),(679,'Leon',36),(680,'Maasin',36),(681,'Miagao',36),(682,'Mina',36),(683,'New Lucena',36),(684,'Oton',36),(685,'Pavia',36),(686,'Pototan',36),(687,'San Dionisio',36),(688,'San Enrique',36),(689,'San Joaquin',36),(690,'San Miguel',36),(691,'San Rafael',36),(692,'Santa Barbara',36),(693,'Sara',36),(694,'Tigbauan',36),(695,'Tubungan',36),(696,'Zarraga',36),(697,'Cauayan City',37),(698,'Santiago City',37),(699,'Alicia',37),(700,'Angadanan',37),(701,'Aurora',37),(702,'Benito Soliven',37),(703,'Burgos',37),(704,'Cabagan',37),(705,'Cabatuan',37),(706,'Cordon',37),(707,'Delfin Albano',37),(708,'Dinapigue',37),(709,'Divilacan',37),(710,'Echague',37),(711,'Gamu',37),(712,'Ilagan',37),(713,'Jones',37),(714,'Luna',37),(715,'Maconacon',37),(716,'Mallig',37),(717,'Naguilian',37),(718,'Palanan',37),(719,'Quezon',37),(720,'Quirino',37),(721,'Ramon',37),(722,'Reina Mercedes',37),(723,'Roxas',37),(724,'San Agustin',37),(725,'San Guillermo',37),(726,'San Isidro',37),(727,'San Manuel',37),(728,'San Mariano',37),(729,'San Mateo',37),(730,'San Pablo',37),(731,'Santa Maria',37),(732,'Santo Tomas',37),(733,'Tumauini',37),(734,'Tabuk',38),(735,'Balbalan',38),(736,'Lubuagan',38),(737,'Pasil',38),(738,'Pinukpuk',38),(739,'Rizal',38),(740,'Tanudan',38),(741,'Tinglayan',38),(742,'San Fernando City',39),(743,'Agoo',39),(744,'Aringay',39),(745,'Bacnotan',39),(746,'Bagulin',39),(747,'Balaoan',39),(748,'Bangar',39),(749,'Bauang',39),(750,'Burgos',39),(751,'Caba',39),(752,'Luna',39),(753,'Naguilian',39),(754,'Pugo',39),(755,'Rosario',39),(756,'San Gabriel',39),(757,'San Juan',39),(758,'Santo Tomas',39),(759,'Santol',39),(760,'Sudipen',39),(761,'Tubao',39),(762,'Biñan City',40),(763,'Calamba City',40),(764,'San Pablo City',40),(765,'Santa Rosa City',40),(766,'Alaminos',40),(767,'Bay',40),(768,'Cabuyao',40),(769,'Calauan',40),(770,'Cavinti',40),(771,'Famy',40),(772,'Kalayaan',40),(773,'Liliw',40),(774,'Los Baños',40),(775,'Luisiana',40),(776,'Lumban',40),(777,'Mabitac',40),(778,'Magdalena',40),(779,'Majayjay',40),(780,'Nagcarlan',40),(781,'Paete',40),(782,'Pagsanjan',40),(783,'Pakil',40),(784,'Pangil',40),(785,'Pila',40),(786,'Rizal',40),(787,'San Pedro',40),(788,'Santa Cruz',40),(789,'Santa Maria',40),(790,'Siniloan',40),(791,'Victoria',40),(792,'Iligan City',41),(793,'Bacolod',41),(794,'Baloi',41),(795,'Baroy',41),(796,'Kapatagan',41),(797,'Kauswagan',41),(798,'Kolambugan',41),(799,'Lala',41),(800,'Linamon',41),(801,'Magsaysay',41),(802,'Maigo',41),(803,'Matungao',41),(804,'Munai',41),(805,'Nunungan',41),(806,'Pantao Ragat',41),(807,'Pantar',41),(808,'Poona Piagapo',41),(809,'Salvador',41),(810,'Sapad',41),(811,'Sultan Naga Dimaporo',41),(812,'Tagoloan',41),(813,'Tangcal',41),(814,'Tubod',41),(815,'Marawi City',42),(816,'Bacolod-Kalawi',42),(817,'Balabagan',42),(818,'Balindong',42),(819,'Bayang',42),(820,'Binidayan',42),(821,'Buadiposo-Buntong',42),(822,'Bubong',42),(823,'Bumbaran',42),(824,'Butig',42),(825,'Calanogas',42),(826,'Ditsaan-Ramain',42),(827,'Ganassi',42),(828,'Kapai',42),(829,'Kapatagan',42),(830,'Lumba-Bayabao',42),(831,'Lumbaca-Unayan',42),(832,'Lumbatan',42),(833,'Lumbayanague',42),(834,'Madalum',42),(835,'Madamba',42),(836,'Maguing',42),(837,'Malabang',42),(838,'Marantao',42),(839,'Marogong',42),(840,'Masiu',42),(841,'Mulondo',42),(842,'Pagayawan',42),(843,'Piagapo',42),(844,'Poona Bayabao',42),(845,'Pualas',42),(846,'Saguiaran',42),(847,'Sultan Dumalondong',42),(848,'Picong',42),(849,'Tagoloan II',42),(850,'Tamparan',42),(851,'Taraka',42),(852,'Tubaran',42),(853,'Tugaya',42),(854,'Wao',42),(855,'Ormoc City',43),(856,'Tacloban City',43),(857,'Abuyog',43),(858,'Alangalang',43),(859,'Albuera',43),(860,'Babatngon',43),(861,'Barugo',43),(862,'Bato',43),(863,'Baybay',43),(864,'Burauen',43),(865,'Calubian',43),(866,'Capoocan',43),(867,'Carigara',43),(868,'Dagami',43),(869,'Dulag',43),(870,'Hilongos',43),(871,'Hindang',43),(872,'Inopacan',43),(873,'Isabel',43),(874,'Jaro',43),(875,'Javier',43),(876,'Julita',43),(877,'Kananga',43),(878,'La Paz',43),(879,'Leyte',43),(880,'Liloan',43),(881,'MacArthur',43),(882,'Mahaplag',43),(883,'Matag-ob',43),(884,'Matalom',43),(885,'Mayorga',43),(886,'Merida',43),(887,'Palo',43),(888,'Palompon',43),(889,'Pastrana',43),(890,'San Isidro',43),(891,'San Miguel',43),(892,'Santa Fe',43),(893,'Sogod',43),(894,'Tabango',43),(895,'Tabontabon',43),(896,'Tanauan',43),(897,'Tolosa',43),(898,'Tunga',43),(899,'Villaba',43),(900,'Cotabato City',44),(901,'Ampatuan',44),(902,'Barira',44),(903,'Buldon',44),(904,'Buluan',44),(905,'Datu Abdullah Sangki',44),(906,'Datu Anggal Midtimbang',44),(907,'Datu Blah T. Sinsuat',44),(908,'Datu Hoffer Ampatuan',44),(909,'Datu Montawal',44),(910,'Datu Odin Sinsuat',44),(911,'Datu Paglas',44),(912,'Datu Piang',44),(913,'Datu Salibo',44),(914,'Datu Saudi-Ampatuan',44),(915,'Datu Unsay',44),(916,'General Salipada K. Pendatun',44),(917,'Guindulungan',44),(918,'Kabuntalan',44),(919,'Mamasapano',44),(920,'Mangudadatu',44),(921,'Matanog',44),(922,'Northern Kabuntalan',44),(923,'Pagalungan',44),(924,'Paglat',44),(925,'Pandag',44),(926,'Parang',44),(927,'Rajah Buayan',44),(928,'Shariff Aguak',44),(929,'Shariff Saydona Mustapha',44),(930,'South Upi',44),(931,'Sultan Kudarat',44),(932,'Sultan Mastura',44),(933,'Sultan sa Barongis',44),(934,'Talayan',44),(935,'Talitay',44),(936,'Upi',44),(937,'Boac',45),(938,'Buenavista',45),(939,'Gasan',45),(940,'Mogpog',45),(941,'Santa Cruz',45),(942,'Torrijos',45),(943,'Masbate City',46),(944,'Aroroy',46),(945,'Baleno',46),(946,'Balud',46),(947,'Batuan',46),(948,'Cataingan',46),(949,'Cawayan',46),(950,'Claveria',46),(951,'Dimasalang',46),(952,'Esperanza',46),(953,'Mandaon',46),(954,'Milagros',46),(955,'Mobo',46),(956,'Monreal',46),(957,'Palanas',46),(958,'Pio V. Corpuz',46),(959,'Placer',46),(960,'San Fernando',46),(961,'San Jacinto',46),(962,'San Pascual',46),(963,'Uson',46),(964,'Caloocan',47),(965,'Las Piñas',47),(966,'Makati',47),(967,'Malabon',47),(968,'Mandaluyong',47),(969,'Manila',47),(970,'Marikina',47),(971,'Muntinlupa',47),(972,'Navotas',47),(973,'Parañaque',47),(974,'Pasay',47),(975,'Pasig',47),(976,'Quezon City',47),(977,'San Juan City',47),(978,'Taguig',47),(979,'Valenzuela City',47),(980,'Pateros',47),(981,'Oroquieta City',48),(982,'Ozamiz City',48),(983,'Tangub City',48),(984,'Aloran',48),(985,'Baliangao',48),(986,'Bonifacio',48),(987,'Calamba',48),(988,'Clarin',48),(989,'Concepcion',48),(990,'Don Victoriano Chiongbian',48),(991,'Jimenez',48),(992,'Lopez Jaena',48),(993,'Panaon',48),(994,'Plaridel',48),(995,'Sapang Dalaga',48),(996,'Sinacaban',48),(997,'Tudela',48),(998,'Cagayan de Oro',49),(999,'Gingoog City',49),(1000,'Alubijid',49),(1001,'Balingasag',49),(1002,'Balingoan',49),(1003,'Binuangan',49),(1004,'Claveria',49),(1005,'El Salvador',49),(1006,'Gitagum',49),(1007,'Initao',49),(1008,'Jasaan',49),(1009,'Kinoguitan',49),(1010,'Lagonglong',49),(1011,'Laguindingan',49),(1012,'Libertad',49),(1013,'Lugait',49),(1014,'Magsaysay',49),(1015,'Manticao',49),(1016,'Medina',49),(1017,'Naawan',49),(1018,'Opol',49),(1019,'Salay',49),(1020,'Sugbongcogon',49),(1021,'Tagoloan',49),(1022,'Talisayan',49),(1023,'Villanueva',49),(1024,'Barlig',50),(1025,'Bauko',50),(1026,'Besao',50),(1027,'Bontoc',50),(1028,'Natonin',50),(1029,'Paracelis',50),(1030,'Sabangan',50),(1031,'Sadanga',50),(1032,'Sagada',50),(1033,'Tadian',50),(1034,'Bacolod City',51),(1035,'Bago City',51),(1036,'Cadiz City',51),(1037,'Escalante City',51),(1038,'Himamaylan City',51),(1039,'Kabankalan City',51),(1040,'La Carlota City',51),(1041,'Sagay City',51),(1042,'San Carlos City',51),(1043,'Silay City',51),(1044,'Sipalay City',51),(1045,'Talisay City',51),(1046,'Victorias City',51),(1047,'Binalbagan',51),(1048,'Calatrava',51),(1049,'Candoni',51),(1050,'Cauayan',51),(1051,'Enrique B. Magalona',51),(1052,'Hinigaran',51),(1053,'Hinoba-an',51),(1054,'Ilog',51),(1055,'Isabela',51),(1056,'La Castellana',51),(1057,'Manapla',51),(1058,'Moises Padilla',51),(1059,'Murcia',51),(1060,'Pontevedra',51),(1061,'Pulupandan',51),(1062,'Salvador Benedicto',51),(1063,'San Enrique',51),(1064,'Toboso',51),(1065,'Valladolid',51),(1066,'Bais City',52),(1067,'Bayawan City',52),(1068,'Canlaon City',52),(1069,'Guihulngan City',52),(1070,'Dumaguete City',52),(1071,'Tanjay City',52),(1072,'Amlan',52),(1073,'Ayungon',52),(1074,'Bacong',52),(1075,'Basay',52),(1076,'Bindoy',52),(1077,'Dauin',52),(1078,'Jimalalud',52),(1079,'La Libertad',52),(1080,'Mabinay',52),(1081,'Manjuyod',52),(1082,'Pamplona',52),(1083,'San Jose',52),(1084,'Santa Catalina',52),(1085,'Siaton',52),(1086,'Sibulan',52),(1087,'Tayasan',52),(1088,'Valencia',52),(1089,'Vallehermoso',52),(1090,'Zamboanguita',52),(1091,'Allen',53),(1092,'Biri',53),(1093,'Bobon',53),(1094,'Capul',53),(1095,'Catarman',53),(1096,'Catubig',53),(1097,'Gamay',53),(1098,'Laoang',53),(1099,'Lapinig',53),(1100,'Las Navas',53),(1101,'Lavezares',53),(1102,'Lope de Vega',53),(1103,'Mapanas',53),(1104,'Mondragon',53),(1105,'Palapag',53),(1106,'Pambujan',53),(1107,'Rosario',53),(1108,'San Antonio',53),(1109,'San Isidro',53),(1110,'San Jose',53),(1111,'San Roque',53),(1112,'San Vicente',53),(1113,'Silvino Lobos',53),(1114,'Victoria',53),(1115,'Cabanatuan City',54),(1116,'Gapan City',54),(1117,'Science City of Muñoz',54),(1118,'Palayan City',54),(1119,'San Jose City',54),(1120,'Aliaga',54),(1121,'Bongabon',54),(1122,'Cabiao',54),(1123,'Carranglan',54),(1124,'Cuyapo',54),(1125,'Gabaldon',54),(1126,'General Mamerto Natividad',54),(1127,'General Tinio',54),(1128,'Guimba',54),(1129,'Jaen',54),(1130,'Laur',54),(1131,'Licab',54),(1132,'Llanera',54),(1133,'Lupao',54),(1134,'Nampicuan',54),(1135,'Pantabangan',54),(1136,'Peñaranda',54),(1137,'Quezon',54),(1138,'Rizal',54),(1139,'San Antonio',54),(1140,'San Isidro',54),(1141,'San Leonardo',54),(1142,'Santa Rosa',54),(1143,'Santo Domingo',54),(1144,'Talavera',54),(1145,'Talugtug',54),(1146,'Zaragoza',54),(1147,'Alfonso Castaneda',55),(1148,'Ambaguio',55),(1149,'Aritao',55),(1150,'Bagabag',55),(1151,'Bambang',55),(1152,'Bayombong',55),(1153,'Diadi',55),(1154,'Dupax del Norte',55),(1155,'Dupax del Sur',55),(1156,'Kasibu',55),(1157,'Kayapa',55),(1158,'Quezon',55),(1159,'Santa Fe',55),(1160,'Solano',55),(1161,'Villaverde',55),(1162,'Abra de Ilog',56),(1163,'Calintaan',56),(1164,'Looc',56),(1165,'Lubang',56),(1166,'Magsaysay',56),(1167,'Mamburao',56),(1168,'Paluan',56),(1169,'Rizal',56),(1170,'Sablayan',56),(1171,'San Jose',56),(1172,'Santa Cruz',56),(1173,'Calapan City',57),(1174,'Baco',57),(1175,'Bansud',57),(1176,'Bongabong',57),(1177,'Bulalacao',57),(1178,'Gloria',57),(1179,'Mansalay',57),(1180,'Naujan',57),(1181,'Pinamalayan',57),(1182,'Pola',57),(1183,'Puerto Galera',57),(1184,'Roxas',57),(1185,'San Teodoro',57),(1186,'Socorro',57),(1187,'Victoria',57),(1188,'Puerto Princesa City',58),(1189,'Aborlan',58),(1190,'Agutaya',58),(1191,'Araceli',58),(1192,'Balabac',58),(1193,'Bataraza',58),(1194,'Brooke\'s Point',58),(1195,'Busuanga',58),(1196,'Cagayancillo',58),(1197,'Coron',58),(1198,'Culion',58),(1199,'Cuyo',58),(1200,'Dumaran',58),(1201,'El Nido',58),(1202,'Kalayaan',58),(1203,'Linapacan',58),(1204,'Magsaysay',58),(1205,'Narra',58),(1206,'Quezon',58),(1207,'Rizal',58),(1208,'Roxas',58),(1209,'San Vicente',58),(1210,'Sofronio Española',58),(1211,'Taytay',58),(1212,'Angeles City',59),(1213,'City of San Fernando',59),(1214,'Apalit',59),(1215,'Arayat',59),(1216,'Bacolor',59),(1217,'Candaba',59),(1218,'Floridablanca',59),(1219,'Guagua',59),(1220,'Lubao',59),(1221,'Mabalacat',59),(1222,'Macabebe',59),(1223,'Magalang',59),(1224,'Masantol',59),(1225,'Mexico',59),(1226,'Minalin',59),(1227,'Porac',59),(1228,'San Luis',59),(1229,'San Simon',59),(1230,'Santa Ana',59),(1231,'Santa Rita',59),(1232,'Santo Tomas',59),(1233,'Sasmuan',59),(1234,'Alaminos City',60),(1235,'Dagupan City',60),(1236,'San Carlos City',60),(1237,'Urdaneta City',60),(1238,'Agno',60),(1239,'Aguilar',60),(1240,'Alcala',60),(1241,'Anda',60),(1242,'Asingan',60),(1243,'Balungao',60),(1244,'Bani',60),(1245,'Basista',60),(1246,'Bautista',60),(1247,'Bayambang',60),(1248,'Binalonan',60),(1249,'Binmaley',60),(1250,'Bolinao',60),(1251,'Bugallon',60),(1252,'Burgos',60),(1253,'Calasiao',60),(1254,'Dasol',60),(1255,'Infanta',60),(1256,'Labrador',60),(1257,'Laoac',60),(1258,'Lingayen',60),(1259,'Mabini',60),(1260,'Malasiqui',60),(1261,'Manaoag',60),(1262,'Mangaldan',60),(1263,'Mangatarem',60),(1264,'Mapandan',60),(1265,'Natividad',60),(1266,'Pozzorubio',60),(1267,'Rosales',60),(1268,'San Fabian',60),(1269,'San Jacinto',60),(1270,'San Manuel',60),(1271,'San Nicolas',60),(1272,'San Quintin',60),(1273,'Santa Barbara',60),(1274,'Santa Maria',60),(1275,'Santo Tomas',60),(1276,'Sison',60),(1277,'Sual',60),(1278,'Tayug',60),(1279,'Umingan',60),(1280,'Urbiztondo',60),(1281,'Villasis',60),(1282,'Lucena City',61),(1283,'Tayabas City',61),(1284,'Agdangan',61),(1285,'Alabat',61),(1286,'Atimonan',61),(1287,'Buenavista',61),(1288,'Burdeos',61),(1289,'Calauag',61),(1290,'Candelaria',61),(1291,'Catanauan',61),(1292,'Dolores',61),(1293,'General Luna',61),(1294,'General Nakar',61),(1295,'Guinayangan',61),(1296,'Gumaca',61),(1297,'Infanta',61),(1298,'Jomalig',61),(1299,'Lopez',61),(1300,'Lucban',61),(1301,'Macalelon',61),(1302,'Mauban',61),(1303,'Mulanay',61),(1304,'Padre Burgos',61),(1305,'Pagbilao',61),(1306,'Panukulan',61),(1307,'Patnanungan',61),(1308,'Perez',61),(1309,'Pitogo',61),(1310,'Plaridel',61),(1311,'Polillo',61),(1312,'Quezon',61),(1313,'Real',61),(1314,'Sampaloc',61),(1315,'San Andres',61),(1316,'San Antonio',61),(1317,'San Francisco',61),(1318,'San Narciso',61),(1319,'Sariaya',61),(1320,'Tagkawayan',61),(1321,'Tiaong',61),(1322,'Unisan',61),(1323,'Aglipay',62),(1324,'Cabarroguis',62),(1325,'Diffun',62),(1326,'Maddela',62),(1327,'Nagtipunan',62),(1328,'Saguday',62),(1329,'Antipolo City',63),(1330,'Angono',63),(1331,'Baras',63),(1332,'Binangonan',63),(1333,'Cainta',63),(1334,'Cardona',63),(1335,'Jalajala',63),(1336,'Morong',63),(1337,'Pililla',63),(1338,'Rodriguez',63),(1339,'San Mateo',63),(1340,'Tanay',63),(1341,'Taytay',63),(1342,'Teresa',63),(1343,'Alcantara',64),(1344,'Banton',64),(1345,'Cajidiocan',64),(1346,'Calatrava',64),(1347,'Concepcion',64),(1348,'Corcuera',64),(1349,'Ferrol',64),(1350,'Looc',64),(1351,'Magdiwang',64),(1352,'Odiongan',64),(1353,'Romblon',64),(1354,'San Agustin',64),(1355,'San Andres',64),(1356,'San Fernando',64),(1357,'San Jose',64),(1358,'Santa Fe',64),(1359,'Santa Maria',64),(1360,'Calbayog City',65),(1361,'Catbalogan City',65),(1362,'Almagro',65),(1363,'Basey',65),(1364,'Calbiga',65),(1365,'Daram',65),(1366,'Gandara',65),(1367,'Hinabangan',65),(1368,'Jiabong',65),(1369,'Marabut',65),(1370,'Matuguinao',65),(1371,'Motiong',65),(1372,'Pagsanghan',65),(1373,'Paranas',65),(1374,'Pinabacdao',65),(1375,'San Jorge',65),(1376,'San Jose De Buan',65),(1377,'San Sebastian',65),(1378,'Santa Margarita',65),(1379,'Santa Rita',65),(1380,'Santo Niño',65),(1381,'Tagapul-an',65),(1382,'Talalora',65),(1383,'Tarangnan',65),(1384,'Villareal',65),(1385,'Zumarraga',65),(1386,'Alabel',66),(1387,'Glan',66),(1388,'Kiamba',66),(1389,'Maasim',66),(1390,'Maitum',66),(1391,'Malapatan',66),(1392,'Malungon',66),(1393,'Enrique Villanueva',67),(1394,'Larena',67),(1395,'Lazi',67),(1396,'Maria',67),(1397,'San Juan',67),(1398,'Siquijor',67),(1399,'Sorsogon City',68),(1400,'Barcelona',68),(1401,'Bulan',68),(1402,'Bulusan',68),(1403,'Casiguran',68),(1404,'Castilla',68),(1405,'Donsol',68),(1406,'Gubat',68),(1407,'Irosin',68),(1408,'Juban',68),(1409,'Magallanes',68),(1410,'Matnog',68),(1411,'Pilar',68),(1412,'Prieto Diaz',68),(1413,'Santa Magdalena',68),(1414,'General Santos City',69),(1415,'Koronadal City',69),(1416,'Banga',69),(1417,'Lake Sebu',69),(1418,'Norala',69),(1419,'Polomolok',69),(1420,'Santo Niño',69),(1421,'Surallah',69),(1422,'T\'boli',69),(1423,'Tampakan',69),(1424,'Tantangan',69),(1425,'Tupi',69),(1426,'Maasin City',70),(1427,'Anahawan',70),(1428,'Bontoc',70),(1429,'Hinunangan',70),(1430,'Hinundayan',70),(1431,'Libagon',70),(1432,'Liloan',70),(1433,'Limasawa',70),(1434,'Macrohon',70),(1435,'Malitbog',70),(1436,'Padre Burgos',70),(1437,'Pintuyan',70),(1438,'Saint Bernard',70),(1439,'San Francisco',70),(1440,'San Juan',70),(1441,'San Ricardo',70),(1442,'Silago',70),(1443,'Sogod',70),(1444,'Tomas Oppus',70),(1445,'Tacurong City',71),(1446,'Bagumbayan',71),(1447,'Columbio',71),(1448,'Esperanza',71),(1449,'Isulan',71),(1450,'Kalamansig',71),(1451,'Lambayong',71),(1452,'Lebak',71),(1453,'Lutayan',71),(1454,'Palimbang',71),(1455,'President Quirino',71),(1456,'Senator Ninoy Aquino',71),(1457,'Banguingui',72),(1458,'Hadji Panglima Tahil',72),(1459,'Indanan',72),(1460,'Jolo',72),(1461,'Kalingalan Caluang',72),(1462,'Lugus',72),(1463,'Luuk',72),(1464,'Maimbung',72),(1465,'Old Panamao',72),(1466,'Omar',72),(1467,'Pandami',72),(1468,'Panglima Estino',72),(1469,'Pangutaran',72),(1470,'Parang',72),(1471,'Pata',72),(1472,'Patikul',72),(1473,'Siasi',72),(1474,'Talipao',72),(1475,'Tapul',72),(1476,'Surigao City',73),(1477,'Alegria',73),(1478,'Bacuag',73),(1479,'Basilisa',73),(1480,'Burgos',73),(1481,'Cagdianao',73),(1482,'Claver',73),(1483,'Dapa',73),(1484,'Del Carmen',73),(1485,'Dinagat',73),(1486,'General Luna',73),(1487,'Gigaquit',73),(1488,'Libjo',73),(1489,'Loreto',73),(1490,'Mainit',73),(1491,'Malimono',73),(1492,'Pilar',73),(1493,'Placer',73),(1494,'San Benito',73),(1495,'San Francisco',73),(1496,'San Isidro',73),(1497,'San Jose',73),(1498,'Santa Monica',73),(1499,'Sison',73),(1500,'Socorro',73),(1501,'Tagana-an',73),(1502,'Tubajon',73),(1503,'Tubod',73),(1504,'Bislig City',74),(1505,'Tandag City',74),(1506,'Barobo',74),(1507,'Bayabas',74),(1508,'Cagwait',74),(1509,'Cantilan',74),(1510,'Carmen',74),(1511,'Carrascal',74),(1512,'Cortes',74),(1513,'Hinatuan',74),(1514,'Lanuza',74),(1515,'Lianga',74),(1516,'Lingig',74),(1517,'Madrid',74),(1518,'Marihatag',74),(1519,'San Agustin',74),(1520,'San Miguel',74),(1521,'Tagbina',74),(1522,'Tago',74),(1523,'Tarlac City',75),(1524,'Anao',75),(1525,'Bamban',75),(1526,'Camiling',75),(1527,'Capas',75),(1528,'Concepcion',75),(1529,'Gerona',75),(1530,'La Paz',75),(1531,'Mayantoc',75),(1532,'Moncada',75),(1533,'Paniqui',75),(1534,'Pura',75),(1535,'Ramos',75),(1536,'San Clemente',75),(1537,'San Jose',75),(1538,'San Manuel',75),(1539,'Santa Ignacia',75),(1540,'Victoria',75),(1541,'Bongao',76),(1542,'Languyan',76),(1543,'Mapun',76),(1544,'Panglima Sugala',76),(1545,'Sapa-Sapa',76),(1546,'Sibutu',76),(1547,'Simunul',76),(1548,'Sitangkai',76),(1549,'South Ubian',76),(1550,'Tandubas',76),(1551,'Turtle Islands',76),(1552,'Olongapo City',77),(1553,'Botolan',77),(1554,'Cabangan',77),(1555,'Candelaria',77),(1556,'Castillejos',77),(1557,'Iba',77),(1558,'Masinloc',77),(1559,'Palauig',77),(1560,'San Antonio',77),(1561,'San Felipe',77),(1562,'San Marcelino',77),(1563,'San Narciso',77),(1564,'Santa Cruz',77),(1565,'Subic',77),(1566,'Dapitan City',78),(1567,'Dipolog City',78),(1568,'Bacungan',78),(1569,'Baliguian',78),(1570,'Godod',78),(1571,'Gutalac',78),(1572,'Jose Dalman',78),(1573,'Kalawit',78),(1574,'Katipunan',78),(1575,'La Libertad',78),(1576,'Labason',78),(1577,'Liloy',78),(1578,'Manukan',78),(1579,'Mutia',78),(1580,'Piñan',78),(1581,'Polanco',78),(1582,'President Manuel A. Roxas',78),(1583,'Rizal',78),(1584,'Salug',78),(1585,'Sergio Osmeña Sr.',78),(1586,'Siayan',78),(1587,'Sibuco',78),(1588,'Sibutad',78),(1589,'Sindangan',78),(1590,'Siocon',78),(1591,'Sirawai',78),(1592,'Tampilisan',78),(1593,'Pagadian City',79),(1594,'Zamboanga City',79),(1595,'Aurora',79),(1596,'Bayog',79),(1597,'Dimataling',79),(1598,'Dinas',79),(1599,'Dumalinao',79),(1600,'Dumingag',79),(1601,'Guipos',79),(1602,'Josefina',79),(1603,'Kumalarang',79),(1604,'Labangan',79),(1605,'Lakewood',79),(1606,'Lapuyan',79),(1607,'Mahayag',79),(1608,'Margosatubig',79),(1609,'Midsalip',79),(1610,'Molave',79),(1611,'Pitogo',79),(1612,'Ramon Magsaysay',79),(1613,'San Miguel',79),(1614,'San Pablo',79),(1615,'Sominot',79),(1616,'Tabina',79),(1617,'Tambulig',79),(1618,'Tigbao',79),(1619,'Tukuran',79),(1620,'Vincenzo A. Sagun',79),(1621,'Alicia',80),(1622,'Buug',80),(1623,'Diplahan',80),(1624,'Imelda',80),(1625,'Ipil',80),(1626,'Kabasalan',80),(1627,'Mabuhay',80),(1628,'Malangas',80),(1629,'Naga',80),(1630,'Olutanga',80),(1631,'Payao',80),(1632,'Roseller Lim',80),(1633,'Siay',80),(1634,'Talusan',80),(1635,'Titay',80),(1636,'Tungawan',80);

/*Table structure for table `civil_status` */

DROP TABLE IF EXISTS `civil_status`;

CREATE TABLE `civil_status` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `civil_status` */

insert  into `civil_status`(`id`,`name`,`is_deleted`) values (1,'Single',0),(2,'Married',0),(3,'Widowed',0),(4,'test',1);

/*Table structure for table `client_list` */

DROP TABLE IF EXISTS `client_list`;

CREATE TABLE `client_list` (
  `client_number` bigint(20) NOT NULL AUTO_INCREMENT,
  `lname` varchar(255) DEFAULT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `mname` varchar(255) DEFAULT '0',
  `ename` varchar(255) DEFAULT '0',
  `ind_corp_id` bigint(20) DEFAULT NULL,
  `birthdate` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `civil_status_id` bigint(20) DEFAULT NULL,
  `spouse` varchar(255) DEFAULT NULL,
  `tin_no` varchar(255) DEFAULT NULL,
  `sss_no` varchar(255) DEFAULT NULL,
  `acr_no` varchar(255) DEFAULT NULL,
  `pagibig_no` varchar(255) DEFAULT NULL,
  `rescert_no` varchar(255) DEFAULT NULL,
  `rescert_date` varchar(255) DEFAULT NULL,
  `rescert_place` varchar(255) DEFAULT NULL,
  `bus_type_id` bigint(20) DEFAULT NULL,
  `ind_code_id` bigint(20) DEFAULT NULL,
  `client_type_id` bigint(20) DEFAULT NULL,
  `country_id` bigint(20) DEFAULT NULL,
  `region_id` bigint(20) DEFAULT NULL,
  `con_name` varchar(255) DEFAULT NULL,
  `con_rescert_no` varchar(255) DEFAULT NULL,
  `con_rescert_date` varchar(255) DEFAULT NULL,
  `con_rescert_place` varchar(255) DEFAULT NULL,
  `home_no` varchar(255) DEFAULT NULL,
  `home_brgy` varchar(255) DEFAULT NULL,
  `home_city` varchar(255) DEFAULT NULL,
  `home_zip` varchar(255) DEFAULT NULL,
  `bus_no` varchar(255) DEFAULT NULL,
  `bus_brgy` varchar(255) DEFAULT NULL,
  `bus_city` varchar(255) DEFAULT NULL,
  `bus_zip` varchar(255) DEFAULT NULL,
  `gar_no` varchar(255) DEFAULT NULL,
  `gar_brgy` varchar(255) DEFAULT NULL,
  `gar_city` varchar(255) DEFAULT NULL,
  `gar_zip` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `fax_no` varchar(255) DEFAULT NULL,
  `bus_tel` varchar(255) DEFAULT NULL,
  `home_tel` varchar(255) DEFAULT NULL,
  `pri_con` varchar(255) DEFAULT NULL,
  `sec_con` varchar(255) DEFAULT NULL,
  `applied_by` varchar(255) DEFAULT NULL,
  `applied_date` date DEFAULT NULL,
  `date_modified` date DEFAULT NULL,
  `same_add` varchar(255) DEFAULT NULL,
  `same_add1` varchar(255) DEFAULT NULL,
  `is_deleted` tinyint(4) DEFAULT '0',
  `status_id` tinyint(4) DEFAULT '0',
  `is_blacklisted` tinyint(4) DEFAULT '0',
  `is_dealer` varchar(255) DEFAULT NULL,
  `is_salesman` varchar(255) DEFAULT NULL,
  `is_borrower` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`client_number`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Data for the table `client_list` */

insert  into `client_list`(`client_number`,`lname`,`fname`,`mname`,`ename`,`ind_corp_id`,`birthdate`,`gender`,`civil_status_id`,`spouse`,`tin_no`,`sss_no`,`acr_no`,`pagibig_no`,`rescert_no`,`rescert_date`,`rescert_place`,`bus_type_id`,`ind_code_id`,`client_type_id`,`country_id`,`region_id`,`con_name`,`con_rescert_no`,`con_rescert_date`,`con_rescert_place`,`home_no`,`home_brgy`,`home_city`,`home_zip`,`bus_no`,`bus_brgy`,`bus_city`,`bus_zip`,`gar_no`,`gar_brgy`,`gar_city`,`gar_zip`,`email`,`fax_no`,`bus_tel`,`home_tel`,`pri_con`,`sec_con`,`applied_by`,`applied_date`,`date_modified`,`same_add`,`same_add1`,`is_deleted`,`status_id`,`is_blacklisted`,`is_dealer`,`is_salesman`,`is_borrower`) values (1,'Tumanda','Jay','Esterado','',1,'04/09/2018','Male',1,'12345','123','13','123','123','123','04/05/2018','213',1,1,1,1,1,'1234','123','04/07/2018','213','123','2','3','4','123','2','3','4','123','2','3','4','jay@gmail.com','12123','123','12123','123','123','1','2018-04-05','2018-05-31','checked','checked',0,1,0,'0','0','checked'),(2,'Ribleza','Wilfred','Magdaong','Jr.',1,'04/09/2018','Male',1,'12345','123','13','123','123','123','04/05/2018','213',1,1,0,1,1,'123','123','04/07/2018','213','123','2','3','4','123','2','3','4','123','2','3','4','jay@gmail.com','12123','123','12123','123','123','1','2018-04-07','2018-05-26','checked','checked',0,0,0,'','','checked'),(3,'test','test','test','',1,'04/13/2018','Male',1,'test','123','123','123','123','123','04/13/2018','test',1,1,1,1,1,'test','123','04/13/2018','test','test','tet','test','test','test','tet','test','test',NULL,NULL,NULL,NULL,'test@gmail.com','test','test','test','test','test','1','2018-04-13',NULL,'checked',NULL,1,0,0,'0','0','checked'),(4,'test2','test2','test2','',1,'04/13/2018','Male',1,'test','123','123','123','123','123','04/13/2018','test',1,1,1,1,1,'tes','123','04/13/2018','test','test','test','test','test','test','test','test','test',NULL,NULL,NULL,NULL,'test@gmail.com','test','test','test','test','test','1','2018-04-13','2018-04-13','checked',NULL,1,0,0,'0','0','checked'),(5,'Chicano','Mhar','Vic','',1,'04/02/2018','Male',1,'uuuu','898098','8098098','8098','098098','98908098','04/02/2018','ii8098098',1,1,1,1,1,'Mhar Vic Chicano','8980980','03/05/2018','80989','4342 V. Baltazar St. Pinabuhatan Pasig City','pasig','Pasig','1602','4342 V. Baltazar St. Pinabuhatan Pasig City','pasig','Pasig','1602',NULL,NULL,NULL,NULL,'test@gmail.com','980-90-9','8989908','89098','98098','09809','1','2018-04-13',NULL,'checked',NULL,0,0,0,'0','0','checked'),(6,'Drilon','Bugoy','Test','',1,'04/27/2018','Male',1,'','1231515213','123124415','123124421412','123124214','123124114123','12/31/2008','123141241',1,1,0,1,1,'Bugoy Drilon','1231442','04/16/2018','Buboy','4342 V. Baltazar St. Pinabuhatan Pasig City','905','Manila','1009','4342 V. Baltazar St. Pinabuhatan Pasig City','905','Manila','1009','4342 V. Baltazar St. Pinabuhatan Pasig City','905','Manila','1009','bugoy@gmail.com','312635817546125','123615467','312635817546125','1265417541625','136851283532','1','2018-04-15','2018-05-31','checked','checked',0,1,0,'checked','checked',''),(7,'CONOCONO','CJAY','TEST','',1,'04/15/2018','Male',2,'TEST','123','123','123','12312','123','04/15/2018','TEST',1,1,0,1,1,'TEST','123','04/15/2018','TES','123','TEST','TEST','123','123','TEST','TEST','123','123','TEST','TEST','123','test11@gmail.com','123','123','123','123','123','1','2018-04-15','2018-05-23','checked','checked',0,0,0,'checked','','checked'),(8,'tests','test','test','',1,'04/16/2018','Male',1,'','123','123','123','123','123','04/16/2018','test',1,1,0,1,1,'test','123','04/16/2018','test','test','test','test','test','test','test','test','test','test','test','test','test','test@gmail.com','test','test','test','test','test','1','2018-04-16','2018-05-14','checked','checked',0,0,1,'','','checked'),(9,'Alingalan','Carl Dennis','M','popoy',1,'09/11/1997','Male',1,'','321312','312321','42423213','1231232','1312321','12/31/2031','321321312',1,1,0,1,1,'Majin Bu','4263278426','04/07/2082','Mars','2462 McKinley Hills','423','Tondo','1006','2462 McKinley Hills','423','Tondo','1006','2462 McKinley Hills','423','Tondo','1006','majin_bu@gmail.com','214123213','31214213123','214123213','312442131312','412413123','1','2018-05-08','2018-05-14','checked','checked',0,1,0,'checked','','checked'),(10,'Carcedo','Chris','','',1,'07/16/1997','Male',2,'Mystic','12312','321312','3123123','312312','3213123','03/21/2031','321312',1,1,0,1,1,'Majin bup','21321','03/21/2031','321312312','3123213','3123123','3213213','321312312','3123213','3123123','3213213','321312312','3123213','3123123','3213213','321312312','321321@gmail.com','321312','3123123','3213123','3123123','312312','1','2018-05-31','2018-06-01','checked','checked',0,0,0,'','','checked'),(11,'Yabson','Ataska','Matino','0',1,'06/06/2018','Male',2,'Ang','213123','312312','3123123','3123123','3123123','03/21/2031','31231231',1,4,0,1,1,'12312312','3123123','03/13/2012','3213123','3123123','312323','3123123','3123123','3123123','312323','3123123','3123123','3123123','312323','3123123','3123123','atask@gmail.com','123131','312313','3123123','3123123','3123123123','1','2018-06-06','2018-06-06','checked','checked',0,0,0,'checked','','checked'),(12,'Gantan','Charles Dave','Reyes','0',1,'01/05/1998','Male',1,'','234-422-344-212','12-4423322-12','4232124','2344-2124-4231','1234423','02/03/2044','123321',1,1,0,1,4,'Carl Dennis Alingalan','244231','12/31/2031','Makati','QC','999','QC','23444','QC','999','QC','23444','QC','999','QC','23444','cd@gmail.com','24213','234-4124','123-3444','234421','213123','1','2018-06-20','2018-06-20','checked','checked',0,0,0,'','','checked');

/*Table structure for table `client_requirements_caf` */

DROP TABLE IF EXISTS `client_requirements_caf`;

CREATE TABLE `client_requirements_caf` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `requirement_name` varchar(255) NOT NULL,
  `requirement_code` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `client_no` bigint(20) NOT NULL,
  `app_no` bigint(20) NOT NULL,
  `is_deleted` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=latin1;

/*Data for the table `client_requirements_caf` */

insert  into `client_requirements_caf`(`id`,`requirement_name`,`requirement_code`,`status`,`client_no`,`app_no`,`is_deleted`) values (3,'2 Valid ID','2val','pending',6,15,0),(4,'Baranggay Clearance','BRCL','pending',6,15,0),(5,'Baranggay Clearance','BRCL','received',5,16,0),(6,'2x2 Picture ID','2x2','received',1,17,0),(7,'2 Valid ID','2val','pending',1,17,0),(8,'Baranggay Clearance','BRCL','received',1,17,0),(9,'2x2 Picture ID','2x2','pending',1,5,0),(10,'2 Valid ID','2val','pending',1,5,0),(11,'Baranggay Clearance','BRCL','pending',1,5,0),(12,'2x2 Picture ID','2x2','pending',213,4,0),(13,'2 Valid ID','2val','pending',213,4,0),(14,'Baranggay Clearance','BRCL','pending',213,4,0),(15,'2 Valid ID','2VAL','pending',6,19,0),(16,'Baranggay Clearance','BRCL','pending',6,19,0),(17,'2x2 Picture ID','2X2','pending',5,18,0),(18,'2 Valid ID','2VAL','pending',5,18,0),(19,'Baranggay Clearance','BRCL','pending',5,18,0),(20,'2x2 Picture ID','2X2','pending',1,20,0),(21,'2 Valid ID','2VAL','pending',1,20,0),(22,'Baranggay Clearance','BRCL','pending',1,20,0),(23,'2x2 Picture ID','2X2','pending',9,21,0),(24,'2 Valid ID','2VAL','pending',9,21,0),(25,'Baranggay Clearance','BRCL','pending',9,21,0),(26,'2x2 Picture ID','2X2','pending',9,22,0),(27,'2 Valid ID','2VAL','pending',9,22,0),(28,'Baranggay Clearance','BRCL','pending',9,22,0),(29,'2 Valid ID','2VAL','pending',9,25,0),(30,'Baranggay Clearance','BRCL','pending',9,25,0),(31,'2x2 Picture ID','2X2','pending',9,28,0),(32,'2 Valid ID','2VAL','pending',9,28,0),(33,'Baranggay Clearance','BRCL','pending',9,28,0),(34,'2x2 Picture ID','2X2','pending',1,29,0),(35,'2 Valid ID','2VAL','pending',1,29,0),(36,'Baranggay Clearance','BRCL','pending',1,29,0),(37,'2x2 Picture ID','2X2','pending',10,30,0),(38,'2 Valid ID','2VAL','pending',10,30,0),(39,'Baranggay Clearance','BRCL','pending',10,30,0),(40,'2x2 Picture ID','2X2','pending',9,31,0),(41,'2 Valid ID','2VAL','pending',9,31,0),(42,'Baranggay Clearance','BRCL','pending',9,31,0),(43,'2x2 Picture ID','2X2','pending',10,32,0),(44,'2 Valid ID','2VAL','pending',10,32,0),(45,'Baranggay Clearance','BRCL','pending',10,32,0),(46,'2x2 Picture ID','2X2','pending',10,33,0),(47,'2 Valid ID','2VAL','pending',10,33,0),(48,'Baranggay Clearance','BRCL','pending',10,33,0),(49,'2 Valid ID','2VAL','pending',1,8,0),(50,'Baranggay Clearance','BRCL','pending',1,8,0),(51,'2x2 Picture ID','2X2','pending',10,39,0),(52,'2 Valid ID','2VAL','pending',10,39,0),(53,'Baranggay Clearance','BRCL','pending',10,39,0),(54,'2x2 Picture ID','2X2','pending',1,0,0),(55,'2 Valid ID','2VAL','pending',1,0,0),(56,'Baranggay Clearance','BRCL','pending',1,0,0),(57,'2x2 Picture ID','2X2','pending',9,201805006,0),(58,'2 Valid ID','2VAL','pending',9,201805006,0),(59,'Baranggay Clearance','BRCL','pending',9,201805006,0),(60,'2x2 Picture ID','2X2','pending',9,201805008,0),(61,'2 Valid ID','2VAL','pending',9,201805008,0),(62,'Baranggay Clearance','BRCL','pending',9,201805008,0),(63,'2x2 Picture ID','2X2','pending',9,201805009,0),(64,'2 Valid ID','2VAL','pending',9,201805009,0),(65,'Baranggay Clearance','BRCL','pending',9,201805009,0),(66,'2 Valid ID','2VAL','pending',7,0,1),(67,'Baranggay Clearance','BRCL','pending',7,0,1),(68,'2 Valid ID','2VAL','pending',2,0,0),(69,'Baranggay Clearance','BRCL','pending',2,0,0),(70,'2 Valid ID','2VAL','pending',9,201805005,0),(71,'Baranggay Clearance','BRCL','pending',9,201805005,0),(72,'Baranggay Clearance','BRCL','pending',6,0,0),(73,'Baranggay Clearance','BRCL','pending',5,0,0),(74,'2 Valid ID','2VAL','to_follow',11,201806002,0),(75,'Baranggay Clearance','BRCL','to_follow',11,201806002,0),(77,'2x2 Picture ID','2X2','to_follow',11,201806002,0),(78,'Tax Income','BIR','to_follow',11,201806002,0),(79,'2x2 Picture ID','2X2','to_follow',9,201805004,0),(80,'Baranggay Clearance','BRCL','received',9,201805004,0),(81,'2x2 Picture ID','2X2','received',1,201805003,0),(82,'2 Valid ID','2VAL','to_follow',1,201805003,0),(83,'Baranggay Clearance','BRCL','pending',1,201805003,0),(84,'Tax Income','BIR','pending',1,201805003,0),(85,'2x2 Picture ID','2X2','pending',9,201805007,0),(86,'2 Valid ID','2VAL','pending',9,201805007,0),(87,'Baranggay Clearance','BRCL','pending',9,201805007,0),(88,'Tax Income','BIR','pending',9,201805007,0);

/*Table structure for table `client_requirements_cf` */

DROP TABLE IF EXISTS `client_requirements_cf`;

CREATE TABLE `client_requirements_cf` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `requirement_name` varchar(255) NOT NULL,
  `requirement_code` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `client_no` bigint(20) NOT NULL,
  `application_no` bigint(20) NOT NULL,
  `is_deleted` bigint(200) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=latin1;

/*Data for the table `client_requirements_cf` */

insert  into `client_requirements_cf`(`id`,`requirement_name`,`requirement_code`,`status`,`client_no`,`application_no`,`is_deleted`) values (1,'2x2 Picture ID','2x2','received',1,17,0),(2,'2 Valid ID','2val','received',1,17,0),(3,'Baranggay Clearance','BRCL','received',1,17,0),(4,'Tax Income','BIR','received',1,17,0),(5,'2x2 Picture ID','2x2','pending',1,5,0),(6,'2 Valid ID','2val','pending',1,5,0),(7,'Baranggay Clearance','BRCL','pending',1,5,0),(8,'Tax Income','BIR','pending',1,5,0),(9,'2x2 Picture ID','2X2','received',9,21,0),(10,'2 Valid ID','2VAL','received',9,21,0),(11,'Baranggay Clearance','BRCL','received',9,21,0),(12,'Tax Income','BIR','received',9,21,0),(13,'2x2 Picture ID','2X2','pending',9,22,0),(14,'2 Valid ID','2VAL','pending',9,22,0),(15,'Baranggay Clearance','BRCL','pending',9,22,0),(16,'Tax Income','BIR','pending',9,22,0),(17,'2x2 Picture ID','2X2','received',6,11,0),(18,'2 Valid ID','2VAL','received',6,11,0),(19,'2x2 Picture ID','2X2','received',9,28,0),(20,'2 Valid ID','2VAL','received',9,28,0),(21,'Baranggay Clearance','BRCL','received',9,28,0),(22,'Tax Income','BIR','received',9,28,0),(23,'2x2 Picture ID','2X2','received',1,29,0),(24,'2 Valid ID','2VAL','received',1,29,0),(25,'Baranggay Clearance','BRCL','received',1,29,0),(26,'Tax Income','BIR','received',1,29,0),(27,'Tax Income','BIR','received',9,25,0),(28,'2x2 Picture ID','2X2','received',5,16,0),(29,'2 Valid ID','2VAL','received',5,16,0),(30,'2x2 Picture ID','2X2','received',10,30,0),(31,'2 Valid ID','2VAL','received',10,30,0),(32,'Baranggay Clearance','BRCL','received',10,30,0),(33,'Tax Income','BIR','received',10,30,0),(38,'2x2 Picture ID','2X2','received',10,33,0),(39,'2 Valid ID','2VAL','received',10,33,0),(40,'Baranggay Clearance','BRCL','received',10,33,0),(41,'Tax Income','BIR','received',10,33,0),(42,'2x2 Picture ID','2X2','received',1,20,0),(43,'2 Valid ID','2VAL','received',1,20,0),(44,'Baranggay Clearance','BRCL','received',1,20,0),(45,'Tax Income','BIR','received',1,20,0),(46,'2x2 Picture ID','2X2','received',10,39,0),(47,'2 Valid ID','2VAL','received',10,39,0),(48,'Baranggay Clearance','BRCL','received',10,39,0),(49,'Tax Income','BIR','received',10,39,0),(51,'Tax Income','BIR','to_follow',9,201805005,0),(52,'2 Valid ID','2VAL','to_follow',6,15,0),(53,'Baranggay Clearance','BRCL','received',6,15,0),(54,'Tax Income','BIR','to_follow',6,15,0),(55,'2 Valid ID','2VAL','to_follow',11,201806002,0),(56,'Baranggay Clearance','BRCL','to_follow',11,201806002,0),(57,'Tax Income','BIR','to_follow',11,201806002,0),(58,'2 Valid ID','2VAL','to_follow',9,201805004,0),(59,'Baranggay Clearance','BRCL','to_follow',9,201805004,0),(60,'Tax Income','BIR','to_follow',9,201805004,0);

/*Table structure for table `client_type` */

DROP TABLE IF EXISTS `client_type`;

CREATE TABLE `client_type` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `client_type` */

insert  into `client_type`(`id`,`name`,`is_deleted`) values (1,'ESP',0),(2,'testt',1);

/*Table structure for table `collateral_code` */

DROP TABLE IF EXISTS `collateral_code`;

CREATE TABLE `collateral_code` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) NOT NULL,
  `desc` varchar(255) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `collateral_code` */

insert  into `collateral_code`(`id`,`code`,`desc`,`is_deleted`) values (1,'AP','APPLIANCES',0),(2,'BO','BUSINESS & OFFICE MACHINES',0),(3,'CL','CLEAN/UNSECURED',0),(4,'HE','HEAVY EQUIPMENT',0),(5,'ME','MEDICAL EQUIPMENT',0),(6,'MV','MOTOR VEHICLE',0),(7,'OT','OTHERS',0),(8,'PD','POST DATED CHEQUES',0),(9,'RE','REAL ESTATE',0),(10,'S','SSS',0),(11,'SG','SBGFC GUARANTEE',0);

/*Table structure for table `collateral_info` */

DROP TABLE IF EXISTS `collateral_info`;

CREATE TABLE `collateral_info` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `loan_list_id` bigint(20) NOT NULL,
  `client_no` bigint(20) NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `assignee` varchar(255) NOT NULL,
  `unit_description` varchar(255) NOT NULL,
  `location_motor` varchar(255) NOT NULL,
  `tct_no` bigint(20) NOT NULL,
  `plate_no` bigint(20) NOT NULL,
  `or_no` bigint(20) NOT NULL,
  `cr_no` bigint(20) NOT NULL,
  `lto_agency` varchar(255) NOT NULL,
  `approve_value` decimal(10,2) NOT NULL,
  `or_date` date NOT NULL,
  `with_stencile` varchar(255) NOT NULL,
  `insurance_status` varchar(255) NOT NULL,
  `insurance_comp_no` bigint(20) NOT NULL,
  `insurance_comp` varchar(255) NOT NULL,
  `policy_no` bigint(20) NOT NULL,
  `exp_date` date NOT NULL,
  `collat_created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `applied_by` bigint(20) NOT NULL,
  `is_deleted` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

/*Data for the table `collateral_info` */

insert  into `collateral_info`(`id`,`loan_list_id`,`client_no`,`client_name`,`assignee`,`unit_description`,`location_motor`,`tct_no`,`plate_no`,`or_no`,`cr_no`,`lto_agency`,`approve_value`,`or_date`,`with_stencile`,`insurance_status`,`insurance_comp_no`,`insurance_comp`,`policy_no`,`exp_date`,`collat_created_date`,`applied_by`,`is_deleted`) values (1,11,6,'Bugoy Ets Drilon','3213123123','12312312','312312',312312,3213123,312312,12312312,'12312312','99999999.99','0000-00-00','yes','',123123,'12312312',12312312,'0000-00-00','2018-04-20 16:03:24',1,1),(2,11,6,'Bugoy Ets Drilon','3213123123','12312312','312312',312312,3213123,312312,12312312,'12312312','99999999.99','0000-00-00','yes','',123123,'12312312',12312312,'0000-00-00','2018-04-20 16:08:39',1,0),(3,11,6,'Bugoy Ets Drilon','123213123','1231231312321','3123123123',12312312312,312312312,123123123,1312321321,'123213123123','99999999.99','0000-00-00','yes','insured',12312312312,'131231231',12312312,'0000-00-00','2018-04-21 14:19:59',1,0),(4,11,6,'Bugoy Ets Drilon','Carl Dennis Alingalan','312312312','3123123123',33123123123,123123123213,33123123123,33123123123,'123123123','99999999.99','2031-03-12','no','insured',123123123123,'3123123123123',3123123123,'2031-03-12','2018-04-21 15:50:22',1,0),(5,14,1,'Jay Esterado Tumanda','test','test','test',123,12131,123,123,'1test','123123.00','2018-04-21','yes','insured',123,'123',123,'1901-12-20','2018-04-21 16:42:30',1,0),(6,14,1,'Jay Esterado Tumanda','test','test','123',123,123,123,123,'test','123.00','1901-12-14','yes','insured',123,'123',123,'1901-12-14','2018-04-21 16:43:17',1,0),(7,14,1,'Jay Esterado Tumanda','test','test','123',123,123,123,123,'test','123.00','1901-12-14','yes','insured',123,'123',123,'1901-12-14','2018-04-21 16:43:17',1,0),(8,14,1,'Jay Esterado Tumanda','test','test','123',123,123,123,123,'test','123.00','1901-12-14','yes','insured',123,'123',123,'1901-12-14','2018-04-21 16:43:17',1,0),(9,14,1,'Jay Esterado Tumanda','test','test','123',123,123,123,123,'test','123.00','1901-12-14','yes','insured',123,'123',123,'1901-12-14','2018-04-21 16:43:17',1,1),(10,14,1,'Jay Esterado Tumanda','1232313','1312312312','321312312',312312312,3213123123,3123123123,312312312,'131231232','99999999.99','2031-03-31','yes','insured',3213123,'3312312321',321312312,'2031-12-31','2018-04-21 16:49:14',1,0),(11,14,1,'Jay Esterado Tumanda','12323121321','312312312','312312312',213312312,12312312,312312312,321312312,'123213123','3213123.00','2031-03-12','yes','insured',312312312,'321312312',3213123,'2031-03-21','2018-04-21 16:51:17',1,0),(12,13,2,'Wilfred Magdaong Ribleza','123213','3213123','3213213',32131232,321321312,33213213,3213213,'123213213123','3123123.00','2031-03-21','yes','insured',321321312,'321321321',321312321,'2032-03-21','2018-04-23 23:15:32',1,0),(13,21,9,'Carl Dennis M Alingalan','312441233','3123123123','3123123',3123123123,3123123123,3213123123,312312312,'32131312','99999999.99','2031-03-21','yes','insured',3213123123,'3123123123',31231231232,'2031-03-12','2018-05-14 11:45:03',1,0),(14,28,9,'Carl Dennis M Alingalan','12312312','31231231','31231231',312312321,312312312,32131232,3213123,'123123123','3123123.00','2031-03-12','yes','insured',312312321,'312312321',3123123,'2031-03-21','2018-05-15 12:11:16',1,0),(15,25,9,'Carl Dennis M Alingalan','124123123','3123123','3123123',312312321,3213123,213123123,312312312,'312312312','3123123.00','2031-03-12','yes','insured',3123123,'321312321',321312312,'2031-03-21','2018-05-15 12:16:51',1,0),(16,30,10,'Manny J Pacquiao','Kimpy De leon','Malaking Compound','Butuan City',2134233214,3214123,213123,3213123,'321312321','321312.00','2031-03-21','yes','insured',3213213,'3213',32123,'2032-03-21','2018-05-16 13:57:37',1,0),(17,30,10,'Manny J Pacquiao','King T\'Challa','Wakanda','Center of africa',294749234,1231241221,213123213,123213213,'213123123','3213213.00','2032-03-21','yes','insured',123123213,'32131232',13213213,'2032-03-21','2018-05-18 00:51:29',1,0),(18,30,10,'Manny J Pacquiao','Tony Stark','Stark Industries','North America',42134213,3123213,312312,21321321,'2131321','321321.00','0201-02-13','yes','insured',3123213213,'123123213',12321321,'2031-12-31','2018-05-18 00:53:52',1,0),(19,31,9,'Carl Dennis M Alingalan','San Goku','Masyadong malaki','Spirit World',2134324123,1234423321,3213231,321321313,'32131231','99999999.99','2031-03-21','yes','insured',213123213,'1233423',124423,'2032-12-31','2018-05-20 14:14:25',1,0),(20,33,10,'Manny J Pacquiao','Benji Paras','SM Manila','2 sq. m',2344123,2441242,2444124,12442331,'2144244','23124421.00','2018-05-23','yes','not_insured',2441244,'Insular',2445512443,'2018-05-15','2018-05-22 19:20:10',1,0),(21,20,1,'Jay Esterado Tumanda','Mark','2132132','3213123',321312312,321312312,31231231,3123123,'312321321','3213123.00','2032-03-21','yes','insured',41231231,'3213213',312321,'2032-03-21','2018-05-24 14:48:16',1,0),(22,38,9,'Carl Dennis M Alingalan','Mang Jose','Makati Ave','Sampaloc, Manila',234241,213123,321312,321312,'LTO Agency?','25000.00','2018-05-27','yes','insured',1232131,'321312',3213123,'2031-03-21','2018-05-27 20:37:07',1,0),(23,39,10,'Manny J Pacquiao','Market placess','23323123','4213131',23213123213,3123123,123123123,312312321,'23213213213','213123.00','2031-03-21','yes','insured',312312321,'1232131',123123,'2032-03-21','2018-05-28 23:56:58',1,0),(24,40,9,'Carl Dennis M Alingalan','32131232','3213123213','123123',123123,12312312,3123312,123123213,'1232132131231','99999999.99','2032-03-21','yes','insured',2312312312,'3123',12312312,'2031-12-31','2018-05-29 00:16:45',1,0),(25,41,9,'Carl Dennis M Alingalan','King T\'Challa','321321','312312321',31231231,32131231,312312312,32131231,'321312312','3123123.00','2031-03-12','yes','insured',3213123,'32131231',3213123,'2031-03-21','2018-05-29 10:18:15',1,0),(27,44,10,'Chris  Carcedo','123213','3123123','312312',312312,3213123,312312,312312,'3123123','312312.00','2031-03-21','yes','insured',312312,'321312',312312,'2031-03-12','2018-06-04 13:25:52',1,0),(28,15,6,'Bugoy Test Drilon','213123','2313','12312',321321,312321,123,213312,'sdasd','3213123.00','0203-12-31','','',0,'',0,'0000-00-00','2018-06-05 17:09:26',1,1),(29,15,6,'Bugoy Test Drilon','123123','123123','123',123213,1312321,123123123,123123123,'31232131','3213123.32','2032-03-21','yes','not_insured',0,'',0,'0000-00-00','2018-06-05 17:43:09',1,0),(30,44,10,'Chris  Carcedo','12312312','321312','321312',312312,321312,312312321,312312321,'213123213','312312.00','2031-03-12','yes','insured',321312,'312321',321321,'2031-03-12','2018-06-05 21:05:08',1,0),(31,46,12,'Charles Dave Reyes Gantan','Bakla sa index','23421','321321',321312,213123,242312,4231,'1232312','123442.00','2013-02-03','','',0,'',0,'0000-00-00','2018-06-20 22:17:33',1,0);

/*Table structure for table `country` */

DROP TABLE IF EXISTS `country`;

CREATE TABLE `country` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `country` */

insert  into `country`(`id`,`name`,`is_deleted`) values (1,'Philippines',0),(2,'ts',1);

/*Table structure for table `cred_app_bwu` */

DROP TABLE IF EXISTS `cred_app_bwu`;

CREATE TABLE `cred_app_bwu` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `loan_id` bigint(20) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  `statement` varchar(255) DEFAULT NULL,
  `gross_inc` varchar(255) DEFAULT NULL,
  `net_inc` varchar(255) DEFAULT NULL,
  `strength` varchar(255) DEFAULT NULL,
  `weak` varchar(255) DEFAULT NULL,
  `reco` varchar(255) DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `cred_app_bwu` */

insert  into `cred_app_bwu`(`id`,`loan_id`,`note`,`statement`,`gross_inc`,`net_inc`,`strength`,`weak`,`reco`) values (1,16,'With other several SPD account','Benmar Cargo Movers, Inc.\r\nAs other sources of income borrower  has other trucking company using the name of Ultimate Express Logistics, Inc.','2100','1790','Existing Account with FFC\r\nEstablished business','CMAP listed','Approval Direct Loan of (1) unit IH Tractor Head');

/*Table structure for table `cred_app_less` */

DROP TABLE IF EXISTS `cred_app_less`;

CREATE TABLE `cred_app_less` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `loan_id` bigint(20) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `percent` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `is_deleted` tinyint(4) DEFAULT '0',
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

/*Data for the table `cred_app_less` */

insert  into `cred_app_less`(`id`,`loan_id`,`name`,`amount`,`percent`,`description`,`is_deleted`) values (1,16,'Operating Expense','100','','',0),(23,16,'test','','10','',0);

/*Table structure for table `cred_app_relations` */

DROP TABLE IF EXISTS `cred_app_relations`;

CREATE TABLE `cred_app_relations` (
  `id` bigint(255) NOT NULL AUTO_INCREMENT,
  `loan_id` bigint(20) DEFAULT NULL,
  `acct_no` varchar(255) DEFAULT NULL,
  `facility` varchar(255) DEFAULT NULL,
  `unit` varchar(255) DEFAULT NULL,
  `plate_no` varchar(255) DEFAULT NULL,
  `af` varchar(255) DEFAULT NULL,
  `tlv` varchar(255) DEFAULT NULL,
  `granted` varchar(255) DEFAULT NULL,
  `terms` varchar(255) DEFAULT NULL,
  `ma` varchar(255) DEFAULT NULL,
  `balance` varchar(255) DEFAULT NULL,
  `rule78` varchar(255) DEFAULT NULL,
  `exp` varchar(255) DEFAULT NULL,
  `applied_by` bigint(20) DEFAULT NULL,
  `date_applied` varchar(255) DEFAULT NULL,
  `is_deleted` tinyint(4) DEFAULT '0',
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `cred_app_relations` */

insert  into `cred_app_relations`(`id`,`loan_id`,`acct_no`,`facility`,`unit`,`plate_no`,`af`,`tlv`,`granted`,`terms`,`ma`,`balance`,`rule78`,`exp`,`applied_by`,`date_applied`,`is_deleted`) values (2,16,'RDLA2201607093','Direct Loan','IH TH','RML 793','1000000','1317200','04/29/2010','24','54883','219532','214027','Satisfactory',1,'2010-04-29',0),(5,16,'RDLA2201607093','Direct Loan',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0);

/*Table structure for table `cred_app_vehicles` */

DROP TABLE IF EXISTS `cred_app_vehicles`;

CREATE TABLE `cred_app_vehicles` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `loan_id` bigint(20) DEFAULT NULL,
  `unit` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `is_deleted` tinyint(4) DEFAULT '0',
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `cred_app_vehicles` */

insert  into `cred_app_vehicles`(`id`,`loan_id`,`unit`,`name`,`description`,`is_deleted`) values (1,16,'26','Assorted TH','Maybank UPC, FFC, Asian Cathay, Cash',0),(2,16,'10','Civic','Test',0);

/*Table structure for table `credit_check` */

DROP TABLE IF EXISTS `credit_check`;

CREATE TABLE `credit_check` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `loan_id` bigint(20) DEFAULT NULL,
  `client_no` bigint(20) DEFAULT NULL,
  `informant` varchar(255) DEFAULT NULL,
  `tel_no` varchar(255) DEFAULT NULL,
  `loan_type_id` bigint(20) DEFAULT NULL,
  `unit` varchar(255) DEFAULT NULL,
  `amt_fin` varchar(255) DEFAULT NULL,
  `pn_amount` varchar(255) DEFAULT NULL,
  `terms` varchar(255) DEFAULT NULL,
  `mon_amor` varchar(255) DEFAULT NULL,
  `date_granted` varchar(255) DEFAULT NULL,
  `balance` varchar(255) DEFAULT NULL,
  `security` varchar(255) DEFAULT NULL,
  `experience` varchar(255) DEFAULT NULL,
  `checked_by` bigint(20) DEFAULT NULL,
  `is_deleted` tinyint(4) DEFAULT '0',
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `credit_check` */

insert  into `credit_check`(`id`,`loan_id`,`client_no`,`informant`,`tel_no`,`loan_type_id`,`unit`,`amt_fin`,`pn_amount`,`terms`,`mon_amor`,`date_granted`,`balance`,`security`,`experience`,`checked_by`,`is_deleted`) values (1,2,1,'Cjay','999',4,'999','99','99','99','9','04/15/2018','9','Test','Test Exp',1,0);

/*Table structure for table `credit_facility` */

DROP TABLE IF EXISTS `credit_facility`;

CREATE TABLE `credit_facility` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `credit_facility` */

insert  into `credit_facility`(`id`,`code`,`name`,`is_deleted`) values (1,'DL','Direct Loan',0),(2,'LE','Lease Contracts Receivables',0),(3,'RE','Real Estate Mortgage',0),(4,'RF','Receivables Finance',0);

/*Table structure for table `dealer` */

DROP TABLE IF EXISTS `dealer`;

CREATE TABLE `dealer` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `is_deleted` tinyint(4) DEFAULT '0',
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `dealer` */

insert  into `dealer`(`id`,`name`,`is_deleted`) values (1,'Dealer No. 1',0);

/*Table structure for table `department` */

DROP TABLE IF EXISTS `department`;

CREATE TABLE `department` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `department_name` varchar(255) NOT NULL,
  `allowance` varchar(255) DEFAULT NULL,
  `department_head_id` bigint(20) DEFAULT NULL,
  `is_deleted` smallint(2) DEFAULT '0',
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

/*Data for the table `department` */

insert  into `department`(`id`,`department_name`,`allowance`,`department_head_id`,`is_deleted`) values (1,'BA','5000',5,0),(2,'PRODCOM','4000',4,0),(3,'SALES','111',16,0),(4,'test3','12',4,1),(5,'test','1',17,1),(6,'test4','1223',4,1),(7,'HR','3000',3,0),(8,'16262526ss','213123',2,1),(9,'1','213123',3,1),(10,'1233','1223',4,1),(11,'we45','1223',2,1),(12,'sadsd','1223',5,1),(13,'jeje','.12',6,1),(14,'test1234','.9',6,1),(15,'wwq','2313',2,1),(16,'yu','678',6,1);

/*Table structure for table `finance_approver` */

DROP TABLE IF EXISTS `finance_approver`;

CREATE TABLE `finance_approver` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `finance_approver` */

insert  into `finance_approver`(`id`,`user_id`) values (1,17);

/*Table structure for table `gender` */

DROP TABLE IF EXISTS `gender`;

CREATE TABLE `gender` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `gender` */

insert  into `gender`(`id`,`name`,`is_deleted`) values (1,'Male',0),(2,'Female',0);

/*Table structure for table `industry_code` */

DROP TABLE IF EXISTS `industry_code`;

CREATE TABLE `industry_code` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `industry_code` */

insert  into `industry_code`(`id`,`name`,`is_deleted`) values (1,'AG - Agricultural',0),(2,'tyest',1),(3,'CF - Consumption',0),(4,'CT - Construction',0),(5,'FI - Financial Institution',0),(6,'MA - Manufacturing',0),(7,'MQ - Mining & Quarrying',0),(8,'OT - Others',0),(9,'PU - Public Utilities',0),(10,'RE - Real Estate',0),(11,'SE - Services',0);

/*Table structure for table `industry_corp` */

DROP TABLE IF EXISTS `industry_corp`;

CREATE TABLE `industry_corp` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `industry_corp` */

insert  into `industry_corp`(`id`,`name`,`is_deleted`) values (1,'Spark Global Tech Systems, Inc.',0),(2,'FCC',1);

/*Table structure for table `instruction_sheet` */

DROP TABLE IF EXISTS `instruction_sheet`;

CREATE TABLE `instruction_sheet` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `ll_id` bigint(20) DEFAULT NULL,
  `app_no` bigint(20) DEFAULT NULL,
  `acc_no` bigint(20) DEFAULT NULL,
  `bor_name` varchar(255) DEFAULT NULL,
  `client_no` bigint(20) DEFAULT NULL,
  `spouse` varchar(255) DEFAULT NULL,
  `client_stat` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `pri_con` bigint(20) DEFAULT NULL,
  `unit_desc` varchar(255) DEFAULT NULL,
  `tie_up_account` varchar(255) DEFAULT NULL,
  `tu_lname` varchar(255) DEFAULT NULL,
  `tu_fname` varchar(255) DEFAULT NULL,
  `tu_unit_desc` varchar(255) DEFAULT NULL,
  `term` bigint(20) DEFAULT NULL,
  `list_cash_price` decimal(10,2) DEFAULT NULL,
  `addon_rate` decimal(10,2) DEFAULT NULL,
  `appraised_value` decimal(10,2) DEFAULT NULL,
  `mon_first_payment` decimal(10,2) DEFAULT NULL,
  `dp_gd_rv` decimal(10,2) DEFAULT NULL,
  `mon_second_payment` decimal(10,2) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `maturity_date` date DEFAULT NULL,
  `due_date` varchar(255) DEFAULT NULL,
  `value_date` date DEFAULT NULL,
  `amount_fin` decimal(10,2) DEFAULT NULL,
  `amount_pn` decimal(10,2) DEFAULT NULL,
  `rcf` decimal(10,2) DEFAULT NULL,
  `rebate_rcf` decimal(10,2) DEFAULT NULL,
  `TLV` decimal(10,2) DEFAULT NULL,
  `manner_payment` bigint(20) DEFAULT NULL,
  `less_udi_percent` decimal(10,2) DEFAULT NULL,
  `less_total` decimal(10,2) DEFAULT NULL,
  `udi_bal` decimal(10,2) DEFAULT NULL,
  `mort_fee` decimal(10,2) DEFAULT NULL,
  `mort_or` decimal(10,2) DEFAULT NULL,
  `mort_total` decimal(10,2) DEFAULT NULL,
  `proc_fee` decimal(10,2) DEFAULT NULL,
  `proc_or` decimal(10,2) DEFAULT NULL,
  `proc_total` decimal(10,2) DEFAULT NULL,
  `apprais_fee` decimal(10,2) DEFAULT NULL,
  `apprais_or` decimal(10,2) DEFAULT NULL,
  `apprais_total` decimal(10,2) DEFAULT NULL,
  `comm_fee` decimal(10,2) DEFAULT NULL,
  `comm_or` decimal(10,2) DEFAULT NULL,
  `comm_total` decimal(10,2) DEFAULT NULL,
  `front_fee` decimal(10,2) DEFAULT NULL,
  `front_or` decimal(10,2) DEFAULT NULL,
  `front_total` decimal(10,2) DEFAULT NULL,
  `sm_fee` decimal(10,2) DEFAULT NULL,
  `salesman_id` bigint(20) DEFAULT NULL,
  `sm_total` decimal(10,2) DEFAULT NULL,
  `dealer_fee` decimal(10,2) DEFAULT NULL,
  `dealer_id` bigint(20) DEFAULT NULL,
  `dealer_total` decimal(10,2) DEFAULT NULL,
  `real_estate_fee` decimal(10,2) DEFAULT NULL,
  `real_estate_or` decimal(10,2) DEFAULT NULL,
  `real_estate_total` decimal(10,2) DEFAULT NULL,
  `insur_prem_fee` decimal(10,2) DEFAULT NULL,
  `insur_prem_or` decimal(10,2) DEFAULT NULL,
  `insur_prem_total` decimal(10,2) DEFAULT NULL,
  `handling_fee` decimal(10,2) DEFAULT NULL,
  `handling_or` decimal(10,2) DEFAULT NULL,
  `handling_total` decimal(10,2) DEFAULT NULL,
  `dpb_fee` decimal(10,2) DEFAULT NULL,
  `dpb_or` decimal(10,2) DEFAULT NULL,
  `dpb_total` decimal(10,2) DEFAULT NULL,
  `doc_fee` decimal(10,2) DEFAULT NULL,
  `doc_or` decimal(10,2) DEFAULT NULL,
  `doc_total` decimal(10,2) DEFAULT NULL,
  `sbgfc_fee` decimal(10,2) DEFAULT NULL,
  `sbgfc_or` decimal(10,2) DEFAULT NULL,
  `sbgfc_total` decimal(10,2) DEFAULT NULL,
  `other_one_fee` decimal(10,2) DEFAULT NULL,
  `other_one_or` decimal(10,2) DEFAULT NULL,
  `other_one_total` decimal(10,2) DEFAULT NULL,
  `other_two_fee` decimal(10,2) DEFAULT NULL,
  `other_two_or` decimal(10,2) DEFAULT NULL,
  `other_two_total` decimal(10,2) DEFAULT NULL,
  `amount_deduct` decimal(10,2) DEFAULT NULL,
  `amount_due` decimal(10,2) DEFAULT NULL,
  `or_no` bigint(20) DEFAULT NULL,
  `or_date` date DEFAULT NULL,
  `or_amount` decimal(10,2) DEFAULT NULL,
  `payee1` varchar(255) DEFAULT NULL,
  `amount_payee1` decimal(10,2) DEFAULT NULL,
  `payee2` varchar(255) DEFAULT NULL,
  `amount_payee2` decimal(10,2) DEFAULT NULL,
  `payee3` varchar(255) DEFAULT NULL,
  `amount_payee3` decimal(10,2) DEFAULT NULL,
  `payee4` varchar(255) DEFAULT NULL,
  `amount_payee4` decimal(10,2) DEFAULT NULL,
  `payee5` varchar(255) DEFAULT NULL,
  `amount_payee5` decimal(10,2) DEFAULT NULL,
  `is_deleted` bigint(20) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

/*Data for the table `instruction_sheet` */

insert  into `instruction_sheet`(`id`,`ll_id`,`app_no`,`acc_no`,`bor_name`,`client_no`,`spouse`,`client_stat`,`address`,`pri_con`,`unit_desc`,`tie_up_account`,`tu_lname`,`tu_fname`,`tu_unit_desc`,`term`,`list_cash_price`,`addon_rate`,`appraised_value`,`mon_first_payment`,`dp_gd_rv`,`mon_second_payment`,`start_date`,`maturity_date`,`due_date`,`value_date`,`amount_fin`,`amount_pn`,`rcf`,`rebate_rcf`,`TLV`,`manner_payment`,`less_udi_percent`,`less_total`,`udi_bal`,`mort_fee`,`mort_or`,`mort_total`,`proc_fee`,`proc_or`,`proc_total`,`apprais_fee`,`apprais_or`,`apprais_total`,`comm_fee`,`comm_or`,`comm_total`,`front_fee`,`front_or`,`front_total`,`sm_fee`,`salesman_id`,`sm_total`,`dealer_fee`,`dealer_id`,`dealer_total`,`real_estate_fee`,`real_estate_or`,`real_estate_total`,`insur_prem_fee`,`insur_prem_or`,`insur_prem_total`,`handling_fee`,`handling_or`,`handling_total`,`dpb_fee`,`dpb_or`,`dpb_total`,`doc_fee`,`doc_or`,`doc_total`,`sbgfc_fee`,`sbgfc_or`,`sbgfc_total`,`other_one_fee`,`other_one_or`,`other_one_total`,`other_two_fee`,`other_two_or`,`other_two_total`,`amount_deduct`,`amount_due`,`or_no`,`or_date`,`or_amount`,`payee1`,`amount_payee1`,`payee2`,`amount_payee2`,`payee3`,`amount_payee3`,`payee4`,`amount_payee4`,`payee5`,`amount_payee5`,`is_deleted`) values (7,30,30,0,'Pacquiao, Manny J',10,'Jinkey Pacquiao','','666 The Money Streey, Brgy. 666, Jensan',32412445285,'Sabungan sa Jensan','0','','','',26,'500000.00','32.28','0.00','49166.50','25000.00','49166.50','2018-05-28','2020-06-28','28','2018-04-28','475000.00','628330.00','650000.00','25000.00','1278330.00',1,'24.35','152998.00','475332.00','5000.00','500.00','4500.00','32131.00','2131.00','30000.00','50000.00','50000.00','0.00','25000.00','5000.00','20000.00','3500.00','1500.00','2000.00','2500.00',0,'2500.00','500.00',0,'500.00','5600.00','1600.00','4000.00','2000.00','1000.00','1000.00','15000.00','2500.00','12500.00','5000.00','5000.00','0.00','8000.00','0.00','8000.00','700.00','0.00','700.00','5000.00','1500.00','3500.00','50000.00','250.00','49750.00','138950.00','336382.00',23441233,'2018-05-29','70981.00','Sige Talon una ulo','5000.00','Agik','56000.00','Ginagawa Mu','25000.00','Pang Empi','2000.00','Talon mo bessy','20000.00',0),(8,29,29,0,'Tumanda, Jay E',1,'12345',NULL,'123, Brgy. 2, 3',123,'Makati','','','','',24,'25000.00','25.00','0.00','52794.00','0.00','52783.00','2018-05-15','2020-05-15','2020-05-15','2020-05-15','1000000.00','1250000.00','16800.00','700.00','1266800.00',0,'25.00','312500.00','937500.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','20000.00',NULL,NULL,'5000.00',NULL,NULL,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00',NULL,'912500.00',0,'0000-00-00','0.00','','0.00','','0.00','','0.00','','0.00','','0.00',0),(9,28,28,0,'Alingalan, Carl Dennis M',9,'',NULL,'2462 McKinley Hills, Brgy. 423, Tondo',312442131312,'Makati Sedeno','','','','',24,'70000.00','30.00','0.00','542377.00','0.00','542367.00','2018-05-17','2020-05-17','2020-05-17','2020-05-17','10000000.00','13000000.00','16800.00','700.00','13016800.00',1,'35.00','4375000.00','8125000.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','25000.00',NULL,NULL,'45000.00',NULL,NULL,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00',NULL,'8055000.00',0,'0000-00-00','0.00','','0.00','','0.00','','0.00','','0.00','','0.00',0),(10,31,31,0,'Alingalan, Carl Dennis M',9,'','','2462 McKinley Hills, Brgy. 423, Tondo',312442131312,'Punta sta.ana manila','0','','','',12,'125000.00','0.12','0.00','6757.50','50000.00','6757.50','2018-05-14','2019-05-14','2019-05-14','2019-05-14','75000.00','75090.00','6000.00','500.00','81090.00',2,'12.45','9348.71','65741.30','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','1222.00',0,NULL,'4322.00',0,NULL,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','608041.00',0,'2000-11-30','0.00','','0.00','','0.00','','0.00','','0.00','','0.00',0),(13,33,33,0,'Pacquiao, Manny J',10,'Jinkey Pacquiao','New','666 The Money Streey, Brgy. 666, Jensan',32412445285,'Magsasay','0','','','',24,'500000.00','31.25','0.00','11249.00','300000.54','11237.00','2018-05-28','2020-04-28','28','2018-04-28','199999.46','262499.29','7200.00','300.00','269699.29',1,'21.19','55623.60','206875.69','2500.00','0.00','2500.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00',0,'0.00','50000.00',0,'50000.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','50000.00','30000.00','20000.00','0.00','0.00','0.00','72500.00','134375.69',1234213,'2018-05-02','30000.00','Na Trucking','50000.00','','0.00','','0.00','','0.00','','0.00',0),(14,39,201805017,0,'Pacquiao, Manny J',10,'Jinkey Pacquiao','New','666 The Money Streey, Brgy. 666, Jensan',32412445285,'Mandaluyong Mental','0','','','',24,'1500000.00','32.56','0.00','81594.00','30000.00','81593.00','2018-05-28','2020-04-28','28','2018-04-28','1470000.00','1948632.00','9600.00','400.00','1958232.00',1,'23.43','456564.48','1492067.52','0.00','0.00','0.00','50000.00','0.00','50000.00','0.00','0.00','0.00','50000.00','40000.00','10000.00','0.00','0.00','0.00','23444.00',0,'23444.00','0.00',0,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','83444.00','1408623.52',12321321,'2018-05-30','40000.00','NA TRUCKING SERVICES','40000.00','','0.00','','0.00','','0.00','','0.00',0),(15,27,201805009,0,'Alingalan, Carl Dennis M',9,'','Old','2462 McKinley Hills, Brgy. 423, Tondo',312442131312,'','0','','','',24,'4000000.00','31.38','0.00','191875.00','500450.65','191871.00','2018-06-25','2020-05-25','25','2018-05-25','3499549.35','4597707.94','7200.00','300.00','4604907.94',1,'21.00','965518.67','3632189.27','10000.00','5000.00','5000.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00',0,'0.00','0.00',0,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','5000.00','960518.67',0,'0000-00-00','5000.00','','0.00','','0.00','','0.00','','0.00','','0.00',0),(18,45,201806002,0,'Yabson, Ataska M',11,'Ang','New','3123123, Brgy. 312323, 3123123',3123123,'asdad','0','','','',24,'400000.00','21.00','0.00','19212.00','25000.00','19206.00','2018-06-19','2020-05-19','19','2018-05-19','375000.00','453750.00','7200.00','300.00','460950.00',1,'31.00','140662.50','313087.50','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','50000.00',6,'50000.00','25000.00',6,'25000.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','75000.00','238087.50',0,'0000-00-00','0.00','','0.00','','0.00','','0.00','','0.00','','0.00',0),(19,26,201805008,0,'Alingalan, Carl Dennis M',9,'','Old','2462 McKinley Hills, Brgy. 423, Tondo',312442131312,'','0','','','',24,'5000000.00','21.32','0.00','240624.00','250000.00','240612.00','2018-09-24','2020-08-24','24','2018-08-24','4750000.00','5762700.00','12000.00','500.00','5774700.00',1,'31.09','1791623.43','3971076.57','25000.00','0.00','25000.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00',0,'0.00','0.00',0,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','25000.00','3946076.57',0,'0000-00-00','0.00','','0.00','','0.00','','0.00','','0.00','','0.00',0),(20,21,201805004,0,'Alingalan, Carl Dennis M',9,'','Old','2462 McKinley Hills, Brgy. 423, Tondo',312442131312,'','0','','','',24,'2000000.00','21.00','0.00','98624.00','50000.00','98612.00','2018-06-28','2020-05-28','28','2018-05-28','1950000.00','2359500.00','7200.00','300.00','2366700.00',1,'31.00','731445.00','1628055.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','3000.00',6,'3000.00','0.00',0,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','3000.00','1625055.00',0,'0000-00-00','0.00','','0.00','','0.00','','0.00','','0.00','','0.00',0);

/*Table structure for table `instruction_sheet_td` */

DROP TABLE IF EXISTS `instruction_sheet_td`;

CREATE TABLE `instruction_sheet_td` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `ll_id` bigint(20) DEFAULT NULL,
  `app_no` bigint(20) DEFAULT NULL,
  `acc_no` bigint(20) DEFAULT NULL,
  `bor_name` varchar(255) DEFAULT NULL,
  `client_no` bigint(20) DEFAULT NULL,
  `spouse` varchar(255) DEFAULT NULL,
  `client_stat` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `pri_con` bigint(20) DEFAULT NULL,
  `unit_desc` varchar(255) DEFAULT NULL,
  `tie_up_account` varchar(255) DEFAULT NULL,
  `tu_lname` varchar(255) DEFAULT NULL,
  `tu_fname` varchar(255) DEFAULT NULL,
  `tu_unit_desc` varchar(255) DEFAULT NULL,
  `amount_line` decimal(10,2) DEFAULT NULL,
  `avail_bal` decimal(10,2) DEFAULT NULL,
  `outstanding_avail` decimal(10,2) DEFAULT NULL,
  `prop_avail` decimal(10,2) DEFAULT NULL,
  `date_approved` date DEFAULT NULL,
  `term` bigint(20) DEFAULT NULL,
  `max_term` bigint(20) DEFAULT NULL,
  `int_rate` decimal(10,2) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `maturity_date` date DEFAULT NULL,
  `value_date` date DEFAULT NULL,
  `amount_pn` decimal(10,2) DEFAULT NULL,
  `discount` decimal(10,2) DEFAULT NULL,
  `net_proceeds` decimal(10,2) DEFAULT NULL,
  `manner_payment` bigint(20) DEFAULT NULL,
  `mort_fee` decimal(10,2) DEFAULT NULL,
  `mort_or` decimal(10,2) DEFAULT NULL,
  `mort_total` decimal(10,2) DEFAULT NULL,
  `proc_fee` decimal(10,2) DEFAULT NULL,
  `proc_or` decimal(10,2) DEFAULT NULL,
  `proc_total` decimal(10,2) DEFAULT NULL,
  `apprais_fee` decimal(10,2) DEFAULT NULL,
  `apprais_or` decimal(10,2) DEFAULT NULL,
  `apprais_total` decimal(10,2) DEFAULT NULL,
  `comm_fee` decimal(10,2) DEFAULT NULL,
  `comm_or` decimal(10,2) DEFAULT NULL,
  `comm_total` decimal(10,2) DEFAULT NULL,
  `front_fee` decimal(10,2) DEFAULT NULL,
  `front_or` decimal(10,2) DEFAULT NULL,
  `front_total` decimal(10,2) DEFAULT NULL,
  `sm_fee` decimal(10,2) DEFAULT NULL,
  `salesman_id` bigint(20) DEFAULT NULL,
  `sm_total` decimal(10,2) DEFAULT NULL,
  `dealer_fee` decimal(10,2) DEFAULT NULL,
  `dealer_id` bigint(20) DEFAULT NULL,
  `dealer_total` decimal(10,2) DEFAULT NULL,
  `real_estate_fee` decimal(10,2) DEFAULT NULL,
  `real_estate_or` decimal(10,2) DEFAULT NULL,
  `real_estate_total` decimal(10,2) DEFAULT NULL,
  `insur_prem_fee` decimal(10,2) DEFAULT NULL,
  `insur_prem_or` decimal(10,2) DEFAULT NULL,
  `insur_prem_total` decimal(10,2) DEFAULT NULL,
  `handling_fee` decimal(10,2) DEFAULT NULL,
  `handling_or` decimal(10,2) DEFAULT NULL,
  `handling_total` decimal(10,2) DEFAULT NULL,
  `dpb_fee` decimal(10,2) DEFAULT NULL,
  `dpb_or` decimal(10,2) DEFAULT NULL,
  `dpb_total` decimal(10,2) DEFAULT NULL,
  `doc_fee` decimal(10,2) DEFAULT NULL,
  `doc_or` decimal(10,2) DEFAULT NULL,
  `doc_total` decimal(10,2) DEFAULT NULL,
  `sbgfc_fee` decimal(10,2) DEFAULT NULL,
  `sbgfc_or` decimal(10,2) DEFAULT NULL,
  `sbgfc_total` decimal(10,2) DEFAULT NULL,
  `other_one_fee` decimal(10,2) DEFAULT NULL,
  `other_one_or` decimal(10,2) DEFAULT NULL,
  `other_one_total` decimal(10,2) DEFAULT NULL,
  `other_two_fee` decimal(10,2) DEFAULT NULL,
  `other_two_or` decimal(10,2) DEFAULT NULL,
  `other_two_total` decimal(10,2) DEFAULT NULL,
  `amount_deduct` decimal(10,2) DEFAULT NULL,
  `amount_due` decimal(10,2) DEFAULT NULL,
  `or_no` bigint(20) DEFAULT NULL,
  `or_date` date DEFAULT NULL,
  `or_amount` decimal(10,2) DEFAULT NULL,
  `payee1` varchar(255) DEFAULT NULL,
  `amount_payee1` decimal(10,2) DEFAULT NULL,
  `payee2` varchar(255) DEFAULT NULL,
  `amount_payee2` decimal(10,2) DEFAULT NULL,
  `payee3` varchar(255) DEFAULT NULL,
  `amount_payee3` decimal(10,2) DEFAULT NULL,
  `payee4` varchar(255) DEFAULT NULL,
  `amount_payee4` decimal(10,2) DEFAULT NULL,
  `payee5` varchar(255) DEFAULT NULL,
  `amount_payee5` decimal(10,2) DEFAULT NULL,
  `is_deleted` bigint(20) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

/*Data for the table `instruction_sheet_td` */

insert  into `instruction_sheet_td`(`id`,`ll_id`,`app_no`,`acc_no`,`bor_name`,`client_no`,`spouse`,`client_stat`,`address`,`pri_con`,`unit_desc`,`tie_up_account`,`tu_lname`,`tu_fname`,`tu_unit_desc`,`amount_line`,`avail_bal`,`outstanding_avail`,`prop_avail`,`date_approved`,`term`,`max_term`,`int_rate`,`start_date`,`maturity_date`,`value_date`,`amount_pn`,`discount`,`net_proceeds`,`manner_payment`,`mort_fee`,`mort_or`,`mort_total`,`proc_fee`,`proc_or`,`proc_total`,`apprais_fee`,`apprais_or`,`apprais_total`,`comm_fee`,`comm_or`,`comm_total`,`front_fee`,`front_or`,`front_total`,`sm_fee`,`salesman_id`,`sm_total`,`dealer_fee`,`dealer_id`,`dealer_total`,`real_estate_fee`,`real_estate_or`,`real_estate_total`,`insur_prem_fee`,`insur_prem_or`,`insur_prem_total`,`handling_fee`,`handling_or`,`handling_total`,`dpb_fee`,`dpb_or`,`dpb_total`,`doc_fee`,`doc_or`,`doc_total`,`sbgfc_fee`,`sbgfc_or`,`sbgfc_total`,`other_one_fee`,`other_one_or`,`other_one_total`,`other_two_fee`,`other_two_or`,`other_two_total`,`amount_deduct`,`amount_due`,`or_no`,`or_date`,`or_amount`,`payee1`,`amount_payee1`,`payee2`,`amount_payee2`,`payee3`,`amount_payee3`,`payee4`,`amount_payee4`,`payee5`,`amount_payee5`,`is_deleted`) values (5,38,201805020,0,'Alingalan, Carl Dennis M',9,'Mia Khalifa','Old','2462 McKinley Hills, Brgy. 423, Tondo',312442131312,'Makati Circuit','0','','','','5400000.00','2000000.00','3400000.00','2000000.00','2018-05-01',356,0,'26.00','2018-05-04','2019-04-25','2018-04-04','2000000.00','248527.69','1751472.31',1,'33183.03','0.00','33183.03','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00',0,'0.00','0.00',0,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','33183.03','1718289.28',21312321,'2018-05-17','0.00','','0.00','','0.00','','0.00','','0.00','','0.00',0),(6,40,201805018,0,'Alingalan, Carl Dennis M',9,'Mia Khalifa','Old','2462 McKinley Hills, Brgy. 423, Tondo',312442131312,'Hello','0','','','','540000.00','20000.00','520000.00','20000.00','2018-05-19',24,0,'26.00','2018-05-28','2018-06-21','2018-04-28','183340.00','644.35','182695.65',1,'33183.00','0.00','33183.00','0.00','0.00','0.00','0.00','0.00','0.00','3244122.00','2544122.00','700000.00','0.00','0.00','0.00','0.00',0,'0.00','0.00',0,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','733183.00','-550487.35',321442,'2018-05-31','2544122.00','','0.00','','0.00','','0.00','','0.00','','0.00',0),(16,41,201805019,0,'Alingalan, Carl Dennis M',9,'Mia Khalifa','Old','2462 McKinley Hills, Brgy. 423, Tondo',312442131312,'Makati Mandaluyong','0','','','','5400000.00','2000000.00','3400000.00','2000000.00','2018-04-30',356,0,'26.00','2016-07-04','2017-06-25','2016-06-04','2000000.00','248528.11','1751471.89',1,'22000.00','0.00','22000.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00',0,'0.00','0.00',0,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','22000.00','1729471.89',0,'0000-00-00','0.00','','0.00','','0.00','','0.00','','0.00','','0.00',0),(17,44,201806001,0,'Carcedo, Chris',10,'Mystic','New','3123213, Brgy. 3123123, 3213213',3123123,'Makati Ave','0','','','','5400000.00','2000000.00','3400000.00','2000000.00','2018-01-17',356,0,'26.00','2016-07-04','2017-06-25','2016-06-04','2000000.00','248528.11','1751471.89',1,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','40000.00',6,'40000.00','0.00',0,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','40000.00','1711471.89',0,'0000-00-00','0.00','','0.00','','0.00','','0.00','','0.00','','0.00',0),(18,46,201806003,0,'Gantan, Charles Dave R',12,'','New','QC, Brgy. 999, QC',234421,'Quezon City','0','','','','5000000.00','2000000.00','3000000.00','2000000.00','2019-09-23',61,0,'21.00','2018-06-14','2018-08-14','2018-05-14','333340.00','8593.33','324746.67',1,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00',0,'0.00','0.00',0,'0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','324746.67',0,'0000-00-00','0.00','','0.00','','0.00','','0.00','','0.00','','0.00',0);

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

insert  into `interview_char`(`id`,`loan_id`,`name`,`contact`,`address`) values (1,19,'','','');

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

insert  into `interview_child`(`id`,`loan_id`,`name`,`age`,`status`,`affiliation`) values (1,19,'Wendy,Peter','12,8',',',',');

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

insert  into `interview_sheet`(`id`,`loan_id`,`client_no`,`nname`,`age`,`civil_status`,`birthdate`,`birthplace`,`edu_att`,`school`,`gsis_sss`,`dri_lic`,`emp_name`,`emp_leng`,`emp_add`,`emp_con`,`emp_des`,`emp_sal`,`emp_prev`,`spouse_name`,`spouse_nname`,`spouse_age`,`spouse_civil_status`,`spouse_birthdate`,`spouse_birthplace`,`spouse_edu_att`,`spouse_school`,`spouse_gsis_sss`,`spouse_dri_lic`,`spouse_emp_name`,`spouse_emp_leng`,`spouse_emp_add`,`spouse_emp_con`,`spouse_emp_des`,`spouse_emp_sal`,`spouse_emp_prev`,`no_child`,`fat_name`,`fat_age`,`fat_add`,`mom_name`,`mom_age`,`mom_add`,`no_sib`,`pres_add`,`pres_tel_no`,`pres_cel_no`,`pres_leng_stay`,`pres_acquire`,`pres_free_name`,`pres_free_tel`,`pres_free_rel`,`pres_rent_name`,`pres_rent_pay`,`pres_rent_tel`,`pres_mort_name`,`pres_mort_pay`,`pres_mort_tel`,`prev_add`,`other_add`,`other_tel_no`,`other_cel_no`,`other_leng_stay`,`other_acquire`,`other_free_name`,`other_free_rel`,`other_free_tel`,`other_rent_name`,`other_rent_pay`,`other_rent_tel`,`other_mort_name`,`other_mort_pay`,`other_mort_tel`,`bus_name`,`org_type`,`date_est`,`bus_nat`,`sing_name`,`part_name`,`part_rel`,`corp_man_name`,`corp_maj_name`,`off_add`,`off_tel_no`,`off_cel_no`,`off_leng_stay`,`off_acquire`,`off_free_name`,`off_free_rel`,`off_free_tel`,`off_rent_name`,`off_rent_pay`,`off_rent_tel`,`off_mort_name`,`off_mort_pay`,`off_mort_tel`,`off_prev_add`,`gar_add`,`gar_tel_no`,`gar_cel_no`,`gar_leng_stay`,`gar_acquire`,`gar_free_name`,`gar_free_rel`,`gar_free_tel`,`gar_rent_name`,`gar_rent_pay`,`gar_rent_tel`,`gar_mort_name`,`gar_mort_pay`,`gar_mort_tel`,`gar_prev_add`,`sour_pay`,`loan_for`,`court_case`,`int_type`,`informant`,`bor_rel`,`int_date`,`corpo_name`,`corpo_pos`,`trade_comp`,`trade_tel`,`trade_con`,`trade_deal`,`trade_coll`,`gas_name`,`gas_tel`,`gas_con`,`gas_coll`,`date_applied`,`applied_by`) values (4,19,6,'Bogs','25',1,'05/28/2018','Pasig','College','','','','','','','','','','','','','',0,'','','','','','','','','','','','','','2','','','','','','','','','','447','','owned','','','','','','','','','','','','','549','','free','','','','','','','','','','','S','','','','','','','','','','745','','owned','','','','','','','','','','','','','847','','owned','','','','','','','','','','','','','','Personal','','','05/28/2018','Jay,Jetro','BA,Dev','','','','','','','','','','2018-05-28','');

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

insert  into `interview_sibling`(`id`,`loan_id`,`name`,`contact`,`address`) values (1,19,'Wilfred,One',',',',');

/*Table structure for table `journal_details` */

DROP TABLE IF EXISTS `journal_details`;

CREATE TABLE `journal_details` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `account_id` bigint(20) DEFAULT NULL,
  `journal_entry_no` bigint(20) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `is_debit` tinyint(4) DEFAULT NULL,
  `bank_name` varchar(255) DEFAULT NULL,
  `chq_number` varchar(255) DEFAULT NULL,
  `desc` varchar(255) DEFAULT NULL,
  `request_by` smallint(1) DEFAULT NULL,
  `date_of_entry` date DEFAULT NULL,
  `status_id` smallint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=253 DEFAULT CHARSET=latin1;

/*Data for the table `journal_details` */

insert  into `journal_details`(`id`,`account_id`,`journal_entry_no`,`amount`,`is_debit`,`bank_name`,`chq_number`,`desc`,`request_by`,`date_of_entry`,`status_id`) values (247,1001,17111,14111,1,'','','test',17,'2017-11-23',1),(248,1002,17111,14111,0,'','','TESt',17,'2017-11-23',2),(249,1005,17111,123,1,'','','test',1,'2017-11-01',1),(250,1002,17111,123,0,'','','rty',1,'2017-11-01',2),(251,1001,17112,100000000,1,'','','test',1,'2017-11-23',1),(252,1001,17112,100000000,0,'','','test',1,'2017-11-23',1);

/*Table structure for table `journal_entries` */

DROP TABLE IF EXISTS `journal_entries`;

CREATE TABLE `journal_entries` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `journal_entry_no` bigint(20) NOT NULL,
  `journal_id` int(11) NOT NULL,
  `date_of_entry` date NOT NULL,
  `description` varchar(100) NOT NULL,
  `request_by` smallint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=latin1;

/*Data for the table `journal_entries` */

insert  into `journal_entries`(`id`,`journal_entry_no`,`journal_id`,`date_of_entry`,`description`,`request_by`) values (50,17111,15,'2017-11-30','TEst',NULL),(51,17111,16,'2017-11-01','test',NULL);

/*Table structure for table `journal_voucher` */

DROP TABLE IF EXISTS `journal_voucher`;

CREATE TABLE `journal_voucher` (
  `jv_primary` int(255) DEFAULT NULL,
  `jv_id` int(255) DEFAULT NULL,
  `clnt_id` int(255) DEFAULT NULL,
  `jv_date` date DEFAULT NULL,
  `details` text,
  `isDeleted` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `journal_voucher` */

insert  into `journal_voucher`(`jv_primary`,`jv_id`,`clnt_id`,`jv_date`,`details`,`isDeleted`) values (6,200001,1,'2018-05-13','1124124',0);

/*Table structure for table `journals` */

DROP TABLE IF EXISTS `journals`;

CREATE TABLE `journals` (
  `journal_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `journal_date` date DEFAULT NULL,
  `description` longtext,
  `ledger_id` bigint(20) DEFAULT NULL,
  `is_archived` int(2) NOT NULL,
  PRIMARY KEY (`journal_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

/*Data for the table `journals` */

insert  into `journals`(`journal_id`,`journal_date`,`description`,`ledger_id`,`is_archived`) values (15,'1930-02-03','TEST JOURNAL 123',0,0),(16,'1901-02-03','test\r\nwest',0,0),(17,'2017-12-01','test234',0,0),(18,'2017-12-02','test567\r\n',0,0),(19,'2017-12-07','tesrtsjd',0,0);

/*Table structure for table `ledgers` */

DROP TABLE IF EXISTS `ledgers`;

CREATE TABLE `ledgers` (
  `ledger_id` bigint(20) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `is_archive` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`ledger_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `ledgers` */

/*Table structure for table `loan_approval_type` */

DROP TABLE IF EXISTS `loan_approval_type`;

CREATE TABLE `loan_approval_type` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `is_deleted` smallint(1) DEFAULT '0',
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `loan_approval_type` */

insert  into `loan_approval_type`(`id`,`code`,`name`,`is_deleted`) values (1,'A1','Add-On - Salary Loan',0),(2,'A2','Add-On - Truck Financing',0),(3,'A3','Add-On - Leasing',0),(4,'A4','Add-On - Others',0),(5,'AA','AA',1),(6,'B1','True Discount',0),(7,'C1','In Arrears - Lump Sum',0),(8,'C2','In Arrears - Annuity',0);

/*Table structure for table `loan_list` */

DROP TABLE IF EXISTS `loan_list`;

CREATE TABLE `loan_list` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `app_type` varchar(255) DEFAULT NULL,
  `app_no` varchar(255) DEFAULT NULL,
  `client_no` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `spouse` varchar(255) DEFAULT NULL,
  `dealer_id` bigint(20) DEFAULT NULL,
  `salesman_id` bigint(20) DEFAULT NULL,
  `loan_type_id` bigint(20) DEFAULT NULL,
  `credit_fac_id` bigint(20) DEFAULT NULL,
  `prod_line_id` bigint(20) DEFAULT NULL,
  `mark_type_id` bigint(20) DEFAULT NULL,
  `coll_code_id` bigint(20) DEFAULT NULL,
  `bus_add` varchar(255) DEFAULT NULL,
  `home_add` varchar(255) DEFAULT NULL,
  `email_add` varchar(255) DEFAULT NULL,
  `bus_tel` varchar(255) DEFAULT NULL,
  `home_tel` varchar(255) DEFAULT NULL,
  `pri_con` varchar(255) DEFAULT NULL,
  `sec_con` varchar(255) DEFAULT NULL,
  `unit_desc` varchar(255) DEFAULT NULL,
  `amt_fin` varchar(255) DEFAULT NULL,
  `res_val` varchar(255) DEFAULT NULL,
  `down_pay` varchar(255) DEFAULT NULL,
  `term` varchar(255) DEFAULT NULL,
  `list_pri` varchar(255) DEFAULT NULL,
  `int_rate` varchar(255) DEFAULT NULL,
  `mon_amor` varchar(255) DEFAULT NULL,
  `applied_by` bigint(20) DEFAULT NULL,
  `ci_check_by` bigint(20) DEFAULT '0',
  `date_applied` date DEFAULT NULL,
  `date_modified` date DEFAULT NULL,
  `is_deleted` tinyint(4) DEFAULT '0',
  `loan_status_id` bigint(20) DEFAULT '2',
  `is_approve` smallint(1) DEFAULT '0',
  `current_approver_id` bigint(20) DEFAULT NULL,
  `approve_type` smallint(1) DEFAULT '0',
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;

/*Data for the table `loan_list` */

insert  into `loan_list`(`id`,`app_type`,`app_no`,`client_no`,`last_name`,`first_name`,`spouse`,`dealer_id`,`salesman_id`,`loan_type_id`,`credit_fac_id`,`prod_line_id`,`mark_type_id`,`coll_code_id`,`bus_add`,`home_add`,`email_add`,`bus_tel`,`home_tel`,`pri_con`,`sec_con`,`unit_desc`,`amt_fin`,`res_val`,`down_pay`,`term`,`list_pri`,`int_rate`,`mon_amor`,`applied_by`,`ci_check_by`,`date_applied`,`date_modified`,`is_deleted`,`loan_status_id`,`is_approve`,`current_approver_id`,`approve_type`) values (18,'new','201805001','5','Chicano','Mhar','uuuu',1,0,1,1,3,1,2,'','','test@gmail.com','8989908','89098','98098','09809',NULL,'10000',NULL,NULL,NULL,NULL,'18',NULL,1,0,'2018-05-01','2018-05-08',0,4,0,NULL,0),(19,'','201805002','6','Drilon','Bugoy','',6,0,2,2,2,2,2,'','','bugoy@gmail.com','123615467','312635817546125','1265417541625','136851283532','test1','10000','100','100','100','100','18','100',1,1,'2018-05-08','2018-06-11',0,4,0,NULL,0),(20,'new','201805003','1','Tumanda','Jay','12345',1,1,1,2,2,1,1,'','','jay@gmail.com','123','12123','123','123',NULL,'10000',NULL,NULL,NULL,NULL,'18',NULL,1,1,'2018-05-08','2018-06-22',0,6,0,NULL,0),(21,'new','201805004','9','Alingalan','Carl Dennis','',1,1,2,1,1,1,1,'','','majin_bu@gmail.com','31214213123','214123213','312442131312','412413123',NULL,'10000',NULL,NULL,NULL,NULL,'18',NULL,1,0,'2018-05-08','2018-06-11',0,9,0,NULL,0),(22,'new','201805005','9','Alingalan','Carl Dennis','',1,1,2,1,2,1,1,'','','majin_bu@gmail.com','31214213123','214123213','312442131312','412413123',NULL,'10000',NULL,NULL,NULL,NULL,'18',NULL,1,1,'2018-05-08','2018-05-13',0,8,0,NULL,0),(24,'','201805006','9','Alingalan','Carl Dennis','',1,1,1,2,2,2,1,'','','majin_bu@gmail.com','31214213123','214123213','312442131312','412413123',NULL,'10000',NULL,NULL,NULL,NULL,'18',NULL,1,1,'2018-05-08','2018-05-08',0,9,0,NULL,0),(25,'','201805007','9','Alingalan','Carl Dennis','',1,1,2,1,2,1,2,'','','majin_bu@gmail.com','31214213123','214123213','312442131312','412413123',NULL,'10000',NULL,NULL,NULL,NULL,'18',NULL,1,0,'2018-05-09','2018-06-24',0,6,0,NULL,0),(26,'','201805008','9','Alingalan','Carl Dennis','',1,1,1,1,1,1,1,'','','majin_bu@gmail.com','31214213123','214123213','312442131312','412413123',NULL,'10000',NULL,NULL,NULL,NULL,'18',NULL,1,1,'2018-05-13','2018-05-13',0,9,0,NULL,0),(27,'','201805009','9','Alingalan','Carl Dennis','',1,1,1,1,1,1,1,'','','majin_bu@gmail.com','31214213123','214123213','312442131312','412413123',NULL,'10000',NULL,NULL,NULL,NULL,'18',NULL,1,1,'2018-05-14','2018-05-14',0,9,0,NULL,0),(28,'','201805010','1','Tumanda','Jay','12345',6,6,1,1,1,1,1,'','','jay@gmail.com','123','12123','123','123','12','10000','12','21','12','12','18','12',1,0,'2018-05-17',NULL,0,2,0,NULL,0),(32,'','201805011','7','CONOCONO','CJAY','TEST',6,0,1,1,1,1,1,'','','test11@gmail.com','123','123','123','123','12','10000','12','12','12','21','18','12',1,0,'2018-05-17',NULL,0,2,0,NULL,0),(33,'','201805012','6','Drilon','Bugoy','',6,0,1,1,2,1,2,'','','bugoy@gmail.com','123615467','312635817546125','1265417541625','136851283532','1','10000','1','1','1','1','18','1',1,0,'2018-05-23',NULL,0,2,0,NULL,0),(34,'','201805013','7','CONOCONO','CJAY','TEST',7,6,2,1,2,1,1,'','','test11@gmail.com','123','123','123','123','1','10000','1','1','1','1','18','1',1,0,'2018-05-23',NULL,0,2,0,NULL,0),(35,'','201805014','2','Ribleza','Wilfred','12345',6,6,1,1,1,1,1,'','','jay@gmail.com','123','12123','123','123','222','10000','2','2','2','2','18','2',1,0,'2018-05-26',NULL,0,2,0,NULL,0),(36,'','201805015','1','Tumanda','Jay','12345',6,0,1,0,0,0,0,'','','','123','12123','','','','10000','','','','','18','',1,0,'2018-05-31',NULL,0,2,0,NULL,0),(41,'','201805016','10','Carcedo','Chris','',6,0,2,0,0,0,0,'','','','','','','','','10000','','','','','18','',1,0,'2018-05-31',NULL,0,2,0,NULL,0),(42,'','201805017','6','Drilon','Bugoy','',7,0,3,0,0,0,0,'','','','123615467','312635817546125','','','','10000','','','','','18','',1,0,'2018-05-31','2018-06-11',0,3,0,NULL,0),(44,'','201806001','10','Carcedo','Chris','Mystic',6,6,6,1,1,1,1,'','','','','','','','Makati Ave','200000','15000','230000','23','50000','52','250000',1,1,'2018-06-01','2018-06-04',0,9,0,NULL,0),(45,'','201806002','11','Yabson','Ataska','Ang',9,0,2,1,1,2,3,'','','','','','','','asdad','131231','3123123','3123123','3123123','313123123','3122312','313123123',1,1,'2018-06-06','2018-06-07',0,9,0,NULL,0),(46,'new','201806003','12','Gantan','Charles Dave','Marami',6,0,6,1,3,1,3,'','','','','','','','Quezon City','200000','15000','2000','23','23000','25','25000',1,1,'2018-06-20','2018-06-20',0,9,0,NULL,0);

/*Table structure for table `loan_status` */

DROP TABLE IF EXISTS `loan_status`;

CREATE TABLE `loan_status` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `is_deleted` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

/*Data for the table `loan_status` */

insert  into `loan_status`(`id`,`name`,`is_deleted`) values (1,'On-going',0),(2,'Marketing - Loan Entry',0),(3,'Credit - CI Checking',0),(4,'Credit - Recommendation of Application',0),(5,'Marketing - Credit Approval',0),(6,'Marketing - Credit Advising',0),(7,'Marketing - Collateral',0),(8,'Marketing - Checklist',0),(9,'Marketing - Instruction Sheet',0),(10,'Loan - Approval',0),(11,'Loan - Distribution',0),(12,'Approved',0),(13,'Rejected',0);

/*Table structure for table `loan_types` */

DROP TABLE IF EXISTS `loan_types`;

CREATE TABLE `loan_types` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `loan_types` */

insert  into `loan_types`(`id`,`code`,`name`,`is_deleted`) values (1,'L1','Salary Loan',0),(2,'L2','Student Loan',0);

/*Table structure for table `manner_of_payment` */

DROP TABLE IF EXISTS `manner_of_payment`;

CREATE TABLE `manner_of_payment` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `is_deleted` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `manner_of_payment` */

insert  into `manner_of_payment`(`id`,`code`,`name`,`is_deleted`) values (1,'PDC','PostDated Checks',0),(2,'COL','Collection',0),(3,'SALDUC','Salary Deduct',0);

/*Table structure for table `marketing_type` */

DROP TABLE IF EXISTS `marketing_type`;

CREATE TABLE `marketing_type` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `marketing_type` */

insert  into `marketing_type`(`id`,`code`,`name`,`is_deleted`) values (1,'MT1','Marketing Type 1',0),(2,'MT2','Marketing Type 2',0);

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

insert  into `neighbor_check`(`id`,`loan_id`,`client_no`,`tel_no`,`cel_no`,`leng_stay`,`acquire`,`free_name`,`free_rel`,`free_tel`,`rent_name`,`rent_pay`,`rent_tel`,`mort_name`,`mort_pay`,`mort_tel`,`prev_add`,`other_add`,`other_tel`,`desc_imp`,`equip_with`,`liv_con`,`liv_con_oth`,`neigh_spec`,`neigh_spec_oth`,`access_to`,`subj_rep`,`direction`,`date_applied`,`applied_by`) values (1,19,6,'1234','1234','12','owned','','','','','','','','','','','','','','','good',NULL,'subdivision',NULL,'bus','','','2018-05-28',0);

/*Table structure for table `official_receipt` */

DROP TABLE IF EXISTS `official_receipt`;

CREATE TABLE `official_receipt` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `client_id` bigint(20) DEFAULT NULL,
  `payment_type_id` bigint(20) DEFAULT NULL,
  `bank_id` bigint(20) DEFAULT NULL,
  `check_no` varchar(255) DEFAULT NULL,
  `details` varchar(255) DEFAULT NULL,
  `deposit_date` varchar(255) DEFAULT NULL,
  `cash` varchar(255) DEFAULT NULL,
  `cheque` varchar(255) DEFAULT NULL,
  `total` varchar(255) DEFAULT NULL,
  `is_deleted` smallint(1) DEFAULT '0',
  `date` varchar(255) DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

/*Data for the table `official_receipt` */

insert  into `official_receipt`(`id`,`client_id`,`payment_type_id`,`bank_id`,`check_no`,`details`,`deposit_date`,`cash`,`cheque`,`total`,`is_deleted`,`date`) values (23,4,1,1,'test','test','04/07/2018','22','22','44',0,'2018-04-05'),(24,4,2,2,'1234','test details','04/05/2018','4300','7000','11300 PHP',0,'2018-04-05'),(25,4,2,2,'1234','test details 2','04/05/2018','4300','3000','7300 PHP',0,'2018-04-05'),(26,4,1,3,'69','YAJ TUMANDA','04/05/2018','6969','6969','13938 PHP',0,'2018-04-05'),(27,1,1,2,'3423421','payment of this day','04/09/2018','2000','','2000 PHP',0,'2018-04-09'),(28,1,1,1,'23','233','04/16/2018','22','22','44 PHP',0,'2018-04-16');

/*Table structure for table `payment_type` */

DROP TABLE IF EXISTS `payment_type`;

CREATE TABLE `payment_type` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `is_deleted` smallint(1) DEFAULT '0',
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `payment_type` */

insert  into `payment_type`(`id`,`name`,`is_deleted`) values (1,'Loan Receivables',0),(2,'Others',0);

/*Table structure for table `preparation` */

DROP TABLE IF EXISTS `preparation`;

CREATE TABLE `preparation` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `client_id` bigint(20) DEFAULT NULL,
  `debit` varchar(255) DEFAULT NULL,
  `credit` varchar(255) DEFAULT NULL,
  `is_deleted` smallint(1) DEFAULT '0',
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `preparation` */

/*Table structure for table `product_line` */

DROP TABLE IF EXISTS `product_line`;

CREATE TABLE `product_line` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `product_line` */

insert  into `product_line`(`id`,`code`,`name`,`is_deleted`) values (1,'DB','DBF - Funded Loans',0),(2,'DP','Discounting of PDC',0),(3,'IL','Interim Loans - DBF Funds',0),(4,'LS','Leasing - Equipment/Vehicle',0),(5,'OT','Others',0),(6,'RE','Loan VS Rem',0),(7,'SB','SBGFC - Funded Loans',0),(8,'SL','Salary Loans',0),(9,'SS','Loan VS Shares of Stocks',0),(10,'TF','Truck Financing',0),(11,'VF','Vehicle Financing',0);

/*Table structure for table `provinces` */

DROP TABLE IF EXISTS `provinces`;

CREATE TABLE `provinces` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(300) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=latin1;

/*Data for the table `provinces` */

insert  into `provinces`(`id`,`name`) values (1,'Abra'),(2,'Agusan del Norte'),(3,'Agusan del Sur'),(4,'Aklan'),(5,'Albay'),(6,'Antique'),(7,'Apayao'),(8,'Aurora'),(9,'Basilan'),(10,'Bataan'),(11,'Batanes'),(12,'Batangas'),(13,'Benguet'),(14,'Biliran'),(15,'Bohol'),(16,'Bukidnon'),(17,'Bulacan'),(18,'Cagayan'),(19,'Camarines Norte'),(20,'Camarines Sur'),(21,'Camiguin'),(22,'Capiz'),(23,'Catanduanes'),(24,'Cavite'),(25,'Cebu'),(26,'Compostela Valley'),(27,'Cotabato'),(28,'Davao del Norte'),(29,'Davao del Sur'),(30,'Davao Oriental'),(31,'Eastern Samar'),(32,'Guimaras'),(33,'Ifugao'),(34,'Ilocos Norte'),(35,'Ilocos Sur'),(36,'Iloilo'),(37,'Isabela'),(38,'Kalinga'),(39,'La Union'),(40,'Laguna'),(41,'Lanao del Norte'),(42,'Lanao del Sur'),(43,'Leyte'),(44,'Maguindanao'),(45,'Marinduque'),(46,'Masbate'),(47,'Metro Manila'),(48,'Misamis Occidental'),(49,'Misamis Oriental'),(50,'Mountain Province'),(51,'Negros Occidental'),(52,'Negros Oriental'),(53,'Northern Samar'),(54,'Nueva Ecija'),(55,'Nueva Vizcaya'),(56,'Occidental Mindoro'),(57,'Oriental Mindoro'),(58,'Palawan'),(59,'Pampanga'),(60,'Pangasinan'),(61,'Quezon'),(62,'Quirino'),(63,'Rizal'),(64,'Romblon'),(65,'Samar'),(66,'Sarangani'),(67,'Siquijor'),(68,'Sorsogon'),(69,'South Cotabato'),(70,'Southern Leyte'),(71,'Sultan Kudarat'),(72,'Sulu'),(73,'Surigao del Norte'),(74,'Surigao del Sur'),(75,'Tarlac'),(76,'Tawi-Tawi'),(77,'Zambales'),(78,'Zamboanga del Norte'),(79,'Zamboanga del Sur'),(80,'Zamboanga Sibugay');

/*Table structure for table `query_message` */

DROP TABLE IF EXISTS `query_message`;

CREATE TABLE `query_message` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `sender_id` bigint(20) NOT NULL,
  `receiver_id` bigint(20) DEFAULT NULL,
  `date_sent` datetime DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `query_id` bigint(20) DEFAULT NULL,
  `read` smallint(1) DEFAULT '0',
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

/*Data for the table `query_message` */

insert  into `query_message`(`id`,`sender_id`,`receiver_id`,`date_sent`,`subject`,`message`,`query_id`,`read`) values (32,1,17,'2017-11-20 17:48:49',NULL,'wew',171,1),(33,5,17,'2017-11-20 17:49:05',NULL,'huyyyyyy',175,1),(34,17,1,'2017-11-20 17:49:17',NULL,'po',171,1),(35,5,17,'2017-11-20 22:33:51',NULL,'wew',175,1),(36,17,5,'2017-11-20 22:34:01',NULL,'oh?\r\n',175,0),(37,1,17,'2017-11-22 10:05:53',NULL,'Hahahha\r\n',171,1),(38,1,17,'2017-11-22 10:05:53',NULL,'Hahahha',171,1),(39,1,17,'2017-11-23 10:45:41',NULL,'huy',171,1),(40,1,17,'2017-11-23 10:45:47',NULL,'huy\r\n',171,1);

/*Table structure for table `questions` */

DROP TABLE IF EXISTS `questions`;

CREATE TABLE `questions` (
  `question_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `question` varchar(255) DEFAULT NULL,
  KEY `question_id` (`question_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `questions` */

insert  into `questions`(`question_id`,`question`) values (1,'What\'s your favorite brand of pencil?'),(2,'What is your favorite flavor?'),(3,'Who\'s your favorite teacher?');

/*Table structure for table `quotes` */

DROP TABLE IF EXISTS `quotes`;

CREATE TABLE `quotes` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `quote` varchar(255) DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `quotes` */

insert  into `quotes`(`id`,`quote`) values (1,'The difference between stupidity and genius is that genius has its limits. - Albert Einstein'),(2,'Insanity: doing the same thing over and over again and expecting different results. - Albert Einstein'),(3,'The only way to keep your health is to eat what you don\'t want, drink what you don\'t like, and do what you\'d rather not. - Mark Twain '),(4,'When you are courting a nice girl an hour seems like a second. When you sit on a red-hot cinder a second seems like an hour. That\'s relativity. - Albert Einstein');

/*Table structure for table `region` */

DROP TABLE IF EXISTS `region`;

CREATE TABLE `region` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `country_id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `region` */

insert  into `region`(`id`,`country_id`,`name`,`is_deleted`) values (1,1,'METRO MANILA',0),(2,1,'test',1),(3,1,'test',1),(4,1,'OUT OF TOWN',0);

/*Table structure for table `request_status` */

DROP TABLE IF EXISTS `request_status`;

CREATE TABLE `request_status` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `request_name` varchar(255) NOT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `request_status` */

insert  into `request_status`(`id`,`request_name`) values (1,'Pending'),(2,'Approved'),(3,'Rejected'),(4,'Cancelled');

/*Table structure for table `requirements` */

DROP TABLE IF EXISTS `requirements`;

CREATE TABLE `requirements` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `requirement_code` varchar(255) NOT NULL,
  `loan_type_id` varchar(255) NOT NULL,
  `caf` varchar(255) NOT NULL,
  `cf` varchar(255) NOT NULL,
  `is_deleted` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `requirements` */

insert  into `requirements`(`id`,`name`,`requirement_code`,`loan_type_id`,`caf`,`cf`,`is_deleted`) values (1,'2x2 Picture ID','2X2','','1,','1,3,',0),(2,'2 Valid ID','2VAL','','2,8,1,','1,3,2,',0),(3,'Baranggay Clearance','BRCL','','3,2,5,1,','1,2,',0),(4,'Tax Income','BIR','','','1,2,',0);

/*Table structure for table `salesman` */

DROP TABLE IF EXISTS `salesman`;

CREATE TABLE `salesman` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `is_deleted` tinyint(4) DEFAULT '0',
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `salesman` */

insert  into `salesman`(`id`,`name`,`is_deleted`) values (1,'Salesman No. 1',0);

/*Table structure for table `security_question` */

DROP TABLE IF EXISTS `security_question`;

CREATE TABLE `security_question` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `security_question` varchar(255) DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `security_question` */

/*Table structure for table `td_sched` */

DROP TABLE IF EXISTS `td_sched`;

CREATE TABLE `td_sched` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `app_no` bigint(20) DEFAULT NULL,
  `client_no` bigint(20) DEFAULT NULL,
  `bank` bigint(20) DEFAULT NULL,
  `check_no` bigint(20) DEFAULT NULL,
  `amount_sched` decimal(10,2) DEFAULT NULL,
  `maturity_date_sched` date DEFAULT NULL,
  `term_sched` bigint(20) DEFAULT NULL,
  `discount` decimal(10,2) DEFAULT NULL,
  `net_proceeds_sched` decimal(10,2) DEFAULT NULL,
  `date_created` datetime DEFAULT CURRENT_TIMESTAMP,
  `is_deleted` bigint(20) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=latin1;

/*Data for the table `td_sched` */

insert  into `td_sched`(`id`,`app_no`,`client_no`,`bank`,`check_no`,`amount_sched`,`maturity_date_sched`,`term_sched`,`discount`,`net_proceeds_sched`,`date_created`,`is_deleted`) values (2,201805020,9,3,2004,'166674.00','2018-06-10',37,'4337.94','162336.06','2018-05-28 21:39:16',0),(5,201805020,9,3,2005,'166666.00','2018-05-31',27,'3187.82','163478.18','2018-05-28 22:09:53',1),(6,201805020,9,2,2008,'166666.00','2018-06-30',33,'0.00','166666.00','2018-05-28 23:14:19',1),(7,201805020,9,1,2089,'166666.00','2018-07-19',76,'8672.13','157993.87','2018-05-28 23:20:18',0),(8,201805020,9,3,2078,'166666.00','2018-06-30',57,'6589.85','160076.15','2018-05-28 23:21:29',0),(9,201805020,9,3,5000,'166666.00','2018-08-31',119,'13190.31','153475.69','2018-05-28 23:27:26',0),(10,201805020,9,3,3214,'166666.00','2018-09-30',149,'16192.59','150473.41','2018-05-28 23:27:40',0),(11,201805020,9,3,4213,'166666.00','2018-09-30',149,'16192.59','150473.41','2018-05-28 23:27:56',0),(12,201805020,9,3,4213,'166666.00','2018-06-30',57,'6589.85','160076.15','2018-05-28 23:28:33',0),(13,201805020,9,3,412344,'166666.00','2018-06-30',57,'6589.85','160076.15','2018-05-28 23:28:51',0),(14,201805020,9,3,321321,'166666.00','2018-05-31',27,'3187.82','163478.18','2018-05-28 23:29:11',0),(15,201805020,9,3,442312,'166666.00','2018-07-31',88,'9959.63','156706.37','2018-05-28 23:29:24',0),(16,201805020,9,3,344213,'166666.00','2018-07-31',88,'9959.63','156706.37','2018-05-28 23:29:37',0),(17,201805020,9,3,4423213,'166666.00','2018-07-25',82,'9318.44','157347.56','2018-05-28 23:29:47',0),(18,201805018,9,2,3421,'166674.00','2018-05-31',3,'360.40','166313.60','2018-05-29 00:19:54',0),(19,201805018,9,2,42312,'16666.00','2018-06-21',24,'283.95','16382.05','2018-05-29 00:20:16',0),(29,201805019,9,2,32421,'166674.00','2018-06-30',33,'3879.87','162794.13','2018-05-31 16:13:20',1),(30,201805019,9,2,10251,'166674.00','2016-08-10',37,'4337.94','162336.06','2018-05-31 16:25:51',0),(31,201805019,9,2,10252,'166666.00','2016-10-10',98,'11016.56','155649.44','2018-05-31 16:26:37',1),(32,201805019,9,2,10252,'166666.00','2016-10-10',98,'11016.56','155649.44','2018-05-31 16:27:35',1),(33,201805019,9,2,10252,'166666.00','2016-09-10',68,'7801.97','158864.03','2018-05-31 16:28:34',0),(34,201805019,9,2,10253,'166666.00','2016-10-10',98,'11016.56','155649.44','2018-05-31 16:29:12',0),(35,201805019,9,2,10254,'166666.00','2016-11-10',129,'14204.39','152461.61','2018-05-31 16:35:13',0),(36,201805019,9,2,10255,'166666.00','2016-12-10',159,'17167.38','149498.62','2018-05-31 16:35:33',0),(37,201805019,9,2,10256,'166666.00','2017-01-10',190,'20110.62','146555.38','2018-05-31 16:36:10',0),(38,201805019,9,2,10257,'166666.00','2017-02-10',221,'22940.22','143725.78','2018-05-31 16:39:55',0),(39,201805019,9,2,10258,'166666.00','2017-03-10',249,'25403.63','141262.37','2018-05-31 16:40:25',0),(40,201805019,9,2,10259,'166666.00','2017-04-10',280,'28034.37','138631.63','2018-05-31 16:40:48',0),(41,201805019,9,2,10260,'166666.00','2017-05-10',310,'30488.62','136177.38','2018-05-31 16:41:13',0),(42,201805019,9,2,10261,'166666.00','2017-06-10',341,'32935.00','133731.00','2018-05-31 16:41:56',0),(43,201805019,9,2,10261,'166666.00','2016-06-10',24,'2839.60','163826.40','2018-05-31 20:46:42',1),(44,201805019,9,2,10262,'166666.00','2017-06-25',356,'34087.41','132578.59','2018-05-31 20:48:39',0),(45,201805019,9,2,10263,'166666.00','2017-07-25',386,'36333.76','130332.24','2018-05-31 21:54:56',1),(46,201806001,10,2,10251,'166674.00','2016-08-10',37,'4337.94','162336.06','2018-06-01 00:19:00',0),(47,201806001,10,2,10252,'166666.00','2016-09-10',68,'7801.97','158864.03','2018-06-01 00:19:33',0),(48,201806001,10,2,10253,'166666.00','2016-10-10',98,'11016.56','155649.44','2018-06-01 00:20:03',0),(49,201806001,10,2,10254,'166666.00','2016-11-10',129,'14204.39','152461.61','2018-06-01 00:20:34',0),(50,201806001,10,2,10255,'166666.00','2016-12-10',159,'17167.38','149498.62','2018-06-01 00:22:45',0),(51,201806001,10,2,10256,'166666.00','2017-01-10',190,'20110.62','146555.38','2018-06-01 00:23:07',0),(52,201806001,10,2,10257,'166666.00','2017-02-10',221,'22940.22','143725.78','2018-06-01 00:23:32',0),(53,201806001,10,2,10258,'166666.00','2017-03-10',249,'25403.63','141262.37','2018-06-01 00:24:04',0),(54,201806001,10,2,10259,'166666.00','2017-04-10',280,'28034.37','138631.63','2018-06-01 00:24:36',0),(55,201806001,10,2,10260,'166666.00','2017-05-10',310,'30488.62','136177.38','2018-06-01 00:24:54',0),(56,201806001,10,2,10261,'166666.00','2017-06-10',341,'32935.00','133731.00','2018-06-01 00:25:29',0),(57,201806001,10,2,10262,'166666.00','2017-06-25',356,'34087.41','132578.59','2018-06-01 00:26:10',0),(58,201806001,10,2,20342,'166666.00','1999-09-24',6128,'135948.56','30717.44','2018-06-04 17:45:56',1),(59,201806003,12,2,20043,'166674.00','2018-07-14',30,'2866.63','163807.37','2018-06-20 22:21:50',0),(60,201806003,12,4,2000,'166666.00','2018-08-14',61,'5726.70','160939.30','2018-06-20 22:22:58',0);

/*Table structure for table `trade_check` */

DROP TABLE IF EXISTS `trade_check`;

CREATE TABLE `trade_check` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `loan_id` bigint(20) DEFAULT NULL,
  `client_no` bigint(20) DEFAULT NULL,
  `informant` varchar(255) DEFAULT NULL,
  `tel_no` varchar(255) DEFAULT NULL,
  `dealings` varchar(255) DEFAULT NULL,
  `since` varchar(255) DEFAULT NULL,
  `ave_bill` varchar(255) DEFAULT NULL,
  `terms` varchar(255) DEFAULT NULL,
  `experience` varchar(255) DEFAULT NULL,
  `date_checked` varchar(255) DEFAULT NULL,
  `checked_by` bigint(20) DEFAULT NULL,
  `is_deleted` tinyint(4) DEFAULT '0',
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `trade_check` */

insert  into `trade_check`(`id`,`loan_id`,`client_no`,`informant`,`tel_no`,`dealings`,`since`,`ave_bill`,`terms`,`experience`,`date_checked`,`checked_by`,`is_deleted`) values (1,2,1,'Wilfred','54','deals','2018','18000','termsss','exp','04/14/2018',1,1),(2,2,1,'Wilfred','1234','deas','2018','18000','termsss','eaxsf','04/15/2018',1,0),(3,8,1,'Mark','2213721','213213213','321312321','321312321','3213123','32132131','03/21/2032',1,0),(4,8,1,'Maribelle','123123','321312321','3213123','3213123','321312','321312','03/12/2032',1,0),(5,18,5,'21312321','312312','3123','23123','2132131','23123','12321321','03/12/2032',1,0);

/*Table structure for table `user_type` */

DROP TABLE IF EXISTS `user_type`;

CREATE TABLE `user_type` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `is_deleted` smallint(1) DEFAULT '0',
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `user_type` */

insert  into `user_type`(`id`,`name`,`is_deleted`) values (1,'Administrator',0),(2,'Accounting',0),(3,'Executive',0),(4,'Department Head',0);

/*Table structure for table `user_types` */

DROP TABLE IF EXISTS `user_types`;

CREATE TABLE `user_types` (
  `user_type_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_type` varchar(255) DEFAULT NULL,
  `is_deleted` smallint(1) DEFAULT '0',
  KEY `id` (`user_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `user_types` */

insert  into `user_types`(`user_type_id`,`user_type`,`is_deleted`) values (1,'Administrator',0),(2,'Accounting',0),(3,'Marketing',0),(4,'CI',0);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `user_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) DEFAULT NULL,
  `middle_initial` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `password` longtext,
  `user_type_id` varchar(50) DEFAULT NULL,
  `is_active` smallint(1) DEFAULT '1',
  `is_login` smallint(1) NOT NULL DEFAULT '0',
  `department_id` smallint(1) DEFAULT '1',
  `question_id` smallint(1) DEFAULT NULL,
  `answer` varchar(255) DEFAULT NULL,
  `is_deleted` smallint(1) DEFAULT '0',
  `last_activity` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT 'default.gif',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `users` */

insert  into `users`(`user_id`,`first_name`,`middle_initial`,`last_name`,`password`,`user_type_id`,`is_active`,`is_login`,`department_id`,`question_id`,`answer`,`is_deleted`,`last_activity`,`username`,`image`) values (1,'CJAY','D.','CONOCONO','TNTz0EXkSq4dC+kr8w8+UF14gOTFdx6RSEJpaGwQ7v4=','1',1,1,0,1,'LovAATjZX7extDhG7zbThmUxMuKZ4nvVLM/ucUpvnRE=',0,'2018-07-03 21:42:22','admin','1041518045921.png'),(2,'Mhar Vic','Mapagmahal','Chicano','TNTz0EXkSq4dC+kr8w8+UF14gOTFdx6RSEJpaGwQ7v4=','1',1,0,1,1,'LovAATjZX7extDhG7zbThmUxMuKZ4nvVLM/ucUpvnRE=',0,'2018-04-15 21:56:14','mharvic','giphy.gif'),(4,'Jay','','Tumanda','TNTz0EXkSq4dC+kr8w8+UF14gOTFdx6RSEJpaGwQ7v4=','1',1,1,1,1,'JEwlbswck19d2LIJWhfaT/Kk6DZySfs4tcF5HD9ynnM=',0,'2018-04-16 08:37:41','jaytumanda','default.gif'),(5,'Wilfred','','Ribleza','RiNRg2U/vFz+uMySogP8cHORVGXXIr5xcnXHJI9jYuY=','1',1,0,1,NULL,NULL,0,'2018-04-16 08:05:53','wilfred','default.gif'),(6,'Admin','','Admin','RiNRg2U/vFz+uMySogP8cHORVGXXIr5xcnXHJI9jYuY=','1',1,0,1,NULL,NULL,0,NULL,'ffc','default.gif');

/*Table structure for table `vw_chartacc` */

DROP TABLE IF EXISTS `vw_chartacc`;

/*!50001 DROP VIEW IF EXISTS `vw_chartacc` */;
/*!50001 DROP TABLE IF EXISTS `vw_chartacc` */;

/*!50001 CREATE TABLE  `vw_chartacc`(
 `id` bigint(20) ,
 `acc_id` varchar(255) ,
 `account_name` longtext ,
 `name` varchar(50) ,
 `is_deleted` tinyint(4) 
)*/;

/*Table structure for table `vw_journals` */

DROP TABLE IF EXISTS `vw_journals`;

/*!50001 DROP VIEW IF EXISTS `vw_journals` */;
/*!50001 DROP TABLE IF EXISTS `vw_journals` */;

/*!50001 CREATE TABLE  `vw_journals`(
 `journal_id` bigint(20) ,
 `journal_date` date ,
 `description` longtext ,
 `is_archived` int(2) 
)*/;

/*View structure for view vw_chartacc */

/*!50001 DROP TABLE IF EXISTS `vw_chartacc` */;
/*!50001 DROP VIEW IF EXISTS `vw_chartacc` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_chartacc` AS select `accounts`.`id` AS `id`,`accounts`.`acc_id` AS `acc_id`,`accounts`.`account_name` AS `account_name`,`account_types`.`name` AS `name`,`accounts`.`is_deleted` AS `is_deleted` from (`accounts` join `account_types` on((`accounts`.`type` = `account_types`.`acc_types_id`))) */;

/*View structure for view vw_journals */

/*!50001 DROP TABLE IF EXISTS `vw_journals` */;
/*!50001 DROP VIEW IF EXISTS `vw_journals` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_journals` AS select `journals`.`journal_id` AS `journal_id`,`journals`.`journal_date` AS `journal_date`,`journals`.`description` AS `description`,`journals`.`is_archived` AS `is_archived` from `journals` */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
