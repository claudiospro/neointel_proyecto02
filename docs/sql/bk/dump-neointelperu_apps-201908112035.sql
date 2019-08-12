-- MySQL dump 10.16  Distrib 10.1.38-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: neointelperu_apps
-- ------------------------------------------------------
-- Server version	10.1.38-MariaDB-0+deb9u1

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
-- Table structure for table `campania`
--

DROP TABLE IF EXISTS `campania`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `campania` (
  `info_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `info_create_user` int(11) DEFAULT '1',
  `info_update` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `info_update_user` int(11) DEFAULT NULL,
  `info_status` tinyint(1) DEFAULT '1',
  `info_order` tinyint(4) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` text COLLATE utf8_unicode_ci,
  `indice` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `venta` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `campania`
--

LOCK TABLES `campania` WRITE;
/*!40000 ALTER TABLE `campania` DISABLE KEYS */;
INSERT INTO `campania` VALUES ('2016-01-20 19:47:48',1,'0000-00-00 00:00:00',NULL,0,0,1,'Canal +','campania_004',1),('2016-01-20 19:47:48',1,'0000-00-00 00:00:00',NULL,0,0,2,'Movistar Fusión','campania_003',1),('2016-01-20 19:47:48',1,'0000-00-00 00:00:00',NULL,0,0,3,'Vodafone One','campania_001',1),('2016-02-26 14:24:55',1,'0000-00-00 00:00:00',NULL,0,0,4,'Vodafone One Pymes','campania_002',1),('2019-07-25 03:49:49',1,'0000-00-00 00:00:00',NULL,1,1,5,'Integra','campania_005',1),('2019-07-25 03:49:49',1,'0000-00-00 00:00:00',NULL,0,2,6,'Inserimos','campania_006',1);
/*!40000 ALTER TABLE `campania` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `campania_history`
--

DROP TABLE IF EXISTS `campania_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `campania_history` (
  `info_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `info_create_user` int(11) DEFAULT '1',
  `info_status` tinyint(1) DEFAULT '1',
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `history_id` int(11) DEFAULT NULL,
  `nombre` text COLLATE utf8_unicode_ci,
  `indice` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `campania_history`
--

LOCK TABLES `campania_history` WRITE;
/*!40000 ALTER TABLE `campania_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `campania_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `campania_lineal`
--

DROP TABLE IF EXISTS `campania_lineal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `campania_lineal` (
  `info_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `info_create_user` int(11) DEFAULT '1',
  `info_update` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `info_update_user` int(11) DEFAULT NULL,
  `info_status` tinyint(1) DEFAULT '1',
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `lineal_id` int(11) DEFAULT NULL,
  `campania_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `campania_lineal`
--

LOCK TABLES `campania_lineal` WRITE;
/*!40000 ALTER TABLE `campania_lineal` DISABLE KEYS */;
INSERT INTO `campania_lineal` VALUES ('2016-01-20 19:47:48',1,'2019-07-24 04:56:33',1,1,1,1,1),('2016-01-20 19:47:48',1,'2019-07-07 19:58:48',2,1,2,2,1),('2016-01-20 19:47:48',1,'0000-00-00 00:00:00',NULL,1,3,3,1),('2016-02-26 15:20:11',1,'0000-00-00 00:00:00',NULL,1,4,4,2),('2016-02-26 15:43:29',1,'0000-00-00 00:00:00',NULL,1,5,5,3),('2019-07-25 03:53:40',1,'0000-00-00 00:00:00',NULL,1,20,8,6),('2019-07-25 03:53:40',1,'0000-00-00 00:00:00',NULL,1,19,7,5),('2019-07-24 15:15:09',1,'0000-00-00 00:00:00',NULL,1,18,6,1);
/*!40000 ALTER TABLE `campania_lineal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `campania_lineal_history`
--

DROP TABLE IF EXISTS `campania_lineal_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `campania_lineal_history` (
  `info_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `info_create_user` int(11) DEFAULT '1',
  `info_status` tinyint(1) DEFAULT '1',
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `history_id` bigint(20) DEFAULT NULL,
  `lineal_id` int(11) DEFAULT NULL,
  `campania_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `campania_lineal_history`
--

LOCK TABLES `campania_lineal_history` WRITE;
/*!40000 ALTER TABLE `campania_lineal_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `campania_lineal_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lineal`
--

DROP TABLE IF EXISTS `lineal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lineal` (
  `info_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `info_create_user` int(11) DEFAULT '1',
  `info_update` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `info_update_user` int(11) DEFAULT NULL,
  `info_status` tinyint(1) DEFAULT '1',
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lineal`
--

LOCK TABLES `lineal` WRITE;
/*!40000 ALTER TABLE `lineal` DISABLE KEYS */;
INSERT INTO `lineal` VALUES ('2016-01-20 19:47:48',1,'2019-07-24 04:56:33',1,1,1,'Lineal 01 Perú'),('2016-01-20 19:47:48',1,'2019-07-07 19:58:48',2,1,2,'Lineal 02'),('2016-01-20 19:47:48',1,'0000-00-00 00:00:00',NULL,1,3,'Lineal 03'),('2016-02-26 15:40:47',1,'0000-00-00 00:00:00',NULL,1,4,'Lineal 4 (temporal)'),('2016-02-26 15:40:47',1,'0000-00-00 00:00:00',NULL,1,5,'Lineal 5'),('2019-07-24 15:15:09',1,'0000-00-00 00:00:00',NULL,1,6,'Lineal 04'),('2019-07-24 15:15:09',1,'2019-07-24 15:15:09',1,1,7,'Lineal 06'),('2019-07-25 03:53:05',1,'0000-00-00 00:00:00',1,1,8,'Lineal 07');
/*!40000 ALTER TABLE `lineal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lineal_history`
--

DROP TABLE IF EXISTS `lineal_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lineal_history` (
  `info_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `info_create_user` int(11) DEFAULT '1',
  `info_status` tinyint(1) DEFAULT '1',
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `history_id` bigint(20) DEFAULT NULL,
  `nombre` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lineal_history`
--

LOCK TABLES `lineal_history` WRITE;
/*!40000 ALTER TABLE `lineal_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `lineal_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mensajes`
--

DROP TABLE IF EXISTS `mensajes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mensajes` (
  `mensaje` varchar(100) DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mensajes`
--

LOCK TABLES `mensajes` WRITE;
/*!40000 ALTER TABLE `mensajes` DISABLE KEYS */;
INSERT INTO `mensajes` VALUES ('test mensaje','2015-11-22 05:00:00',1,1),('test mensaje áá','2015-11-22 05:00:00',1,2);
/*!40000 ALTER TABLE `mensajes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usu_cese_tipo`
--

DROP TABLE IF EXISTS `usu_cese_tipo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usu_cese_tipo` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) DEFAULT NULL,
  `info_status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usu_cese_tipo`
--

LOCK TABLES `usu_cese_tipo` WRITE;
/*!40000 ALTER TABLE `usu_cese_tipo` DISABLE KEYS */;
/*!40000 ALTER TABLE `usu_cese_tipo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usu_perfil`
--

DROP TABLE IF EXISTS `usu_perfil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usu_perfil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usu_perfil`
--

LOCK TABLES `usu_perfil` WRITE;
/*!40000 ALTER TABLE `usu_perfil` DISABLE KEYS */;
INSERT INTO `usu_perfil` VALUES (1,'Admin'),(2,'Gerencia'),(3,'Tramitacion'),(4,'Supervisor'),(5,'Asesor Comercial'),(6,'Coordinador');
/*!40000 ALTER TABLE `usu_perfil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usu_perfil_recurso`
--

DROP TABLE IF EXISTS `usu_perfil_recurso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usu_perfil_recurso` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `perfil_id` int(11) NOT NULL,
  `recurso_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usu_perfil_recurso`
--

LOCK TABLES `usu_perfil_recurso` WRITE;
/*!40000 ALTER TABLE `usu_perfil_recurso` DISABLE KEYS */;
INSERT INTO `usu_perfil_recurso` VALUES (1,1,1),(2,1,2),(3,2,1),(4,3,1),(5,4,1),(6,5,1),(7,6,1),(8,1,3),(9,2,3),(10,3,3),(11,6,3),(12,1,4),(13,2,4),(14,6,4),(15,2,2);
/*!40000 ALTER TABLE `usu_perfil_recurso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usu_recurso`
--

DROP TABLE IF EXISTS `usu_recurso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usu_recurso` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usu_recurso`
--

LOCK TABLES `usu_recurso` WRITE;
/*!40000 ALTER TABLE `usu_recurso` DISABLE KEYS */;
INSERT INTO `usu_recurso` VALUES (1,'Ventas'),(2,'Usuario'),(3,'Barrido'),(4,'Base');
/*!40000 ALTER TABLE `usu_recurso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usu_usuario`
--

DROP TABLE IF EXISTS `usu_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usu_usuario` (
  `info_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `info_create_user` int(11) DEFAULT '1',
  `info_update` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `info_update_user` int(11) DEFAULT NULL,
  `info_status` tinyint(1) DEFAULT '1',
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` text,
  `nombre_corto` varchar(500) NOT NULL,
  `imagen` text,
  `login` varchar(100) DEFAULT NULL,
  `pwd` varchar(50) DEFAULT '$4nkNrBEK8ra2',
  `fecha_cese` timestamp NULL DEFAULT NULL,
  `fecha_entrada` timestamp NULL DEFAULT NULL,
  `comentario` varchar(600) DEFAULT NULL,
  `telefono` varchar(150) DEFAULT NULL,
  `direccion` varchar(500) DEFAULT NULL,
  `cese_observacion` varchar(600) DEFAULT NULL,
  `cese_tipo` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usu_usuario`
--

LOCK TABLES `usu_usuario` WRITE;
/*!40000 ALTER TABLE `usu_usuario` DISABLE KEYS */;
INSERT INTO `usu_usuario` VALUES ('2016-01-21 00:47:48',1,'2019-08-11 15:56:07',1,1,1,'claudio rodriguez','Claud',NULL,'crodriguez','$4M4mpfilkNnU','0000-00-00 00:00:00','2019-07-07 05:00:00','','','','',0),('2019-08-11 15:57:49',1,'2019-08-11 15:59:39',1,0,32,'Juan Perez','Jperez',NULL,'jperez','$4nkNrBEK8ra2','2019-08-11 05:00:00','2019-08-11 05:00:00','','32235232','','',0),('2019-07-25 04:59:33',1,'2019-07-27 06:16:33',1,1,29,'Rosario Jauregui','Charito',NULL,'charo','$4M4mpfilkNnU','0000-00-00 00:00:00','2019-07-10 05:00:00','','','','',0),('2019-07-27 07:48:27',1,'0000-00-00 00:00:00',NULL,1,30,'July Resaz','July',NULL,'july','$4nkNrBEK8ra2','0000-00-00 00:00:00','2019-07-15 05:00:00','','','','',0),('2019-07-27 07:49:50',1,'0000-00-00 00:00:00',NULL,1,31,'Paty Sup','Pat',NULL,'paty','$4nkNrBEK8ra2','0000-00-00 00:00:00','2019-07-03 05:00:00','','','','',0);
/*!40000 ALTER TABLE `usu_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usu_usuario_history`
--

DROP TABLE IF EXISTS `usu_usuario_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usu_usuario_history` (
  `info_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `info_create_user` int(11) DEFAULT '1',
  `info_status` tinyint(1) DEFAULT '1',
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `history_id` bigint(20) DEFAULT NULL,
  `nombre` text COLLATE utf8_unicode_ci,
  `imagen` text COLLATE utf8_unicode_ci,
  `login` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pwd` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usu_usuario_history`
--

LOCK TABLES `usu_usuario_history` WRITE;
/*!40000 ALTER TABLE `usu_usuario_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `usu_usuario_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usu_usuario_lineal`
--

DROP TABLE IF EXISTS `usu_usuario_lineal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usu_usuario_lineal` (
  `info_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `info_create_user` int(11) DEFAULT '1',
  `info_update` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `info_update_user` int(11) DEFAULT NULL,
  `info_status` tinyint(1) DEFAULT '1',
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `usuario_id` bigint(20) NOT NULL,
  `lineal_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=175 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usu_usuario_lineal`
--

LOCK TABLES `usu_usuario_lineal` WRITE;
/*!40000 ALTER TABLE `usu_usuario_lineal` DISABLE KEYS */;
INSERT INTO `usu_usuario_lineal` VALUES ('2019-07-27 07:48:27',1,'0000-00-00 00:00:00',NULL,1,170,30,7),('2019-07-25 05:00:06',1,'0000-00-00 00:00:00',NULL,1,169,29,7),('2019-07-24 15:15:46',1,'0000-00-00 00:00:00',NULL,1,160,26,5),('2019-07-24 07:32:50',1,'0000-00-00 00:00:00',NULL,1,155,5,5),('2019-07-07 19:58:03',2,'0000-00-00 00:00:00',NULL,1,121,27,5),('2019-07-24 15:15:46',1,'0000-00-00 00:00:00',NULL,1,159,26,6),('2019-07-24 15:15:46',1,'0000-00-00 00:00:00',NULL,1,158,26,3),('2019-07-24 15:15:46',1,'0000-00-00 00:00:00',NULL,1,157,26,2),('2019-07-24 15:15:46',1,'0000-00-00 00:00:00',NULL,1,156,26,1),('2019-07-07 20:33:03',1,'0000-00-00 00:00:00',NULL,1,146,6,5),('2019-07-07 20:33:03',1,'0000-00-00 00:00:00',NULL,1,145,6,4),('2019-07-07 20:33:03',1,'0000-00-00 00:00:00',NULL,1,144,6,3),('2019-07-07 20:33:03',1,'0000-00-00 00:00:00',NULL,1,143,6,2),('2019-07-07 20:32:15',1,'0000-00-00 00:00:00',NULL,1,141,4,5),('2019-07-07 20:32:15',1,'0000-00-00 00:00:00',NULL,1,140,4,4),('2019-07-07 20:32:15',1,'0000-00-00 00:00:00',NULL,1,139,4,3),('2019-07-07 17:14:20',2,'0000-00-00 00:00:00',NULL,1,61,28,1),('2019-08-11 15:59:39',1,'0000-00-00 00:00:00',NULL,1,174,32,7),('2019-08-11 15:56:07',1,'0000-00-00 00:00:00',NULL,1,172,1,7),('2019-07-24 07:32:50',1,'0000-00-00 00:00:00',NULL,1,154,5,1),('2019-07-07 20:33:03',1,'0000-00-00 00:00:00',NULL,1,142,6,1),('2019-07-07 06:08:06',1,'0000-00-00 00:00:00',NULL,1,46,2,1),('2019-07-07 20:32:15',1,'0000-00-00 00:00:00',NULL,1,138,4,2),('2019-07-07 20:32:15',1,'0000-00-00 00:00:00',NULL,1,137,4,1),('2019-07-07 17:12:40',2,'0000-00-00 00:00:00',NULL,1,60,3,1),('2019-07-27 07:49:50',1,'0000-00-00 00:00:00',NULL,1,171,31,7);
/*!40000 ALTER TABLE `usu_usuario_lineal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usu_usuario_lineal_history`
--

DROP TABLE IF EXISTS `usu_usuario_lineal_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usu_usuario_lineal_history` (
  `info_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `info_create_user` int(11) DEFAULT '1',
  `info_status` tinyint(1) DEFAULT '1',
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `history_id` bigint(20) DEFAULT NULL,
  `usuario_id` bigint(20) NOT NULL,
  `lineal_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usu_usuario_lineal_history`
--

LOCK TABLES `usu_usuario_lineal_history` WRITE;
/*!40000 ALTER TABLE `usu_usuario_lineal_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `usu_usuario_lineal_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usu_usuario_perfil`
--

DROP TABLE IF EXISTS `usu_usuario_perfil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usu_usuario_perfil` (
  `info_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `info_create_user` int(11) DEFAULT '1',
  `info_update` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `info_update_user` int(11) DEFAULT NULL,
  `info_status` tinyint(1) DEFAULT '1',
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `usuario_id` bigint(20) NOT NULL,
  `perfil_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usu_usuario_perfil`
--

LOCK TABLES `usu_usuario_perfil` WRITE;
/*!40000 ALTER TABLE `usu_usuario_perfil` DISABLE KEYS */;
INSERT INTO `usu_usuario_perfil` VALUES ('2016-01-20 19:47:48',1,'2019-08-11 15:56:07',1,1,1,1,1),('2016-01-20 19:47:48',1,'2019-07-07 06:08:06',1,1,2,2,2),('2016-01-20 19:47:48',1,'2019-07-07 17:12:40',2,1,3,3,3),('2016-01-20 19:47:48',1,'2019-07-07 20:32:15',1,1,4,4,5),('2016-01-20 19:47:48',1,'2019-07-24 07:32:50',1,1,5,5,5),('2016-01-21 18:00:08',1,'2019-07-07 20:33:03',1,1,6,6,6),('2016-02-26 20:23:17',1,'2019-07-24 15:15:46',1,1,7,26,4),('2016-02-26 20:23:17',1,'2019-07-07 19:58:03',2,1,8,27,5),('2019-07-07 17:14:20',2,'0000-00-00 00:00:00',NULL,1,9,28,5),('2019-07-25 04:59:33',1,'2019-07-25 05:00:06',1,1,10,29,5),('2019-07-27 07:48:27',1,'0000-00-00 00:00:00',NULL,1,11,30,4),('2019-07-27 07:49:50',1,'0000-00-00 00:00:00',NULL,1,12,31,6),('2019-08-11 15:57:49',1,'2019-08-11 15:59:39',1,1,13,32,1);
/*!40000 ALTER TABLE `usu_usuario_perfil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usu_usuario_perfil_history`
--

DROP TABLE IF EXISTS `usu_usuario_perfil_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usu_usuario_perfil_history` (
  `info_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `info_create_user` int(11) DEFAULT '1',
  `info_status` tinyint(1) DEFAULT '1',
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `history_id` bigint(20) DEFAULT NULL,
  `usuario_id` bigint(20) NOT NULL,
  `perfil_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usu_usuario_perfil_history`
--

LOCK TABLES `usu_usuario_perfil_history` WRITE;
/*!40000 ALTER TABLE `usu_usuario_perfil_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `usu_usuario_perfil_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `venta`
--

DROP TABLE IF EXISTS `venta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `venta` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `info_create_fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `info_create_user` bigint(20) NOT NULL,
  `info_update_fecha` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `info_update_user` bigint(20) NOT NULL,
  `info_status` tinyint(1) NOT NULL DEFAULT '1',
  `asesor_venta_id` bigint(20) NOT NULL,
  `tramitacion_id` bigint(20) NOT NULL,
  `supervisor_id` bigint(20) NOT NULL,
  `coordinador_id` bigint(20) NOT NULL,
  `campania` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `lineal_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `venta`
--

LOCK TABLES `venta` WRITE;
/*!40000 ALTER TABLE `venta` DISABLE KEYS */;
INSERT INTO `venta` VALUES (7,'2016-01-28 12:49:14',5,'2016-02-18 18:39:24',5,1,5,3,4,6,'campania_001',1),(10,'2016-02-01 15:00:56',5,'2016-02-19 21:41:46',6,0,5,3,4,6,'campania_001',1),(11,'2016-02-01 16:48:21',5,'2016-02-22 21:59:49',4,1,5,3,4,6,'campania_001',1),(16,'2016-02-01 18:16:44',6,'2016-02-01 18:16:49',6,1,6,3,4,6,'campania_001',1),(17,'2016-02-11 15:34:35',5,'2019-07-24 07:29:13',1,1,5,3,4,6,'campania_001',1),(18,'2016-02-11 15:44:44',5,'2016-02-19 21:41:39',6,1,5,3,4,6,'campania_001',1),(19,'2016-02-22 12:47:43',5,'2016-02-22 12:47:43',0,1,5,0,4,6,'campania_001',1),(20,'2016-02-23 13:33:51',4,'2016-02-23 13:33:53',4,1,4,0,4,6,'campania_001',1),(21,'2016-02-23 14:30:22',3,'2016-02-23 14:30:22',0,1,3,0,4,6,'campania_001',1),(23,'2016-02-29 14:58:35',27,'2016-02-29 14:58:54',26,1,27,0,26,6,'campania_002',5),(24,'2016-02-29 16:11:07',6,'2016-02-29 16:11:07',0,1,6,0,4,6,'campania_001',1),(25,'2016-02-29 16:11:07',1,'2019-07-21 20:55:57',1,1,1,1,1,1,'campania_004',1),(26,'2016-02-29 16:11:07',1,'2019-07-24 06:19:10',1,1,1,1,1,1,'campania_004',1),(27,'2019-07-21 21:37:27',5,'2019-07-22 00:01:56',1,1,5,0,26,6,'campania_004',1),(28,'2019-07-21 22:32:01',5,'2019-07-24 15:21:07',1,0,5,0,26,6,'campania_004',1),(29,'2019-07-24 06:09:46',5,'2019-07-24 06:09:46',0,1,5,0,26,6,'campania_004',1),(30,'2019-07-24 06:12:01',5,'2019-07-24 06:50:11',1,1,5,0,26,6,'campania_004',1),(31,'2019-07-27 07:50:02',29,'2019-08-06 14:30:19',1,0,29,0,30,31,'campania_005',7),(32,'2019-07-27 08:09:54',29,'2019-07-27 08:22:51',1,0,29,0,30,31,'campania_005',7),(33,'2019-07-27 08:15:04',29,'2019-07-27 08:22:48',1,0,29,0,30,31,'campania_005',7),(34,'2019-07-27 08:15:21',29,'2019-07-27 18:11:11',0,0,29,0,30,31,'campania_005',7),(35,'2019-07-27 15:27:21',29,'2019-08-03 04:29:20',1,0,29,0,30,31,'campania_005',7),(36,'2019-07-27 15:51:55',29,'2019-07-27 18:10:49',0,0,29,0,30,31,'campania_005',7),(37,'2019-07-27 15:52:19',29,'2019-07-30 02:34:10',1,1,29,0,30,31,'campania_005',7),(38,'2019-07-27 16:35:05',29,'2019-07-27 18:10:54',0,0,29,0,30,31,'campania_005',7),(39,'2019-07-27 16:35:23',29,'2019-07-27 18:10:57',0,0,29,0,30,31,'campania_005',7),(40,'2019-07-27 16:36:38',29,'2019-07-27 18:11:04',0,0,29,0,30,31,'campania_005',7),(41,'2019-07-27 16:39:38',29,'2019-07-27 18:11:18',0,0,29,0,30,31,'campania_005',7),(42,'2019-07-27 16:41:22',29,'2019-07-30 01:00:16',0,1,29,0,30,31,'campania_005',7),(43,'2019-07-27 16:46:30',29,'2019-07-27 18:11:33',0,0,29,0,30,31,'campania_005',7),(44,'2019-07-27 16:48:49',29,'2019-07-27 18:11:00',0,0,29,0,30,31,'campania_005',7),(45,'2019-07-27 16:52:30',29,'2019-07-27 18:11:06',0,0,29,0,30,31,'campania_005',7),(46,'2019-07-27 16:54:14',29,'2019-07-27 18:11:14',0,0,29,0,30,31,'campania_005',7),(47,'2019-07-27 16:57:13',29,'2019-07-27 18:10:51',0,0,29,0,30,31,'campania_005',7),(48,'2019-07-27 16:58:04',29,'2019-07-27 18:11:23',0,0,29,0,30,31,'campania_005',7),(49,'2019-07-27 16:59:24',29,'2019-07-27 18:11:26',0,0,29,0,30,31,'campania_005',7);
/*!40000 ALTER TABLE `venta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `venta_booleano`
--

DROP TABLE IF EXISTS `venta_booleano`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `venta_booleano` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `info_status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `venta_booleano`
--

LOCK TABLES `venta_booleano` WRITE;
/*!40000 ALTER TABLE `venta_booleano` DISABLE KEYS */;
INSERT INTO `venta_booleano` VALUES (1,'SI',1),(2,'NO',1);
/*!40000 ALTER TABLE `venta_booleano` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `venta_cambio_titular_005`
--

DROP TABLE IF EXISTS `venta_cambio_titular_005`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `venta_cambio_titular_005` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `info_status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `venta_cambio_titular_005`
--

LOCK TABLES `venta_cambio_titular_005` WRITE;
/*!40000 ALTER TABLE `venta_cambio_titular_005` DISABLE KEYS */;
INSERT INTO `venta_cambio_titular_005` VALUES (1,'SI',1),(2,'NO',1);
/*!40000 ALTER TABLE `venta_cambio_titular_005` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `venta_campania_001`
--

DROP TABLE IF EXISTS `venta_campania_001`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `venta_campania_001` (
  `id` bigint(20) NOT NULL,
  `cliente_nombre` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `cliente_tipo` bigint(20) NOT NULL,
  `cliente_documento_tipo` bigint(20) NOT NULL,
  `cliente_documento` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `cliente_documento_reverso` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `cliente_nacimiento` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `cliente_correo` varchar(600) COLLATE utf8_unicode_ci NOT NULL,
  `cuenta_bancaria` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `cliente_contacto_fijo` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `cliente_contacto_movil` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `provincia` bigint(20) NOT NULL,
  `localidad` bigint(20) NOT NULL,
  `codigo_postal` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `direccion_tipo` bigint(20) NOT NULL,
  `direccion_nombre` bigint(20) NOT NULL,
  `direccion_numero` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `direccion_piso` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `direccion_puerta` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `direccion_id` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `producto` bigint(20) NOT NULL,
  `fijo_numero` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `fijo_modalidad` bigint(20) NOT NULL,
  `fijo_operador` bigint(20) NOT NULL,
  `fijo_titular` bigint(20) NOT NULL,
  `fijo_titular_documento` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `fijo_titular_nombre` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `movil_numero` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `movil_modalidad` bigint(20) NOT NULL,
  `movil_operador` bigint(20) NOT NULL,
  `movil_tarifa` bigint(20) NOT NULL,
  `movil_terminal` varchar(600) COLLATE utf8_unicode_ci NOT NULL,
  `movil_titular` bigint(20) NOT NULL,
  `movil_titular_documento` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `movil_titular_nombre` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `movil_estado` bigint(20) NOT NULL,
  `movil_icc` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `producto_observacion` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `movil_adicional_1_numero` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `movil_adicional_1_modalidad` bigint(20) NOT NULL,
  `movil_adicional_1_operador` bigint(20) NOT NULL,
  `movil_adicional_1_tarifa` bigint(20) NOT NULL,
  `movil_adicional_1_terminal` varchar(600) COLLATE utf8_unicode_ci NOT NULL,
  `movil_adicional_1_titular` bigint(20) NOT NULL,
  `movil_adicional_1_titular_documento` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `movil_adicional_1_titular_nombre` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `movil_adicional_1_estado` bigint(20) NOT NULL,
  `movil_adicional_1_icc` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `movil_adicional_2_numero` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `movil_adicional_2_modalidad` bigint(20) NOT NULL,
  `movil_adicional_2_operador` bigint(20) NOT NULL,
  `movil_adicional_2_tarifa` bigint(20) NOT NULL,
  `movil_adicional_2_terminal` varchar(600) COLLATE utf8_unicode_ci NOT NULL,
  `movil_adicional_2_titular` bigint(20) NOT NULL,
  `movil_adicional_2_titular_documento` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `movil_adicional_2_titular_nombre` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `movil_adicional_2_estado` bigint(20) NOT NULL,
  `movil_adicional_2_icc` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `estado` bigint(20) NOT NULL DEFAULT '1',
  `estado_real` bigint(20) NOT NULL DEFAULT '1',
  `estado_observacion` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `aprobado_supervisor` bigint(20) NOT NULL,
  `fecha_instalada` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `venta_campania_001`
--

LOCK TABLES `venta_campania_001` WRITE;
/*!40000 ALTER TABLE `venta_campania_001` DISABLE KEYS */;
INSERT INTO `venta_campania_001` VALUES (7,'Carlos Garcia Lopez',1,1,'45460258-D','8888888','01-09-88','nodispone@outlook.es','2100-3651-42-3564125685','123456789','639258741',1,0,'45630',3,3,'27','4','B','',1,'999999999',1,3,0,'','','',2,1,3,'',1,'','',2,'677777','aa','123456789',0,0,3,'',0,'','',0,'','',0,0,3,'aaaa',0,'','',0,'',1,3,'zz',1,'2016-02-18 18:27:44'),(10,'Silvia Gimenez Camuñas',0,1,'35123532 - D','ssssssdfsdf','12 - 05 - 99','silviag@outlook.es','2100 - 5684 - 01 - 1235800479','931411391','627653712',1,1,'08100 ',1,4,'13','3','F','',1,'123456789',2,9,1,'35123562-D','Silvia Gimenez Camuñas','627653712',2,3,3,'dfgdfgdf dfgd',1,'35123562 - D','Silvia Gimenez Camuñas',2,'','','659684571',2,7,3,'',2,'C','Carlos sanchez garcia',2,'','',0,1,3,'',0,'','',0,'',1,3,'',0,'2016-02-18 18:51:12'),(11,'Cristina maria monzon ramirez Perú',1,1,'35654512-R','','25-04-19','nodispone@gmail.com','','963258147','654321987',48,0,'Navarra',1,5,'2','3','J','aaa',8,'654235684',1,7,2,'54612387-W','','654235651',2,2,3,'',1,'54612387-W','Jose diaz fernandez',2,'','zzz','',0,0,3,'',0,'','',0,'','',0,0,3,'',0,'','',0,'',1,2,'',0,'2016-02-12 05:00:00'),(17,'',0,0,'','','','','','','',0,0,'',0,0,'','','','',11,'',0,0,0,'','','',0,0,3,'',0,'','',0,'','aa','',0,0,3,'',0,'','',0,'','',0,0,3,'',0,'','',0,'',1,1,'',1,'2016-02-17 05:00:00'),(18,'',0,0,'','','','','','','',0,0,'',0,0,'','','','',13,'',0,0,0,'','','',0,0,3,'',0,'','',0,'','aa','',0,0,3,'',0,'','',0,'','',0,0,3,'',0,'','',0,'',1,1,'',2,'2016-02-12 18:42:19'),(19,'',0,0,'','4564576457456','','','','','',0,0,'',1,7,'','','','',13,'',1,9,2,'','','',1,9,4,'zxcvxdcv xcfg',0,'','',0,'','','',0,0,3,'',0,'','',0,'','',0,0,3,'',0,'','',0,'',1,1,'',2,'2016-02-22 12:47:43'),(20,'aaa',2,2,'sdfdfgdfg','aaaaa','aaaa','aaaa','aaa','123456789','123456788',43,10,'56456',3,4,'435345','1','2','3',1,'534534534',1,18,1,'','','',0,0,3,'',0,'','',0,'','','',0,0,3,'',0,'','',0,'','',0,0,3,'',0,'','',0,'',0,0,'',0,'0000-00-00 00:00:00'),(21,'',0,0,'','','','','','','',0,0,'',0,0,'','','','',13,'',0,0,0,'','','',0,0,3,'',0,'','',0,'','','',0,0,3,'',0,'','',0,'','',0,0,3,'',0,'','',0,'',0,0,'',2,'0000-00-00 00:00:00'),(24,'',0,0,'','','','','','','',0,0,'',0,0,'','','','',13,'',0,0,0,'','','',0,0,3,'',0,'','',0,'','','',0,0,3,'',0,'','',0,'','',0,0,3,'',0,'','',0,'',0,0,'',0,'0000-00-00 00:00:00');
/*!40000 ALTER TABLE `venta_campania_001` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `venta_campania_001_campos`
--

DROP TABLE IF EXISTS `venta_campania_001_campos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `venta_campania_001_campos` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `pestana` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `grupo` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `grupo_etiqueta` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `etiqueta` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `orden` int(11) NOT NULL,
  `tabla` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `diccionario` tinyint(2) NOT NULL,
  `diccionario_dependencia` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `diccionario_nombre` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `diccionario_orden` tinyint(1) NOT NULL DEFAULT '1',
  `tipo` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `perfiles` varchar(500) COLLATE utf8_unicode_ci NOT NULL DEFAULT '1, 2, 3, 4, 5, 6',
  `permisos` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'w, w, w, w, w, w',
  `listado_aparece` tinyint(4) DEFAULT '0',
  `listado_orden` int(11) DEFAULT '0',
  `listado_label` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `listado_ancho` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `venta_campania_001_campos`
--

LOCK TABLES `venta_campania_001_campos` WRITE;
/*!40000 ALTER TABLE `venta_campania_001_campos` DISABLE KEYS */;
INSERT INTO `venta_campania_001_campos` VALUES (1,'Cliente','','','cliente_nombre','Cliente',1,'cliente',0,'','',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w',1,1,'Cliente',150),(2,'Cliente','','','cliente_tipo','Tipo Cliente',2,'cliente',2,'','',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, r, w',1,2,'Tipo de Cli.',100),(3,'Cliente','cliente_documento','Documento','cliente_documento_tipo','Tipo',3,'cliente',2,'','',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w',0,0,NULL,NULL),(4,'Cliente','cliente_documento','Documento','cliente_documento','Número',4,'cliente',0,'','',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w',0,0,NULL,NULL),(5,'Cliente','','','cliente_nacimiento','Fecha de Nacimiento',6,'cliente',0,'','',1,'TIMESTAMP-VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w',0,0,NULL,NULL),(7,'Cliente','','','cliente_correo','Correo',7,'cliente',0,'','',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w',0,0,NULL,NULL),(8,'Cliente','cliente_contacto','Contacto','cliente_contacto_fijo','Fijo',9,'cliente',0,'','',1,'TELEFONO','1, 2, 3, 4, 5, 6','w, w, w, w, w, w',0,0,NULL,NULL),(9,'Cliente','cliente_contacto','Contacto','cliente_contacto_movil','Movil',10,'cliente',0,'','',1,'TELEFONO','1, 2, 3, 4, 5, 6','w, w, w, w, w, w',0,0,NULL,NULL),(10,'Cliente','ubigeo','Ubigeo','provincia','Provincia',11,'venta',2,'','',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w',1,3,'Prov.',100),(11,'Cliente','ubigeo','Ubigeo','localidad','Localidad',12,'venta',1,'provincia','',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w',0,0,NULL,NULL),(12,'Cliente','direccion','Dirección','direccion_tipo','Tipo',14,'venta',1,'','',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w',0,0,NULL,NULL),(13,'Cliente','direccion','Dirección','direccion_nombre','Nombre',15,'venta',1,'','',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w',0,0,NULL,NULL),(14,'Cliente','direccion','Dirección','direccion_numero','Número',16,'venta',0,'','',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w',0,0,NULL,NULL),(15,'Cliente','direccion','Dirección','direccion_piso','Planta(Piso, Bloque)',17,'venta',0,'','',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w',0,0,NULL,NULL),(16,'Cliente','direccion','Dirección','direccion_puerta','Puerta',18,'venta',0,'','',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w',0,0,NULL,NULL),(17,'Producto','','','producto','Producto',20,'venta',3,'','',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w',1,4,'Prod.',200),(18,'Estados','estado_venta','Estado','estado','Estado',58,'venta',2,'','',0,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, r, w',0,0,NULL,NULL),(19,'Estados','','','fecha_instalada','Fecha de Instalación',62,'venta',0,'','',1,'TIMESTAMP','1, 2, 3, 4, 5, 6','w, w, w, w, r, w',0,0,NULL,NULL),(20,'Cliente','ubigeo','Ubigeo','codigo_postal','Código Postal',13,'venta',0,'','',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w',0,0,NULL,NULL),(21,'Cliente','','','cuenta_bancaria','Cuenta Bancaria',8,'cliente',0,'','',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w',0,0,NULL,NULL),(22,'Estados','estado_venta','Estado','estado_observacion','Observación',60,'venta',0,'','',1,'TEXT','1, 2, 3, 4, 5, 6','w, w, w, r, r, w',0,0,NULL,NULL),(24,'Producto','fijo','Fijo','fijo_numero','Número',21,'venta',0,'','',1,'TELEFONO','1, 2, 3, 4, 5, 6','w, w, w, w, w, w',0,0,NULL,NULL),(25,'Producto','fijo','Fijo','fijo_modalidad','Modalidad',22,'venta',2,'','modalidad',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w',0,0,NULL,NULL),(26,'Producto','fijo','Fijo','fijo_operador','Operador',23,'venta',1,'','operador',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w',0,0,NULL,NULL),(27,'Producto','movil','Movil','movil_numero','Número',27,'venta',0,'','',1,'TELEFONO','1, 2, 3, 4, 5, 6','w, w, w, w, w, w',0,0,NULL,NULL),(28,'Producto','movil','Movil','movil_modalidad','Modalidad',28,'venta',2,'','modalidad',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w',0,0,NULL,NULL),(29,'Producto','movil','Movil','movil_operador','Operador',29,'venta',1,'','operador',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w',0,0,NULL,NULL),(30,'Producto','movil','Movil','movil_tarifa','Tarifa',30,'venta',3,'','tarifa_movil',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w',0,0,NULL,NULL),(31,'Producto','movil','Movil','movil_titular','Mismo Titular',32,'venta',2,'','titular',0,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w',0,0,NULL,NULL),(32,'Producto','movil','Movil','movil_estado','Estado',35,'venta',2,'','',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w',0,0,NULL,NULL),(33,'Producto','movil','Movil','movil_icc','ICC',36,'venta',0,'','',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w',0,0,NULL,NULL),(34,'Moviles Adicionales','movil_adicional_1','Movil Adicional 1','movil_adicional_1_numero','Número',38,'venta',0,'','',1,'TELEFONO','1, 2, 3, 4, 5, 6','w, w, w, w, w, w',0,0,NULL,NULL),(35,'Moviles Adicionales','movil_adicional_1','Movil Adicional 1','movil_adicional_1_modalidad','Modalidad',39,'venta',2,'','modalidad',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w',0,0,NULL,NULL),(36,'Moviles Adicionales','movil_adicional_1','Movil Adicional 1','movil_adicional_1_operador','Operador',40,'venta',1,'','operador',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w',0,0,NULL,NULL),(37,'Moviles Adicionales','movil_adicional_1','Movil Adicional 1','movil_adicional_1_tarifa','Tarifa',41,'venta',3,'','tarifa_movil',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w',0,0,NULL,NULL),(38,'Moviles Adicionales','movil_adicional_1','Movil Adicional 1','movil_adicional_1_titular','Mismo Titular',43,'venta',2,'','titular',0,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w',0,0,NULL,NULL),(39,'Moviles Adicionales','movil_adicional_1','Movil Adicional 1','movil_adicional_1_estado','Estado',46,'venta',2,'','movil_estado',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w',0,0,NULL,NULL),(40,'Moviles Adicionales','movil_adicional_1','Movil Adicional 1','movil_adicional_1_icc','ICC',47,'venta',0,'','',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w',0,0,NULL,NULL),(41,'Moviles Adicionales','movil_adicional_2','Movil Adicional 2','movil_adicional_2_numero','Número',48,'venta',0,'','',1,'TELEFONO','1, 2, 3, 4, 5, 6','w, w, w, w, w, w',0,0,NULL,NULL),(42,'Moviles Adicionales','movil_adicional_2','Movil Adicional 2','movil_adicional_2_modalidad','Modalidad',49,'venta',2,'','modalidad',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w',0,0,NULL,NULL),(43,'Moviles Adicionales','movil_adicional_2','Movil Adicional 2','movil_adicional_2_operador','Operador',50,'venta',1,'','operador',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w',0,0,NULL,NULL),(44,'Moviles Adicionales','movil_adicional_2','Movil Adicional 2','movil_adicional_2_tarifa','Tarifa',51,'venta',3,'','tarifa_movil',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w',0,0,NULL,NULL),(45,'Moviles Adicionales','movil_adicional_2','Movil Adicional 2','movil_adicional_2_titular','Mismo Titular',53,'venta',2,'','titular',0,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w',0,0,NULL,NULL),(46,'Moviles Adicionales','movil_adicional_2','Movil Adicional 2','movil_adicional_2_estado','Estado',56,'venta',2,'','movil_estado',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w',0,0,NULL,NULL),(47,'Moviles Adicionales','movil_adicional_2','Movil Adicional 2','movil_adicional_2_icc','ICC',57,'venta',0,'','',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w',0,0,NULL,NULL),(48,'Cliente','cliente_documento','Documento','cliente_documento_reverso','Reverso',5,'cliente',0,'','',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w',0,0,NULL,NULL),(49,'Producto','fijo','Fijo','fijo_titular','Mismo Titular',24,'venta',2,'','titular',0,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w',0,0,NULL,NULL),(50,'Producto','fijo','Fijo','fijo_titular_documento','Documento del Titular',25,'venta',0,'','',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w',0,0,NULL,NULL),(51,'Producto','fijo','Fijo','fijo_titular_nombre','Nombre del Titular',26,'venta',0,'','',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w',0,0,NULL,NULL),(52,'Producto','movil','Movil','movil_titular_documento','Documento del Titular',33,'venta',0,'','',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w',0,0,NULL,NULL),(53,'Producto','movil','Movil','movil_titular_nombre','Nombre del Titular',34,'venta',0,'','',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w',0,0,NULL,NULL),(54,'Moviles Adicionales','movil_adicional_1','Movil Adicional 1','movil_adicional_1_titular_documento','Documento del Titular',44,'venta',0,'','',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w',0,0,NULL,NULL),(55,'Moviles Adicionales','movil_adicional_1','Movil Adicional 1','movil_adicional_1_titular_nombre','Nombre del Titular',45,'venta',0,'','',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w',0,0,NULL,NULL),(56,'Moviles Adicionales','movil_adicional_2','Movil Adicional 2','movil_adicional_2_titular_documento','Documento del Titular',54,'venta',0,'','',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w',0,0,NULL,NULL),(57,'Moviles Adicionales','movil_adicional_2','Movil Adicional 2','movil_adicional_2_titular_nombre','Nombre del Titular',55,'venta',0,'','',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w',0,0,NULL,NULL),(58,'Estados','estado_venta','Estado','estado_real','Estado Real',59,'venta',2,'','',0,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, h, w',0,0,NULL,NULL),(59,'Cliente','direccion','Dirección','direccion_id','Dirección ID',19,'cliente',0,'','',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w',0,0,NULL,NULL),(61,'Estados','','','aprobado_supervisor','Aprobado por Supervisor',61,'venta',2,'','booleano',0,'VARCHAR','1, 2, 3, 4, 5, 6','r, r, r, w, r, r',0,0,NULL,NULL),(62,'Producto','','','producto_observacion','Obserción',37,'venta',0,'','',1,'TEXT','1, 2, 3, 4, 5, 6','w, w, w, w, w, w',0,0,NULL,NULL),(63,'Producto','movil','Movil','movil_terminal','Terminal',31,'venta',0,'','',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w',0,0,NULL,NULL),(64,'Moviles Adicionales','movil_adicional_1','Movil Adicional 1','movil_adicional_1_terminal','Terminal',42,'venta',0,'','',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w',0,0,NULL,NULL),(65,'Moviles Adicionales','movil_adicional_2','Movil Adicional 2','movil_adicional_2_terminal','Terminal',52,'venta',0,'','',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w',0,0,NULL,NULL);
/*!40000 ALTER TABLE `venta_campania_001_campos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `venta_campania_002`
--

DROP TABLE IF EXISTS `venta_campania_002`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `venta_campania_002` (
  `id` bigint(20) NOT NULL,
  `cliente_nombre` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `cliente_documento` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `representante_nombre` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `representante_documento` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `representante_documento_reverso` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `representante_nacimiento` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `representante_correo` varchar(600) COLLATE utf8_unicode_ci NOT NULL,
  `cuenta_bancaria` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `cliente_contacto_fijo` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `cliente_contacto_movil` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `provincia` bigint(20) NOT NULL,
  `localidad` bigint(20) NOT NULL,
  `codigo_postal` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `direccion_tipo` bigint(20) NOT NULL,
  `direccion_nombre` bigint(20) NOT NULL,
  `direccion_numero` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `direccion_piso` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `direccion_puerta` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `direccion_id` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `producto` bigint(20) NOT NULL,
  `fijo_numero` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `fijo_modalidad` bigint(20) NOT NULL,
  `fijo_operador` bigint(20) NOT NULL,
  `fijo_titular` bigint(20) NOT NULL,
  `fijo_titular_documento` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `fijo_titular_nombre` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `movil_numero` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `movil_modalidad` bigint(20) NOT NULL,
  `movil_operador` bigint(20) NOT NULL,
  `movil_tarifa` bigint(20) NOT NULL,
  `movil_terminal` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `movil_titular` bigint(20) NOT NULL,
  `movil_titular_documento` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `movil_titular_nombre` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `movil_estado` bigint(20) NOT NULL,
  `movil_icc` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `producto_observacion` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `movil_adicional_1_numero` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `movil_adicional_1_modalidad` bigint(20) NOT NULL,
  `movil_adicional_1_operador` bigint(20) NOT NULL,
  `movil_adicional_1_tarifa` bigint(20) NOT NULL,
  `movil_adicional_1_terminal` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `movil_adicional_1_titular` bigint(20) NOT NULL,
  `movil_adicional_1_titular_documento` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `movil_adicional_1_titular_nombre` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `movil_adicional_1_estado` bigint(20) NOT NULL,
  `movil_adicional_1_icc` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `movil_adicional_2_numero` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `movil_adicional_2_modalidad` bigint(20) NOT NULL,
  `movil_adicional_2_operador` bigint(20) NOT NULL,
  `movil_adicional_2_tarifa` bigint(20) NOT NULL,
  `movil_adicional_2_terminal` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `movil_adicional_2_titular` bigint(20) NOT NULL,
  `movil_adicional_2_titular_documento` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `movil_adicional_2_titular_nombre` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `movil_adicional_2_estado` bigint(20) NOT NULL,
  `movil_adicional_2_icc` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `movil_adicional_3_numero` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `movil_adicional_3_modalidad` bigint(20) NOT NULL,
  `movil_adicional_3_operador` bigint(20) NOT NULL,
  `movil_adicional_3_tarifa` bigint(20) NOT NULL,
  `movil_adicional_3_terminal` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `movil_adicional_3_titular` bigint(20) NOT NULL,
  `movil_adicional_3_titular_documento` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `movil_adicional_3_titular_nombre` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `movil_adicional_3_estado` bigint(20) NOT NULL,
  `movil_adicional_3_icc` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `movil_adicional_4_numero` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `movil_adicional_4_modalidad` bigint(20) NOT NULL,
  `movil_adicional_4_operador` bigint(20) NOT NULL,
  `movil_adicional_4_tarifa` bigint(20) NOT NULL,
  `movil_adicional_4_terminal` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `movil_adicional_4_titular` bigint(20) NOT NULL,
  `movil_adicional_4_titular_documento` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `movil_adicional_4_titular_nombre` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `movil_adicional_4_estado` bigint(20) NOT NULL,
  `movil_adicional_4_icc` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `movil_adicional_5_numero` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `movil_adicional_5_modalidad` bigint(20) NOT NULL,
  `movil_adicional_5_operador` bigint(20) NOT NULL,
  `movil_adicional_5_tarifa` bigint(20) NOT NULL,
  `movil_adicional_5_terminal` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `movil_adicional_5_titular` bigint(20) NOT NULL,
  `movil_adicional_5_titular_documento` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `movil_adicional_5_titular_nombre` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `movil_adicional_5_estado` bigint(20) NOT NULL,
  `movil_adicional_5_icc` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `movil_adicional_observacion` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `estado` bigint(20) NOT NULL DEFAULT '1',
  `estado_real` bigint(20) NOT NULL DEFAULT '1',
  `estado_observacion` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `aprobado_supervisor` bigint(20) NOT NULL DEFAULT '2',
  `fecha_instalada` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `venta_campania_002`
--

LOCK TABLES `venta_campania_002` WRITE;
/*!40000 ALTER TABLE `venta_campania_002` DISABLE KEYS */;
INSERT INTO `venta_campania_002` VALUES (23,'A','A','','','','','','','','',0,0,'',0,0,'','','','',14,'',0,0,0,'','','',0,0,7,'',0,'','',0,'','','',0,0,7,'',0,'','',0,'','',0,0,7,'',0,'','',0,'','',0,0,7,'',0,'','',0,'','',0,0,7,'',0,'','',0,'','',0,0,7,'',0,'','',0,'','',1,1,'',2,'2016-02-29 05:00:00');
/*!40000 ALTER TABLE `venta_campania_002` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `venta_campania_002_campos`
--

DROP TABLE IF EXISTS `venta_campania_002_campos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `venta_campania_002_campos` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `pestana` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `grupo` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `grupo_etiqueta` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `etiqueta` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `orden` int(11) NOT NULL,
  `tabla` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `diccionario` tinyint(2) NOT NULL,
  `diccionario_dependencia` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `diccionario_nombre` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `diccionario_orden` tinyint(1) NOT NULL DEFAULT '1',
  `tipo` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `perfiles` varchar(500) COLLATE utf8_unicode_ci NOT NULL DEFAULT '1, 2, 3, 4, 5, 6',
  `permisos` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'w, w, w, w, w, w',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=99 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `venta_campania_002_campos`
--

LOCK TABLES `venta_campania_002_campos` WRITE;
/*!40000 ALTER TABLE `venta_campania_002_campos` DISABLE KEYS */;
INSERT INTO `venta_campania_002_campos` VALUES (1,'Cliente','','','cliente_nombre','Empresa',1,'cliente',0,'','',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w'),(4,'Cliente','','','cliente_documento','Documento',2,'cliente',0,'','',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w'),(5,'Cliente','representante','Representante','representante_nacimiento','Fecha de Nacimiento',6,'cliente',0,'','',1,'TIMESTAMP-VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w'),(7,'Cliente','representante','Representante','representante_correo','Correo',7,'cliente',0,'','',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w'),(8,'Cliente','cliente_contacto','Contacto','cliente_contacto_fijo','Fijo',9,'cliente',0,'','',1,'TELEFONO','1, 2, 3, 4, 5, 6','w, w, w, w, w, w'),(9,'Cliente','cliente_contacto','Contacto','cliente_contacto_movil','Movil',10,'cliente',0,'','',1,'TELEFONO','1, 2, 3, 4, 5, 6','w, w, w, w, w, w'),(10,'Cliente','ubigeo','Ubigeo','provincia','Provincia',11,'venta',2,'','',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w'),(11,'Cliente','ubigeo','Ubigeo','localidad','Localidad',12,'venta',1,'provincia','',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w'),(12,'Cliente','direccion','Dirección','direccion_tipo','Tipo',14,'venta',1,'','',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w'),(13,'Cliente','direccion','Dirección','direccion_nombre','Nombre',15,'venta',1,'','',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w'),(14,'Cliente','direccion','Dirección','direccion_numero','Número',16,'venta',0,'','',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w'),(15,'Cliente','direccion','Dirección','direccion_piso','Planta(Piso, Bloque)',17,'venta',0,'','',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w'),(16,'Cliente','direccion','Dirección','direccion_puerta','Puerta',18,'venta',0,'','',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w'),(17,'Producto','','','producto','Producto',20,'venta',3,'','',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w'),(18,'Estados','estado_venta','Estado','estado','Estado',89,'venta',2,'','',0,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, r, w'),(19,'Estados','','','fecha_instalada','Fecha de Instalación',93,'venta',0,'','',1,'TIMESTAMP','1, 2, 3, 4, 5, 6','w, w, w, w, r, w'),(20,'Cliente','ubigeo','Ubigeo','codigo_postal','Código Postal',13,'venta',0,'','',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w'),(21,'Cliente','','','cuenta_bancaria','Cuenta Bancaria',8,'cliente',0,'','',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w'),(22,'Estados','estado_venta','Estado','estado_observacion','Observación',91,'venta',0,'','',1,'TEXT','1, 2, 3, 4, 5, 6','w, w, w, r, r, w'),(24,'Producto','fijo','Fijo','fijo_numero','Número',21,'venta',0,'','',1,'TELEFONO','1, 2, 3, 4, 5, 6','w, w, w, w, w, w'),(25,'Producto','fijo','Fijo','fijo_modalidad','Modalidad',22,'venta',2,'','modalidad',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w'),(26,'Producto','fijo','Fijo','fijo_operador','Operador',23,'venta',1,'','operador',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w'),(27,'Producto','movil','Movil','movil_numero','Número',27,'venta',0,'','',1,'TELEFONO','1, 2, 3, 4, 5, 6','w, w, w, w, w, w'),(28,'Producto','movil','Movil','movil_modalidad','Modalidad',28,'venta',2,'','modalidad',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w'),(29,'Producto','movil','Movil','movil_operador','Operador',29,'venta',1,'','operador',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w'),(30,'Producto','movil','Movil','movil_tarifa','Tarifa',30,'venta',3,'','tarifa_movil',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w'),(31,'Producto','movil','Movil','movil_titular','Mismo Titular',32,'venta',2,'','titular',0,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w'),(32,'Producto','movil','Movil','movil_estado','Estado',35,'venta',2,'','',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w'),(33,'Producto','movil','Movil','movil_icc','ICC',36,'venta',0,'','',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w'),(34,'Moviles Adicionales','movil_adicional_1','Movil Adicional 1','movil_adicional_1_numero','Número',38,'venta',0,'','',1,'TELEFONO','1, 2, 3, 4, 5, 6','w, w, w, w, w, w'),(35,'Moviles Adicionales','movil_adicional_1','Movil Adicional 1','movil_adicional_1_modalidad','Modalidad',39,'venta',2,'','modalidad',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w'),(36,'Moviles Adicionales','movil_adicional_1','Movil Adicional 1','movil_adicional_1_operador','Operador',40,'venta',1,'','operador',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w'),(37,'Moviles Adicionales','movil_adicional_1','Movil Adicional 1','movil_adicional_1_tarifa','Tarifa',41,'venta',3,'','tarifa_movil',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w'),(38,'Moviles Adicionales','movil_adicional_1','Movil Adicional 1','movil_adicional_1_titular','Mismo Titular',43,'venta',2,'','titular',0,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w'),(39,'Moviles Adicionales','movil_adicional_1','Movil Adicional 1','movil_adicional_1_estado','Estado',46,'venta',2,'','movil_estado',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w'),(40,'Moviles Adicionales','movil_adicional_1','Movil Adicional 1','movil_adicional_1_icc','ICC',47,'venta',0,'','',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w'),(41,'Moviles Adicionales','movil_adicional_2','Movil Adicional 2','movil_adicional_2_numero','Número',48,'venta',0,'','',1,'TELEFONO','1, 2, 3, 4, 5, 6','w, w, w, w, w, w'),(42,'Moviles Adicionales','movil_adicional_2','Movil Adicional 2','movil_adicional_2_modalidad','Modalidad',49,'venta',2,'','modalidad',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w'),(43,'Moviles Adicionales','movil_adicional_2','Movil Adicional 2','movil_adicional_2_operador','Operador',50,'venta',1,'','operador',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w'),(44,'Moviles Adicionales','movil_adicional_2','Movil Adicional 2','movil_adicional_2_tarifa','Tarifa',51,'venta',3,'','tarifa_movil',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w'),(45,'Moviles Adicionales','movil_adicional_2','Movil Adicional 2','movil_adicional_2_titular','Mismo Titular',53,'venta',2,'','titular',0,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w'),(46,'Moviles Adicionales','movil_adicional_2','Movil Adicional 2','movil_adicional_2_estado','Estado',56,'venta',2,'','movil_estado',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w'),(47,'Moviles Adicionales','movil_adicional_2','Movil Adicional 2','movil_adicional_2_icc','ICC',57,'venta',0,'','',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w'),(48,'Cliente','representante','Representante','representante_documento_reverso','Reverso',5,'cliente',0,'','',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w'),(49,'Producto','fijo','Fijo','fijo_titular','Mismo Titular',24,'venta',2,'','titular',0,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w'),(50,'Producto','fijo','Fijo','fijo_titular_documento','Documento del Titular',25,'venta',0,'','',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w'),(51,'Producto','fijo','Fijo','fijo_titular_nombre','Nombre del Titular',26,'venta',0,'','',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w'),(52,'Producto','movil','Movil','movil_titular_documento','Documento del Titular',33,'venta',0,'','',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w'),(53,'Producto','movil','Movil','movil_titular_nombre','Nombre del Titular',34,'venta',0,'','',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w'),(54,'Moviles Adicionales','movil_adicional_1','Movil Adicional 1','movil_adicional_1_titular_documento','Documento del Titular',44,'venta',0,'','',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w'),(55,'Moviles Adicionales','movil_adicional_1','Movil Adicional 1','movil_adicional_1_titular_nombre','Nombre del Titular',45,'venta',0,'','',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w'),(56,'Moviles Adicionales','movil_adicional_2','Movil Adicional 2','movil_adicional_2_titular_documento','Documento del Titular',54,'venta',0,'','',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w'),(57,'Moviles Adicionales','movil_adicional_2','Movil Adicional 2','movil_adicional_2_titular_nombre','Nombre del Titular',55,'venta',0,'','',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w'),(58,'Estados','estado_venta','Estado','estado_real','Estado Real',90,'venta',2,'','',0,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, h, w'),(59,'Cliente','direccion','Dirección','direccion_id','Dirección ID',19,'cliente',0,'','',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w'),(61,'Estados','','','aprobado_supervisor','Aprobado por Supervisor',92,'venta',2,'','booleano',0,'VARCHAR','1, 2, 3, 4, 5, 6','r, r, r, w, r, r'),(62,'Producto','','','producto_observacion','Observación',37,'venta',0,'','',1,'TEXT','1, 2, 3, 4, 5, 6','w, w, w, w, w, w'),(63,'Producto','movil','Movil','movil_terminal','Terminal',31,'venta',0,'','',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w'),(64,'Moviles Adicionales','movil_adicional_1','Movil Adicional 1','movil_adicional_1_terminal','Terminal',42,'venta',0,'','',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w'),(65,'Moviles Adicionales','movil_adicional_2','Movil Adicional 2','movil_adicional_2_terminal','Terminal',52,'venta',0,'','',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w'),(66,'Cliente','representante','Representante','representante_nombre','Nombre',3,'cliente',0,'','',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w'),(67,'Cliente','representante','Representante','representante_documento','Documento',4,'cliente',0,'','',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w'),(68,'Moviles Adicionales','movil_adicional_3','Movil Adicional 3','movil_adicional_3_numero','Número',58,'venta',0,'','',1,'TELEFONO','1, 2, 3, 4, 5, 6','w, w, w, w, w, w'),(69,'Moviles Adicionales','movil_adicional_3','Movil Adicional 3','movil_adicional_3_modalidad','Modalidad',59,'venta',2,'','modalidad',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w'),(70,'Moviles Adicionales','movil_adicional_3','Movil Adicional 3','movil_adicional_3_operador','Operador',60,'venta',1,'','operador',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w'),(71,'Moviles Adicionales','movil_adicional_3','Movil Adicional 3','movil_adicional_3_tarifa','Tarifa',61,'venta',3,'','tarifa_movil',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w'),(72,'Moviles Adicionales','movil_adicional_3','Movil Adicional 3','movil_adicional_3_terminal','Terminal',62,'venta',0,'','',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w'),(73,'Moviles Adicionales','movil_adicional_3','Movil Adicional 3','movil_adicional_3_titular','Mismo Titular',63,'venta',2,'','titular',0,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w'),(74,'Moviles Adicionales','movil_adicional_3','Movil Adicional 3','movil_adicional_3_titular_documento','Documento del Titular',64,'venta',0,'','',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w'),(75,'Moviles Adicionales','movil_adicional_3','Movil Adicional 3','movil_adicional_3_titular_nombre','Nombre del Titular',65,'venta',0,'','',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w'),(76,'Moviles Adicionales','movil_adicional_3','Movil Adicional 3','movil_adicional_3_estado','Estado',66,'venta',2,'','movil_estado',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w'),(77,'Moviles Adicionales','movil_adicional_3','Movil Adicional 3','movil_adicional_3_icc','ICC',67,'venta',0,'','',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w'),(78,'Moviles Adicionales','movil_adicional_4','Movil Adicional 4','movil_adicional_4_numero','Número',68,'venta',0,'','',1,'TELEFONO','1, 2, 3, 4, 5, 6','w, w, w, w, w, w'),(79,'Moviles Adicionales','movil_adicional_4','Movil Adicional 4','movil_adicional_4_modalidad','Modalidad',69,'venta',2,'','modalidad',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w'),(80,'Moviles Adicionales','movil_adicional_4','Movil Adicional 4','movil_adicional_4_operador','Operador',70,'venta',1,'','operador',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w'),(81,'Moviles Adicionales','movil_adicional_4','Movil Adicional 4','movil_adicional_4_tarifa','Tarifa',71,'venta',3,'','tarifa_movil',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w'),(82,'Moviles Adicionales','movil_adicional_4','Movil Adicional 4','movil_adicional_4_terminal','Terminal',72,'venta',0,'','',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w'),(83,'Moviles Adicionales','movil_adicional_4','Movil Adicional 4','movil_adicional_4_titular','Mismo Titular',73,'venta',2,'','titular',0,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w'),(84,'Moviles Adicionales','movil_adicional_4','Movil Adicional 4','movil_adicional_4_titular_documento','Documento del Titular',74,'venta',0,'','',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w'),(85,'Moviles Adicionales','movil_adicional_4','Movil Adicional 4','movil_adicional_4_titular_nombre','Nombre del Titular',75,'venta',0,'','',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w'),(86,'Moviles Adicionales','movil_adicional_4','Movil Adicional 4','movil_adicional_4_estado','Estado',76,'venta',2,'','movil_estado',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w'),(87,'Moviles Adicionales','movil_adicional_4','Movil Adicional 4','movil_adicional_4_icc','ICC',77,'venta',0,'','',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w'),(88,'Moviles Adicionales','movil_adicional_5','Movil Adicional 5','movil_adicional_5_numero','Número',78,'venta',0,'','',1,'TELEFONO','1, 2, 3, 4, 5, 6','w, w, w, w, w, w'),(89,'Moviles Adicionales','movil_adicional_5','Movil Adicional 5','movil_adicional_5_modalidad','Modalidad',79,'venta',2,'','modalidad',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w'),(90,'Moviles Adicionales','movil_adicional_5','Movil Adicional 5','movil_adicional_5_operador','Operador',80,'venta',1,'','operador',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w'),(91,'Moviles Adicionales','movil_adicional_5','Movil Adicional 5','movil_adicional_5_tarifa','Tarifa',81,'venta',3,'','tarifa_movil',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w'),(92,'Moviles Adicionales','movil_adicional_5','Movil Adicional 5','movil_adicional_5_terminal','Terminal',82,'venta',0,'','',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w'),(93,'Moviles Adicionales','movil_adicional_5','Movil Adicional 5','movil_adicional_5_titular','Mismo Titular',83,'venta',2,'','titular',0,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w'),(94,'Moviles Adicionales','movil_adicional_5','Movil Adicional 5','movil_adicional_5_titular_documento','Documento del Titular',84,'venta',0,'','',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w'),(95,'Moviles Adicionales','movil_adicional_5','Movil Adicional 5','movil_adicional_5_titular_nombre','Nombre del Titular',85,'venta',0,'','',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w'),(96,'Moviles Adicionales','movil_adicional_5','Movil Adicional 5','movil_adicional_5_estado','Estado',86,'venta',2,'','movil_estado',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w'),(97,'Moviles Adicionales','movil_adicional_5','Movil Adicional 5','movil_adicional_5_icc','ICC',87,'venta',0,'','',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w'),(98,'Moviles Adicionales','','','movil_adicional_observacion','Observación',88,'venta',0,'','',1,'TEXT','1, 2, 3, 4, 5, 6','w, w, w, w, w, w');
/*!40000 ALTER TABLE `venta_campania_002_campos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `venta_campania_004`
--

DROP TABLE IF EXISTS `venta_campania_004`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `venta_campania_004` (
  `id` bigint(20) NOT NULL,
  `cliente_nombre` varchar(500) DEFAULT NULL,
  `cliente_tipo` bigint(20) DEFAULT NULL,
  `cliente_documento_tipo` bigint(20) DEFAULT NULL,
  `cliente_documento` varchar(100) DEFAULT NULL,
  `cliente_nacimiento` varchar(50) DEFAULT NULL,
  `cliente_correo` varchar(150) DEFAULT NULL,
  `cliente_contacto_fijo` varchar(100) DEFAULT NULL,
  `cliente_contacto_movil` varchar(100) DEFAULT NULL,
  `provincia` bigint(20) DEFAULT NULL,
  `localidad` bigint(20) DEFAULT NULL,
  `direccion_tipo` bigint(20) DEFAULT NULL,
  `direccion_nombre` varchar(700) DEFAULT NULL,
  `direccion_numero` varchar(50) DEFAULT NULL,
  `direccion_piso` varchar(100) DEFAULT NULL,
  `direccion_puerta` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `venta_campania_004`
--

LOCK TABLES `venta_campania_004` WRITE;
/*!40000 ALTER TABLE `venta_campania_004` DISABLE KEYS */;
INSERT INTO `venta_campania_004` VALUES (25,'antamina 2',2,NULL,'12',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(26,'banco',2,0,'33','0000-00-00 00:00:00','','444444444','',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(27,'cliente 01',1,NULL,'55555',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(28,'Juan Perez',2,NULL,'33456676',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(29,'Juana Perez',2,3,'44444334444','0000-00-00 00:00:00','a@a.com','333333333','',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(30,'abc',2,2,'56666','1990','b@gmail.com','555555555','666666666',43,10,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `venta_campania_004` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `venta_campania_004_campos`
--

DROP TABLE IF EXISTS `venta_campania_004_campos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `venta_campania_004_campos` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `pestana` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `grupo` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `grupo_etiqueta` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `etiqueta` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `orden` int(11) NOT NULL,
  `tabla` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `diccionario` tinyint(2) NOT NULL,
  `diccionario_dependencia` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `diccionario_nombre` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `diccionario_orden` tinyint(1) NOT NULL DEFAULT '1',
  `tipo` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `perfiles` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '1, 2, 3, 4, 5, 6',
  `permisos` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'w, w, w, w, w, w',
  `listado_aparece` tinyint(4) NOT NULL DEFAULT '0',
  `listado_orden` int(11) NOT NULL DEFAULT '1',
  `listado_label` varchar(150) DEFAULT NULL,
  `listado_ancho` int(11) DEFAULT '100',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `venta_campania_004_campos`
--

LOCK TABLES `venta_campania_004_campos` WRITE;
/*!40000 ALTER TABLE `venta_campania_004_campos` DISABLE KEYS */;
INSERT INTO `venta_campania_004_campos` VALUES (1,'Cliente','','','cliente_nombre','Cliente',1,'cliente',0,' ',' ',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w',1,1,'Cliente',0),(2,'Cliente','cliente_documento','Documento','cliente_documento','Número',4,'cliente',0,'','',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w',0,0,'Doc.',0),(3,'Cliente','','','cliente_tipo','Tipo Cliente',2,'cliente',2,'','',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w',1,2,'Tip.',200),(4,'Cliente','cliente_documento','Documento','cliente_documento_tipo','Tipo',3,'cliente',2,'','',2,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w',0,0,'',0),(5,'Cliente','','','cliente_nacimiento','Fecha de Nacimiento',5,'cliente',0,'','',1,'TIMESTAMP-VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w',0,0,'',0),(6,'Cliente','','','cliente_correo','Correo',6,'cliente',0,'','',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w',0,0,'',0),(7,'Cliente','cliente_contacto','Contacto','cliente_contacto_fijo','Fijo',7,'cliente',0,'','',1,'TELEFONO','1, 2, 3, 4, 5, 6','w, w, w, w, w, w',0,0,'',0),(8,'Cliente','cliente_contacto','Contacto','cliente_contacto_movil','Movil',8,'cliente',0,'','',1,'TELEFONO','1, 2, 3, 4, 5, 6','w, w, w, w, w, w',0,1,'',0),(9,'Cliente','ubigeo','Ubigeo','provincia','Provincia',9,'venta',2,'','',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w',0,1,'',0),(10,'Cliente','ubigeo','Ubigeo','localidad','Localidad',10,'venta',1,'provincia','',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w',0,1,'',0),(11,'Cliente','direccion','Dirección','direccion_tipo','Tipo',11,'venta',1,'','',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w',0,1,'',0),(12,'Cliente','direccion','Dirección','direccion_nombre','Nombre',12,'venta',1,'','',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w',0,1,'',0),(13,'Cliente','direccion','Dirección','direccion_numero','Número',13,'venta',0,'','',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w',0,1,'',0),(14,'Cliente','direccion','Dirección','direccion_piso','Planta(Piso, Bloque)',14,'venta',0,'','',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w',0,1,'',0),(15,'Cliente','direccion','Dirección','direccion_puerta','Puerta',15,'venta',0,'','',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w',0,1,'',0);
/*!40000 ALTER TABLE `venta_campania_004_campos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `venta_campania_005`
--

DROP TABLE IF EXISTS `venta_campania_005`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `venta_campania_005` (
  `id` bigint(20) NOT NULL,
  `fecha_venta` timestamp NULL DEFAULT NULL,
  `tipo_venta_005` bigint(20) DEFAULT NULL,
  `venta_estado_005` bigint(20) DEFAULT '2',
  `cambio_titular_005` bigint(20) DEFAULT NULL,
  `cliente` varchar(500) DEFAULT NULL,
  `dni` varchar(50) DEFAULT NULL,
  `correo` varchar(250) DEFAULT NULL,
  `contrasenia` varchar(100) DEFAULT NULL,
  `cuenta_bancaria` varchar(50) DEFAULT NULL,
  `telefono_fijo` varchar(100) DEFAULT NULL,
  `telefono_movil` varchar(100) DEFAULT NULL,
  `telefono_2` varchar(100) DEFAULT NULL,
  `telefono_3` varchar(100) DEFAULT NULL,
  `direccion` longblob,
  `provincia` bigint(20) DEFAULT NULL,
  `localidad` varchar(500) DEFAULT NULL,
  `municipio` varchar(500) DEFAULT NULL,
  `codigo_postal` varchar(50) DEFAULT NULL,
  `cups` varchar(100) DEFAULT NULL,
  `comercializadora` varchar(500) DEFAULT NULL,
  `potencia` varchar(50) DEFAULT NULL,
  `tarifa_acceso_005` bigint(20) DEFAULT NULL,
  `observaciones_acesor` tinyblob,
  `cambio_estado` timestamp NULL DEFAULT NULL,
  `comentario_tramitacion` tinyblob,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `venta_campania_005`
--

LOCK TABLES `venta_campania_005` WRITE;
/*!40000 ALTER TABLE `venta_campania_005` DISABLE KEYS */;
INSERT INTO `venta_campania_005` VALUES (31,'2019-08-14 05:00:00',2,10,2,'JOSE','44028610','aa@aa.com','4234','124234232342333333333333','111111111','222222222','','','AWSDASDSD',2,'15','','23423423','2222222222222222222222','','',0,'','2019-08-20 05:00:00','DSFSDFSDFSD SDFSDFSDF SDFSDF SDFSD SDFSDF gdfdfgdg\r\nasdasd\r\nasd\r\nasd'),(32,'2019-07-24 05:00:00',2,9,0,'','','','','','','','','','',0,'0','','','','','',0,'','0000-00-00 00:00:00',NULL),(33,'0000-00-00 00:00:00',2,NULL,0,'','','','','','','','','','',0,'0','','','','','',0,'','0000-00-00 00:00:00',NULL),(34,'2019-07-24 05:00:00',2,NULL,2,'aaaaa','','','','','','','','','',0,'0','','','','','',0,'','0000-00-00 00:00:00',NULL),(35,'2019-07-10 05:00:00',2,1,2,'JUAN PEREZ','3454664436','a@gmail.com','4346','444444444444444444444444','555555555','555555555','666666666','333333333','WDWQW Q EWQWE\r\nQWEQWEQWE\r\nQWEQW',64,'13','MUNICIPIO 22','23423423423444444444','3453453444444444444464','234234','1.5',13,'Observaciones','2019-07-24 05:00:00',''),(36,'2019-07-08 05:00:00',0,2,0,'','','','','','','','','','',0,'0','','','','','',0,'','0000-00-00 00:00:00',NULL),(37,'2019-07-16 05:00:00',1,2,1,'BBB BBB ','4234234C23D3233','a@aa.com','','45345345DEFDFD4534555555','999999999','988888888','','','SDASDASDAS\r\nASDASDA\r\nASASD',63,'14','','24234332','23423423DFSDFSDF345345','','',0,'','0000-00-00 00:00:00',''),(38,'2019-07-02 05:00:00',2,2,0,'?','','','','','','','','','',0,'0','','','','','',0,'','0000-00-00 00:00:00',NULL),(39,'2019-07-10 05:00:00',2,2,0,'?????','','','','','','','','','',0,'0','','','','','',0,'','0000-00-00 00:00:00',NULL),(40,'2019-07-02 05:00:00',0,2,0,'áááa','','','','','','','','','',0,'0','','','','','',0,'','0000-00-00 00:00:00',NULL),(41,'2019-07-10 05:00:00',2,2,2,'ASDSD PERú','','','','','','','','','',0,'0','','','','','',0,'','0000-00-00 00:00:00',NULL),(42,'0000-00-00 00:00:00',0,2,0,'PERÚ','','','','','','','','','',0,'0','','','','','',0,'','0000-00-00 00:00:00',NULL),(43,'2019-07-09 05:00:00',1,2,0,'PERÚ','','aa@aaa.com','','','','','','','',0,'0','','','','','',0,'','0000-00-00 00:00:00',NULL),(44,'2019-07-30 05:00:00',1,2,0,'AAA','','aa@aaaa','','','','','','','',0,'0','','','','','',0,'','0000-00-00 00:00:00',NULL),(45,'2019-07-29 05:00:00',0,2,0,'AAAA','','aaaa@aa.com','','','','','','','',0,'0','','','','','',0,'','0000-00-00 00:00:00',NULL),(46,'2019-07-24 05:00:00',0,2,0,'AAAAA','','aaa','','','','','','','',0,'0','','','','','',0,'','0000-00-00 00:00:00',NULL),(47,'0000-00-00 00:00:00',0,2,0,'','','aaaaaa@aaa.com','','','','','','','',0,'0','','','','','',0,'','0000-00-00 00:00:00',NULL),(48,'0000-00-00 00:00:00',0,2,0,'bbbb','','bbbb','','','','','','','',0,'0','','','','','',0,'','0000-00-00 00:00:00',NULL),(49,'0000-00-00 00:00:00',0,2,0,'ccc','','cccc','','','','','','','',0,'0','','','','','',0,'','0000-00-00 00:00:00',NULL);
/*!40000 ALTER TABLE `venta_campania_005` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `venta_campania_005_campos`
--

DROP TABLE IF EXISTS `venta_campania_005_campos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `venta_campania_005_campos` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `pestana` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `grupo` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '',
  `grupo_etiqueta` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '',
  `nombre` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '',
  `etiqueta` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '',
  `orden` int(11) DEFAULT '0',
  `tabla` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '',
  `diccionario` tinyint(2) DEFAULT '0',
  `diccionario_dependencia` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '',
  `diccionario_nombre` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '',
  `diccionario_orden` tinyint(1) DEFAULT '1',
  `tipo` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '',
  `perfiles` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '1, 2, 3, 4, 5, 6',
  `permisos` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT 'w, w, w, w, w, w',
  `listado_aparece` tinyint(4) DEFAULT '0',
  `listado_orden` int(11) DEFAULT '1',
  `listado_label` varchar(150) CHARACTER SET utf8 DEFAULT '',
  `listado_ancho` int(11) DEFAULT '0',
  `listado_permisos` varchar(100) CHARACTER SET utf8 DEFAULT '1,1,1,1,1,1',
  `campo_mayuscula` tinyint(4) DEFAULT '1',
  `campo_obligatorio` tinyint(4) DEFAULT '1',
  `declarativo_fecha` tinyint(4) DEFAULT '0' COMMENT 'Exportador de excel',
  `declarativo_columna_ancho` int(11) DEFAULT '25',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `venta_campania_005_campos`
--

LOCK TABLES `venta_campania_005_campos` WRITE;
/*!40000 ALTER TABLE `venta_campania_005_campos` DISABLE KEYS */;
INSERT INTO `venta_campania_005_campos` VALUES (1,'Venta','','','fecha_venta','Fecha de Venta',1,'venta',0,'','',1,'TIMESTAMP','1, 2, 3, 4, 5, 6','w, w, w, w, w, w',1,2,'FECHA VENTA',80,'1, 1, 1, 1, 1, 1',1,1,1,15),(2,'Venta','','','tipo_venta_005','Tipo de Venta',2,'venta',2,'','',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w',1,9,'TIPO VENTA',80,'1, 1, 1, 1, 1, 1',1,1,0,25),(3,'Estado','','','venta_estado_005','Estado',24,'venta',2,'','',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, r, w',1,6,'ESTADO',100,'1, 1, 1, 1, 1, 1',1,1,0,15),(5,'Cliente','suministro','Suministro','cambio_titular_005','Cambio de titular',5,'venta',2,'','',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w',0,1,'',0,'1, 1, 1, 1, 1, 1',1,1,0,25),(6,'Cliente','suministro','Suministro','cliente','Cliente',6,'venta',0,'','',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w',1,3,'CLIENTE',0,'1, 1, 1, 1, 1, 1',1,1,0,25),(7,'Cliente','suministro','Suministro','dni','DNI',7,'venta',0,'','',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w',1,4,'DNI Cli.',80,'1, 1, 1, 1, 1, 1',1,1,0,15),(8,'Cliente','suministro','Suministro','correo','Correo',8,'venta',0,'','',1,'EMAIL','1, 2, 3, 4, 5, 6','w, w, w, w, w, w',0,1,'',0,'1, 1, 1, 1, 1, 1',0,1,0,25),(9,'Cliente','suministro','Suministro','contrasenia','Contraseña',9,'venta',0,'','',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w',0,1,'',0,'1, 1, 1, 1, 1, 1',1,0,0,25),(10,'Cliente','suministro','Suministro','cuenta_bancaria','Cuenta Bancaria',10,'venta',0,'','',1,'BANCO24','1, 2, 3, 4, 5, 6','w, w, w, w, w, w',0,1,'',0,'1, 1, 1, 1, 1, 1',1,1,0,25),(11,'Cliente','telefono_contacto','Teléfono de Contacto','telefono_fijo','Teléfono Fijo',11,'venta',0,'','',1,'TELEFONO','1, 2, 3, 4, 5, 6','w, w, w, w, w, w',1,7,'FIJO 1',100,'1, 1, 1, 1, 1, 1',1,1,0,20),(12,'Cliente','telefono_contacto','Teléfono de Contacto','telefono_movil','Teléfono Movil',12,'venta',0,'','',1,'TELEFONO','1, 2, 3, 4, 5, 6','w, w, w, w, w, w',1,8,'MOVIL 1',100,'1, 1, 1, 1, 1, 1',1,1,0,20),(13,'Cliente','telefono_contacto','Teléfono de Contacto','telefono_2','Teléfono 2',13,'venta',0,'','',1,'TELEFONO','1, 2, 3, 4, 5, 6','w, w, w, w, w, w',0,1,'',0,'1, 1, 1, 1, 1, 1',1,0,0,25),(14,'Cliente','telefono_contacto','Teléfono de Contacto','telefono_3','Teléfono 3',14,'venta',0,'','',1,'TELEFONO','1, 2, 3, 4, 5, 6','w, w, w, w, w, w',0,1,'',0,'1, 1, 1, 1, 1, 1',1,0,0,25),(15,'Suministro','ubigeo','Ubigeo','direccion','Dirección',15,'venta',0,'','',1,'TEXT','1, 2, 3, 4, 5, 6','w, w, w, w, w, w',0,1,'',0,'1, 1, 1, 1, 1, 1',1,1,0,25),(16,'Suministro','ubigeo','Ubigeo','provincia','Provincia',16,'venta',2,'','',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w',0,1,'',0,'1, 1, 1, 1, 1, 1',1,1,0,25),(17,'Suministro','ubigeo','Ubigeo','localidad','Localidad',17,'venta',1,'provincia','',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w',0,1,'',0,'1, 1, 1, 1, 1, 1',1,1,0,25),(18,'Suministro','ubigeo','Ubigeo','municipio','Municipio',18,'venta',0,'','',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w',0,1,'',0,'1, 1, 1, 1, 1, 1',1,0,0,25),(19,'Suministro','ubigeo','Ubigeo','codigo_postal','Código Postal',19,'venta',0,'','',1,'INT','1, 2, 3, 4, 5, 6','w, w, w, w, w, w',0,1,'',0,'1, 1, 1, 1, 1, 1',1,1,0,25),(20,'Suministro','suministro','Suministro','cups','CUPS',20,'venta',0,'','',1,'BANCO22','1, 2, 3, 4, 5, 6','w, w, w, w, w, w',1,5,'CUPS',200,'1, 1, 1, 1, 1, 1',1,1,0,25),(21,'Suministro','suministro','Suministro','comercializadora','Comercializadora',21,'venta',0,'','',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w',0,1,'',0,'1, 1, 1, 1, 1, 1',1,0,0,25),(22,'Suministro','suministro','Suministro','potencia','Potencia',22,'venta',0,'','',1,'FLOAT','1, 2, 3, 4, 5, 6','w, w, w, w, w, w',0,1,'',0,'1, 1, 1, 1, 1, 1',1,0,0,25),(23,'Suministro','suministro','Suministro','tarifa_acceso_005','Tarifa de Acceso',23,'venta',2,'','',1,'VARCHAR','1, 2, 3, 4, 5, 6','w, w, w, w, w, w',0,1,'',0,'1, 1, 1, 1, 1, 1',1,0,0,25),(24,'Estado','','','observaciones_acesor','Observaciones del Acesor',25,'venta',0,'','',1,'TEXT','1, 2, 3, 4, 5, 6','w, w, w, w, w, w',0,1,'',0,'1, 1, 1, 1, 1, 1',0,0,0,25),(25,'Estado','backoffice','BackOffice','cambio_estado','Cambio de Estado',26,'venta',0,'','',1,'TIMESTAMP','1, 2, 3, 4, 5, 6','w, w, w, w, r, w',1,10,'CAMBIO ESTADO',80,'1, 1, 1, 1, 1, 1',1,0,0,15),(26,'Estado','backoffice','BackOffice','comentario_tramitacion','Comentario de Tramitación',27,'venta',0,'','',1,'TEXT','1, 2, 3, 4, 5, 6','w, w, w, w, r, w',1,11,'COMENTARIO TRAMITACION',120,'1, 1, 1, 1, 1, 1',0,0,0,45);
/*!40000 ALTER TABLE `venta_campania_005_campos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `venta_campania_006`
--

DROP TABLE IF EXISTS `venta_campania_006`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `venta_campania_006` (
  `id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `venta_campania_006`
--

LOCK TABLES `venta_campania_006` WRITE;
/*!40000 ALTER TABLE `venta_campania_006` DISABLE KEYS */;
/*!40000 ALTER TABLE `venta_campania_006` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `venta_campania_006_campos`
--

DROP TABLE IF EXISTS `venta_campania_006_campos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `venta_campania_006_campos` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `pestana` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `grupo` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `grupo_etiqueta` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `etiqueta` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `orden` int(11) NOT NULL,
  `tabla` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `diccionario` tinyint(2) NOT NULL,
  `diccionario_dependencia` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `diccionario_nombre` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `diccionario_orden` tinyint(1) NOT NULL DEFAULT '1',
  `tipo` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `perfiles` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '1, 2, 3, 4, 5, 6',
  `permisos` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'w, w, w, w, w, w',
  `listado_aparece` tinyint(4) NOT NULL DEFAULT '0',
  `listado_orden` int(11) NOT NULL DEFAULT '1',
  `listado_label` varchar(150) DEFAULT NULL,
  `listado_ancho` int(11) DEFAULT '100',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `venta_campania_006_campos`
--

LOCK TABLES `venta_campania_006_campos` WRITE;
/*!40000 ALTER TABLE `venta_campania_006_campos` DISABLE KEYS */;
/*!40000 ALTER TABLE `venta_campania_006_campos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `venta_cliente_005`
--

DROP TABLE IF EXISTS `venta_cliente_005`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `venta_cliente_005` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `info_status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `venta_cliente_005`
--

LOCK TABLES `venta_cliente_005` WRITE;
/*!40000 ALTER TABLE `venta_cliente_005` DISABLE KEYS */;
INSERT INTO `venta_cliente_005` VALUES (1,'jun perez',1),(2,'sdfsfd',1),(3,'dsfrwerwer',1);
/*!40000 ALTER TABLE `venta_cliente_005` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `venta_cliente_documento_tipo`
--

DROP TABLE IF EXISTS `venta_cliente_documento_tipo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `venta_cliente_documento_tipo` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `info_status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `venta_cliente_documento_tipo`
--

LOCK TABLES `venta_cliente_documento_tipo` WRITE;
/*!40000 ALTER TABLE `venta_cliente_documento_tipo` DISABLE KEYS */;
INSERT INTO `venta_cliente_documento_tipo` VALUES (1,'DNI o NIF',1),(2,'CIF',1),(3,'NIE',1);
/*!40000 ALTER TABLE `venta_cliente_documento_tipo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `venta_cliente_tipo`
--

DROP TABLE IF EXISTS `venta_cliente_tipo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `venta_cliente_tipo` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `info_status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `venta_cliente_tipo`
--

LOCK TABLES `venta_cliente_tipo` WRITE;
/*!40000 ALTER TABLE `venta_cliente_tipo` DISABLE KEYS */;
INSERT INTO `venta_cliente_tipo` VALUES (1,'Residencial',1),(2,'Autonomo o Empresa',1);
/*!40000 ALTER TABLE `venta_cliente_tipo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `venta_direccion_nombre`
--

DROP TABLE IF EXISTS `venta_direccion_nombre`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `venta_direccion_nombre` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` text COLLATE utf8_unicode_ci NOT NULL,
  `info_status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `venta_direccion_nombre`
--

LOCK TABLES `venta_direccion_nombre` WRITE;
/*!40000 ALTER TABLE `venta_direccion_nombre` DISABLE KEYS */;
INSERT INTO `venta_direccion_nombre` VALUES (1,'de Aurora',1),(2,'aa',1),(3,'maestro garcia montes',1),(4,'Joan Maragall',1),(5,'santa pau',1),(6,'la retama',1),(7,'asdsd',1),(8,'cvbvcbvb bvg',1);
/*!40000 ALTER TABLE `venta_direccion_nombre` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `venta_direccion_tipo`
--

DROP TABLE IF EXISTS `venta_direccion_tipo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `venta_direccion_tipo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `info_status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `venta_direccion_tipo`
--

LOCK TABLES `venta_direccion_tipo` WRITE;
/*!40000 ALTER TABLE `venta_direccion_tipo` DISABLE KEYS */;
INSERT INTO `venta_direccion_tipo` VALUES (1,'Calle',1),(2,'Avenida',1),(3,'Plaza',1);
/*!40000 ALTER TABLE `venta_direccion_tipo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `venta_estado`
--

DROP TABLE IF EXISTS `venta_estado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `venta_estado` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `info_status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `venta_estado`
--

LOCK TABLES `venta_estado` WRITE;
/*!40000 ALTER TABLE `venta_estado` DISABLE KEYS */;
INSERT INTO `venta_estado` VALUES (1,'En tramitacion',1),(2,'Ok tramitado',1),(3,'Ko cliente',1);
/*!40000 ALTER TABLE `venta_estado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `venta_estado_real`
--

DROP TABLE IF EXISTS `venta_estado_real`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `venta_estado_real` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `estado_id` bigint(20) NOT NULL,
  `info_status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `venta_estado_real`
--

LOCK TABLES `venta_estado_real` WRITE;
/*!40000 ALTER TABLE `venta_estado_real` DISABLE KEYS */;
INSERT INTO `venta_estado_real` VALUES (1,'Pendiente',1,1),(2,'En tramitacion',1,1),(3,'Ok tramitado',2,1),(4,'Autoinstalable',1,1),(5,'Incidencia cliente',1,1),(6,'Pendiente de instalación',1,1),(7,'Pendiente de documentación',1,1),(8,'Ko cliente',3,1),(9,'Desconectada',1,1),(11,'Pendiente por documentacion',1,1);
/*!40000 ALTER TABLE `venta_estado_real` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `venta_localidad`
--

DROP TABLE IF EXISTS `venta_localidad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `venta_localidad` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` text COLLATE utf8_unicode_ci NOT NULL,
  `provincia` bigint(20) NOT NULL,
  `info_status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `venta_localidad`
--

LOCK TABLES `venta_localidad` WRITE;
/*!40000 ALTER TABLE `venta_localidad` DISABLE KEYS */;
INSERT INTO `venta_localidad` VALUES (1,'Tres Cantos',1,1),(6,'nuevo',1,1),(7,'aaaa',50,1),(8,'nuevoXD',63,1),(9,'Localidad 01',52,1),(10,'Mollet del valles',43,1),(11,'zaragoza',22,1),(12,'ejemplo',7,1),(13,'localida 22',64,1),(14,'ccccc',63,1),(15,'localidad',2,1);
/*!40000 ALTER TABLE `venta_localidad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `venta_modalidad`
--

DROP TABLE IF EXISTS `venta_modalidad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `venta_modalidad` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `info_status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `venta_modalidad`
--

LOCK TABLES `venta_modalidad` WRITE;
/*!40000 ALTER TABLE `venta_modalidad` DISABLE KEYS */;
INSERT INTO `venta_modalidad` VALUES (1,'Alta Nueva',1),(2,'Portalidad',1);
/*!40000 ALTER TABLE `venta_modalidad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `venta_movil_estado`
--

DROP TABLE IF EXISTS `venta_movil_estado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `venta_movil_estado` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `info_status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `venta_movil_estado`
--

LOCK TABLES `venta_movil_estado` WRITE;
/*!40000 ALTER TABLE `venta_movil_estado` DISABLE KEYS */;
INSERT INTO `venta_movil_estado` VALUES (1,'Tarjeta',1),(2,'Contrato',1);
/*!40000 ALTER TABLE `venta_movil_estado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `venta_operador`
--

DROP TABLE IF EXISTS `venta_operador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `venta_operador` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `info_status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `venta_operador`
--

LOCK TABLES `venta_operador` WRITE;
/*!40000 ALTER TABLE `venta_operador` DISABLE KEYS */;
INSERT INTO `venta_operador` VALUES (1,'Euskaltel',1),(2,'Movistar',1),(3,'Orange',1),(4,'R(Telecomunicaciones)',1),(5,'Telecable',1),(6,'Vodafone',1),(7,'Yoigo',1),(8,'Telecom',1),(9,'Jazztel',1),(10,'Ya.Com',1),(11,'Extratelecom',1),(12,'Simyo',1),(13,'Laicamovil',1),(14,'Ptv(procono)',1),(15,'Digi Movil',1),(16,'Lebara',1),(17,'Mas Movil',1),(18,'345345',1);
/*!40000 ALTER TABLE `venta_operador` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `venta_producto`
--

DROP TABLE IF EXISTS `venta_producto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `venta_producto` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` text COLLATE utf8_unicode_ci NOT NULL,
  `campania` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'campania_00',
  `info_status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `venta_producto`
--

LOCK TABLES `venta_producto` WRITE;
/*!40000 ALTER TABLE `venta_producto` DISABLE KEYS */;
INSERT INTO `venta_producto` VALUES (1,'Vodafone One L 300Mb ','campania_001',1),(2,'Duo Fibra 50Mb','campania_001',1),(3,'Vodafone One S 50Mb ','campania_001',1),(4,'Vodafone One M 50Mb ','campania_001',1),(5,'Vodafone One L 50Mb ','campania_001',1),(6,'Duo Fibra 120Mb','campania_001',1),(7,'Vodafone One S 120Mb ','campania_001',1),(8,'Vodafone One M 120Mb ','campania_001',1),(9,'Vodafone One L 120Mb ','campania_001',1),(10,'Duo Fibra 300Mb','campania_001',1),(11,'Vodafone One S 300Mb ','campania_001',1),(12,'Duo fibra M 300Mb ','campania_001',1),(13,'ADSL Max vellocidad(Autonomo)','campania_001',1),(14,'temp22','campania_002',1);
/*!40000 ALTER TABLE `venta_producto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `venta_provincia`
--

DROP TABLE IF EXISTS `venta_provincia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `venta_provincia` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `info_status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `venta_provincia`
--

LOCK TABLES `venta_provincia` WRITE;
/*!40000 ALTER TABLE `venta_provincia` DISABLE KEYS */;
INSERT INTO `venta_provincia` VALUES (1,'Madrid',1),(2,'Almeria',1),(3,'Cadiz',1),(4,'Cordoba',1),(5,'Granada',1),(6,'Huelva',1),(7,'Jaen',1),(8,'Malaga',1),(9,'Sevilla',1),(10,'Huesca',1),(11,'Teruel',1),(22,'Zaragoza',1),(23,'Las palmas',1),(24,'Santa cruz de tenerife',1),(25,'Cantabria',1),(26,'Albacete',1),(32,'Guadalajara',1),(33,'Toledo',1),(34,'Burgos',1),(35,'Leon',1),(36,'Palencia',1),(37,'Salamanca',1),(38,'Segovia',1),(39,'Soria',1),(40,'Valladolid',1),(41,'Zamora',1),(42,'Avila',1),(43,'Barcelona',1),(44,'Gerona',1),(45,'Lerida',1),(46,'Tarragona',1),(47,'Ceuta',1),(48,'Navarra',1),(49,'Alicante',1),(50,'Castellon',1),(51,'Valencia',1),(52,'Badajoz ',1),(53,'Caceres',1),(54,'La acoruña',1),(55,'Lugo',1),(56,'Orense',1),(57,'Pontevedra',1),(58,'Islas baleares',1),(59,'La rioja ',1),(60,'Melilla',1),(61,'Guipuzcoa',1),(62,'Vizcaya',1),(63,'Alava',1),(64,'Asturias',1),(65,'Murcia',1),(66,'Cuidad real',1),(67,'Cuenca',1);
/*!40000 ALTER TABLE `venta_provincia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `venta_tarifa_acceso_005`
--

DROP TABLE IF EXISTS `venta_tarifa_acceso_005`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `venta_tarifa_acceso_005` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `info_status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `venta_tarifa_acceso_005`
--

LOCK TABLES `venta_tarifa_acceso_005` WRITE;
/*!40000 ALTER TABLE `venta_tarifa_acceso_005` DISABLE KEYS */;
INSERT INTO `venta_tarifa_acceso_005` VALUES (1,'2.0DHS LUZ',1),(2,'2.1A LUZ',1),(3,'2.1DHA LUZ',1),(4,'2.1DHS LUZ',1),(5,'3.0A LUZ',1),(6,'3.1A LUZ',1),(7,'6.1A LUZ',1),(8,'6.1B LUZ',1),(9,'6.2 LUZ',1),(10,'6.3 LUZ',1),(11,'6.4 LUZ',1),(12,'6.5 LUZ',1),(13,'3.1 GAS',1),(14,'3.2 GAS',1);
/*!40000 ALTER TABLE `venta_tarifa_acceso_005` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `venta_tarifa_movil`
--

DROP TABLE IF EXISTS `venta_tarifa_movil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `venta_tarifa_movil` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `campania` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `info_status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `venta_tarifa_movil`
--

LOCK TABLES `venta_tarifa_movil` WRITE;
/*!40000 ALTER TABLE `venta_tarifa_movil` DISABLE KEYS */;
INSERT INTO `venta_tarifa_movil` VALUES (1,'S','campania_001',1),(2,'M','campania_001',1),(3,'L','campania_001',1),(4,'Mini ','campania_001',1),(5,'S','campania_002',1),(6,'M','campania_002',1),(7,'L','campania_002',1);
/*!40000 ALTER TABLE `venta_tarifa_movil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `venta_tipo_venta_005`
--

DROP TABLE IF EXISTS `venta_tipo_venta_005`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `venta_tipo_venta_005` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `info_status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `venta_tipo_venta_005`
--

LOCK TABLES `venta_tipo_venta_005` WRITE;
/*!40000 ALTER TABLE `venta_tipo_venta_005` DISABLE KEYS */;
INSERT INTO `venta_tipo_venta_005` VALUES (1,'LUZ',1),(2,'GAZ',1);
/*!40000 ALTER TABLE `venta_tipo_venta_005` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `venta_titular`
--

DROP TABLE IF EXISTS `venta_titular`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `venta_titular` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `info_status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `venta_titular`
--

LOCK TABLES `venta_titular` WRITE;
/*!40000 ALTER TABLE `venta_titular` DISABLE KEYS */;
INSERT INTO `venta_titular` VALUES (1,'SI',1),(2,'NO',1);
/*!40000 ALTER TABLE `venta_titular` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `venta_venta_estado_005`
--

DROP TABLE IF EXISTS `venta_venta_estado_005`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `venta_venta_estado_005` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `info_status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `venta_venta_estado_005`
--

LOCK TABLES `venta_venta_estado_005` WRITE;
/*!40000 ALTER TABLE `venta_venta_estado_005` DISABLE KEYS */;
INSERT INTO `venta_venta_estado_005` VALUES (1,'VENTA CON DNI',1),(2,'PTE&nbsp;LLAMADA AUTOMATICA',1),(3,'PTE CONFIRMACION POR EMAIL',1),(4,'FIRMADO ONLINE',1),(5,'PTE DOCUMENTACION',1),(6,'KO',1),(7,'EN TRAMITE',1),(8,'PTE ACTIVACION',1),(9,'ACTIVADO',1),(10,'RECHAZADO',1),(11,'BAJA',1);
/*!40000 ALTER TABLE `venta_venta_estado_005` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `vista_usuarios`
--

DROP TABLE IF EXISTS `vista_usuarios`;
/*!50001 DROP VIEW IF EXISTS `vista_usuarios`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `vista_usuarios` (
  `id` tinyint NOT NULL,
  `nombre` tinyint NOT NULL,
  `nombre_corto` tinyint NOT NULL,
  `login` tinyint NOT NULL,
  `clave` tinyint NOT NULL,
  `perfil` tinyint NOT NULL,
  `grupo_1` tinyint NOT NULL,
  `grupo_2` tinyint NOT NULL,
  `grupo_5` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Dumping routines for database 'neointelperu_apps'
--
/*!50003 DROP PROCEDURE IF EXISTS `usu_lineal_save` */;
ALTER DATABASE `neointelperu_apps` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`neo`@`localhost` PROCEDURE `usu_lineal_save`(
  in_id BIGINT
, in_nombre VARCHAR(500)
, in_info_status INT
, in_campania_id BIGINT
, in_fecha VARCHAR(100)
, in_usuario BIGINT
)
BEGIN
  DECLARE ou_id BIGINT DEFAULT 0;
  IF in_id = 0 THEN
     INSERT INTO lineal
     (nombre, info_status, info_create, info_create_user)
     VALUES(in_nombre, in_info_status, in_fecha, in_usuario)
     ;
     SELECT last_insert_id() INTO ou_id
     ;
     INSERT INTO campania_lineal
     (lineal_id, campania_id, info_create, info_create_user)
     VALUES (ou_id, in_campania_id, in_fecha, in_usuario)
     ;
  ELSE
     UPDATE lineal SET 
       nombre = in_nombre
     , info_status = in_info_status
     , info_update = in_fecha
     , info_update_user = in_usuario
     WHERE id = in_id
     ;
     UPDATE campania_lineal SET 
       campania_id = in_campania_id
     , info_update = in_fecha
     , info_update_user = in_usuario
     WHERE lineal_id = in_id
     ;
     SET ou_id = in_id
     ;
  END IF
  ;
  SELECT ou_id;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
ALTER DATABASE `neointelperu_apps` CHARACTER SET utf8 COLLATE utf8_general_ci ;
/*!50003 DROP PROCEDURE IF EXISTS `usu_usuario_asesor_venta_save` */;
ALTER DATABASE `neointelperu_apps` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`neo`@`localhost` PROCEDURE `usu_usuario_asesor_venta_save`(
  in_nombre TEXT
, in_login VARCHAR(100)
, in_supervisor VARCHAR(100)
)
proc_label:BEGIN
  DECLARE pr_supervisor_perfil_id BIGINT DEFAULT 0;
  DECLARE pr_user_id BIGINT DEFAULT 0;
  DECLARE pr_user_perfil_id BIGINT DEFAULT 0;
  DECLARE pr_perfil_id BIGINT DEFAULT 0;
  DECLARE pr_user_lineal_id BIGINT DEFAULT 0;
  DECLARE pr_lineal_id BIGINT DEFAULT 0;
  
  
  SELECT up.perfil_id INTO pr_supervisor_perfil_id FROM usu_usuario_perfil up
  join usu_usuario u ON u.id=up.usuario_id
  WHERE u.login=in_supervisor
  ;
  IF pr_supervisor_perfil_id != 4  THEN
     SELECT 'No es supervisor';
     LEAVE proc_label;
  END IF
  ;
  
  SELECT id INTO pr_user_id FROM usu_usuario WHERE login = in_login
  ;
  IF pr_user_id > 0 THEN
    SELECT 'Usuario Existente';
  ELSE
    INSERT INTO usu_usuario (nombre, login) VALUES(in_nombre, in_login)
    ;
    SELECT last_insert_id() INTO pr_user_id
    ;
    SELECT 'Usuario Nuevo';
  END IF
  ;
  
  SELECT id, perfil_id INTO pr_user_perfil_id, pr_perfil_id
  FROM usu_usuario_perfil WHERE usuario_id = pr_user_id
  ;
  IF pr_user_perfil_id > 0 THEN
     IF pr_perfil_id != 5 THEN
        SELECT 'Perfil Sin Permiso';
     END IF
     ;
  ELSE
     INSERT INTO usu_usuario_perfil(usuario_id, perfil_id)
     VALUES (pr_user_id, 5)
     ;  
  END IF
  ;
  
  IF pr_perfil_id != 5 THEN
     SELECT ul.lineal_id INTO pr_lineal_id
     FROM usu_usuario_lineal ul
     LEFT JOIN usu_usuario u ON u.id=ul.usuario_id
     WHERE u.login=in_supervisor
     ;
     SELECT id INTO pr_user_lineal_id
     FROM usu_usuario_lineal
     WHERE usuario_id = pr_user_id
     ;
     
     IF pr_user_lineal_id > 0 THEN
        UPDATE usu_usuario_lineal SET lineal_id=pr_lineal_id
        WHERE usuario_id = pr_user_id
        ;
     ELSE
        INSERT INTO usu_usuario_lineal(usuario_id, lineal_id) VALUES
        (pr_user_id, pr_lineal_id)
        ;
     END IF
     ;
  END IF
  ;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
ALTER DATABASE `neointelperu_apps` CHARACTER SET utf8 COLLATE utf8_general_ci ;
/*!50003 DROP PROCEDURE IF EXISTS `usu_usuario_save` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`neo`@`localhost` PROCEDURE `usu_usuario_save`(
  in_id BIGINT
, in_nombre VARCHAR(500)
, in_nombre_corto VARCHAR(500)
, in_login VARCHAR(500)
, in_comentario VARCHAR(500)
, in_telefono VARCHAR(100)
, in_direccion VARCHAR(500)
, in_info_status INT
, in_fecha_entrada VARCHAR(20)
, in_fecha_cese VARCHAR(20)
, in_cese_observacion VARCHAR(200)
, in_cese_tipo BIGINT
, in_perfil_id BIGINT
, in_fecha VARCHAR(100)
, in_usuario BIGINT
)
BEGIN
  DECLARE ou_id BIGINT DEFAULT 0;
  IF in_id = 0 THEN
     INSERT INTO usu_usuario
     (nombre, nombre_corto, login, comentario,
      telefono, direccion, 
      info_status, fecha_entrada, fecha_cese,
      cese_observacion, cese_tipo,
      info_create, info_create_user)
     VALUES(in_nombre, in_nombre_corto, in_login, in_comentario,
            in_telefono, in_direccion, 
            in_info_status, in_fecha_entrada, in_fecha_cese,
            in_cese_observacion, in_cese_tipo,
            in_fecha, in_usuario)
     ;
     SELECT last_insert_id() INTO ou_id
     ;
     INSERT INTO usu_usuario_perfil (usuario_id, perfil_id, info_create, info_create_user)
     VALUES (ou_id, in_perfil_id,in_fecha, in_usuario)
     ;
  ELSE
     UPDATE usu_usuario SET 
       nombre = in_nombre
     , nombre_corto = in_nombre_corto
     , login = in_login
     , comentario = in_comentario
     , telefono = in_telefono
     , direccion = in_direccion
     , info_status = in_info_status
     , fecha_entrada = in_fecha_entrada
     , fecha_cese = in_fecha_cese
     , cese_observacion = in_cese_observacion
     , cese_tipo = in_cese_tipo
     , info_update = in_fecha
     , info_update_user = in_usuario
     WHERE id = in_id
     ;
     UPDATE usu_usuario_perfil SET 
       perfil_id = in_perfil_id
     , info_update = in_fecha
     , info_update_user = in_usuario
     WHERE usuario_id = in_id
     ;
     SET ou_id = in_id;
  END IF
  ;
  SELECT ou_id
  ;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `ventas_save` */;
ALTER DATABASE `neointelperu_apps` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`neo`@`localhost` PROCEDURE `ventas_save`(`in_id` BIGINT, `in_campania` VARCHAR(600), `in_fecha` VARCHAR(100), `in_usuario` INT)
BEGIN
  DECLARE ou_id BIGINT;
  DECLARE pr_lineal_id BIGINT;
  DECLARE pr_asesor_venta_id BIGINT;
  
  DECLARE pr_supervisor_id BIGINT;
  DECLARE pr_coordinador_id BIGINT;
  
  IF in_id=0 THEN
     SELECT lineal_id INTO pr_lineal_id  FROM usu_usuario_lineal WHERE usuario_id= in_usuario LIMIT 1
     ;
     
     
     
     
     SELECT ul.usuario_id INTO pr_supervisor_id FROM usu_usuario_lineal ul
     LEFT JOIN usu_usuario_perfil up ON up.usuario_id=ul.usuario_id
     WHERE ul.lineal_id= pr_lineal_id and up.perfil_id=4
     ;
     SELECT ul.usuario_id INTO pr_coordinador_id FROM usu_usuario_lineal ul
     LEFT JOIN usu_usuario_perfil up ON up.usuario_id=ul.usuario_id
     WHERE ul.lineal_id= pr_lineal_id and up.perfil_id=6
     ;

     INSERT INTO venta
     (info_create_fecha, info_create_user, info_update_fecha,
      asesor_venta_id, supervisor_id, coordinador_id,
      campania, lineal_id)
     VALUES
     (in_fecha, in_usuario, in_fecha,
      in_usuario, pr_supervisor_id, pr_coordinador_id,
      in_campania, pr_lineal_id)
     ; 
     SELECT last_insert_id() INTO ou_id
     ;
  ELSE
     UPDATE venta SET
     info_update_user=in_usuario, info_update_fecha=in_fecha
     WHERE id=in_id
     ;
     SET ou_id = in_id;
  END IF
  ;
  SELECT ou_id
  ;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
ALTER DATABASE `neointelperu_apps` CHARACTER SET utf8 COLLATE utf8_general_ci ;

--
-- Final view structure for view `vista_usuarios`
--

/*!50001 DROP TABLE IF EXISTS `vista_usuarios`*/;
/*!50001 DROP VIEW IF EXISTS `vista_usuarios`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`neo`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_usuarios` AS select `u`.`id` AS `id`,`u`.`nombre` AS `nombre`,`u`.`nombre_corto` AS `nombre_corto`,`u`.`login` AS `login`,if((`u`.`pwd` = '$4nkNrBEK8ra2'),'No','Si') AS `clave`,`p`.`nombre` AS `perfil`,(select count(`usu_usuario_lineal`.`id`) from `usu_usuario_lineal` where ((`usu_usuario_lineal`.`usuario_id` = `u`.`id`) and (`usu_usuario_lineal`.`lineal_id` = 1))) AS `grupo_1`,(select count(`usu_usuario_lineal`.`id`) from `usu_usuario_lineal` where ((`usu_usuario_lineal`.`usuario_id` = `u`.`id`) and (`usu_usuario_lineal`.`lineal_id` = 2))) AS `grupo_2`,(select count(`usu_usuario_lineal`.`id`) from `usu_usuario_lineal` where ((`usu_usuario_lineal`.`usuario_id` = `u`.`id`) and (`usu_usuario_lineal`.`lineal_id` = 5))) AS `grupo_5` from ((`usu_usuario` `u` left join `usu_usuario_perfil` `up` on((`up`.`usuario_id` = `u`.`id`))) left join `usu_perfil` `p` on((`p`.`id` = `up`.`perfil_id`))) order by `u`.`id` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-08-11 20:35:19
