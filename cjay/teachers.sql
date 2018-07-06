/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : abada_db

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-07-04 14:45:16
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `teachers`
-- ----------------------------
DROP TABLE IF EXISTS `teachers`;
CREATE TABLE `teachers` (
  `teacher_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `nationality` varchar(255) DEFAULT NULL,
  `birthdate` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `mobile_no` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `is_deleted` varchar(1) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `telephone_no` varchar(255) DEFAULT NULL,
  `birthplace` varchar(255) DEFAULT NULL,
  `religion` varchar(255) DEFAULT NULL,
  `ed_Desc` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`teacher_id`)
) ENGINE=InnoDB AUTO_INCREMENT=88 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of teachers
-- ----------------------------
INSERT INTO `teachers` VALUES ('1', 'E15-0221', 'Christine', 'De Belen', 'Aceveda', null, null, null, '9771278452', null, '0', null, null, null, null, null);
INSERT INTO `teachers` VALUES ('2', 'E12-0184', 'Dianne April', 'Comia', 'Alcantara', null, null, null, null, null, '0', null, null, null, null, null);
INSERT INTO `teachers` VALUES ('3', 'E04-0122', 'Allan', 'Villanueva', 'Ansaldo', null, null, null, null, null, '0', null, null, null, null, null);
INSERT INTO `teachers` VALUES ('4', 'E12-0185', 'Vanessa', 'Teria', 'Ardid', null, null, null, '9463244227', null, '0', null, null, null, null, null);
INSERT INTO `teachers` VALUES ('5', 'E08-0142', 'Rechel', 'Navarro', 'Arpia', null, null, null, '9994832213', null, '0', null, null, null, null, null);
INSERT INTO `teachers` VALUES ('6', 'E01-0007', 'Richard', 'Ledesma', 'Asignacion', null, null, null, '9208045980', null, '0', null, null, null, null, null);
INSERT INTO `teachers` VALUES ('7', 'E12-0181', 'Alfredo', 'Macadangdang', 'Atalin, Jr.', null, null, null, '9109640895', null, '0', null, null, null, null, null);
INSERT INTO `teachers` VALUES ('8', 'E01-0011', 'Demetrio', 'Montoya', 'Banastas', null, null, null, null, null, '0', null, null, null, null, null);
INSERT INTO `teachers` VALUES ('9', 'E08-0136', 'Jennifer', 'Pedraza', 'Castillo', null, null, null, '9176727965', null, '0', null, null, null, null, null);
INSERT INTO `teachers` VALUES ('10', 'E01-0018', 'Gorgonia', 'Macalindol', 'David', null, null, null, '9058570190', null, '0', null, null, null, null, null);
INSERT INTO `teachers` VALUES ('11', 'E01-0098', 'Judith', 'Pestano', 'De Belen', null, null, null, '9178301848', null, '0', null, null, null, null, null);
INSERT INTO `teachers` VALUES ('12', 'E01-0020', 'Eufrecina', 'Lolong', 'Del Valle', null, null, null, '9168760544', null, '0', null, null, null, null, null);
INSERT INTO `teachers` VALUES ('13', 'E11-0158', 'Jay', null, 'Familaran', null, null, null, null, null, '0', null, null, null, null, null);
INSERT INTO `teachers` VALUES ('14', 'E13-0198', 'Reymark', 'De Castro', 'Fran', null, null, null, '9469623966', null, '0', null, null, null, null, null);
INSERT INTO `teachers` VALUES ('15', 'E01-0034', 'Lolita', 'Mangaring', 'Geronaga', null, null, null, null, null, '0', null, null, null, null, null);
INSERT INTO `teachers` VALUES ('16', 'E10-0155', 'Maureen', 'Diomampo', 'Helera', null, null, null, null, null, '0', null, null, null, null, null);
INSERT INTO `teachers` VALUES ('17', 'E01-0036', 'Mauro', 'Panaligan', 'Helera', null, null, null, null, null, '0', null, null, null, null, null);
INSERT INTO `teachers` VALUES ('18', 'E01-0040', 'Ammafe', null, 'Jarabe', null, null, null, null, null, '0', null, null, null, null, null);
INSERT INTO `teachers` VALUES ('19', 'E11-0161', 'Arturo', 'Magcamit', 'Julao', null, null, null, null, null, '0', null, null, null, null, null);
INSERT INTO `teachers` VALUES ('20', 'E01-0043', 'Cecilia', 'Limueco', 'Kasilag', null, null, null, null, null, '0', null, null, null, null, null);
INSERT INTO `teachers` VALUES ('21', 'E12-0188', 'Mary Grace', 'Macuha', 'Malbog', null, null, null, '9126501842', null, '0', null, null, null, null, null);
INSERT INTO `teachers` VALUES ('22', 'E12-0191', 'Ma. Cecilia', 'Candelario', 'Mendoza', null, null, null, '9212089408', null, '0', null, null, null, null, null);
INSERT INTO `teachers` VALUES ('23', 'E09-0149', 'Willy', 'Hebreo', 'Mendoza', null, null, null, '9985632091', null, '0', null, null, null, null, null);
INSERT INTO `teachers` VALUES ('24', 'E16-0254', 'Sheryl', 'Montiano', 'Montiano', null, null, null, '9178378205', null, '0', null, null, null, null, null);
INSERT INTO `teachers` VALUES ('25', 'E01-0075', 'Rosalia', 'Rabano', 'Nieva', null, null, null, '9269557658', null, '0', null, null, null, null, null);
INSERT INTO `teachers` VALUES ('26', 'E16-0253', 'Christine', 'Daganta', 'Silva', null, null, null, '9275825092', null, '0', null, null, null, null, null);
INSERT INTO `teachers` VALUES ('27', 'E13-0230', 'Marlon', 'Rubia', 'Villanueva', null, null, null, '9105859849', null, '0', null, null, null, null, null);
INSERT INTO `teachers` VALUES ('28', 'E01-0092', 'Josephine', null, 'Vito', null, null, null, null, null, '0', null, null, null, null, null);
INSERT INTO `teachers` VALUES ('29', 'E16-0261', 'Arnold', 'Acosta', 'Antonio', null, null, null, '9070865395', null, '0', null, null, null, null, null);
INSERT INTO `teachers` VALUES ('30', 'E16-0262', 'Richelle Ann', 'Fesalbon', 'Fababair', null, null, null, '9096515395', null, '0', null, null, null, null, null);
INSERT INTO `teachers` VALUES ('31', 'E15-0229', 'Precious Anne', 'Santos', 'Luarca', null, null, null, '9306436857', null, '0', null, null, null, null, null);
INSERT INTO `teachers` VALUES ('32', 'E15-0239', 'Mira Joy', 'Ramos', 'Narito', null, null, null, '9104811119', null, '0', null, null, null, null, null);
INSERT INTO `teachers` VALUES ('33', 'E16-0252', 'Ruperto III', 'Espinas', 'Oropesa', null, null, null, '9098021215', null, '0', null, null, null, null, null);
INSERT INTO `teachers` VALUES ('34', 'E16-0247', 'Janelle Leigh', 'Forfieda', 'Aguito', null, null, null, null, null, '0', null, null, null, null, null);
INSERT INTO `teachers` VALUES ('35', null, 'Paul', null, 'Ballocanag', null, null, null, '9994643278', null, '0', null, null, null, null, null);
INSERT INTO `teachers` VALUES ('36', 'E01-0012', 'Milagros', 'Maranan', 'Bautista', null, null, null, '9293993334', null, '0', null, null, null, null, null);
INSERT INTO `teachers` VALUES ('37', 'E15-0224', 'Maycel', 'Seno', 'Enriquez', null, null, null, '9072987845', null, '0', null, null, null, null, null);
INSERT INTO `teachers` VALUES ('38', 'E15-0225', 'Mae Marielle', 'Fabunan', 'Fababeir', null, null, null, '9096220532', null, '0', null, null, null, null, null);
INSERT INTO `teachers` VALUES ('39', 'E15-0226', 'Whalee', 'Famatian', 'Ferrera', null, null, null, '9461683636', null, '0', null, null, null, null, null);
INSERT INTO `teachers` VALUES ('40', 'E01-0035', 'Myrene', 'Carpena', 'Geronaga', null, null, null, '9198229912', null, '0', null, null, null, null, null);
INSERT INTO `teachers` VALUES ('41', 'E15-0227', 'Rodolfo Jr.', 'Miciano', 'Geronimo', null, null, null, '9214730566', null, '0', null, null, null, null, null);
INSERT INTO `teachers` VALUES ('42', 'E13-0197', 'John Ryan', 'Mercado', 'Guimera', null, null, null, '9124365707', null, '0', null, null, null, null, null);
INSERT INTO `teachers` VALUES ('43', 'E16-0242', 'Jim Frankle', 'Sades', 'Labrador', null, null, null, '9090464414', null, '0', null, null, null, null, null);
INSERT INTO `teachers` VALUES ('44', 'E14-0211', 'Rizza', 'Dela Pena', 'Lluvia', null, null, null, '9306904728', null, '0', null, null, null, null, null);
INSERT INTO `teachers` VALUES ('45', 'E16-0243', 'Reymond', 'Melaya', 'Mangubat', null, null, null, '9186586049', null, '0', null, null, null, null, null);
INSERT INTO `teachers` VALUES ('46', 'E12-0167', 'Maeril Joy', 'Jandusay', 'Mendez', null, null, null, null, null, '0', null, null, null, null, null);
INSERT INTO `teachers` VALUES ('47', 'E16-0250', 'Cherry', 'Ornedo', 'Minga', null, null, null, '9464084133', null, '0', null, null, null, null, null);
INSERT INTO `teachers` VALUES ('48', 'E16-0245', 'Jevert', 'Meneses', 'Muje', null, null, null, '9308959734', null, '0', null, null, null, null, null);
INSERT INTO `teachers` VALUES ('49', 'E01-0079', 'Edwina', 'Ferrera', 'Pamatian', null, null, null, '9498539930', null, '0', null, null, null, null, null);
INSERT INTO `teachers` VALUES ('50', 'E15-0228', 'Dextin', 'Comia', 'Sadicon', null, null, null, '9485381635', null, '0', null, null, null, null, null);
INSERT INTO `teachers` VALUES ('51', 'E01-0086', 'Marites', 'Alinsunurin', 'Saguid', null, null, null, '9215970739', null, '0', null, null, null, null, null);
INSERT INTO `teachers` VALUES ('52', 'E12-0175', 'Michelle', 'Laylay', 'Suarez', null, null, null, '9498336749', null, '0', null, null, null, null, null);
INSERT INTO `teachers` VALUES ('53', 'E14-0219', 'Rodelie', 'Abutar', 'Jatulan', null, null, null, '9469094772', null, '0', null, null, null, null, null);
INSERT INTO `teachers` VALUES ('54', 'E16-0248', 'Mary Grace', 'Luce', 'Logdat', null, null, null, '9272550529', null, '0', null, null, null, null, null);
INSERT INTO `teachers` VALUES ('55', 'E14-0207', 'Maylyn', 'Marmol', 'Maaba', null, null, null, '9073180538', null, '0', null, null, null, null, null);
INSERT INTO `teachers` VALUES ('56', 'E14-0206', 'Kristelle', 'Lingon', 'Manongsong', null, null, null, null, null, '0', null, null, null, null, null);
INSERT INTO `teachers` VALUES ('57', 'E16-0249', 'Mary Grace', 'Laurente', 'Mendoza ', null, null, null, '9951591759', null, '0', null, null, null, null, null);
INSERT INTO `teachers` VALUES ('58', 'E16-0244', 'Mark Jaynard', 'Asuncion', 'Mollo', null, null, null, '9484966867', null, '0', null, null, null, null, null);
INSERT INTO `teachers` VALUES ('59', 'E13-0200', 'Jennifer', 'Fajot', 'Montante', null, null, null, '9055932617', null, '0', null, null, null, null, null);
INSERT INTO `teachers` VALUES ('60', 'E14-0205', 'Sosmitha', 'Magcamit', 'Narzoles', null, null, null, '9468265838', null, '0', null, null, null, null, null);
INSERT INTO `teachers` VALUES ('61', 'E14-0233', 'Ederlyn', 'Lacdang', 'Real', null, null, null, '9129619773', null, '0', null, null, null, null, null);
INSERT INTO `teachers` VALUES ('62', 'E16-0246', 'Cezar', 'Lacerna', 'Sapungan', null, null, null, '9991894630', null, '0', null, null, null, null, null);
INSERT INTO `teachers` VALUES ('63', 'E16-0251', 'Mary Nyl Gae', 'Roderos', 'Vinzon', null, null, null, '9483575086', null, '0', null, null, null, null, null);
INSERT INTO `teachers` VALUES ('64', 'E13- 0232', 'Belarmino Jr.', 'Pingol', 'Alimurong', null, null, null, '9178530007', null, '0', null, null, null, null, null);
INSERT INTO `teachers` VALUES ('65', 'E01-0003', 'Adrian', 'De Joya', 'Ansaldo', null, null, null, null, null, '0', null, null, null, null, null);
INSERT INTO `teachers` VALUES ('66', null, 'Aileen', null, 'Ansaldo', null, null, null, null, null, '0', null, null, null, null, null);
INSERT INTO `teachers` VALUES ('67', 'E01-0005', 'Edwin', 'Duenas', 'Arpia', null, null, null, '9298538695', null, '0', null, null, null, null, null);
INSERT INTO `teachers` VALUES ('68', 'E01-0006', 'Remelyn', 'Mascarinas', 'Arpia', null, null, null, '9189205462', null, '0', null, null, null, null, null);
INSERT INTO `teachers` VALUES ('69', 'E15-0236', 'Jesus Jr.', 'Tribiana', 'Asprec', null, null, null, '9752972852', null, '0', null, null, null, null, null);
INSERT INTO `teachers` VALUES ('70', 'E08-0131', 'Maximo', 'Selda', 'Asuncion', null, null, null, '9303754058', null, '0', null, null, null, null, null);
INSERT INTO `teachers` VALUES ('71', 'E10-0150', 'Gil', 'Ansaldo', 'Bautista', null, null, null, '9079510843', null, '0', null, null, null, null, null);
INSERT INTO `teachers` VALUES ('72', 'E01-0013', 'Angela Mia', 'Ansaldo', 'Buenaventura', null, null, null, '9192239168', null, '0', null, null, null, null, null);
INSERT INTO `teachers` VALUES ('73', 'E14-0203', 'Jeffrey', 'Macalindol', 'David', null, null, null, null, null, '0', null, null, null, null, null);
INSERT INTO `teachers` VALUES ('74', 'E01-0021', 'Magdalena', 'Sarmiento', 'Delica', null, null, null, '9488166233', null, '0', null, null, null, null, null);
INSERT INTO `teachers` VALUES ('75', 'E16- 0255', 'Maria Eden', 'Mangcupanng', 'de la Cruz', null, null, null, '9306540217', null, '0', null, null, null, null, null);
INSERT INTO `teachers` VALUES ('76', 'E16- 0240', 'Daniel', 'Abarientos', 'Delos Martirez', null, null, null, '9282180454', null, '0', null, null, null, null, null);
INSERT INTO `teachers` VALUES ('77', 'E03-0107', 'Romeo', 'Mogol', 'Dimaano', null, null, null, '9214418285', null, '0', null, null, null, null, null);
INSERT INTO `teachers` VALUES ('78', 'E01-0031', 'Gemma', 'Dela Cruz', 'Fontecilla', null, null, null, '9072427125', null, '0', null, null, null, null, null);
INSERT INTO `teachers` VALUES ('79', 'E14-0204', 'Krissa', 'Lucenada', 'Gasang', null, null, null, '9469658289', null, '0', null, null, null, null, null);
INSERT INTO `teachers` VALUES ('80', 'E04-0115', 'Mark Morris', 'Landicho', 'Lim', null, null, null, '9204513230', null, '0', null, null, null, null, null);
INSERT INTO `teachers` VALUES ('81', 'E01-0055', 'Diomedes', 'Nieva', 'Magcamit', null, null, null, null, null, '0', null, null, null, null, null);
INSERT INTO `teachers` VALUES ('82', 'E01-0057', 'Teresita', null, 'Magcamit', null, null, null, null, null, '0', null, null, null, null, null);
INSERT INTO `teachers` VALUES ('83', 'E01-0061', 'Emelyn', 'Marasigan', 'Narra', null, null, null, '9183448538', null, '0', null, null, null, null, null);
INSERT INTO `teachers` VALUES ('84', 'E12-0183', 'Ruth', 'Eming', 'Ortega', null, null, null, '9214856931', null, '0', null, null, null, null, null);
INSERT INTO `teachers` VALUES ('85', 'E14- 0231', 'Mc Aldrin ', 'Olita', 'Raymundo', null, null, null, null, null, '0', null, null, null, null, null);
INSERT INTO `teachers` VALUES ('86', 'E01-0010', 'Nanette', 'Balmes', 'Tolentino', null, null, null, '9104393423', null, '0', null, null, null, null, null);
INSERT INTO `teachers` VALUES ('87', 'E13-0201', 'Maria Cecilia', 'David', 'Villegas', null, null, null, '9175364991', null, '0', null, null, null, null, null);
