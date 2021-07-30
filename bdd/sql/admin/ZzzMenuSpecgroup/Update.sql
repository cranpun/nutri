-- MySQL dump 10.19  Distrib 10.3.29-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: homestead
-- ------------------------------------------------------
-- Server version	10.3.29-MariaDB-0ubuntu0.20.04.1-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `connection` text COLLATE utf8_unicode_ci NOT NULL,
  `queue` text COLLATE utf8_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `food`
--

DROP TABLE IF EXISTS `food`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `food` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '名前',
  `kana` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'かな',
  `category` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'カテゴリ：vegetable,meat,seafood,grain(穀物),fruit,seasoning（調味料）,etc（その他）',
  `favorite` int(11) NOT NULL DEFAULT 0 COMMENT 'お気に入り。昇順。',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `food_kana_unique` (`kana`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `food`
--

LOCK TABLES `food` WRITE;
/*!40000 ALTER TABLE `food` DISABLE KEYS */;
INSERT INTO `food` VALUES (1,'豚肉','ぶたにく','meat',0,'2021-07-30 05:44:48','2021-07-30 05:44:48'),(2,'卵','たまご','etc',0,'2021-07-30 05:44:48','2021-07-30 05:44:48'),(3,'牛乳','ぎゅうにゅう','etc',0,'2021-07-30 05:44:48','2021-07-30 05:44:48'),(4,'updatebdd_test_food','bdd_test_food_kana','seafood',0,'2021-07-30 05:44:58','2021-07-30 05:45:22');
/*!40000 ALTER TABLE `food` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `foodnutri`
--

DROP TABLE IF EXISTS `foodnutri`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `foodnutri` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `food_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '食材',
  `nutri_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '栄養素',
  `amount` int(11) NOT NULL DEFAULT 0 COMMENT '含有量：未使用',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `foodnutri`
--

LOCK TABLES `foodnutri` WRITE;
/*!40000 ALTER TABLE `foodnutri` DISABLE KEYS */;
INSERT INTO `foodnutri` VALUES (1,'1','1',0,'2021-07-30 05:44:48','2021-07-30 05:44:48'),(2,'1','2',0,'2021-07-30 05:44:48','2021-07-30 05:44:48'),(3,'1','3',0,'2021-07-30 05:44:48','2021-07-30 05:44:48'),(4,'1','4',0,'2021-07-30 05:44:48','2021-07-30 05:44:48'),(5,'1','12',0,'2021-07-30 05:44:48','2021-07-30 05:44:48'),(6,'1','14',0,'2021-07-30 05:44:48','2021-07-30 05:44:48'),(7,'1','16',0,'2021-07-30 05:44:48','2021-07-30 05:44:48'),(8,'1','27',0,'2021-07-30 05:44:48','2021-07-30 05:44:48'),(9,'1','32',0,'2021-07-30 05:44:48','2021-07-30 05:44:48'),(10,'2','1',0,'2021-07-30 05:44:48','2021-07-30 05:44:48'),(11,'2','4',0,'2021-07-30 05:44:48','2021-07-30 05:44:48'),(12,'2','8',0,'2021-07-30 05:44:48','2021-07-30 05:44:48'),(13,'2','18',0,'2021-07-30 05:44:48','2021-07-30 05:44:48'),(14,'2','19',0,'2021-07-30 05:44:48','2021-07-30 05:44:48'),(15,'2','25',0,'2021-07-30 05:44:48','2021-07-30 05:44:48'),(16,'2','31',0,'2021-07-30 05:44:48','2021-07-30 05:44:48'),(17,'3','1',0,'2021-07-30 05:44:48','2021-07-30 05:44:48'),(18,'3','8',0,'2021-07-30 05:44:48','2021-07-30 05:44:48'),(19,'3','13',0,'2021-07-30 05:44:48','2021-07-30 05:44:48'),(20,'3','23',0,'2021-07-30 05:44:48','2021-07-30 05:44:48'),(21,'3','25',0,'2021-07-30 05:44:48','2021-07-30 05:44:48'),(25,'4','2',0,'2021-07-30 05:45:22','2021-07-30 05:45:22'),(26,'4','3',0,'2021-07-30 05:45:22','2021-07-30 05:45:22'),(27,'4','4',0,'2021-07-30 05:45:22','2021-07-30 05:45:22');
/*!40000 ALTER TABLE `foodnutri` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '名前',
  `memo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'メモ',
  `servedate` date NOT NULL COMMENT '提供日',
  `timing` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'lunch/dinner',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu`
--

LOCK TABLES `menu` WRITE;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` VALUES (1,'bdd_menu1','bdd_memo1','2021-07-30','lunch','2021-07-30 05:51:00','2021-07-30 05:51:00'),(2,'bdd_menu2','bdd_memo2','2021-07-30','lunch','2021-07-30 05:51:00','2021-07-30 05:51:00');
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menufood`
--

DROP TABLE IF EXISTS `menufood`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menufood` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '献立',
  `food_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '食材',
  `amount` int(11) NOT NULL DEFAULT 0 COMMENT '含有量：未使用',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menufood`
--

LOCK TABLES `menufood` WRITE;
/*!40000 ALTER TABLE `menufood` DISABLE KEYS */;
INSERT INTO `menufood` VALUES (1,'1','3',0,'2021-07-30 05:51:00','2021-07-30 05:51:00'),(2,'1','2',0,'2021-07-30 05:51:00','2021-07-30 05:51:00'),(3,'1','1',0,'2021-07-30 05:51:00','2021-07-30 05:51:00'),(4,'2','3',0,'2021-07-30 05:51:00','2021-07-30 05:51:00'),(5,'2','2',0,'2021-07-30 05:51:00','2021-07-30 05:51:00'),(6,'2','1',0,'2021-07-30 05:51:00','2021-07-30 05:51:00');
/*!40000 ALTER TABLE `menufood` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_user_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2021_07_14_000000_create_food',1),(5,'2021_07_14_000000_create_foodnutri',1),(6,'2021_07_14_000000_create_menu',1),(7,'2021_07_14_000000_create_menufood',1),(8,'2021_07_14_000000_create_nutri',1),(9,'2021_07_29_000000_add_foodkana',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nutri`
--

DROP TABLE IF EXISTS `nutri`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nutri` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '名前',
  `dailyrequired` int(11) NOT NULL DEFAULT 0 COMMENT '1日の必須量：未使用',
  `pos` int(11) NOT NULL COMMENT '表示位置。昇順。',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nutri`
--

LOCK TABLES `nutri` WRITE;
/*!40000 ALTER TABLE `nutri` DISABLE KEYS */;
INSERT INTO `nutri` VALUES (1,'タンパク質',0,10,'2021-07-30 05:44:48','2021-07-30 05:44:48'),(2,'脂質',0,20,'2021-07-30 05:44:48','2021-07-30 05:44:48'),(3,'飽和脂肪酸',0,30,'2021-07-30 05:44:48','2021-07-30 05:44:48'),(4,'n-6系脂肪酸',0,40,'2021-07-30 05:44:48','2021-07-30 05:44:48'),(5,'n-3系脂肪酸',0,50,'2021-07-30 05:44:48','2021-07-30 05:44:48'),(6,'炭水化物',0,60,'2021-07-30 05:44:48','2021-07-30 05:44:48'),(7,'食物繊維',0,70,'2021-07-30 05:44:48','2021-07-30 05:44:48'),(8,'ビタミンA',0,80,'2021-07-30 05:44:48','2021-07-30 05:44:48'),(9,'ビタミンD',0,90,'2021-07-30 05:44:48','2021-07-30 05:44:48'),(10,'ビタミンE',0,100,'2021-07-30 05:44:48','2021-07-30 05:44:48'),(11,'ビタミンK',0,110,'2021-07-30 05:44:48','2021-07-30 05:44:48'),(12,'ビタミンB1',0,120,'2021-07-30 05:44:48','2021-07-30 05:44:48'),(13,'ビタミンB2',0,130,'2021-07-30 05:44:48','2021-07-30 05:44:48'),(14,'ビタミンB6',0,140,'2021-07-30 05:44:48','2021-07-30 05:44:48'),(15,'ビタミンB12',0,150,'2021-07-30 05:44:48','2021-07-30 05:44:48'),(16,'ナイアシン',0,160,'2021-07-30 05:44:48','2021-07-30 05:44:48'),(17,'葉酸',0,170,'2021-07-30 05:44:48','2021-07-30 05:44:48'),(18,'パントテン酸',0,180,'2021-07-30 05:44:48','2021-07-30 05:44:48'),(19,'ビオチン',0,190,'2021-07-30 05:44:48','2021-07-30 05:44:48'),(20,'ビタミンC',0,200,'2021-07-30 05:44:48','2021-07-30 05:44:48'),(21,'ナトリウム',0,210,'2021-07-30 05:44:48','2021-07-30 05:44:48'),(22,'カリウム',0,220,'2021-07-30 05:44:48','2021-07-30 05:44:48'),(23,'カルシウム',0,230,'2021-07-30 05:44:48','2021-07-30 05:44:48'),(24,'マグネシウム',0,240,'2021-07-30 05:44:48','2021-07-30 05:44:48'),(25,'リン',0,250,'2021-07-30 05:44:48','2021-07-30 05:44:48'),(26,'鉄',0,260,'2021-07-30 05:44:48','2021-07-30 05:44:48'),(27,'亜鉛',0,270,'2021-07-30 05:44:48','2021-07-30 05:44:48'),(28,'銅',0,280,'2021-07-30 05:44:48','2021-07-30 05:44:48'),(29,'マンガン',0,290,'2021-07-30 05:44:48','2021-07-30 05:44:48'),(30,'ヨウ素',0,300,'2021-07-30 05:44:48','2021-07-30 05:44:48'),(31,'セレン',0,310,'2021-07-30 05:44:48','2021-07-30 05:44:48'),(32,'クロム',0,320,'2021-07-30 05:44:48','2021-07-30 05:44:48'),(33,'モリブデン',0,330,'2021-07-30 05:44:48','2021-07-30 05:44:48');
/*!40000 ALTER TABLE `nutri` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'admin',
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_datetime` datetime DEFAULT NULL,
  `last_action` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_user_id` bigint(20) DEFAULT NULL COMMENT '編集者のuser_ID',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'nutri_bdd_admin','開発者用管理者','admin','mizuno_k+nutri_bdd_admin@cranpun.sub.jp','2021-07-30 05:44:48','$2y$10$Sbjg0oCnsavSp71.IJvtEuiiFAc9S6vgBpX.3AwanJkzJk88rCG.C',NULL,NULL,NULL,NULL,'2021-07-30 05:44:48','2021-07-30 05:44:48');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-07-30 14:51:02
