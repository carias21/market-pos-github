-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-06-2023 a las 20:38:48
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `market-pos-github`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `prc_GananciaBruta` ()   select Tbl.*, T3.gananciaBruta
from
(
select fecha,  IFNULL(ventas, 0)as ventas,IFNULL(compras, 0)as compras
from (select monthname(v.fecha_venta) as fecha, sum(round(v.total_venta,2)) as ventas 
      from ventas v 
      where year(v.fecha_venta)= year(now()) 
      group by month(v.fecha_venta)desc ) t1  
left join (select monthname(c.fecha_compra ) as fecha_compra, sum(round(c.total_compra,2)) as compras
           from compras c 
           group by month(c.fecha_compra)desc) t2 on t1.fecha = t2.fecha_compra
) Tbl
left join
(select monthname(v.fecha_venta) as fecha, round(sum(v.cantidad * v.precio_venta - v.precio_compra), 2) as gananciaBruta 
 from ventas v 
 where year(v.fecha_venta) = year(now()) 
 group by month(v.fecha_venta) desc) as T3 on Tbl.fecha = T3.fecha$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `prc_GananciaNeta` ()   select Tbl.*,Tbl.ventas- Tbl.compras AS gananciaNeta
from
(
select fecha,  IFNULL(ventas, 0)as ventas,IFNULL(compras, 0)as compras



FROM (select MONTHNAME(v.fecha_venta) as fecha, SUM(round(v.total_venta,2)) as VENTAS 
      FROM ventas v 
      WHERE YEAR(v.fecha_venta)= YEAR(NOW()) 
GROUP BY MONTH(v.fecha_venta)DESC ) T1  
LEFT JOIN (select MONTHNAME(c.fecha_compra ) as fecha_compra, SUM(round(c.total_compra,2)) as COMPRAS
           FROM compras c 
           GROUP BY MONTH(c.fecha_compra)DESC) T2 ON T1.fecha =T2.fecha_compra
    
) Tbl$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `prc_ListadoProductosVendidos` ()   BEGIN
select p.codigo_producto,
	p.descripcion_producto,
    SUM(vd.cantidad) as cantidad,
    /*Round indica decimales tiene el valor, con 2 */
    sum(Round(vd.total_venta,2)) as total_venta
from ventas vd inner join productos p on vd.codigo_producto = p.codigo_producto
GROUP BY p.codigo_producto, p.descripcion_producto
/*Ordena los productos de forma Desc, descendente */
order by sum(Round(vd.cantidad)) DESC
/*como solo necesito 10, indicamos el limite */
limit 30;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `prc_ListarProductos` ()  NO SQL BEGIN
SELECT '' as detalles, 
	p.id,
    p.codigo_producto,
    c.id_categoria,
    c.nombre_categoria,
    p.descripcion_producto,
    ROUND(p.precio_compra_producto, 2) as precio_compra,
    ROUND(p.precio_venta_producto, 2) as precio_venta,
    ROUND( p.precio_venta_producto - p.precio_compra_producto,2) as utilidad,
    case when c.aplica_peso = 1 then concat(p.stock_producto) else concat(p.stock_producto) end as stock,
    
   case when c.aplica_peso = 1 then concat(p.minimo_stock_producto) else concat(p.minimo_stock_producto) end as minimo_stock,
    
  case when c.aplica_peso = 1 then concat(p.ventas_producto) else concat(p.ventas_producto) end as ventas,  
    p.fecha_creacion_producto,
    p.fecha_actualizacion_producto,
       p.foto,
    '' as opciones
    
FROM productos p  inner join categorias c on p.id_categoria_producto =  c.id_categoria order by p.id desc; /*el order by p.id desc.. funciona para que en mi tabla aparezca el primer dato de producto ingresado como primero */

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `prc_ListarProductosMasVendidos` ()  NO SQL BEGIN
select p.codigo_producto,
	p.descripcion_producto,
    SUM(vd.cantidad) as cantidad,
    /*Round indica decimales tiene el valor, con 2 */
    sum(Round(vd.total_venta,2)) as total_venta
from ventas vd inner join productos p on vd.codigo_producto = p.codigo_producto
GROUP BY p.codigo_producto, p.descripcion_producto
/*Ordena los productos de forma Desc, descendente */
order by sum(Round(vd.cantidad,2)) DESC
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

SET totalCompras = (select sum(c.total_compra) from compras c  where EXTRACT(YEAR FROM c.fecha_compra) = EXTRACT(YEAR FROM curdate()));

set totalVentas = (select sum(vc.total_venta) from ventas vc where EXTRACT(YEAR FROM vc.fecha_venta) = EXTRACT(YEAR FROM curdate()));
/*
set totalVentas = (select sum(vc.total_venta) from ventas vc where EXTRACT(MONTH FROM vc.fecha_venta) = EXTRACT(MONTH FROM curdate()) and EXTRACT(YEAR FROM vc.fecha_venta) = EXTRACT(YEAR FROM curdate()));
*/
set ganancias = (totalVentas - totalCompras);
            
                 
set productosPocoStock = (select count(1) from productos p where p.stock_producto <= p.minimo_stock_producto);

set ventasHoy = (select sum(vc.total_venta) from ventas vc WHERE date(vc.fecha_venta) = date( NOW()-INTERVAL 6 HOUR));



SELECT IFNULL(totalProductos,0) AS totalProductos,
	   IFNULL(ROUND(totalCompras,2),0) AS totalCompras,
       IFNULL(ROUND(totalVentas,2),0) AS totalVentas,
       IFNULL(ROUND(ganancias,2),0) AS ganancias,
       IFNULL(productosPocoStock,0) AS productosPocoStock,
       IFNULL(ROUND(ventasHoy,2),0) AS ventasHoy;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `prc_ObtenerVentasMesActual` ()  NO SQL SELECT vc.fecha_venta,
       SUM(ROUND(vc.total_venta, 2)) AS total_venta,
       (SELECT SUM(ROUND(vcp.total_venta, 2))
        FROM ventas vcp
        WHERE DATE_FORMAT(vcp.fecha_venta, '%Y-%m') = DATE_FORMAT(DATE_SUB(vc.fecha_venta, INTERVAL 1 MONTH), '%Y-%m')
        AND DATE_FORMAT(vcp.fecha_venta, '%d') = DATE_FORMAT(vc.fecha_venta, '%d')
       ) AS total_venta_ant
FROM ventas vc
WHERE DATE(vc.fecha_venta) >= DATE(LAST_DAY(NOW() - INTERVAL 1 MONTH) + INTERVAL 1 DAY)
AND DATE(vc.fecha_venta) <= LAST_DAY(DATE(CURRENT_DATE))
GROUP BY DATE(vc.fecha_venta)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `prc_ObtenerVentasMesesPorAño` ()   SELECT 
    MONTHNAME(v.fecha_venta) AS Mes
    , SUM(round(v.total_venta,2)) AS Total_Venta
FROM ventas v
WHERE YEAR(v.fecha_venta)= YEAR(NOW())
GROUP BY MONTH(v.fecha_venta)DESC$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `prc_top_ventas_categorias` ()   BEGIN

select cast(sum(vd.total_venta)  AS DECIMAL(8,2)) as y, c.nombre_categoria as label
    from ventas vd inner join productos p on vd.codigo_producto = p.codigo_producto
                        inner join categorias c on c.id_categoria = p.id_categoria_producto
    group by c.nombre_categoria
    LIMIT 10;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `prc_Total_Caja` ()   BEGIN
declare total_Caja float;
declare efectivo float;
declare tarjeta float;
declare transferencia float;
declare otro float;


SET total_Caja = (select sum(c.entrada - c.salida) as total_Caja from caja c);

SET efectivo = (select sum(c.entrada - c.salida) as efectivo from caja c where c.fk_tipo_pago= 1);

SET tarjeta = (select sum(c.entrada - c.salida) as tarjeta from caja c where c.fk_tipo_pago= 2);

