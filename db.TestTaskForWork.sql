-- MySQL dump 10.13  Distrib 8.0.15, for Win64 (x86_64)
--
-- Host: localhost    Database: bd_testtaskforwork
-- ------------------------------------------------------
-- Server version	8.0.15

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8mb4 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_id` (`user_id`),
  CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,2,105.30),(2,10,631.17),(3,14,150.09),(4,15,1500.00),(5,16,850.00),(6,16,7230.00),(7,17,5201.00),(8,17,163.00),(9,17,21.00),(10,16,70.00),(11,19,125.00),(12,19,5421.21),(13,19,8421.21);
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(55) NOT NULL,
  `login` varchar(55) NOT NULL,
  `password` varchar(255) NOT NULL,
  `surname` varchar(55) NOT NULL,
  `name` varchar(55) NOT NULL,
  `patronymic` varchar(55) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (2,'egorEmelin@mail.ru','EgorEmelin','$2y$10$XBhZg2i95bs3fDVV.CWFEuH9kOZpxzp7OnM3jE4zq.Pn1Wufs/IU6','Емелин','Егор','Сергеевич'),(9,'yuriyAntonov@gmail.com','YuriyAntonov','$2y$10$tTvQyROYiGpcU.wk4VVVo.SH/wnfBVoJHq8wQ6AskICPHQZ1u8ryy','Антонов','Юрий','Александрович'),(10,'VasiliyFomin@mail.ru','VasiliyFomin','$2y$10$9c1815k85WAOwNJAIOb06OnYSFCp5D9nXz/4dkkfSWOGpKjmIQs0u','Фомин','Василий','Николаевич'),(11,'NikolayPetrenko@mail.ru','NikolayPetrenko','$2y$10$0JmkzUKPCOtKfZGeAogHE.O9TGRtviCaURv6VKxFwxDmiH76nOohu','Петренко','Николай','Григорьевич'),(12,'PetrUstugov@mail.ru','PetrUstugov','$2y$10$s4rF920nVBOOHnpcM/.XP.eeWiuUbpICl0/dFFq5wwyOH2DqRBrPy','Устюгов','Петр','Валерьевич'),(13,'RomanGorin@mail.ru','RomanGorin','$2y$10$dCS4qSrjyJRqrMnIUzfane4fcXUj6PvGDS.hEcxzzPil5oSt3Fa1K','Горин','Роман','Сергеевич'),(14,'ValeriySholokhov@ya.ru','ValeriySholokhov','$2y$10$a76RfG2jhqwCYRXFNJaIE.4iq2/.Xf3HdBg6pZodaAevlWt26Crci','Шолохов','Валерий','Максимович'),(15,'StasPerushin@mail.ru','StasPerushin','$2y$10$7dVwjS2Z66Q4ShtuZfd7j.qyLI0PznHWCmBLgwYZIiLdczK4AC7Ui','Перушин','Стас','Петрович'),(16,'GrigoriyUliyanov@ya.ru','GrigoriyUliyanov','$2y$10$40dWAZwfdceXH8yl7vSDleAoG1eGcNIuavAhLrG6vz0XFz3egaXmS','Ульянов','Григорий','Васильевич'),(17,'IlyaVarlamov@gmail.com','IlyaVarlamov','$2y$10$sl0jzTaXm6.i5Mf1pcrMAuySYAVoSjiQRucbPxJXR3EtGdSR3WQr.','Варламов','Илья','Романович'),(18,'ArtemZaycev@mail.ru','ArtemZaycev','$2y$10$yM8uLqVItpsK1lBP4E6Qg.8B3QylOjwU2yOa15rTb7NnEX0D5fS.S','Зайцев','Артем','Николаевич'),(19,'RuslanBeliy@gmail.com','RuslanBeliy','$2y$10$8V88k7m5P/RIDPkedODg6OnLFf3I8RZCUD9ZJI3LTU39vB3cr6RRe','Белый','Руслан','Романович');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-08-10 20:00:52
