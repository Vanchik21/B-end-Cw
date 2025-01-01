-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Час створення: Гру 27 2024 р., 20:52
-- Версія сервера: 9.1.0
-- Версія PHP: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База даних: `cms`
--

-- --------------------------------------------------------

--
-- Структура таблиці `animals`
--

DROP TABLE IF EXISTS `animals`;
CREATE TABLE IF NOT EXISTS `animals` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `species` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `image` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп даних таблиці `animals`
--

INSERT INTO `animals` (`id`, `name`, `species`, `description`, `image`) VALUES
(1, 'Слон', 'Африканський слон лісовий', 'Африканський слон лісовий (Loxodonta cyclotis), який населяє тропічні й прилеглі до них ліси, та африканський слон саванний (Loxodonta africana), — мешкає на територіях з лісовою, трав\'яною, водно-болотною, пустельною рослинністю.', 'animal1.jpg'),
(14, 'Мавпа', 'Зелена мавпа', 'Зелена мавпа живе в сухих, запилених африканських саванах. Іноді їх називають ефіопськими мавпами, оскільки ці савани розташовані на заході Ефіопії. Однак вид поширений не тільки в Ефіопії, але і в інших африканських регіонах. Цікавою є «уніформа» цього виду. «Зелені» «одягаються» строкато.', '676ddbdc7b67f_monkey.jpeg'),
(15, 'Кенгуру', 'Гігантський кенгуру', 'Гігантський кенгуру  - вид кенгуру . Чисельність виду сягає двох мільйонів особин. Є найбільшим після великого рудого кенгуру , також йому належить рекорд швидкості серед усіх кенгуру - 64 км/год. У порівнянні з іншими видами кенгуру найбільше контактує з людиною. Інша назва цього виду – сірий східний кенгуру.', '676ddc64a0f48_animal3.png'),
(16, 'Алігатор', 'Алігатор міссісіпський', 'Алігатор міссісіпський — один з двох сучасних видів алігатора. Його природний ареал включає південно-східну частину США, де він населяє заболочені території, часто в населених людиною областях. Він дещо більший за розміром, ніж інший вид алігатора, китайський алігатор.', '676ddcebea2cc_alligator.png');

-- --------------------------------------------------------

--
-- Структура таблиці `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `news_id` int NOT NULL,
  `user_id` int NOT NULL,
  `content` text COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `news_id` (`news_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп даних таблиці `comments`
--

INSERT INTO `comments` (`id`, `news_id`, `user_id`, `content`, `created_at`) VALUES
(2, 1, 7, 'віпівп', '2024-12-26 12:24:13'),
(9, 3, 7, 'еркеро', '2024-12-26 12:27:29');

-- --------------------------------------------------------

--
-- Структура таблиці `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci NOT NULL,
  `event_date` date NOT NULL,
  `time` time NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп даних таблиці `events`
--

INSERT INTO `events` (`id`, `title`, `description`, `event_date`, `time`, `image`) VALUES
(9, 'Освітні лекції та майстер-класи', 'Лекції для дітей і дорослих про збереження дикої природи, майстер-класи: створення годівничок для птахів, розпізнавання слідів тварин', '2024-12-28', '11:00:00', '676de0956c47a_save.png'),
(8, 'День відкритих дверей у зоопарку', 'Безкоштовний вхід, екскурсії з гідами, які розкажуть цікаві факти про тварин.', '2024-12-30', '15:30:00', '676ddf2f39591_event1.jpg'),
(10, 'День волонтера', 'Залучення відвідувачів до прибирання, висадки рослин або створення іграшок для тварин.', '2024-12-29', '10:00:00', '676de191381f1_volonter.jpg');

-- --------------------------------------------------------

--
-- Структура таблиці `news`
--

DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `content` text COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп даних таблиці `news`
--

INSERT INTO `news` (`id`, `title`, `content`, `image`, `created_at`) VALUES
(5, 'З Різдвом Христовим та прийдешнім Новим Роком!', 'Вітаємо всіх прекрасних людей із чудовим святом Різдва Христового та прийдешнім Новим роком! Дякуємо за вашу постійну підтримку! Світло і добро завжди перемагають!', 'happy.jpg', '2024-12-26 22:49:32'),
(7, 'Реабілітація врятованих сервалів', 'Плямисті Осіріс, Сехмет, Гор та Ісіда освоїлись у своїх нових комфортних домівках. У яких облаштовано: африканські дерева з лазалками та кігтеточкоми, гамачки,  затишні лофти для відпочинку, питні фонтанчики, різні види ґрунтів та кам’яні скелі для прогулянок і стрибків, а також купа різноманітних іграшок та подушок для котячих розва', 'save.jpg', '2024-12-26 22:52:58');

-- --------------------------------------------------------

--
-- Структура таблиці `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `login` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `access_level` int DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп даних таблиці `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `firstname`, `lastname`, `access_level`) VALUES
(10, 'ivan@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Бульба', 'Іван', 0),
(7, 'admin@ztu.edu.ua', '21232f297a57a5a743894a0e4a801fc3', 'Захаров', 'Іван ', 2);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