SET transferencia = (select sum(c.entrada - c.salida) as transferencia from caja c where c.fk_tipo_pago= 3);

SET otro = (select sum(c.entrada - c.salida) as otro from caja c where c.fk_tipo_pago= 4);







SELECT IFNULL(ROUND(total_Caja,2),0) AS total_Caja,
 			  IFNULL(ROUND(efectivo,2),0) AS efectivo,
               IFNULL(ROUND(tarjeta,2),0) AS tarjeta,
                IFNULL(ROUND(transferencia,2),0) AS transferencia,
                  IFNULL(ROUND(otro,2),0) AS otro;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `prc_total_ventas_usuarios` ()   SELECT u.usuario, ROUND(SUM(v.total_venta), 2) AS ventas_totales
FROM ventas v
INNER JOIN usuarios u ON u.id_usuario = v.usuario
WHERE MONTH(v.fecha_venta) = MONTH(CURRENT_DATE())
GROUP BY u.usuario$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `PRUEBAS-G.NETA.BRUTA` ()   BEGIN
  DECLARE ingreso_total FLOAT;
  DECLARE costo_total FLOAT;
  DECLARE ganancia_bruta FLOAT;
  DECLARE impuestos FLOAT;
  DECLARE ganancia_neta FLOAT;
  
  SELECT SUM(total_venta) INTO ingreso_total FROM ventas;
  
  SELECT SUM(cantidad * precio_compra) INTO costo_total FROM ventas WHERE precio_compra IS NOT NULL;
  
  SET ganancia_bruta = ingreso_total - costo_total;
  
  SET impuestos = ganancia_bruta * 0.12; -- Suponiendo una tasa impositiva del 18%
  
  SET ganancia_neta = ganancia_bruta - impuestos;
  
  SELECT ganancia_bruta, ganancia_neta;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `PRUEBAS-VENTAS-USER-MES` ()   SELECT v.usuario, MONTH(v.fecha_venta) as Mes, YEAR(v.fecha_venta) as Anio, SUM(v.total_venta) as TotalVentas
    FROM ventas v
    GROUP BY v.usuario, MONTH(v.fecha_venta), YEAR(v.fecha_venta)
    ORDER BY  v.usuario, YEAR(v.fecha_venta), month(v.fecha_venta)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `PRUEBAS_GENERALES` ()   SELECT 
    YEAR(v.fecha_venta) AS Anio,
    MONTHNAME(v.fecha_venta) AS Mes,
    SUM(ROUND(v.total_venta, 2)) AS Total_Venta,
    ROUND(SUM(v.total_venta) / COUNT(DISTINCT DATE(v.fecha_venta)), 2) AS Promedio_Venta_Diaria,
    ROUND(SUM(v.total_venta) / COUNT(DISTINCT MONTH(v.fecha_venta)), 2) AS Promedio_Venta_Mensual
FROM ventas v
WHERE YEAR(v.fecha_venta) = YEAR(NOW())
GROUP BY YEAR(v.fecha_venta), MONTH(v.fecha_venta)
ORDER BY YEAR(v.fecha_venta) DESC, MONTH(v.fecha_venta) DESC$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja`
--

CREATE TABLE `caja` (
  `id_caja` int(11) NOT NULL,
  `codigo_producto` bigint(20) NOT NULL,
  `fecha` timestamp NULL DEFAULT current_timestamp(),
  `descripcion` text DEFAULT NULL,
  `entrada` float NOT NULL,
  `salida` float NOT NULL,
  `saldo_actual` float NOT NULL,
  `fk_usuario` int(11) NOT NULL,
  `fk_tipo_pago` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `caja`
--

INSERT INTO `caja` (`id_caja`, `codigo_producto`, `fecha`, `descripcion`, `entrada`, `salida`, `saldo_actual`, `fk_usuario`, `fk_tipo_pago`) VALUES
(1033, 24365346, '2023-06-08 18:00:04', '441', 2000, 0, 0, 1, 1),
(1034, 2222222222222, '2023-06-08 18:00:18', '450', 5, 0, 0, 1, 1),
(1035, 24365346, '2023-06-08 18:00:48', '441', 2000, 0, 0, 1, 2),
(1036, 24365346, '2023-06-08 18:01:03', '441', 2000, 0, 0, 1, 2),
(1037, 24365346, '2023-06-08 18:06:14', '441', 2000, 0, 0, 1, 1),
(1038, 24365346, '2023-06-08 18:07:42', 'MUEBLE RUSTICO', 2000, 0, 0, 1, 2),
(1039, 111111111111, '2023-06-08 18:32:21', 'PRODUCTO CAMBIO AÑO', 20, 0, 0, 1, 4),
(1040, 111111111111, '2023-06-08 18:33:18', 'PRODUCTO CAMBIO AÑO', 20, 0, 0, 1, 4),
(1041, 111111111111, '2023-06-08 18:33:43', 'PRODUCTO CAMBIO AÑO', 20, 0, 0, 1, 3),
(1042, 0, '2023-06-08 18:34:10', 'EFECTIVO', 100, 0, 0, 1, 1),
(1043, 0, '2023-06-08 18:34:23', 'RETIRO', 0, 4000, 0, 1, 1),
(1044, 0, '2023-06-08 18:35:22', 'RETIRO', 0, 104, 0, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `nombre_categoria` text DEFAULT NULL,
  `aplica_peso` int(11) NOT NULL,
  `fecha_creacion_categoria` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `fecha_actualizacion_categoria` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nombre_categoria`, `aplica_peso`, `fecha_creacion_categoria`, `fecha_actualizacion_categoria`) VALUES
(120, 'categoria', 0, '2023-03-19 05:17:12', '2023-03-19'),
(121, 'MERMELADAS', 0, '2023-03-20 23:08:03', '2023-03-21'),
(122, 'TABLAS', 0, '2023-04-17 17:58:06', '2023-04-17'),
(123, 'ALMIBARES', 0, '2023-04-17 17:58:13', '2023-04-17'),
(124, 'FLORES', 0, '2023-04-17 17:58:19', '2023-04-17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `nit_cliente` varchar(15) NOT NULL,
  `nombre_cliente` varchar(100) DEFAULT NULL,
  `numero_tel` varchar(15) DEFAULT NULL,
  `correo_electronico` varchar(100) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `notas` varchar(100) DEFAULT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_actualizacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `nit_cliente`, `nombre_cliente`, `numero_tel`, `correo_electronico`, `direccion`, `notas`, `fecha_creacion`, `fecha_actualizacion`) VALUES
