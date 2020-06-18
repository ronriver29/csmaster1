-- --------------------------------------------------------
-- Host:                         122.3.154.210
-- Server version:               10.1.36-MariaDB - Source distribution
-- Server OS:                    Linux
-- HeidiSQL Version:             9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table coopris_testserver.refprovince
CREATE TABLE IF NOT EXISTS `refprovince` (
  `id` int(11) NOT NULL,
  `psgcCode` varchar(255) DEFAULT NULL,
  `provDesc` text,
  `regCode` varchar(255) DEFAULT NULL,
  `provCode` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table coopris_testserver.refprovince: ~88 rows (approximately)
/*!40000 ALTER TABLE `refprovince` DISABLE KEYS */;
INSERT INTO `refprovince` (`id`, `psgcCode`, `provDesc`, `regCode`, `provCode`) VALUES
	(0, 'psgcCode', 'provDesc', 'regCode', 'provCode'),
	(1, '012800000', 'Ilocos Norte', '001', '0128'),
	(2, '012900000', 'Ilocos Sur', '001', '0129'),
	(3, '013300000', 'La Union', '001', '0133'),
	(4, '015500000', 'Pangasinan', '001', '0155'),
	(5, '020900000', 'Batanes', '002', '0209'),
	(6, '021500000', 'Cagayan', '002', '0215'),
	(7, '023100000', 'Isabela', '002', '0231'),
	(8, '025000000', 'Nueva Vizcaya', '002', '0250'),
	(9, '025700000', 'Quirino', '002', '0257'),
	(10, '030800000', 'Bataan', '003', '0308'),
	(11, '031400000', 'Bulacan', '003', '0314'),
	(12, '034900000', 'Nueva Ecija', '003', '0349'),
	(13, '035400000', 'Pampanga', '003', '0354'),
	(14, '036900000', 'Tarlac', '003', '0369'),
	(15, '037100000', 'Zambales', '003', '0371'),
	(16, '037700000', 'Aurora', '003', '0377'),
	(17, '041000000', 'Batangas', '004', '0410'),
	(18, '042100000', 'Cavite', '004', '0421'),
	(19, '043400000', 'Laguna', '004', '0434'),
	(20, '045600000', 'Quezon', '004', '0456'),
	(21, '045800000', 'Rizal', '004', '0458'),
	(22, '184000000', 'Marinduque', '018', '1840'),
	(23, '185100000', 'Occidental Mindoro', '018', '1851'),
	(24, '185200000', 'Oriental Mindoro', '018', '1852'),
	(25, '185300000', 'Palawan', '018', '1853'),
	(26, '185900000', 'Romblon', '018', '1859'),
	(27, '050500000', 'Albay', '005', '0505'),
	(28, '051600000', 'Camarines Norte', '005', '0516'),
	(29, '051700000', 'Camarines Sur', '005', '0517'),
	(30, '052000000', 'Catanduanes', '005', '0520'),
	(31, '054100000', 'Masbate', '005', '0541'),
	(32, '056200000', 'Sorsogon', '005', '0562'),
	(33, '060400000', 'Aklan', '006', '0604'),
	(34, '060600000', 'Antique', '006', '0606'),
	(35, '061900000', 'Capiz', '006', '0619'),
	(36, '063000000', 'Iloilo', '006', '0630'),
	(37, '064500000', 'Negros Occidental', '006', '0645'),
	(38, '067900000', 'Guimaras', '006', '0679'),
	(39, '071200000', 'Bohol', '007', '0712'),
	(40, '072200000', 'Cebu', '007', '0722'),
	(41, '074600000', 'Negros Oriental', '007', '0746'),
	(42, '076100000', 'Siquijor', '007', '0761'),
	(43, '082600000', 'Eastern Samar', '008', '0826'),
	(44, '083700000', 'Leyte', '008', '0837'),
	(45, '084800000', 'Northern Samar', '008', '0848'),
	(46, '086000000', 'Samar (Western Samar)', '008', '0860'),
	(47, '086400000', 'Southern Leyte', '008', '0864'),
	(48, '087800000', 'Biliran', '008', '0878'),
	(49, '097200000', 'Zamboanga Del Norte', '009', '0972'),
	(50, '097300000', 'Zamboanga Del Sur', '009', '0973'),
	(51, '098300000', 'Zamboanga Sibugay', '009', '0983'),
	(52, '099700000', 'City Of Isabela', '009', '0997'),
	(53, '101300000', 'Bukidnon', '010', '1013'),
	(54, '101800000', 'Camiguin', '010', '1018'),
	(55, '103500000', 'Lanao Del Norte', '010', '1035'),
	(56, '104200000', 'Misamis Occidental', '010', '1042'),
	(57, '104300000', 'Misamis Oriental', '010', '1043'),
	(58, '112300000', 'Davao Del Norte', '011', '1123'),
	(59, '112400000', 'Davao Del Sur', '011', '1124'),
	(60, '112500000', 'Davao Oriental', '011', '1125'),
	(61, '118200000', 'Compostela Valley', '011', '1182'),
	(62, '118600000', 'Davao Occidental', '011', '1186'),
	(63, '124700000', 'Cotabato (North Cotabato)', '012', '1247'),
	(64, '126300000', 'South Cotabato', '012', '1263'),
	(65, '126500000', 'Sultan Kudarat', '012', '1265'),
	(66, '128000000', 'Sarangani', '012', '1280'),
	(67, '129800000', 'Cotabato City', '012', '1298'),
	(68, '163900000', 'NCR City of Manila First District', '016', '1639'),
	(70, '167400000', 'NCR Second District', '016', '1674'),
	(71, '167500000', 'NCR Third District', '016', '1675'),
	(72, '167600000', 'NCR Fourth District', '016', '1676'),
	(73, '150100000', 'Abra', '015', '1501'),
	(74, '151100000', 'Benguet', '015', '1511'),
	(75, '152700000', 'Ifugao', '015', '1527'),
	(76, '153200000', 'Kalinga', '015', '1532'),
	(77, '154400000', 'Mountain Province', '015', '1544'),
	(78, '158100000', 'Apayao', '015', '1581'),
	(79, '140700000', 'Basilan', '014', '1407'),
	(80, '143600000', 'Lanao Del Sur', '014', '1436'),
	(81, '143800000', 'Maguindanao', '014', '1438'),
	(82, '146600000', 'Sulu', '014', '1466'),
	(83, '147000000', 'Tawi-Tawi', '014', '1470'),
	(84, '130200000', 'Agusan Del Norte', '013', '1302'),
	(85, '130300000', 'Agusan Del Sur', '013', '1303'),
	(86, '136700000', 'Surigao Del Norte', '013', '1367'),
	(87, '136800000', 'Surigao Del Sur', '013', '1368'),
	(88, '138500000', 'Dinagat Islands', '013', '1385');
/*!40000 ALTER TABLE `refprovince` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
