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
-- Table structure for table `area`
--

DROP TABLE IF EXISTS `area`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `area` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `active` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'on' COMMENT '有効状態=on/off',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '名前',
  `contact` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '問い合わせ先',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `area`
--

LOCK TABLES `area` WRITE;
/*!40000 ALTER TABLE `area` DISABLE KEYS */;
INSERT INTO `area` VALUES (1,'on','お客様','（連絡不可）','2021-07-12 08:16:15','2021-07-12 08:16:15'),(2,'on','その他','（連絡不可）','2021-07-12 08:16:15','2021-07-12 08:16:15'),(3,'on','株式会社エクセル','contact@excelapp.iwill-sys.com','2021-07-12 08:16:15','2021-07-12 08:16:15');
/*!40000 ALTER TABLE `area` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `award`
--

DROP TABLE IF EXISTS `award`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `award` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '名前',
  `area_id` bigint(20) unsigned NOT NULL COMMENT '所属する営業所ID',
  `awardrank` int(11) NOT NULL COMMENT '賞',
  `bestchoice_id` bigint(20) unsigned NOT NULL DEFAULT 0 COMMENT '所属するべストチョイスのID',
  `bgcolor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#FFFFFF' COMMENT '背景色',
  `active` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'on' COMMENT '有効on/無効off',
  `last_user_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `award`
--

LOCK TABLES `award` WRITE;
/*!40000 ALTER TABLE `award` DISABLE KEYS */;
/*!40000 ALTER TABLE `award` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `awardchoice`
--

DROP TABLE IF EXISTS `awardchoice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `awardchoice` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `award_id` bigint(20) unsigned NOT NULL COMMENT '所属する賞',
  `area_id` bigint(20) unsigned NOT NULL COMMENT '所属する営業所ID',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '賞品名',
  `amazonlink` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'amazonlink',
  `active` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'on' COMMENT '有効状態',
  `pos` int(11) NOT NULL COMMENT '位置（昇順）',
  `desc` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '説明',
  `last_user_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `awardchoice`
--

LOCK TABLES `awardchoice` WRITE;
/*!40000 ALTER TABLE `awardchoice` DISABLE KEYS */;
/*!40000 ALTER TABLE `awardchoice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bestchoice`
--

DROP TABLE IF EXISTS `bestchoice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bestchoice` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '名前',
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '表示名',
  `area_id` bigint(20) unsigned NOT NULL COMMENT '所属する営業所ID',
  `bgcolor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#FFFFFF' COMMENT '背景色',
  `active` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'on' COMMENT '有効on/無効off',
  `last_user_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bestchoice`
--

LOCK TABLES `bestchoice` WRITE;
/*!40000 ALTER TABLE `bestchoice` DISABLE KEYS */;
/*!40000 ALTER TABLE `bestchoice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `config`
--

DROP TABLE IF EXISTS `config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `config` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'キー',
  `value` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '値',
  `desc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '説明',
  `last_user_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `config`
--

LOCK TABLES `config` WRITE;
/*!40000 ALTER TABLE `config` DISABLE KEYS */;
INSERT INTO `config` VALUES (1,'top_text','トップコンテンツ\ntop contents','トップ画面に表示するテキスト',1,'2021-07-12 08:16:15','2021-07-12 08:16:15'),(2,'match01open','on','じゃんけんゲームの開催状態',1,'2021-07-12 08:16:15','2021-07-12 08:16:15');
/*!40000 ALTER TABLE `config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `loc`
--

DROP TABLE IF EXISTS `loc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `loc` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `active` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'on' COMMENT '有効状態=on/off',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '名前',
  `user_id` int(11) NOT NULL COMMENT '担当者ID',
  `area_id` int(11) NOT NULL COMMENT '営業所ID',
  `last_user_id` int(11) NOT NULL COMMENT '編集者ID。excelappのusers::id。',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `loc`
--

LOCK TABLES `loc` WRITE;
/*!40000 ALTER TABLE `loc` DISABLE KEYS */;
/*!40000 ALTER TABLE `loc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `match01`
--

DROP TABLE IF EXISTS `match01`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `match01` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL COMMENT '提出したユーザのID',
  `hand` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '出した手：guu, cho, paa',
  `vs_match01_id` bigint(20) unsigned DEFAULT NULL COMMENT '対戦相手のmatch id',
  `result` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '勝敗：win, lose',
  `result_datetime` datetime DEFAULT NULL COMMENT '勝敗が決まった日時',
  `check_datetime` datetime DEFAULT NULL COMMENT '結果を当人が確認した日時',
  `last_user_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `match01`
--

LOCK TABLES `match01` WRITE;
/*!40000 ALTER TABLE `match01` DISABLE KEYS */;
INSERT INTO `match01` VALUES (1,3,'cho',NULL,NULL,NULL,NULL,1,'2021-07-12 08:16:15','2021-07-12 08:16:15');
/*!40000 ALTER TABLE `match01` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_user_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2020_12_25_160000_create_prize',1),(5,'2021_01_25_160000_create_area',1),(6,'2021_01_25_160000_create_loc',1),(7,'2021_02_19_160000_create_ticketlog',1),(8,'2021_03_02_000000_create_config',1),(9,'2021_03_05_000000_create_awardchoice',1),(10,'2021_03_19_000000_create_match01',1),(11,'2021_05_27_000000_create_awardbestchoice',1),(12,'2021_07_09_000000_create_coupon',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prize`
--

DROP TABLE IF EXISTS `prize`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `prize` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `award_id` bigint(20) unsigned NOT NULL COMMENT '所属する賞',
  `odr_price` int(11) DEFAULT NULL COMMENT '発注費用',
  `dlv_price` int(11) DEFAULT NULL COMMENT '納品費用',
  `loc_id` int(11) NOT NULL COMMENT '納品ロケID',
  `area_id` int(11) NOT NULL COMMENT '営業所ID',
  `tooffice` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '営業所着',
  `customer_datetime` datetime DEFAULT NULL COMMENT '応募日時。nullの場合は未応募として判断。',
  `customer_user_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'お客様ユーザID',
  `customer_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'お客様名',
  `customer_kana` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'カナ',
  `customer_zip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'お客様郵便番号',
  `customer_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'お客様住所',
  `customer_tel` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'お客様電話番号',
  `customer_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'お客様メールアドレス',
  `customer_memo` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'お客様自由記入欄',
  `awardchoice_id` bigint(20) unsigned DEFAULT NULL COMMENT 'お客様が選択した賞品',
  `notice_entry` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'お客様へ公開するメモ',
  `prv_memo` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '社内向けのメモ',
  `passcode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '応募時照合用のパスコード。URLで渡される。',
  `dlv_datetime` datetime DEFAULT NULL COMMENT '発送処理の登録日時。nullの場合は未処理として判断。',
  `dlv_cyear` int(11) DEFAULT NULL COMMENT '集計年',
  `dlv_cmonth` int(11) DEFAULT NULL COMMENT '集計月',
  `last_user_id` bigint(20) unsigned DEFAULT NULL COMMENT '編集者ID。excelappのusers::id。',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `printed` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'yet' COMMENT '印刷済み（yet/done）',
  PRIMARY KEY (`id`),
  KEY `prize_area_id_index` (`area_id`),
  KEY `prize_loc_id_index` (`loc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prize`
--

LOCK TABLES `prize` WRITE;
/*!40000 ALTER TABLE `prize` DISABLE KEYS */;
INSERT INTO `prize` VALUES (1,1,100,200,1,2,'on','2021-02-01 21:21:21','2','テスト応募者','テストオウボシャ','123-4567','埼玉県戸田市','090-1234-5678','test@dev.dev.ll','お客様メモ',1,'テストエントリーの注意書き','テスト非公開メモ','testpasscode','2021-02-01 11:11:11',2021,2,1,'2020-11-11 13:22:22','2020-11-11 13:22:22','yet');
/*!40000 ALTER TABLE `prize` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticketlog`
--

DROP TABLE IF EXISTS `ticketlog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ticketlog` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'ユーザID',
  `count` int(11) NOT NULL COMMENT '発行枚数',
  `reason` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '付与理由',
  `last_user_id` int(11) NOT NULL COMMENT '編集者ID。excelappのusers::id。',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ticketlog_created_at_index` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ticketlog`
--

LOCK TABLES `ticketlog` WRITE;
/*!40000 ALTER TABLE `ticketlog` DISABLE KEYS */;
/*!40000 ALTER TABLE `ticketlog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `active` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'on' COMMENT '有効状態：ON/OFF',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'ユーザ',
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '表示名',
  `area_id` bigint(20) NOT NULL COMMENT '営業所ID',
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '権限：社員（clerk）、お客様（customer）',
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_datetime` datetime DEFAULT NULL,
  `last_action` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_user_id` bigint(20) DEFAULT NULL COMMENT '編集者ID。excelappのusers::id。',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'on','excelapp_bdd_clerk','開発者用社員',2,'clerk','mizuno_k@cranpun.sub.jp',NULL,'$2y$10$FYgr8CSnZNnodamCLPeHLuHi/WRA0XZamKLFr7xmU47WfoPwElvJW','2021-07-12 17:16:37','user/indexcustomer',NULL,NULL,'2021-07-12 08:16:15','2021-07-12 08:16:15'),(2,'on','excelapp_bdd_customer','開発者用お客様',1,'customer','mizuno_k@cranpun.sub.jp',NULL,'$2y$10$FYgr8CSnZNnodamCLPeHLuHi/WRA0XZamKLFr7xmU47WfoPwElvJW',NULL,NULL,NULL,NULL,'2021-07-12 08:16:15','2021-07-12 08:16:15'),(3,'on','excelapp_bdd_vs','開発者用対戦相手',1,'customer','mizuno_k+vs@cranpun.sub.jp',NULL,'$2y$10$FYgr8CSnZNnodamCLPeHLuHi/WRA0XZamKLFr7xmU47WfoPwElvJW',NULL,NULL,NULL,NULL,'2021-07-12 08:16:15','2021-07-12 08:16:15'),(4,'on','bdd_test_clerk','bddテスト用社員',3,'clerk','test_clerk@dev.dev.ll',NULL,'$2y$10$j9XcJEKEUc3938FxtwGtwuwzC3X5VVGESNdJtPMaTKyYMHvV59pRC',NULL,NULL,NULL,1,'2021-07-12 08:16:25','2021-07-12 08:16:25'),(5,'on','bdd_test_customer','bddテスト用お客様',1,'customer','test_customer@dev.dev.ll',NULL,'$2y$10$1jfB28NlM8e4EBQsDedPqebrZKGo0fKAkma/Z9dxGH/IMR9xGIu92',NULL,NULL,NULL,1,'2021-07-12 08:16:36','2021-07-12 08:16:36');
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

-- Dump completed on 2021-07-12 17:16:38
