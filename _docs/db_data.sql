-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               10.0.33-MariaDB-0ubuntu0.16.04.1 - Ubuntu 16.04
-- Операционная система:         debian-linux-gnu
-- HeidiSQL Версия:              9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Дамп данных таблицы addressbook.address_book: ~0 rows (приблизительно)
DELETE FROM `address_book`;
/*!40000 ALTER TABLE `address_book` DISABLE KEYS */;
/*!40000 ALTER TABLE `address_book` ENABLE KEYS */;

-- Дамп данных таблицы addressbook.city: ~0 rows (приблизительно)
DELETE FROM `city`;
/*!40000 ALTER TABLE `city` DISABLE KEYS */;
INSERT INTO `city` (`id`, `name`, `country_id`) VALUES
	(1, 'New York', 1),
	(2, 'Dallas', 1),
	(3, 'Toronto', 2),
	(4, 'Montreal', 2);
/*!40000 ALTER TABLE `city` ENABLE KEYS */;

-- Дамп данных таблицы addressbook.country: ~0 rows (приблизительно)
DELETE FROM `country`;
/*!40000 ALTER TABLE `country` DISABLE KEYS */;
INSERT INTO `country` (`id`, `name`) VALUES
	(1, 'USA'),
	(2, 'Canada');
/*!40000 ALTER TABLE `country` ENABLE KEYS */;

-- Дамп данных таблицы addressbook.user: ~0 rows (приблизительно)
DELETE FROM `user`;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `login`, `password`, `status`) VALUES
	(1, 'admin', 'admin', 1);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
