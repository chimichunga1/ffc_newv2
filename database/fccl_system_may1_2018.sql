-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 01, 2018 at 02:39 PM
-- Server version: 5.7.20-0ubuntu0.16.04.1
-- PHP Version: 5.6.33-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fccl_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` bigint(20) NOT NULL,
  `acc_id` varchar(255) NOT NULL,
  `account_name` longtext,
  `type` int(11) DEFAULT NULL,
  `is_deleted` tinyint(4) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) VALUES
(1, '0', 'wew', 2, 0),
(2, '1001', 'Cash', 5, 0),
(3, '1002', 'Petty Cash', 5, 0),
(4, '1003', 'Accounts Recievable', 5, 0),
(5, '1004', 'Notes Receivable', 5, 0),
(6, '1005', 'Allowance for Bad Debts', 5, 0),
(7, '1006', 'Merchandise Inventory', 5, 0),
(8, '1007', 'Supplies Unused', 5, 0),
(9, '1008', 'Prepaid Insurance', 5, 0),
(10, '1009', 'Furnitures and Fixtures', 4, 0),
(11, '1010', 'Accu. Depreciation-F&F', 4, 0),
(12, '1011', 'Equipment', 4, 0),
(13, '1012', 'Accu. deprecaition-Equip.', 4, 0),
(14, '1013', 'Land', 4, 0),
(15, '1014', 'Building', 4, 0),
(16, '1015', 'Accu. Depreciation-Bldg', 4, 0),
(17, '123', 'One', 6, 0),
(18, '2001', 'Accounts Payable', 6, 0),
(19, '222222', 'CJAY TEST', 1, 0),
(20, '3001', 'Salaries Expenses', 3, 0),
(21, '3002', 'Utilities Expenses', 3, 0),
(22, '3003', 'Supplies Expense', 3, 0),
(23, '3004', 'Rent Expense', 3, 0),
(24, '3435', 'bully', 7, 0),
(25, '34578', 'game', 6, 0),
(26, '34fgg', 'sfdfds', 6, 0),
(27, '4001', 'Accounts Payable', 6, 0),
(28, '5001', 'Service', 2, 0),
(29, '5002', 'Sales', 5, 0),
(30, '6001', 'Mr. X Capital', 8, 0),
(31, '6002', 'MrM', 9, 0),
(32, '7900', 'Test', 11, 0),
(33, '9999', 'Test Income', 1, 0),
(34, 'ASD', 'ASD', 1, 0),
(38, 'CJAY', 'xcvfb', 7, 0),
(35, 'CJAY CONOCONO', 'CJAY CONOCONO wew', 2, 0),
(36, 'CJAY1996', 'CJAY', 2, 0),
(37, 'qwdqd44546', 'fghfhg', 3, 1),
(39, '`er', 'ert', 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `account_types`
--

