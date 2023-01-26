-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-06-2022 a las 06:45:48
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `market-pos-pruebas21`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `prc_ListarProductos` ()  NO SQL BEGIN
SELECT '' as detalles, 
	p.id,
    p.codigo_producto,
    c.id_categoria,
    c.nombre_categoria,
    p.descripcion_producto,
    ROUND(p.precio_compra_producto, 2) as precio_compra,
    ROUND(p.precio_venta_producto, 2) as precio_venta,
    ROUND(p.utilidad,2) as utilidad,
    case when c.aplica_peso = 1 then concat(p.stock_producto) else concat(p.stock_producto) end as stock,
    
   case when c.aplica_peso = 1 then concat(p.minimo_stock_producto) else concat(p.minimo_stock_producto) end as minimo_stock,
    
  case when c.aplica_peso = 1 then concat(p.ventas_producto) else concat(p.ventas_producto) end as ventas,  
    p.fecha_creacion_producto,
    p.fecha_actualizacion_producto,
    '' as opciones
    
FROM productos p  inner join categorias c on p.id_categoria_producto =  c.id_categoria order by p.id desc; /*el order by p.id desc.. funciona para que en mi tabla aparezca el primer dato de producto ingresado como primero */

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `prc_ListarProductosMasVendidos` ()  NO SQL BEGIN
select p.codigo_producto,
	p.descripcion_producto,
    SUM(vd.cantidad) as cantidad,
    /*Round indica decimales tiene el valor, con 2 */
    sum(Round(vd.total_venta,2)) as total_venta
from venta_detalle vd inner join productos p on vd.codigo_producto = p.codigo_producto
GROUP BY p.codigo_producto, p.descripcion_producto
/*Ordena los productos de forma Desc, descendente */
order by sum(Round(vd.total_venta,2)) DESC
/*como solo necesito 10, indicamos el limite */
limit 10;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `prc_ListarProductosPocoStock` ()  NO SQL BEGIN
select p.codigo_producto,
	p.descripcion_producto,
    p.stock_producto,
    p.minimo_stock_producto
from productos p
WHERE p.stock_producto <= p.minimo_stock_producto
/*ASC indica de forma ascendente */
order by p.stock_producto ASC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `prc_ObtenerDatosDashboard` ()  NO SQL BEGIN
declare totalProductos int;
declare totalCompras float;
declare totalVentas float;
declare ganancias float;
declare productosPocoStock int;
declare ventasHoy float;

SET totalProductos = (SELECT count(*) FROM productos p);
SET totalCompras = (select sum(p.precio_compra_producto*p.stock_producto) from productos p);
set totalVentas = (select sum(vc.total_venta) from venta_cabecera vc where EXTRACT(MONTH FROM vc.fecha_venta) = EXTRACT(MONTH FROM curdate()) and EXTRACT(YEAR FROM vc.fecha_venta) = EXTRACT(YEAR FROM curdate()));
set ganancias = (select sum(vd.total_venta - (p.precio_compra_producto * vd.cantidad)) from venta_detalle vd inner join productos p on vd.codigo_producto = p.codigo_producto
                 where EXTRACT(MONTH FROM vd.fecha_venta) = EXTRACT(MONTH FROM curdate()) and EXTRACT(YEAR FROM vd.fecha_venta) = EXTRACT(YEAR FROM curdate()));
set productosPocoStock = (select count(1) from productos p where p.stock_producto <= p.minimo_stock_producto);
set ventasHoy = (select sum(vc.total_venta) from venta_cabecera vc where vc.fecha_venta = curdate());

SELECT IFNULL(totalProductos,0) AS totalProductos,
	   IFNULL(ROUND(totalCompras,2),0) AS totalCompras,
       IFNULL(ROUND(totalVentas,2),0) AS totalVentas,
       IFNULL(ROUND(ganancias,2),0) AS ganancias,
       IFNULL(productosPocoStock,0) AS productosPocoStock,
       IFNULL(ROUND(ventasHoy,2),0) AS ventasHoy;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `prc_ObtenerVentasMesActual` ()  NO SQL BEGIN 

