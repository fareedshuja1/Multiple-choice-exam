-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Apr 09, 2015 at 01:11 PM
-- Server version: 5.0.51
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Database: `exam_v3`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `allowance`
-- 

CREATE TABLE `allowance` (
  `allow_id` int(11) NOT NULL,
  `allow_name` varchar(50) NOT NULL,
  `allow_type` varchar(1) NOT NULL,
  PRIMARY KEY  (`allow_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 
-- Dumping data for table `allowance`
-- 

INSERT INTO `allowance` VALUES (1, 'YEARLY INCREAMENT', 'I');
INSERT INTO `allowance` VALUES (2, 'SPECIAL DUTY ALLOWANCE', 'A');

-- --------------------------------------------------------

-- 
-- Table structure for table `category`
-- 

CREATE TABLE `category` (
  `cat_id` int(11) NOT NULL auto_increment,
  `cat_name` varchar(40) NOT NULL,
  `cat_status` varchar(20) NOT NULL,
  PRIMARY KEY  (`cat_id`),
  UNIQUE KEY `cat_name` (`cat_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- 
-- Dumping data for table `category`
-- 

INSERT INTO `category` VALUES (4, 'Beginner', 'Active');
INSERT INTO `category` VALUES (5, 'Intermediate', 'Active');
INSERT INTO `category` VALUES (6, 'Advance', 'Active');

-- --------------------------------------------------------

-- 
-- Table structure for table `class_code`
-- 

CREATE TABLE `class_code` (
  `ccid` int(11) NOT NULL,
  `scid` int(11) NOT NULL,
  `class_name` varchar(50) NOT NULL,
  `emp_id` int(11) default NULL,
  `room_id` int(11) default NULL,
  `class_time` varchar(8) default NULL,
  `class_etime` varchar(8) default NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY  (`ccid`),
  KEY `FK_class_code_scid` (`scid`),
  KEY `FK_class_code_emp` (`emp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 
-- Dumping data for table `class_code`
-- 

INSERT INTO `class_code` VALUES (1, 1, 'PHP 1', 3, 1, '02:00 PM', '03:00 PM', '2015-02-28', '2015-03-30', 'Incomplete');
INSERT INTO `class_code` VALUES (2, 1, 'OO PHP', 3, 1, '03:15 PM', '04:00 PM', '2015-04-06', '2015-06-06', 'Incomplete');
INSERT INTO `class_code` VALUES (3, 2, 'Oracle Class', 2, NULL, '05:00 PM', NULL, '2015-04-01', '2015-06-01', 'Incomplete');
INSERT INTO `class_code` VALUES (4, 1, 'PHP Codeigniter', 3, 1, '04:15 PM', '05:00 PM', '2015-04-01', '2015-06-01', 'Incomplete');

-- --------------------------------------------------------

-- 
-- Table structure for table `emails`
-- 

CREATE TABLE `emails` (
  `mail_id` int(11) NOT NULL,
  `mail_host` varchar(25) NOT NULL,
  `mail_port` int(11) NOT NULL,
  `mail_username` varchar(100) NOT NULL,
  `mail_password` varchar(100) NOT NULL,
  `mail_sendername` varchar(50) NOT NULL,
  `mail_status` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Dumping data for table `emails`
-- 

INSERT INTO `emails` VALUES (3, 'smtp.gmail.com', 587, 'babar_ali@gmail.com', 'babar', 'Babar Ali', 'Inactive');
INSERT INTO `emails` VALUES (2, 'smtp.gmail.com', 587, 'noor@gmail.com', 'noor', 'Noor Zaman', 'Inactive');
INSERT INTO `emails` VALUES (1, 'smtp.gmail.com', 587, 'programmer.gee@gmail.com', '', 'DB Scholars', 'Active');

-- --------------------------------------------------------

-- 
-- Table structure for table `employees`
-- 

CREATE TABLE `employees` (
  `emp_id` int(11) NOT NULL,
  `emp_name` varchar(50) NOT NULL,
  `emp_fname` varchar(50) NOT NULL,
  `emp_contact` varchar(50) NOT NULL,
  `emp_address` text NOT NULL,
  `emp_pic` varchar(100) NOT NULL,
  `emp_email` varchar(50) NOT NULL,
  `emp_type` varchar(10) NOT NULL,
  `sal_amount` int(11) NOT NULL,
  PRIMARY KEY  (`emp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 
-- Dumping data for table `employees`
-- 

INSERT INTO `employees` VALUES (1, 'Fareed Shuja', 'Ahmad Khan', '03349194966', 'Hayatabad, Khyber Pakhtunkhwa.', '001Copy.jpg', 'faridshuja1@gmail.com', 'F', 12000);
INSERT INTO `employees` VALUES (2, 'Noor Zaman', 'Zaman Khan', '03001234567', 'Hangu, Kpk', 'BD2.png', 'noor@yahoo.com', 'F', 10000);
INSERT INTO `employees` VALUES (3, 'Sohail Ahmad Khan', 'Ahmad Khan', '03004567898', 'Peshawar City', 'TW logo.png', 'sohail@ifast.com.pk', 'H', 50);

-- --------------------------------------------------------

-- 
-- Table structure for table `employees_allowance`
-- 

CREATE TABLE `employees_allowance` (
  `emp_id` int(11) NOT NULL,
  `allow_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date default NULL,
  `amount` int(11) NOT NULL,
  `remarks` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 
-- Dumping data for table `employees_allowance`
-- 

INSERT INTO `employees_allowance` VALUES (1, 1, '2015-04-02', NULL, 5000, 'This is remarks');
INSERT INTO `employees_allowance` VALUES (1, 2, '2015-04-02', '2015-04-30', 6000, 'This is remarks.');

-- --------------------------------------------------------

-- 
-- Table structure for table `exam_master`
-- 

CREATE TABLE `exam_master` (
  `em_id` int(11) NOT NULL,
  `exam_date` date NOT NULL,
  `e_start_time` datetime NOT NULL,
  `e_end_time` datetime NOT NULL,
  `ccid` int(11) NOT NULL,
  `total_ques` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `tot_minutes` int(11) default NULL,
  `pass_per` int(11) NOT NULL,
  PRIMARY KEY  (`em_id`),
  KEY `FK_exam_master_ccid` (`ccid`),
  KEY `FK_exam_master_cat_id` (`cat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 
-- Dumping data for table `exam_master`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `login`
-- 

CREATE TABLE `login` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `emp_id` int(11) default NULL,
  `group_id` int(11) default NULL,
  `is_active` varchar(10) NOT NULL,
  `sup_admin` varchar(1) default NULL,
  PRIMARY KEY  (`username`),
  KEY `FK_login_emp_id` (`emp_id`),
  KEY `FK_login_group_id` (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 
-- Dumping data for table `login`
-- 

INSERT INTO `login` VALUES ('admin', '21232f297a57a5a743894a0e4a801fc3', 1, 1, '1', '1');
INSERT INTO `login` VALUES ('sohail', 'a2de32da8c7b9de7332c15c194ce20df', 3, 1, '1', NULL);

-- --------------------------------------------------------

-- 
-- Table structure for table `main_courses`
-- 

CREATE TABLE `main_courses` (
  `mcid` int(11) NOT NULL auto_increment,
  `mc_title` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY  (`mcid`),
  UNIQUE KEY `mc_title` (`mc_title`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- 
-- Dumping data for table `main_courses`
-- 

INSERT INTO `main_courses` VALUES (1, 'Web Development', 'Active');
INSERT INTO `main_courses` VALUES (2, 'Databases', 'Active');

-- --------------------------------------------------------

-- 
-- Table structure for table `nationality`
-- 

CREATE TABLE `nationality` (
  `nat_id` int(11) NOT NULL auto_increment,
  `nat_title` varchar(50) NOT NULL,
  PRIMARY KEY  (`nat_id`),
  UNIQUE KEY `nat_title` (`nat_title`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

-- 
-- Dumping data for table `nationality`
-- 

INSERT INTO `nationality` VALUES (5, 'AFGHAN');
INSERT INTO `nationality` VALUES (8, 'INDIAN');
INSERT INTO `nationality` VALUES (6, 'OTHERS');
INSERT INTO `nationality` VALUES (4, 'PAKISTANI');

-- --------------------------------------------------------

-- 
-- Table structure for table `question_bank`
-- 

CREATE TABLE `question_bank` (
  `ques_id` int(11) NOT NULL,
  `scid` int(11) NOT NULL,
  `ques_text` varchar(500) NOT NULL,
  `ques_hints` varchar(100) NOT NULL,
  `ques_year` varchar(10) NOT NULL,
  `ques_status` varchar(10) NOT NULL,
  `cat_id` int(11) NOT NULL,
  PRIMARY KEY  (`ques_id`),
  KEY `FK_question_bank_scid` (`scid`),
  KEY `FK_question_bank_cat_id` (`cat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 
-- Dumping data for table `question_bank`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `question_bank_options`
-- 

CREATE TABLE `question_bank_options` (
  `ques_id` int(11) NOT NULL,
  `s_no` int(11) NOT NULL,
  `option_text` varchar(200) NOT NULL,
  `correct_option` varchar(10) NOT NULL,
  KEY `FK_question_bank_options_ques_id` (`ques_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 
-- Dumping data for table `question_bank_options`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `question_paper`
-- 

CREATE TABLE `question_paper` (
  `std_qno` int(11) NOT NULL,
  `em_id` int(11) NOT NULL,
  `student_id` varchar(20) NOT NULL,
  `ques_id` int(11) default NULL,
  `s_no` int(11) default NULL,
  `std_correct_ans` int(11) default NULL,
  `std_status` varchar(1) default NULL,
  `rem_minutes` int(11) default NULL,
  `rem_sec` int(11) default NULL,
  `exam_status` varchar(1) default NULL,
  KEY `FK_question_paper_student_id` (`student_id`),
  KEY `FK_question_paper_ques_id` (`ques_id`),
  KEY `FK_question_paper_em_id` (`em_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 
-- Dumping data for table `question_paper`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `religion`
-- 

CREATE TABLE `religion` (
  `rel_id` int(11) NOT NULL auto_increment,
  `rel_title` varchar(50) NOT NULL,
  PRIMARY KEY  (`rel_id`),
  UNIQUE KEY `rel_title` (`rel_title`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

-- 
-- Dumping data for table `religion`
-- 

INSERT INTO `religion` VALUES (8, 'CHRISTIAN');
INSERT INTO `religion` VALUES (6, 'HINDU');
INSERT INTO `religion` VALUES (5, 'ISLAM');

-- --------------------------------------------------------

-- 
-- Table structure for table `rooms`
-- 

CREATE TABLE `rooms` (
  `room_id` int(11) NOT NULL,
  `room_name` varchar(50) default NULL,
  PRIMARY KEY  (`room_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 
-- Dumping data for table `rooms`
-- 

INSERT INTO `rooms` VALUES (1, 'ROOM 1');
INSERT INTO `rooms` VALUES (2, 'ROOM 2');
INSERT INTO `rooms` VALUES (3, 'ROOM 3');
INSERT INTO `rooms` VALUES (4, 'ROOM 4');
INSERT INTO `rooms` VALUES (5, 'ROOM 5');

-- --------------------------------------------------------

-- 
-- Table structure for table `student_academic_record`
-- 

CREATE TABLE `student_academic_record` (
  `sar_id` int(11) NOT NULL auto_increment,
  `exam_passed` varchar(50) NOT NULL,
  `board` varchar(50) NOT NULL,
  `year` varchar(10) NOT NULL,
  `grade` varchar(10) NOT NULL,
  `division` varchar(10) NOT NULL,
  `percantage` int(11) NOT NULL,
  `student_id` varchar(20) NOT NULL,
  PRIMARY KEY  (`sar_id`),
  KEY `FK_student_academic_record_student_id` (`student_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `student_academic_record`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `student_course_detail`
-- 

CREATE TABLE `student_course_detail` (
  `scd_id` int(11) NOT NULL,
  `student_id` varchar(20) NOT NULL,
  `ccid` int(11) NOT NULL,
  `scd_status` varchar(20) NOT NULL,
  `form_no` int(11) default NULL,
  `reg_no` varchar(30) default NULL,
  `total_fee` int(11) NOT NULL,
  `discounted_fee` int(11) NOT NULL,
  `rem_fee` int(11) default NULL,
  PRIMARY KEY  (`scd_id`),
  KEY `FK_student_course_detail_student_id` (`student_id`),
  KEY `FK_student_course_detail_ccid` (`ccid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 
-- Dumping data for table `student_course_detail`
-- 

INSERT INTO `student_course_detail` VALUES (1, 'ITALR1', 1, 'Incomplete', 3978, '9876', 10000, 10000, 500);
INSERT INTO `student_course_detail` VALUES (2, 'ITALR2', 1, 'Incomplete', 3978, '9765', 10000, 8000, 0);

-- --------------------------------------------------------

-- 
-- Table structure for table `student_info`
-- 

CREATE TABLE `student_info` (
  `student_id` varchar(20) NOT NULL,
  `student_name` varchar(50) NOT NULL,
  `student_fname` varchar(50) NOT NULL,
  `student_password` varchar(100) NOT NULL,
  `student_dob` date NOT NULL,
  `student_gender` varchar(10) NOT NULL,
  `nat_id` int(11) NOT NULL,
  `rel_id` int(11) NOT NULL,
  `student_nic` varchar(15) default NULL,
  `student_fnic` varchar(15) default NULL,
  `student_phone` varchar(15) default NULL,
  `student_cell` varchar(15) default NULL,
  `student_email` text,
  `emergency_phone` varchar(15) default NULL,
  `emergency_cell` varchar(15) NOT NULL,
  `emergency_email` text,
  `student_address` text,
  `created_date` varchar(50) NOT NULL,
  `form_no` int(11) NOT NULL,
  `reg_no` varchar(30) NOT NULL,
  `student_image` text NOT NULL,
  PRIMARY KEY  (`student_id`),
  KEY `FK_student_info_nat_id` (`nat_id`),
  KEY `FK_student_info_rel_id` (`rel_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 
-- Dumping data for table `student_info`
-- 

INSERT INTO `student_info` VALUES ('ITALR1', 'Fareed Shuja', 'Abdullah Khan', '2b31a482b7563e1d0c8551ef93b587e0', '1989-03-26', 'Male', 4, 5, '78323-9834567-1', '98734-6723987-1', '03349194966', '03349194966', 'faridshuja1@gmail.com', '03349194966', '03349194966', 'faridshuja@yahoo.com', 'Phase 1, Hayatabad, Peshawar. Pakistan', '2015-01-25', 0, '', '001 - Copy.jpg');
INSERT INTO `student_info` VALUES ('ITALR2', 'Noor Zaman', 'Zaman Khan', '35670b396d511467d1e07b78e35bb350', '1980-01-01', 'Male', 4, 5, '43984-3984398-4', '39483-9843984-9', '03349394893', '03001234567', 'noor_zaman@gmail.com', '0915783456', '03331234567', 'zaman_noor@yahoo.com', 'Hangu, Khyber Pakhtunkhwa.', '2015-03-30', 0, '', '1408354015-IMG_1923.jpg');
INSERT INTO `student_info` VALUES ('ITALR3', 'Sameer Ali', 'Ali Khan', 'dd07685ab6fe19921bc771b5eb391e1f', '1989-04-04', 'Male', 4, 5, '24242-4242424-2', '53453-5353534-5', '0915678345', '03007654321', 'sameer_ali@yahoo.com', '0915678345', '033339876543', 'ali_sameer@yahoo.com', 'Khyber Pakhtunkhwa, Peshawar.', '2015-04-07', 0, '', '1 - Copy.jpg');
INSERT INTO `student_info` VALUES ('ITALR4', 'Babar Khan', 'Aftab Alam', '086c7006a1cf5d3f67d1d247d8439ab8', '1990-05-09', 'Male', 4, 5, '35636-5474756-8', '86858-6745634-5', '0915683456', '03449384933', 'babar@gmail.com', '0918765345', '03542324221', 'aftab@yahoo.com', 'Gulbahar, Peshawar City', '2015-04-07', 0, '', '');
INSERT INTO `student_info` VALUES ('ITALR5', 'Malik Shahab', 'Shahab Khan', 'd4271f5837b98a81d047d180195be0f6', '1980-01-01', 'Male', 4, 5, '35346-5647464-5', '57675-4564564-5', '0912345674', '03349812443', 'malik@gmail.com', '0912345674', '03458798222', 'shahab@yahoo.com', 'Peshawar City. Pakistan', '2015-04-07', 0, '', '');

-- --------------------------------------------------------

-- 
-- Table structure for table `student_ledger`
-- 

CREATE TABLE `student_ledger` (
  `ledger_id` varchar(11) NOT NULL,
  `scd_id` int(11) NOT NULL,
  `paid_amt` int(11) NOT NULL,
  `payment_date` date NOT NULL,
  `payment_type` varchar(1) NOT NULL,
  KEY `FK_student_ledger` (`scd_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 
-- Dumping data for table `student_ledger`
-- 

INSERT INTO `student_ledger` VALUES ('INV-0000001', 1, 10000, '2015-03-30', 'T');
INSERT INTO `student_ledger` VALUES ('INV-0000001', 1, 8500, '2015-03-30', 'P');
INSERT INTO `student_ledger` VALUES ('INV-0000002', 1, 1000, '2015-03-30', 'P');
INSERT INTO `student_ledger` VALUES ('INV-0000003', 2, 8000, '2015-03-30', 'T');
INSERT INTO `student_ledger` VALUES ('INV-0000003', 2, 3000, '2015-03-30', 'P');
INSERT INTO `student_ledger` VALUES ('INV-0000004', 2, 300, '2015-03-30', 'P');
INSERT INTO `student_ledger` VALUES ('INV-0000005', 2, 4700, '2015-03-30', 'P');

-- --------------------------------------------------------

-- 
-- Table structure for table `sub_courses`
-- 

CREATE TABLE `sub_courses` (
  `scid` int(11) NOT NULL auto_increment,
  `mcid` int(11) NOT NULL,
  `sc_title` varchar(50) NOT NULL,
  `course_duration` varchar(10) NOT NULL,
  `course_fee` int(11) NOT NULL,
  PRIMARY KEY  (`scid`),
  UNIQUE KEY `sc_title` (`sc_title`),
  KEY `FK_sub_courses_mcid` (`mcid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- 
-- Dumping data for table `sub_courses`
-- 

INSERT INTO `sub_courses` VALUES (1, 1, 'PHP', '2', 10000);
INSERT INTO `sub_courses` VALUES (2, 2, 'MYSQL DATABASE', '2', 15000);
INSERT INTO `sub_courses` VALUES (3, 1, 'HTML 5 & CSS 3', '2', 10000);

-- --------------------------------------------------------

-- 
-- Table structure for table `um_group`
-- 

CREATE TABLE `um_group` (
  `group_id` int(11) NOT NULL auto_increment,
  `group_name` varchar(50) NOT NULL,
  PRIMARY KEY  (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- 
-- Dumping data for table `um_group`
-- 

INSERT INTO `um_group` VALUES (1, 'Admin');
INSERT INTO `um_group` VALUES (2, 'Employee');
INSERT INTO `um_group` VALUES (3, 'Computer Operator');
INSERT INTO `um_group` VALUES (4, 'Students');

-- --------------------------------------------------------

-- 
-- Table structure for table `um_menu`
-- 

CREATE TABLE `um_menu` (
  `menu_id` int(11) NOT NULL auto_increment,
  `menu_name` varchar(50) NOT NULL,
  `menu_url` varchar(100) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `menu_main` tinyint(1) NOT NULL,
  `menu_order` int(11) default NULL,
  PRIMARY KEY  (`menu_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=38 ;

-- 
-- Dumping data for table `um_menu`
-- 

INSERT INTO `um_menu` VALUES (1, 'Users', '', 0, 1, 2);
INSERT INTO `um_menu` VALUES (2, 'Add / View Users', 'index.php?folder=users&page=add_user', 1, 1, NULL);
INSERT INTO `um_menu` VALUES (4, 'Employees', '', 0, 1, 1);
INSERT INTO `um_menu` VALUES (5, 'Add Employee', 'index.php?folder=employees&page=add_employees', 4, 1, NULL);
INSERT INTO `um_menu` VALUES (6, 'Employees List', 'index.php?folder=employees&page=view_employees', 4, 1, NULL);
INSERT INTO `um_menu` VALUES (7, 'Students', '', 0, 1, 4);
INSERT INTO `um_menu` VALUES (8, 'Add Student', 'index.php?folder=students&page=add_student', 7, 1, NULL);
INSERT INTO `um_menu` VALUES (9, 'Students List', 'index.php?folder=students&page=view_students', 7, 1, NULL);
INSERT INTO `um_menu` VALUES (12, 'Courses & Ledger', '', 0, 1, 3);
INSERT INTO `um_menu` VALUES (13, 'Main Courses', 'index.php?folder=courses&page=add_main_courses', 12, 1, NULL);
INSERT INTO `um_menu` VALUES (14, 'Sub Courses', 'index.php?folder=courses&page=add_sub_courses', 12, 1, NULL);
INSERT INTO `um_menu` VALUES (16, 'Generals', '', 0, 1, 7);
INSERT INTO `um_menu` VALUES (18, 'Class Code', 'index.php?folder=courses&page=add_class_code', 12, 1, NULL);
INSERT INTO `um_menu` VALUES (20, 'Add / View Groups', 'index.php?folder=users&page=add_group', 16, 1, NULL);
INSERT INTO `um_menu` VALUES (23, 'Questions Bank', '', 0, 1, 5);
INSERT INTO `um_menu` VALUES (24, 'Add Question', 'index.php?folder=questions&page=add_question', 23, 1, NULL);
INSERT INTO `um_menu` VALUES (25, 'View Questions', 'index.php?folder=questions&page=all_questions', 23, 1, NULL);
INSERT INTO `um_menu` VALUES (27, 'Exam Master', '', 0, 1, 6);
INSERT INTO `um_menu` VALUES (28, 'Add Exam', 'index.php?folder=questions&page=exam_master', 27, 1, NULL);
INSERT INTO `um_menu` VALUES (29, 'Exam Reports', 'index.php?folder=questions&page=exam_report', 27, 1, NULL);
INSERT INTO `um_menu` VALUES (30, 'Add / View Category', 'index.php?folder=generals&page=add_category', 23, 1, NULL);
INSERT INTO `um_menu` VALUES (31, 'Database Backup', 'index.php?folder=menu&page=db_backup', 16, 1, NULL);
INSERT INTO `um_menu` VALUES (32, 'Add/View Nationality', 'index.php?folder=generals&page=add_nationality', 16, 1, NULL);
INSERT INTO `um_menu` VALUES (33, 'Add / View Religion', 'index.php?folder=generals&page=add_religion', 16, 1, NULL);
INSERT INTO `um_menu` VALUES (34, 'Mail Settings', '', 0, 1, 8);
INSERT INTO `um_menu` VALUES (35, 'Mail Form', 'index.php?folder=mails&page=mail_form', 34, 1, NULL);
INSERT INTO `um_menu` VALUES (36, 'Fee Structure', 'index.php?folder=courses&page=add_ledger', 12, 1, 4);
INSERT INTO `um_menu` VALUES (37, 'Allowance', 'index.php?folder=generals&page=add_allowance', 4, 1, 3);

-- --------------------------------------------------------

-- 
-- Table structure for table `um_permission`
-- 

CREATE TABLE `um_permission` (
  `permission_id` int(11) NOT NULL auto_increment,
  `group_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `permission_read` tinyint(1) NOT NULL,
  `permission_update` tinyint(1) NOT NULL,
  PRIMARY KEY  (`permission_id`),
  KEY `FK_um_permission_group_id` (`group_id`),
  KEY `FK_um_permission_menu_id` (`menu_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=477 ;

-- 
-- Dumping data for table `um_permission`
-- 

INSERT INTO `um_permission` VALUES (380, 2, 1, 0, 0);
INSERT INTO `um_permission` VALUES (381, 2, 2, 0, 0);
INSERT INTO `um_permission` VALUES (382, 2, 4, 1, 0);
INSERT INTO `um_permission` VALUES (383, 2, 5, 1, 1);
INSERT INTO `um_permission` VALUES (384, 2, 6, 1, 1);
INSERT INTO `um_permission` VALUES (385, 2, 7, 1, 0);
INSERT INTO `um_permission` VALUES (386, 2, 8, 1, 1);
INSERT INTO `um_permission` VALUES (387, 2, 9, 1, 1);
INSERT INTO `um_permission` VALUES (388, 2, 12, 1, 0);
INSERT INTO `um_permission` VALUES (389, 2, 13, 1, 1);
INSERT INTO `um_permission` VALUES (390, 2, 14, 1, 1);
INSERT INTO `um_permission` VALUES (391, 2, 16, 0, 0);
INSERT INTO `um_permission` VALUES (393, 2, 18, 1, 1);
INSERT INTO `um_permission` VALUES (394, 2, 20, 0, 0);
INSERT INTO `um_permission` VALUES (395, 2, 23, 1, 0);
INSERT INTO `um_permission` VALUES (396, 2, 24, 0, 0);
INSERT INTO `um_permission` VALUES (397, 2, 25, 0, 0);
INSERT INTO `um_permission` VALUES (398, 2, 27, 0, 0);
INSERT INTO `um_permission` VALUES (399, 2, 28, 0, 0);
INSERT INTO `um_permission` VALUES (400, 2, 29, 0, 0);
INSERT INTO `um_permission` VALUES (401, 2, 30, 1, 1);
INSERT INTO `um_permission` VALUES (402, 3, 1, 0, 0);
INSERT INTO `um_permission` VALUES (403, 3, 2, 0, 0);
INSERT INTO `um_permission` VALUES (404, 3, 4, 0, 0);
INSERT INTO `um_permission` VALUES (405, 3, 5, 0, 0);
INSERT INTO `um_permission` VALUES (406, 3, 6, 0, 0);
INSERT INTO `um_permission` VALUES (407, 3, 7, 0, 0);
INSERT INTO `um_permission` VALUES (408, 3, 8, 0, 0);
INSERT INTO `um_permission` VALUES (409, 3, 9, 0, 0);
INSERT INTO `um_permission` VALUES (410, 3, 12, 0, 0);
INSERT INTO `um_permission` VALUES (411, 3, 13, 0, 0);
INSERT INTO `um_permission` VALUES (412, 3, 14, 0, 0);
INSERT INTO `um_permission` VALUES (413, 3, 16, 0, 0);
INSERT INTO `um_permission` VALUES (415, 3, 18, 0, 0);
INSERT INTO `um_permission` VALUES (416, 3, 20, 0, 0);
INSERT INTO `um_permission` VALUES (417, 3, 23, 1, 0);
INSERT INTO `um_permission` VALUES (418, 3, 24, 1, 0);
INSERT INTO `um_permission` VALUES (419, 3, 25, 1, 0);
INSERT INTO `um_permission` VALUES (420, 3, 27, 0, 0);
INSERT INTO `um_permission` VALUES (421, 3, 28, 0, 0);
INSERT INTO `um_permission` VALUES (422, 3, 29, 0, 0);
INSERT INTO `um_permission` VALUES (423, 3, 30, 1, 0);
INSERT INTO `um_permission` VALUES (424, 3, 31, 0, 0);
INSERT INTO `um_permission` VALUES (451, 4, 1, 0, 0);
INSERT INTO `um_permission` VALUES (452, 4, 2, 0, 0);
INSERT INTO `um_permission` VALUES (453, 4, 4, 0, 0);
INSERT INTO `um_permission` VALUES (454, 4, 5, 0, 0);
INSERT INTO `um_permission` VALUES (455, 4, 6, 0, 0);
INSERT INTO `um_permission` VALUES (456, 4, 7, 1, 0);
INSERT INTO `um_permission` VALUES (457, 4, 8, 1, 1);
INSERT INTO `um_permission` VALUES (458, 4, 9, 0, 0);
INSERT INTO `um_permission` VALUES (459, 4, 12, 0, 0);
INSERT INTO `um_permission` VALUES (460, 4, 13, 0, 0);
INSERT INTO `um_permission` VALUES (461, 4, 14, 0, 0);
INSERT INTO `um_permission` VALUES (462, 4, 16, 0, 0);
INSERT INTO `um_permission` VALUES (463, 4, 18, 0, 0);
INSERT INTO `um_permission` VALUES (464, 4, 20, 0, 0);
INSERT INTO `um_permission` VALUES (465, 4, 23, 0, 0);
INSERT INTO `um_permission` VALUES (466, 4, 24, 0, 0);
INSERT INTO `um_permission` VALUES (467, 4, 25, 0, 0);
INSERT INTO `um_permission` VALUES (468, 4, 27, 0, 0);
INSERT INTO `um_permission` VALUES (469, 4, 28, 0, 0);
INSERT INTO `um_permission` VALUES (470, 4, 29, 0, 0);
INSERT INTO `um_permission` VALUES (471, 4, 30, 0, 0);
INSERT INTO `um_permission` VALUES (472, 4, 31, 0, 0);
INSERT INTO `um_permission` VALUES (473, 4, 32, 0, 0);
INSERT INTO `um_permission` VALUES (474, 4, 33, 0, 0);
INSERT INTO `um_permission` VALUES (475, 4, 34, 0, 0);
INSERT INTO `um_permission` VALUES (476, 4, 35, 0, 0);

-- 
-- Constraints for dumped tables
-- 

-- 
-- Constraints for table `class_code`
-- 
ALTER TABLE `class_code`
  ADD CONSTRAINT `FK_class_code_emp` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`emp_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_class_code_scid` FOREIGN KEY (`scid`) REFERENCES `sub_courses` (`scid`) ON UPDATE CASCADE;

-- 
-- Constraints for table `exam_master`
-- 
ALTER TABLE `exam_master`
  ADD CONSTRAINT `FK_exam_master_cat_id` FOREIGN KEY (`cat_id`) REFERENCES `category` (`cat_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_exam_master_ccid` FOREIGN KEY (`ccid`) REFERENCES `class_code` (`ccid`) ON UPDATE CASCADE;

-- 
-- Constraints for table `login`
-- 
ALTER TABLE `login`
  ADD CONSTRAINT `FK_login_emp_id` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`emp_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_login_group_id` FOREIGN KEY (`group_id`) REFERENCES `um_group` (`group_id`) ON UPDATE CASCADE;

-- 
-- Constraints for table `question_bank`
-- 
ALTER TABLE `question_bank`
  ADD CONSTRAINT `FK_question_bank_cat_id` FOREIGN KEY (`cat_id`) REFERENCES `category` (`cat_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_question_bank_scid` FOREIGN KEY (`scid`) REFERENCES `sub_courses` (`scid`) ON UPDATE CASCADE;

-- 
-- Constraints for table `question_bank_options`
-- 
ALTER TABLE `question_bank_options`
  ADD CONSTRAINT `FK_question_bank_options_ques_id` FOREIGN KEY (`ques_id`) REFERENCES `question_bank` (`ques_id`) ON UPDATE CASCADE;

-- 
-- Constraints for table `question_paper`
-- 
ALTER TABLE `question_paper`
  ADD CONSTRAINT `FK_question_paper_em_id` FOREIGN KEY (`em_id`) REFERENCES `exam_master` (`em_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_question_paper_ques_id` FOREIGN KEY (`ques_id`) REFERENCES `question_bank` (`ques_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_question_paper_student_id` FOREIGN KEY (`student_id`) REFERENCES `student_info` (`student_id`) ON UPDATE CASCADE;

-- 
-- Constraints for table `student_academic_record`
-- 
ALTER TABLE `student_academic_record`
  ADD CONSTRAINT `FK_student_academic_record_student_id` FOREIGN KEY (`student_id`) REFERENCES `student_info` (`student_id`) ON UPDATE CASCADE;

-- 
-- Constraints for table `student_course_detail`
-- 
ALTER TABLE `student_course_detail`
  ADD CONSTRAINT `FK_student_course_detail_ccid` FOREIGN KEY (`ccid`) REFERENCES `class_code` (`ccid`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_student_course_detail_student_id` FOREIGN KEY (`student_id`) REFERENCES `student_info` (`student_id`) ON UPDATE CASCADE;

-- 
-- Constraints for table `student_info`
-- 
ALTER TABLE `student_info`
  ADD CONSTRAINT `FK_student_info_nat_id` FOREIGN KEY (`nat_id`) REFERENCES `nationality` (`nat_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_student_info_rel_id` FOREIGN KEY (`rel_id`) REFERENCES `religion` (`rel_id`) ON UPDATE CASCADE;

-- 
-- Constraints for table `student_ledger`
-- 
ALTER TABLE `student_ledger`
  ADD CONSTRAINT `FK_student_ledger` FOREIGN KEY (`scd_id`) REFERENCES `student_course_detail` (`scd_id`) ON UPDATE CASCADE;

-- 
-- Constraints for table `sub_courses`
-- 
ALTER TABLE `sub_courses`
  ADD CONSTRAINT `FK_sub_courses_mcid` FOREIGN KEY (`mcid`) REFERENCES `main_courses` (`mcid`) ON UPDATE CASCADE;

-- 
-- Constraints for table `um_permission`
-- 
ALTER TABLE `um_permission`
  ADD CONSTRAINT `FK_um_permission_group_id` FOREIGN KEY (`group_id`) REFERENCES `um_group` (`group_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_um_permission_menu_id` FOREIGN KEY (`menu_id`) REFERENCES `um_menu` (`menu_id`) ON UPDATE CASCADE;
