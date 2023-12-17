-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Máy chç: localhost
-- ThÝi gian ã t¡o: Th10 16, 2023 lúc 11:39 AM
-- Phiên b£n máy phåc vå: 10.4.12-MariaDB-log
-- Phiên b£n PHP: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- C¡ sß dï liÇu: `sql_trungkien_ph`
--

-- --------------------------------------------------------

--
-- C¥u trúc b£ng cho b£ng `ketquaxs`
--

CREATE TABLE `ketquaxs` (
  `id` bigint(20) NOT NULL,
  `dai` varchar(255) DEFAULT NULL,
  `db` varchar(255) DEFAULT NULL,
  `g1` varchar(255) DEFAULT NULL,
  `g2` varchar(255) DEFAULT NULL,
  `g3` varchar(255) DEFAULT NULL,
  `g4` varchar(255) DEFAULT NULL,
  `g5` varchar(255) DEFAULT NULL,
  `g6` varchar(255) DEFAULT NULL,
  `g7` varchar(255) DEFAULT NULL,
  `g8` varchar(255) DEFAULT NULL,
  `tail0` varchar(255) DEFAULT NULL,
  `tail1` varchar(255) DEFAULT NULL,
  `tail2` varchar(255) DEFAULT NULL,
  `tail3` varchar(255) DEFAULT NULL,
  `tail4` varchar(255) DEFAULT NULL,
  `tail5` varchar(255) DEFAULT NULL,
  `tail6` varchar(255) DEFAULT NULL,
  `tail7` varchar(255) DEFAULT NULL,
  `tail8` varchar(255) DEFAULT NULL,
  `tail9` varchar(255) DEFAULT NULL,
  `head0` varchar(255) DEFAULT NULL,
  `head1` varchar(255) DEFAULT NULL,
  `head2` varchar(255) DEFAULT NULL,
  `head3` varchar(255) DEFAULT NULL,
  `head4` varchar(255) DEFAULT NULL,
  `head5` varchar(255) DEFAULT NULL,
  `head6` varchar(255) DEFAULT NULL,
  `head7` varchar(255) DEFAULT NULL,
  `head8` varchar(255) DEFAULT NULL,
  `head9` varchar(255) DEFAULT NULL,
  `lastTwoCode` varchar(255) DEFAULT NULL,
  `createdate` datetime DEFAULT NULL,
  `timestamp` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- ang Õ dï liÇu cho b£ng `ketquaxs`
--

INSERT INTO `ketquaxs` (`id`, `dai`, `db`, `g1`, `g2`, `g3`, `g4`, `g5`, `g6`, `g7`, `g8`, `tail0`, `tail1`, `tail2`, `tail3`, `tail4`, `tail5`, `tail6`, `tail7`, `tail8`, `tail9`, `head0`, `head1`, `head2`, `head3`, `head4`, `head5`, `head6`, `head7`, `head8`, `head9`, `lastTwoCode`, `createdate`, `timestamp`) VALUES
(26756, 'TP.HCM', '818059', '77465', '82785', '56840,82813', '50013,46551,10287,31607,11892,60900,80059', '0140', '8742,0401,0108', '566', '78', '7,0,1,8', '3,3', '', '', '0,0,2', '-9,1,9', '5,6', '8', '5,7', '2', '4,0,4', '5,0', '9,4', '1,1', '', '6,8', '6', '8,0', '0,7', '-5,5', '00,01,07,08,13,13,40,40,42,51,-59,59,65,66,78,85,87,92', '2023-08-07 16:00:01', 1691398860),
(26757, 'Óng Tháp', '429483', '88191', '47246', '20938,35759', '31933,85636,79299,40082,72406,00252,38086', '8252', '3068,4045,0596', '955', '50', '6', '', '', '8,3,6', '6,5', '9,2,2,5,0', '8', '', '-3,2,6', '1,9,6', '5', '9', '8,5,5', '-8,3', '', '4,5', '4,3,0,8,9', '', '3,6', '5,9', '06,33,36,38,45,46,50,52,52,55,59,68,82,-83,86,91,96,99', '2023-08-07 16:00:01', 1691398860),
(26758, 'Cà Mau', '132101', '79746', '06825', '32575,53937', '66679,21354,30025,68822,89674,28953,53331', '7036', '7737,7824,1118', '318', '57', '-1', '8,8', '5,5,2,4', '7,1,6,7', '6', '4,3,7', '', '5,9,4', '', '', '', '-0,3', '2', '5', '5,7,2', '2,7,2', '4,3', '3,3,5', '1,1', '7', '-01,18,18,22,24,25,25,31,36,37,37,46,53,54,57,74,75,79', '2023-08-07 16:00:01', 1691398860),
(26759, 'Thëa Thiên Hu¿', '930074', '15503', '55542', '47210,70400', '05723,38768,01244,44219,32898,10847,62812', '1462', '3045,0781,7498', '267', '55', '3,0', '0,9,2', '3', '', '2,4,7,5', '5', '8,2,7', '-4', '1', '8,8', '1,0', '8', '4,1,6', '0,2', '-7,4', '4,5', '', '4,6', '6,9,9', '1', '00,03,10,12,19,23,42,44,45,47,55,62,67,68,-74,81,98,98', '2023-08-07 17:00:01', 1691402460),
(26760, 'Phú Yên', '685529', '97938', '41700', '21713,69994', '72467,00104,35684,90801,37619,43397,31023', '9573', '0261,9758,2818', '779', '98', '0,4,1', '3,9,8', '-9,3', '8', '', '8', '7,1', '3,9', '4', '4,7,8', '0', '0,6', '', '1,2,7', '9,0,8', '', '', '6,9', '3,5,1,9', '-2,1,7', '00,01,04,13,18,19,23,-29,38,58,61,67,73,79,84,94,97,98', '2023-08-07 17:00:02', 1691402460),
(26761, 'MiÁn B¯c', '08672', '20246', '43830,65267', '30196,09287,20041,85627,27167,55315', '1341,7186,6137,2626', '0177,6134,9942,5179,7704,0359', '214,722,518', '07,63,16,74', '', '4,7', '5,4,8,6', '7,6,2', '0,7,4', '6,1,1,2', '9', '7,7,3', '-2,7,9,4', '7,6', '6', '3', '4,4', '-7,4,2', '6', '3,0,1,7', '1', '4,9,8,2,1', '6,8,2,6,3,7,0', '1', '7,5', '04,07,14,15,16,18,22,26,27,30,34,37,41,41,42,46,59,63,67,67,-72,74,77,79,86,87,96', '2023-08-07 18:00:02', 1691406060),
(26762, 'B¿n Tre', '533293', '98884', '95354', '83556,08430', '46782,32863,73605,56740,24526,33867,39067', '7552', '1087,9835,4996', '536', '15', '5', '5', '6', '0,5,6', '0', '4,6,2', '3,7,7', '', '4,2,7', '-3,6', '3,4', '', '8,5', '-9,6', '8,5', '0,3,1', '5,2,9,3', '6,6,8', '', '', '05,15,26,30,35,36,40,52,54,56,63,67,67,82,84,87,-93,96', '2023-08-08 16:00:01', 1691485260),
(26763, 'Ving Tàu', '367542', '62721', '31940', '99714,48895', '92747,04108,16228,79113,97477,99089,33414', '4836', '2120,8831,7899', '770', '07', '8,7', '4,3,4', '1,8,0', '6,1', '-2,0,7', '', '', '7,0', '9', '5,9', '4,2,7', '2,3', '-4', '1', '1,1', '9', '3', '4,7,0', '0,2', '8,9', '07,08,13,14,14,20,21,28,31,36,40,-42,47,70,77,89,95,99', '2023-08-08 16:00:01', 1691485260),
(26764, 'B¡c Liêu', '846176', '09096', '72648', '74254,72414', '35472,67178,80087,57913,85089,15955,18668', '2726', '3399,1009,7830', '284', '27', '9', '4,3', '6,7', '0', '8', '4,5', '8', '-6,2,8', '7,9,4', '6,9', '3', '', '7', '1', '5,1,8', '5', '-7,9,2', '8,2', '4,7,6', '8,9,0', '09,13,14,26,27,30,48,54,55,68,72,-76,78,84,87,89,96,99', '2023-08-08 16:00:01', 1691485260),
(26765, '¯k L¯k', '090553', '16141', '82166', '12964,40317', '68780,42128,51228,08971,27489,22687,33695', '5787', '9463,5320,0943', '193', '61', '', '7', '8,8,0', '', '1,3', '-3', '6,4,3,1', '1', '0,9,7,7', '5,3', '8,2', '4,7,6', '', '-5,6,4,9', '6', '9', '6', '1,8,8', '2,2', '8', '17,20,28,28,41,43,-53,61,63,64,66,71,80,87,87,89,93,95', '2023-08-08 17:00:01', 1691488860),
(26766, 'Qu£ng Nam', '219309', '86928', '77707', '32955,29744', '62661,34890,03987,25514,84234,50210,59749', '5277', '8174,3904,8640', '516', '73', '-9,7,4', '4,0,6', '8', '4', '4,9,0', '5', '1', '7,4,3', '7', '0', '9,1,4', '6', '', '7', '4,1,3,7,0', '5', '1', '0,8,7', '2', '-0,4', '04,07,-09,10,14,16,28,34,40,44,49,55,61,73,74,77,87,90', '2023-08-08 17:00:01', 1691488860),
(26767, 'MiÁn B¯c', '80766', '27080', '64096,60943', '71174,97077,93957,19786,63087,56243', '9054,7415,0167,2940', '3214,9178,9878,6066,7076,5984', '325,947,371', '70,19,14,97', '', '', '5,4,9,4', '5', '', '3,3,0,7', '7,4', '-6,7,6', '4,7,8,8,6,1,0', '0,6,7,4', '6,7', '8,4,7', '7', '', '4,4', '7,5,1,8,1', '1,2', '-6,9,8,6,7', '7,5,8,6,4,9', '7,7', '1', '14,14,15,19,25,40,43,43,47,54,57,-66,66,67,70,71,74,76,77,78,78,80,84,86,87,96,97', '2023-08-08 18:00:02', 1691492460),
(26770, 'Tây Ninh', '247919', '12792', '59147', '23003, 29421', '67199, 2274, 37814, 23491,05622,33083,33261', '7126', '3007,0395,6375', '754', '04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '04,54,07,95,75,26,61,83,22,91,14,74,99,21,03,47,92,-19', '2023-08-17 11:48:00', NULL),
(26771, 'V)nh Long', '815897', '78759', '82600', '63413,11204', '21609,45093,22347,60819,01613,77673,13587', '6166', '3545,7180,7029', '823', '98', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '98,97,23,45,80,29,66,09,93,47,19,13,73,87,13,04,00,59', '2023-09-01 21:16:00', NULL),
(26772, 'Bình D°¡ng', '94438', '45642', '59169', '97145,39310', '00693,91191,98827,58001,03755,91789,94990', '2930', '6515,3284,4793', '108', '71', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '71,38,08,15,84,93,30,93,91,27,01,55,89,90,45,10,69,42', '2023-09-01 21:17:00', NULL),
(26773, 'Trà Vinh', '485055', '58676', '90789', '40064,74140', '67712,46896,29152,37048,78100,36004,92712', '8598', '6833,2213,3504', '831', '51', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '51,55,31,33,13,04,98,12,96,52,48,00,04,12,64,40,89,76', '2023-09-01 21:18:00', NULL),
(26774, 'MiÁn B¯c', '61379', '79008', '07854 80318', '48527 90784 13121 89610 34437 47431', '7099 6773 7723 6743', '4050 1687 2692 4187 1868 4573', '559 179 626', '43 54 36 09', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '43 54 36 09 79 59 79 26 08 54 18 27 84 21 10 37 31 99 73 23 43 50 87 92 87 68 73', '2023-09-01 21:20:00', NULL),
(26776, 'Qu£ng Nam', '546778', '54326', '54362', '32955,29744', '62661,34890,03987,25514,84234,50210,59749', '5277', '8174,3904,8640', '324', '21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '2023-10-11 13:31:00', NULL),
(26777, 'Óng Nai', '027714', '85254', '78117', '38789,25250', '80102,37972,29942,80376,01112,37323,35415', '8844', '2979,1214,3335', '944', '04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '04,14,44,79,14,35,44,02,72,42,76,12,23,15,89,50,17,54', '2023-10-11 23:02:00', NULL),
(26779, 'C§n Th¡', '018482', '14296', '59132', '18370, 76189', '74734, 74403, 04855, 35397, 20973, 78566, 44233', '4013', '6099, 5040, 5450', '836', '13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '13, 82, 36, 99, 40, 50, 13, 34, 03, 55, 97, 73, 66, 33, 70, 89, 32, 96', '2023-10-12 04:08:00', NULL),
(26780, 'Sóc Trng', '464744', '75993', '82345', '42009, 68239', '35923, 35902, 07437, 52229, 83406, 44333, 55607', '8465', '4924, 2841, 7660', '248', '69', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '69, 44, 48, 24, 41, 60, 65, 23, 02, 37, 29, 06, 33, 07, 09, 39, 45, 93', '2023-10-11 16:16:00', NULL),
(26781, 'Tây Ninh', '556554', '34595', '54425', '55097,67928', '69787,78970,52405,84629,07454,66992,34163', '4093', '5060,9042,1621', '898', '41', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '2023-10-12 21:09:00', NULL),
(26782, 'TiÁn Giang', '198112', '31695', '05616', '64459,68994', '33820,08657,99737,30474,75329,31663,12754', '5648', '3800,3521,8689', '331', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '11,12,31,00,21,89,48,20,57,37,74,29,63,54,59,94,16,95', '2023-10-15 00:33:00', NULL),
(26783, 'Kiên Giang', '289176', '50135', '91873', '08083,13293', '84385,20642,88344,64370,80362,89224,53285', '6041', '0243,9551,2880', '436', '69', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '69,76,36,43,51,80,41,85,42,44,70,62,24,85,83,93,73,35', '2023-10-15 00:33:00', NULL),
(26784, 'MiÁn B¯c', '15013', '43153', '40745,63082', '64745,57226,04843,26387', '2455,0971,5175,1254', '8586,1190,6393,6972', '999,997,294', '29,60,79,77', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '29,60,79,77,13,99,97,94,53,45,82,45,26,43,87,24,73,55,71,75,54,86,90,93,72,32,50', '2023-10-15 00:33:00', NULL),
(26785, 'Lâm Óng', '001392', '87749', '19440', '94482,22909', '56997,07266,84665,52409,34987,59786,48113', '9297', '8536,8077,9137', '209', '15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '15,92,09,36,77,37,97,97,66,65,09,87,86,13,82,09,40,49', '2023-10-15 17:43:00', NULL),
(26786, 'Khánh Hòa', '116703', '68283', '28146', '55416,01323', '26936,42857,30012,86684,06357,48759,83981', '4715', '9790,7825,9902', '724', '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '11,03,24,90,25,02,15,36,57,12,84,57,59,81,16,23,46,83', '2023-10-15 17:43:00', NULL),
(26787, 'Kon Tum', '668298', '32021', '23820', '53238,07138', '87559,31035,07048,11008,27042,06465,12603', '9389', '0607,1056,0885', '081', '06', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '06,98,81,07,56,85,89,59,35,48,08,42,65,03,38,38,20,21', '2023-10-15 17:43:00', NULL),
(26788, 'Thëa Thiên Hu¿', '887031', '29847', '96168', '04292,81874', '62557,28943,81599,58933,02295,79485,60773', '8634', '5528,1581,7341', '344', '69', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '69,31,44,28,81,41,34,57,43,99,33,95,85,73,92,74,68,47', '2023-10-15 17:43:00', NULL),
(26789, 'TP.HCM', '310208', '09591', '54242', '53738,82584', '56552,06682,82785,51132,89970,16325,03805', '3110', '0504,4014,6847', '624', '38', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '38,08,24,04,14,47,10,52,82,85,32,70,25,05,38,84,42,91', '2023-10-14 18:22:00', NULL),
(26790, 'Long An', '620613', '40854', '74965', '38287,23612', '29956,56632,93554,47571,89859,31376,63264', '2663', '8772,7290,3191', '620', '21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '21,13,20,72,90,91,63,56,32,54,71,59,76,64,87,12,65,54', '2023-10-14 18:22:00', NULL),
(26791, 'Bình Ph°Ûc', '954335', '39765', '26720', '82540,42204', '65225,05687,70618,36866,67995,99355,48448', '1163', '2497,0918,7106', '795', '78', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '78,35,95,97,18,06,63,25,87,18,66,95,55,48,40,04,20,65', '2023-10-14 18:22:00', NULL),
(26792, 'H­u Giang', '635150', '62410', '39775', '48044,35036', '26369,12633,79143,63548,59678,61341,85019', '3376', '6947,3888,6939', '079', '68', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '68,50,79,47,88,39,76,69,33,43,48,78,41,19,44,36,75,10', '2023-10-14 18:22:00', NULL),
(26793, 'MiÁn B¯c', '59454', '486', '02755,43379', '99550,05287,68380,32640', '6838,0361,7534,5331', '6853,9553,6500,1359', '481,321,424', '03,39,81,58', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '03,39,81,58,54,81,21,24,86,55,79,50,87,80,40,38,48,38,61,34,31,53,53,00,59,60,50', '2023-10-14 19:06:00', NULL),
(26794, 'à Nµng', '336771', '60363', '73939', '16566,52955', '33964,03870,47531,74461,72869,41772,98778', '7569', '6291,2329,4614', '324', '25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '25,71,24,91,29,14,69,64,70,31,61,69,72,78,66,55,39,63', '2023-10-14 19:06:00', NULL),
(26795, 'Quãng Ngãi', '665621', '93795', '75068', '75065,55235', '17357,89159,64904,87084,71984,84057,75477', '7911', '2038,2741,3849', '413', '86', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '86,21,13,38,41,49,11,57,59,04,84,84,57,77,65,35,68,95', '2023-10-14 19:06:00', NULL),
(26796, '¯k Nông', '069366', '11708', '81944', '23272,81266', '98793,12703,13469,39072,12954,81638,36978', '5185', '9859,9194,0931', '297', '38', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '38,66,97,59,94,31,85,93,03,69,72,54,38,78,72,66,44,08', '2023-10-14 19:06:00', NULL),
(26797, 'V)nh Long', '848688', '81171', '24984', '69030,65815', '03184,60843,05923,11367,02679,18854,79640', '1552', '3475,9213,7223', '497', '60', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '60,88,97,75,13,23,52,84,43,23,67,79,54,40,30,15,84,71', '2023-10-13 19:24:00', NULL),
(26798, 'Bình D°¡ng', '052677', '96532', '70730', '03172,18742', '73190,33319,15645,92653,89267,64357,66271', '7208', '5906,3213,7955', '766', '22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '22,77,66,06,13,55,08,90,19,45,53,67,57,71,72,42,30,32', '2023-10-13 19:24:00', NULL),
(26799, 'Trà Vinh', '560986', '72057', '87717', '63720,80792', '14665,41168,71834,88247,39857,33742,09577', '8615', '4615,6237,3521', '557', '13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '13,86,57,15,37,21,15,65,68,34,47,57,42,77,20,92,17,57', '2023-10-13 19:24:00', NULL),
(26800, 'MiÁn B¯c', '40620', '36972', '97683,99909', '08047,50255,63076,61617', '6459,0224,5895,5108', '1293,3744,8119,9435', '794,879,397', '86,35,84,68', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '86,35,84,68,20,94,79,97,72,83,09,47,55,76,17,79,83,59,24,95,08,93,44,19,35,35,42', '2023-10-13 19:24:00', NULL),
(26801, 'Gia Lai', '897335', '46571', '70321', '51611,46622', '08639,29077,17928,47798,87556,93986,29347', '8750', '0636,4255,6325', '418', '60', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '60,35,18,36,55,25,50,39,77,28,98,56,86,47,11,22,21,71', '2023-10-13 19:28:00', NULL),
(26802, 'Ninh Thu­n', '486236', '80612', '23446', '18711,96851', '52351,06064,95554,76957,38125,94285,27956', '5430', '1972,4073,5494', '906', '12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '12,36,06,72,73,94,30,51,64,54,57,25,85,56,11,51,46,12', '2023-10-13 19:28:00', NULL),
(26803, 'Tây Ninh', '556554', '34595', '54425', '55097,67928', '69787,78970,52405,84629,07454,66992,34163', '4093', '5060,9042,1621', '898', '41', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '41,54,98,60,42,21,93,87,70,05,29,54,92,63,97,28,25,95', '2023-10-12 19:30:00', NULL),
(26804, 'An Giang', '043286', '16535', '40432', '62403,95516', '06601,60534,12750,26674,46015,76363,50341', '0312', '2714,0002,8928', '744', '45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '45,86,44,14,02,28,12,01,34,50,74,15,63,41,03,16,32,35', '2023-10-12 19:30:00', NULL),
(26805, 'Bình Thu­n', '640135', '98848', '04352', '94813,18518', '72746,54789,80656,55474,55066,64309,29255', '1433', '2236,8523,3389', '067', '71', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '71,35,67,36,23,89,33,46,89,56,74,66,09,55,13,18,52,48', '2023-10-12 19:30:00', NULL),
(26806, 'MiÁn B¯c', '50875', '95632', '39892,34582', '50557,03012,38198,20971', '0633,1981,2032,4676', '7866,1480,9846,3202', '884,935,151', '25,65,20,03', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '25,65,20,03,75,84,35,51,32,92,82,57,12,98,71,96,53,33,81,32,76,66,80,46,02,39,75', '2023-10-12 21:43:00', NULL),
(26807, 'Bình Ënh', '875722', '06277', '20935', '72167,83569', '68741,38798,83284,42753,41829,34132,33869', '2209', '8530,5843,9148', '588', '48', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '48,22,88,30,43,48,09,41,98,84,53,29,32,69,67,69,35,77', '2023-10-12 21:42:00', NULL),
(26808, 'Qu£ng TrË', '145342', '79141', '94685', '65254,23249', '16065,37960,58841,51165,54059,12415,94004', '4368', '5747,0774,7902', '181', '92', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '92,42,81,47,74,02,68,65,60,41,65,59,15,04,54,49,85,41', '2023-10-12 21:43:00', NULL),
(26809, 'Qu£ng Bình', '029344', '65035', '41928', '35235,34105', '71917,60983,67932,41601,36578,66018,67783', '8463', '9390,3204,0332', '641', '38', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '38,44,41,90,04,32,63,17,83,32,01,78,18,83,35,05,28,35', '2023-10-12 21:43:00', NULL),
(26810, 'MiÁn B¯c', '49140', '34659', '55529,10478', '30337,13749,64088,19673', '0865,5620,5382,7544', '1596,5137,8019,2565', '138,522,101', '77,60,19,89', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '77,60,19,89,40,38,22,01,59,29,78,37,49,88,73,93,11,65,20,82,44,96,37,19,65,01,06', '2023-10-11 19:34:00', NULL),
(26811, 'à Nµng', '015713', '09625', '11517', '14168,16682', '53035,51062,71579,26923,43646,56888,55227', '2955', '6007,9448,2539', '095', '14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '14,13,95,07,48,39,55,35,62,79,23,46,88,27,68,82,17,25', '2023-10-11 19:34:00', NULL),
(26812, 'Khánh Hòa', '413689', '93878', '94280', '55075,98996', '42657,43178,46598,15429,86313,63495,55031', '1653', '3524,0510,3139', '867', '08', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '08,89,67,24,10,39,53,57,78,98,29,13,95,31,75,96,80,78', '2023-10-11 19:34:00', NULL),
(26814, 'C§n Th¡', '018482', '14296', '59132', '18370,76189', '74734,74403,04855,35397,20973,78566,44233', '4013', '6099,5040,5450', '836', '13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '13,82,36,99,40,50,13,34,03,55,97,73,66,33,70,89,32,96', '2023-10-11 19:36:00', NULL),
(26816, 'MiÁn B¯c', '84521', '59398', '06955,97174', '76861,38679,96018,06578', '9277,4822,0696,3467', '5349,4865,9875,9623', '604,563,431', '93,92,27,19', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '93,92,27,19,21,04,63,31,98,55,74,61,79,18,78,25,76,77,22,96,67,49,65,75,23,13,40', '2023-10-10 19:38:00', NULL),
(26817, '¯k L¯k', '446469', '47767', '68867', '45205,33048', '72668,78384,56815,24332,25146,80041,75409', '5556', '5233,3768,0345', '703', '31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '31,69,03,33,68,45,56,68,84,15,32,46,41,09,05,48,67,67', '2023-10-10 19:38:00', NULL),
(26818, 'Qu£ng Nam', '532389', '49737', '26706', '06623,80677', '98134,42057,54930,88879,25924,46982,87998', '6827', '6155,0022,7526', '832', '75', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '75,89,32,55,22,26,27,34,57,30,79,24,82,98,23,77,06,37', '2023-10-10 19:38:00', NULL),
(26819, 'B¿n Tre', '950075', '51225', '90814', '80399,75963', '82176,53459,37682,17601,79139,20550,08473', '7109', '6797,1764,5333', '807', '06', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '06,75,07,97,64,33,09,76,59,82,01,39,50,73,99,63,14,25', '2023-10-10 19:39:00', NULL),
(26820, 'Ving Tàu', '361591', '57144', '52954', '11070,86244', '30300,99204,73213,36280,48729,74414,20213', '5324', '1656,5840,6424', '361', '99', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '99,91,61,56,40,24,24,00,04,13,80,29,14,13,70,44,54,44', '2023-10-10 19:39:00', NULL),
(26821, 'B¡c Liêu', '133051', '85427', '82141', '87495,95326', '45067,18969,23211,81904,02513,28820,34203', '2998', '5591,2907,6128', '744', '78', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '78,51,44,91,07,28,98,67,69,11,04,13,20,03,95,26,41,27', '2023-10-10 19:39:00', NULL),
(26822, 'TP.HCM', '576677', '61661', '07898', '01214,61601', '09852,46270,24024,01207,38434,81471,69451', '8979', '9857,8381,3396', '953', '34', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '34,77,53,57,81,96,79,52,70,24,07,34,71,51,14,01,98,61', '2023-10-09 19:41:00', NULL),
(26823, 'Óng Tháp', '752824', '17356', '56883', '69474,29839', '23428,06342,39152,45576,82798,94864,17616', '2589', '6812,6507,7264', '012', '94', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '94,24,12,12,07,64,89,28,42,52,76,98,64,16,74,39,83,56', '2023-10-09 19:41:00', NULL),
(26824, 'Cà Mau', '788241', '65174', '05840', '30654,80146', '56223,10758,08050,83329,55388,68335,30049', '2995', '9673,3489,0238', '179', '96', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '96,41,79,73,89,38,95,23,58,50,29,88,35,49,54,46,40,74', '2023-10-09 19:41:00', NULL),
(26825, 'MiÁn B¯c', '91245', '31903', '84892,01956', '06356,03876,36672,24111,26365,30725', '0051,4351,6340,4970', '7484,4228,9564,1750,7829,2650', '690,719,504', '35,30,17,68', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '35,30,17,68,45,90,19,04,03,92,56,56,76,72,11,65,25,51,51,40,70,84,28,64,50,29,50', '2023-10-09 19:42:00', NULL),
(26826, 'Thëa Thiên Hu¿', '786981', '90121', '13387', '53224,35102', '13348,81248,61787,19015,85208,36001,68655', '5742', '7992,6022,4730', '766', '65', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '65,81,66,92,22,30,42,48,48,87,15,08,01,55,24,02,87,21', '2023-10-09 19:42:00', NULL),
(26827, 'Phú Yên', '400518', '19494', '02023', '17697,62571', '16467,34607,12520,07968,74177,25842,30116', '6080', '5374,3347,6093', '815', '38', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '38,18,15,74,47,93,80,67,07,20,68,77,42,16,97,71,23,94', '2023-10-09 19:42:00', NULL);

-- --------------------------------------------------------

--
-- C¥u trúc b£ng cho b£ng `lang`
--

CREATE TABLE `lang` (
  `id` int(11) NOT NULL,
  `vn` mediumtext DEFAULT NULL,
  `en` mediumtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- ang Õ dï liÇu cho b£ng `lang`
--

INSERT INTO `lang` (`id`, `vn`, `en`) VALUES
(1, 'ng Nh­p', 'Login'),
(2, 'ng Ký', 'Register'),
(3, 'Thông Tin', 'Profile'),
(4, 'ng Nh­p ho·c ng Ký', 'Login or Register'),
(5, 'Tên ng nh­p', 'Username'),
(6, 'M­t kh©u', 'Password'),
(7, 'Nh­p tên ng nh­p', 'Enter your username'),
(8, 'Nh­p m­t kh©u', 'Enter password'),
(9, 'ang xí lý', 'Processing'),
(10, 'Vui lòng nh­p tên ng nh­p', 'Please enter your username'),
(11, 'Vui lòng nh­p m­t kh©u', 'Please enter a password'),
(12, 'Tên ng nh­p không tÓn t¡i', 'Username does not exist'),
(13, 'M­t kh©u ng nh­p không chính xác', 'Login password is incorrect'),
(14, 'Tài kho£n ã bË khóa', 'The account is locked'),
(15, 'Vui lòng nh­p Ënh d¡ng tài kho£n hãp lÇ', 'Please enter a valid account format'),
(16, 'Tài kho£n ph£i të 5 ¿n 64 ký tñ', 'Account must be between 5 and 64 characters'),
(17, 'Tên ng nh­p ã tÓn t¡i!', 'Username available!'),
(18, 'Vui lòng ·t m­t kh©u trên 3 ký tñ', 'Please set a password above 3 characters'),
(19, 'B¡n ã ¡t giÛi h¡n t¡o tài kho£n', 'You have reached your account creation limit'),
(20, 'T¡o tài kho£n thành công', 'Account successfully created'),
(21, 'Vui lòng kiÃm tra c¥u hình c¡ sß dï liÇu', 'Please check the database configuration'),
(22, 'Vui lòng nh­p Ëa chÉ email', 'Please enter your email address'),
(23, 'Vui lòng nh­p Ëa chÉ email hãp lÇ', 'Please enter a valid email address'),
(24, 'Ëa chÉ email không tÓn t¡i trong hÇ thÑng', 'Email address does not exist in the system'),
(25, 'XÁC NH¬N KHÔI PHäC M¬T KH¨U', 'CONFIRMED PASSWORD RECOVERY'),
(26, 'Có ai ó vëa yêu c§u khôi phåc l¡i m­t kh©u b±ng Email này, n¿u là b¡n vui lòng nh­p mã xác minh phía d°Ûi Ã xác minh tài kho£n', 'Someone has just requested to recover password by this email, if you are, please enter the verification code below to verify the account.'),
(27, 'Chúng tôi ã gíi mã xác minh vào Ëa chÉ Email cça b¡n', 'We have sent a verification code to your Email address'),
(28, 'Vui lòng nh­p m­t kh©u mÛi', 'Please enter a new password'),
(29, 'Vui lòng xác minh l¡i m­t kh©u', 'Please verify your password'),
(30, 'TÕng n¡p', 'Total Balance'),
(31, 'SÑ d° hiÇn t¡i', 'Credit Available'),
(32, 'SÑ tiÁn ã sí dång', 'Amount used'),
(33, 'N¡p tiÁn ngay', 'Pay Now'),
(34, 'LËch sí dòng tiÁn', 'Cash flow history'),
(35, 'THÐNG KÊ CHI TI¾T', 'DETAILED STATISTICS'),
(36, 'LËch Sí Giao DËch', 'Transaction history'),
(37, 'N¡p TiÁn', 'Recharge'),
(38, 'THÔNG TIN', 'INFORMATION'),
(39, 'ang ho¡t Ùng', 'Online'),
(40, 'Tr¡ng Thái', 'Status'),
(41, 'Gi£m', 'Discount'),
(42, 'GIAO DÊCH G¦N ÂY', 'RECENT TRANSACTIONS'),
(43, 'Trang Chç', 'Home'),
(45, 'SÑ l°ãng', 'Amount'),
(46, 'Thanh toán', 'Pay'),
(47, 'XEM NGAY', 'VIEW NOW'),
(48, 'T¢I VÀ', 'DOWNLOAD'),
(49, 'CHÌN ÊNH D NG T¢I VÀ', 'CHOOSE DOWNLOAD FORMAT'),
(50, 'CHI TI¾T  N HÀNG', 'ORDER DETAILS'),
(51, 'ThÝi Gian', 'Time'),
(52, 'Lo¡i', 'Type'),
(53, 'Mã Giao Dich', 'Transaction id'),
(54, 'L¯U Ý', 'Note'),
(55, 'Sao chép', 'Copy'),
(56, 'T£i Backup', 'Download Backup'),
(57, 'Dòng tiÁn', 'Cash flow'),
(58, 'LËch sí n¡p tiÁn', 'Deposit history'),
(59, 'Chç tài kho£n', 'Recipient\'s name'),
(60, 'NÙi dung chuyÃn tiÁn', 'Money transfer content'),
(61, 'SÑ tài kho£n', 'Payout account number'),
(62, 'Ngân hàng', 'Bank'),
(63, 'ng Xu¥t', 'Logout'),
(64, 'Thành viên', 'Member'),
(65, '¡i lý', 'Agency'),
(66, 'Ëa chÉ Email', 'Email address'),
(67, 'SÑ iÇn tho¡i', 'Number phone'),
(68, 'HÍ và Tên', 'Full name'),
(69, 'ThÝi gian ng ký', 'Registration period'),
(70, 'M­t kh©u mÛi', 'New password'),
(71, 'Nh­p l¡i m­t kh©u mÛi', 'Confirm  new password'),
(72, 'Thông tin °ãc mã hóa khi °a lên máy chç cça chúng tôi', 'Information is encrypted when posted on our servers'),
(73, 'L¯U THÔNG TIN', 'SAVE INFORMATION'),
(74, '¡n giá', 'Unit price'),
(75, 'SÑ tiÁn c§n thanh toán', 'Amount to be paid'),
(76, 'óng', 'Close'),
(77, 'Tên s£n ph©m', 'Product\'s name'),
(78, 'HiÇn có', 'Available'),
(79, 'Thao tác', 'Control'),
(80, 'L°u thành công', 'Save successfully'),
(81, 'ang xí lý giao dËch', 'Processing the transaction'),
(82, 'Lo¡i này ã h¿t hàng', 'This type is out of stock'),
(83, 'Mua Ngay', 'Buy Now'),
(84, 'H¿t hàng', 'Out of stock'),
(85, 'QuÑc gia', 'Countries'),
(86, 'Vui lòng ng nh­p Ã thñc hiÇn giao dËch', 'Please log in to make a transaction'),
(87, 'DËch vå không hãp lÇ', 'Invalid service'),
(88, 'DËch vå này không kh£ dång', 'This service is not available'),
(89, 'SÑ l°ãng mua không phù hãp', 'Purchase quantity does not match'),
(90, 'SÑ l°ãng tÑi a 1 l§n là', 'The maximum number of times is'),
(91, 'SÑ l°ãng trong hÇ thÑng không ç', 'The quantity in the system is not enough'),
(92, 'SÑ d° không ç vui lòng n¡p thêm', 'Insufficient balance, please recharge'),
(93, 'Tài kho£n cça b¡n ã bË ch¥m dét vì sí dång BUG', 'Your account has been terminated for using BUG'),
(94, 'Giao dËch thành công!', 'Successful transaction!'),
(95, 'Th¥t B¡i', 'Error'),
(96, 'Thành Công', 'Success'),
(97, 'C£nh Báo', 'Warning'),
(98, 'DANH SÁCH TÀI KHO¢N', 'LIST OF ACCOUNTS'),
(99, 'Chính sách', 'Policy'),
(100, 'LÊCH Sì N P TIÀN', 'MONEY DEPOSIT HISTORY'),
(101, 'Công Cå', 'Tool'),
(102, 'N P TIÀN', 'RECHARGE'),
(103, 'SÑ l°ãng tÑi thiÃu', 'Minimum quantity'),
(104, 'Top N¡p TiÁn', 'Deposit Rankings'),
(105, 'B¢NG X¾P H NG N P TIÀN', 'RANKING OF MONEY'),
(106, 'THÀNH VIÊN', 'MEMBER'),
(107, 'TÔNG TIÀN N P', 'TOTAL DEPOSIT'),
(108, 'X¾P H NG', 'RANK'),
(109, 'CÔNG Cä L¤Y MÃ 2FA', 'TOOL GET CODE 2FA'),
(110, 'Vui lòng nh­p Secret Key', 'Please enter Secret Key'),
(111, 'ANG Xì LÝ', 'PROCESSING'),
(112, 'CHÚNG TÔI CUNG C¤P', 'WE OFFER'),
(113, 'Có nhïng tài kho£n Facebook còn khá tr» n¿u b¡n c§n trong thÝi gian ng¯n, trên trang web cça chúng tôi', 'There are Facebook accounts, that are quite young if you need them for a short time, on our website'),
(114, 'TÀI KHO¢N ANG BÁN', 'ACCOUNT IS SELLING'),
(115, 'Công ty chúng tôi ã có mÙt thÝi gian dài trên thË tr°Ýng tài kho£n xã hÙi sÑ l°ãng lÛn và tài kho£n internet công cÙng. Chúng tôi ang cung c¥p cho khách hàng các tài kho£n sÑ l°ãng lÛn an toàn trên t¥t c£ các lo¡i m¡ng và cÕng thông tin công cÙng', 'Our company has been for a while on the market of bulk social accounts and public internet recourses. We are offering our customers secure bulk accounts on all kinds of public networks and portals'),
(116, 'Xem thêm', 'Learn more'),
(117, 'Nhà cung c¥p tài kho£n marketing hàng §u', 'Top marketing account provider'),
(118, 'Chúng tôi cung c¥p nhïng tài kho£n m¡ng xã hÙi ch¥t l°ãng nh¥t', 'We provide top quality social media accounts'),
(119, 'S£n ph©m', 'Product'),
(120, 'Trang chç', 'Home'),
(121, 'DËch vå', 'Services'),
(122, 'Quên m­t kh©u', 'Forgot password'),
(123, 'Nh­p OTP', 'Enter OTP'),
(124, 'Nh­p l¡i m­t kh©u', 'Verify password'),
(125, 'Õi m­t kh©u', 'Change Password'),
(126, 's£n ph©m trong nhóm này', 'products in this group'),
(127, 'Ñi tác cça chúng tôi', 'Partner'),
(128, 'iÁu kho£n', 'Rules'),
(129, 'DËch Vå', 'Services'),
(130, 'Liên HÇ', 'Contact');

-- --------------------------------------------------------

--
-- C¥u trúc b£ng cho b£ng `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `content` mediumtext DEFAULT NULL,
  `createdate` datetime DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- C¥u trúc b£ng cho b£ng `options`
--

CREATE TABLE `options` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `value` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- ang Õ dï liÇu cho b£ng `options`
--

INSERT INTO `options` (`id`, `name`, `value`) VALUES
(1, 'tenweb', ''),
(2, 'mota', ''),
(3, 'tukhoa', ''),
(4, 'logo', 'https://i.imgur.com/lIjCMpE.jpeg'),
(5, 'email', ''),
(6, 'pass_email', ''),
(7, 'luuy_naptien', '<ul>\r\n	<li>HÇ thÑng xí lý 5s 1 th».</li>\r\n	<li>Vui lòng gíi úng mÇnh giá, sai mÇnh giá thñc nh­n mÇnh giá bé nh¥t.</li>\r\n	<li>Ví då mÇnh giá thñc là 100k, quý khách n¡p 100k thñc nh­n 100k.</li>\r\n	<li>Ví då mÇnh giá thñc là 100k quý khách n¡p 50k thñc nh­n 50k.</li>\r\n	<li>MÇnh giá 10k, 20k, 30k tính thêm 3% phí.</li>\r\n</ul>\r\n'),
(10, 'luuy_napbank', 'test'),
(11, 'noidung_naptien', 'NAPTIEN'),
(12, 'thongbao', '<b> Thông báo cho khách hàng thay Õi trong Admin</b>'),
(13, 'anhbia', 'https://imgur.com/MLNLxUb.png'),
(14, 'favicon', 'https://imgur.com/3v69j9E.png'),
(15, 'ck_daily', '10'),
(16, 'doanhthu_daily', '11'),
(17, 'baotri', 'ON'),
(18, 'chinhsach', '<p>B°NG VIÆC Sì DäNG CÁC DÊCH Vä HO¶C MÞ MØT TÀI KHO¢N, B N CHO BI¾T R°NG B N CH¤P NH¬N, KHÔNG RÚT L I, CÁC IÀU KHO¢N DÊCH Vä NÀY. N¾U B N KHÔNG ÒNG Ý VÚI CÁC IÀU KHO¢N NÀY, VUI LÒNG KHÔNG Sì DäNG CÁC DÊCH Vä CæA CHÚNG TÔI HAY TRUY C¬P TRANG WEB. N¾U B N D¯ÚI 18 TUÔI HO¶C \"Ø TUÔI TR¯ÞNG THÀNH\"PHÙ HâP Þ N I B N SÐNG, B N PH¢I XIN PHÉP CHA M¸ HO¶C NG¯ÜI GIÁM HØ HâP PHÁP Â MÞ MØT TÀI KHO¢N VÀ CHA M¸ HO¶C NG¯ÜI GIÁM HØ HâP PHÁP PH¢I ÒNG Ý VÚI CÁC IÀU KHO¢N DÊCH Vä NÀY. N¾U B N KHÔNG BI¾T B N CÓ THUØC \"Ø TUÔI TR¯ÞNG THÀNH\" Þ N I B N SÐNG HAY KHÔNG, HO¶C KHÔNG HIÂU PH¦N NÀY, VUI LÒNG KHÔNG T O TÀI KHO¢N CHO ¾N KHI B N Ã NHÜ CHA M¸ HO¶C NG¯ÜI GIÁM HØ HâP PHÁP CæA B N GIÚP à. N¾U B N LÀ CHA M¸ HO¶C NG¯ÜI GIÁM HØ HâP PHÁP CæA MØT TRº VÊ THÀNH NIÊN MUÐN T O MØT TÀI KHO¢N, B N PH¢I CH¤P NH¬N CÁC IÀU KHO¢N DÊCH Vä NÀY THAY M¶T CHO TRº VÊ THÀNH NIÊN Ó VÀ B N S¼ CHÊU TRÁCH NHIÆM ÐI VÚI T¤T C¢ HO T ØNG Sì DäNG TÀI KHO¢N HAY CÁC DÊCH Vä, BAO GÒM CÁC GIAO DÊCH MUA HÀNG DO TRº VÊ THÀNH NIÊN THðC HIÆN, CHO DÙ TÀI KHO¢N CæA TRº VÊ THÀNH NIÊN Ó ¯âC MÞ VÀO LÚC NÀY HAY ¯âC T O SAU NÀY VÀ CHO DÙ TRº VÊ THÀNH NIÊN CÓ ¯âC B N GIÁM SÁT TRONG GIAO DÊCH MUA HÀNG Ó HAY KHÔNG.</p>\r\n'),
(19, 'api_bank', 'vuilongthayapi'),
(20, 'api_momo', 'vuilongthayapi'),
(21, 'theme', 'JoBest'),
(22, 'api_card', 'vuilongthayapi'),
(23, 'ck_card', '30'),
(24, 'theme_color', '#0f0684'),
(25, 'theme_home', '0'),
(26, 'stt_giao_dich_gan_day', 'ON'),
(27, 'status_demo', 'OFF'),
(28, 'chinhsach_baohanh', '<h2 class=\"page-title\" style=\"margin-right: 0px; margin-bottom: 20px; margin-left: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; font-weight: 700; font-size: 23px; font-family: Roboto, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\"><br></h2>'),
(29, 'sdt_momo', '0947838111'),
(30, 'name_momo', 'NGUYEN TAN '),
(31, 'tk_tsr', 'xoatkmkneukhongxai'),
(32, 'mk_tsr', 'xoatkmkneukhongxai'),
(33, 'mk2_tsr', ''),
(34, 'luuy_tsr', '<p>N¡p tiÁn qua thesieure.com cÙng tiÁn ngay.</p><p>ChuyÃn tiÁn nh­p úng nÙi dung chuyÃn tiÁn sau ó COPY mã giao dËch t¡i THESIEURE.COM và nh­p vào ô trên.</p>'),
(36, 'fanpage', ''),
(43, 'stt_giaodichao', 'OFF'),
(44, 'files', ''),
(45, 'btnSaveOption', ''),
(46, 'right_panel', 'ON'),
(47, 'emailct', ''),
(48, 'TypePassword', 'md5'),
(49, 'contact', '&lt;p&gt;&lt;br&gt;&lt;/p&gt;'),
(51, 'phone', '0978158212'),
(52, 'youtube', ''),
(53, 'script', ''),
(54, 'motabank', '<p><span style=\"color: rgb(80, 173, 78); font-family: Roboto, sans-serif; font-weight: 700; background-color: rgb(249, 249, 249);\">Khóa hÍc s½ °ãc kích ho¡t sau khi kiÃm tra tài kho£n và xác nh­n viÇc thanh toán cça b¡n thành công.</span><span style=\"background-color: rgb(249, 249, 249); color: rgb(80, 173, 78); font-family: Roboto, sans-serif; font-weight: 700; font-size: 1rem;\">(Vui lòng chÝ xác nh­n trong ngày ho·c liên hÇ zalo h× trã: 0978158212)</span></p><p><span style=\"color: rgb(80, 173, 78); font-family: Roboto, sans-serif; font-weight: 700; background-color: rgb(249, 249, 249);\"><br></span></p><p style=\"box-sizing: inherit; margin-bottom: 0px; color: rgb(39, 39, 39); font-family: Roboto, sans-serif;\"><span style=\"box-sizing: inherit; font-weight: 700;\">ChuyÃn kho£n ngân hàng</span></p><p style=\"box-sizing: inherit; margin-bottom: 0px; color: rgb(39, 39, 39); font-family: Roboto, sans-serif;\">B¡n có thÃ ¿n b¥t kó ngân hàng nào ß ViÇt Nam (ho·c sí dång Internet Banking) Ã chuyÃn tiÁn theo thông tin bên d°Ûi:</p><p><br style=\"box-sizing: inherit; color: rgb(39, 39, 39); font-family: Roboto, sans-serif;\"></p><ul class=\"top\" style=\"box-sizing: inherit; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; list-style: none; padding: 0px; display: inline-block; width: 648px; color: rgb(39, 39, 39); font-family: Roboto, sans-serif;\"><li style=\"box-sizing: inherit; list-style: none; padding: 0px; display: inline-block; vertical-align: top; width: 648px; line-height: 25px;\"><span class=\"bold\" style=\"box-sizing: inherit; font-weight: bold !important; width: 140px; display: block; float: left;\">" SÑ tài kho£n:</span>19034624681013</li><li style=\"box-sizing: inherit; list-style: none; padding: 0px; display: inline-block; vertical-align: top; width: 648px; line-height: 25px;\"><span class=\"bold\" style=\"box-sizing: inherit; font-weight: bold !important; width: 140px; display: block; float: left;\">" Chç tài kho£n:</span>Giang ThË H£i Lý<br></li><li style=\"box-sizing: inherit; list-style: none; padding: 0px; display: inline-block; vertical-align: top; width: 648px; line-height: 25px;\"><span class=\"bold\" style=\"box-sizing: inherit; font-weight: bold !important; width: 140px; display: block; float: left;\">" Ngân hàng:</span>Ngân Hàng Th°¡ng M¡i CÕ Ph§n Kù Th°¡ng ViÇt Nam (Techcombank)</li></ul><p style=\"box-sizing: inherit; margin-bottom: 0px; color: rgb(39, 39, 39); font-family: Roboto, sans-serif;\"><i style=\"box-sizing: inherit;\">Ghi chú khi chuyÃn kho£n:</i></p><ul class=\"center\" style=\"box-sizing: inherit; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; list-style: none; padding: 0px; display: inline-block; width: 648px; color: rgb(39, 39, 39); font-family: Roboto, sans-serif;\"><li style=\"box-sizing: inherit; list-style: none; padding: 0px; display: inline-block; vertical-align: top; width: 648px; line-height: 25px;\">" T¡i måc \"Ghi chú\" khi chuyÃn kho£n, b¡n ghi rõ: SÑ iÇn tho¡i. HÍ và tên. Email ng ký hÍc (thay \"@\" thành \".\"). Mã ¡n hàng</li><li style=\"box-sizing: inherit; list-style: none; padding: 0px; display: inline-block; vertical-align: top; width: 648px; line-height: 25px;\">" Ví då: SDT 0909090909. Nguyen Thi Huong Lan. nguyenthihuonglan.gmail.com. Don hang 2313123</li></ul><p><span style=\"color: rgb(39, 39, 39); font-family: Roboto, sans-serif; font-size: 16px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(249, 249, 249); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; display: inline !important; float: none;\"></span><span style=\"color: rgb(80, 173, 78); font-family: Roboto, sans-serif; font-weight: 700; background-color: rgb(249, 249, 249);\"><br></span><br></p>'),
(55, 'stkbank_thanhtoan', '0531002590569'),
(56, 'namebank_thanhtoan', 'Công ty TNHH ào T¡o NguÓn Lñc ViÇt.'),
(57, 'chinhanhbank_thanhtoan', 'Ngân hàng Vietcombank, Chi nhánh ông Sài Gòn, Tp.HCM.'),
(59, 'cotuc', '0.5'),
(60, 'phantramruttien', '1');

-- --------------------------------------------------------

--
-- C¥u trúc b£ng cho b£ng `saved`
--

CREATE TABLE `saved` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `dai` varchar(255) DEFAULT NULL,
  `so` mediumtext DEFAULT NULL,
  `haic` float DEFAULT NULL,
  `bac` float DEFAULT 0,
  `dd` float DEFAULT 0,
  `xc` float DEFAULT 0,
  `da` float DEFAULT 0,
  `trung` float DEFAULT 0,
  `xachaic` float DEFAULT 0,
  `thuchaic` float DEFAULT 0,
  `xacbac` float DEFAULT 0,
  `thucbac` float DEFAULT 0,
  `xacdd` float DEFAULT 0,
  `thucdd` float DEFAULT 0,
  `xacxc` float DEFAULT 0,
  `thucxc` float DEFAULT 0,
  `xacda` float DEFAULT 0,
  `thucda` float DEFAULT 0,
  `totalxac` float DEFAULT 0,
  `totalthuc` float DEFAULT 0,
  `totalanthua` float DEFAULT 0,
  `trangthai` varchar(255) DEFAULT NULL,
  `ngaydanh` datetime DEFAULT NULL,
  `createdate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- C¥u trúc b£ng cho b£ng `tyle`
--

CREATE TABLE `tyle` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT '0',
  `ref_users` int(11) DEFAULT NULL,
  `price18lo` float DEFAULT 0,
  `blo` float DEFAULT 0,
  `18lo` float DEFAULT 0,
  `price17lo` float DEFAULT 0,
  `17lo` float DEFAULT 0,
  `price17dao` float DEFAULT 0,
  `17dao` float DEFAULT 0,
  `17lod` float DEFAULT 0,
  `17d` float DEFAULT 0,
  `price7lo` float DEFAULT 0,
  `7lo` float DEFAULT 0,
  `price7lod` float DEFAULT 0,
  `7lod` float DEFAULT 0,
  `7dao` float DEFAULT 0,
  `7d` float DEFAULT 0,
  `priceda` float DEFAULT 0,
  `da` float DEFAULT 0,
  `pricedau` float DEFAULT 0,
  `dau` float DEFAULT 0,
  `a` float DEFAULT 0,
  `priceduoi` float DEFAULT 0,
  `duoi` float DEFAULT 0,
  `b` float DEFAULT 0,
  `pricedd` float DEFAULT 0,
  `dd` float DEFAULT 0,
  `ab` float DEFAULT 0,
  `pricexc` float DEFAULT 0,
  `xc` float DEFAULT 0,
  `pricexdao` float DEFAULT 0,
  `xdao` float DEFAULT 0,
  `xd` float DEFAULT 0,
  `price27lo` float DEFAULT 0,
  `27lo` float DEFAULT 0,
  `price23lo` float DEFAULT 0,
  `23lo` float DEFAULT 0,
  `price23dao` float DEFAULT 0,
  `23dao` float DEFAULT 0,
  `23d` float DEFAULT 0,
  `dai` varchar(255) DEFAULT NULL,
  `createdate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- ang Õ dï liÇu cho b£ng `tyle`
--

INSERT INTO `tyle` (`id`, `username`, `ref_users`, `price18lo`, `blo`, `18lo`, `price17lo`, `17lo`, `price17dao`, `17dao`, `17lod`, `17d`, `price7lo`, `7lo`, `price7lod`, `7lod`, `7dao`, `7d`, `priceda`, `da`, `pricedau`, `dau`, `a`, `priceduoi`, `duoi`, `b`, `pricedd`, `dd`, `ab`, `pricexc`, `xc`, `pricexdao`, `xdao`, `xd`, `price27lo`, `27lo`, `price23lo`, `23lo`, `price23dao`, `23dao`, `23d`, `dai`, `createdate`) VALUES
(208, 'a2', 1, 0, 70, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 63, 73, 64, 74, 74, 65, 75, 75, 66, 76, 76, 67, 77, 68, 78, 78, 60, 70, 61, 71, 62, 72, 72, 'mb', '2023-10-21 04:45:00'),
(209, 'a2', 1, 60, 70, 70, 61, 71, 62, 72, 72, 72, 63, 73, 64, 74, 74, 74, 65, 75, 66, 76, 76, 67, 77, 77, 68, 78, 78, 69, 79, 70, 80, 80, 0, 0, 0, 0, 0, 0, 0, 'mn', '2023-10-21 04:45:00'),
(210, 'a2', 1, 60, 70, 70, 61, 71, 62, 72, 72, 72, 63, 73, 64, 74, 74, 74, 65, 75, 66, 76, 76, 67, 77, 77, 68, 78, 78, 69, 79, 70, 80, 80, 0, 0, 0, 0, 0, 0, 0, 'mt', '2023-10-21 04:45:00'),
(211, 'a3', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 70, 70, 70, 70, 70, 70, 70, 70, 70, 70, 70, 70, 70, 70, 70, 70, 70, 70, 70, 70, 70, 70, 70, 'mb', '2023-10-25 07:29:36'),
(212, 'a3', 1, 70, 70, 70, 70, 70, 70, 70, 70, 70, 70, 70, 70, 70, 70, 70, 70, 70, 70, 70, 70, 70, 70, 70, 70, 70, 70, 70, 70, 70, 70, 70, 0, 0, 0, 0, 0, 0, 0, 'mn', '2023-10-25 07:29:36'),
(213, 'a3', 1, 70, 70, 70, 70, 70, 70, 70, 70, 70, 70, 70, 70, 70, 70, 70, 70, 70, 70, 70, 70, 70, 70, 70, 70, 70, 70, 70, 70, 70, 70, 70, 0, 0, 0, 0, 0, 0, 0, 'mt', '2023-10-25 07:29:36'),
(214, 'm1', 41, 0, 75, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 'mb', '2023-11-11 01:16:19'),
(215, 'm1', 41, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 0, 0, 0, 0, 0, 0, 0, 'mn', '2023-11-11 01:16:19'),
(216, 'm1', 41, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 0, 0, 0, 0, 0, 0, 0, 'mt', '2023-11-11 01:16:19'),
(217, 'meow3', NULL, 0, 75, 75, 0, 75, 0, 75, 75, 0, 0, 75, 0, 75, 75, 0, 0, 75, 0, 75, 75, 0, 75, 75, 0, 75, 75, 0, 75, 0, 75, 75, 0, 0, 0, 0, 0, 0, 0, 'mt', '2023-11-11 02:24:49'),
(218, 'meow3', NULL, 0, 75, 75, 0, 75, 0, 75, 75, 0, 0, 75, 0, 75, 75, 0, 0, 75, 0, 75, 75, 0, 75, 75, 0, 75, 75, 0, 75, 0, 75, 75, 0, 0, 0, 0, 0, 0, 0, 'mn', '2023-11-11 02:24:49'),
(219, 'meow3', NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 75, 0, 75, 75, 0, 75, 75, 0, 75, 75, 0, 75, 0, 75, 75, 0, 75, 0, 75, 0, 75, 75, 'mb', '2023-11-11 02:24:49'),
(220, 'meo1', 42, 0, 75, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 'mb', '2023-11-11 02:26:29'),
(221, 'meo1', 42, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 0, 0, 0, 0, 0, 0, 0, 'mn', '2023-11-11 02:26:29'),
(222, 'meo1', 42, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 0, 0, 0, 0, 0, 0, 0, 'mt', '2023-11-11 02:26:29'),
(223, 'meo2', 42, 0, 60, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 70, 60, 70, 60, 60, 70, 60, 60, 70, 60, 60, 70, 60, 70, 60, 60, 70, 60, 70, 60, 70, 60, 60, 'mb', '2023-11-11 02:27:48'),
(224, 'meo2', 42, 70, 60, 60, 70, 60, 70, 60, 60, 60, 70, 60, 70, 60, 60, 60, 70, 60, 70, 60, 60, 70, 60, 60, 70, 60, 60, 70, 60, 70, 60, 60, 0, 0, 0, 0, 0, 0, 0, 'mn', '2023-11-11 02:27:48'),
(225, 'meo2', 42, 70, 60, 60, 70, 60, 70, 60, 60, 60, 70, 60, 70, 60, 60, 60, 70, 60, 70, 60, 60, 70, 60, 60, 70, 60, 60, 70, 60, 70, 60, 60, 0, 0, 0, 0, 0, 0, 0, 'mt', '2023-11-11 02:27:48'),
(229, 'a2', NULL, 0, 75, 75, 0, 75, 0, 75, 75, 0, 0, 75, 0, 75, 75, 0, 0, 75, 0, 75, 75, 0, 75, 75, 0, 75, 75, 0, 75, 0, 75, 75, 0, 0, 0, 0, 0, 0, 0, 'mt', '2023-11-12 11:12:11'),
(230, 'a2', NULL, 0, 75, 75, 0, 75, 0, 75, 75, 0, 0, 75, 0, 75, 75, 0, 0, 75, 0, 75, 75, 0, 75, 75, 0, 75, 75, 0, 75, 0, 75, 75, 0, 0, 0, 0, 0, 0, 0, 'mn', '2023-11-12 11:12:11'),
(231, 'a2', NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 75, 0, 75, 75, 0, 75, 75, 0, 75, 75, 0, 75, 0, 75, 75, 0, 75, 0, 75, 0, 75, 75, 'mb', '2023-11-12 11:12:11'),
(232, 'a12321', NULL, 0, 75, 75, 0, 75, 0, 75, 75, 0, 0, 75, 0, 75, 75, 0, 0, 75, 0, 75, 75, 0, 75, 75, 0, 75, 75, 0, 75, 0, 75, 75, 0, 0, 0, 0, 0, 0, 0, 'mt', '2023-11-12 11:13:32'),
(233, 'a12321', NULL, 0, 75, 75, 0, 75, 0, 75, 75, 0, 0, 75, 0, 75, 75, 0, 0, 75, 0, 75, 75, 0, 75, 75, 0, 75, 75, 0, 75, 0, 75, 75, 0, 0, 0, 0, 0, 0, 0, 'mn', '2023-11-12 11:13:32'),
(234, 'a12321', NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 75, 0, 75, 75, 0, 75, 75, 0, 75, 75, 0, 75, 0, 75, 75, 0, 75, 0, 75, 0, 75, 75, 'mb', '2023-11-12 11:13:32');

-- --------------------------------------------------------

--
-- C¥u trúc b£ng cho b£ng `type`
--

CREATE TABLE `type` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `ref_users` int(11) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `thuhaimn` varchar(255) DEFAULT NULL,
  `thubamn` varchar(255) DEFAULT NULL,
  `thutumn` varchar(255) DEFAULT NULL,
  `thunammn` varchar(255) DEFAULT NULL,
  `thusaumn` varchar(255) DEFAULT NULL,
  `thubaymn` varchar(255) DEFAULT NULL,
  `chunhatmn` varchar(255) DEFAULT NULL,
  `thuhaimt` varchar(255) DEFAULT NULL,
  `thubamt` varchar(255) DEFAULT NULL,
  `thutumt` varchar(255) DEFAULT NULL,
  `thunammt` text DEFAULT NULL,
  `thusaumt` varchar(255) DEFAULT NULL,
  `thubaymt` varchar(255) DEFAULT NULL,
  `chunhatmt` varchar(255) DEFAULT NULL,
  `createdate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- ang Õ dï liÇu cho b£ng `type`
--

INSERT INTO `type` (`id`, `username`, `ref_users`, `type`, `thuhaimn`, `thubamn`, `thutumn`, `thunammn`, `thusaumn`, `thubaymn`, `chunhatmn`, `thuhaimt`, `thubamt`, `thutumt`, `thunammt`, `thusaumt`, `thubaymt`, `chunhatmt`, `createdate`) VALUES
(35, 'a2', 1, NULL, 'cm,dt,tp', 'bt,vt,bl', 'dn,ct,st', 'tn,ag,bth', 'vl,bd,tv', 'tp,la,bp,hg', 'tg,kg,dl', 'py,tth', 'dlk,qna', 'dan,kh', 'bdh,qt,qb', 'gl,nt', 'dan,qn,dno', 'kt,kh,tth', '2023-10-21 04:45:00'),
(36, 'a3', 1, NULL, 'tp,dt,cm', 'bt,vt,bl', 'dn,ct,st', 'tn,ag,bth', 'vl,bd,tv', 'tp,la,bp,hg', 'tg,kg,dl', 'py,tth', 'dlk,qna', 'dan,kh', 'bdh,qt,qb', 'gl,nt', 'dan,qn,dno', 'kt,kh,tth', '2023-10-25 07:29:36'),
(37, 'm1', 41, NULL, 'dt,cm,tp', 'bt,vt,bl', 'dn,ct,st', 'tn,ag,bth', 'vl,bd,tv', 'tp,la,bp,hg', 'tg,kg,dl', 'py,tth', 'dlk,qna', 'dan,kh', 'bdh,qt,qb', 'gl,nt', 'dan,qn,dno', 'kt,kh,tth', '2023-11-11 01:16:19'),
(38, 'meo1', 42, NULL, 'tp,dt,cm', 'bt,vt,bl', 'dn,ct,st', 'tn,ag,bth', 'vl,bd,tv', 'tp,la,bp,hg', 'tg,kg,dl', 'py,tth', 'dlk,qna', 'dan,kh', 'bdh,qt,qb', 'gl,nt', 'dan,qn,dno', 'kt,kh,tth', '2023-11-11 02:26:29'),
(39, 'meo2', 42, NULL, 'tp,cm,dt', 'bt,vt,bl', 'dn,ct,st', 'tn,ag,bth', 'vl,bd,tv', 'tp,la,bp,hg', 'tg,kg,dl', 'py,tth', 'dlk,qna', 'dan,kh', 'bdh,qt,qb', 'gl,nt', 'dan,qn,dno', 'kt,kh,tth', '2023-11-11 02:27:48');

-- --------------------------------------------------------

--
-- C¥u trúc b£ng cho b£ng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `level` varchar(255) DEFAULT NULL,
  `banned` int(11) DEFAULT 0,
  `createdate` datetime DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `ref` varchar(255) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  `timedelete` int(11) DEFAULT NULL,
  `total_money` int(11) DEFAULT 0,
  `phone` varchar(255) DEFAULT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `UserAgent` mediumtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- ang Õ dï liÇu cho b£ng `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `token`, `level`, `banned`, `createdate`, `email`, `ref`, `ip`, `time`, `timedelete`, `total_money`, `phone`, `fullname`, `UserAgent`) VALUES
(1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'ZEgeLCYXQVyswWDankcJTbihxumRKofdPMABGzOpqUtHajrNvFIlS', 'admin', 0, '2022-12-04 16:50:08', 'admin@admin.com', '', '127.0.0.1', NULL, 7, 50250, '0964999999', 'Chi¿n Th¯ng', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1'),
(23, 'adminadmin', 'f6fdffe48c908deb0f4c3bd36c032e72', NULL, 'daily', 0, '2023-08-13 17:11:34', '123123', '', NULL, NULL, NULL, 123123, '09642513269', NULL, NULL),
(40, 'meow1', 'a8698009bce6d1b8c2128eddefc25aad', NULL, 'daily', 0, '2023-09-10 22:27:48', '', '', NULL, NULL, NULL, 0, '', NULL, NULL),
(42, 'meow3', '781e5e245d69b566979b86e28d23f2c7', NULL, 'daily', 0, '2023-11-11 02:24:49', NULL, NULL, NULL, NULL, 7, 0, '', NULL, NULL);

--
-- ChÉ måc cho các b£ng ã Õ
--

--
-- ChÉ måc cho b£ng `ketquaxs`
--
ALTER TABLE `ketquaxs`
  ADD PRIMARY KEY (`id`);

--
-- ChÉ måc cho b£ng `lang`
--
ALTER TABLE `lang`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- ChÉ måc cho b£ng `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- ChÉ måc cho b£ng `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- ChÉ måc cho b£ng `saved`
--
ALTER TABLE `saved`
  ADD PRIMARY KEY (`id`);

--
-- ChÉ måc cho b£ng `tyle`
--
ALTER TABLE `tyle`
  ADD PRIMARY KEY (`id`);

--
-- ChÉ måc cho b£ng `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`id`);

--
-- ChÉ måc cho b£ng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- AUTO_INCREMENT cho các b£ng ã Õ
--

--
-- AUTO_INCREMENT cho b£ng `ketquaxs`
--
ALTER TABLE `ketquaxs`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26828;

--
-- AUTO_INCREMENT cho b£ng `lang`
--
ALTER TABLE `lang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT cho b£ng `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3858;

--
-- AUTO_INCREMENT cho b£ng `options`
--
ALTER TABLE `options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT cho b£ng `saved`
--
ALTER TABLE `saved`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=221;

--
-- AUTO_INCREMENT cho b£ng `tyle`
--
ALTER TABLE `tyle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=244;

--
-- AUTO_INCREMENT cho b£ng `type`
--
ALTER TABLE `type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT cho b£ng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