SELECT vc.fecha_venta,
sum(round(vc.total_venta,2)) as total_venta
FROM venta_cabecera vc
WHERE date(vc.fecha_venta) >= date(last_day(now() - INTERVAL 1 month) + INTERVAL 1 day)
and date(vc.fecha_venta) <= last_day(date(CURRENT_DATE))
GROUP by date(vc.fecha_venta);
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `nombre_categoria` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `aplica_peso` int(11) NOT NULL,
  `fecha_creacion_categoria` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `fecha_actualizacion_categoria` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nombre_categoria`, `aplica_peso`, `fecha_creacion_categoria`, `fecha_actualizacion_categoria`) VALUES
(1, 'Galletas', 0, '2021-10-03 05:00:00', '2021-10-03'),
(2, 'Golosina', 0, '2021-10-03 05:00:00', '2021-10-03'),
(3, 'Wafer', 0, '2021-10-03 05:00:00', '2021-10-03'),
(4, 'Chocolate', 0, '2021-10-03 05:00:00', '2021-10-03'),
(5, 'Atún', 0, '2021-10-03 05:00:00', '2021-10-03'),
(6, 'Papel Higiénico', 0, '2021-10-03 05:00:00', '2021-10-03'),
(7, 'Leche', 0, '2021-10-03 05:00:00', '2021-10-03'),
(8, 'Arroz', 0, '2021-10-03 05:00:00', '2021-10-03'),
(9, 'Yogurt', 0, '2021-10-03 05:00:00', '2021-10-03'),
(10, 'Aceite', 0, '2021-10-03 05:00:00', '2021-10-03'),
(11, 'Gaseosa', 0, '2021-10-03 05:00:00', '2021-10-03'),
(12, 'Mantequilla', 0, '2021-10-03 05:00:00', '2021-10-03'),
(13, 'Refresco', 0, '2021-10-03 05:00:00', '2021-10-03'),
(14, 'Jugo', 0, '2021-10-03 05:00:00', '2021-10-03'),
(15, 'Energizante', 0, '2021-10-03 05:00:00', '2021-10-03'),
(16, 'Avena', 0, '2021-10-03 05:00:00', '2021-10-03'),
(17, 'Snack', 0, '2021-10-03 05:00:00', '2021-10-18'),
(18, 'Verduras', 1, '2021-10-11 03:46:03', '2021-10-18'),
(19, 'Frutas', 1, '2021-10-18 21:38:23', '2021-10-18'),
(20, 'Bazar', 0, '2021-10-18 21:42:56', '2021-10-18'),
(21, 'Cervezas', 0, '2021-10-18 21:51:47', '2021-10-18'),
(22, 'Helados', 0, '2021-10-18 21:54:59', '2021-10-18'),
(23, 'Carnes', 1, '2021-10-18 22:29:03', '2021-10-19'),
(24, 'Embutidos', 0, '2021-10-18 22:43:56', '2021-10-19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `id_empresa` int(11) NOT NULL,
  `razon_social` text NOT NULL,
  `ruc` bigint(20) NOT NULL,
  `direccion` text NOT NULL,
  `marca` text NOT NULL,
  `serie_boleta` varchar(4) NOT NULL,
  `nro_correlativo_venta` varchar(8) NOT NULL,
  `email` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`id_empresa`, `razon_social`, `ruc`, `direccion`, `marca`, `serie_boleta`, `nro_correlativo_venta`, `email`) VALUES
(1, 'Maga & Tito Market', 10467291241, 'Avenida Brasil 1347 - Jesus María', 'Maga & Tito Market', '0002', '00000024', 'magaytito@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `codigo_producto` bigint(13) NOT NULL,
  `id_categoria_producto` int(11) DEFAULT NULL,
  `descripcion_producto` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `precio_compra_producto` float NOT NULL,
  `precio_venta_producto` float NOT NULL,
  `utilidad` float NOT NULL,
  `stock_producto` float DEFAULT NULL,
  `minimo_stock_producto` float DEFAULT NULL,
  `ventas_producto` float DEFAULT NULL,
  `fecha_creacion_producto` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `fecha_actualizacion_producto` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `codigo_producto`, `id_categoria_producto`, `descripcion_producto`, `precio_compra_producto`, `precio_venta_producto`, `utilidad`, `stock_producto`, `minimo_stock_producto`, `ventas_producto`, `fecha_creacion_producto`, `fecha_actualizacion_producto`) VALUES
(1, 7755139002809, 8, 'Paisana extra 5k', 18.29, 20, 1.71, 2, 0, 4, '2021-10-24 22:27:45', '0000-00-00'),
(2, 7751271027656, 9, 'Gloria Fresa 500ml', 3.79, 5, 1.21, 6, 3, 0, '0000-00-00 00:00:00', '0000-00-00'),
(3, 7751271021999, 7, 'Gloria evaporada ligth 400g', 3.4, 5, 1.6, 24, 12, 0, '0000-00-00 00:00:00', '0000-00-00'),
(4, 7750106003094, 1, 'soda san jorge 40g', 0.5, 0.8, 0.3, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00'),
(5, 7622300279783, 1, 'vainilla field 37g', 0.33, 0.5, 0.17, 24, 10, 0, '0000-00-00 00:00:00', '0000-00-00'),
(6, 7750243053037, 1, 'Margarita', 0.53, 0.6, 0.07, 12, 6, 0, '0000-00-00 00:00:00', '0000-00-00'),
(7, 7622300513917, 1, 'soda field 34g', 0.37, 0.6, 0.23, 18, 5, 0, '0000-00-00 00:00:00', '0000-00-00'),
(8, 7622300116521, 1, 'ritz original', 0.43, 0.7, 0.27, 24, 10, 0, '0000-00-00 00:00:00', '0000-00-00'),
(9, 7622300124526, 1, 'ritz queso 34g', 0.68, 0.8, 0.12, 18, 5, 0, '0000-00-00 00:00:00', '0000-00-00'),
(10, 7750243166201, 1, 'Chocobum', 0.62, 0.8, 0.18, 18, 9, 0, '0000-00-00 00:00:00', '0000-00-00'),
(11, 7752748005924, 1, 'Picaras', 0.6, 0.8, 0.2, 24, 12, 0, '0000-00-00 00:00:00', '0000-00-00'),
(12, 7590011251100, 1, 'oreo original 36g', 0.57, 0.8, 0.23, 30, 10, 0, '0000-00-00 00:00:00', '0000-00-00'),
(13, 7590011205158, 1, 'club social 26g', 0.53, 0.8, 0.27, 36, 10, 0, '0000-00-00 00:00:00', '0000-00-00'),
(14, 7750885012928, 1, 'frac vanilla 45.5g', 0.52, 0.8, 0.28, 18, 5, 0, '0000-00-00 00:00:00', '0000-00-00'),
(15, 7750885012881, 1, 'frac chocolate 45.5g', 0.52, 0.8, 0.28, 18, 5, 0, '0000-00-00 00:00:00', '0000-00-00'),
(16, 7750885012904, 1, 'frac chasica 45.5g', 0.52, 0.8, 0.28, 18, 5, 0, '0000-00-00 00:00:00', '0000-00-00'),
(17, 7750885016483, 3, 'tuyo 22g', 0.5, 0.8, 0.3, 20, 5, 0, '0000-00-00 00:00:00', '0000-00-00'),
(18, 7750106002608, 1, 'gn rellenitas 36g chocolate', 0.47, 0.8, 0.33, 18, 5, 0, '0000-00-00 00:00:00', '0000-00-00'),
(19, 7750106002592, 1, 'gn rellenitas 36g coco', 0.47, 0.8, 0.33, 18, 5, 0, '0000-00-00 00:00:00', '0000-00-00'),
(20, 7750106002615, 1, 'gn rellenitas 36g coco', 0.47, 0.8, 0.33, 18, 5, 0, '0000-00-00 00:00:00', '0000-00-00'),
(21, 7750885010269, 4, 'cancun', 0.75, 0.9, 0.15, 24, 10, 0, '0000-00-00 00:00:00', '0000-00-00'),
(22, 7750670014250, 11, 'Big cola 400ml', 1, 1, 0, 15, 10, 0, '0000-00-00 00:00:00', '0000-00-00'),
(23, 7802800716821, 13, 'Zuko Piña', 0.9, 1, 0.1, 12, 6, 0, '0000-00-00 00:00:00', '0000-00-00'),
(24, 7802800716838, 13, 'Zuko Durazno', 0.9, 1, 0.1, 12, 6, 0, '0000-00-00 00:00:00', '0000-00-00'),
(25, 7752748010423, 2, 'chin chin 32g', 0.88, 1, 0.12, 16, 5, 0, '0000-00-00 00:00:00', '0000-00-00'),
(26, 7613035963948, 1, 'Morocha 30g', 0.85, 1, 0.15, 24, 12, 0, '0000-00-00 00:00:00', '0000-00-00'),
(27, 7802800716777, 13, 'Zuko Emoliente', 0.67, 1, 0.33, 12, 6, 0, '0000-00-00 00:00:00', '0000-00-00'),
(28, 7750885016469, 1, 'Choco donuts', 0.56, 1, 0.44, 18, 9, 0, '0000-00-00 00:00:00', '0000-00-00'),
(29, 7751580000715, 11, 'Pepsi 355ml', 1.5, 1.2, -0.3, 15, 10, 0, '0000-00-00 00:00:00', '0000-00-00'),
(30, 7758574003202, 16, 'Quaker 120gr', 1.29, 1.2, -0.09, 6, 3, 0, '0000-00-00 00:00:00', '0000-00-00'),
(31, 7750670011839, 14, 'Pulp Durazno 315ml', 1, 1.2, 0.2, 6, 3, 0, '0000-00-00 00:00:00', '0000-00-00'),
(32, 7613036679312, 3, 'morochas wafer 37g', 1, 1.2, 0.2, 12, 5, 0, '0000-00-00 00:00:00', '0000-00-00'),
(33, 7613034978059, 1, 'Wafer sublime', 0.92, 1.2, 0.28, 24, 12, 0, '0000-00-00 00:00:00', '0000-00-00'),
(34, 7622300117207, 1, 'hony bran 33g', 0.9, 1.2, 0.3, 18, 5, 0, '0000-00-00 00:00:00', '0000-00-00'),
(35, 7613035049628, 1, 'Sublime clásico', 1.06, 1.3, 0.24, 24, 12, 0, '0000-00-00 00:00:00', '0000-00-00'),
(36, 7751271029186, 9, 'Gloria fresa 180ml', 1.5, 1.5, 0, 24, 12, 0, '0000-00-00 00:00:00', '0000-00-00'),
(37, 7751271029209, 9, 'Gloria durazno 180ml', 1.5, 1.5, 0, 24, 12, 0, '0000-00-00 00:00:00', '0000-00-00'),
(38, 7751271012348, 9, 'Frutado fresa vasito', 1.39, 1.5, 0.11, 12, 6, 0, '0000-00-00 00:00:00', '0000-00-00'),
(39, 7751271012355, 9, 'Frutado durazno vasito', 1.39, 1.5, 0.11, 12, 6, 0, '0000-00-00 00:00:00', '0000-00-00'),
(40, 7750885006460, 16, '3 ositos quinua', 1.9, 1.8, -0.1, 6, 3, 0, '0000-00-00 00:00:00', '0000-00-00'),
(41, 7751912148467, 11, 'Seven Up 500ml', 1.8, 1.8, 0, 20, 10, 0, '0000-00-00 00:00:00', '0000-00-00'),
(42, 7750182002363, 11, 'Fanta Kola Inglesa 500ml', 1.39, 1.8, 0.41, 7, 6, 5, '2021-10-24 22:27:16', '0000-00-00'),
(43, 7750182220378, 11, 'Fanta Naranja 500ml', 1.39, 1.8, 0.41, 12, 6, 0, '0000-00-00 00:00:00', '0000-00-00'),
(44, 7759185001977, 6, 'Noble pq 2 unid', 1.3, 1.8, 0.5, 10, 6, 0, '0000-00-00 00:00:00', '0000-00-00'),
(45, 7751493000154, 6, 'Suave pq 2 unid', 1.99, 2, 0.01, 10, 6, 0, '0000-00-00 00:00:00', '0000-00-00'),
(46, 7751580000364, 11, 'Pepsi 750ml', 2.8, 2.5, -0.3, 12, 6, 0, '0000-00-00 00:00:00', '0000-00-00'),
(47, 7750182006095, 11, 'Coca cola 600ml', 2.6, 2.5, -0.1, 12, 6, 0, '0000-00-00 00:00:00', '0000-00-00'),
(48, 7750182006088, 11, 'Inca Kola 600ml', 2.6, 2.5, -0.1, 12, 6, 0, '0000-00-00 00:00:00', '0000-00-00'),
(49, 7759185000642, 6, 'Elite Megarrollo', 2.19, 2.8, 0.61, 12, 6, 0, '0000-00-00 00:00:00', '0000-00-00'),
(50, 7751271029155, 7, 'Pura vida 395g', 2.6, 2.9, 0.3, 24, 12, 0, '0000-00-00 00:00:00', '0000-00-00'),
(51, 7613036552806, 7, 'Ideal cremosita 395g', 3, 3.2, 0.2, 24, 12, 0, '0000-00-00 00:00:00', '0000-00-00'),
(52, 7613036552837, 7, 'Ideal Light 395g', 2.8, 3.2, 0.4, 24, 12, 0, '0000-00-00 00:00:00', '0000-00-00'),
(53, 7750151005548, 9, 'Fresa 370ml Laive', 2.19, 3.2, 1.01, 12, 6, 0, '0000-00-00 00:00:00', '0000-00-00'),
(54, 7751271021975, 7, 'Gloria evaporada entera ', 3.2, 3.3, 0.1, 24, 12, 0, '0000-00-00 00:00:00', '0000-00-00'),
(55, 7750151007214, 7, 'Laive Ligth caja 480ml', 2.8, 3.3, 0.5, 6, 3, 0, '0000-00-00 00:00:00', '0000-00-00'),
(56, 7751580000807, 11, 'Pepsi 1.5L', 4.4, 3.5, -0.9, 6, 3, 0, '0000-00-00 00:00:00', '0000-00-00'),
(57, 7751271027663, 9, 'Gloria durazno 500ml', 3.79, 3.5, -0.29, 6, 3, 0, '0000-00-00 00:00:00', '0000-00-00'),
(58, 7751271027670, 9, 'Gloria Vainilla Francesa 500ml', 3.79, 3.5, -0.29, 6, 3, 0, '0000-00-00 00:00:00', '0000-00-00'),
(59, 7751271017367, 9, 'Griego gloria', 3.65, 3.5, -0.15, 6, 3, 0, '0000-00-00 00:00:00', '0000-00-00'),
(60, 7750670000185, 11, 'Sabor Oro 1.7L', 3.5, 3.5, 0, 6, 3, 0, '0000-00-00 00:00:00', '0000-00-00'),
(61, 7501006559019, 7, 'Canchita mantequilla ', 3.25, 3.5, 0.25, 5, 3, 1, '2021-10-24 22:27:45', '0000-00-00'),
(62, 7501006559002, 7, 'Canchita natural', 3.25, 3.5, 0.25, 3, 2, 0, '0000-00-00 00:00:00', '0000-00-00'),
(63, 7750151007221, 7, 'Laive sin lactosa caja 480ml', 3.17, 3.5, 0.33, 6, 3, 0, '0000-00-00 00:00:00', '0000-00-00'),
(64, 7754725000281, 8, 'Valle Norte 750g', 3.1, 3.5, 0.4, 6, 5, 4, '2021-10-19 02:27:17', '0000-00-00'),
(65, 7751271012263, 9, 'Battimix', 2.89, 3.5, 0.61, 24, 12, 0, '0000-00-00 00:00:00', '0000-00-00'),
(66, 38000846731, 7, 'Pringles papas', 2.8, 3.5, 0.7, 12, 6, 0, '0000-00-00 00:00:00', '0000-00-00'),
(67, 7755139161759, 8, 'Costeño 750g', 3.69, 4.2, 0.51, 20, 10, 0, '0000-00-00 00:00:00', '0000-00-00'),
(68, 7758950000900, 8, 'Faraon amarillo 1k', 3.39, 4.2, 0.81, 10, 5, 0, '0000-00-00 00:00:00', '0000-00-00'),
(69, 7759450000209, 5, 'A1 Trozos ', 5.17, 4.9, -0.27, 6, 3, 0, '0000-00-00 00:00:00', '0000-00-00'),
(70, 7759185004800, 6, 'Nova pq 2 unid', 3.99, 4.9, 0.91, 6, 2, 0, '0000-00-00 00:00:00', '0000-00-00'),
(71, 7751493009928, 6, 'Suave pq 4 unid', 4.58, 5, 0.42, 6, 3, 0, '0000-00-00 00:00:00', '0000-00-00'),
(72, 7751158010443, 5, 'Florida Trozos ', 5.15, 5.5, 0.35, 6, 3, 0, '0000-00-00 00:00:00', '0000-00-00'),
(73, 7750518000711, 6, 'Paracas pq 4 unid', 5, 5.5, 0.5, 6, 3, 0, '0000-00-00 00:00:00', '0000-00-00'),
(74, 7750408001675, 5, 'Trozos de atún Campomar', 4.66, 5.5, 0.84, 6, 3, 0, '0000-00-00 00:00:00', '0000-00-00'),
(75, 7759450112780, 5, 'A1 Filete', 4.65, 5.5, 0.85, 6, 3, 0, '0000-00-00 00:00:00', '0000-00-00'),
(76, 7862100603030, 5, 'Real Trozos', 4.63, 5.5, 0.87, 6, 3, 0, '0000-00-00 00:00:00', '0000-00-00'),
(77, 7750151111959, 9, 'Durazno 1L laive', 5.7, 5.7, 0, 6, 3, 0, '0000-00-00 00:00:00', '0000-00-00'),
(78, 7750151111942, 9, 'Fresa 1L Laive', 5.7, 5.7, 0, 6, 3, 0, '0000-00-00 00:00:00', '0000-00-00'),
(79, 7759450002333, 5, 'A1 Filete Ligth', 6.08, 5.8, -0.28, 6, 3, 0, '0000-00-00 00:00:00', '0000-00-00'),
(80, 7751271027557, 9, 'Lúcuma 1L Gloria', 5.9, 5.9, 0, 6, 3, 0, '0000-00-00 00:00:00', '0000-00-00'),
(81, 7751271027526, 9, 'Fresa 1L Gloria', 5.9, 5.9, 0, 6, 3, 0, '0000-00-00 00:00:00', '0000-00-00'),
(82, 7751271013734, 9, 'Milkito fresa 1L', 5.9, 5.9, 0, 3, 1, 0, '0000-00-00 00:00:00', '0000-00-00'),
(83, 7751271027557, 9, 'Gloria Durazno 1L', 5.9, 5.9, 0, 6, 3, 0, '0000-00-00 00:00:00', '0000-00-00'),
(84, 7750408076161, 5, 'Filete de atún Campomar', 5.08, 5.9, 0.82, 6, 3, 0, '0000-00-00 00:00:00', '0000-00-00'),
(85, 7751158010603, 5, 'Florida Filete Ligth', 5.63, 6, 0.37, 6, 3, 0, '0000-00-00 00:00:00', '0000-00-00'),
(86, 7751158000437, 5, 'Filete de atún Florida ', 5.4, 6, 0.6, 12, 5, 0, '0000-00-00 00:00:00', '0000-00-00'),
(87, 7750236330169, 11, 'Inca Kola 1.5L', 5.9, 6.5, 0.6, 6, 3, 0, '0000-00-00 00:00:00', '0000-00-00'),
(88, 7750182155663, 11, 'Coca Cola 1.5L', 5.9, 6.5, 0.6, 6, 3, 0, '0000-00-00 00:00:00', '0000-00-00'),
(89, 9002490100070, 15, 'Red Bull 250ml', 5.33, 6.9, 1.57, 6, 3, 0, '0000-00-00 00:00:00', '0000-00-00'),
(90, 7750182000222, 11, 'Sprite 3L', 7.49, 7.5, 0.01, 4, 2, 0, '0000-00-00 00:00:00', '0000-00-00'),
(91, 7751580000968, 11, 'Pepsi 3L', 8, 8, 0, 4, 2, 0, '0000-00-00 00:00:00', '0000-00-00'),
(92, 7750151003902, 12, 'Laive 200gr', 8.9, 8.8, -0.1, 6, 3, 0, '0000-00-00 00:00:00', '0000-00-00'),
(93, 7751271011150, 12, 'Gloria Pote con sal', 9.19, 9.2, 0.01, 3, 2, 0, '0000-00-00 00:00:00', '0000-00-00'),
(94, 7759222002097, 10, 'Deleite 1L', 9.8, 9.5, -0.3, 3, 2, 1, '2021-10-19 02:29:41', '0000-00-00'),
(95, 7750243064095, 10, 'Sao 1L', 12.1, 12.1, 0, 3, 1, 0, '0000-00-00 00:00:00', '0000-00-00'),
(96, 7750243042338, 10, 'Cocinero 1L', 12.4, 12.4, 0, 3, 1, 0, '0000-00-00 00:00:00', '0000-00-00'),
(97, 7750243042949, 10, 'Primor 1L', 11.79, 12.5, 0.71, 3, 1, 0, '0000-00-00 00:00:00', '0000-00-00'),
(98, 10001, 4, 'alfajor', 1.5, 2.3, 0.8, 15, 5, 5, '2021-10-24 22:27:45', NULL),
(99, 10002, 19, 'Manzana', 3, 5, 2, 4.75, 2, 0.25, '2021-10-19 02:32:55', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta_cabecera`
--

