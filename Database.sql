CREATE DATABASE  IF NOT EXISTS `power_zone` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `power_zone`;
-- MySQL dump 10.13  Distrib 8.0.41, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: power_zone
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `carrito`
--

DROP TABLE IF EXISTS `carrito`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `carrito` (
  `id_carrito` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `fecha_creacion` datetime NOT NULL DEFAULT current_timestamp(),
  `estado` enum('activo','completado','cancelado') NOT NULL DEFAULT 'activo',
  PRIMARY KEY (`id_carrito`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `carrito_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carrito`
--

LOCK TABLES `carrito` WRITE;
/*!40000 ALTER TABLE `carrito` DISABLE KEYS */;
INSERT INTO `carrito` VALUES (15,39,'2026-04-11 14:26:26','completado'),(16,40,'2026-04-11 16:48:12','completado'),(17,37,'2026-04-11 17:07:36','activo'),(18,39,'2026-04-11 17:07:50','completado'),(19,39,'2026-04-11 17:13:32','completado'),(20,40,'2026-04-11 17:17:09','completado'),(21,39,'2026-04-12 13:14:52','completado'),(22,39,'2026-04-18 12:50:52','completado'),(23,39,'2026-04-18 13:47:50','activo'),(24,40,'2026-04-18 13:48:24','completado'),(25,40,'2026-04-18 13:59:33','completado'),(26,40,'2026-04-18 14:03:48','completado');
/*!40000 ALTER TABLE `carrito` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `carrito_detalle`
--

DROP TABLE IF EXISTS `carrito_detalle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `carrito_detalle` (
  `id_detalle` int(11) NOT NULL AUTO_INCREMENT,
  `id_carrito` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL DEFAULT 1,
  `precio_unitario` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id_detalle`),
  KEY `id_carrito` (`id_carrito`),
  KEY `id_producto` (`id_producto`),
  CONSTRAINT `carrito_detalle_ibfk_1` FOREIGN KEY (`id_carrito`) REFERENCES `carrito` (`id_carrito`),
  CONSTRAINT `carrito_detalle_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carrito_detalle`
--

LOCK TABLES `carrito_detalle` WRITE;
/*!40000 ALTER TABLE `carrito_detalle` DISABLE KEYS */;
INSERT INTO `carrito_detalle` VALUES (21,15,4,1,39990.00),(22,16,2,1,79990.00),(24,18,1,1,29990.00),(25,18,3,1,24990.00),(26,19,1,1,29990.00),(27,19,3,1,24990.00),(28,20,1,1,29990.00),(29,20,4,1,39990.00),(30,21,2,1,79990.00),(31,22,2,1,79990.00),(32,22,4,1,39990.00),(35,24,2,1,79990.00),(36,24,3,1,24990.00),(37,25,2,1,79990.00),(38,25,4,1,39990.00),(39,26,3,1,24990.00);
/*!40000 ALTER TABLE `carrito_detalle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categorias`
--

DROP TABLE IF EXISTS `categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(80) NOT NULL,
  `estado` enum('activo','inactivo') NOT NULL DEFAULT 'activo',
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias`
--

LOCK TABLES `categorias` WRITE;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` VALUES (1,'Ropa Deportiva','activo'),(2,'Zapatos Deportivos','activo'),(3,'Accesorios','activo');
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pedido_detalle`
--

DROP TABLE IF EXISTS `pedido_detalle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pedido_detalle` (
  `id_detalle` int(11) NOT NULL AUTO_INCREMENT,
  `id_pedido` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_unitario` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id_detalle`),
  KEY `id_pedido` (`id_pedido`),
  KEY `id_producto` (`id_producto`),
  CONSTRAINT `pedido_detalle_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id_pedido`),
  CONSTRAINT `pedido_detalle_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedido_detalle`
--

LOCK TABLES `pedido_detalle` WRITE;
/*!40000 ALTER TABLE `pedido_detalle` DISABLE KEYS */;
INSERT INTO `pedido_detalle` VALUES (1,1,3,1,24990.00,24990.00),(2,1,4,1,39990.00,39990.00),(4,2,2,2,79990.00,159980.00),(26,18,1,1,29990.00,29990.00),(27,18,4,1,39990.00,39990.00),(28,19,2,1,79990.00,79990.00),(29,20,2,1,79990.00,79990.00),(30,20,4,1,39990.00,39990.00),(32,21,2,1,79990.00,79990.00),(33,21,3,1,24990.00,24990.00),(35,22,2,1,79990.00,79990.00),(36,22,4,1,39990.00,39990.00),(38,23,3,1,24990.00,24990.00);
/*!40000 ALTER TABLE `pedido_detalle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pedidos`
--

DROP TABLE IF EXISTS `pedidos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pedidos` (
  `id_pedido` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `fecha_pedido` datetime NOT NULL DEFAULT current_timestamp(),
  `direccion` varchar(200) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `estado` enum('pendiente','empacado','enviado','entregado','cancelado') NOT NULL DEFAULT 'pendiente',
  `observaciones` text DEFAULT NULL,
  `metodo_pago` varchar(50) NOT NULL,
  PRIMARY KEY (`id_pedido`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedidos`
--

LOCK TABLES `pedidos` WRITE;
/*!40000 ALTER TABLE `pedidos` DISABLE KEYS */;
INSERT INTO `pedidos` VALUES (1,39,'2026-04-09 19:28:41','100 metros norte de la carnicería la Chaira y 75 metros al oeste','60046342',64980.00,'entregado','n/a','Tarjeta'),(2,39,'2026-04-09 19:40:14','100 metros norte de la carnicería la Chaira y 75 metros al oeste','60046342',289940.00,'entregado','n','Tarjeta'),(3,39,'2026-04-09 19:42:34','100 metros norte de la carnicería la Chaira y 75 metros al oeste','60046342',29990.00,'pendiente','n','Transferencia'),(4,39,'2026-04-09 19:49:03','100 metros norte de la carnicería la Chaira y 75 metros al oeste','60046342',79990.00,'pendiente','nd','Tarjeta'),(18,40,'2026-04-11 17:17:23','China Occidental','60046342',69980.00,'entregado','','Tarjeta'),(19,39,'2026-04-12 13:15:59','100 metros norte de la carnicería la Chaira y 75 metros al oeste','62046343',79990.00,'pendiente','','Tarjeta'),(20,39,'2026-04-18 12:51:23','Heredia centro','8888-5555',119980.00,'enviado','122','Transferencia'),(21,40,'2026-04-18 13:48:42','Heredia centro','60046345',104980.00,'pendiente','2122','Tarjeta'),(22,40,'2026-04-18 14:00:29','Potrero Cerrado','62046343',119980.00,'pendiente','na','Tarjeta'),(23,40,'2026-04-18 14:04:03','Heredia centro','8888-5555',24990.00,'pendiente','','Transferencia');
/*!40000 ALTER TABLE `pedidos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productos`
--

DROP TABLE IF EXISTS `productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL AUTO_INCREMENT,
  `id_categoria` int(11) NOT NULL,
  `nombre` varchar(120) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `talla` varchar(5) DEFAULT NULL,
  `color` varchar(30) DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `estado` enum('activo','inactivo') NOT NULL DEFAULT 'activo',
  `en_oferta` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`id_producto`),
  KEY `id_categoria` (`id_categoria`),
  CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productos`
--

LOCK TABLES `productos` WRITE;
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
INSERT INTO `productos` VALUES (1,1,'Camiseta Deportiva Pro','Tecnología Dri-FIT para máximo rendimiento',29990.00,21,'M','Verde','/G4_AmbienteWeb/Views/assets/images/products/01camiseta.png','activo',_binary ''),(2,2,'Zapatos Running Elite','Amortiguación superior para corredores',79990.00,0,'42','Negro','/G4_AmbienteWeb/Views/assets/images/products/02zapatos.png','activo',_binary '\0'),(3,1,'Shorts de Entrenamiento','Ligeros y transpirables',24990.00,23,'L','Gris','/G4_AmbienteWeb/Views/assets/images/products/03short.png','activo',_binary '\0'),(4,3,'Mochila Deportiva','Espacio para todo tu equipo',39990.00,5,'U','Gris','/G4_AmbienteWeb/Views/assets/images/products/04mochila.png','activo',_binary '\0');
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id_rol` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`id_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'administrador'),(2,'cliente');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `cedula` varchar(20) DEFAULT NULL,
  `nombre` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `estado` enum('activo','inactivo') NOT NULL DEFAULT 'activo',
  `id_rol` int(11) NOT NULL,
  `fecha_registro` datetime NOT NULL DEFAULT current_timestamp(),
  `token_recuperacion` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `correo` (`correo`),
  KEY `id_rol` (`id_rol`),
  CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (37,'000000000','Administrador','admin@powerzone.com','123456','activo',1,'2026-04-08 00:27:27',NULL),(38,'118870741','DARRY ANTONIO OPORTA VILLEGAS','doporta70741@ufide.ac.cr','123456','activo',2,'2026-04-07 18:27:57',NULL),(39,'305440788','FABIAN ALBERTO ARAYA BALLESTERO','fabianballester24@gmail.com','123456','activo',2,'2026-04-09 19:22:09',NULL),(40,'100299721','Daniel Suaréz','daniel@gmail.com','123456','activo',2,'2026-04-11 16:47:56',NULL);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'power_zone'
--
/*!50003 DROP PROCEDURE IF EXISTS `sp_ActualizarCantidad` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ActualizarCantidad`(
    IN pIdDetalle  INT,
    IN pIdUsuario  INT,
    IN pNuevaCant  INT
)
BEGIN
    DECLARE vIdCarrito  INT;
    DECLARE vIdProducto INT;
    DECLARE vStock      INT;
 
    -- Verificar que el ítem pertenece al carrito activo del usuario
    SELECT cd.id_carrito, cd.id_producto
    INTO   vIdCarrito, vIdProducto
    FROM   carrito_detalle cd
    JOIN   carrito         c  ON c.id_carrito = cd.id_carrito
    WHERE  cd.id_detalle = pIdDetalle
      AND  c.id_usuario  = pIdUsuario
      AND  c.estado      = 'activo'
    LIMIT  1;
 
    IF vIdCarrito IS NULL THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'Ítem no encontrado en el carrito activo.';
    END IF;
 
    IF pNuevaCant <= 0 THEN
        DELETE FROM carrito_detalle WHERE id_detalle = pIdDetalle;
    ELSE
        SELECT stock INTO vStock
        FROM   productos
        WHERE  id_producto = vIdProducto;
 
        IF pNuevaCant > vStock THEN
            SIGNAL SQLSTATE '45000'
                SET MESSAGE_TEXT = 'Stock insuficiente para la cantidad solicitada.';
        END IF;
 
        UPDATE carrito_detalle
        SET    cantidad = pNuevaCant
        WHERE  id_detalle = pIdDetalle;
    END IF;
 
    SELECT ROW_COUNT() AS filas_afectadas;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ActualizarContrasena` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ActualizarContrasena`(
    pNuevaContrasena VARCHAR(255),
    pIdUsuario INT
)
BEGIN
    UPDATE  usuarios
    SET     contrasena = pNuevaContrasena
    WHERE   id_usuario = pIdUsuario;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ActualizarEstadoPedido` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ActualizarEstadoPedido`(
    IN pIdPedido INT,
    IN pNuevoEstado VARCHAR(50)
)
BEGIN
    IF pNuevoEstado IS NOT NULL AND pNuevoEstado <> '' THEN
        UPDATE pedidos 
        SET Estado = pNuevoEstado 
        WHERE id_pedido = pIdPedido;
    END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ActualizarPerfil` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ActualizarPerfil`(
    pNombre VARCHAR(100),
    pCorreo VARCHAR(100),
    pCedula VARCHAR(20),
    pIdUsuario INT
)
BEGIN
    UPDATE  usuarios
    SET     nombre = pNombre,
            correo = pCorreo,
            cedula = pCedula
    WHERE   id_usuario = pIdUsuario;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ActualizarProducto` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ActualizarProducto`(
    pIdProducto  INT,
    pIdCategoria INT,
    pNombre      VARCHAR(120),
    pDescripcion TEXT,
    pPrecio      DECIMAL(10,2),
    pStock       INT,
    pTalla       VARCHAR(5),
    pColor       VARCHAR(30),
    pImagen      VARCHAR(255)
)
BEGIN
    UPDATE productos
    SET id_categoria = pIdCategoria,
        nombre       = pNombre,
        descripcion  = pDescripcion,
        precio       = pPrecio,
        stock        = pStock,
        talla        = pTalla,
        color        = pColor,
        imagen       = CASE WHEN pImagen != '' THEN pImagen ELSE imagen END
    WHERE id_producto = pIdProducto;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_AgregarAlCarrito` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_AgregarAlCarrito`(
    IN pIdUsuario   INT,
    IN pIdProducto  INT,
    IN pCantidad    INT
)
BEGIN
    DECLARE vIdCarrito      INT          DEFAULT NULL;
    DECLARE vIdDetalle      INT          DEFAULT NULL;
    DECLARE vCantidadActual INT          DEFAULT 0;
    DECLARE vStock          INT          DEFAULT 0;
    DECLARE vPrecio         DECIMAL(10,2);
    DECLARE vEstadoProd     VARCHAR(10);
 
    -- Validar producto
    SELECT precio, stock, estado
    INTO   vPrecio, vStock, vEstadoProd
    FROM   productos
    WHERE  id_producto = pIdProducto
    LIMIT  1;
 
    IF vEstadoProd IS NULL THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'Producto no encontrado.';
    END IF;
 
    IF vEstadoProd <> 'activo' THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'El producto no está disponible.';
    END IF;
 
    -- Buscar o crear carrito activo
    SELECT id_carrito INTO vIdCarrito
    FROM   carrito
    WHERE  id_usuario = pIdUsuario
      AND  estado     = 'activo'
    LIMIT  1;
 
    IF vIdCarrito IS NULL THEN
        INSERT INTO carrito (id_usuario, estado)
        VALUES (pIdUsuario, 'activo');
        SET vIdCarrito = LAST_INSERT_ID();
    END IF;
 
    -- Revisar si el producto ya está en el carrito
    SELECT id_detalle, cantidad
    INTO   vIdDetalle, vCantidadActual
    FROM   carrito_detalle
    WHERE  id_carrito  = vIdCarrito
      AND  id_producto = pIdProducto
    LIMIT  1;
 
    -- Validar stock total (lo que ya tiene + lo que pide)
    IF (vCantidadActual + pCantidad) > vStock THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'Stock insuficiente para la cantidad solicitada.';
    END IF;
 
    IF vIdDetalle IS NOT NULL THEN
        UPDATE carrito_detalle
        SET    cantidad = cantidad + pCantidad
        WHERE  id_detalle = vIdDetalle;
    ELSE
        INSERT INTO carrito_detalle (id_carrito, id_producto, cantidad, precio_unitario)
        VALUES (vIdCarrito, pIdProducto, pCantidad, vPrecio);
    END IF;
 
    SELECT vIdCarrito AS id_carrito;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_AgregarProducto` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_AgregarProducto`(
    pIdCategoria INT,
    pNombre VARCHAR(120),
    pDescripcion TEXT,
    pPrecio DECIMAL(10,2),
    pStock INT,
    pTalla VARCHAR(5),
    pColor VARCHAR(30),
    pImagen VARCHAR(255)
)
BEGIN
    INSERT INTO productos (id_categoria, nombre, descripcion, precio, stock, talla, color, imagen, estado)
    VALUES (pIdCategoria, pNombre, pDescripcion, pPrecio, pStock, pTalla, pColor, pImagen, 'activo');
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_CambiarEstadoProducto` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_CambiarEstadoProducto`(
    pIdProducto INT
)
BEGIN
    UPDATE productos
    SET    estado = CASE WHEN estado = 'activo' THEN 'inactivo' ELSE 'activo' END
    WHERE  id_producto = pIdProducto;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_CancelarCarrito` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_CancelarCarrito`(
    IN pIdUsuario INT
)
BEGIN
    DECLARE vIdCarrito INT;
 
    SELECT id_carrito INTO vIdCarrito
    FROM   carrito
    WHERE  id_usuario = pIdUsuario
      AND  estado     = 'activo'
    LIMIT  1;
 
    IF vIdCarrito IS NULL THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'No existe un carrito activo para este usuario.';
    END IF;
 
    DELETE FROM carrito_detalle WHERE id_carrito = vIdCarrito;
 
    UPDATE carrito
    SET    estado = 'cancelado'
    WHERE  id_carrito = vIdCarrito;
 
    SELECT vIdCarrito AS id_carrito_cancelado;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultarPedido` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultarPedido`(
    IN pIdPedido INT
)
BEGIN
    SELECT 
        PED.id_pedido, USR.nombre AS Nombre_Cliente, 
        PRO.Nombre AS Nombre_Producto, PRO.Stock,
        PRO.Talla, PRO.Color, DET.Cantidad,
        PED.Fecha_pedido, PED.Direccion, 
        PED.Telefono, PED.Estado,
        PED.Metodo_pago
    FROM pedidos PED
    INNER JOIN usuarios USR 
	ON PED.id_usuario = USR.id_usuario 
    INNER JOIN pedido_detalle DET 
	ON PED.id_pedido = DET.id_pedido
    INNER JOIN productos PRO 
	ON DET.id_producto = PRO.id_producto
    WHERE PED.id_pedido = pIdPedido OR pIdPedido IS NULL;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultarPedidos` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultarPedidos`(
    IN pIdPedido INT
)
BEGIN
    SELECT 
        PRO.Nombre, PRO.Stock, PRO.Talla, PRO.Color,
        DET.Cantidad, PED.Fecha_pedido, PED.Direccion, 
        PED.Telefono, PED.Estado,PED.Metodo_pago
    FROM pedidos PED
    INNER JOIN pedido_detalle DET 
    ON PED.id_pedido = DET.id_pedido
    INNER JOIN productos PRO 
    ON DET.id_producto = PRO.id_producto
    WHERE PED.id_pedido = pIdPedido OR pIdPedido IS NULL;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultarProducto` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultarProducto`(
    pIdProducto INT
)
BEGIN
    SELECT id_producto, id_categoria, nombre, descripcion, precio, stock, talla, color, imagen, estado, en_oferta
    FROM   productos
    WHERE  id_producto = pIdProducto;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultarProductos` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultarProductos`(
)
BEGIN
    SELECT  id_producto,
            id_categoria,
            nombre,
            descripcion,
            precio,
            stock,
            talla,
            color,
            imagen,
            estado,
            en_oferta,
            CASE WHEN estado = 'activo' THEN 'Activo' ELSE 'Inactivo' END AS EstadoDescripcion
    FROM    productos;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultarUsuario` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultarUsuario`(
    pIdUsuario INT
)
BEGIN
    SELECT  id_usuario,
            cedula,
            nombre,
            correo,
            estado,
            id_rol
    FROM    usuarios
    WHERE   id_usuario = pIdUsuario;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_EliminarDelCarrito` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_EliminarDelCarrito`(
    IN pIdDetalle  INT,
    IN pIdUsuario  INT
)
BEGIN
    DELETE cd
    FROM   carrito_detalle cd
    JOIN   carrito         c  ON c.id_carrito = cd.id_carrito
    WHERE  cd.id_detalle = pIdDetalle
      AND  c.id_usuario  = pIdUsuario
      AND  c.estado      = 'activo';
 
    IF ROW_COUNT() = 0 THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'Ítem no encontrado o el carrito no está activo.';
    END IF;
 
    SELECT ROW_COUNT() AS filas_afectadas;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_FinalizarCarrito` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_FinalizarCarrito`(
    IN pIdUsuario     INT,
    IN pDireccion     VARCHAR(200),
    IN pTelefono      VARCHAR(20),
    IN pMetodoPago    VARCHAR(50),
    IN pObservaciones TEXT
)
BEGIN
    DECLARE vIdCarrito  INT;
    DECLARE vTotal      DECIMAL(10,2);
    DECLARE vIdPedido   INT;
    DECLARE vContItems  INT;
 
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        ROLLBACK;
        RESIGNAL;
    END;
 
    START TRANSACTION;
 
    -- Obtener carrito activo
    SELECT id_carrito INTO vIdCarrito
    FROM   carrito
    WHERE  id_usuario = pIdUsuario
      AND  estado     = 'activo'
    LIMIT  1;
 
    IF vIdCarrito IS NULL THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'No existe un carrito activo para este usuario.';
    END IF;
 
    -- Verificar que tenga ítems
    SELECT COUNT(*) INTO vContItems
    FROM   carrito_detalle
    WHERE  id_carrito = vIdCarrito;
 
    IF vContItems = 0 THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'El carrito está vacío.';
    END IF;
 
    -- Calcular total
    SELECT SUM(cantidad * precio_unitario) INTO vTotal
    FROM   carrito_detalle
    WHERE  id_carrito = vIdCarrito;
 
    -- Crear pedido
    INSERT INTO pedidos (id_usuario, direccion, telefono, total, estado, metodo_pago, observaciones)
    VALUES (pIdUsuario, pDireccion, pTelefono, vTotal, 'pendiente', pMetodoPago, pObservaciones);
 
    SET vIdPedido = LAST_INSERT_ID();
 
    -- Copiar ítems al pedido
    INSERT INTO pedido_detalle (id_pedido, id_producto, cantidad, precio_unitario, subtotal)
    SELECT vIdPedido,
           id_producto,
           cantidad,
           precio_unitario,
           (cantidad * precio_unitario)
    FROM   carrito_detalle
    WHERE  id_carrito = vIdCarrito;
 
    -- Descontar stock
    UPDATE productos p
    JOIN   carrito_detalle cd ON cd.id_producto = p.id_producto
    SET    p.stock = p.stock - cd.cantidad
    WHERE  cd.id_carrito = vIdCarrito;
 
    -- Cerrar carrito
    UPDATE carrito
    SET    estado = 'completado'
    WHERE  id_carrito = vIdCarrito;
 
    COMMIT;
 
    SELECT vIdPedido AS id_pedido, vTotal AS total;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_Login` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Login`(
    IN pCorreo VARCHAR(100)
)
BEGIN
    SELECT u.id_usuario, u.nombre, u.correo, u.contrasena, u.id_rol, r.nombre AS nombre_rol
    FROM usuarios u
    INNER JOIN roles r ON u.id_rol = r.id_rol
    WHERE u.correo = pCorreo
    LIMIT 1;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ObtenerCarrito` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ObtenerCarrito`(
    IN pIdUsuario INT
)
BEGIN
    SELECT
        c.id_carrito,
        c.fecha_creacion,
        c.estado                                          AS estado_carrito,
        cd.id_detalle,
        p.id_producto,
        p.nombre                                          AS nombre_producto,
        p.imagen,
        p.talla,
        p.color,
        p.stock                                           AS stock_disponible,
        cd.cantidad,
        cd.precio_unitario,
        (cd.cantidad * cd.precio_unitario)                AS subtotal,
        SUM(cd.cantidad * cd.precio_unitario)
            OVER (PARTITION BY c.id_carrito)              AS total_carrito
    FROM   carrito          c
    JOIN   carrito_detalle  cd ON cd.id_carrito  = c.id_carrito
    JOIN   productos        p  ON p.id_producto  = cd.id_producto
    WHERE  c.id_usuario = pIdUsuario
      AND  c.estado     = 'activo'
    ORDER BY cd.id_detalle;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_Registrar` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Registrar`(
     pNombre VARCHAR(200),
     pCorreoElectronico VARCHAR(100),
     pContrasenna VARCHAR(255),
     pCedula VARCHAR(20)
)
BEGIN
    DECLARE vIdRol INT;
    
    SELECT id_rol INTO vIdRol
    FROM roles
    WHERE nombre = 'cliente'
    LIMIT 1;

    INSERT INTO usuarios(cedula, nombre, correo, contrasena, estado, id_rol)
    VALUES (pCedula, pNombre, pCorreoElectronico, pContrasenna, 'activo', vIdRol);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ToggleOferta` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ToggleOferta`(
    pIdProducto INT
)
BEGIN
    UPDATE productos
    SET    en_oferta = CASE WHEN en_oferta = 1 THEN 0 ELSE 1 END
    WHERE  id_producto = pIdProducto;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_VaciarCarrito` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_VaciarCarrito`(
    IN pIdUsuario INT
)
BEGIN
    DECLARE vIdCarrito INT;
 
    SELECT id_carrito INTO vIdCarrito
    FROM   carrito
    WHERE  id_usuario = pIdUsuario
      AND  estado     = 'activo'
    LIMIT  1;
 
    IF vIdCarrito IS NULL THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'No existe un carrito activo para este usuario.';
    END IF;
 
    DELETE FROM carrito_detalle WHERE id_carrito = vIdCarrito;
 
    SELECT vIdCarrito AS id_carrito, ROW_COUNT() AS items_eliminados;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ValidarCorreo` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ValidarCorreo`(
    pCorreo VARCHAR(100)
)
BEGIN
    SELECT  id_usuario,
            nombre,
      correo,
      contrasena
    FROM    usuarios
    WHERE   correo  = pCorreo
    AND     estado  = 'activo';
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-04-18 14:08:04
