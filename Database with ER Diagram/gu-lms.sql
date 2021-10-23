-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 24, 2021 at 12:47 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gu-lms`
--

-- --------------------------------------------------------

--
-- Table structure for table `assignments`
--

CREATE TABLE `assignments` (
  `as_id` int(11) NOT NULL,
  `ma_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `full_mark` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `correct_answers`
--

CREATE TABLE `correct_answers` (
  `ca_id` int(11) NOT NULL,
  `qu_id` int(11) NOT NULL,
  `correct_answer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `co_id` int(11) NOT NULL,
  `co_name` varchar(255) NOT NULL,
  `dep_id` int(11) NOT NULL,
  `sem_id` int(11) NOT NULL,
  `credit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`co_id`, `co_name`, `dep_id`, `sem_id`, `credit`) VALUES
(1, 'English for Civil Engineering', 5, 8, 4),
(2, 'phezic', 5, 8, 4),
(3, 'Steel Design 1', 5, 8, 3),
(4, 'Computer Basics', 5, 1, 2),
(5, 'Masonry Structures', 5, 6, 3),
(6, 'Project Design', 5, 8, 6),
(7, 'Project Design', 5, 8, 6),
(8, 'Transportation', 5, 8, 2),
(9, 'Strength of Materials 2', 5, 8, 2),
(10, 'fluid mechanics', 5, 8, 2),
(11, 'eng teaching earthquake', 5, 8, 3),
(12, 'Surveying', 5, 8, 2),
(13, 'Coding progranning computer', 5, 8, 3),
(14, 'geology', 5, 1, 2),
(15, 'Drawing', 5, 1, 2),
(16, 'islamic study', 5, 2, 2),
(17, 'Coding progranning computer', 5, 8, 3),
(18, 'Math 2', 5, 2, 4),
(19, 'Design Steel', 5, 5, 3),
(20, 'Mathe', 5, 2, 4),
(21, 'project dezinc', 5, 7, 8),
(22, 'Geology', 5, 1, 2),
(23, 'project dezinc', 5, 6, 8),
(24, 'Peace', 5, 7, 2),
(25, 'Hydraulics Structures', 5, 7, 2),
(26, 'Road Engineering', 5, 5, 3),
(27, 'Environment', 5, 7, 2),
(28, 'Engineering basics', 5, 1, 2),
(29, 'Survey 2', 5, 4, 3),
(30, 'Survey 1', 5, 3, 3),
(31, 'Air Port Engineering', 5, 8, 2),
(32, 'Soil Mechanics 2', 5, 8, 2),
(33, 'Building Maintenang & Repair', 5, 8, 2),
(34, 'Project Design', 5, 8, 6),
(35, 'Peace', 5, 8, 2),
(36, 'Hydraulics Structures', 5, 8, 2),
(37, 'Tunnel Engineering', 5, 7, 2),
(38, 'Mechanical & Electrical Equepment', 5, 8, 2),
(39, 'Engineering System', 5, 7, 2),
(40, 'Engineering Economy', 5, 7, 2),
(41, 'Afghanistan History', 5, 7, 2),
(42, 'Construction Methods', 5, 7, 2),
(43, 'Water supply & waste water', 5, 7, 3),
(44, 'Masonry Structures', 5, 7, 2),
(45, 'Foundation Design', 5, 7, 3),
(46, 'Project Management', 5, 7, 3),
(47, 'Pavement Design', 5, 6, 2),
(48, 'Application of Computer for Civil Engineering', 5, 6, 2),
(49, 'Structural Loads', 5, 6, 2),
(50, 'Concrete Design 2', 5, 6, 3),
(51, 'Steel Design 1', 5, 6, 3),
(52, 'Hydraulics', 5, 6, 2),
(53, 'Earthquake', 5, 6, 3),
(54, 'Writing Method', 5, 6, 2),
(55, 'Transportation', 5, 5, 2),
(56, 'Project Estimation', 5, 5, 2),
(57, 'Hydrology', 5, 5, 2),
(58, 'Construction Machinery', 5, 5, 2),
(59, 'Structural Analysis 2', 5, 5, 3),
(60, 'Steel Design 1', 5, 5, 3),
(61, 'Concrete Design 1', 5, 5, 3),
(62, 'English for Civil Engineering', 5, 5, 4),
(63, 'Fluid Mechanics', 5, 4, 3),
(64, 'Islamic Culture2', 5, 4, 2),
(65, 'Differential Equation', 5, 4, 3),
(66, 'Structural Analysis 1', 5, 4, 3),
(67, 'Soil Mechanics', 5, 4, 4),
(68, 'Strength of Materials 2', 5, 4, 2),
(69, 'Thechnology of Concrete', 5, 4, 2),
(70, 'Research Methodology', 5, 4, 2),
(71, 'Strength of Materials 1', 5, 3, 3),
(72, 'Architectural Design', 5, 3, 2),
(73, 'Dynamics', 5, 3, 3),
(74, 'Surveying', 5, 3, 2),
(75, 'Mathematics 3', 5, 3, 4),
(76, 'Physics 3', 5, 3, 4),
(77, 'Programing', 5, 3, 3),
(78, 'Computer Basics', 5, 2, 2),
(79, 'Physics 2', 5, 2, 4),
(80, 'Mathematics 2', 5, 2, 4),
(81, 'English2', 5, 2, 4),
(82, 'Statics', 5, 2, 3),
(83, 'Construction Materials', 5, 2, 2),
(84, 'Drawing', 5, 1, 2),
(85, 'Physics (1)', 5, 1, 4),
(86, 'General Mathematics (1)', 5, 1, 4),
(87, 'English (1)', 5, 1, 4),
(88, 'geology', 5, 1, 2),
(89, 'Islamic studies (1)', 5, 1, 2),
(90, 'Writing Method', 5, 7, 2),
(91, 'Project Design', 5, 0, 6),
(92, 'General Chemistry', 5, 1, 2),
(93, 'Principle of Computer (2)', 3, 4, 2),
(94, 'Thesis', 3, 8, 6),
(95, 'Principle of Political Science', 3, 8, 2),
(96, 'Psychology', 3, 8, 3),
(97, 'Research for the Student of Economics', 3, 8, 3),
(98, 'Islamic Banking', 3, 7, 2),
(99, 'Professional Language', 3, 7, 4),
(100, 'Principle of Insurance', 3, 7, 3),
(101, 'Economics Calculation', 3, 7, 4),
(102, 'Principle of Research Methodology', 3, 7, 2),
(103, 'Economic Systems', 3, 7, 2),
(104, 'Principle of Scientific Writing', 3, 6, 2),
(105, 'Public Sector Economics', 3, 6, 3),
(106, 'International Monetary and Financial Organizations', 3, 6, 3),
(107, 'Afghanistan History', 3, 6, 2),
(108, 'International Finance', 3, 6, 3),
(109, 'Development Economics', 3, 6, 3),
(110, 'Afghanistan Economics', 3, 6, 2),
(111, 'Strategic Management', 3, 5, 3),
(112, 'Financial Management (2)', 3, 5, 3),
(113, 'Money, Exchange and Banking', 3, 5, 3),
(114, 'International Trade', 3, 5, 3),
(115, 'Public Sector Economics', 3, 5, 3),
(116, 'Marketing', 3, 5, 3),
(117, 'Organization Behavior Management', 3, 4, 3),
(118, 'Macroeconomics (2)', 3, 4, 4),
(119, 'Accounting (2)', 3, 4, 3),
(120, 'Financial Management (1)', 3, 4, 3),
(121, 'Statistics (2)', 3, 4, 4),
(122, 'Principle of Computer (1)', 3, 3, 2),
(123, 'Macroeconomics (1)', 3, 3, 4),
(124, 'Statistics (1)', 3, 3, 4),
(125, 'Macroeconomic1', 3, 3, 4),
(126, 'Accounting (1)', 3, 3, 3),
(127, 'Democracy', 3, 2, 2),
(128, 'Islamic studies (2)', 3, 2, 2),
(129, 'Math 2', 3, 2, 4),
(130, 'Peace', 3, 2, 2),
(131, 'Industrial Accounting', 3, 2, 3),
(132, 'Macroeconomic1', 3, 2, 4),
(133, 'English (2)', 3, 2, 2),
(134, '(Dari) Literature', 3, 1, 2),
(135, 'English (1)', 3, 1, 2),
(136, 'Human Rights', 3, 1, 2),
(137, 'Principle of Economics', 3, 1, 3),
(138, 'Math 1', 3, 1, 4),
(139, 'Fundamental of Management & Organization', 3, 1, 3),
(140, 'Islamic studies (1)', 3, 1, 2),
(141, 'Islamic Studies 4', 2, 4, 2),
(142, 'Islamic Culture 3', 2, 3, 2),
(143, 'Elective II', 2, 8, 4),
(144, 'Elective I', 2, 7, 3),
(145, 'Project Design', 2, 8, 4),
(146, 'Information Technology Resource Management', 2, 8, 4),
(147, 'Network Secur9y', 2, 8, 4),
(148, 'Project and Research Methodology', 2, 7, 4),
(149, 'Software Engineering', 2, 6, 4),
(150, 'Wireless Networks and Mobile', 2, 7, 4),
(151, 'Advance Network', 2, 7, 4),
(152, 'Web Programming II', 2, 6, 4),
(153, 'ICT Management', 2, 6, 4),
(154, 'Database Management', 2, 6, 4),
(155, 'Network Programming', 2, 6, 4),
(156, 'Network IV', 2, 6, 4),
(157, 'Network III', 2, 5, 4),
(158, 'Network Operating System', 2, 5, 4),
(159, 'Web Programming I', 2, 5, 4),
(160, 'Data Structures and Algor9hms', 2, 5, 4),
(161, 'Operating System', 2, 4, 4),
(162, 'Statistics', 2, 4, 4),
(163, 'Network II', 2, 4, 4),
(164, 'Computer Arch9ecture', 2, 4, 4),
(165, 'English (4)', 2, 4, 2),
(166, 'Business Communication', 2, 3, 1),
(167, 'Network I', 2, 3, 4),
(168, 'Probabil9ies', 2, 3, 4),
(169, 'Fundamental of Programing II', 2, 3, 4),
(170, 'Fundamental of Database', 2, 3, 4),
(171, 'Fundamental of Network', 2, 1, 4),
(172, 'Fundamental of Programming I', 2, 2, 4),
(173, 'Physic II', 2, 2, 3),
(174, 'Discrete Mathematics', 2, 2, 3),
(175, 'Fundamental of Computer II', 2, 2, 4),
(176, 'Physics (1)', 2, 1, 3),
(177, 'General Mathematics (1)', 2, 1, 3),
(178, 'Fundamental of Computer l', 2, 1, 4),
(179, 'Peace Studies', 2, 7, 2),
(180, 'Human Rights', 2, 5, 2),
(181, 'Afghanistan History', 2, 4, 2),
(182, 'English (3)', 2, 3, 2),
(183, 'English II', 2, 2, 2),
(184, 'English (1)', 2, 1, 2),
(185, 'Islamic Culture II', 2, 2, 2),
(186, 'Islamic studies (1)', 2, 1, 2),
(187, 'eslamyat', 6, 1, 1),
(188, 'Islamic Culture (4)', 6, 4, 1),
(189, 'hoqoq madani', 6, 3, 2),
(190, 'Academic practices and academic behavior', 6, 0, 1),
(191, 'hoqoq benolmell omomei', 6, 4, 2),
(192, 'hoqoq benolmell khososi', 6, 5, 2),
(193, 'Evidence Proof', 6, 8, 2),
(194, 'Academic practices and behavior', 6, 1, 1),
(195, '1 Business 1', 6, 0, 2),
(196, 'Islamic Studies (2)', 6, 2, 1),
(197, 'History of Criminal 1', 6, 2, 2),
(198, 'General International 1', 6, 2, 3),
(199, '1 of International Organization', 6, 2, 2),
(200, 'Principles and Fundamental of Democracy', 6, 2, 2),
(201, 'Foreign Language (2)', 6, 2, 2),
(202, 'Fundamentals of Public Economy', 6, 2, 2),
(203, 'Individuals and Insolves', 6, 2, 2),
(204, 'Infringements of children', 6, 8, 2),
(205, 'Philosophy of 1', 6, 5, 2),
(206, 'History of Islam Civilization', 6, 4, 2),
(207, 'Humanitarian 1', 6, 7, 2),
(208, 'English (2)', 6, 0, 2),
(209, 'Principle of Computer (2)', 6, 0, 2),
(210, 'Professsional Text In English (2)', 6, 4, 2),
(211, 'Professsional Text In English (1)', 6, 3, 2),
(212, 'contract', 6, 5, 2),
(213, 'Cyber ??crimes', 6, 5, 2),
(214, 'Islamic Culture (5)', 6, 5, 1),
(215, 'Criminological', 6, 4, 2),
(216, 'Criminal policy', 6, 4, 2),
(217, 'Consumer 1', 6, 2, 2),
(218, 'Ethics and professional conduct', 6, 2, 2),
(219, 'Media 1', 6, 2, 2),
(220, 'Introduction to 1 (2)', 6, 2, 2),
(221, 'Contemporary 1 systems', 6, 2, 3),
(222, 'Legal jurisprudence texts', 6, 2, 2),
(223, 'Principles of jurisprudence', 6, 3, 2),
(224, 'Obligations 1 (2)', 6, 4, 2),
(225, 'History of 1', 6, 1, 2),
(226, 'Rules of jurisprudence', 6, 1, 2),
(227, 'Legal Terminology Arabic', 6, 3, 1),
(228, 'Islamic Culture (3)', 6, 3, 1),
(229, 'Environment 1', 6, 3, 2),
(230, 'Criminology', 6, 3, 2),
(231, 'Principles of 1', 6, 3, 2),
(232, 'Obligations 1 (1)', 6, 3, 2),
(233, 'Criminal Psychology', 6, 0, 2),
(234, 'Fundamentals of Statistic', 6, 0, 2),
(235, 'Islamic Thyme', 6, 1, 1),
(236, 'Criminal 1 of Islam', 6, 1, 2),
(237, 'Fundamentals of Islamic 1', 6, 1, 2),
(238, 'Objective rights', 6, 1, 2),
(239, 'Allah\'s verses', 6, 1, 1),
(240, 'General English (1', 6, 1, 2),
(241, 'Fundamentals of Islamic 1', 6, 1, 2),
(242, 'Vers\'s Ahkam & Arabic Legal Terminology', 6, 0, 2),
(243, 'Thesis', 6, 8, 6),
(244, 'Legal Clinic', 6, 8, 2),
(245, 'Intellectual Property & Insurance 1', 6, 8, 2),
(246, 'Civil rights(8)', 6, 8, 2),
(247, 'Principles of Islamic jurisprudence(2)', 6, 8, 2),
(248, 'Forensic', 6, 7, 2),
(249, 'Human Rights in Islam & Pathology', 6, 7, 2),
(250, 'Specialized research methods', 6, 7, 2),
(251, 'Civil 1(7)', 6, 7, 2),
(252, 'peace', 6, 7, 2),
(253, 'Scientific Police', 6, 7, 2),
(254, 'Criminal Procedure Code(2)', 6, 7, 2),
(255, 'Public Finance', 6, 3, 2),
(256, 'Comparative 1', 6, 6, 2),
(257, 'Rules of jurisprudence(2)', 6, 6, 2),
(258, 'Commercial 1(4)', 6, 6, 2),
(259, 'The Regulation Of Panel Prosecution(1)', 6, 6, 2),
(260, 'Specific criminal 1(3)', 6, 6, 2),
(261, 'Professional Text In English', 6, 6, 2),
(262, 'criminology', 6, 6, 2),
(263, 'principles of civil prosecutions(2)', 6, 6, 2),
(264, 'Civil 1(6)', 6, 6, 2),
(265, 'commercial 1(3)', 6, 5, 2),
(266, 'Administrative 1 (2)', 6, 5, 2),
(267, 'Specialized research methods', 6, 5, 2),
(268, 'Specific Criminal 1(2)', 6, 5, 2),
(269, 'private International 1(2)', 6, 5, 2),
(270, 'Principles of democracy', 6, 5, 2),
(271, 'Civil 1(5)', 6, 5, 2),
(272, 'principles of civil prosecutions(1)', 6, 5, 2),
(273, 'Foundations of Inference right Islam(2)', 6, 5, 2),
(274, 'Afghanistan History', 6, 4, 2),
(275, 'Human Rights', 6, 1, 2),
(276, 'commercial 1(2)', 6, 3, 2),
(277, 'private International 1(1)', 6, 4, 2),
(278, 'Foundations of Inference right Islam(1)', 6, 4, 2),
(279, 'Civil 1(4)', 6, 4, 2),
(280, 'Specific criminal justice(1)', 6, 4, 2),
(281, 'Practical judgment', 6, 7, 2),
(282, 'computer(1)', 6, 4, 2),
(283, 'Administrative 1(1)', 6, 4, 2),
(284, 'computer(1)', 6, 3, 2),
(285, 'International Organization', 6, 3, 2),
(286, 'constitution 1(2)', 6, 3, 2),
(287, 'Civil 1(3)', 6, 3, 2),
(288, 'Vers\'s Ahkam & Arabic legal terminology', 6, 3, 2),
(289, 'Public International 1(2)', 6, 3, 2),
(290, 'General Criminal 1(3)', 6, 3, 2),
(291, 'Academic writing', 6, 3, 2),
(292, 'Labor 1', 6, 3, 2),
(293, 'introduction to economic', 6, 0, 2),
(294, 'public International 1(1)', 6, 0, 2),
(295, 'Commercial 1(1)', 6, 2, 2),
(296, 'General Criminal 1(2)', 6, 0, 2),
(297, 'Principle of Computer (1)', 6, 0, 2),
(298, 'civil rights (2)', 6, 0, 2),
(299, 'Constitution 1(1)', 6, 0, 2),
(300, 'principles of Research', 6, 0, 2),
(301, 'Islamic studies (2)', 6, 0, 2),
(302, 'General Criminal 1(1)', 6, 3, 2),
(303, 'Civil 1 (1)', 6, 1, 2),
(304, 'principle of 1', 6, 1, 2),
(305, 'introduction to sociology', 6, 1, 2),
(306, 'peace', 6, 1, 2),
(307, 'Islamic studies (1)', 6, 1, 2),
(308, 'introduction to political science', 6, 1, 2),
(309, 'English (1)', 6, 1, 2),
(310, 'literature (Dari)', 6, 1, 2),
(311, 'Robotic Engineering', 1, 7, 4),
(312, 'Design of advanced mobile applications', 1, 8, 4),
(313, 'Elective II', 1, 8, 4),
(314, 'Elective I', 1, 7, 4),
(315, 'Project Design', 1, 8, 4),
(316, 'Computer Graphic', 1, 8, 4),
(317, 'Code of Ethics', 1, 8, 2),
(318, 'Project and Research Methodology', 1, 7, 4),
(319, 'Visual Programming', 1, 6, 4),
(320, 'Artificial Intelligence', 1, 7, 4),
(321, 'Theory of Computation', 1, 7, 3),
(322, 'Web Programming II', 1, 6, 4),
(323, 'Algorithm Analysis', 1, 6, 4),
(324, 'Database Programming', 1, 6, 4),
(325, 'Advance 10', 1, 6, 4),
(326, 'Android Programming', 1, 6, 4),
(327, 'Linear Algebra', 1, 5, 2),
(328, 'Web Programming I', 1, 5, 4),
(329, 'Advance Object Oriented Programming', 1, 5, 4),
(330, '10', 1, 5, 4),
(331, 'Data Structures and Algorithms', 1, 5, 4),
(332, 'Operating System', 1, 4, 4),
(333, 'Statistics', 1, 4, 4),
(334, 'Network II', 1, 4, 4),
(335, 'Computer Architecture', 1, 4, 4),
(336, 'English IV', 1, 4, 2),
(337, 'Business Communication', 1, 3, 1),
(338, 'Network I', 1, 3, 4),
(339, 'Probabilities', 1, 3, 4),
(340, 'Java Programming', 1, 3, 4),
(341, 'Fundamental of Database', 1, 3, 4),
(342, 'Fundamental of Network', 1, 2, 4),
(343, 'Fundamental of Programming', 1, 1, 4),
(344, 'Physic II', 1, 2, 3),
(345, 'Discrete Mathematics', 1, 2, 3),
(346, 'Fundamental of Computer II', 1, 2, 4),
(347, 'Physic I', 1, 1, 3),
(348, 'General Mathematics', 1, 1, 3),
(349, 'Fundamental of Computer', 1, 1, 4),
(350, 'Writing Rules', 1, 8, 2),
(351, 'Peace Studies', 1, 7, 2),
(352, 'Human Rights', 1, 5, 2),
(353, 'Contemporary History', 1, 4, 2),
(354, 'English III', 1, 3, 2),
(355, 'English II', 1, 2, 2),
(356, 'English I', 1, 1, 2),
(357, 'Islamic Culture II', 1, 2, 2),
(358, 'Islamic Culture I', 1, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `courses_shifts`
--

CREATE TABLE `courses_shifts` (
  `sh_id` int(11) NOT NULL,
  `sh_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courses_shifts`
--

INSERT INTO `courses_shifts` (`sh_id`, `sh_name`) VALUES
(1, 'Morning'),
(2, 'Afternoon'),
(3, 'Evening');

-- --------------------------------------------------------

--
-- Table structure for table `days`
--

CREATE TABLE `days` (
  `day_id` int(11) NOT NULL,
  `day_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `days`
--

INSERT INTO `days` (`day_id`, `day_name`) VALUES
(1, 'Saturday '),
(2, 'Sunday'),
(3, 'Monday'),
(4, 'Tuesday'),
(5, 'Wednesday'),
(6, 'Thursday'),
(7, 'Friday');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `dep_id` int(11) NOT NULL,
  `dep_name` varchar(255) NOT NULL,
  `dep_code` varchar(2) NOT NULL,
  `set_admin` tinyint(4) DEFAULT NULL,
  `active_set_course` tinyint(4) NOT NULL DEFAULT 0,
  `set_course_done` tinyint(4) NOT NULL DEFAULT 0,
  `course_checked` tinyint(4) NOT NULL DEFAULT 0,
  `fac_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`dep_id`, `dep_name`, `dep_code`, `set_admin`, `active_set_course`, `set_course_done`, `course_checked`, `fac_id`) VALUES
(1, 'Software Engineering', '10', 1, 0, 1, 1, 1),
(2, 'Information Technology', '01', 1, 0, 1, 1, 1),
(3, 'Economic Management', '04', NULL, 0, 0, 0, 2),
(4, 'Business Administration', '05', NULL, 0, 0, 0, 2),
(5, 'Law', '01', 1, 0, 0, 0, 3),
(6, 'Political Science', '02', 1, 0, 0, 0, 3),
(7, 'Software', '11', 1, 0, 0, 0, 4);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `ev_id` int(11) NOT NULL,
  `event_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `faculties`
--

CREATE TABLE `faculties` (
  `fac_id` int(11) NOT NULL,
  `fac_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `faculties`
--

INSERT INTO `faculties` (`fac_id`, `fac_name`) VALUES
(1, 'Computer Science'),
(2, 'Economics and Management'),
(3, 'Law and Political Science'),
(4, 'Computer science');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `materials`
--

CREATE TABLE `materials` (
  `ma_id` int(11) NOT NULL,
  `type` int(4) NOT NULL,
  `co_id` int(11) NOT NULL,
  `sem_id` int(11) DEFAULT NULL,
  `week` int(11) NOT NULL DEFAULT 0,
  `record_id` int(11) NOT NULL,
  `table_name` int(11) NOT NULL,
  `file_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `materials_type`
--

CREATE TABLE `materials_type` (
  `mat_type_id` int(11) NOT NULL,
  `type_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `materials_type`
--

INSERT INTO `materials_type` (`mat_type_id`, `type_name`) VALUES
(1, 'syllabus'),
(2, 'material '),
(3, 'assignment'),
(4, 'student_assignment');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `noti_id` int(11) NOT NULL,
  `message` varchar(255) NOT NULL,
  `event` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`noti_id`, `message`, `event`, `created_at`) VALUES
(39, 'Set Course Activated For You.', 1, '2021-09-26 04:05:21'),
(40, 'Set Course Activated For You.', 1, '2021-09-26 04:05:47'),
(41, 'Software Engineering Done Set Course', 4, '2021-09-26 04:06:22'),
(42, 'New Lecture Added To Physics (1) Course', 2, '2021-09-26 05:48:30'),
(43, 'New Assignment Added To Physics (1) Course', 3, '2021-09-26 05:50:01'),
(44, 'Set Course Activated For You.', 1, '2021-09-26 06:58:55'),
(45, 'Set Course Activated For You.', 1, '2021-09-26 07:26:39'),
(46, 'Software Engineering Done Set Course', 4, '2021-09-26 07:28:20'),
(47, 'New Lecture Added To Physics (1) Course', 2, '2021-09-26 09:22:57'),
(48, 'New Assignment Added To Physics (1) Course', 3, '2021-09-26 09:23:55'),
(49, 'New Lecture Added To Fundamental of Network Course', 2, '2021-09-30 11:37:34'),
(50, 'New Assignment Added To Physics (1) Course', 3, '2021-10-10 00:09:13');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `period_years`
--

CREATE TABLE `period_years` (
  `log_id` int(11) NOT NULL,
  `period` tinyint(4) NOT NULL COMMENT '1 Spring, 2 Fall ',
  `year` int(11) NOT NULL,
  `semester_start_date` date NOT NULL,
  `semester_end_date` date DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `deleted` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `period_years`
--

INSERT INTO `period_years` (`log_id`, `period`, `year`, `semester_start_date`, `semester_end_date`, `status`, `deleted`) VALUES
(1, 1, 1400, '1400-07-03', NULL, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `per_id` int(11) NOT NULL,
  `per_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`per_id`, `per_name`) VALUES
(1, 'add-course'),
(2, 'view-course'),
(3, 'edit-course'),
(4, 'delete-course'),
(5, 'search-course'),
(6, 'course-as-department'),
(7, 'set-course'),
(8, 'active-set-course-view'),
(9, 'approve-course'),
(10, 'dismiss-course'),
(11, 'approve-course-view'),
(12, 'check-courses'),
(13, 'add-teacher'),
(14, 'view-teachers'),
(15, 'edit-teacher'),
(16, 'delete-teacher'),
(17, 'teacher-info'),
(18, 'make-teacher-account'),
(19, 'add-student'),
(20, 'view-students'),
(21, 'edit-student'),
(22, 'delete-student'),
(23, 'view-student-info'),
(24, 'make-student-account'),
(25, 'add-faculty'),
(26, 'view-faculties'),
(27, 'edit-faculty'),
(28, 'delete-faculty'),
(29, 'add-department'),
(30, 'view-department'),
(31, 'edit-department'),
(32, 'delete-department'),
(33, 'set-admin'),
(34, 'add-staff'),
(35, 'view-staffs'),
(36, 'edit-staff'),
(37, 'delete-staff'),
(38, 'staff-info'),
(39, 'make-staff-account'),
(40, 'add-position'),
(41, 'view-positions'),
(42, 'edit-position'),
(43, 'delete-position'),
(44, 'add-year-period'),
(45, 'view-year-periods'),
(46, 'edit-year-period'),
(47, 'delete-year-period'),
(48, 'add-role'),
(49, 'view-roles'),
(50, 'edit-role'),
(51, 'delete-role'),
(52, 'add-user'),
(53, 'view-users'),
(54, 'edit-user'),
(55, 'delete-user'),
(56, 'teacher-courses'),
(57, 'student_select_credits'),
(58, 'students_credit_list'),
(59, 'student-courses'),
(60, 'add_syllabus'),
(61, 'delete_syllabus'),
(62, 'add_material'),
(63, 'delete_material'),
(64, 'delete_assignment'),
(65, 'view_details_assignment'),
(66, 'add_assignment'),
(67, 'student_add_assignment');

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `position_id` int(11) NOT NULL,
  `position_name` varchar(64) NOT NULL,
  `position_type_id` int(11) NOT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`position_id`, `position_name`, `position_type_id`, `description`) VALUES
(1, 'Super Admin', 1, NULL),
(2, 'Head of Department', 1, NULL),
(4, 'Staff', 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `position_types`
--

CREATE TABLE `position_types` (
  `position_type_id` int(11) NOT NULL,
  `position_type_name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `position_types`
--

INSERT INTO `position_types` (`position_type_id`, `position_type_name`) VALUES
(1, 'Head of Department'),
(2, 'Staff');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `qu_id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `score` int(11) NOT NULL,
  `type` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `question_answers`
--

CREATE TABLE `question_answers` (
  `qa_id` int(11) NOT NULL,
  `answer` varchar(255) NOT NULL,
  `qu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(255) NOT NULL,
  `role_type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`, `role_type_id`) VALUES
(1, 'Super Admin', 1),
(2, 'Admin', 2),
(3, 'Teacher', 3),
(4, 'Student', 4),
(5, 'Staff', 5);

-- --------------------------------------------------------

--
-- Table structure for table `roles_permissions`
--

CREATE TABLE `roles_permissions` (
  `rp_id` int(11) NOT NULL,
  `roles_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roles_permissions`
--

INSERT INTO `roles_permissions` (`rp_id`, `roles_id`, `permission_id`) VALUES
(3, 2, 1),
(53, 2, 6),
(54, 2, 7),
(60, 2, 14),
(63, 2, 17),
(67, 1, 2),
(70, 1, 5),
(90, 1, 25),
(91, 1, 26),
(92, 1, 27),
(93, 1, 28),
(94, 1, 29),
(95, 1, 30),
(96, 1, 31),
(98, 1, 33),
(99, 1, 34),
(100, 1, 35),
(101, 1, 36),
(102, 1, 37),
(103, 1, 38),
(104, 1, 39),
(105, 1, 40),
(106, 1, 41),
(107, 1, 42),
(108, 1, 43),
(109, 1, 44),
(110, 1, 45),
(111, 1, 46),
(112, 1, 47),
(113, 1, 48),
(123, 1, 3),
(124, 1, 4),
(126, 1, 8),
(127, 1, 9),
(128, 1, 10),
(129, 1, 11),
(130, 1, 12),
(131, 2, 15),
(132, 2, 16),
(133, 5, 19),
(134, 5, 20),
(135, 5, 21),
(136, 5, 22),
(137, 5, 23),
(147, 1, 50),
(148, 1, 51),
(149, 1, 49),
(150, 1, 52),
(151, 1, 53),
(152, 1, 54),
(153, 1, 55),
(154, 2, 18),
(155, 5, 24),
(156, 3, 56),
(157, 2, 13),
(159, 4, 57),
(160, 2, 58),
(161, 4, 59),
(163, 3, 60),
(164, 3, 61),
(165, 3, 62),
(166, 3, 63),
(167, 3, 64),
(168, 3, 65),
(169, 3, 66),
(170, 4, 67),
(171, 2, 2),
(172, 2, 5);

-- --------------------------------------------------------

--
-- Table structure for table `role_types`
--

CREATE TABLE `role_types` (
  `role_type_id` int(11) NOT NULL,
  `type` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role_types`
--

INSERT INTO `role_types` (`role_type_id`, `type`) VALUES
(1, 'Show For SuperAdmin'),
(2, 'Show For Admin'),
(3, 'Show For Teacher'),
(4, 'Show For Student'),
(5, 'Show For Staff');

-- --------------------------------------------------------

--
-- Table structure for table `semesters`
--

CREATE TABLE `semesters` (
  `sem_id` int(11) NOT NULL,
  `sem_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `semesters`
--

INSERT INTO `semesters` (`sem_id`, `sem_name`) VALUES
(1, 'Semester 1'),
(2, 'Semester 2'),
(3, 'Semester 3'),
(4, 'Semester 4'),
(5, 'Semester 5'),
(6, 'Semester 6'),
(7, 'Semester 7'),
(8, 'Semester 8');

-- --------------------------------------------------------

--
-- Table structure for table `staffs`
--

CREATE TABLE `staffs` (
  `staff_id` int(11) NOT NULL,
  `unique_id` int(11) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `father_name` varchar(64) DEFAULT NULL,
  `tazkira_id` int(11) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `education` tinyint(4) DEFAULT NULL,
  `gender` tinyint(4) DEFAULT NULL,
  `position_id` int(11) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `dep_id` int(11) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `staffs`
--

INSERT INTO `staffs` (`staff_id`, `unique_id`, `first_name`, `last_name`, `father_name`, `tazkira_id`, `date_of_birth`, `education`, `gender`, `position_id`, `phone`, `email`, `dep_id`, `photo`) VALUES
(1, 141700001, 'Hussain', 'Rasuli', NULL, NULL, NULL, NULL, 1, 1, NULL, 'hussainrasuli22@gmail.com', 70, NULL),
(2, 142700002, 'Bahman', 'Razaie', 'Ali Jan', 939838, '1996-09-01', 1, 1, 4, '0790304843', 'bahmanrazaie@gmail.com', 70, 'BDIkW2YjpEetlhNegX75NWvrZObO1OW9pkSa8yeW.jpg'),
(3, 142100005, 'Abdul Rashid', 'Ahmadi', 'Naser', 494994, '1990-09-01', 1, 1, 2, '0790304848', 'abdulrashidahmadi@gmail.com', 1, 'eZVSadNu2jcw1ChTdOL1guhoGLOfEaYa55JEQ0XF.jpg'),
(4, 142700004, 'Farkhonda', 'Mohsini', 'Taha', 499494, '1996-09-01', 2, 2, 2, '0209030484', 'farkhondamohsini@gmail.com', 2, 'UbRoz9XLAwaNJaVp5Xif6rjOqrs2g5qVJLtnHS7M.jpg'),
(5, 141110022, 'Ali sina', 'Salimi', 'Taha', 49494, '2021-09-22', 2, 1, 2, '0790304844', 'ali_sina@gmail.com', 7, '29CLMiYrJpceO3Ub3yt3nvUBBUuwR8s2szr0nrL4.jpg'),
(6, 142020018, 'Mahdi', 'Soltani', 'Taha', 4544333, '2021-09-22', 2, 1, 2, '0790304843', 'mahdi_soltani@gmail.com', 6, 'W90XyU1wjVx7HzvEEtFQeVkOdk6fg6QRm1Cf9lWo.jpg'),
(7, 142010017, 'Hasan', 'Rasuli', 'Yosouf Ali', 34343, '2021-09-22', 2, 1, 2, '0782389093', 'hasan_rasuli22@gmail.com', 5, 'OmxDNEMVOvLGFDPa9FUgqlaGBuGqdk0qslSpp7zI.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `stu_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `father_name` varchar(64) NOT NULL,
  `date_of_birth` date NOT NULL,
  `tazkira_id` int(11) NOT NULL,
  `gender` tinyint(4) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `faculty_id` int(11) NOT NULL,
  `dep_id` int(11) NOT NULL,
  `semester_id` int(11) NOT NULL,
  `shift_id` int(11) NOT NULL,
  `unique_id` int(11) DEFAULT NULL,
  `active_select_credit` tinyint(4) DEFAULT 0,
  `select_credit` tinyint(1) DEFAULT 0,
  `admin_approve_credits` tinyint(4) NOT NULL DEFAULT 0,
  `photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`stu_id`, `first_name`, `last_name`, `father_name`, `date_of_birth`, `tazkira_id`, `gender`, `email`, `phone`, `faculty_id`, `dep_id`, `semester_id`, `shift_id`, `unique_id`, `active_select_credit`, `select_credit`, `admin_approve_credits`, `photo`) VALUES
(1, 'Ali', 'Karimi', 'taha', '2021-09-02', 847883, 1, 'alikarimi@gmail.com', '0782389093', 1, 1, 1, 1, 142100009, 0, 1, 1, 'J35Ak0fYEQu30nq5BPmWoLycZe3U1psR6D6iSKoi.jpg'),
(2, 'Farid', 'Nazari', 'taha', '2021-09-22', 449949, 1, 'farid_nazari@gmail.com', '0790303991', 1, 2, 1, 1, 142010010, 0, 1, 1, 'N6hTJvJcQznSCQEB8UNfMM1R64S7j6dzawdprXwn.jpg'),
(4, 'Zia', 'Mohammadi', 'taha', '2021-09-22', 94944, 1, 'zia_mohammdi@gmail.com', '0790303991', 1, 1, 8, 1, 142100011, 0, 1, 1, 'aq8MzFFftohM5kN7G8tcp5wA5y9EMES82TxxGTC2.jpg'),
(5, 'Mohammad Jalal', 'Shojaie', 'Taha', '2021-09-22', 34344, 1, 'jalal_shojaie@gmail.com', '0790304843', 3, 5, 3, 1, 142010021, 0, 0, 0, 'EylYtX2QSjzzuLzG3YXa6LH6uXSdavRkw8jyd4FT.jpg'),
(6, 'Hasib', 'Mohammadi', 'Taha', '2021-09-22', 343443, 1, 'hasib_mohammadi@gmail.com', '0209030484', 3, 6, 2, 2, 142020020, 0, 0, 0, NULL),
(7, 'Taha', 'Mohaqqeq', 'Hussain', '2021-09-22', 445454, 1, 'taha_mohaqqeq@gmail.com', '0790304845', 3, 5, 1, 1, 142010019, 0, 0, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `students_assignments`
--

CREATE TABLE `students_assignments` (
  `sg_id` int(11) NOT NULL,
  `stu_id` int(11) NOT NULL,
  `assignment_id` int(11) NOT NULL,
  `ma_id` int(11) NOT NULL,
  `mark` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT 0,
  `description` text DEFAULT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students_assignments`
--

INSERT INTO `students_assignments` (`sg_id`, `stu_id`, `assignment_id`, `ma_id`, `mark`, `status`, `description`, `created_at`) VALUES
(2, 1, 3, 11, 2, 1, 'asdsad', '1400-07-04'),
(3, 1, 7, 21, NULL, 0, NULL, '1400-07-04'),
(4, 1, 6, 23, 2, 1, 'well done', '1400-07-04'),
(5, 1, 8, 26, 5, 1, 'well done', '1400-07-04');

-- --------------------------------------------------------

--
-- Table structure for table `students_courses`
--

CREATE TABLE `students_courses` (
  `sc_id` int(11) NOT NULL,
  `stu_id` int(11) NOT NULL,
  `tc_id` int(11) NOT NULL,
  `relevant_semester` int(11) NOT NULL,
  `approve` tinyint(4) DEFAULT 0,
  `seen` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students_courses`
--

INSERT INTO `students_courses` (`sc_id`, `stu_id`, `tc_id`, `relevant_semester`, `approve`, `seen`) VALUES
(1, 2, 22, 1, 1, 1),
(2, 2, 23, 1, 1, 1),
(3, 2, 24, 1, 1, 1),
(4, 2, 25, 1, 1, 1),
(5, 2, 26, 1, 0, 1),
(6, 2, 27, 1, 1, 1),
(7, 2, 29, 1, 0, 1),
(8, 4, 43, 8, 1, 1),
(9, 4, 3, 8, 0, 1),
(10, 4, 5, 8, 0, 1),
(11, 1, 22, 1, 1, 1),
(12, 1, 23, 1, 1, 1),
(13, 1, 24, 1, 1, 1),
(14, 1, 25, 1, 1, 1),
(15, 1, 26, 1, 1, 1),
(16, 1, 27, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `table_names`
--

CREATE TABLE `table_names` (
  `tb_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `table_names`
--

INSERT INTO `table_names` (`tb_id`, `name`) VALUES
(1, 'Teacher'),
(2, 'Student'),
(3, 'Staff');

-- --------------------------------------------------------

--
-- Table structure for table `taken_answers`
--

CREATE TABLE `taken_answers` (
  `ta_id` int(11) NOT NULL,
  `stu_id` int(11) NOT NULL,
  `qu_id` int(11) NOT NULL,
  `taken_answer` int(11) NOT NULL,
  `score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `tea_id` int(11) NOT NULL,
  `unique_id` int(11) DEFAULT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `father_name` varchar(255) NOT NULL,
  `id_card_number` bigint(20) NOT NULL,
  `date_of_birth` date NOT NULL,
  `education` tinyint(4) NOT NULL,
  `gender` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `dep_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`tea_id`, `unique_id`, `first_name`, `last_name`, `father_name`, `id_card_number`, `date_of_birth`, `education`, `gender`, `email`, `phone`, `photo`, `dep_id`) VALUES
(2, 142100006, 'Mohmmad Arif', 'Arfan', 'Taha', 449383, '2021-09-01', 2, 1, 'mohmmad_arif@gmail.com', '0790304843', NULL, 1),
(3, 142100007, 'Mohammad Arif', 'Paynda', 'Taha', 949944, '2021-09-22', 2, 1, 'arifPaynda@gmail.com', '0782389093', '1oGoo7z3CkDk2V9qcyKSaEFQO45AwmzUDCqdDV82.jpg', 1),
(4, 142100008, 'Ali Akbar', 'Mohammadi', 'Taha', 39933, '2021-09-22', 2, 1, 'ali_akbar@gmail.com', '0790303991', 'Ta89bHxVfZO1TWfLgvW0QIanQxRKkmP6ljiSmNOs.jpg', 1),
(5, 142100012, 'Mohammad Ali', 'Hussaini', 'Taha', 94994, '2021-09-22', 2, 1, 'Mohammad_ali@gmail.com', '0790304843', NULL, 1),
(6, 142010014, 'Mursal', 'Bahar', 'Taha', 8348494, '2021-09-22', 2, 1, 'hussainrasuli22@gmail.com', '0790303991', '4tHpoXPhDtRIVIEc4PK6YayZZsi8FWWEYeaUQrz4.jpg', 1),
(7, 142010013, 'Nagar', 'Rasuli', 'Taha', 89040458, '2021-09-22', 2, 2, 'nagar_rasuli@gmail.com', '0782389093', 'CehBTPFFrET15R9M5Vcww3qrzlRIgPZasCUsXxwn.jpg', 1),
(8, 142010015, 'Venus', 'Bakhtiari', 'Taha', 483983, '2021-09-22', 2, 2, 'venus_bakhtiari@gmail.com', '0790304843', 'HduWZBNPGMwSH8GalSjtp6OUgHfzEsO2gEJc1Vwi.jpg', 1),
(9, 142010016, 'Nazanin', 'Hussaini', 'Taha', 4445454, '2021-09-22', 2, 2, 'nazanin_hussaini@gmail.com', '0790304848', 'B8krXHwF1K5HabJ2sPhqWVdROpkz1ScpTx9oGlej.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `teachers_courses`
--

CREATE TABLE `teachers_courses` (
  `tc_id` int(11) NOT NULL,
  `co_id` int(11) NOT NULL,
  `tea_id` int(11) NOT NULL,
  `sem_id` int(11) NOT NULL,
  `shift` int(11) NOT NULL,
  `day` int(11) NOT NULL,
  `dep_id` int(11) NOT NULL,
  `approved` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teachers_courses`
--

INSERT INTO `teachers_courses` (`tc_id`, `co_id`, `tea_id`, `sem_id`, `shift`, `day`, `dep_id`, `approved`) VALUES
(1, 343, 2, 1, 1, 1, 1, 1),
(3, 348, 4, 1, 1, 3, 1, 1),
(5, 347, 3, 1, 1, 1, 1, 1),
(6, 349, 3, 1, 1, 1, 1, 1),
(7, 356, 4, 1, 1, 2, 1, 1),
(8, 358, 2, 1, 1, 3, 1, 1),
(9, 342, 3, 2, 1, 1, 1, 1),
(10, 344, 2, 2, 1, 3, 1, 1),
(11, 345, 4, 2, 1, 4, 1, 1),
(12, 346, 2, 2, 1, 5, 1, 1),
(13, 355, 5, 2, 1, 6, 1, 1),
(14, 357, 5, 2, 1, 1, 1, 1),
(15, 338, 4, 2, 1, 1, 1, 1),
(16, 340, 3, 3, 2, 1, 1, 1),
(17, 341, 4, 3, 2, 2, 1, 1),
(18, 354, 2, 3, 2, 3, 1, 1),
(19, 332, 4, 3, 2, 4, 1, 1),
(20, 333, 5, 3, 2, 5, 1, 1),
(21, 334, 2, 3, 2, 1, 1, 1),
(22, 171, 6, 1, 1, 1, 2, 1),
(23, 176, 6, 1, 1, 2, 2, 1),
(24, 177, 7, 1, 1, 5, 2, 1),
(25, 178, 8, 1, 1, 4, 2, 1),
(26, 184, 8, 1, 1, 2, 2, 1),
(27, 186, 9, 1, 1, 6, 2, 1),
(28, 175, 7, 2, 2, 1, 2, 1),
(29, 183, 8, 2, 2, 3, 2, 1),
(30, 163, 9, 2, 2, 6, 2, 1),
(31, 158, 4, 2, 2, 1, 2, 1),
(32, 161, 4, 2, 2, 2, 2, 1),
(33, 185, 6, 2, 2, 2, 2, 1),
(34, 182, 6, 3, 3, 1, 2, 1),
(35, 157, 5, 3, 3, 2, 2, 1),
(36, 152, 3, 3, 3, 2, 2, 1),
(37, 149, 4, 3, 3, 4, 2, 1),
(38, 154, 9, 3, 3, 1, 2, 1),
(39, 181, 6, 3, 3, 3, 2, 1),
(40, 148, 4, 8, 1, 1, 2, 1),
(41, 148, 7, 8, 2, 2, 2, 1),
(42, 148, 9, 8, 3, 5, 2, 1),
(43, 315, 2, 8, 1, 1, 1, 1),
(44, 315, 3, 8, 2, 2, 1, 1),
(45, 315, 4, 8, 3, 3, 1, 1),
(46, 348, 3, 3, 1, 4, 1, 0),
(47, 324, 2, 4, 2, 3, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_status` tinyint(4) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `table_name` int(11) DEFAULT NULL,
  `record_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `user_status`, `role_id`, `table_name`, `record_id`, `created_at`, `updated_at`) VALUES
(1, '141700001@gawharshad.edu.af', '$2y$10$TjeYmkK5vfm4f.hwafiTDepe3fd8nCaQ5sUvpIquqfHhwikaa.rgW', 1, 1, 3, 1, '2021-09-21 13:10:56', '2021-09-21 13:10:56'),
(2, '142700002@gawharshad.edu.com', '$2y$10$SE5bZfN8Me6YdYmLWgfQLuoJQ6QieE2Fm6hFh9RG3PYDSH9OFqKMa', 1, 5, 3, 2, '2021-09-21 13:29:34', '2021-09-21 13:29:34'),
(4, '142700004@gawharshad.edu.com', '$2y$10$Hy49aBIKgEx5EKG9/eue3OgmloDVZWAluy/HKjv/VtMWnut/Drx32', 1, 2, 3, 4, '2021-09-21 13:58:08', '2021-09-21 13:58:08'),
(5, '142100005@gawharshad.edu.com', '$2y$10$7XUz8LX/CHjABvUAPk0/fOeXgd4CijMFjSTW460Jftu/Qgx3RzvJG', 1, 2, 3, 3, '2021-09-21 15:12:47', '2021-09-21 15:12:47'),
(7, '142100006@gawharshad.edu.com', '$2y$10$QxtRxJ14hZAYfNscsN6wvOu33O0D8zpkcWhh9WVNB09lvwQa.dnVq', 1, 3, 1, 2, '2021-09-21 17:26:20', '2021-09-21 17:26:20'),
(8, '142100007@gawharshad.edu.com', '$2y$10$OGvm8Brl8I04RCAQhiSFuOQzO8UKsHYZIOzhID0hw3Leijdjb.TUi', 1, 3, 1, 3, '2021-09-21 17:29:16', '2021-09-21 17:29:16'),
(9, '142100008@gawharshad.edu.com', '$2y$10$boVnGxHDW4FMaVNMknxVW.D9wAnMeYYwDuVTMS.BKjrb3nN75AJR6', 1, 3, 1, 4, '2021-09-21 17:30:32', '2021-09-21 17:30:32'),
(10, '142100009@gawharshad.edu.com', '$2y$10$S0luT0TJnupFFcK3K2V/5.iVEdYO.Gl/FZv5gOTjR0Ll6SMupiU5.', 1, 4, 2, 1, '2021-09-21 18:47:32', '2021-09-21 18:47:32'),
(11, '142010010@gawharshad.edu.com', '$2y$10$qblhSUo00AY6.HSLnoUxk.bCxAq3pJup0OCBKYqOaKcmOMvcSbV/e', 1, 4, 2, 2, '2021-09-21 18:53:45', '2021-09-21 18:53:45'),
(12, '142100011@gawharshad.edu.com', '$2y$10$rS6KIzV5.wZnIdW3/JTOP.yuXmDUXDL2tI7qK1N5DEEM7k7PKzhMi', 1, 4, 2, 4, '2021-09-21 19:01:10', '2021-09-21 19:01:10'),
(13, '142100012@gawharshad.edu.com', '$2y$10$kosfTrvXl8Bf039swwOGRuN4o7e4VP.AQYuNkwD9OoVv4xOE1qwGS', 1, 3, 1, 5, '2021-09-21 19:18:29', '2021-09-21 19:18:29'),
(14, '142010013@gawharshad.edu.com', '$2y$10$UCgiLyYTjSrEQNh/pBI9XeAaIZIlEq0Oxknb.6.mp0ftYIuUB6w1.', 1, 3, 1, 7, '2021-09-22 01:12:01', '2021-09-22 01:12:01'),
(15, '142010014@gawharshad.edu.com', '$2y$10$A.v/d8JpwfaP06ZToO0ai.J/WhQa8rQODXRqZawVot16vCTmkbBeG', 1, 3, 1, 6, '2021-09-22 01:12:13', '2021-09-22 01:12:13'),
(16, '142010015@gawharshad.edu.com', '$2y$10$jjWgOfPVQuMWYTJJs8bJ.OweEAovBNpYLMtR9LhbSJBxGslGpp5y6', 1, 3, 1, 8, '2021-09-22 01:15:11', '2021-09-22 01:15:11'),
(18, '142010016@gawharshad.edu.com', '$2y$10$YmHNaj10Ng2mg3deANoklOagA6bZ6aVYrqMuuNNwNaAqp5gklFUY2', 1, 3, 1, 9, '2021-09-22 01:22:41', '2021-09-22 01:22:41'),
(21, '142010017@gawharshad.edu.com', '$2y$10$du33OAQbzwl9zUmsvSfXyu72bvy.tK.lCxtqYH7HIP5u0.WTxw8YO', 1, 2, 3, 7, '2021-09-22 02:49:34', '2021-09-22 02:49:34'),
(22, '142020018@gawharshad.edu.com', '$2y$10$2.oIkZ7UgvIaLtM7m3HDG.HSVjwWX6ydl/LsTtTZvSL5Y0y7C/SMe', 1, 2, 3, 6, '2021-09-22 02:49:43', '2021-09-22 02:49:43'),
(23, '142010019@gawharshad.edu.com', '$2y$10$i/ZaroCJ2lrgOQKYu1htHOgkTBZk9WQbElFFT8StGmwE2DEtNl7AK', 1, 4, 2, 7, '2021-09-22 02:52:17', '2021-09-22 02:52:17'),
(24, '142020020@gawharshad.edu.com', '$2y$10$8pZ6egg489691EoOy.be.OMgXNWYDbDSwbYEz5S5xR2ec/L7R9/LS', 1, 4, 2, 6, '2021-09-22 02:53:06', '2021-09-22 02:53:06'),
(25, '142010021@gawharshad.edu.com', '$2y$10$SFzrHvy0qPhGZAl02.Ytv.Wlz./7yOr7sCAvmYM2p0.iMX0XVEPRW', 1, 4, 2, 5, '2021-09-22 02:53:38', '2021-09-22 02:53:38'),
(26, '141110022@gawharshad.edu.com', '$2y$10$rYw27AYl0qlYY3SSXX5OjOV6ddGfRB.TYIU0PgTFNp/z1XhUQ3gUa', 1, 2, 3, 5, '2021-09-26 02:50:42', '2021-09-26 02:50:42');

-- --------------------------------------------------------

--
-- Table structure for table `user_notifications`
--

CREATE TABLE `user_notifications` (
  `user_noti_id` int(11) NOT NULL,
  `noti_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tc_id` int(11) DEFAULT NULL,
  `sem_id` int(11) DEFAULT NULL,
  `nofi_read` tinyint(4) NOT NULL DEFAULT 0,
  `nofi_seen` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_notifications`
--

INSERT INTO `user_notifications` (`user_noti_id`, `noti_id`, `user_id`, `tc_id`, `sem_id`, `nofi_read`, `nofi_seen`) VALUES
(57, 45, 3, NULL, NULL, 0, 0),
(58, 46, 1, NULL, NULL, 1, 0),
(59, 47, 2, 23, 1, 1, 0),
(60, 47, 1, 23, 1, 1, 0),
(61, 48, 2, 23, 1, 1, 0),
(62, 48, 1, 23, 1, 1, 0),
(63, 49, 2, 22, 1, 1, 0),
(64, 49, 1, 22, 1, 1, 0),
(65, 50, 2, 23, 1, 1, 0),
(66, 50, 1, 23, 1, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assignments`
--
ALTER TABLE `assignments`
  ADD PRIMARY KEY (`as_id`);

--
-- Indexes for table `correct_answers`
--
ALTER TABLE `correct_answers`
  ADD PRIMARY KEY (`ca_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`co_id`);

--
-- Indexes for table `courses_shifts`
--
ALTER TABLE `courses_shifts`
  ADD PRIMARY KEY (`sh_id`);

--
-- Indexes for table `days`
--
ALTER TABLE `days`
  ADD PRIMARY KEY (`day_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`dep_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`ev_id`);

--
-- Indexes for table `faculties`
--
ALTER TABLE `faculties`
  ADD PRIMARY KEY (`fac_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `materials`
--
ALTER TABLE `materials`
  ADD PRIMARY KEY (`ma_id`);

--
-- Indexes for table `materials_type`
--
ALTER TABLE `materials_type`
  ADD PRIMARY KEY (`mat_type_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`noti_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `period_years`
--
ALTER TABLE `period_years`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`per_id`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`position_id`);

--
-- Indexes for table `position_types`
--
ALTER TABLE `position_types`
  ADD PRIMARY KEY (`position_type_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`qu_id`);

--
-- Indexes for table `question_answers`
--
ALTER TABLE `question_answers`
  ADD PRIMARY KEY (`qa_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `roles_permissions`
--
ALTER TABLE `roles_permissions`
  ADD PRIMARY KEY (`rp_id`);

--
-- Indexes for table `role_types`
--
ALTER TABLE `role_types`
  ADD PRIMARY KEY (`role_type_id`);

--
-- Indexes for table `semesters`
--
ALTER TABLE `semesters`
  ADD PRIMARY KEY (`sem_id`);

--
-- Indexes for table `staffs`
--
ALTER TABLE `staffs`
  ADD PRIMARY KEY (`staff_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`stu_id`);

--
-- Indexes for table `students_assignments`
--
ALTER TABLE `students_assignments`
  ADD PRIMARY KEY (`sg_id`);

--
-- Indexes for table `students_courses`
--
ALTER TABLE `students_courses`
  ADD PRIMARY KEY (`sc_id`);

--
-- Indexes for table `table_names`
--
ALTER TABLE `table_names`
  ADD PRIMARY KEY (`tb_id`);

--
-- Indexes for table `taken_answers`
--
ALTER TABLE `taken_answers`
  ADD PRIMARY KEY (`ta_id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`tea_id`);

--
-- Indexes for table `teachers_courses`
--
ALTER TABLE `teachers_courses`
  ADD PRIMARY KEY (`tc_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_user_email_unique` (`email`);

--
-- Indexes for table `user_notifications`
--
ALTER TABLE `user_notifications`
  ADD PRIMARY KEY (`user_noti_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assignments`
--
ALTER TABLE `assignments`
  MODIFY `as_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `correct_answers`
--
ALTER TABLE `correct_answers`
  MODIFY `ca_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `co_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=360;

--
-- AUTO_INCREMENT for table `courses_shifts`
--
ALTER TABLE `courses_shifts`
  MODIFY `sh_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `days`
--
ALTER TABLE `days`
  MODIFY `day_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `dep_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `ev_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faculties`
--
ALTER TABLE `faculties`
  MODIFY `fac_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `materials`
--
ALTER TABLE `materials`
  MODIFY `ma_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `materials_type`
--
ALTER TABLE `materials_type`
  MODIFY `mat_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `noti_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `period_years`
--
ALTER TABLE `period_years`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `per_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `position_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `position_types`
--
ALTER TABLE `position_types`
  MODIFY `position_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `qu_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `question_answers`
--
ALTER TABLE `question_answers`
  MODIFY `qa_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `roles_permissions`
--
ALTER TABLE `roles_permissions`
  MODIFY `rp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=173;

--
-- AUTO_INCREMENT for table `role_types`
--
ALTER TABLE `role_types`
  MODIFY `role_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `semesters`
--
ALTER TABLE `semesters`
  MODIFY `sem_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `staffs`
--
ALTER TABLE `staffs`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `stu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `students_assignments`
--
ALTER TABLE `students_assignments`
  MODIFY `sg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `students_courses`
--
ALTER TABLE `students_courses`
  MODIFY `sc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `table_names`
--
ALTER TABLE `table_names`
  MODIFY `tb_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `taken_answers`
--
ALTER TABLE `taken_answers`
  MODIFY `ta_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `tea_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `teachers_courses`
--
ALTER TABLE `teachers_courses`
  MODIFY `tc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `user_notifications`
--
ALTER TABLE `user_notifications`
  MODIFY `user_noti_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