CREATE TABLE `venta_cabecera` (
  `id_boleta` int(11) NOT NULL,
  `nro_boleta` varchar(8) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `subtotal` float NOT NULL,
  `igv` float NOT NULL,
  `total_venta` float DEFAULT NULL,
  `fecha_venta` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `venta_cabecera`
--

INSERT INTO `venta_cabecera` (`id_boleta`, `nro_boleta`, `descripcion`, `subtotal`, `igv`, `total_venta`, `fecha_venta`) VALUES
(46, '00000014', 'Venta realizada con Nro Boleta: 00000014', 0, 0, 69, '2021-10-18 21:54:10'),
(47, '00000015', 'Venta realizada con Nro Boleta: 00000015', 0, 0, 17.5, '2022-06-01 22:34:17'),
(48, '00000016', 'Venta realizada con Nro Boleta: 00000016', 0, 0, 16.2, '2021-10-18 22:34:51'),
(49, '00000017', 'Venta realizada con Nro Boleta: 00000017', 0, 0, 5, '2021-10-18 23:01:17'),
(50, '00000018', 'Venta realizada con Nro Boleta: 00000018', 0, 0, 1.8, '2021-10-18 23:56:24'),
(51, '00000019', 'Venta realizada con Nro Boleta: 00000019', 0, 0, 21.2, '2021-10-19 02:27:17'),
(52, '00000020', 'Venta realizada con Nro Boleta: 00000020', 0, 0, 29.5, '2021-10-19 02:29:41'),
(53, '00000021', 'Venta realizada con Nro Boleta: 00000021', 0, 0, 9.2, '2021-10-19 02:31:19'),
(54, '00000022', 'Venta realizada con Nro Boleta: 00000022', 0, 0, 1.25, '2021-10-19 02:32:55'),
(55, '00000023', 'Venta realizada con Nro Boleta: 00000023', 0, 0, 1.8, '2021-10-24 22:27:16'),
(56, '00000024', 'Venta realizada con Nro Boleta: 00000024', 0, 0, 65.8, '2021-10-24 22:27:45');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta_detalle`
--

CREATE TABLE `venta_detalle` (
  `id` int(11) NOT NULL,
  `nro_boleta` varchar(8) COLLATE utf8_spanish_ci NOT NULL,
  `codigo_producto` bigint(20) NOT NULL,
  `cantidad` float NOT NULL,
  `total_venta` float NOT NULL,
  `fecha_venta` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `venta_detalle`
--

INSERT INTO `venta_detalle` (`id`, `nro_boleta`, `codigo_producto`, `cantidad`, `total_venta`, `fecha_venta`) VALUES
(521, '00000014', 7755139002809, 3, 69, '2021-10-18 21:54:10'),
(522, '00000015', 7754725000281, 5, 17.5, '2021-10-18 22:34:17'),
(523, '00000016', 7751271021975, 1, 3.3, '2021-10-18 22:34:51'),
(524, '00000016', 7750182006088, 1, 2.5, '2021-10-18 22:34:51'),
(525, '00000016', 7750151003902, 1, 8.8, '2021-10-18 22:34:51'),
(526, '00000016', 7750885012928, 1, 0.8, '2021-10-18 22:34:51'),
(527, '00000016', 7750106002608, 1, 0.8, '2021-10-18 22:34:51'),
(528, '00000017', 7751271027656, 1, 5, '2021-10-18 23:01:17'),
(529, '00000018', 7750182002363, 1, 1.8, '2021-10-18 23:56:24'),
(530, '00000019', 7754725000281, 4, 14, '2021-10-19 02:27:17'),
(531, '00000019', 7750182002363, 4, 7.2, '2021-10-19 02:27:17'),
(532, '00000020', 7759222002097, 1, 9.5, '2021-10-19 02:29:41'),
(533, '00000020', 7755139002809, 1, 20, '2021-10-19 02:29:41'),
(534, '00000021', 10001, 4, 9.2, '2021-10-19 02:31:19'),
(535, '00000022', 10002, 0.25, 1.25, '2021-10-19 02:32:55'),
(536, '00000014', 7755139002809, 3, 69, '2021-10-02 02:54:10'),
(537, '00000015', 7754725000281, 5, 17.5, '2021-10-02 03:34:17'),
(538, '00000016', 7751271021975, 1, 3.3, '2021-10-02 03:34:51'),
(539, '00000016', 7750182006088, 1, 2.5, '2021-10-02 03:34:51'),
(540, '00000016', 7750151003902, 1, 8.8, '2021-10-02 03:34:51'),
(541, '00000016', 7750885012928, 1, 0.8, '2021-10-02 03:34:51'),
(542, '00000016', 7750106002608, 1, 0.8, '2021-10-02 03:34:51'),
(543, '00000017', 7751271027656, 1, 5, '2021-10-02 04:01:17'),
(544, '00000018', 7750182002363, 1, 1.8, '2021-10-02 04:56:24'),
(545, '00000019', 7754725000281, 4, 14, '2021-10-01 07:27:17'),
(546, '00000019', 7750182002363, 4, 7.2, '2021-10-01 07:27:17'),
(547, '00000020', 7759222002097, 1, 9.5, '2021-10-01 07:29:41'),
(548, '00000020', 7755139002809, 1, 20, '2021-10-01 07:29:41'),
(549, '00000021', 10001, 4, 9.2, '2021-10-01 07:31:19'),
(550, '00000022', 10002, 0.25, 1.25, '2021-10-01 07:32:55'),
(551, '00000014', 7755139002809, 3, 69, '2021-10-03 02:54:10'),
(552, '00000015', 7754725000281, 5, 17.5, '2021-10-03 03:34:17'),
(553, '00000016', 7751271021975, 1, 3.3, '2021-10-03 03:34:51'),
(554, '00000016', 7750182006088, 1, 2.5, '2021-10-03 03:34:51'),
(555, '00000016', 7750151003902, 1, 8.8, '2021-10-03 03:34:51'),
(556, '00000016', 7750885012928, 1, 0.8, '2021-10-03 03:34:51'),
(557, '00000016', 7750106002608, 1, 0.8, '2021-10-03 03:34:51'),
(558, '00000017', 7751271027656, 1, 5, '2021-10-03 04:01:17'),
(559, '00000018', 7750182002363, 1, 1.8, '2021-10-03 04:56:24'),
(560, '00000019', 7754725000281, 4, 14, '2021-10-02 07:27:17'),
(561, '00000019', 7750182002363, 4, 7.2, '2021-10-02 07:27:17'),
(562, '00000020', 7759222002097, 1, 9.5, '2021-10-02 07:29:41'),
(563, '00000020', 7755139002809, 1, 20, '2021-10-02 07:29:41'),
(564, '00000021', 10001, 4, 9.2, '2021-10-02 07:31:19'),
(565, '00000022', 10002, 0.25, 1.25, '2021-10-02 07:32:55'),
(566, '00000014', 7755139002809, 3, 69, '2021-10-04 02:54:10'),
(567, '00000015', 7754725000281, 5, 17.5, '2021-10-04 03:34:17'),
(568, '00000016', 7751271021975, 1, 3.3, '2021-10-04 03:34:51'),
(569, '00000016', 7750182006088, 1, 2.5, '2021-10-04 03:34:51'),
(570, '00000016', 7750151003902, 1, 8.8, '2021-10-04 03:34:51'),
(571, '00000016', 7750885012928, 1, 0.8, '2021-10-04 03:34:51'),
(572, '00000016', 7750106002608, 1, 0.8, '2021-10-04 03:34:51'),
(573, '00000017', 7751271027656, 1, 5, '2021-10-04 04:01:17'),
(574, '00000018', 7750182002363, 1, 1.8, '2021-10-04 04:56:24'),
(575, '00000019', 7754725000281, 4, 14, '2021-10-03 07:27:17'),
(576, '00000019', 7750182002363, 4, 7.2, '2021-10-03 07:27:17'),
(577, '00000020', 7759222002097, 1, 9.5, '2021-10-03 07:29:41'),
(578, '00000020', 7755139002809, 1, 20, '2021-10-03 07:29:41'),
(579, '00000021', 10001, 4, 9.2, '2021-10-03 07:31:19'),
(580, '00000022', 10002, 0.25, 1.25, '2021-10-03 07:32:55'),
(581, '00000014', 7755139002809, 3, 69, '2021-10-05 02:54:10'),
(582, '00000015', 7754725000281, 5, 17.5, '2021-10-05 03:34:17'),
(583, '00000016', 7751271021975, 1, 3.3, '2021-10-05 03:34:51'),
(584, '00000016', 7750182006088, 1, 2.5, '2021-10-05 03:34:51'),
(585, '00000016', 7750151003902, 1, 8.8, '2021-10-05 03:34:51'),
(586, '00000016', 7750885012928, 1, 0.8, '2021-10-05 03:34:51'),
(587, '00000016', 7750106002608, 1, 0.8, '2021-10-05 03:34:51'),
(588, '00000017', 7751271027656, 1, 5, '2021-10-05 04:01:17'),
(589, '00000018', 7750182002363, 1, 1.8, '2021-10-05 04:56:24'),
(590, '00000019', 7754725000281, 4, 14, '2021-10-04 07:27:17'),
(591, '00000019', 7750182002363, 4, 7.2, '2021-10-04 07:27:17'),
(592, '00000020', 7759222002097, 1, 9.5, '2021-10-04 07:29:41'),
(593, '00000020', 7755139002809, 1, 20, '2021-10-04 07:29:41'),
(594, '00000021', 10001, 4, 9.2, '2021-10-04 07:31:19'),
(595, '00000022', 10002, 0.25, 1.25, '2021-10-04 07:32:55'),
(596, '00000014', 7755139002809, 3, 69, '2021-10-06 02:54:10'),
(597, '00000015', 7754725000281, 5, 17.5, '2021-10-06 03:34:17'),
(598, '00000016', 7751271021975, 1, 3.3, '2021-10-06 03:34:51'),
(599, '00000016', 7750182006088, 1, 2.5, '2021-10-06 03:34:51'),
(600, '00000016', 7750151003902, 1, 8.8, '2021-10-06 03:34:51'),
(601, '00000016', 7750885012928, 1, 0.8, '2021-10-06 03:34:51'),
(602, '00000016', 7750106002608, 1, 0.8, '2021-10-06 03:34:51'),
(603, '00000017', 7751271027656, 1, 5, '2021-10-06 04:01:17'),
(604, '00000018', 7750182002363, 1, 1.8, '2021-10-06 04:56:24'),
(605, '00000019', 7754725000281, 4, 14, '2021-10-05 07:27:17'),
(606, '00000019', 7750182002363, 4, 7.2, '2021-10-05 07:27:17'),
(607, '00000020', 7759222002097, 1, 9.5, '2021-10-05 07:29:41'),
(608, '00000020', 7755139002809, 1, 20, '2021-10-05 07:29:41'),
(609, '00000021', 10001, 4, 9.2, '2021-10-05 07:31:19'),
(610, '00000022', 10002, 0.25, 1.25, '2021-10-05 07:32:55'),
(611, '00000014', 7755139002809, 3, 69, '2021-10-07 02:54:10'),
(612, '00000015', 7754725000281, 5, 17.5, '2021-10-07 03:34:17'),
(613, '00000016', 7751271021975, 1, 3.3, '2021-10-07 03:34:51'),
(614, '00000016', 7750182006088, 1, 2.5, '2021-10-07 03:34:51'),
(615, '00000016', 7750151003902, 1, 8.8, '2021-10-07 03:34:51'),
(616, '00000016', 7750885012928, 1, 0.8, '2021-10-07 03:34:51'),
(617, '00000016', 7750106002608, 1, 0.8, '2021-10-07 03:34:51'),
(618, '00000017', 7751271027656, 1, 5, '2021-10-07 04:01:17'),
(619, '00000018', 7750182002363, 1, 1.8, '2021-10-07 04:56:24'),
(620, '00000019', 7754725000281, 4, 14, '2021-10-06 07:27:17'),
(621, '00000019', 7750182002363, 4, 7.2, '2021-10-06 07:27:17'),
(622, '00000020', 7759222002097, 1, 9.5, '2021-10-06 07:29:41'),
(623, '00000020', 7755139002809, 1, 20, '2021-10-06 07:29:41'),
(624, '00000021', 10001, 4, 9.2, '2021-10-06 07:31:19'),
(625, '00000022', 10002, 0.25, 1.25, '2021-10-06 07:32:55'),
(626, '00000014', 7755139002809, 3, 69, '2021-10-08 02:54:10'),
(627, '00000015', 7754725000281, 5, 17.5, '2021-10-08 03:34:17'),
(628, '00000016', 7751271021975, 1, 3.3, '2021-10-08 03:34:51'),
(629, '00000016', 7750182006088, 1, 2.5, '2021-10-08 03:34:51'),
(630, '00000016', 7750151003902, 1, 8.8, '2021-10-08 03:34:51'),
(631, '00000016', 7750885012928, 1, 0.8, '2021-10-08 03:34:51'),
(632, '00000016', 7750106002608, 1, 0.8, '2021-10-08 03:34:51'),
(633, '00000017', 7751271027656, 1, 5, '2021-10-08 04:01:17'),
(634, '00000018', 7750182002363, 1, 1.8, '2021-10-08 04:56:24'),
(635, '00000019', 7754725000281, 4, 14, '2021-10-07 07:27:17'),
(636, '00000019', 7750182002363, 4, 7.2, '2021-10-07 07:27:17'),
(637, '00000020', 7759222002097, 1, 9.5, '2021-10-07 07:29:41'),
(638, '00000020', 7755139002809, 1, 20, '2021-10-07 07:29:41'),
(639, '00000021', 10001, 4, 9.2, '2021-10-07 07:31:19'),
(640, '00000022', 10002, 0.25, 1.25, '2021-10-07 07:32:55'),
(641, '00000023', 7750182002363, 1, 1.8, '2021-10-24 22:27:16'),
(642, '00000024', 10001, 1, 2.3, '2021-10-24 22:27:45'),
(643, '00000024', 7501006559019, 1, 3.5, '2021-10-24 22:27:45'),
(644, '00000024', 7755139002809, 3, 60, '2021-10-24 22:27:45');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id_empresa`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`,`codigo_producto`);

--
-- Indices de la tabla `venta_cabecera`
--
ALTER TABLE `venta_cabecera`
  ADD PRIMARY KEY (`id_boleta`);

--
-- Indices de la tabla `venta_detalle`
--
ALTER TABLE `venta_detalle`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id_empresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT de la tabla `venta_cabecera`
--
ALTER TABLE `venta_cabecera`
  MODIFY `id_boleta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT de la tabla `venta_detalle`
--
ALTER TABLE `venta_detalle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=645;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
