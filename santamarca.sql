-- MySQL dump 10.13  Distrib 5.5.44, for debian-linux-gnu (i686)
--
-- Host: localhost    Database: santamarca
-- ------------------------------------------------------
-- Server version	5.5.44-0ubuntu0.12.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `sm_backgrounds`
--

DROP TABLE IF EXISTS `sm_backgrounds`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sm_backgrounds` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) DEFAULT '',
  `width` smallint(6) DEFAULT NULL,
  `height` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sm_backgrounds`
--

LOCK TABLES `sm_backgrounds` WRITE;
/*!40000 ALTER TABLE `sm_backgrounds` DISABLE KEYS */;
INSERT INTO `sm_backgrounds` VALUES (42,'42.jpg',1397,1051),(43,'43.jpg',1388,931),(41,'41.jpg',1500,1110),(45,'45.jpg',1031,745),(26,'26.jpg',1392,800),(40,'40.jpg',2008,1400),(39,'39.jpg',2087,1427),(47,'47.jpg',1300,967);
/*!40000 ALTER TABLE `sm_backgrounds` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sm_images`
--

DROP TABLE IF EXISTS `sm_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sm_images` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `name` varchar(64) DEFAULT NULL,
  `priority` smallint(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=251 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sm_images`
--

LOCK TABLES `sm_images` WRITE;
/*!40000 ALTER TABLE `sm_images` DISABLE KEYS */;
INSERT INTO `sm_images` VALUES (108,1,'1_70622_11232',0),(116,1,'1_28026_48895',0),(177,3,'3_79729_52733',0),(107,1,'1_01697_61663',0),(161,1,'1_77783_25530',0),(8,1,'1_8',0),(9,1,'1_9',0),(10,1,'1_10',0),(11,2,'2_1',0),(156,3,'3_51352_84375',0),(23,4,'4_3',0),(24,4,'4_4',0),(25,4,'4_5',1),(26,4,'4_6',0),(27,4,'4_7',0),(127,3,'3_89502_46463',0),(152,3,'3_19634_49464',0),(30,5,'5_2',1),(31,5,'5_3',0),(32,5,'5_4',0),(33,5,'5_5',0),(34,5,'5_6',0),(35,5,'5_7',0),(36,5,'5_8',0),(37,5,'5_9',0),(97,11,'11_48333_48983',0),(98,11,'11_84800_13944',1),(102,12,'12_97604_03891',0),(44,6,'6_7',0),(45,6,'6_8',0),(46,7,'7_1',0),(47,7,'7_2',0),(48,7,'7_3',0),(49,7,'7_4',0),(50,7,'7_5',0),(51,7,'7_6',0),(52,7,'7_7',0),(53,7,'7_8',0),(54,7,'7_9',0),(55,7,'7_10',0),(56,7,'7_11',0),(57,8,'8_1',0),(58,8,'8_2',0),(59,8,'8_3',0),(60,8,'8_4',0),(61,8,'8_5',0),(94,10,'10_84979_39006',0),(90,10,'10_74374_17194',1),(96,10,'10_31929_19574',0),(100,11,'11_20033_51783',0),(208,15,'15_67261_88613',1),(103,12,'12_58121_04568',0),(104,1,'1_68473_33503',0),(105,1,'1_03313_75629',0),(114,1,'1_90204_31549',0),(205,1,'1_02875_07025',1),(162,1,'1_21414_88582',0),(123,3,'3_19132_59559',0),(125,3,'3_63794_08828',0),(166,1,'1_56340_03854',0),(133,5,'5_56949_76385',1),(135,13,'13_30295_28338',0),(137,13,'13_55902_27222',0),(150,11,'11_37774_12794',0),(141,13,'13_69516_06465',1),(155,3,'3_35900_55915',0),(158,3,'3_31607_54334',0),(167,3,'3_88493_76818',0),(164,1,'1_98491_97065',0),(173,3,'3_11359_74278',1),(175,3,'3_38592_54756',1),(178,3,'3_22074_22609',0),(180,14,'14_19346_59908',0),(181,14,'14_88959_79200',0),(183,14,'14_83239_91156',0),(184,14,'14_70949_62825',0),(185,14,'14_31029_54692',1),(188,14,'14_63403_31672',0),(189,14,'14_36847_92492',0),(190,14,'14_46417_84578',0),(192,15,'15_41767_95566',0),(193,15,'15_45414_96857',0),(195,15,'15_22266_13183',0),(196,15,'15_27515_11219',0),(197,15,'15_43725_22195',0),(198,15,'15_60488_08519',0),(199,15,'15_72680_24501',0),(202,15,'15_56189_61573',0),(203,1,'1_24080_74605',2),(209,16,'16_49604_62245',0),(210,16,'16_30299_02984',0),(211,16,'16_99958_15558',0),(213,16,'16_99086_18665',0),(214,16,'16_52761_48090',0),(216,17,'17_88767_98176',0),(217,17,'17_74349_17249',0),(218,17,'17_70698_95587',0),(220,18,'18_44068_85696',0),(221,18,'18_72746_46163',0),(222,18,'18_02843_21325',0),(223,19,'19_02216_30703',0),(224,19,'19_26955_34711',0),(225,19,'19_08112_69843',0),(227,2,'2_42411_53075',0),(231,20,'20_03835_58333',0),(233,20,'20_78659_49797',0),(234,20,'20_00657_10535',0),(235,20,'20_52991_18952',0),(236,20,'20_39362_10161',0),(237,20,'20_44749_29380',0),(238,20,'20_00082_73357',0),(239,20,'20_06315_36259',0),(240,20,'20_41096_47757',0),(241,20,'20_30862_81402',0),(244,20,'20_97981_56067',0),(245,21,'21_65593_73171',0),(246,21,'21_90587_87094',0),(248,21,'21_25761_86918',0),(249,21,'21_24380_65725',0),(250,21,'21_93176_33286',0);
/*!40000 ALTER TABLE `sm_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sm_projects`
--

DROP TABLE IF EXISTS `sm_projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sm_projects` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL DEFAULT '',
  `description` text,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sm_projects`
--

LOCK TABLES `sm_projects` WRITE;
/*!40000 ALTER TABLE `sm_projects` DISABLE KEYS */;
INSERT INTO `sm_projects` VALUES (1,'> Claro, cuando una marca cruza las fronteras','Claro, la marca local de telefonía móvil, ha derivado en la marca regional de telecomunicaciones. Para esto ha sido necesario llevar un arduo proceso de estandarización y adaptación de marca a cada uno de los países en los que participa. Claro es un proyecto en desarrollo, para el cual hemos colaborado, con el equipo interno de América Móvil, en la creación de manuales de estándares, sistemas de comunicación gráfica, experiencia en sucursales, desarrollo de submarcas y migración de marcas locales.','2013-05-17 16:14:22'),(2,'> Campaña institucional Telcel','En su tremenda presencia en el mercado nacional, Telcel busca una nueva expresión de marca basada en las emociones y en una invitación a la realización de su público: sueña, baila, comparte, son los temas de esta campaña que exploto en los espectaculares del país recientemente','2013-05-17 16:14:39'),(3,'> Frugo. Vive bien, come lo mejor','La compañía de productos agrícola Frugo, hoy en día proveedor de alimentos congelados y envasados a granel a compañías productoras de alimentos en EUA, Europa y Japón, como una nueva estrategia de negocio, ha comenzado a incursionar en nuevas categorías y nuevos mercados, con una amplia variedad de productos enlatados para el consumidor final y para el Food Services. Aliados en este proceso, hemos realizado un extenso proyecto de rebranding, que va desde el rediseño de su identidad, hasta las aplicaciones en líneas de productos.','2013-05-17 16:14:54'),(5,'> Perfumes Europeos','Perfumes Europeos es una opción accesible a perfumes de buena calidad. En un contexto donde las marcas tiene gran peso en la decisión de compra, Perfumes Europeos decidió reformular su marca y llevar la expresión de ésta al nivel que necesita para competir en un mercado complejo y exigente.','2013-05-17 16:15:26'),(15,'> Selmec. 70 años llenos de energía','Excelencia energética es la visión de esta empresa, con más de 70 años en el mercado. Santa Marca ha colaborado con ellos en reestructurar su pensamiento estratégico y en prepararla para los nuevos retos. Además hemos definido una identidad apropiada a la nueva estrategia y gestionamos la implementación total.','2014-06-05 11:55:08'),(20,'>Laboratorio Medico Polanco','Acompañando el proceso de expansión, y reposicionando la marca','2014-10-10 10:56:02'),(17,'> Sn. Marino. Divina comida del mar','','2014-06-05 13:32:35'),(18,'> Red Promedic','Servicios de seguros para asistencia médica a través del desarrollo de los elementos de identidad e implementación.','2014-06-05 13:34:27'),(16,'> Refillia. Ámalo otra vez','Refillia cree en la reutilización, no como un hecho meramente ecológico, sino por la capacidad que tienen las personas de crear vínculos con ciertos objetos. Ésta es la oportunidad que busca esta joven marca en el mercado. Nosotros colaboramos con ellos tanto en el desarrollo de marca, como en la conceptualización de sus productos.','2014-06-05 13:27:35'),(21,'>Renapred','Renapred es una institución comprometida con la prevención de enfermedades y deficiencias al nacimiento que interacción con las barreras del entorno, generan discapacidad. Para ellos hemos desarrollado un posiconaminetos y na image que refuerce su credibilidad y lo conecte de una manera eficiente con sus audiencias.','2015-01-16 12:47:26');
/*!40000 ALTER TABLE `sm_projects` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-01-12 18:20:17