CREATE TABLE `account_types` (
  `acc_types_id` bigint(20) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `inc_when_debit` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account_types`
--

INSERT INTO `account_types` (`acc_types_id`, `name`, `inc_when_debit`) VALUES
(1, 'Revenue(Main)', 0),
(2, 'Revenue(Side)', 0),
(3, 'Expenses', 1),
(4, 'Assets(Non-Current)', 1),
(5, 'Assets(Current)', 1),
(6, 'Liabilities(Current)', 0),
(7, 'Liabilities(Non-Current)', 0),
(8, 'Owner\'s Equity (Capital)', 0),
(9, 'Owner\'s Equity (Drawing)', 0),
(10, 'Contra (Current Assets)', 0),
(11, 'Non-Current Asset', 0);

-- --------------------------------------------------------

--
-- Table structure for table `additional_cash`
--

CREATE TABLE `additional_cash` (
  `id` bigint(20) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `year` varchar(255) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `additional_cash`
--

INSERT INTO `additional_cash` (`id`, `amount`, `year`, `is_deleted`) VALUES
(1, '111', '2017', 0);

-- --------------------------------------------------------

--
-- Table structure for table `approval_flow`
--

CREATE TABLE `approval_flow` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `approval_flow`
--

INSERT INTO `approval_flow` (`id`, `user_id`) VALUES
(324, 1),
(325, 3),
(326, 13);

-- --------------------------------------------------------

--
-- Table structure for table `available_balance`
--

CREATE TABLE `available_balance` (
  `id` bigint(20) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `year` varchar(255) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `available_balance`
--

INSERT INTO `available_balance` (`id`, `amount`, `year`, `is_deleted`) VALUES
(1, '700', '2017', 0),
(3, '354', '2018', 0),
(4, '1', '1', 0);

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE `bank` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `is_deleted` smallint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bank`
--

INSERT INTO `bank` (`id`, `name`, `is_deleted`) VALUES
(1, 'BDO', 0),
(2, 'BPI', 0),
(3, 'UnionBank', 0);

-- --------------------------------------------------------

--
-- Table structure for table `budget_per_week`
--

CREATE TABLE `budget_per_week` (
  `id` bigint(20) NOT NULL,
  `budget` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `budget_per_week`
--

INSERT INTO `budget_per_week` (`id`, `budget`) VALUES
(1, '1000003290');

-- --------------------------------------------------------

--
-- Table structure for table `business_type`
--

CREATE TABLE `business_type` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `business_type`
--

INSERT INTO `business_type` (`id`, `name`, `is_deleted`) VALUES
(1, 'Business Solutions Company', 0),
(2, 'test', 1);

-- --------------------------------------------------------

--
-- Table structure for table `caf_info`
--

CREATE TABLE `caf_info` (
  `id` bigint(20) NOT NULL,
  `client_no` bigint(20) NOT NULL,
  `application_no` bigint(20) NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `spouse` varchar(255) NOT NULL,
  `co_maker` varchar(255) NOT NULL,
  `contact_no` bigint(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `dealer` varchar(255) NOT NULL,
  `salesman` varchar(255) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `list_cash_price` bigint(20) NOT NULL,
  `appraised_value` bigint(20) NOT NULL,
  `downpayment` bigint(20) NOT NULL,
  `amount_financed` bigint(20) NOT NULL,
  `term` bigint(20) NOT NULL,
  `interest_rate` bigint(20) NOT NULL,
  `monthly_payment` bigint(20) NOT NULL,
  `second_payment` bigint(20) NOT NULL,
  `prepared_by` varchar(255) NOT NULL,
  `noted_by` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_deleted` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `caf_info`
--

INSERT INTO `caf_info` (`id`, `client_no`, `application_no`, `client_name`, `spouse`, `co_maker`, `contact_no`, `address`, `dealer`, `salesman`, `unit`, `list_cash_price`, `appraised_value`, `downpayment`, `amount_financed`, `term`, `interest_rate`, `monthly_payment`, `second_payment`, `prepared_by`, `noted_by`, `created_at`, `is_deleted`) VALUES
(14, 1, 17, 'Jay Esterado Tumanda', '12345', 'Carl Dennis Alingalan', 123, '123 Brgy. 2 3', 'Test T. Test', 'Test T. Test', '123', 123, 115, 123, 123, 123, 123, 123, 123, 'CJAY Dadivas CONOCONO', 'RAMON R. RAMOS', '2018-04-25 22:19:32', 0),
(15, 5, 16, 'Mhar Vic Chicano', 'uuuu', 'Dennis Matias', 98098, '4342 V. Baltazar St. Pinabuhatan Pasig City Brgy. pasig Pasig', 'Juan De Cruz', 'Juan Tuw Tre', '123', 123, 123, 123, 123, 123, 123, 123, 123, 'CJAY Dadivas CONOCONO', 'RAMON R. RAMOS', '2018-04-25 22:52:48', 0);

-- --------------------------------------------------------

--
-- Table structure for table `cash_request`
--

CREATE TABLE `cash_request` (
  `id` bigint(20) NOT NULL,
  `request_by` bigint(20) NOT NULL,
  `journal_entry_no` bigint(20) DEFAULT NULL,
  `journal_id` bigint(20) DEFAULT NULL,
  `date_of_entry` date DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `status_id` bigint(20) DEFAULT '1',
  `approver_id` bigint(20) DEFAULT '0',
  `total_amount` varchar(255) DEFAULT NULL,
  `journal_details_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cash_request`
--

INSERT INTO `cash_request` (`id`, `request_by`, `journal_entry_no`, `journal_id`, `date_of_entry`, `description`, `status_id`, `approver_id`, `total_amount`, `journal_details_id`) VALUES
(2, 1, 17111, 16, '2017-11-01', 'test', 2, 17, '123', '250'),
(3, 1, 17112, 16, '2017-11-23', 'test', 4, 3, '100000000', '252');

-- --------------------------------------------------------

--
-- Table structure for table `civil_status`
--

CREATE TABLE `civil_status` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `civil_status`
--

INSERT INTO `civil_status` (`id`, `name`, `is_deleted`) VALUES
(1, 'Single', 0),
(2, 'Married', 0),
(3, 'Widowed', 0),
(4, 'test', 1);

-- --------------------------------------------------------

--
-- Table structure for table `client_list`
--

CREATE TABLE `client_list` (
  `client_number` bigint(20) NOT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `mname` varchar(255) DEFAULT NULL,
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
  `is_blacklisted` tinyint(4) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `client_list`
--

INSERT INTO `client_list` (`client_number`, `lname`, `fname`, `mname`, `ind_corp_id`, `birthdate`, `gender`, `civil_status_id`, `spouse`, `tin_no`, `sss_no`, `acr_no`, `pagibig_no`, `rescert_no`, `rescert_date`, `rescert_place`, `bus_type_id`, `ind_code_id`, `client_type_id`, `country_id`, `region_id`, `con_name`, `con_rescert_no`, `con_rescert_date`, `con_rescert_place`, `home_no`, `home_brgy`, `home_city`, `home_zip`, `bus_no`, `bus_brgy`, `bus_city`, `bus_zip`, `gar_no`, `gar_brgy`, `gar_city`, `gar_zip`, `email`, `fax_no`, `bus_tel`, `home_tel`, `pri_con`, `sec_con`, `applied_by`, `applied_date`, `date_modified`, `same_add`, `same_add1`, `is_deleted`, `status_id`, `is_blacklisted`) VALUES
(1, 'Tumanda', 'Jay', 'Esterado', 1, '04/09/2018', 'Male', 1, '12345', '123', '13', '123', '123', '123', '04/05/2018', '213', 1, 1, 1, 1, 1, '1234', '123', '04/07/2018', '213', '123', '2', '3', '4', '123', '2', '3', '4', NULL, NULL, NULL, NULL, 'jay@gmail.com', '12123', '123', '12123', '123', '123', '1', '2018-04-05', '2018-04-17', 'checked', NULL, 0, 0, 0),
(2, 'Ribleza', 'Wilfred', 'Magdaong', 1, '04/09/2018', 'Male', 1, '12345', '123', '13', '123', '123', '123', '04/05/2018', '213', 1, 1, 1, 1, 1, '123', '123', '04/07/2018', '213', '123', '2', '3', '4', '123', '2', '3', '4', NULL, NULL, NULL, NULL, 'jay@gmail.com', '12123', '123', '12123', '123', '123', '1', '2018-04-07', '2018-04-11', 'checked', NULL, 0, 0, 0),
(3, 'test', 'test', 'test', 1, '04/13/2018', 'Male', 1, 'test', '123', '123', '123', '123', '123', '04/13/2018', 'test', 1, 1, 1, 1, 1, 'test', '123', '04/13/2018', 'test', 'test', 'tet', 'test', 'test', 'test', 'tet', 'test', 'test', NULL, NULL, NULL, NULL, 'test@gmail.com', 'test', 'test', 'test', 'test', 'test', '1', '2018-04-13', NULL, 'checked', NULL, 1, 0, 0),
(4, 'test2', 'test2', 'test2', 1, '04/13/2018', 'Male', 1, 'test', '123', '123', '123', '123', '123', '04/13/2018', 'test', 1, 1, 1, 1, 1, 'tes', '123', '04/13/2018', 'test', 'test', 'test', 'test', 'test', 'test', 'test', 'test', 'test', NULL, NULL, NULL, NULL, 'test@gmail.com', 'test', 'test', 'test', 'test', 'test', '1', '2018-04-13', '2018-04-13', 'checked', NULL, 1, 0, 0),
(5, 'Chicano', 'Mhar', 'Vic', 1, '04/02/2018', 'Male', 1, 'uuuu', '898098', '8098098', '8098', '098098', '98908098', '04/02/2018', 'ii8098098', 1, 1, 1, 1, 1, 'Mhar Vic Chicano', '8980980', '03/05/2018', '80989', '4342 V. Baltazar St. Pinabuhatan Pasig City', 'pasig', 'Pasig', '1602', '4342 V. Baltazar St. Pinabuhatan Pasig City', 'pasig', 'Pasig', '1602', NULL, NULL, NULL, NULL, 'test@gmail.com', '980-90-9', '8989908', '89098', '98098', '09809', '1', '2018-04-13', NULL, 'checked', NULL, 0, 0, 0),
(6, 'Drilon', 'Bugoy', 'Test', 1, '04/27/2018', 'Male', 1, '', '1231515213', '123124415', '123124421412', '123124214', '123124114123', '12/31/2008', '123141241', 1, 1, 1, 1, 1, 'Bugoy Drilon', '1231442', '04/16/2018', 'Buboy', 'dito doon', '905', 'Manila', '1009', 'dito doon', '905', 'Manila', '1009', NULL, NULL, NULL, NULL, 'bugoy@gmail.com', '12347', '123615467', '312635817546125', '1265417541625', '136851283532', '1', '2018-04-15', NULL, 'checked', NULL, 0, 0, 0),
(7, 'CONOCONO', 'CJAY', 'TEST', 1, '04/15/2018', 'Male', 1, 'TEST', '123', '123', '123', '12312', '123', '04/15/2018', 'TEST', 1, 1, 1, 1, 1, 'TEST', '123', '04/15/2018', 'TES', '123', 'TEST', 'TEST', '123', '123', 'TEST', 'TEST', '123', NULL, NULL, NULL, NULL, 'test11@gmail.com', '123', '123', '123', '123', '123', '1', '2018-04-15', NULL, 'checked', NULL, 0, 0, 0),
(8, 'tests', 'test', 'test', 1, '04/16/2018', 'Male', 1, '', '123', '123', '123', '123', '123', '04/16/2018', 'test', 1, 1, 1, 1, 1, 'test', '123', '04/16/2018', 'test', 'test', 'test', 'test', 'test', 'test', 'test', 'test', 'test', NULL, NULL, NULL, NULL, 'test@gmail.com', 'test', 'test', 'test', 'test', 'test', '1', '2018-04-16', '2018-04-18', 'checked', NULL, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `client_requirements_caf`
--

CREATE TABLE `client_requirements_caf` (
  `id` bigint(20) NOT NULL,
  `requirement_name` varchar(255) NOT NULL,
  `requirement_code` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `client_no` bigint(20) NOT NULL,
  `application_no` bigint(20) NOT NULL,
  `is_deleted` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `client_requirements_caf`
--

INSERT INTO `client_requirements_caf` (`id`, `requirement_name`, `requirement_code`, `status`, `client_no`, `application_no`, `is_deleted`) VALUES
(3, '2 Valid ID', '2val', 'pending', 6, 15, 0),
(4, 'Baranggay Clearance', 'BRCL', 'pending', 6, 15, 0),
(5, 'Baranggay Clearance', 'BRCL', 'received', 5, 16, 0),
(6, '2x2 Picture ID', '2x2', 'received', 1, 17, 0),
(7, '2 Valid ID', '2val', 'pending', 1, 17, 0),
(8, 'Baranggay Clearance', 'BRCL', 'received', 1, 17, 0),
(9, '2x2 Picture ID', '2x2', 'pending', 1, 5, 0),
(10, '2 Valid ID', '2val', 'pending', 1, 5, 0),
(11, 'Baranggay Clearance', 'BRCL', 'pending', 1, 5, 0),
(12, '2x2 Picture ID', '2x2', 'pending', 213, 4, 0),
(13, '2 Valid ID', '2val', 'pending', 213, 4, 0),
(14, 'Baranggay Clearance', 'BRCL', 'pending', 213, 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `client_requirements_cf`
--

CREATE TABLE `client_requirements_cf` (
  `id` bigint(20) NOT NULL,
  `requirement_name` varchar(255) NOT NULL,
  `requirement_code` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `client_no` bigint(20) NOT NULL,
  `application_no` bigint(20) NOT NULL,
  `is_deleted` bigint(200) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `client_requirements_cf`
--

INSERT INTO `client_requirements_cf` (`id`, `requirement_name`, `requirement_code`, `status`, `client_no`, `application_no`, `is_deleted`) VALUES
(1, '2x2 Picture ID', '2x2', 'pending', 1, 17, 0),
(2, '2 Valid ID', '2val', 'received', 1, 17, 0),
(3, 'Baranggay Clearance', 'BRCL', 'received', 1, 17, 0),
(4, 'Tax Income', 'BIR', 'received', 1, 17, 0),
(5, '2x2 Picture ID', '2x2', 'pending', 1, 5, 0),
(6, '2 Valid ID', '2val', 'pending', 1, 5, 0),
(7, 'Baranggay Clearance', 'BRCL', 'pending', 1, 5, 0),
(8, 'Tax Income', 'BIR', 'pending', 1, 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `client_type`
--

CREATE TABLE `client_type` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `client_type`
--

INSERT INTO `client_type` (`id`, `name`, `is_deleted`) VALUES
(1, 'ESP', 0),
(2, 'testt', 1);

-- --------------------------------------------------------

--
-- Table structure for table `collateral_code`
--

CREATE TABLE `collateral_code` (
  `id` bigint(20) NOT NULL,
  `code` varchar(255) NOT NULL,
  `desc` varchar(255) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `collateral_code`
--

INSERT INTO `collateral_code` (`id`, `code`, `desc`, `is_deleted`) VALUES
(1, 'CC1', 'Collateral Code 1', 0),
(2, 'CC2', 'Collateral Code 2', 0);

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `name`, `is_deleted`) VALUES
(1, 'Philippines', 0),
(2, 'ts', 1);

-- --------------------------------------------------------

--
-- Table structure for table `credit_check`
--

CREATE TABLE `credit_check` (
  `id` bigint(20) NOT NULL,
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
  `is_deleted` tinyint(4) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `credit_check`
--

INSERT INTO `credit_check` (`id`, `loan_id`, `client_no`, `informant`, `tel_no`, `loan_type_id`, `unit`, `amt_fin`, `pn_amount`, `terms`, `mon_amor`, `date_granted`, `balance`, `security`, `experience`, `checked_by`, `is_deleted`) VALUES
(1, 2, 1, 'Cjay', '999', 4, '999', '99', '99', '99', '9', '04/15/2018', '9', 'Test', 'Test Exp', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `credit_facility`
--

CREATE TABLE `credit_facility` (
  `id` bigint(20) NOT NULL,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `credit_facility`
--

INSERT INTO `credit_facility` (`id`, `code`, `name`, `is_deleted`) VALUES
(1, 'CF1', 'CF1', 0),
(2, 'CF2', 'CF2', 0);

-- --------------------------------------------------------

--
-- Table structure for table `cred_app_bwu`
--

CREATE TABLE `cred_app_bwu` (
  `id` bigint(20) NOT NULL,
  `loan_id` bigint(20) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  `statement` varchar(255) DEFAULT NULL,
  `gross_inc` varchar(255) DEFAULT NULL,
  `net_inc` varchar(255) DEFAULT NULL,
  `strength` varchar(255) DEFAULT NULL,
  `weak` varchar(255) DEFAULT NULL,
  `reco` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cred_app_bwu`
--

INSERT INTO `cred_app_bwu` (`id`, `loan_id`, `note`, `statement`, `gross_inc`, `net_inc`, `strength`, `weak`, `reco`) VALUES
(1, 16, 'With other several SPD account', 'Benmar Cargo Movers, Inc.\r\nAs other sources of income borrower  has other trucking company using the name of Ultimate Express Logistics, Inc.', '2100', '1790', 'Existing Account with FFC\r\nEstablished business', 'CMAP listed', 'Approval Direct Loan of (1) unit IH Tractor Head');

-- --------------------------------------------------------

--
-- Table structure for table `cred_app_less`
--

CREATE TABLE `cred_app_less` (
  `id` bigint(20) NOT NULL,
  `loan_id` bigint(20) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `percent` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `is_deleted` tinyint(4) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cred_app_less`
--

INSERT INTO `cred_app_less` (`id`, `loan_id`, `name`, `amount`, `percent`, `description`, `is_deleted`) VALUES
(1, 16, 'Operating Expense', '100', '', '', 0),
(23, 16, 'test', '', '10', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `cred_app_relations`
--

CREATE TABLE `cred_app_relations` (
  `id` bigint(255) NOT NULL,
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
  `is_deleted` tinyint(4) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cred_app_relations`
--

INSERT INTO `cred_app_relations` (`id`, `loan_id`, `acct_no`, `facility`, `unit`, `plate_no`, `af`, `tlv`, `granted`, `terms`, `ma`, `balance`, `rule78`, `exp`, `applied_by`, `date_applied`, `is_deleted`) VALUES
(2, 16, 'RDLA2201607093', 'Direct Loan', 'IH TH', 'RML 793', '1000000', '1317200', '04/29/2010', '24', '54883', '219532', '214027', 'Satisfactory', 1, '2010-04-29', 0),
(5, 16, 'RDLA2201607093', 'Direct Loan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `cred_app_vehicles`
--

CREATE TABLE `cred_app_vehicles` (
  `id` bigint(20) NOT NULL,
  `loan_id` bigint(20) DEFAULT NULL,
  `unit` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `is_deleted` tinyint(4) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cred_app_vehicles`
--

INSERT INTO `cred_app_vehicles` (`id`, `loan_id`, `unit`, `name`, `description`, `is_deleted`) VALUES
(1, 16, '26', 'Assorted TH', 'Maybank UPC, FFC, Asian Cathay, Cash', 0),
(2, 16, '10', 'Civic', 'Test', 0);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` bigint(20) NOT NULL,
  `department_name` varchar(255) NOT NULL,
  `allowance` varchar(255) DEFAULT NULL,
  `department_head_id` bigint(20) DEFAULT NULL,
  `is_deleted` smallint(2) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `department_name`, `allowance`, `department_head_id`, `is_deleted`) VALUES
(1, 'BA', '5000', 5, 0),
(2, 'PRODCOM', '4000', 4, 0),
(3, 'SALES', '111', 16, 0),
(4, 'test3', '12', 4, 1),
(5, 'test', '1', 17, 1),
(6, 'test4', '1223', 4, 1),
(7, 'HR', '3000', 3, 0),
(8, '16262526ss', '213123', 2, 1),
(9, '1', '213123', 3, 1),
(10, '1233', '1223', 4, 1),
(11, 'we45', '1223', 2, 1),
(12, 'sadsd', '1223', 5, 1),
(13, 'jeje', '.12', 6, 1),
(14, 'test1234', '.9', 6, 1),
(15, 'wwq', '2313', 2, 1),
(16, 'yu', '678', 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `finance_approver`
--

CREATE TABLE `finance_approver` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `finance_approver`
--

INSERT INTO `finance_approver` (`id`, `user_id`) VALUES
(1, 17);

-- --------------------------------------------------------

--
-- Table structure for table `gender`
--

CREATE TABLE `gender` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gender`
--

INSERT INTO `gender` (`id`, `name`, `is_deleted`) VALUES
(1, 'Male', 0),
(2, 'Female', 0);

-- --------------------------------------------------------

--
-- Table structure for table `industry_code`
--

CREATE TABLE `industry_code` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `industry_code`
--

INSERT INTO `industry_code` (`id`, `name`, `is_deleted`) VALUES
(1, 'BS', 0),
(2, 'tyest', 1);

-- --------------------------------------------------------

--
-- Table structure for table `industry_corp`
--

CREATE TABLE `industry_corp` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `industry_corp`
--

INSERT INTO `industry_corp` (`id`, `name`, `is_deleted`) VALUES
(1, 'Spark Global Tech Systems, Inc.', 0),
(2, 'FCC', 1);

-- --------------------------------------------------------

--
-- Table structure for table `journals`
--

CREATE TABLE `journals` (
  `journal_id` bigint(20) NOT NULL,
  `journal_date` date DEFAULT NULL,
  `description` longtext,
  `ledger_id` bigint(20) DEFAULT NULL,
  `is_archived` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `journals`
--

INSERT INTO `journals` (`journal_id`, `journal_date`, `description`, `ledger_id`, `is_archived`) VALUES
(15, '1930-02-03', 'TEST JOURNAL 123', 0, 0),
(16, '1901-02-03', 'test\r\nwest', 0, 0),
(17, '2017-12-01', 'test234', 0, 0),
(18, '2017-12-02', 'test567\r\n', 0, 0),
(19, '2017-12-07', 'tesrtsjd', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `journal_details`
--

CREATE TABLE `journal_details` (
  `id` bigint(20) NOT NULL,
  `account_id` bigint(20) DEFAULT NULL,
  `journal_entry_no` bigint(20) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `is_debit` tinyint(4) DEFAULT NULL,
  `bank_name` varchar(255) DEFAULT NULL,
  `chq_number` varchar(255) DEFAULT NULL,
  `desc` varchar(255) DEFAULT NULL,
  `request_by` smallint(1) DEFAULT NULL,
  `date_of_entry` date DEFAULT NULL,
  `status_id` smallint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `journal_details`
--

INSERT INTO `journal_details` (`id`, `account_id`, `journal_entry_no`, `amount`, `is_debit`, `bank_name`, `chq_number`, `desc`, `request_by`, `date_of_entry`, `status_id`) VALUES
(247, 1001, 17111, 14111, 1, '', '', 'test', 17, '2017-11-23', 1),
(248, 1002, 17111, 14111, 0, '', '', 'TESt', 17, '2017-11-23', 2),
(249, 1005, 17111, 123, 1, '', '', 'test', 1, '2017-11-01', 1),
(250, 1002, 17111, 123, 0, '', '', 'rty', 1, '2017-11-01', 2),
(251, 1001, 17112, 100000000, 1, '', '', 'test', 1, '2017-11-23', 1),
(252, 1001, 17112, 100000000, 0, '', '', 'test', 1, '2017-11-23', 1);

-- --------------------------------------------------------

--
-- Table structure for table `journal_entries`
--

CREATE TABLE `journal_entries` (
  `id` bigint(20) NOT NULL,
  `journal_entry_no` bigint(20) NOT NULL,
  `journal_id` int(11) NOT NULL,
  `date_of_entry` date NOT NULL,
  `description` varchar(100) NOT NULL,
  `request_by` smallint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `journal_entries`
--

INSERT INTO `journal_entries` (`id`, `journal_entry_no`, `journal_id`, `date_of_entry`, `description`, `request_by`) VALUES
(50, 17111, 15, '2017-11-30', 'TEst', NULL),
(51, 17111, 16, '2017-11-01', 'test', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ledgers`
--

CREATE TABLE `ledgers` (
  `ledger_id` bigint(20) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `is_archive` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `loan_approval_type`
--

CREATE TABLE `loan_approval_type` (
  `id` bigint(20) NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `is_deleted` smallint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loan_approval_type`
--

INSERT INTO `loan_approval_type` (`id`, `code`, `name`, `is_deleted`) VALUES
(1, 'AO', 'Add - On', 0),
(2, 'IALS', 'In-Arrears Lump Sum', 0),
(3, 'IAA', 'In-Arrears Annuity', 0),
(4, 'TD', 'True Discount', 0);

-- --------------------------------------------------------

--
-- Table structure for table `loan_list`
--

CREATE TABLE `loan_list` (
  `id` bigint(20) NOT NULL,
  `app_type` varchar(255) DEFAULT NULL,
  `app_no` varchar(255) DEFAULT NULL,
  `client_no` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `spouse` varchar(255) DEFAULT NULL,
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
  `applied_by` bigint(20) DEFAULT NULL,
  `date_applied` date DEFAULT NULL,
  `date_modified` date DEFAULT NULL,
  `is_deleted` tinyint(4) DEFAULT '0',
  `loan_status_id` bigint(20) DEFAULT '1',
  `is_approve` smallint(1) DEFAULT '0',
  `current_approver_id` bigint(20) DEFAULT NULL,
  `approve_type` smallint(1) DEFAULT '0',
  `voucher_type` smallint(1) DEFAULT NULL COMMENT '1-Check 2-Journal'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loan_list`
--

INSERT INTO `loan_list` (`id`, `app_type`, `app_no`, `client_no`, `last_name`, `first_name`, `spouse`, `loan_type_id`, `credit_fac_id`, `prod_line_id`, `mark_type_id`, `coll_code_id`, `bus_add`, `home_add`, `email_add`, `bus_tel`, `home_tel`, `pri_con`, `sec_con`, `applied_by`, `date_applied`, `date_modified`, `is_deleted`, `loan_status_id`, `is_approve`, `current_approver_id`, `approve_type`, `voucher_type`) VALUES
(1, 'new', '1', '1', 'Tumanda', 'Jay', '', 1, 1, 1, 1, 1, 'Makati', 'Taguig     ', 'jay@gmail.com', '123', '123', '123', '123', 1, '2018-03-19', '2018-04-13', 0, 2, 2, 1, 0, NULL),
(4, '', '12321', '213', 'wew', 'wew', 'wew', 1, 2, 1, 1, 1, 'wew', 'wwew', 'wew@gmail.com', 'wwew', 'qweqw', 'wqewq', 'wqe', 1, '2018-03-31', '2018-04-30', 0, 4, 0, 3, 1, NULL),
(5, 'new', '', '1', 'Tumanda', 'Jay', '12345', 1, 2, 1, 1, 1, '', '', 'jay@gmail.com', '123', '12123', '123', '123', 1, '2018-04-15', '2018-04-30', 0, 5, 0, 1, 0, NULL),
(6, '', '4182018-5', '5', 'Chicano', 'Mhar', 'uuuu', 2, 1, 1, 2, 1, 'w', 'w', 'test@gmail.com', '8989908', '89098', '98098', '09809', 1, '2018-04-15', '2018-04-19', 0, 11, 0, 3, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `loan_status`
--

CREATE TABLE `loan_status` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `is_deleted` smallint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loan_status`
--

INSERT INTO `loan_status` (`id`, `name`, `is_deleted`) VALUES
(1, 'On-Going', 0),
(2, 'Marketing - Loan Entry', 0),
(3, 'Marketing - CI', 0),
(4, 'Credit - Trade Checking', 0),
(5, 'Credit - Credit Checking', 0),
(6, 'Approval Committee', 0),
(7, 'Marketing - Checklist', 0),
(8, 'Marketing - Collateral', 0),
(9, 'Marketing - Instruction Sheet', 0),
(10, 'Loan - Approval', 0),
(11, 'Loan - Distribution', 0),
(12, 'Approved', 0),
(13, 'Rejected', 0);

-- --------------------------------------------------------

--
-- Table structure for table `loan_types`
--

CREATE TABLE `loan_types` (
  `id` bigint(20) NOT NULL,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loan_types`
--

INSERT INTO `loan_types` (`id`, `code`, `name`, `is_deleted`) VALUES
(1, 'L1', 'Salary Loan', 0),
(2, 'L2', 'Student Loan', 0);

-- --------------------------------------------------------

--
-- Table structure for table `marketing_type`
--

CREATE TABLE `marketing_type` (
  `id` bigint(20) NOT NULL,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `marketing_type`
--

INSERT INTO `marketing_type` (`id`, `code`, `name`, `is_deleted`) VALUES
(1, 'MT1', 'Marketing Type 1', 0),
(2, 'MT2', 'Marketing Type 2', 0);

-- --------------------------------------------------------

--
-- Table structure for table `official_receipt`
--

CREATE TABLE `official_receipt` (
  `id` bigint(20) NOT NULL,
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
  `date` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `official_receipt`
--

INSERT INTO `official_receipt` (`id`, `client_id`, `payment_type_id`, `bank_id`, `check_no`, `details`, `deposit_date`, `cash`, `cheque`, `total`, `is_deleted`, `date`) VALUES
(23, 4, 1, 1, 'test', 'test', '04/07/2018', '22', '22', '44', 0, '2018-04-05'),
(24, 4, 2, 2, '1234', 'test details', '04/05/2018', '4300', '7000', '11300 PHP', 0, '2018-04-05'),
(25, 4, 2, 2, '1234', 'test details 2', '04/05/2018', '4300', '3000', '7300 PHP', 0, '2018-04-05'),
(26, 4, 1, 3, '69', 'YAJ TUMANDA', '04/05/2018', '6969', '6969', '13938 PHP', 0, '2018-04-05'),
(27, 1, 1, 2, '3423421', 'payment of this day', '04/09/2018', '2000', '', '2000 PHP', 0, '2018-04-09'),
(28, 1, 1, 1, '23', '233', '04/16/2018', '22', '22', '44 PHP', 0, '2018-04-16');

-- --------------------------------------------------------

--
-- Table structure for table `payment_type`
--

CREATE TABLE `payment_type` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `is_deleted` smallint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_type`
--

INSERT INTO `payment_type` (`id`, `name`, `is_deleted`) VALUES
(1, 'Loan Receivables', 0),
(2, 'Others', 0);

-- --------------------------------------------------------

--
-- Table structure for table `preparation`
--

CREATE TABLE `preparation` (
  `id` bigint(20) NOT NULL,
  `client_id` bigint(20) DEFAULT NULL,
  `debit` varchar(255) DEFAULT NULL,
  `credit` varchar(255) DEFAULT NULL,
  `is_deleted` smallint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_line`
--

CREATE TABLE `product_line` (
  `id` bigint(20) NOT NULL,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_line`
--

INSERT INTO `product_line` (`id`, `code`, `name`, `is_deleted`) VALUES
(1, 'PL1', 'Product Line 1', 0),
(2, 'PL2', 'Product Line 2', 0);

-- --------------------------------------------------------

--
-- Table structure for table `query_message`
--

CREATE TABLE `query_message` (
  `id` bigint(20) NOT NULL,
  `sender_id` bigint(20) NOT NULL,
  `receiver_id` bigint(20) DEFAULT NULL,
  `date_sent` datetime DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `query_id` bigint(20) DEFAULT NULL,
  `read` smallint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `query_message`
--

INSERT INTO `query_message` (`id`, `sender_id`, `receiver_id`, `date_sent`, `subject`, `message`, `query_id`, `read`) VALUES
(32, 1, 17, '2017-11-20 17:48:49', NULL, 'wew', 171, 1),
(33, 5, 17, '2017-11-20 17:49:05', NULL, 'huyyyyyy', 175, 1),
(34, 17, 1, '2017-11-20 17:49:17', NULL, 'po', 171, 1),
(35, 5, 17, '2017-11-20 22:33:51', NULL, 'wew', 175, 1),
(36, 17, 5, '2017-11-20 22:34:01', NULL, 'oh?\r\n', 175, 0),
(37, 1, 17, '2017-11-22 10:05:53', NULL, 'Hahahha\r\n', 171, 1),
(38, 1, 17, '2017-11-22 10:05:53', NULL, 'Hahahha', 171, 1),
(39, 1, 17, '2017-11-23 10:45:41', NULL, 'huy', 171, 1),
(40, 1, 17, '2017-11-23 10:45:47', NULL, 'huy\r\n', 171, 1);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `question_id` bigint(20) NOT NULL,
  `question` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`question_id`, `question`) VALUES
(1, 'What\'s your favorite brand of pencil?'),
(2, 'What is your favorite flavor?'),
(3, 'Who\'s your favorite teacher?');

-- --------------------------------------------------------

--
-- Table structure for table `quotes`
--

CREATE TABLE `quotes` (
  `id` bigint(20) NOT NULL,
  `quote` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quotes`
--

INSERT INTO `quotes` (`id`, `quote`) VALUES
(1, 'The difference between stupidity and genius is that genius has its limits. - Albert Einstein'),
(2, 'Insanity: doing the same thing over and over again and expecting different results. - Albert Einstein'),
(3, 'The only way to keep your health is to eat what you don\'t want, drink what you don\'t like, and do what you\'d rather not. - Mark Twain '),
(4, 'When you are courting a nice girl an hour seems like a second. When you sit on a red-hot cinder a second seems like an hour. That\'s relativity. - Albert Einstein');

-- --------------------------------------------------------

--
-- Table structure for table `region`
--

CREATE TABLE `region` (
  `id` bigint(20) NOT NULL,
  `country_id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `region`
--

INSERT INTO `region` (`id`, `country_id`, `name`, `is_deleted`) VALUES
(1, 1, 'NCR', 0),
(2, 1, 'test', 1),
(3, 1, 'test', 1);

-- --------------------------------------------------------

--
-- Table structure for table `request_status`
--

CREATE TABLE `request_status` (
  `id` bigint(20) NOT NULL,
  `request_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `request_status`
--

INSERT INTO `request_status` (`id`, `request_name`) VALUES
(1, 'Pending'),
(2, 'Approved'),
(3, 'Rejected'),
(4, 'Cancelled');

-- --------------------------------------------------------

--
-- Table structure for table `requirements`
--

CREATE TABLE `requirements` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `requirement_code` varchar(255) NOT NULL,
  `loan_type_id` varchar(255) NOT NULL,
  `caf` varchar(255) NOT NULL,
  `cf` varchar(255) NOT NULL,
  `is_deleted` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `requirements`
--

INSERT INTO `requirements` (`id`, `name`, `requirement_code`, `loan_type_id`, `caf`, `cf`, `is_deleted`) VALUES
(1, '2x2 Picture ID', '2x2', '', '8,1,', '1,', 0),
(2, '2 Valid ID', '2val', '', '2,8,1,', '1,', 0),
(3, 'Baranggay Clearance', 'BRCL', '', '3,2,5,1,', '1,', 0),
(4, 'Tax Income', 'BIR', '', '', '1,', 0);

-- --------------------------------------------------------

--
-- Table structure for table `security_question`
--

CREATE TABLE `security_question` (
  `id` bigint(20) NOT NULL,
  `security_question` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `trade_check`
--

CREATE TABLE `trade_check` (
  `id` bigint(20) NOT NULL,
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
  `is_deleted` tinyint(4) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trade_check`
--

INSERT INTO `trade_check` (`id`, `loan_id`, `client_no`, `informant`, `tel_no`, `dealings`, `since`, `ave_bill`, `terms`, `experience`, `date_checked`, `checked_by`, `is_deleted`) VALUES
(1, 2, 1, 'Wilfred', '54', 'deals', '2018', '18000', 'termsss', 'exp', '04/14/2018', 1, 1),
(2, 2, 1, 'Wilfred', '1234', 'deas', '2018', '18000', 'termsss', 'eaxsf', '04/15/2018', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` bigint(20) NOT NULL,
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
  `image` varchar(255) DEFAULT 'default.gif'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `middle_initial`, `last_name`, `password`, `user_type_id`, `is_active`, `is_login`, `department_id`, `question_id`, `answer`, `is_deleted`, `last_activity`, `username`, `image`) VALUES
(1, 'CJAY', 'D.', 'CONOCONO', 'TNTz0EXkSq4dC+kr8w8+UF14gOTFdx6RSEJpaGwQ7v4=', '1', 1, 1, 0, 1, 'LovAATjZX7extDhG7zbThmUxMuKZ4nvVLM/ucUpvnRE=', 0, '2018-05-01 14:39:19', 'admin', '1041518045921.png'),
(2, 'Mhar Vic', 'Mapagmahal', 'Chicano', 'TNTz0EXkSq4dC+kr8w8+UF14gOTFdx6RSEJpaGwQ7v4=', '1', 1, 0, 1, 1, 'LovAATjZX7extDhG7zbThmUxMuKZ4nvVLM/ucUpvnRE=', 0, '2018-04-15 21:56:14', 'mharvic', 'giphy.gif'),
(4, 'Jay', '', 'Tumanda', 'TNTz0EXkSq4dC+kr8w8+UF14gOTFdx6RSEJpaGwQ7v4=', '1', 1, 1, 1, 1, 'JEwlbswck19d2LIJWhfaT/Kk6DZySfs4tcF5HD9ynnM=', 0, '2018-04-16 08:37:41', 'jaytumanda', 'default.gif'),
(5, 'Wilfred', '', 'Ribleza', 'RiNRg2U/vFz+uMySogP8cHORVGXXIr5xcnXHJI9jYuY=', '1', 1, 0, 1, NULL, NULL, 0, '2018-04-16 08:05:53', 'wilfred', 'default.gif'),
(6, 'Admin', '', 'Admin', 'RiNRg2U/vFz+uMySogP8cHORVGXXIr5xcnXHJI9jYuY=', '1', 1, 0, 1, NULL, NULL, 0, NULL, 'ffc', 'default.gif');

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `is_deleted` smallint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`id`, `name`, `is_deleted`) VALUES
(1, 'Administrator', 0),
(2, 'Accounting', 0),
(3, 'Executive', 0),
(4, 'Department Head', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_types`
--

CREATE TABLE `user_types` (
  `user_type_id` bigint(20) NOT NULL,
  `user_type` varchar(255) DEFAULT NULL,
  `is_deleted` smallint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_types`
--

INSERT INTO `user_types` (`user_type_id`, `user_type`, `is_deleted`) VALUES
(1, 'Administrator', 0),
(2, 'Accounting', 0),
(3, 'Marketing', 0),
(4, 'CI', 0);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_chartacc`
--
CREATE TABLE `vw_chartacc` (
`id` bigint(20)
,`acc_id` varchar(255)
,`account_name` longtext
,`name` varchar(50)
,`is_deleted` tinyint(4)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_journals`
--
CREATE TABLE `vw_journals` (
`journal_id` bigint(20)
,`journal_date` date
,`description` longtext
,`is_archived` int(2)
);

-- --------------------------------------------------------

--
-- Structure for view `vw_chartacc`
--
DROP TABLE IF EXISTS `vw_chartacc`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_chartacc`  AS  select `accounts`.`id` AS `id`,`accounts`.`acc_id` AS `acc_id`,`accounts`.`account_name` AS `account_name`,`account_types`.`name` AS `name`,`accounts`.`is_deleted` AS `is_deleted` from (`accounts` join `account_types` on((`accounts`.`type` = `account_types`.`acc_types_id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `vw_journals`
--
DROP TABLE IF EXISTS `vw_journals`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_journals`  AS  select `journals`.`journal_id` AS `journal_id`,`journals`.`journal_date` AS `journal_date`,`journals`.`description` AS `description`,`journals`.`is_archived` AS `is_archived` from `journals` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`acc_id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `account_types`
--
ALTER TABLE `account_types`
  ADD PRIMARY KEY (`acc_types_id`);

--
-- Indexes for table `additional_cash`
--
ALTER TABLE `additional_cash`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `approval_flow`
--
ALTER TABLE `approval_flow`
  ADD KEY `id` (`id`);

--
-- Indexes for table `available_balance`
--
ALTER TABLE `available_balance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank`
--
ALTER TABLE `bank`
  ADD KEY `id` (`id`);

--
-- Indexes for table `budget_per_week`
--
ALTER TABLE `budget_per_week`
  ADD KEY `id` (`id`);

--
-- Indexes for table `business_type`
--
ALTER TABLE `business_type`
  ADD KEY `id` (`id`);

--
-- Indexes for table `caf_info`
--
ALTER TABLE `caf_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cash_request`
--
ALTER TABLE `cash_request`
  ADD KEY `id` (`id`);

--
-- Indexes for table `civil_status`
--
ALTER TABLE `civil_status`
  ADD KEY `id` (`id`);

--
-- Indexes for table `client_list`
--
ALTER TABLE `client_list`
  ADD PRIMARY KEY (`client_number`);

--
-- Indexes for table `client_requirements_caf`
--
ALTER TABLE `client_requirements_caf`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client_requirements_cf`
--
ALTER TABLE `client_requirements_cf`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client_type`
--
ALTER TABLE `client_type`
  ADD KEY `id` (`id`);

--
-- Indexes for table `collateral_code`
--
ALTER TABLE `collateral_code`
  ADD KEY `id` (`id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD KEY `id` (`id`);

--
-- Indexes for table `credit_check`
--
ALTER TABLE `credit_check`
  ADD KEY `id` (`id`);

--
-- Indexes for table `credit_facility`
--
ALTER TABLE `credit_facility`
  ADD KEY `id` (`id`);

--
-- Indexes for table `cred_app_bwu`
--
ALTER TABLE `cred_app_bwu`
  ADD KEY `id` (`id`);

--
-- Indexes for table `cred_app_less`
--
ALTER TABLE `cred_app_less`
  ADD KEY `id` (`id`);

--
-- Indexes for table `cred_app_relations`
--
ALTER TABLE `cred_app_relations`
  ADD KEY `id` (`id`);

--
-- Indexes for table `cred_app_vehicles`
--
ALTER TABLE `cred_app_vehicles`
  ADD KEY `id` (`id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD KEY `id` (`id`);

--
-- Indexes for table `finance_approver`
--
ALTER TABLE `finance_approver`
  ADD KEY `id` (`id`);

--
-- Indexes for table `gender`
--
ALTER TABLE `gender`
  ADD KEY `id` (`id`);

--
-- Indexes for table `industry_code`
--
ALTER TABLE `industry_code`
  ADD KEY `id` (`id`);

--
-- Indexes for table `industry_corp`
--
ALTER TABLE `industry_corp`
  ADD KEY `id` (`id`);

--
-- Indexes for table `journals`
--
ALTER TABLE `journals`
  ADD PRIMARY KEY (`journal_id`);

--
-- Indexes for table `journal_details`
--
ALTER TABLE `journal_details`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `journal_entries`
--
ALTER TABLE `journal_entries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ledgers`
--
ALTER TABLE `ledgers`
  ADD PRIMARY KEY (`ledger_id`);

--
-- Indexes for table `loan_approval_type`
--
ALTER TABLE `loan_approval_type`
  ADD KEY `id` (`id`);

--
-- Indexes for table `loan_list`
--
ALTER TABLE `loan_list`
  ADD KEY `id` (`id`);

--
-- Indexes for table `loan_status`
--
ALTER TABLE `loan_status`
  ADD KEY `id` (`id`);

--
-- Indexes for table `loan_types`
--
ALTER TABLE `loan_types`
  ADD KEY `id` (`id`);

--
-- Indexes for table `marketing_type`
--
ALTER TABLE `marketing_type`
  ADD KEY `id` (`id`);

--
-- Indexes for table `official_receipt`
--
ALTER TABLE `official_receipt`
  ADD KEY `id` (`id`);

--
-- Indexes for table `payment_type`
--
ALTER TABLE `payment_type`
  ADD KEY `id` (`id`);

--
-- Indexes for table `preparation`
--
ALTER TABLE `preparation`
  ADD KEY `id` (`id`);

--
-- Indexes for table `product_line`
--
ALTER TABLE `product_line`
  ADD KEY `id` (`id`);

--
-- Indexes for table `query_message`
--
ALTER TABLE `query_message`
  ADD KEY `id` (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `quotes`
--
ALTER TABLE `quotes`
  ADD KEY `id` (`id`);

--
-- Indexes for table `region`
--
ALTER TABLE `region`
  ADD KEY `id` (`id`);

--
-- Indexes for table `request_status`
--
ALTER TABLE `request_status`
  ADD KEY `id` (`id`);

--
-- Indexes for table `requirements`
--
ALTER TABLE `requirements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `security_question`
--
ALTER TABLE `security_question`
  ADD KEY `id` (`id`);

--
-- Indexes for table `trade_check`
--
ALTER TABLE `trade_check`
  ADD KEY `id` (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD KEY `id` (`id`);

--
-- Indexes for table `user_types`
--
ALTER TABLE `user_types`
  ADD KEY `id` (`user_type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `additional_cash`
--
ALTER TABLE `additional_cash`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `approval_flow`
--
ALTER TABLE `approval_flow`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=327;
--
-- AUTO_INCREMENT for table `available_balance`
--
ALTER TABLE `available_balance`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `bank`
--
ALTER TABLE `bank`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `budget_per_week`
--
ALTER TABLE `budget_per_week`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `business_type`
--
ALTER TABLE `business_type`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `caf_info`
--
ALTER TABLE `caf_info`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `cash_request`
--
ALTER TABLE `cash_request`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `civil_status`
--
ALTER TABLE `civil_status`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `client_list`
--
ALTER TABLE `client_list`
  MODIFY `client_number` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `client_requirements_caf`
--
ALTER TABLE `client_requirements_caf`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `client_requirements_cf`
--
ALTER TABLE `client_requirements_cf`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `client_type`
--
ALTER TABLE `client_type`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `collateral_code`
--
ALTER TABLE `collateral_code`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `credit_check`
--
ALTER TABLE `credit_check`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `credit_facility`
--
ALTER TABLE `credit_facility`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `cred_app_bwu`
--
ALTER TABLE `cred_app_bwu`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `cred_app_less`
--
ALTER TABLE `cred_app_less`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `cred_app_relations`
--
ALTER TABLE `cred_app_relations`
  MODIFY `id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `cred_app_vehicles`
--
ALTER TABLE `cred_app_vehicles`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `finance_approver`
--
ALTER TABLE `finance_approver`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `gender`
--
ALTER TABLE `gender`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `industry_code`
--
ALTER TABLE `industry_code`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `industry_corp`
--
ALTER TABLE `industry_corp`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `journals`
--
ALTER TABLE `journals`
  MODIFY `journal_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `journal_details`
--
ALTER TABLE `journal_details`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=253;
--
-- AUTO_INCREMENT for table `journal_entries`
--
ALTER TABLE `journal_entries`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
--
-- AUTO_INCREMENT for table `loan_approval_type`
--
ALTER TABLE `loan_approval_type`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `loan_list`
--
ALTER TABLE `loan_list`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `loan_status`
--
ALTER TABLE `loan_status`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `loan_types`
--
ALTER TABLE `loan_types`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `marketing_type`
--
ALTER TABLE `marketing_type`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `official_receipt`
--
ALTER TABLE `official_receipt`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `payment_type`
--
ALTER TABLE `payment_type`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `preparation`
--
ALTER TABLE `preparation`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `product_line`
--
ALTER TABLE `product_line`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `query_message`
--
ALTER TABLE `query_message`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `question_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `quotes`
--
ALTER TABLE `quotes`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `region`
--
ALTER TABLE `region`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `request_status`
--
ALTER TABLE `request_status`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `requirements`
--
ALTER TABLE `requirements`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `security_question`
--
ALTER TABLE `security_question`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `trade_check`
--
ALTER TABLE `trade_check`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user_types`
--
ALTER TABLE `user_types`
  MODIFY `user_type_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
