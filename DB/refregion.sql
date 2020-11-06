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

-- Dumping structure for table coopris_testserver.refregion
CREATE TABLE IF NOT EXISTS `refregion` (
  `id` int(11) NOT NULL,
  `psgcCode` varchar(255) DEFAULT NULL,
  `regDesc` text,
  `regCode` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table coopris_testserver.refregion: ~19 rows (approximately)
/*!40000 ALTER TABLE `refregion` DISABLE KEYS */;
INSERT INTO `refregion` (`id`, `psgcCode`, `regDesc`, `regCode`) VALUES
	(1, '010000000', 'Region I (Dagupan)', '001'),
	(2, '020000000', 'Region II (Tuguegarao)', '002'),
	(3, '030000000', 'Region III (Pampanga)', '003'),
	(4, '040000000', 'Region IV-A (Calamba)', '004'),
	(5, '180000000', 'Region IV-B (Mimaropa)', '018'),
	(6, '050000000', 'Region V (Naga)', '005'),
	(7, '060000000', 'Region VI (Iloilo)', '006'),
	(8, '070000000', 'Region VII (Cebu)', '007'),
	(9, '080000000', 'Region VIII (Tacloban)', '008'),
	(10, '090000000', 'Region IX (Pagadian)', '009'),
	(11, '100000000', 'Region X (Cagayan De Oro)', '010'),
	(12, '110000000', 'Region XI (Davao)', '011'),
	(13, '120000000', 'Region XII (Kidapawan)', '012'),
	(14, '130000000', 'Region XIII (Caraga)', '013'),
	(15, '150000000', 'Cordillera Administrative Region (CAR)', '015'),
	(16, '140000000', 'Autonomous Region in Muslim Mindanao (ARMM)', '014'),
	(18, '160000000', 'National Capital Region (NCR)', '016');
/*!40000 ALTER TABLE `refregion` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
