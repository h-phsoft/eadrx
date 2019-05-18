-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `drx_books` (
  `book_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto PK',
  `lang_id` int(11) NOT NULL COMMENT 'Language, FK',
  `book_title` varchar(200) NOT NULL COMMENT 'Title',
  `book_desc` mediumtext NOT NULL COMMENT 'Description',
  `book_image` char(150) NOT NULL COMMENT 'Image',
  `status_id` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Status',
  `book_price` decimal(10,2) NOT NULL COMMENT 'Price',
  `ins_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Datetime',
  PRIMARY KEY (`book_id`),
  KEY `lang_id` (`lang_id`),
  KEY `book_status` (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `drx_books` (`book_id`, `lang_id`, `book_title`, `book_desc`, `book_image`, `status_id`, `book_price`, `ins_datetime`) VALUES
(1, 1, 'Test Book', '<p>Test Book Test Book Test Book Test Book Test Book Test Book Test Book Test Book Test Book Test Book Test Book Test Book Test Book Test Book Test Book Test Book Test Book Test Book Test Book Test Book Test Book Test Book Test Book Test Book Test Book Test Book Test Book Test Book Test Book Test Book Test Book Test Book Test Book Test Book Test Book Test Book Test Book Test Book Test Book Test Book Test Book Test Book Test Book Test Book Test Book Test Book Test Book Test Book Test Book Test Book Test Book Test Book Test Book Test Book Test Book Test Book Test Book Test Book</p>', 'DrX_0000_Splash.jpg', 1, '100.00', '2018-12-22 17:09:16');

-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `drx_consultation` (
  `cons_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Consultation Question Id',
  `user_id` int(11) NOT NULL COMMENT 'Consultation price',
  `status_id` int(11) NOT NULL DEFAULT '1' COMMENT 'Status, FK',
  `cons_amount` decimal(6,2) NOT NULL DEFAULT '0.00' COMMENT 'Consultation Selected Price',
  `cons_message` mediumtext NOT NULL COMMENT 'Request Message',
  `cons_file` varchar(200) DEFAULT NULL COMMENT 'Attached File',
  `cons_audio` varchar(200) DEFAULT NULL COMMENT 'Attached Audio',
  `ins_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Created datetime',
  PRIMARY KEY (`cons_id`),
  KEY `status_id` (`status_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `drx_consultation` (`cons_id`, `user_id`, `status_id`, `cons_amount`, `cons_message`, `cons_file`, `cons_audio`, `ins_datetime`) VALUES
(1, 3, 1, '100.00', 'Hi, Please i need your help about Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla', NULL, NULL, '2018-12-22 17:54:01');

-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `drx_consult_answer` (
  `answer_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto PK',
  `user_id` int(11) NOT NULL COMMENT 'User Id, FK',
  `cons_id` int(11) NOT NULL COMMENT 'Consultation Id, FK',
  `answer_text` mediumtext NOT NULL COMMENT 'Answer Message',
  `answer_file` varchar(200) DEFAULT NULL COMMENT 'Attached File',
  `answer_audio` varchar(200) DEFAULT NULL COMMENT 'Attached Audio',
  `ins_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Created datetime',
  PRIMARY KEY (`answer_id`),
  KEY `user_id` (`user_id`),
  KEY `cons_id` (`cons_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `drx_consult_answer` (`answer_id`, `user_id`, `cons_id`, `answer_text`, `answer_file`, `answer_audio`, `ins_datetime`) VALUES
(1, 2, 1, 'Ok, I\'ll Answer in 24 hours', NULL, NULL, '2018-12-22 19:25:22');

-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `drx_consult_assign` (
  `assign_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Consultation Question Id',
  `user_id` int(11) NOT NULL COMMENT 'User Id, FK',
  `cons_id` int(11) NOT NULL COMMENT 'Consultation, FK',
  `assign_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'Status,',
  `ins_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Created datetime',
  PRIMARY KEY (`assign_id`),
  KEY `user_id` (`user_id`),
  KEY `cons_id` (`cons_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `drx_consult_assign` (`assign_id`, `user_id`, `cons_id`, `assign_status`, `ins_datetime`) VALUES
(1, 2, 1, 1, '2018-12-22 19:22:54');

-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `drx_consult_price` (
  `cons_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto PK',
  `status_id` tinyint(4) NOT NULL COMMENT 'Status, 	',
  `cons_price` decimal(6,2) NOT NULL DEFAULT '0.00' COMMENT 'Consultation price',
  `ins_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Created datetime',
  PRIMARY KEY (`cons_id`),
  UNIQUE KEY `cons_price` (`cons_price`),
  KEY `status_id` (`status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `drx_consult_status` (
  `status_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto PK',
  `status_name` varchar(200) NOT NULL DEFAULT '' COMMENT 'Status Name',
  `ins_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Created datetime',
  PRIMARY KEY (`status_id`),
  UNIQUE KEY `status_name` (`status_name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO `drx_consult_status` (`status_id`, `status_name`, `ins_datetime`) VALUES
(1, 'New', '2018-12-22 15:15:09'),
(2, 'Pending', '2018-12-22 15:15:16'),
(3, 'Done', '2018-12-22 15:15:23');

-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `drx_devices` (
  `dev_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto PK',
  `user_id` int(11) NOT NULL COMMENT 'User, FK',
  `status_id` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'Status,',
  `dev_token` varchar(200) NOT NULL COMMENT 'Token',
  `dev_os` varchar(10) NOT NULL COMMENT 'Operating system Android / IOS',
  `ins_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Created datetime',
  PRIMARY KEY (`dev_id`),
  UNIQUE KEY `dev_token` (`dev_token`),
  KEY `user_id` (`user_id`),
  KEY `dev_status` (`status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `drx_notif_priv` (
  `notif_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto PK',
  `user_id` int(11) NOT NULL COMMENT 'User',
  `notif_text` mediumtext NOT NULL COMMENT 'Notification Message',
  `ins_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Sent datetime',
  PRIMARY KEY (`notif_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `drx_notif_pub` (
  `notif_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto PK',
  `lang_id` int(11) NOT NULL COMMENT 'Language',
  `notif_text` mediumtext NOT NULL COMMENT 'Notification Message',
  `ins_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Sent datetime',
  PRIMARY KEY (`notif_id`),
  KEY `lang_id` (`lang_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `drx_permission` (
  `perm_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Auto PK',
  `pgrp_id` int(11) NOT NULL COMMENT 'Permission Group, FK',
  `menu_id` int(11) NOT NULL COMMENT 'Menu Item, FK',
  `perm_ok` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Permission Status',
  PRIMARY KEY (`perm_id`),
  UNIQUE KEY `pgrp_id_2` (`pgrp_id`,`menu_id`),
  KEY `pgrp_id` (`pgrp_id`),
  KEY `menu_id` (`menu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `drx_subscribe` (
  `sub_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto PK',
  `user_id` int(11) NOT NULL COMMENT 'User, FK',
  `stype_id` int(11) NOT NULL COMMENT 'Subscribe Type, FK',
  `sub_sdate` date NOT NULL COMMENT 'Start Date',
  `sub_edate` date NOT NULL COMMENT 'End Date',
  `sub_price` decimal(6,2) NOT NULL DEFAULT '0.00' COMMENT 'Price',
  `ins_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Created datetime',
  PRIMARY KEY (`sub_id`),
  KEY `stype_id` (`stype_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `drx_user_balance` (
  `blnc_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto PK',
  `user_id` int(11) NOT NULL COMMENT 'User, FK',
  `stype_id` int(11) NOT NULL COMMENT 'Subscribe Type, FK',
  `blnc_balnce` decimal(6,2) NOT NULL DEFAULT '0.00' COMMENT 'User Balance by SType',
  `ins_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Created datetime',
  PRIMARY KEY (`blnc_id`),
  UNIQUE KEY `user_id_stype_id` (`stype_id`,`user_id`),
  KEY `stype_id` (`stype_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `drx_subs_type` (
  `stype_id` int(11) NOT NULL COMMENT 'Primary Key',
  `stype_name` varchar(100) NOT NULL DEFAULT '' COMMENT 'Name',
  PRIMARY KEY (`stype_id`),
  UNIQUE KEY `stype_name` (`stype_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `drx_subs_type` (`stype_id`, `stype_name`) VALUES
(2, 'Books'),
(11, 'Test 1'),
(12, 'Test 2'),
(13, 'Test 3'),
(14, 'Test 4'),
(1, 'Tips');

-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `drx_test` (
  `test_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto PK',
  `test_num` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'Test Number in the main site',
  `test_name` varchar(200) NOT NULL COMMENT 'Name, Local Test Name',
  `test_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'Status,',
  `test_price` decimal(6,2) NOT NULL DEFAULT '0.00' COMMENT 'Price, Muse use a Trigger to insert changes into Test Price Log table',
  `ins_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Datetime',
  PRIMARY KEY (`test_id`),
  UNIQUE KEY `test_num` (`test_num`),
  UNIQUE KEY `test_name` (`test_name`),
  KEY `test_status` (`test_status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `drx_test_prices` (
  `price_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto PK',
  `test_id` int(11) NOT NULL COMMENT 'Test, FK',
  `user_id` int(11) NOT NULL COMMENT 'User, FK',
  `price_old` decimal(6,2) NOT NULL DEFAULT '0.00' COMMENT 'Old Price',
  `price_new` decimal(6,2) NOT NULL DEFAULT '0.00' COMMENT 'New Price',
  `ins_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Datetime',
  PRIMARY KEY (`price_id`),
  KEY `test_id` (`test_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `drx_test_results` (
  `res_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto PK',
  `user_id` int(11) NOT NULL COMMENT 'User, FK',
  `test_id` int(11) NOT NULL COMMENT 'Test, FK',
  `res_request` mediumtext NOT NULL COMMENT 'JSON sent to Main site web service',
  `res_result` mediumtext NOT NULL COMMENT 'Result received from Main site web service',
  `ins_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Datetime',
  PRIMARY KEY (`res_id`),
  KEY `test_id` (`test_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `drx_tips` (
  `tips_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto PK',
  `lang_id` int(11) NOT NULL COMMENT 'Language',
  `tips_text` mediumtext NOT NULL COMMENT 'Tips Text in Language',
  `ins_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Datetime',
  PRIMARY KEY (`tips_id`),
  KEY `lang_id` (`lang_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `drx_tips_sents` (
  `stips_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto PK',
  `user_id` int(11) NOT NULL COMMENT 'User',
  `lang_id` int(11) NOT NULL COMMENT 'Language',
  `tips_id` int(11) NOT NULL COMMENT 'Tips',
  `tips_text` mediumtext NOT NULL COMMENT 'Tips Text in Language',
  `ins_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Sent datetime',
  PRIMARY KEY (`stips_id`),
  KEY `user_id` (`user_id`),
  KEY `lang_id` (`lang_id`),
  KEY `tips_id` (`tips_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `drx_user_payments` (
  `upay_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto PK',
  `user_id` int(11) NOT NULL COMMENT 'User, FK',
  `stype_id` int(11) NOT NULL COMMENT 'Subscribe Type, FK',
  `upay_chargeid` varchar(255) NOT NULL COMMENT 'ChargeId ??????????',
  `upay_reference` varchar(150) NOT NULL COMMENT 'Reference',
  `upay_result` varchar(50) NOT NULL COMMENT 'Result',
  `upay_payid` varchar(150) NOT NULL COMMENT 'Payment Id ??????????',
  `upay_cardtype` varchar(50) NOT NULL COMMENT 'Card Type',
  `upay_trackid` varchar(30) NOT NULL COMMENT 'Track Id ??????????',
  `upay_card` varchar(10) NOT NULL COMMENT 'Card Number',
  `upay_hash` varchar(255) NOT NULL COMMENT 'Hash ??????????',
  `upay_paydate` date NOT NULL COMMENT 'Payment Date',
  `upay_amount` decimal(6,2) NOT NULL COMMENT 'Payment Amount',
  `ins_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Created datetime',
  PRIMARY KEY (`upay_id`),
  KEY `user_id` (`user_id`),
  KEY `stype_id` (`stype_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------
ALTER TABLE `drx_books`
  ADD CONSTRAINT `drx_books_ibfk_1` FOREIGN KEY (`lang_id`) REFERENCES `phs_language` (`lang_id`),
  ADD CONSTRAINT `drx_books_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `phs_status` (`status_id`);

ALTER TABLE `drx_consultation`
  ADD CONSTRAINT `drx_consultation_ibfk_1` FOREIGN KEY (`status_id`) REFERENCES `drx_consult_status` (`status_id`),
  ADD CONSTRAINT `drx_consultation_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `cpy_user` (`user_id`);

ALTER TABLE `drx_consult_answer`
  ADD CONSTRAINT `drx_consult_answer_ibfk_1` FOREIGN KEY (`cons_id`) REFERENCES `drx_consultation` (`cons_id`),
  ADD CONSTRAINT `drx_consult_answer_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `cpy_user` (`user_id`);

ALTER TABLE `drx_consult_assign`
  ADD CONSTRAINT `drx_consult_assign_ibfk_1` FOREIGN KEY (`cons_id`) REFERENCES `drx_consultation` (`cons_id`),
  ADD CONSTRAINT `drx_consult_assign_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `cpy_user` (`user_id`);

ALTER TABLE `drx_consult_price`
  ADD CONSTRAINT `drx_consult_price_ibfk_1` FOREIGN KEY (`status_id`) REFERENCES `phs_status` (`status_id`);

ALTER TABLE `drx_devices`
  ADD CONSTRAINT `drx_devices_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `cpy_user` (`user_id`),
  ADD CONSTRAINT `drx_devices_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `phs_status` (`status_id`);

ALTER TABLE `drx_notif_priv`
  ADD CONSTRAINT `drx_notif_priv_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `cpy_user` (`user_id`);

ALTER TABLE `drx_notif_pub`
  ADD CONSTRAINT `drx_notif_pub_ibfk_1` FOREIGN KEY (`lang_id`) REFERENCES `phs_language` (`lang_id`);

ALTER TABLE `drx_permission`
  ADD CONSTRAINT `drx_permission_ibfk_1` FOREIGN KEY (`menu_id`) REFERENCES `phs_menu` (`menu_id`),
  ADD CONSTRAINT `drx_permission_ibfk_2` FOREIGN KEY (`pgrp_id`) REFERENCES `cpy_pgroup` (`pgrp_id`);

ALTER TABLE `drx_subscribe`
  ADD CONSTRAINT `drx_subscribe_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `cpy_user` (`user_id`),
  ADD CONSTRAINT `drx_subscribe_ibfk_2` FOREIGN KEY (`stype_id`) REFERENCES `drx_subs_type` (`stype_id`);

ALTER TABLE `drx_test_prices`
  ADD CONSTRAINT `drx_test_prices_ibfk_1` FOREIGN KEY (`test_id`) REFERENCES `drx_test` (`test_id`),
  ADD CONSTRAINT `drx_test_prices_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `cpy_user` (`user_id`);

ALTER TABLE `drx_test_results`
  ADD CONSTRAINT `drx_test_results_ibfk_1` FOREIGN KEY (`test_id`) REFERENCES `drx_test` (`test_id`),
  ADD CONSTRAINT `drx_test_results_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `cpy_user` (`user_id`);

ALTER TABLE `drx_tips`
  ADD CONSTRAINT `drx_tips_ibfk_1` FOREIGN KEY (`lang_id`) REFERENCES `phs_language` (`lang_id`);

ALTER TABLE `drx_tips_sents`
  ADD CONSTRAINT `drx_tips_sents_ibfk_1` FOREIGN KEY (`lang_id`) REFERENCES `phs_language` (`lang_id`),
  ADD CONSTRAINT `drx_tips_sents_ibfk_2` FOREIGN KEY (`tips_id`) REFERENCES `drx_tips` (`tips_id`),
  ADD CONSTRAINT `drx_tips_sents_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `cpy_user` (`user_id`);

ALTER TABLE `drx_user_subscribe`
  ADD CONSTRAINT `drx_user_subscribe_ibfk_1` FOREIGN KEY (`stype_id`) REFERENCES `drx_subs_type` (`stype_id`),
  ADD CONSTRAINT `drx_user_subscribe_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `cpy_user` (`user_id`);
COMMIT;