(41, '0', 'C/F', '00000000', '', 'CIUDAD', 'N/A', '2023-05-24 17:09:13', '2023-06-01 18:33:26'),
(43, '2353243', 'LUIS SOLIS', '28647278', 'LSOLIS@GMAIL.COM', 'CIUDAD', 'N/A', '2023-05-24 17:53:57', '2023-05-24 17:53:57'),
(44, '2375664', 'CARLOS ARIAS', '54251041', 'cariaslopez11@gmail.com', 'ciudad', '', '2023-05-24 18:01:29', '2023-05-24 18:01:29'),
(45, '2777053710101', 'ALFONSO ARIAS', '54251041', 'cariasl4@miumg.edu.gt', 'CIUDAD', '', '2023-05-24 22:39:05', '2023-05-24 22:39:05'),
(46, '676456827', 'JUAN VELASQUEZ', '65463465', '', 'CIUDAD', '', '2023-05-25 17:08:29', '2023-05-25 17:08:29'),
(47, '23523532', 'PEDRO CONTRERAS', '8645726', 'PEDRO@GMAIL.COM', 'CIUDAD', '', '2023-05-25 18:24:26', '2023-05-25 18:24:26'),
(49, '7836473767', 'LUIS PEDRO VENITO', '238283898', 'LUIV@GMAIL.GT', 'CIUDAD', '', '2023-05-25 22:30:55', '2023-06-01 05:04:59'),
(52, '234234234', 'LUISA DE LEON', '66587627', 'LLEON@GMAIL.COM', 'SAN LUCAS SAC.', '', '2023-05-25 22:47:26', '2023-05-25 22:47:26'),
(79, '387468376', 'CARLOS 21102001', '54251042', 'CARIASL@GMAIL.COM', 'SAN LUCAS SACCC', '', '2023-05-29 18:03:25', '2023-05-29 18:03:25'),
(80, '3278462345', 'FERNANDA DE LEON', '5654222', 'FER@HOTMAIL.COM', 'CIUDAD', 'ES CHAVA', '2023-05-29 18:30:48', '2023-05-29 18:30:48'),
(83, '324532634', 'gabriela', '', '', '', '', '2023-05-29 18:38:36', '2023-05-29 18:38:36'),
(84, '3453573647', 'FERNANDO', '63547255', 'FER@GMAIL.COM', 'CIUDAD', '', '2023-05-29 18:42:02', '2023-05-29 18:42:02'),
(89, '234235235', 'MARYORI FERNANDA', '3884281', 'MARYO@GMAIL.COM', 'SAN JOSE PINULAS', '', '2023-05-29 19:11:27', '2023-05-29 19:11:27'),
(129, '67567546265', 'FERNANDA VELASQUEZ', '5645674', 'FERVE@GMAIL.COM', 'SAN LUCAS', 'N-A', '2023-06-08 17:08:28', '2023-06-08 17:08:28'),
(130, '283756265', 'CARLOS LOPEZ', '762726', '', '', '', '2023-06-08 17:09:07', '2023-06-08 17:09:07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `id_compra` int(11) NOT NULL,
  `codigo_producto` bigint(20) NOT NULL,
  `fk_id_categoria` int(11) DEFAULT NULL,
  `fk_id_producto` int(11) DEFAULT NULL,
  `cantidad` float NOT NULL,
  `precio_compra` float NOT NULL,
  `total_compra` float DEFAULT NULL,
  `fecha_compra` timestamp NULL DEFAULT current_timestamp(),
  `comentarios` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `compras`
--

INSERT INTO `compras` (`id_compra`, `codigo_producto`, `fk_id_categoria`, `fk_id_producto`, `cantidad`, `precio_compra`, `total_compra`, `fecha_compra`, `comentarios`) VALUES
(777, 234323, 121, 428, 1, 20, 20, '2023-03-23 05:01:52', 'NaN'),
(779, 23423, 121, 434, 4, 2, 8, '2023-03-27 03:58:07', 'NaN'),
(780, 23423, 121, 434, 1, 2, 2, '2023-03-27 03:58:46', 'NaN'),
(784, 23423, 121, 434, 1, 2, 5, '2023-04-10 18:49:33', '2.00'),
(785, 32523, 121, 433, 1, 2, 4, '2023-04-10 18:49:33', '2.00'),
(786, 234323, 121, 428, 1, 20, 30, '2023-04-10 18:49:33', '20.00'),
(787, 234323, 121, 428, 1, 20, 30, '2023-04-10 18:51:27', '20.00'),
(788, 23423, 121, 434, 1, 2, 5, '2023-04-10 18:51:47', '2.00'),
(789, 234323, 121, 428, 1, 20, 30, '2023-04-10 18:52:07', '20.00'),
(790, 32523, 121, 433, 1, 2, 10, '2023-04-10 19:00:59', '2.00'),
(791, 234323, 121, 428, 1, 20, 35, '2023-04-10 19:10:12', '20.00'),
(792, 23423, 121, 434, 1, 2, 20, '2023-04-10 19:12:26', '2.00'),
(793, 32523, 121, 433, 1, 2, 6, '2023-04-10 19:12:26', '2.00'),
(794, 234323, 121, 428, 1, 20, 35, '2023-04-10 19:12:26', '20.00'),
(795, 234323, 121, 428, 1, 20, 35, '2023-04-10 19:18:36', 'NaN'),
(796, 234323, 121, 428, 1, 21, 30, '2023-04-10 19:20:27', 'NaN'),
(797, 234323, 121, 428, 1, 20, 31, '2023-04-10 19:20:58', 'NaN'),
(798, 32523, 121, 433, 1, 2, 41, '2023-04-10 19:24:02', 'NaN'),
(799, 234323, 121, 428, 1, 20, 31, '2023-04-10 19:24:56', 'NaN'),
(800, 234323, 121, 428, 1, 20, 20, '2023-04-10 19:30:12', 'NaN'),
(801, 32523, 121, 433, 1, 2, 2, '2023-04-10 19:30:37', 'NaN'),
(802, 32523, 121, 433, 1, 2, 2, '2023-04-10 19:32:15', 'NaN'),
(803, 32523, 121, 433, 1, 2, 2, '2023-04-10 19:32:24', 'NaN'),
(804, 32523, 121, 433, 10, 2, 20, '2023-04-10 23:02:08', 'NaN'),
(805, 32523, 121, 433, 10, 2, 20, '2023-04-10 23:02:17', 'NaN'),
(806, 32523, 121, 433, 10, 2, 20, '2023-04-10 23:02:21', 'NaN'),
(807, 32523, 121, 433, 2, 2, 4, '2023-04-10 23:02:43', 'NaN'),
(808, 234323, 121, 428, 1, 20, 20, '2023-04-10 23:04:20', 'NaN'),
(809, 32523, 121, 433, 1, 2, 2, '2023-04-10 23:05:36', 'NaN'),
(810, 32523, 121, 433, 1, 2, 2, '2023-04-10 23:08:21', 'NaN'),
(811, 23423, 121, 434, 1, 2, 2, '2023-04-10 23:10:47', 'NaN'),
(812, 32523, 121, 433, 1, 2, 2, '2023-04-10 23:10:47', 'NaN'),
(813, 234323, 121, 428, 1, 20, 20, '2023-04-10 23:10:47', 'NaN'),
(814, 32523, 121, 433, 1, 2, 2, '2023-04-10 23:10:56', 'NaN'),
(815, 23423, 121, 434, 1, 20, 20, '2023-04-10 23:11:50', 'NaN'),
(816, 32523, 121, 433, 1, 21, 21, '2023-04-10 23:11:50', 'NaN'),
(817, 234323, 121, 428, 1, 22, 22, '2023-04-10 23:11:50', 'NaN'),
(818, 234323, 121, 428, 1, 22, 22, '2023-04-10 23:15:17', 'NaN'),
(819, 32523, 121, 433, 1, 21, 21, '2023-04-10 23:15:17', 'NaN'),
(820, 23423, 121, 434, 1, 20, 20, '2023-04-10 23:15:17', 'NaN'),
(821, 32523, 121, 433, 1, 21, 21, '2023-04-10 23:16:04', 'NaN'),
(822, 23423, 121, 434, 1, 20, 20, '2023-04-10 23:16:30', 'NaN'),
(823, 32523, 121, 433, 1, 30, 30, '2023-04-10 23:16:30', 'NaN'),
(824, 23423, 121, 434, 23, 20, 460, '2023-04-10 23:24:07', 'NaN'),
(825, 32523, 121, 433, 5, 30, 150, '2023-04-10 23:24:07', 'NaN'),
(826, 234323, 121, 428, 1, 22, 22, '2023-04-10 23:24:07', 'NaN'),
(827, 234323, 121, 428, 1, 22, 22, '2023-05-22 22:35:40', 'NaN'),
(828, 2343243, 121, 446, 1, 3, 3, '2023-05-22 22:35:51', 'NaN'),
(829, 325235, 123, 444, 1, 8, 8, '2023-05-22 22:36:00', 'NaN'),
(830, 325235, 123, 444, 1, 8, 8, '2023-05-22 22:36:19', 'NaN'),
(831, 24365346, 120, 441, 4, 400, 1600, '2023-05-30 04:15:43', 'NaN'),
(832, 2343243, 121, 446, 0, 3, 0, '2023-05-30 16:43:05', 'NaN'),
(833, 98734, 121, 439, 1, 30, 30, '2023-05-30 16:43:05', 'NaN'),
(834, 24365346, 120, 441, 1, 400, 400, '2023-05-30 18:21:58', 'NaN'),
(835, 98734, 121, 439, 1, 30, 30, '2023-05-30 18:22:12', 'NaN'),
(836, 24365346, 120, 441, 1, 400, 400, '2023-05-30 18:22:12', 'NaN'),
(837, 98734, 121, 439, 5, 30, 150, '2023-05-30 18:23:51', 'NaN'),
(838, 32523, 121, 433, 1, 30, 30, '2023-05-30 18:24:06', 'NaN'),
(839, 871264375122, 121, 447, 1, 20, 20, '2023-05-30 18:43:43', 'NaN'),
(840, 871264375122, 121, 447, 1, 20, 20, '2023-05-30 18:46:04', 'NaN'),
(841, 24365346, 120, 441, 1, 400, 400, '2023-05-30 18:47:15', 'NaN'),
(842, 32523, 121, 433, 1, 30, 30, '2023-05-30 18:47:25', 'NaN'),
(843, 234323, 121, 428, 1, 22, 22, '2023-05-30 18:47:36', 'NaN'),
(844, 871264375122, 121, 447, 1, 20, 20, '2023-05-30 18:47:54', 'NaN'),
(845, 871264375122, 121, 447, 2, 20, 40, '2023-05-30 18:48:03', 'NaN'),
(848, 871264375122, 121, 447, 1, 20, 20, '2023-05-30 18:49:54', 'NaN'),
(849, 23423, 121, 434, 0, 21, 0, '2023-05-30 22:38:15', 'NaN'),
(850, 24365346, 120, 441, 1, 400, 400, '2023-05-30 22:38:15', 'NaN'),
(851, 32523, 121, 433, 1, 30, 30, '2023-05-30 22:38:15', 'NaN'),
(852, 24365346, 120, 441, 1, 400, 400, '2023-05-30 22:42:47', 'NaN'),
(854, 24365346, 120, 441, 10, 400, 4000, '2023-06-08 19:22:24', 'NaN'),
(855, 4872364676, 124, 448, 10, 20, 200, '2023-06-08 19:23:07', 'NaN'),
(856, 24365346, 120, 441, 1, 400, 400, '2023-06-08 23:27:44', 'NaN'),
(857, 24365346, 120, 441, 2, 400, 800, '2023-06-08 23:42:10', 'NaN'),
(858, 24365346, 120, 441, 1, 400, 400, '2023-06-08 23:43:28', 'NaN'),
(859, 24365346, 120, 441, 1, 400, 400, '2023-06-08 23:45:14', 'NaN'),
(860, 24365346, 120, 441, 1, 400, 400, '2023-06-08 23:45:42', 'NaN');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`id_empresa`, `razon_social`, `ruc`, `direccion`, `marca`, `serie_boleta`, `nro_correlativo_venta`, `email`) VALUES
(1, 'Tecnet', 54251041, 'Ciudad', 'Tecnet', '0002', '00001328', 'tecnetgt@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulos`
--

CREATE TABLE `modulos` (
  `id` int(11) NOT NULL,
  `modulo` varchar(45) DEFAULT NULL,
  `padre_id` int(11) DEFAULT NULL,
  `vista` varchar(45) DEFAULT NULL,
  `icon_menu` varchar(45) DEFAULT NULL,
  `orden` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `modulos`
--

INSERT INTO `modulos` (`id`, `modulo`, `padre_id`, `vista`, `icon_menu`, `orden`) VALUES
(1, 'Tablero Principal', 0, 'dashboard.php', 'fas fa-tachometer-alt', 0),
(2, 'Ventas', 0, '', 'fas fa-store-alt', 5),
(3, 'Punto de Venta', 2, 'ventas.php', 'far fa-circle', 6),
(4, 'Administrar Ventas', 2, 'administrar_ventas.php', 'far fa-circle', 7),
(5, 'Productos', 0, NULL, 'fas fa-cart-plus', 1),
(6, 'Inventario', 5, 'productos.php', 'far fa-circle', 2),
(7, 'Carga Masiva', 5, 'carga_masiva_productos.php', 'far fa-circle', 3),
(8, 'Categorías', 5, 'categorias.php', 'far fa-circle', 4),
(9, 'Compras', 0, '', 'fas fa-dolly', 8),
(10, 'Reportes', 11, 'reportes.php', 'fas fa-chart-line', 13),
(11, 'Configuración', 0, '', 'fas fa-cogs', 12),
(12, 'Usuarios', 11, 'usuarios.php', 'fas fa-users', 14),
(13, 'Roles y Perfiles', 11, 'modulos_perfiles.php', 'fas fa-tablet-alt', 15),
(14, 'Punto de Compra', 9, 'compras.php', 'far fa-circle', 9),
(15, 'Caja', 0, '', 'fas fa-cash-register', 11),
(16, 'Administrar Compras', 9, 'administrar_compras.php', 'far fa-circle', 10),
(17, 'Administrar Caja', 15, 'administrar_caja.php', 'far fa-circle', 16),
(18, 'Inventario Actual', 15, 'inventario_actual.php', 'far fa-circle', 17),
(19, 'Clientes', 2, 'clientes.php', 'fas fa-users', 18);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfiles`
--

CREATE TABLE `perfiles` (
  `id_perfil` int(11) NOT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `estado` tinyint(4) DEFAULT NULL,
  `fecha_creacion_perfil` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `fecha_actualizacion_perfil` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `perfiles`
--

INSERT INTO `perfiles` (`id_perfil`, `descripcion`, `estado`, `fecha_creacion_perfil`, `fecha_actualizacion_perfil`) VALUES
(1, 'MANAGER', 1, '2023-03-19 05:38:16', '2023-03-19'),
(33, 'vendedor', 1, '2023-03-15 21:43:56', '2023-03-15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil_modulo`
--

CREATE TABLE `perfil_modulo` (
  `idperfil_modulo` int(11) NOT NULL,
  `id_perfil` int(11) DEFAULT NULL,
  `id_modulo` int(11) DEFAULT NULL,
  `vista_inicio` tinyint(4) DEFAULT NULL,
  `estado` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `perfil_modulo`
--

INSERT INTO `perfil_modulo` (`idperfil_modulo`, `id_perfil`, `id_modulo`, `vista_inicio`, `estado`) VALUES
(13, 1, 13, 0, 1),
(654, 33, 3, 1, 1),
(655, 33, 2, 0, 1),
(656, 33, 17, 0, 1),
(657, 33, 15, 0, 1),
(658, 33, 18, 0, 1),
(659, 33, 4, 0, 1),
(660, 1, 1, 1, 1),
(661, 1, 6, 0, 1),
(662, 1, 5, 0, 1),
(663, 1, 7, 0, 1),
(664, 1, 8, 0, 1),
(665, 1, 3, 0, 1),
(666, 1, 2, 0, 1),
(667, 1, 4, 0, 1),
(668, 1, 14, 0, 1),
(669, 1, 9, 0, 1),
(670, 1, 16, 0, 1),
(671, 1, 10, 0, 1),
(672, 1, 11, 0, 1),
(673, 1, 12, 0, 1),
(674, 1, 17, 0, 1),
(675, 1, 15, 0, 1),
(676, 1, 18, 0, 1),
(677, 1, 19, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `codigo_producto` varchar(13) NOT NULL,
  `id_categoria_producto` int(11) DEFAULT NULL,
  `descripcion_producto` text DEFAULT NULL,
  `precio_compra_producto` float NOT NULL,
  `precio_venta_producto` float NOT NULL,
  `utilidad` float NOT NULL,
  `stock_producto` float DEFAULT NULL,
  `minimo_stock_producto` float DEFAULT NULL,
  `ventas_producto` float DEFAULT NULL,
  `fecha_creacion_producto` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `fecha_actualizacion_producto` date DEFAULT NULL,
  `foto` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `codigo_producto`, `id_categoria_producto`, `descripcion_producto`, `precio_compra_producto`, `precio_venta_producto`, `utilidad`, `stock_producto`, `minimo_stock_producto`, `ventas_producto`, `fecha_creacion_producto`, `fecha_actualizacion_producto`, `foto`) VALUES
(428, '234323', 121, 'MERMELADA DE SAUCO ', 22, 35, 13, 0, 2, 27, '2023-05-30 22:42:22', '2023-03-21', 'MERMELADA DE SAUCO.jpeg'),
(433, '32523', 121, 'asdasd', 30, 34, 2, 162, 4, 89, '2023-06-08 06:29:47', '2023-03-23', 'default.png'),
(434, '23423', 121, 'PRODUCTO PRUEBA', 21, 33, 3, 0, 5, 47, '2023-05-30 22:38:15', '2023-03-23', 'elporvenir.jpeg'),
(439, '98734', 121, 'MERMELADA 10', 30, 40, 10, 8863, 1, 67, '2023-06-08 06:18:47', '2023-04-17', 'Captura de pantalla 2023-03-27 230643.png'),
(440, '93847', 124, 'FLORE DE TAGETE', 10, 50, 40, 100, 2, 0, '2023-05-14 04:16:17', '2023-04-17', 'WhatsApp Image 2023-01-24 at 12.33.39 PM (1).jpeg'),
(441, '24365346', 120, 'MUEBLE RUSTICO BARNIZADO', 400, 2000, 1600, 242, 832, 76, '2023-06-08 23:50:24', '2023-04-17', 'WhatsApp Image 2023-01-24 at 12.33.42 PM (1).jpeg'),
(442, '525235', 122, 'TABLA DE BAMBÚ', 92, 828, 736, 341, 1, 2, '2023-05-30 18:13:33', '2023-04-17', 'WhatsApp Image 2023-03-21 at 12.45.48 PM (1).jpeg'),
(443, '953876', 123, 'ALMIBARES DE MELOCOTONES', 30, 100, 70, 976, 2, 23, '2023-05-29 19:12:30', '2023-04-17', 'WhatsApp Image 2023-03-21 at 12.45.54 PM.jpeg'),
(444, '325235', 123, 'PRUEBAS 10', 8, 99, 91, 928, 1, 3, '2023-05-23 03:40:08', '2023-04-17', 'WhatsApp Image 2023-03-15 at 10.48.42 AM.jpeg'),
(445, '234234', 123, 'PRUEBAS 100', 30, 50, 20, 218, 2, 4, '2023-05-23 03:40:08', '2023-04-17', 'BANCO REDONDO 52-53CM.png'),
(446, '2343243', 121, 'MERMELADA', 3, 34, 31, 1, 3, 2, '2023-06-07 18:27:34', '2023-04-18', 'default.png'),
(447, '871264375122', 121, 'MERMELADA DE SAUCO', 20, 80, 60, 4, 2, 3, '2023-05-30 18:49:54', '2023-05-12', 'default.png'),
(448, '4872364676', 124, 'FLOR DE SAN LUCAS', 20, 33, 10, 14, 0, 0, '2023-06-08 19:23:07', '2023-06-01', 'CHILTEPE.jpg'),
(449, '111111111111', 124, 'PRODUCTO CAMBIO AÑO', 10, 20, 10, 40, 3, 10, '2023-06-08 18:33:43', '2023-06-08', 'WhatsApp Image 2023-06-07 at 10.44.15 AM (1).jpeg'),
(450, '2222222222222', 120, 'PRUEBAS DE CODIGO', 2, 5, 3, 221, 5, 1, '2023-06-08 18:00:18', '2023-06-08', 'default.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_pago`
--

CREATE TABLE `tipo_pago` (
  `id` int(11) NOT NULL,
  `tipo_pago` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_pago`
--

INSERT INTO `tipo_pago` (`id`, `tipo_pago`) VALUES
(1, 'EFECTIVO'),
(2, 'TARJETA'),
(3, 'TRANSFERENCIA'),
(4, 'OTRO'),
(5, 'N/A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre_usuario` varchar(100) DEFAULT NULL,
  `apellido_usuario` varchar(100) DEFAULT NULL,
  `usuario` varchar(100) DEFAULT NULL,
  `clave` text DEFAULT NULL,
  `id_perfil_usuario` int(11) DEFAULT NULL,
  `estado` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre_usuario`, `apellido_usuario`, `usuario`, `clave`, `id_perfil_usuario`, `estado`) VALUES
(1, 'Carlos', 'Arias', 'carias', 'cofEhK.v.u6ZA', 1, 1),
(43, 'Chano', 'Arias', 'chano', 'coMs4e95z7vOc', 33, 1),
(44, 'VENDEDOR', '1', 'V1', 'cofEhK.v.u6ZA', 33, 1),
(45, 'Papa', 'Arias', 'papa', 'copX1QJ7n9Oi2', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id_venta` int(11) NOT NULL,
  `codigo_producto` bigint(20) NOT NULL,
  `fk_id_categoria` int(11) DEFAULT NULL,
  `fk_id_producto` int(11) DEFAULT NULL,
  `cantidad` float NOT NULL,
  `precio_venta` float NOT NULL,
  `descuento_venta` float DEFAULT NULL,
  `total_venta` float DEFAULT NULL,
  `fecha_venta` timestamp NULL DEFAULT current_timestamp(),
  `usuario` int(2) NOT NULL,
  `precio_compra` int(10) DEFAULT NULL,
  `fk_tipo_pago` int(2) NOT NULL,
  `fk_id_cliente` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id_venta`, `codigo_producto`, `fk_id_categoria`, `fk_id_producto`, `cantidad`, `precio_venta`, `descuento_venta`, `total_venta`, `fecha_venta`, `usuario`, `precio_compra`, `fk_tipo_pago`, `fk_id_cliente`) VALUES
(333, 98734, 121, 439, 1, 40, 0, 40, '2023-05-04 04:35:01', 1, 30, 1, 41),
(334, 32523, 121, 433, 1, 34, 0, 34, '2023-05-04 04:35:01', 1, 30, 1, 41),
(335, 24365346, 120, 441, 1, 2000, 0, 2000, '2023-05-04 04:35:01', 1, 400, 1, 41),
(336, 32523, 121, 433, 1, 34, 0, 34, '2023-05-05 03:40:44', 1, 30, 3, 41),
(337, 98734, 121, 439, 1, 40, 0, 40, '2023-05-05 04:32:32', 44, 30, 3, 41),
(338, 32523, 121, 433, 1, 34, 0, 34, '2023-05-05 04:32:32', 44, 30, 3, 41),
(339, 24365346, 120, 441, 1, 2000, 0, 2000, '2023-05-05 04:32:32', 44, 400, 3, 41),
(340, 32523, 121, 433, 1, 34, 0, 34, '2023-05-05 16:58:33', 43, 30, 3, 41),
(341, 24365346, 120, 441, 1, 2000, 0, 2000, '2023-05-05 16:58:33', 43, 400, 3, 41),
(342, 23423, 121, 434, 1, 33, 0, 33, '2023-05-05 16:59:34', 45, 20, 4, 41),
(343, 98734, 121, 439, 1, 40, 0, 40, '2023-05-05 16:59:34', 45, 30, 4, 41),
(344, 24365346, 120, 441, 5, 2000, 0, 10000, '2023-05-05 16:59:53', 45, 400, 2, 41),
(345, 32523, 121, 433, 1, 34, 0, 34, '2023-05-05 16:59:53', 45, 30, 2, 41),
(346, 32523, 121, 433, 1, 34, 0, 34, '2023-05-09 04:21:17', 1, 30, 3, 41),
(347, 24365346, 120, 441, 1, 2000, 0, 2000, '2023-05-09 04:21:17', 1, 400, 3, 41),
(348, 234234, 123, 445, 1, 50, 0, 50, '2023-05-10 02:42:24', 1, 30, 2, 41),
(349, 325235, 123, 444, 1, 99, 0, 99, '2023-05-10 02:42:24', 1, 8, 2, 41),
(350, 953876, 123, 443, 1, 100, 0, 100, '2023-05-10 02:42:24', 1, 30, 2, 41),
(351, 98734, 121, 439, 1, 40, 0, 40, '2023-05-10 02:42:24', 1, 30, 2, 41),
(352, 23423, 121, 434, 1, 33, 0, 33, '2023-05-10 02:42:24', 1, 20, 2, 41),
(353, 32523, 121, 433, 1, 34, 0, 34, '2023-05-10 02:42:24', 1, 30, 2, 41),
(354, 98734, 121, 439, 3, 40, 0, 120, '2023-05-10 02:42:57', 1, 30, 1, 41),
(355, 32523, 121, 433, 2, 34, 0, 68, '2023-05-10 02:42:57', 1, 30, 1, 41),
(356, 24365346, 120, 441, 2, 2000, 0, 4000, '2023-05-10 02:42:57', 1, 400, 1, 41),
(357, 98734, 121, 439, 1, 40, 0, 40, '2023-05-11 23:07:23', 1, 30, 1, 41),
(358, 32523, 121, 433, 1, 34, 0, 34, '2023-05-11 23:07:23', 1, 30, 1, 41),
(359, 24365346, 120, 441, 1, 2000, 0, 2000, '2023-05-11 23:07:23', 1, 400, 1, 41),
(375, 24365346, 120, 441, 1, 2000, 0, 2000, '2023-05-14 04:17:14', 1, 400, 1, 41),
(376, 32523, 121, 433, 1, 34, 0, 34, '2023-05-14 04:17:31', 1, 30, 3, 41),
(377, 525235, 122, 442, 1, 828, 0, 828, '2023-05-15 04:53:39', 1, 92, 3, 41),
(378, 953876, 123, 443, 1, 100, 0, 100, '2023-05-15 04:53:39', 1, 30, 3, 41),
(379, 98734, 121, 439, 1, 40, 0, 40, '2023-05-15 04:53:39', 1, 30, 3, 41),
(380, 23423, 121, 434, 1, 33, 0, 33, '2023-05-15 04:53:39', 1, 20, 3, 41),
(381, 32523, 121, 433, 1, 34, 0, 34, '2023-05-15 04:53:39', 1, 30, 3, 41),
(382, 24365346, 120, 441, 2, 2000, 0, 4000, '2023-05-15 04:53:39', 1, 400, 3, 41),
(383, 24365346, 120, 441, 1, 2000, 0, 2000, '2023-05-17 16:36:53', 1, 400, 2, 41),
(384, 24365346, 120, 441, 1, 2000, 0, 2000, '2023-05-17 16:38:08', 1, 400, 1, 41),
(385, 24365346, 120, 441, 1, 2000, 0, 2000, '2023-05-17 16:40:44', 1, 400, 2, 41),
(386, 32523, 121, 433, 2, 34, 0, 68, '2023-05-17 16:40:44', 1, 30, 2, 41),
(387, 24365346, 120, 441, 1, 2000, 0, 2000, '2023-05-19 03:54:13', 1, 400, 1, 41),
(388, 23423, 121, 434, 1, 33, 0, 33, '2023-05-19 03:54:13', 1, 20, 1, 41),
(389, 32523, 121, 433, 1, 34, 0, 34, '2023-05-19 03:54:13', 1, 30, 1, 41),
(390, 234323, 121, 428, 1, 35, 0, 35, '2023-05-22 22:51:02', 1, 22, 3, 41),
(391, 24365346, 120, 441, 1, 2000, 0, 2000, '2023-05-22 23:49:25', 1, 400, 1, 41),
(392, 24365346, 120, 441, 1, 2000, 0, 2000, '2023-05-22 23:49:53', 1, 400, 3, 41),
(393, 234234, 123, 445, 1, 50, 0, 50, '2023-05-22 23:56:06', 1, 30, 4, 41),
(394, 234234, 123, 445, 1, 50, 0, 50, '2023-05-22 23:56:37', 1, 30, 3, 41),
(395, 23423, 121, 434, 1, 33, 0, 33, '2023-05-23 00:01:08', 1, 20, 2, 41),
(396, 23423, 121, 434, 1, 33, 0, 33, '2023-05-23 00:14:27', 1, 20, 1, 41),
(397, 98734, 121, 439, 1, 40, 0, 40, '2023-05-23 00:14:47', 1, 30, 2, 41),
(398, 23423, 121, 434, 1, 33, 0, 33, '2023-05-23 00:17:28', 1, 20, 3, 41),
(399, 24365346, 120, 441, 1, 2000, 10, 1990, '2023-05-23 00:17:28', 1, 400, 3, 41),
(403, 871264375122, 121, 447, 1, 80, 0, 80, '2023-05-23 00:20:35', 1, 20, 2, 41),
(404, 24365346, 120, 441, 1, 2000, 0, 2000, '2023-05-23 03:33:18', 1, 400, 2, 41),
(405, 24365346, 120, 441, 1, 2000, 0, 2000, '2023-05-23 03:33:38', 1, 400, 3, 41),
(408, 98734, 121, 439, 1, 40, 0, 40, '2023-05-23 03:37:00', 1, 30, 2, 41),
(409, 98734, 121, 439, 1, 40, 0, 40, '2023-05-23 03:37:26', 1, 30, 3, 41),
(412, 98734, 121, 439, 1, 40, 30, 10, '2023-05-23 03:40:08', 1, 30, 3, 41),
(413, 234234, 123, 445, 1, 50, 0, 50, '2023-05-23 03:40:08', 1, 30, 3, 41),
(414, 325235, 123, 444, 1, 99, 0, 99, '2023-05-23 03:40:08', 1, 8, 3, 41),
(415, 953876, 123, 443, 1, 100, 59, 41, '2023-05-23 03:40:08', 1, 30, 3, 41),
(420, 871264375122, 121, 447, 2, 80, 0, 160, '2023-05-23 03:43:37', 1, 20, 2, 41),
(421, 23423, 121, 434, 1, 33, 0, 33, '2023-05-23 03:49:47', 1, 20, 4, 41),
(422, 32523, 121, 433, 1, 34, 0, 34, '2023-05-23 03:49:47', 1, 30, 4, 41),
(423, 98734, 121, 439, 1, 40, 0, 40, '2023-05-24 16:51:57', 1, 30, 3, 41),
(424, 23423, 121, 434, 1, 33, 0, 33, '2023-05-24 16:51:57', 1, 20, 3, 41),
(425, 24365346, 120, 441, 1, 2000, 0, 2000, '2023-05-24 16:51:57', 1, 400, 3, 41),
(426, 24365346, 120, 441, 1, 2000, 0, 2000, '2023-05-24 16:59:20', 1, 400, 1, 41),
(427, 24365346, 120, 441, 1, 2000, 0, 2000, '2023-05-24 17:11:21', 1, 400, 1, 41),
(428, 23423, 121, 434, 1, 33, 0, 33, '2023-05-24 17:13:46', 1, 20, 2, 41),
(434, 24365346, 120, 441, 1, 2000, 0, 2000, '2023-05-24 22:09:01', 1, 400, 2, 41),
(435, 32523, 121, 433, 2, 34, 0, 68, '2023-05-24 23:04:57', 1, 30, 2, 41),
(436, 24365346, 120, 441, 1, 2000, 0, 2000, '2023-05-24 23:07:57', 1, 400, 1, 41),
(437, 24365346, 120, 441, 1, 2000, 0, 2000, '2023-05-24 23:08:08', 1, 400, 2, 41),
(438, 24365346, 120, 441, 1, 2000, 0, 2000, '2023-05-24 23:47:19', 1, 400, 1, 41),
(439, 32523, 121, 433, 1, 34, 0, 34, '2023-05-24 23:47:46', 1, 30, 2, 41),
(440, 24365346, 120, 441, 1, 2000, 0, 2000, '2023-05-25 04:02:26', 1, 400, 1, 41),
(441, 32523, 121, 433, 1, 34, 0, 34, '2023-05-25 04:02:44', 1, 30, 3, 41),
(445, 23423, 121, 434, 1, 33, 0, 33, '2023-05-25 04:07:45', 1, 20, 2, 43),
(452, 24365346, 120, 441, 1, 2000, 0, 2000, '2023-05-25 04:31:10', 1, 400, 1, 41),
(456, 24365346, 120, 441, 1, 2000, 0, 2000, '2023-05-25 04:35:47', 1, 400, 3, 43),
(457, 24365346, 120, 441, 1, 2000, 0, 2000, '2023-05-25 04:36:44', 1, 400, 2, 41),
(458, 24365346, 120, 441, 1, 2000, 0, 2000, '2023-05-25 04:37:06', 1, 400, 2, 41),
(459, 953876, 123, 443, 1, 100, 0, 100, '2023-05-25 04:38:10', 1, 30, 1, 41),
(460, 32523, 121, 433, 1, 34, 0, 34, '2023-05-25 04:38:10', 1, 30, 1, 41),
(461, 98734, 121, 439, 1, 40, 0, 40, '2023-05-25 05:03:02', 1, 30, 3, 43),
(462, 32523, 121, 433, 1, 34, 4, 30, '2023-05-25 17:01:09', 1, 30, 1, 43),
(463, 23423, 121, 434, 1, 33, 0, 33, '2023-05-25 17:04:55', 1, 20, 1, 41),
(464, 23423, 121, 434, 1, 33, 0, 33, '2023-05-25 17:05:04', 1, 20, 2, 44),
(465, 24365346, 120, 441, 1, 2000, 0, 2000, '2023-05-25 17:07:51', 1, 400, 1, 43),
(466, 24365346, 120, 441, 1, 2000, 0, 2000, '2023-05-25 17:09:26', 1, 400, 2, 41),
(467, 98734, 121, 439, 1, 40, 0, 40, '2023-05-25 17:09:26', 1, 30, 2, 41),
(468, 23423, 121, 434, 1, 33, 0, 33, '2023-05-25 17:13:00', 1, 20, 2, 46),
(469, 23423, 121, 434, 1, 33, 0, 33, '2023-05-25 18:20:22', 1, 20, 2, 44),
(470, 24365346, 120, 441, 1, 2000, 0, 2000, '2023-05-25 18:56:05', 1, 400, 1, 44),
(471, 98734, 121, 439, 1, 40, 0, 40, '2023-05-25 18:56:22', 1, 30, 3, 43),
(472, 32523, 121, 433, 1, 34, 0, 34, '2023-05-25 18:56:30', 1, 30, 2, 45),
(473, 98734, 121, 439, 1, 40, 0, 40, '2023-05-25 22:31:30', 1, 30, 2, 49),
(474, 23423, 121, 434, 1, 33, 0, 33, '2023-05-25 22:31:30', 1, 20, 2, 49),
(475, 32523, 121, 433, 1, 34, 0, 34, '2023-05-25 22:31:30', 1, 30, 2, 49),
(476, 24365346, 120, 441, 1, 2000, 0, 2000, '2023-05-25 22:31:30', 1, 400, 2, 49),
(477, 23423, 121, 434, 1, 33, 0, 33, '2023-05-25 23:24:20', 1, 20, 2, 41),
(478, 24365346, 120, 441, 1, 2000, 0, 2000, '2023-05-25 23:24:20', 1, 400, 2, 41),
(479, 24365346, 120, 441, 1, 2000, 0, 2000, '2023-05-26 15:58:16', 1, 400, 1, 52),
(480, 32523, 121, 433, 1, 34, 0, 34, '2023-05-26 16:00:41', 1, 30, 4, 44),
(481, 24365346, 120, 441, 1, 2000, 0, 2000, '2023-05-27 15:21:03', 1, 400, 1, 41),
(482, 24365346, 120, 441, 1, 2000, 0, 2000, '2023-05-29 05:21:41', 1, 400, 2, 47),
(483, 871264375122, 121, 447, 1, 10, 0, 10, '0000-00-00 00:00:00', 1, 5, 2, 41),
(484, 98734, 121, 439, 2, 40, 0, 80, '2023-05-29 18:03:30', 1, 30, 1, 79),
(485, 32523, 121, 433, 2, 34, 0, 68, '2023-05-29 18:03:30', 1, 30, 1, 79),
(486, 32523, 121, 433, 1, 34, 0, 34, '2023-05-29 18:30:58', 1, 30, 1, 80),
(487, 24365346, 120, 441, 1, 2000, 0, 2000, '2023-05-29 18:30:58', 1, 400, 1, 80),
(488, 98734, 121, 439, 1, 40, 0, 40, '2023-05-29 18:38:47', 1, 30, 3, 83),
(489, 24365346, 120, 441, 1, 2000, 0, 2000, '2023-05-29 18:38:47', 1, 400, 3, 83),
(490, 32523, 121, 433, 1, 34, 4, 30, '2023-05-29 18:42:06', 1, 30, 1, 84),
(492, 24365346, 120, 441, 1, 2000, 0, 2000, '2023-05-29 18:58:51', 1, 400, 1, 41),
(493, 32523, 121, 433, 2, 34, 0, 68, '2023-05-29 19:11:39', 1, 30, 2, 89),
(494, 24365346, 120, 441, 1, 2000, 0, 2000, '2023-05-29 19:11:39', 1, 400, 2, 89),
(495, 953876, 123, 443, 1, 100, 0, 100, '2023-05-29 19:12:30', 1, 30, 2, 41),
(496, 24365346, 120, 441, 1, 2000, 0, 2000, '2023-05-29 19:12:30', 1, 400, 2, 41),
(497, 24365346, 120, 441, 3, 2000, 0, 6000, '2023-05-30 04:16:05', 1, 400, 1, 44),
(498, 525235, 122, 442, 1, 828, 0, 828, '2023-05-30 18:13:33', 1, 92, 2, 44),
(503, 234323, 121, 428, 1, 35, 0, 35, '2023-05-30 22:42:22', 1, 22, 2, 46),
(504, 24365346, 120, 441, 1, 2000, 0, 2000, '2023-06-01 05:52:55', 1, 400, 2, 41),
(505, 24365346, 120, 441, 1, 2000, 0, 2000, '2023-06-01 17:24:12', 1, 400, 2, 41),
(506, 32523, 121, 433, 1, 34, 0, 34, '2023-06-01 17:24:37', 1, 30, 1, 41),
(507, 32523, 121, 433, 1, 34, 0, 34, '2023-06-01 17:24:52', 1, 30, 2, 44),
(508, 24365346, 120, 441, 1, 2000, 0, 2000, '2023-06-01 17:25:12', 1, 400, 4, 44),
(509, 98734, 121, 439, 1, 40, 0, 40, '2023-06-01 17:25:37', 1, 30, 2, 44),
(510, 98734, 121, 439, 1, 40, 0, 40, '2023-06-01 17:25:59', 1, 30, 3, 79),
(513, 24365346, 120, 441, 1, 2000, 0, 2000, '2023-06-07 18:27:10', 1, 400, 2, 41),
(514, 2343243, 121, 446, 1, 34, 0, 34, '2023-06-07 18:27:34', 1, 3, 1, 41),
(515, 32523, 121, 433, 1, 34, 0, 34, '2023-06-07 18:31:14', 1, 30, 2, 41),
(516, 24365346, 120, 441, 1, 2000, 0, 2000, '2023-06-07 18:31:31', 1, 400, 2, 45),
(519, 98734, 121, 439, 1, 40, 0, 40, '2023-06-07 18:55:32', 1, 30, 1, 79),
(520, 24365346, 120, 441, 1, 2000, 0, 2000, '2023-06-08 04:45:01', 1, 400, 3, 41),
(521, 98734, 121, 439, 1, 40, 0, 40, '2023-06-08 05:08:17', 1, 30, 2, 41),
(522, 111111111111, 124, 449, 1, 20, 0, 20, '2023-06-08 05:10:37', 1, 10, 2, 41),
(523, 111111111111, 124, 449, 1, 20, 0, 20, '2023-06-08 05:10:48', 1, 10, 4, 44),
(530, 24365346, 120, 441, 1, 2000, 1000, 1000, '2023-06-08 06:17:35', 1, 400, 1, 41),
(531, 24365346, 120, 441, 1, 2000, 0, 2000, '2023-06-08 06:18:19', 1, 400, 2, 41),
(532, 98734, 121, 439, 1, 40, 0, 40, '2023-06-08 06:18:47', 1, 30, 1, 41),
(533, 111111111111, 124, 449, 4, 20, 0, 80, '2023-06-08 06:29:47', 1, 10, 4, 46),
(534, 32523, 121, 433, 4, 34, 0, 136, '2023-06-08 06:29:47', 1, 30, 4, 46),
(535, 24365346, 120, 441, 1, 2000, 0, 2000, '2023-06-08 06:29:47', 1, 400, 4, 46),
(536, 24365346, 120, 441, 1, 2000, 0, 2000, '2023-06-08 17:04:18', 1, 400, 3, 41),
(537, 111111111111, 124, 449, 1, 20, 0, 20, '2023-06-08 17:09:13', 1, 10, 4, 130),
(538, 24365346, 120, 441, 1, 2000, 0, 2000, '2023-06-08 17:29:22', 1, 400, 3, 41),
(539, 24365346, 120, 441, 1, 2000, 0, 2000, '2023-06-08 18:00:04', 1, 400, 1, 41),
(540, 2222222222222, 120, 450, 1, 5, 0, 5, '2023-06-08 18:00:18', 1, 2, 1, 41),
(541, 24365346, 120, 441, 1, 2000, 0, 2000, '2023-06-08 18:00:48', 1, 400, 2, 41),
(542, 24365346, 120, 441, 1, 2000, 0, 2000, '2023-06-08 18:01:03', 1, 400, 2, 41),
(543, 24365346, 120, 441, 1, 2000, 0, 2000, '2023-06-08 18:06:14', 1, 400, 1, 41),
(544, 24365346, 120, 441, 1, 2000, 0, 2000, '2023-06-08 18:07:42', 1, 400, 2, 41),
(545, 111111111111, 124, 449, 1, 20, 0, 20, '2023-06-08 18:32:21', 1, 10, 4, 41),
(546, 111111111111, 124, 449, 1, 20, 0, 20, '2023-06-08 18:33:18', 1, 10, 4, 41),
(547, 111111111111, 124, 449, 1, 20, 0, 20, '2023-06-08 18:33:43', 1, 10, 3, 41);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta_detalle`
--

CREATE TABLE `venta_detalle` (
  `id` int(11) NOT NULL,
  `nro_boleta` varchar(8) NOT NULL,
  `codigo_producto` bigint(20) NOT NULL,
  `cantidad` float NOT NULL,
  `total_venta` float NOT NULL,
  `fecha_venta` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `caja`
--
ALTER TABLE `caja`
  ADD PRIMARY KEY (`id_caja`),
  ADD KEY `fk_usuario` (`fk_usuario`),
  ADD KEY `fk_tipo_pago` (`fk_tipo_pago`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`),
  ADD UNIQUE KEY `nombre_categoria` (`nombre_categoria`) USING HASH,
  ADD UNIQUE KEY `uq_nombre_categoria` (`nombre_categoria`) USING HASH;

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`),
  ADD UNIQUE KEY `uq_nit_cliente` (`nit_cliente`);

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id_compra`),
  ADD KEY `fk_id_categoria` (`fk_id_categoria`),
  ADD KEY `fk_id_producto` (`fk_id_producto`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id_empresa`);

--
-- Indices de la tabla `modulos`
--
ALTER TABLE `modulos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  ADD PRIMARY KEY (`id_perfil`);

--
-- Indices de la tabla `perfil_modulo`
--
ALTER TABLE `perfil_modulo`
  ADD PRIMARY KEY (`idperfil_modulo`),
  ADD KEY `id_perfil` (`id_perfil`),
  ADD KEY `id_modulo` (`id_modulo`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`,`codigo_producto`),
  ADD UNIQUE KEY `codigo_producto` (`codigo_producto`),
  ADD KEY `id_categoria_producto` (`id_categoria_producto`);

--
-- Indices de la tabla `tipo_pago`
--
ALTER TABLE `tipo_pago`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `id_perfil_usuario` (`id_perfil_usuario`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id_venta`),
  ADD UNIQUE KEY `uq_codigo_producto_fecha_venta` (`fk_id_producto`,`fecha_venta`),
  ADD KEY `fk_tipo_pago` (`fk_tipo_pago`),
  ADD KEY `usuario` (`usuario`),
  ADD KEY `fk_id_cliente` (`fk_id_cliente`),
  ADD KEY `fk_id_categoria` (`fk_id_categoria`);

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
-- AUTO_INCREMENT de la tabla `caja`
--
ALTER TABLE `caja`
  MODIFY `id_caja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1045;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `id_compra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=861;

--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id_empresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `modulos`
--
ALTER TABLE `modulos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  MODIFY `id_perfil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `perfil_modulo`
--
ALTER TABLE `perfil_modulo`
  MODIFY `idperfil_modulo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=678;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=451;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=548;

--
-- AUTO_INCREMENT de la tabla `venta_cabecera`
--
ALTER TABLE `venta_cabecera`
  MODIFY `id_boleta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=184;

--
-- AUTO_INCREMENT de la tabla `venta_detalle`
--
ALTER TABLE `venta_detalle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=787;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `caja`
--
ALTER TABLE `caja`
  ADD CONSTRAINT `caja_ibfk_1` FOREIGN KEY (`fk_tipo_pago`) REFERENCES `tipo_pago` (`id`),
  ADD CONSTRAINT `fk_usuario` FOREIGN KEY (`fk_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `compras`
--
ALTER TABLE `compras`
  ADD CONSTRAINT `compras_ibfk_1` FOREIGN KEY (`fk_id_categoria`) REFERENCES `categorias` (`id_categoria`),
  ADD CONSTRAINT `compras_ibfk_2` FOREIGN KEY (`fk_id_producto`) REFERENCES `productos` (`id`);

--
-- Filtros para la tabla `perfil_modulo`
--
ALTER TABLE `perfil_modulo`
  ADD CONSTRAINT `id_modulo` FOREIGN KEY (`id_modulo`) REFERENCES `modulos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_perfil` FOREIGN KEY (`id_perfil`) REFERENCES `perfiles` (`id_perfil`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_categoria_producto`) REFERENCES `categorias` (`id_categoria`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_perfil_usuario`) REFERENCES `perfiles` (`id_perfil`);

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`fk_tipo_pago`) REFERENCES `tipo_pago` (`id`),
  ADD CONSTRAINT `ventas_ibfk_2` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `ventas_ibfk_3` FOREIGN KEY (`fk_id_cliente`) REFERENCES `clientes` (`id_cliente`),
  ADD CONSTRAINT `ventas_ibfk_4` FOREIGN KEY (`fk_id_categoria`) REFERENCES `categorias` (`id_categoria`),
  ADD CONSTRAINT `ventas_ibfk_5` FOREIGN KEY (`fk_id_producto`) REFERENCES `productos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
