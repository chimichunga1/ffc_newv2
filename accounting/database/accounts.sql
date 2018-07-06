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
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('1','000-00-00','000-00-00','0','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('2','101-00-00','CASH ON HAND','1','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('3','101-01-00','Cash on Hand','1','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('4','102-00-00','DEPOSIT IN BANKS','1','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('5','102-01-00','Deposit In Banks Current','1','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('6','102-01-01','Deposit In Banks Current BPI-CA#0321-0016-61','1','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('7','102-01-02','Deposit In Banks Current MB-CA#195319-9','1','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('8','102-01-03','Deposit In Banks Current PCIB-CA#0532-10020-4','1','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('9','102-01-04','Deposit In Banks Current DBP-CA#001773-405-8','1','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('10','102-01-05','Deposit In Banks Current CBC-CA#106-111821-5','1','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('11','102-01-06','Deposit In Banks Current EWB-CA','1','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('12','102-01-07','Deposit In Banks Current BSPI-CA#8000-10001-201','1','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('13','102-01-08','Deposit In Banks Current BPISED#3771-0086-06','1','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('14','102-02-00','Deposit In Banks Savings','1','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('15','102-02-01','Deposit In Banks Savings BPI-SA#0321-0016-61','1','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('16','102-02-02','Deposit In Banks Savings MB-SA#1081929-6','1','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('17','102-02-03','Deposit In Banks Savings PCIB-SA#0533-26854-6','1','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('18','102-02-04','Deposit In Banks Savings DBP-SA#02842-405-8','1','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('19','102-02-05','Deposit In Banks Savings CBC-SA#106-111822-8','1','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('20','102-02-06','Deposit In Banks Savings EWB-SA','1','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('21','103-00-00','RECEIVABLES/LOANS','1','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('22','103-01-00','Receivables Financed','1','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('23','103-02-00','Lease Contract Receivables','1','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('24','103-03-00','Past Due Receivables','1','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('25','103-04-00','Items in Litigation','1','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('26','103-05-00','Allow. for Probable Losses- Rec\'ble Fin./LCR','1','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('27','104-00-00','TRADING ACCOUNT SECURITIES','1','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('28','104-01-00','Trading Account Securities','1','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('29','105-00-00','EQUITY INVESTMENTS','1','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('30','105-01-00','Residual Value Eqpt & Other Prop. for Lease','1','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('31','106-00-00','EQUITY INVESTMENTS','1','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('32','106-01-00','Equity Invest.in Allied Undertaking/ Affiliates','1','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('33','107-00-00','REAL PROPERTY, FURNITURE, FIXTURES AND EQUIPMENT','1','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('34','107-01-00','Furniture& Fixtures','1','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('35','107-02-00','Accumulated Depreciation - Fur. & Fix','1','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('36','107-03-00','Office Equipment','1','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('37','107-04-00','Accumulated Depreciation-Dif Equipment','1','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('38','107-05-00','Transportation Equipment','1','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('39','107-06-00','Accumulated Depreciation - Trans. Eqpt.','1','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('40','108-00-00','REAL AND OTHER PROPERTIES OWNED OR ACQUIRED','1','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('41','108-01-00','Real & Other Properties owned & acquired','1','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('42','109-00-00','OTHER ASSETS','1','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('43','109-01-00','Petty Cash Fund','1','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('44','109-02-00','Accounts Receivable','1','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('45','109-02-01','Accounts Receivable Input-tax','1','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('46','109-02-02','Accounts Receivable Various\r\n','1','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('47','109-02-03','Accounts Receivable IIL/PD','1','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('48','109-03-00','Other Investments','1','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('49','201-00-00','BILLS PAYABLE','2','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('50','201-01-00','Bills Payable','2','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('51','202-00-00','DEPOSITS ON LEASE CONTRACT','2','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('52','202-01-00','Deposits on Lease Contracts','2','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('53','203-00-00','ACCRUED TAXES & OTHER EXPENSES','2','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('54','203-01-00','Accrued Income Tax Payable','2','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('55','203-02-00','Accrued Other Taxes & Licenses Payable','2','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('56','203-03-00','Accrued Interest Payable','2','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('57','203-04-00','Accrued Other Expenses Payable','2','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('58','204-00-00','UNEARNED INCOME & OTHER DEFERRED CREDITS','2','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('59','204-01-00','Unearned Discount & Interest','2','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('60','204-02-00','Advance Leasing Incose Received','2','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('61','205-00-00','OTHER LIABILITIES','2','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('62','205-01-00','Accounts Payable','2','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('63','205-01-01','Accounts Payable AF','2','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('64','205-01-02','Accounts Payable VAT','2','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('65','205-01-03','Accounts Payable AP','2','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('66','205-01-04','Accounts Payable MF','2','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('67','205-01-05','Accounts Payable PR','2','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('68','205-01-06','Accounts Payable DS','2','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('69','205-01-07','Accounts Payable RESTRUC-UDI','2','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('70','205-01-08','Accounts Payable Other','2','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('71','205-01-09','Accounts Payable Insurance','2','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('72','205-01-10','Accounts Payable UDI/ALIR','2','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('73','205-01-11','Accounts Payable CSA-LPC/HFC','2','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('74','205-01-12','Accounts Payable RCF/HFC/PBC','2','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('75','205-01-13','Accounts Payable CSA-UDI','2','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('76','205-01-14','Accounts Payable IIL-HFC/LPC','2','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('77','205-01-15','Accounts Payable ROPOA-UDI','2','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('78','205-02-00','Dividends Payable','2','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('79','205-03-00','Withholding Tax Payable','2','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('80','205-04-00','SSS Premium Payable','2','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('81','205-05-00','PHIC Premium Payable','2','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('82','205-06-00','HDMF Premium Payable','2','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('83','205-07-00','Employees Compensation Premium Payable','2','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('84','205-08-00','Miscellaneous Liabilities','2','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('85','205-08-01','Miscellaneous Liabilities RCF','2','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('86','205-08-02','Miscellaneous Liabilities HFC','2','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('87','205-08-03','Miscellaneous Liabilities PBC','2','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('88','301-00-00','CAPITAL ACCOUNTS','3','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('89','301-01-00','Authorized Capital Stock - Common','3','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('90','301-02-00','Authorized Capital Stock - Preferred','3','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('91','301-03-00','Unissued Capital Stock - Common','3','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('92','301-04-00','Unissued Capital Stock - Preferred','3','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('93','301-05-00','Subscriptions Receivable - Common','3','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('94','301-06-00','Subscriptions Receivable - Preferred','3','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('95','301-07-00','Subscribed Capital Stock - Common','3','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('96','301-08-00','Subscribed Capital Stock - Preferred','3','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('99','301-11-00','Treasury Stock','3','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('100','301-12-00','Retained Earnings','3','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('101','302-00-00','PROFIT AND LOSS SUMMARY','3','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('102','302-01-00','Profit and Loss Summary','3','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('103','401-00-00','FINANCING/ LEASING INCOME','4','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('104','401-01-00','Interest, Discount & Finance','4','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('105','401-02-00','Leasing Income','4','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('106','401-03-00','Service Charges/Fees','4','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('107','402-00-00','INTEREST INCOME','4','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('108','402-01-00','Interest Income','4','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('109','403-00-00','DIVIDEND','4','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('110','403-01-00','Dividends','4','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('111','404-00-00','OTHER INCOME','4','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('112','404-01-00','Recovery on Charge-Off Assets','4','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('113','404-02-00','Income From Assets Acquired','4','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('114','404-03-00','Profit/(Loss) From Assets Bold/Exchange','4','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('115','404-04-00','Miscellaneous Income/(Loss)','4','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('116','404-04-01','LPC','4','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('117','404-04-02','Other','4','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('118','501-00-00','INTEREST / FINANCE CHARGES ON BURROWED FUNDS','5','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('119','501-01-00','Interest on Bills Payable','5','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('120','501-02-00','Finance Charges','5','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('121','502-00-00','COMPENSATION FRINGE BENEFITS','5','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('122','502-01-00','Salaries & Wages','5','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('123','502-02-00','Staff Benefits','5','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('124','502-03-00','SSS Premium','5','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('125','502-04-00','PHIC Premium','5','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('126','502-05-00','HOMF Premium','5','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('127','502-06-00','Medical, Dental & Hospitalization','5','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('128','502-07-00','Contribution to Retirement/ Provident Fund','5','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('129','502-08-00','Employee\'s Compensation Premium','5','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('130','503-00-00','MANAGEMENT OTHER PROFESSIONAL FEES','5','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('131','503-01-00','Management Fees','5','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('132','503-02-00','Professional Fees','5','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('133','504-00-00','FINES, PENALTIES & OTHER CHARGES','5','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('134','504-01-00','Fines, Penalties & Other Charges','5','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('135','505-00-00','TAXES AND LICENSES','5','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('136','505-01-00','Taxes and Licenses','5','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('137','506-00-00','TRANSFER MORTGAGE & REGISTRATION FEES','5','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('138','506-01-00','Transter Mortgage & Registration Fees','5','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('139','507-00-00','INSURANCE','5','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('140','507-01-00','Insurance','5','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('141','508-00-00','DEPRECIATION AMORTIZATION','5','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('142','508-01-00','Depreciation - Fur. & Fixture','5','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('143','508-02-00','Depreciation - Office Equipment','5','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('144','508-03-00','Depreciation - Trans. Equipment','5','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('145','509-00-00','LITIGATION / ASSETS ACQUIRED EXPENSES','5','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('146','509-01-00','Litigation / Assets Acquired Expenses','5','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('147','510-00-00','OTHER EXPENSES','5','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('148','510-01-00','Rent','5','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('149','510-02-00','Power, Light & Water','5','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('150','510-03-00','Fuel & Lubrication','5','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('151','510-04-00','Travelling Expenses','5','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('152','510-05-00','Repairs & Haintenance','5','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('153','510-06-00','Security, Messengerial and Janitorial Services','5','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('154','510-07-00','Commission / Trust Fees','5','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('155','510-08-00','Data Processing Charges','5','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('156','510-09-00','Bank Charges','5','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('157','510-10-00','Postage, Telephone, cables & Telegrams','5','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('158','510-11-00','Documentary & Science Stamps Used','5','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('159','510-12-00','Stationery & Supplies Used','5','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('160','510-13-00','Periodicals & Magazines','5','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('161','510-14-00','Advertising & Publicity','5','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('162','510-15-00','Representation & Entertainment','5','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('163','510-16-00','Membership Fees & Dues','5','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('164','510-17-00','Donation & Charitable Contributions','5','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('165','510-18-00','Miscellaneous Expenses','5','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('166','511-00-00','BAD DEBTS WRITTEN OFF','5','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('167','511-01-00','Bad Debts Written Off','5','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('168','512-00-00','PROVISIONS','5','0');
insert into `accounts` (`id`, `acc_id`, `account_name`, `type`, `is_deleted`) values('169','512-01-00','Provision for Income Tax IN','5','0');