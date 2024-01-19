-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-05-2023 a las 03:46:25
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bdinventario`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `buscar_accesorios` (IN `id` INT(11))   SELECT accesorio.num_inv_acc,tipo_accesorio.tipo_accesorio,accesorio.modelo,marca.nombre_marca from accesorio
        INNER JOIN tipo_accesorio ON tipo_accesorio.id_taccesorio=accesorio.id_taccesorio
        INNER join marca ON marca.id_marca=accesorio.id_marca
        INNER JOIN detalle_cpu_accesorio ON detalle_cpu_accesorio.num_inv_accesorio=accesorio.num_inv_acc
        INNER JOIN cpu ON cpu.num_inventario=detalle_cpu_accesorio.num_inv_cpu WHERE cpu.id_cpu=id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `buscar_inventario` (IN `_inventario` VARCHAR(11))   BEGIN

    DECLARE CONTADOR INT(11);
   
    
    -- obtener cuantos hay de cada tabla con el mismo num inventario
	SET CONTADOR = CONTADOR +(SELECT count(*) from cpu where num_inventario='_inventario');
    
    
    
  
    -- bien ahora solo debemos retornar los datos mediante otro SELECT
    SELECT CONTADOR;
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `consulta_general` ()   SELECT id_cpu,cpu.num_inventario,nombre_cpu,marca.nombre_marca,cpu.modelo,clasificacion.nombre_clasif,serv_tag,garantia,tipo_estado.nombre_estado,CONCAT_WS(' ',empleados.nombre,empleados.apellido) as operador,usuario_windows,fecha_ingreso,usuario_sistema.nombre_usu as ingresado_por,
CONCAT_WS(' ',procesador.fabricante,procesador.modelo,procesador.generacion,procesador.velocidad) as procesador,
(SELECT GROUP_CONCAT(DISTINCTROW CONCAT_WS(' ',tipo_ram.tipo_ram,ram.capacidad,ram.frecuencia,ram.observaciones), ' ') as ram from ram join tipo_ram ON tipo_ram.id_tipo_ram=ram.id_tipo_ram where cpu.id_ram=ram.id_ram) as ram,CONCAT_WS(' ',t_video.modelo,t_video.capacidad) as tvideo,
/*CONCAT_WS(' ',"Inv:",ups.num_inventario,ups.modelo,ups.capacidad) as ups,*/(SELECT GROUP_CONCAT(DISTINCTROW CONCAT_WS(' ',disco.tipo_disco,disco.tipo_puerto,disco.capacidad), ' ') as discos from disco join detalle_cpu_disco ON detalle_cpu_disco.num_inv_cpu=cpu.num_inventario where detalle_cpu_disco.id_disco=disco.id_disco) as discos,(SELECT GROUP_CONCAT(DISTINCTROW CONCAT_WS(' ',accesorio.num_inv_acc,tipo_accesorio.tipo_accesorio), ' ') from accesorio join detalle_cpu_accesorio ON cpu.num_inventario=detalle_cpu_accesorio.num_inv_cpu JOIN tipo_accesorio ON accesorio.id_taccesorio=tipo_accesorio.id_taccesorio where detalle_cpu_accesorio.num_inv_accesorio=accesorio.num_inv_acc) as accesorios,
(SELECT GROUP_CONCAT(DISTINCTROW CONCAT_WS(' ',ipv4.ip), ' ') from ipv4 join detalle_cpu_ip ON detalle_cpu_ip.num_inv_cpu=cpu.num_inventario where detalle_cpu_ip.id_ip=ipv4.id_ip) as ipv4,
(SELECT GROUP_CONCAT(DISTINCTROW CONCAT_WS(' ',monitor.num_inventario,monitor.tipo_monitor,marca.nombre_marca), ' ') from monitor join detalle_cpu_monitor ON cpu.num_inventario=detalle_cpu_monitor.num_inv_cpu JOIN marca ON monitor.id_marca=marca.id_marca where detalle_cpu_monitor.id_monitor=monitor.id_monitor) as monitores,
edificio.nombre_edificio,departamento.departamento,ubicacion.ubicacion,cpu.observacion FROM cpu 
            INNER JOIN marca ON cpu.id_marca=marca.id_marca
            INNER JOIN clasificacion ON cpu.id_clasificacion=clasificacion.id_clasificacion_cpu
            INNER JOIN tipo_estado ON cpu.id_estado=tipo_estado.id_estado
            INNER JOIN edificio ON cpu.id_edificio=edificio.id_edificio
            INNER JOIN departamento ON cpu.id_depto=departamento.id_departamento
            INNER JOIN ubicacion ON cpu.id_ubicacion=ubicacion.id_ubicacion
            INNER JOIN empleados ON cpu.id_empleado=empleados.id_empleado
            INNER JOIN procesador ON cpu.id_procesador=procesador.id_procesador
            INNER JOIN ram ON cpu.id_ram=ram.id_ram
            INNER JOIN t_video ON cpu.id_tarjeta_v=t_video.id_tarjeta_v
            INNER JOIN usuario_sistema ON cpu.modificado_por=usuario_sistema.id_usuario  order by id_cpu desc$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_CONTADOR_INVENTARIO` (IN `_inventario` VARCHAR(11))   BEGIN
    DECLARE CONTADOR INT;
    DECLARE CONTADOR1 INT;
    DECLARE CONTADOR2 INT;
    DECLARE CONTADOR3 INT;
    DECLARE CONTADOR4 INT;
    DECLARE CONTADOR5 INT;
    DECLARE TOTAL INT;
    
    -- obtener cuantos hay de cada tabla con el mismo num inventario
	SET CONTADOR = (SELECT count(*) from cpu where num_inventario='_inventario');
    
    -- tabla 
    SET CONTADOR1 = (SELECT count(*) from monitor where num_inventario='_inventario');
    
    -- Nos regresa 
    SET CONTADOR2 = (SELECT count(*) from ups where num_inventario='_inventario');
    
    SET CONTADOR3 = (SELECT count(*) from liveu where num_inventario='_inventario');
    
    SET CONTADOR4 = (SELECT count(*) from swt_rt where num_inventario='_inventario');
    
    SET CONTADOR5 = (SELECT count(*) from accesorio where num_inv_acc='_inventario');
    
    -- Nos regresa el total de los supuestos repetidos
    SET TOTAL = (CONTADOR+CONTADOR1+CONTADOR2+CONTADOR3+CONTADOR4+CONTADOR5);
    
    -- bien ahora solo debemos retornar los datos mediante otro SELECT
    SELECT TOTAL AS _total;
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_insert` (IN `cpu` VARCHAR(11), IN `id_soft` INT(11))   BEGIN

DECLARE licencia_id varchar(100);

-- extraer el id_licencia
SET licencia_id=(SELECT id_licencia from licencia where id_software=id_soft);

-- hacer el insert en la tabla detalle
    INSERT INTO detalle_cpu_licencia(`num_inv_cpu`, `id_licencia`) VALUES (cpu,licencia_id);
    
 -- actualizar el campo disponibilidad en la tabla licencia
 	UPDATE `licencia` SET `disponibilidad`=`disponibilidad`-1 WHERE `id_licencia`=licencia_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_insert2` (IN `cpu` VARCHAR(11), IN `id_soft` INT(11))   BEGIN

DECLARE licencia_id varchar(100);

-- extraer el id_licencia
SET licencia_id=(SELECT id_licencia from licencia where id_software=id_soft);

-- hacer el delete en la tabla detalle
   DELETE FROM `detalle_cpu_licencia` WHERE `num_inv_cpu`=cpu and `id_licencia`=licencia_id;
    
 -- actualizar el campo disponibilidad en la tabla licencia
 	UPDATE `licencia` SET `disponibilidad`=`disponibilidad`+1 WHERE `id_licencia`=licencia_id;
END$$

--
-- Funciones
--
CREATE DEFINER=`root`@`localhost` FUNCTION `contar_inventario` (`inventario` VARCHAR(11)) RETURNS INT(10) UNSIGNED  BEGIN
  -- Paso 1. Declaramos una variable local
  DECLARE total INT UNSIGNED;
  DECLARE CONTADOR INT;
  DECLARE CONTADOR1 INT;
  DECLARE CONTADOR2 INT;
  DECLARE CONTADOR4 INT;
  DECLARE CONTADOR5 INT;

  -- Paso 2. Contamos los productos
  SET CONTADOR = (SELECT count(*) from cpu where num_inventario=inventario);
    
    -- tabla 
    SET CONTADOR1 = (SELECT count(*) from monitor where num_inventario=inventario);
    
    -- Nos regresa 
    SET CONTADOR2 = (SELECT count(*) from ups where num_inventario=inventario);
    
    SET CONTADOR4 = (SELECT count(*) from swt_rt where num_inventario=inventario);
    
    SET CONTADOR5 = (SELECT count(*) from accesorio where num_inv_acc=inventario);
    
    SET total = (CONTADOR+CONTADOR1+CONTADOR2+CONTADOR4+CONTADOR5);

  -- Paso 3. Devolvemos el resultado
  RETURN total;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `contar_inventarioaccesorio` (`inventario` VARCHAR(11), `id` INT) RETURNS INT(10) UNSIGNED  BEGIN
  -- Paso 1. Declaramos una variable local
  DECLARE total INT UNSIGNED;
  DECLARE CONTADOR INT;
  DECLARE CONTADOR1 INT;
  DECLARE CONTADOR2 INT;
  DECLARE CONTADOR4 INT;
  DECLARE CONTADOR5 INT;

  -- Paso 2. Contamos los productos
  SET CONTADOR = (SELECT count(*) from cpu where num_inventario=inventario);
    
    -- tabla 
    SET CONTADOR1 = (SELECT count(*) from monitor where num_inventario=inventario);
    
    -- Nos regresa 
    SET CONTADOR2 = (SELECT count(*) from ups where num_inventario=inventario);
    
    SET CONTADOR4 = (SELECT count(*) from swt_rt where num_inventario=inventario);
    
    SET CONTADOR5 = (SELECT count(*) from accesorio where num_inv_acc=inventario and id_accesorio !=id);
    
    SET TOTAL = (CONTADOR+CONTADOR1+CONTADOR2+CONTADOR4+CONTADOR5);

  -- Paso 3. Devolvemos el resultado
  RETURN total;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `contar_inventariocpu` (`inventario` VARCHAR(11), `id` INT) RETURNS INT(10) UNSIGNED  BEGIN
  -- Paso 1. Declaramos una variable local
  DECLARE total INT UNSIGNED;
  DECLARE CONTADOR INT;
  DECLARE CONTADOR1 INT;
  DECLARE CONTADOR2 INT;
  DECLARE CONTADOR4 INT;
  DECLARE CONTADOR5 INT;

  -- Paso 2. Contamos los productos
  SET CONTADOR = (SELECT count(*) from cpu where num_inventario=inventario and id_cpu !=id);
    
    -- tabla 
    SET CONTADOR1 = (SELECT count(*) from monitor where num_inventario=inventario);
    
    -- Nos regresa 
    SET CONTADOR2 = (SELECT count(*) from ups where num_inventario=inventario);
    
    SET CONTADOR4 = (SELECT count(*) from swt_rt where num_inventario=inventario);
    
    SET CONTADOR5 = (SELECT count(*) from accesorio where num_inv_acc=inventario);
    
    SET TOTAL = (CONTADOR+CONTADOR1+CONTADOR2+CONTADOR4+CONTADOR5);

  -- Paso 3. Devolvemos el resultado
  RETURN total;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `contar_inventariomonitor` (`inventario` VARCHAR(11), `id` INT) RETURNS INT(10) UNSIGNED  BEGIN
  -- Paso 1. Declaramos una variable local
  DECLARE total INT UNSIGNED;
  DECLARE CONTADOR INT;
  DECLARE CONTADOR1 INT;
  DECLARE CONTADOR2 INT;
  DECLARE CONTADOR4 INT;
  DECLARE CONTADOR5 INT;

  -- Paso 2. Contamos los productos
  SET CONTADOR = (SELECT count(*) from cpu where num_inventario=inventario);
    
    -- tabla 
    SET CONTADOR1 = (SELECT count(*) from monitor where num_inventario=inventario and id_monitor !=id );
    
    -- Nos regresa 
    SET CONTADOR2 = (SELECT count(*) from ups where num_inventario=inventario);
    
    SET CONTADOR4 = (SELECT count(*) from swt_rt where num_inventario=inventario);
    
    SET CONTADOR5 = (SELECT count(*) from accesorio where num_inv_acc=inventario);
    
    SET TOTAL = (CONTADOR+CONTADOR1+CONTADOR2+CONTADOR4+CONTADOR5);

  -- Paso 3. Devolvemos el resultado
  RETURN total;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `contar_inventarioups` (`inventario` VARCHAR(11), `id` INT) RETURNS INT(10) UNSIGNED  BEGIN
  -- Paso 1. Declaramos una variable local
  DECLARE total INT UNSIGNED;
  DECLARE CONTADOR INT;
  DECLARE CONTADOR1 INT;
  DECLARE CONTADOR2 INT;
  DECLARE CONTADOR4 INT;
  DECLARE CONTADOR5 INT;

  -- Paso 2. Contamos los productos
  SET CONTADOR = (SELECT count(*) from cpu where num_inventario=inventario);
    
    -- tabla 
    SET CONTADOR1 = (SELECT count(*) from monitor where num_inventario=inventario);
    
    -- Nos regresa 
    SET CONTADOR2 = (SELECT count(*) from ups where num_inventario=inventario and id_ups !=id );
    
    SET CONTADOR4 = (SELECT count(*) from swt_rt where num_inventario=inventario);
    
    SET CONTADOR5 = (SELECT count(*) from accesorio where num_inv_acc=inventario);
    
    SET TOTAL = (CONTADOR+CONTADOR1+CONTADOR2+CONTADOR4+CONTADOR5);

  -- Paso 3. Devolvemos el resultado
  RETURN total;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `update_licencia` (`increment` INT(11), `cant_nueva` INT(12)) RETURNS INT(10) UNSIGNED  BEGIN
  -- Paso 1. Declaramos las variables locales
  DECLARE respuesta INT;
  DECLARE cant INT UNSIGNED;
  DECLARE cant_vieja INT;
  DECLARE disponible INT;
  DECLARE ocupadas INT;
  DECLARE nueva_dispo INT;
  
  -- Paso 2. extraer la cantidad vieja
  SET cant_vieja = (SELECT `cantidad` from `licencia` where `incremento`=increment);
  
  -- Paso 3. extraer la disponibilidad
  SET disponible = (SELECT `disponibilidad` from `licencia` where `incremento`=increment);
  
  -- Paso 4. realizar el calculo de ocupadas
  SET ocupadas = (cant_vieja-disponible);
  

  -- Paso 5. Estructura Else If
    IF cant_nueva>ocupadas THEN 
    
        SET nueva_dispo = (cant_nueva-ocupadas);
        
        -- hacer el update con la nueva disponibilidad
        UPDATE `licencia` SET `disponibilidad`=nueva_dispo,`cantidad`=cant_nueva WHERE `incremento`=increment;
        set respuesta=1;
        RETURN respuesta;
        
    ELSEIF cant_nueva<ocupadas THEN 
        set respuesta=0;
        RETURN respuesta;
        
        ELSEIF cant_nueva=ocupadas THEN
        
         SET nueva_dispo = (cant_nueva-ocupadas);
        
        -- hacer el update con la nueva disponibilidad
        UPDATE `licencia` SET `disponibilidad`=nueva_dispo,`cantidad`=cant_nueva WHERE `incremento`=increment;
        
            set respuesta=2;
            RETURN respuesta;
    END IF;
    
    
    
    
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `verificar_inventario` (`inventario` VARCHAR(11), `equipo` VARCHAR(10), `id` INT) RETURNS INT(10) UNSIGNED  BEGIN
  -- Paso 1. Declaramos las variables locales
  DECLARE total INT UNSIGNED;
  DECLARE CONTADOR INT;
  DECLARE CONTADOR1 INT;
  DECLARE CONTADOR2 INT;
  DECLARE CONTADOR3 INT;
  DECLARE CONTADOR4 INT;
  DECLARE CONTADOR5 INT;


  -- Paso 2. Estructura Else If
    IF equipo='cpu' THEN 
    
        SET CONTADOR = (SELECT count(*) from cpu where num_inventario=inventario and id_cpu!=id);
        -- tabla 
        SET CONTADOR1 = (SELECT count(*) from monitor where num_inventario=inventario);
        -- Nos regresa 
        SET CONTADOR2 = (SELECT count(*) from ups where num_inventario=inventario);
        
        
        SET CONTADOR4 = (SELECT count(*) from swt_rt where num_inventario=inventario);
        
        SET CONTADOR5 = (SELECT count(*) from accesorio where num_inv_acc=inventario);
        
    ELSEIF equipo='monitor' THEN 

        SET CONTADOR = (SELECT count(*) from cpu where num_inventario=inventario);
        -- tabla 
        SET CONTADOR1 = (SELECT count(*) from monitor where num_inventario=inventario and id_monitor!=id);
        -- Nos regresa 
        SET CONTADOR2 = (SELECT count(*) from ups where num_inventario=inventario);
        
        
        SET CONTADOR4 = (SELECT count(*) from swt_rt where num_inventario=inventario);
        
        SET CONTADOR5 = (SELECT count(*) from accesorio where num_inv_acc=inventario);
        
    END IF;
    
    SET total = (CONTADOR+CONTADOR1+CONTADOR2+CONTADOR4+CONTADOR5);

    RETURN total;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accesorio`
--

CREATE TABLE `accesorio` (
  `id_accesorio` int(11) NOT NULL,
  `num_inv_acc` varchar(11) NOT NULL,
  `modelo` varchar(45) DEFAULT NULL,
  `descri` varchar(2000) DEFAULT NULL,
  `serie` varchar(45) DEFAULT NULL,
  `id_taccesorio` int(11) DEFAULT NULL,
  `id_marca` int(11) DEFAULT NULL,
  `fecha_compra` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `accesorio`
--

INSERT INTO `accesorio` (`id_accesorio`, `num_inv_acc`, `modelo`, `descri`, `serie`, `id_taccesorio`, `id_marca`, `fecha_compra`) VALUES
(37, '20-233-2179', 'H390', 'NINGUNA', 'GSHy2367', 16, 54, '09-07-2022'),
(39, '20-234-7119', 'OEMR R740', 'NINGUNA', '123456S1S12S', 19, 42, ''),
(42, '20-232-1162', '', 'NINGUNA', 'JUTR5897', 16, 54, ''),
(43, '20-233-3133', '', 'NINGUNA', 'HGTS4572', 16, 54, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_software`
--

CREATE TABLE `categoria_software` (
  `id_categoria` int(11) NOT NULL,
  `categoria` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categoria_software`
--

INSERT INTO `categoria_software` (`id_categoria`, `categoria`) VALUES
(18, 'Sistema Operativo'),
(19, 'Antivirus'),
(21, 'Play-Out'),
(22, 'Suite Ofimática ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clasificacion`
--

CREATE TABLE `clasificacion` (
  `id_clasificacion_cpu` int(11) NOT NULL,
  `nombre_clasif` varchar(45) NOT NULL COMMENT 'La orientacion o tarea a la que se dedica el cpu.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `clasificacion`
--

INSERT INTO `clasificacion` (`id_clasificacion_cpu`, `nombre_clasif`) VALUES
(34, 'Editora'),
(35, 'Desktop'),
(36, 'Laptop'),
(37, 'Servidor'),
(38, 'AIO'),
(39, 'Laptop20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clasificacion_licencia`
--

CREATE TABLE `clasificacion_licencia` (
  `id_clasificacion` int(11) NOT NULL,
  `clasificacion` varchar(45) NOT NULL,
  `tipo_identificador` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `clasificacion_licencia`
--

INSERT INTO `clasificacion_licencia` (`id_clasificacion`, `clasificacion`, `tipo_identificador`) VALUES
(14, 'Corporativa', 'ID'),
(15, 'OEM', 'ID'),
(20, 'Dongol', 'ID');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cpu`
--

CREATE TABLE `cpu` (
  `id_cpu` int(11) NOT NULL,
  `num_inventario` varchar(11) NOT NULL,
  `id_marca` int(11) DEFAULT NULL,
  `modelo` varchar(40) DEFAULT NULL,
  `id_clasificacion` int(11) DEFAULT NULL COMMENT '1=render, 2=audio, 3=desktop, 4=editoraM, 5=ENL, 6=GenCar, 7=loop, 8=prompter, 9=servidor, 10=Vizuali, 11=animacion, 12=portatil, 13=serv Play Out',
  `serv_tag` varchar(45) DEFAULT NULL,
  `garantia` varchar(45) DEFAULT NULL,
  `id_estado` int(11) DEFAULT NULL,
  `id_empleado` int(11) DEFAULT NULL COMMENT 'Se refiere al operador de la máquina\r\n',
  `nombre_cpu` varchar(45) NOT NULL,
  `usuario_windows` varchar(50) NOT NULL,
  `fecha_ingreso` varchar(40) NOT NULL,
  `id_procesador` int(11) DEFAULT NULL,
  `id_ram` int(11) DEFAULT NULL,
  `id_tarjeta_v` int(11) DEFAULT NULL,
  `id_ups` int(11) DEFAULT NULL,
  `id_edificio` int(11) DEFAULT NULL,
  `id_depto` int(11) DEFAULT NULL,
  `id_ubicacion` int(11) DEFAULT NULL,
  `observacion` varchar(500) DEFAULT NULL,
  `modificado_por` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cpu`
--

INSERT INTO `cpu` (`id_cpu`, `num_inventario`, `id_marca`, `modelo`, `id_clasificacion`, `serv_tag`, `garantia`, `id_estado`, `id_empleado`, `nombre_cpu`, `usuario_windows`, `fecha_ingreso`, `id_procesador`, `id_ram`, `id_tarjeta_v`, `id_ups`, `id_edificio`, `id_depto`, `id_ubicacion`, `observacion`, `modificado_por`) VALUES
(190, '20-233-1168', 30, 'Precision 5820', 34, '2HC3L02', '2022/09/07 - 2025/01/26', 18, 14, 'EU_Producción', 'EU_Producción', '2023-05-07', 11, 28, 31, 73, 13, 25, 25, 'NINGUNA', 24),
(191, '20-234-4169', 30, 'Precision 5820', 35, '2H95L02', '2022/09/07 - 2025/01/26', 17, 16, 'EU_Redaccion', 'EU_Redaccion', '2023-05-07', 12, 26, 29, 77, 16, 41, 41, 'NINGUNA', 18),
(192, '20-233-5253', 30, 'PRECISION 3650', 34, 'FPCZDF3', '2022/09/07 - 2025/01/26', 17, 20, 'EU_Cabina_Prod', 'EU_Cabina_Prod', '2023-05-07', 12, 26, 29, 75, 18, 29, 28, 'NINGUNA', 18),
(193, '20-234-5232', 30, 'Precision 7610', 35, 'JXH2WM3', '2022/09/07 - 2025/01/26', 17, 15, 'EU_Promo', 'EU_Promo', '2023-05-07', 12, 26, 31, 76, 20, 33, 31, 'NINGUNA', 18);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

CREATE TABLE `departamento` (
  `id_departamento` int(11) NOT NULL,
  `departamento` varchar(45) NOT NULL COMMENT 'el nombre del area laboral de la empresa',
  `id_edificio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `departamento`
--

INSERT INTO `departamento` (`id_departamento`, `departamento`, `id_edificio`) VALUES
(16, 'Suave', 13),
(17, 'Exitos', 13),
(18, '94.1', 13),
(19, 'Rock N Pop', 13),
(20, 'Vox FM', 13),
(21, 'Radio Centro', 13),
(22, 'Satelite', 13),
(23, 'XY 90.5', 13),
(25, 'HRN', 13),
(26, 'Continuidad', 13),
(27, 'Estudio A', 13),
(28, 'Estudio B', 13),
(29, 'Radio Caliente', 18),
(30, 'Producción Musical', 13),
(31, 'Radio Choluteca', 18),
(32, 'Cabina Suave', 13),
(33, 'Radio Norte', 20),
(34, 'XY 90.5', 20),
(35, 'Recepción', 13),
(36, 'Sistemas', 13),
(37, 'Taller Técnico', 13),
(38, 'Ventas', 13),
(39, 'Cuarto Transmisión', 13),
(40, 'Gerencia', 13),
(41, 'Radio Caribe', 16),
(42, 'Cabina Producción', 13),
(43, 'IT', 13),
(44, 'Estudio Producción', 13),
(45, 'Producción HRN', 13);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_cpu_accesorio`
--

CREATE TABLE `detalle_cpu_accesorio` (
  `id_detalle` int(11) NOT NULL,
  `num_inv_cpu` varchar(11) NOT NULL,
  `num_inv_accesorio` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detalle_cpu_accesorio`
--

INSERT INTO `detalle_cpu_accesorio` (`id_detalle`, `num_inv_cpu`, `num_inv_accesorio`) VALUES
(33, '20-233-1168', '20-233-2179'),
(34, '20-233-5253', '20-234-7119'),
(35, '20-234-4169', '20-232-1162'),
(36, '20-234-5232', '20-233-3133');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_cpu_disco`
--

CREATE TABLE `detalle_cpu_disco` (
  `id_detalle` int(11) NOT NULL,
  `id_disco` int(11) NOT NULL,
  `num_inv_cpu` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detalle_cpu_disco`
--

INSERT INTO `detalle_cpu_disco` (`id_detalle`, `id_disco`, `num_inv_cpu`) VALUES
(170, 24, '20-233-5253'),
(171, 22, '20-234-5232'),
(172, 24, '20-234-4169'),
(173, 22, '20-233-1168');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_cpu_ip`
--

CREATE TABLE `detalle_cpu_ip` (
  `id_det_ip` int(11) NOT NULL,
  `num_inv_cpu` varchar(11) NOT NULL,
  `id_ip` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detalle_cpu_ip`
--

INSERT INTO `detalle_cpu_ip` (`id_det_ip`, `num_inv_cpu`, `id_ip`) VALUES
(101, '20-233-5253', 37),
(102, '20-234-5232', 41),
(103, '20-234-4169', 40),
(104, '20-233-1168', 39);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_cpu_licencia`
--

CREATE TABLE `detalle_cpu_licencia` (
  `id_detalle` int(11) NOT NULL,
  `num_inv_cpu` varchar(11) NOT NULL,
  `id_licencia` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detalle_cpu_licencia`
--

INSERT INTO `detalle_cpu_licencia` (`id_detalle`, `num_inv_cpu`, `id_licencia`) VALUES
(327, '20-233-1168', 'Inscripcion '),
(328, '20-233-1168', 'Licencia Por Hardware'),
(329, '20-233-1168', 'Propiedad de Fabricante '),
(330, '20-234-4169', 'Inscripcion '),
(331, '20-234-4169', 'Licencia Por Hardware'),
(332, '20-234-4169', 'Propiedad de Fabricante '),
(333, '20-232-3138', 'Inscripcion '),
(334, '20-232-3138', 'Licencia Por Hardware'),
(335, '20-232-3138', 'Propiedad de Fabricante '),
(336, '20-233-5253', 'Inscripcion '),
(337, '20-233-5253', 'Licencia Por Hardware'),
(338, '20-233-5253', 'Propiedad de Fabricante '),
(339, '20-234-5232', 'Inscripcion '),
(340, '20-234-5232', 'Licencia Por Hardware'),
(341, '20-234-5232', 'Propiedad de Fabricante ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_cpu_monitor`
--

CREATE TABLE `detalle_cpu_monitor` (
  `id_detalle` int(11) NOT NULL,
  `num_inv_cpu` varchar(11) NOT NULL,
  `id_monitor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detalle_cpu_monitor`
--

INSERT INTO `detalle_cpu_monitor` (`id_detalle`, `num_inv_cpu`, `id_monitor`) VALUES
(86, '20-233-5253', 51),
(87, '20-234-5232', 52),
(88, '20-234-4169', 50),
(89, '20-233-1168', 48);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `disco`
--

CREATE TABLE `disco` (
  `id_disco` int(11) NOT NULL,
  `tipo_disco` varchar(45) NOT NULL,
  `tipo_puerto` varchar(45) NOT NULL,
  `capacidad` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `disco`
--

INSERT INTO `disco` (`id_disco`, `tipo_disco`, `tipo_puerto`, `capacidad`) VALUES
(22, 'SSD', 'Sata', '1TB'),
(23, 'SSD', 'Sata', '256GB'),
(24, 'HDD', 'Sata', '500GB'),
(25, 'HDD', 'Sata', '2TB'),
(26, 'HDD', 'Sata', '320GB'),
(27, 'HDD', 'Sata', '250TB'),
(28, 'HDD', 'Sata', '160GB'),
(29, 'HDD', 'Sata', '80GB'),
(30, 'Flash', 'Sata', '8GB'),
(31, 'HDD', 'Sata', '4GB'),
(32, 'HDD', 'Sata', '1 TB'),
(36, 'Flash', 'M2', '500 GB');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `edificio`
--

CREATE TABLE `edificio` (
  `id_edificio` int(11) NOT NULL,
  `nombre_edificio` varchar(60) NOT NULL COMMENT 'colocar el nombre del ediificio y la ciudad donde se encuentra dicho edificio.'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `edificio`
--

INSERT INTO `edificio` (`id_edificio`, `nombre_edificio`) VALUES
(13, 'Emisoras Unidas'),
(16, 'Caribe'),
(18, 'SUR'),
(20, 'Norte');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `id_empleado` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `apellido` varchar(20) NOT NULL,
  `telefono` varchar(9) NOT NULL,
  `correo` varchar(30) NOT NULL,
  `id_departamento` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id_empleado`, `nombre`, `apellido`, `telefono`, `correo`, `id_departamento`) VALUES
(7, 'Wilson', 'Mendez', '', '', 43),
(13, 'Douglas', 'Diaz', '', '', 43),
(14, 'Marciel ', 'Gomez', '', '', 45),
(15, 'Guiseppe ', 'Santana', '', '', 45),
(16, 'Pamela', 'Figueroa', '', '', 45),
(17, 'Karen ', 'Reyes', '', '', 45),
(18, 'Mary', 'Ramirez', '', '', 45),
(19, 'Yessica', 'Mass', '', '', 45),
(20, 'Jari', 'Barahona', '', '', 45),
(21, 'Javier', 'Bardales', '', '', 43),
(22, 'Rosendo ', 'Garcia', '', '', 45);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipo`
--

CREATE TABLE `equipo` (
  `id_equipo` int(11) NOT NULL,
  `num_inventario` varchar(11) NOT NULL,
  `descripcion` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `equipo`
--

INSERT INTO `equipo` (`id_equipo`, `num_inventario`, `descripcion`) VALUES
(123, '20-233-2179', 'ACCESORIO'),
(124, '20-232-2128', 'ACCESORIO'),
(125, '20-234-7119', 'ACCESORIO'),
(126, '20-231-7110', 'ACCESORIO'),
(127, '20-233-0107', 'ACCESORIO'),
(128, '20-235-9110', 'UPS'),
(129, '20-233-1837', 'MONITOR'),
(130, '20-235-8123', 'MONITOR'),
(131, '20-232-1186', 'CPU'),
(132, '20-234-2184', 'CPU'),
(133, '20-233-1168', 'CPU'),
(134, '20-234-4169', 'CPU'),
(135, '20-234-8146', 'MONITOR'),
(136, '20-233-5253', 'CPU'),
(137, '20-235-7022', 'MONITOR'),
(138, '20-232-4259', 'MONITOR'),
(139, '20-234-5232', 'CPU'),
(140, '20-232-1162', 'ACCESORIO'),
(141, '20-233-3133', 'ACCESORIO'),
(142, '20-232-934_', 'UPS'),
(143, '20-232-8119', 'UPS'),
(144, '20-235-0234', 'UPS'),
(145, '20-232-6200', 'UPS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ipv4`
--

CREATE TABLE `ipv4` (
  `id_ip` int(11) NOT NULL,
  `ip` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ipv4`
--

INSERT INTO `ipv4` (`id_ip`, `ip`) VALUES
(37, '192.168.0.10'),
(42, '192.168.0.12'),
(39, '192.168.0.14'),
(40, '192.168.0.15'),
(41, '192.168.0.17');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `ip_desocupadas`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `ip_desocupadas` (
`id_ip` int(11)
,`ip` varchar(45)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `ip_ocupadas`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `ip_ocupadas` (
`id_ip` int(11)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `licencia`
--

CREATE TABLE `licencia` (
  `id_licencia` varchar(100) NOT NULL,
  `id_clasificacion` int(12) DEFAULT NULL,
  `id_software` int(12) DEFAULT NULL,
  `duracion` int(10) NOT NULL,
  `recurrente` varchar(2) DEFAULT NULL,
  `cantidad` int(12) NOT NULL,
  `disponibilidad` int(11) NOT NULL,
  `nota` varchar(100) NOT NULL,
  `dia` int(11) DEFAULT NULL COMMENT 'fecha de compra',
  `mes` int(11) DEFAULT NULL COMMENT 'fecha de compra',
  `anio` int(11) DEFAULT NULL COMMENT 'fecha de compra',
  `incremento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `licencia`
--

INSERT INTO `licencia` (`id_licencia`, `id_clasificacion`, `id_software`, `duracion`, `recurrente`, `cantidad`, `disponibilidad`, `nota`, `dia`, `mes`, `anio`, `incremento`) VALUES
('Inscripcion ', 14, 61, 12, 'SI', 120, 115, 'N/A', 25, 12, 2022, 60),
('Licencia Por Hardware', 20, 63, 0, 'NO', 40, 35, 'N/A', 5, 9, 2022, 63),
('Por el Hardware', 15, 47, 0, 'NO', 4, 4, 'N/A', 20, 11, 2020, 61),
('Por Fabricante ', 15, 60, 0, 'NO', 55, 55, 'N/A', 6, 10, 2020, 62),
('Propiedad de Fabricante ', 15, 48, 0, 'NO', 90, 85, 'N/A', 1, 1, 2015, 59);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mantenimiento`
--

CREATE TABLE `mantenimiento` (
  `id_mantenimiento` int(11) NOT NULL,
  `tipo_equipo` varchar(11) NOT NULL,
  `num_inventario` varchar(11) NOT NULL COMMENT 'el id del equipo que se le brinda mantenimiento, cpu, liveu etc.',
  `fecha` varchar(40) NOT NULL,
  `precio` varchar(11) NOT NULL,
  `id_departamento` int(11) DEFAULT NULL,
  `estado` varchar(40) DEFAULT NULL COMMENT 'entregado o pendiente de entrega',
  `observaciones` varchar(120) NOT NULL,
  `tipo_mantenimiento` varchar(21) NOT NULL COMMENT 'preventivo\ncorrectivo\n'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `mantenimiento`
--

INSERT INTO `mantenimiento` (`id_mantenimiento`, `tipo_equipo`, `num_inventario`, `fecha`, `precio`, `id_departamento`, `estado`, `observaciones`, `tipo_mantenimiento`) VALUES
(8, 'Monitor', '20-231-1212', '05/03/2023', '1200.00', 16, 'Entregado', 'Se daño led izquierdo', 'Correctivo'),
(9, 'Accesorios', '20-233-2179', '05/03/2023', '', 17, 'Reparacion', '', 'Preventivo'),
(10, 'Ups', '20-232-7175', '02/22/2023', '1200.00', 34, 'Reparacion', 'Cambio de Baterias ', 'Correctivo'),
(11, 'Ups', '20-232-7175', '05/02/2023', '33', 23, 'Entregado', 'Nuevamente bateria', 'Preventivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca`
--

CREATE TABLE `marca` (
  `id_marca` int(11) NOT NULL,
  `nombre_marca` varchar(25) NOT NULL COMMENT 'Todas las marcas disponibles para todos los equipos.'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `marca`
--

INSERT INTO `marca` (`id_marca`, `nombre_marca`) VALUES
(30, 'Dell'),
(31, 'Lenovo'),
(32, 'Genérica '),
(33, 'HP'),
(34, 'ONE'),
(35, 'QBEX'),
(36, 'Intel'),
(37, 'AMD'),
(38, 'NVIDIA'),
(39, 'Sweetwater'),
(40, 'Compaq'),
(41, 'Toshiba'),
(42, 'Sony'),
(43, 'Kinstong'),
(44, 'Microsoft'),
(45, 'Apple'),
(46, 'Google'),
(47, 'ESET'),
(48, 'APC'),
(51, 'HARDATA'),
(52, 'Tripp_Lite'),
(53, 'LinkSys'),
(54, 'logitech');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `monitor`
--

CREATE TABLE `monitor` (
  `id_monitor` int(11) NOT NULL,
  `num_inventario` varchar(11) NOT NULL,
  `id_marca` int(11) DEFAULT NULL,
  `serie` varchar(45) DEFAULT NULL,
  `serv_tag` varchar(45) DEFAULT NULL,
  `tamano` varchar(45) DEFAULT NULL,
  `tipo_monitor` varchar(45) DEFAULT NULL,
  `observacion` varchar(800) DEFAULT NULL,
  `fecha_compra` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `monitor`
--

INSERT INTO `monitor` (`id_monitor`, `num_inventario`, `id_marca`, `serie`, `serv_tag`, `tamano`, `tipo_monitor`, `observacion`, `fecha_compra`) VALUES
(48, '20-231-1212', 30, '', 'WEFWEFWE', '24', 'LCD', 'NINGUNA', ''),
(50, '20-235-8123', 33, '123456', 'GENERICO', '22', 'LED', 'NINGUNA', ''),
(51, '20-234-8146', 30, '', '', '24\"', 'LCD', 'NINGUNA', ''),
(52, '20-235-7022', 30, '', '', '24\"', 'LED', 'NINGUNA', ''),
(53, '20-232-4259', 30, '', '', '24\"', 'LCD', 'NINGUNA', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `procesador`
--

CREATE TABLE `procesador` (
  `id_procesador` int(11) NOT NULL,
  `fabricante` varchar(45) NOT NULL,
  `modelo` varchar(45) NOT NULL,
  `generacion` varchar(45) NOT NULL,
  `velocidad` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `procesador`
--

INSERT INTO `procesador` (`id_procesador`, `fabricante`, `modelo`, `generacion`, `velocidad`) VALUES
(11, 'Intel', 'Xeon', 'E5620', '2,4GHZ'),
(12, 'Intel', 'Xeon', 'E5-2403', '2,4GHZ'),
(13, 'Intel', 'Xeon', 'E5-2620', '2.0GHz'),
(14, 'Intel', 'Core i7', '8265U', '1.6GHz'),
(15, 'Intel', 'Pentium', 'N3700', '1.6GHz'),
(17, 'Intel', 'Core Duo', 'E 4800', '3.0 GHz'),
(18, 'Intel', 'Core Duo', 'E 8500', '3.17 Ghz'),
(19, 'Intel', 'Xeon', 'E1240', '3.50GHz'),
(20, 'Intel', 'Core i5', '11', '3.10GHz'),
(21, 'Intel', 'Core i3', '7100', '3.90GHz'),
(22, 'NVIDIA', 'Tegra', '4', '1.6GHz'),
(23, 'Intel', 'Celeron', '', '2.4GHz'),
(24, 'Intel', 'Core', '', '2.60GHz'),
(25, 'Intel', 'Core i7', '4790', '3.60GHz'),
(26, 'Intel', '2 Duo', '', '2.93GHz'),
(27, 'Intel', 'Core i5', '', '3.2GHz'),
(28, 'Intel', 'i3', '', '3.5GHz'),
(29, 'Intel', 'Core i7', '', '3.20Ghz'),
(30, 'Intel', 'Xeon', '', '2.3Ghz'),
(31, 'Intel', 'Core Duo', '', '3.2 Ghz'),
(32, 'Intel', 'Core i3', '', '2.3 Ghz'),
(33, 'Intel', 'Dual Core', '', '2.5Ghz'),
(34, 'Intel', 'Xeon Dual Core', '', '2.0GHz'),
(35, 'Intel', 'Pentium ', '4', '3.4GHz'),
(37, 'Intel', 'Core i5', '', ''),
(38, 'Dell', 'Core i6', 'asd', ''),
(39, 'Dell20', 'Core i3 3.70GHz', '4ta', '3.10GHz');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ram`
--

CREATE TABLE `ram` (
  `id_ram` int(11) NOT NULL,
  `id_tipo_ram` int(11) DEFAULT NULL,
  `capacidad` varchar(30) NOT NULL COMMENT 'total de almacenamiento',
  `frecuencia` varchar(20) NOT NULL,
  `observaciones` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ram`
--

INSERT INTO `ram` (`id_ram`, `id_tipo_ram`, `capacidad`, `frecuencia`, `observaciones`) VALUES
(26, 23, '8', '3200', 'NINGUNA'),
(27, 24, '4', '1600', 'NINGUNA'),
(28, 23, '16GB', '3200MHz', '2 módulos de 8GB'),
(34, 21, '2GB', '1600GHz', 'NINGUNA'),
(35, 28, '2GB', '320GHz', 'NINGUNA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `software`
--

CREATE TABLE `software` (
  `id_software` int(11) NOT NULL,
  `producto` varchar(45) NOT NULL,
  `id_marca` int(11) DEFAULT NULL,
  `edicion` varchar(45) DEFAULT NULL,
  `version_` varchar(45) DEFAULT NULL,
  `id_categoria` int(11) DEFAULT NULL,
  `nota` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `software`
--

INSERT INTO `software` (`id_software`, `producto`, `id_marca`, `edicion`, `version_`, `id_categoria`, `nota`) VALUES
(46, 'Sistema Operativo', 44, 'Professional', '7', 18, 'NINGUNA'),
(47, 'Windows Server', 44, '2022', 'R2', 18, 'NINGUNA'),
(48, 'Sistema Operativo', 44, 'Professional', '10', 18, 'Español'),
(49, 'Windows Server', 44, '2019', 'R2', 18, 'NINGUNA'),
(57, 'Microsoft Office', 44, '2010', '2010', 22, 'NINGUNA'),
(58, 'Microsoft Office', 44, '2012', '2013', 22, 'NINGUNA'),
(59, 'Microsoft Office', 44, '2015', '2016', 22, 'NINGUNA'),
(60, 'Sistema Operativo', 44, 'Profesional', '11', 18, 'NINGUNA'),
(61, 'Smart Security Premium', 47, 'Seguridad Premium 2023', '9.0', 19, 'NINGUNA'),
(63, 'HDX RADIO', 51, '2023', 'R4', 21, 'NINGUNA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `swt_rt`
--

CREATE TABLE `swt_rt` (
  `id_swt_rt` int(11) NOT NULL,
  `num_inventario` varchar(11) NOT NULL,
  `nombre_equipo` varchar(52) NOT NULL COMMENT 'Definir si se refiere a un router o un switch.',
  `id_depto` int(11) DEFAULT NULL,
  `id_marca` int(11) DEFAULT NULL,
  `id_ip` int(11) DEFAULT NULL,
  `id_estado` int(11) DEFAULT NULL COMMENT 'operando o bodega',
  `modelo` varchar(50) DEFAULT NULL,
  `serial` varchar(50) DEFAULT NULL,
  `cant_puertos` int(11) DEFAULT NULL,
  `port_dispo` int(11) DEFAULT NULL,
  `tipo_equipo` varchar(10) DEFAULT NULL COMMENT 'Definir si es router o switch',
  `nota` varchar(220) DEFAULT NULL COMMENT 'Datos especificos del equipo:\nspf\nusuario\npassword\nred fisica',
  `descripcion` varchar(220) DEFAULT NULL,
  `pass` varchar(400) NOT NULL,
  `usuario` varchar(220) NOT NULL,
  `d_ubicacion` varchar(220) NOT NULL,
  `red` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `swt_rt`
--

INSERT INTO `swt_rt` (`id_swt_rt`, `num_inventario`, `nombre_equipo`, `id_depto`, `id_marca`, `id_ip`, `id_estado`, `modelo`, `serial`, `cant_puertos`, `port_dispo`, `tipo_equipo`, `nota`, `descripcion`, `pass`, `usuario`, `d_ubicacion`, `red`) VALUES
(53, '20-235-1198', '', 43, 30, 37, 17, 'GS1200HG', 'GSR1548', 12, 12, 'Switch', NULL, '', '', '', 'RACK IT', 0),
(55, '20-235-1155', 'ITRADIO', 43, 53, 42, 17, 'OEMR R200', 'DR78h42', 1, 3, 'Router', NULL, '', 'ddiaz', 'ddiaz', 'Rack de IT', 0),
(56, '20-234-3155', '', 25, 33, 39, 17, 'ProtFR87', '12HSD456', 20, 4, 'Switch', NULL, '', '', '', 'Estación de Radio HRN', 0),
(57, '20-231-0126', 'EUInvitados', 25, 53, 40, 17, 'MR500', 'AX500', 1, 6, 'Router', NULL, '', 'ddiaz', 'ddiaz', '', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_accesorio`
--

CREATE TABLE `tipo_accesorio` (
  `id_taccesorio` int(11) NOT NULL,
  `tipo_accesorio` varchar(45) NOT NULL COMMENT 'nombre del accesorio del cpu o de cualquier otro equipo.'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_accesorio`
--

INSERT INTO `tipo_accesorio` (`id_taccesorio`, `tipo_accesorio`) VALUES
(16, 'Altavoces'),
(17, 'Headset'),
(18, 'Scanner'),
(19, 'Microfono');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_estado`
--

CREATE TABLE `tipo_estado` (
  `id_estado` int(11) NOT NULL,
  `nombre_estado` varchar(45) NOT NULL COMMENT 'contiene el nombre del tipo de estado que puede contener cualquier equipo o estructura.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipo_estado`
--

INSERT INTO `tipo_estado` (`id_estado`, `nombre_estado`) VALUES
(17, 'Activo'),
(18, 'Pasivo'),
(19, 'Prestamo'),
(20, 'Desechado'),
(21, 'ACTIVO20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_ram`
--

CREATE TABLE `tipo_ram` (
  `id_tipo_ram` int(11) NOT NULL,
  `tipo_ram` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipo_ram`
--

INSERT INTO `tipo_ram` (`id_tipo_ram`, `tipo_ram`) VALUES
(21, 'DDR3'),
(22, 'DDR1'),
(23, 'DDR4'),
(24, 'DDR2'),
(25, 'DDR5'),
(28, 'DDR10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_video`
--

CREATE TABLE `t_video` (
  `id_tarjeta_v` int(11) NOT NULL,
  `id_marca` int(11) DEFAULT NULL,
  `modelo` varchar(45) NOT NULL,
  `capacidad` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `t_video`
--

INSERT INTO `t_video` (`id_tarjeta_v`, `id_marca`, `modelo`, `capacidad`) VALUES
(27, 36, 'Quadro FX 3600', '4GB'),
(29, 36, 'GeForce RTX ', '4GB'),
(30, 36, 'INTEGRADA', '1GB'),
(31, 36, 'RTX A2000', '4GB');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubicacion`
--

CREATE TABLE `ubicacion` (
  `id_ubicacion` int(11) NOT NULL,
  `id_departamento` int(11) NOT NULL,
  `ubicacion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ubicacion`
--

INSERT INTO `ubicacion` (`id_ubicacion`, `id_departamento`, `ubicacion`) VALUES
(19, 43, 'Tegucigalpa'),
(20, 31, 'Choluteca'),
(21, 23, 'Tegucigalpa'),
(22, 26, 'Tegucigalpa'),
(23, 27, 'Tegucigalpa'),
(24, 28, 'Tegucigalpa'),
(25, 25, 'Tegucigalpa'),
(26, 22, 'Tegucigalpa'),
(27, 20, 'Tegucigalpa'),
(28, 29, 'Choluteca'),
(29, 19, 'Tegucigalpa'),
(30, 30, 'Tegucigalpa'),
(31, 33, 'San Pedro Sula'),
(32, 34, 'San Pedro Sula'),
(41, 41, 'La Ceiba'),
(44, 45, 'Tegucigalpa'),
(45, 17, 'Tegucigalpa'),
(46, 18, 'Tegucigalpa'),
(47, 21, 'Tegucigalpa'),
(48, 16, 'Tegucigalpa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ups`
--

CREATE TABLE `ups` (
  `id_ups` int(11) NOT NULL,
  `num_inventario` varchar(11) NOT NULL,
  `id_marca` int(11) DEFAULT NULL,
  `modelo` varchar(45) DEFAULT NULL,
  `capacidad` varchar(45) DEFAULT NULL,
  `fecha_compra` varchar(50) NOT NULL,
  `observacion` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ups`
--

INSERT INTO `ups` (`id_ups`, `num_inventario`, `id_marca`, `modelo`, `capacidad`, `fecha_compra`, `observacion`) VALUES
(73, '20-232-7175', 45, 'APC1200', '1200VA', '', 'NINGUNA'),
(75, '20-231-2411', 45, 'APC500', '500VA', '', 'NINGUNA'),
(76, '20-232-8119', 52, 'BJK200', '600VA', '', 'NINGUNA'),
(77, '20-235-0234', 52, 'BJK200', '600VA', '', 'NINGUNA'),
(78, '20-232-6200', 48, 'ZP500', '500VA', '', 'NINGUNA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_sistema`
--

CREATE TABLE `usuario_sistema` (
  `id_usuario` int(11) NOT NULL,
  `nombre_usu` varchar(45) DEFAULT NULL,
  `pass` varchar(150) DEFAULT NULL,
  `id_empleado` int(11) DEFAULT NULL,
  `tipo_usuario` varchar(45) DEFAULT NULL,
  `estado` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario_sistema`
--

INSERT INTO `usuario_sistema` (`id_usuario`, `nombre_usu`, `pass`, `id_empleado`, `tipo_usuario`, `estado`) VALUES
(17, 'jbardales', '32f3e48157637fa553e887d31fc90684bb32fff49e32b88392297632ce98670274e1533840b5dc43b0428ab7fefdc97c9227da8bd361391f688a2b92c46230de', 21, 'admin', '1'),
(18, 'wmendez', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 7, 'admin', '1'),
(24, 'ddiaz', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 13, 'tecnico', '1');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_licencia`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_licencia` (
`cant_lic` int(1)
,`fabricante` int(1)
,`id_licencia` int(1)
,`nombre` int(1)
,`descripcion` int(1)
,`fecha_adqui` int(1)
,`fecha_vence` int(1)
,`clave` int(1)
,`usuario_lic` int(1)
,`pass` int(1)
,`pag_web` int(1)
,`tipo_contrato` int(1)
,`usadas``usadas` int(1)
);

-- --------------------------------------------------------

--
-- Estructura para la vista `ip_desocupadas`
--
DROP TABLE IF EXISTS `ip_desocupadas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ip_desocupadas`  AS SELECT `i`.`id_ip` AS `id_ip`, `i`.`ip` AS `ip` FROM `ipv4` AS `i` WHERE !(`i`.`id_ip` in (select `ip_ocupadas`.`id_ip` from `ip_ocupadas`))  ;

-- --------------------------------------------------------

--
-- Estructura para la vista `ip_ocupadas`
--
DROP TABLE IF EXISTS `ip_ocupadas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ip_ocupadas`  AS SELECT `detalle_cpu_ip`.`id_ip` AS `id_ip` FROM `detalle_cpu_ip` union select `swt_rt`.`id_ip` AS `ip` from `swt_rt`  ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_licencia`
--
DROP TABLE IF EXISTS `vista_licencia`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_licencia`  AS SELECT 1 AS `cant_lic`, 1 AS `fabricante`, 1 AS `id_licencia`, 1 AS `nombre`, 1 AS `descripcion`, 1 AS `fecha_adqui`, 1 AS `fecha_vence`, 1 AS `clave`, 1 AS `usuario_lic`, 1 AS `pass`, 1 AS `pag_web`, 1 AS `tipo_contrato`, 1 AS `usadas``usadas``usadas``usadas`  ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `accesorio`
--
ALTER TABLE `accesorio`
  ADD PRIMARY KEY (`id_accesorio`),
  ADD KEY `id_taccesorio` (`id_taccesorio`),
  ADD KEY `id_marca` (`id_marca`);

--
-- Indices de la tabla `categoria_software`
--
ALTER TABLE `categoria_software`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `clasificacion`
--
ALTER TABLE `clasificacion`
  ADD PRIMARY KEY (`id_clasificacion_cpu`);

--
-- Indices de la tabla `clasificacion_licencia`
--
ALTER TABLE `clasificacion_licencia`
  ADD PRIMARY KEY (`id_clasificacion`);

--
-- Indices de la tabla `cpu`
--
ALTER TABLE `cpu`
  ADD PRIMARY KEY (`id_cpu`),
  ADD KEY `id_marca` (`id_marca`),
  ADD KEY `id_clasificacion` (`id_clasificacion`),
  ADD KEY `id_procesador` (`id_procesador`),
  ADD KEY `id_edificio` (`id_edificio`),
  ADD KEY `id_empleado` (`id_empleado`),
  ADD KEY `id_ram` (`id_ram`),
  ADD KEY `id_estado` (`id_estado`),
  ADD KEY `id_tarjeta_v` (`id_tarjeta_v`),
  ADD KEY `id_depto` (`id_ubicacion`),
  ADD KEY `id_ups` (`id_ups`),
  ADD KEY `modificado_por` (`modificado_por`),
  ADD KEY `id_depto_2` (`id_depto`);

--
-- Indices de la tabla `departamento`
--
ALTER TABLE `departamento`
  ADD PRIMARY KEY (`id_departamento`),
  ADD KEY `fk_departamento_edificio` (`id_edificio`);

--
-- Indices de la tabla `detalle_cpu_accesorio`
--
ALTER TABLE `detalle_cpu_accesorio`
  ADD PRIMARY KEY (`id_detalle`);

--
-- Indices de la tabla `detalle_cpu_disco`
--
ALTER TABLE `detalle_cpu_disco`
  ADD PRIMARY KEY (`id_detalle`),
  ADD KEY `fk_detalle_disco` (`id_disco`);

--
-- Indices de la tabla `detalle_cpu_ip`
--
ALTER TABLE `detalle_cpu_ip`
  ADD PRIMARY KEY (`id_det_ip`),
  ADD KEY `fk_cpu_ip` (`id_ip`);

--
-- Indices de la tabla `detalle_cpu_licencia`
--
ALTER TABLE `detalle_cpu_licencia`
  ADD PRIMARY KEY (`id_detalle`),
  ADD KEY `fk_detalle_licencia` (`id_licencia`);

--
-- Indices de la tabla `detalle_cpu_monitor`
--
ALTER TABLE `detalle_cpu_monitor`
  ADD PRIMARY KEY (`id_detalle`),
  ADD KEY `num_inv_cpu` (`id_monitor`);

--
-- Indices de la tabla `disco`
--
ALTER TABLE `disco`
  ADD PRIMARY KEY (`id_disco`);

--
-- Indices de la tabla `edificio`
--
ALTER TABLE `edificio`
  ADD PRIMARY KEY (`id_edificio`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id_empleado`),
  ADD KEY `id_edificio` (`id_departamento`);

--
-- Indices de la tabla `equipo`
--
ALTER TABLE `equipo`
  ADD PRIMARY KEY (`id_equipo`);

--
-- Indices de la tabla `ipv4`
--
ALTER TABLE `ipv4`
  ADD PRIMARY KEY (`id_ip`),
  ADD UNIQUE KEY `ip` (`ip`);

--
-- Indices de la tabla `licencia`
--
ALTER TABLE `licencia`
  ADD PRIMARY KEY (`id_licencia`),
  ADD UNIQUE KEY `incremento` (`incremento`),
  ADD KEY `id_clasificacion` (`id_clasificacion`),
  ADD KEY `id_software` (`id_software`);

--
-- Indices de la tabla `mantenimiento`
--
ALTER TABLE `mantenimiento`
  ADD PRIMARY KEY (`id_mantenimiento`),
  ADD KEY `fk_mantenimiento_departamento` (`id_departamento`) USING BTREE;

--
-- Indices de la tabla `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`id_marca`);

--
-- Indices de la tabla `monitor`
--
ALTER TABLE `monitor`
  ADD PRIMARY KEY (`id_monitor`),
  ADD KEY `fk_monitor_marca` (`id_marca`);

--
-- Indices de la tabla `procesador`
--
ALTER TABLE `procesador`
  ADD PRIMARY KEY (`id_procesador`);

--
-- Indices de la tabla `ram`
--
ALTER TABLE `ram`
  ADD PRIMARY KEY (`id_ram`),
  ADD KEY `fk_ram_tiporam` (`id_tipo_ram`);

--
-- Indices de la tabla `software`
--
ALTER TABLE `software`
  ADD PRIMARY KEY (`id_software`),
  ADD KEY `fk_software_categoria` (`id_categoria`),
  ADD KEY `fk_sofware_marca` (`id_marca`);

--
-- Indices de la tabla `swt_rt`
--
ALTER TABLE `swt_rt`
  ADD PRIMARY KEY (`id_swt_rt`),
  ADD KEY `fk_swtrt_estado` (`id_estado`),
  ADD KEY `fk_swtrt_marca` (`id_marca`),
  ADD KEY `fk_swtrt_ip` (`id_ip`),
  ADD KEY `fk_swtrt_depto` (`id_depto`) USING BTREE;

--
-- Indices de la tabla `tipo_accesorio`
--
ALTER TABLE `tipo_accesorio`
  ADD PRIMARY KEY (`id_taccesorio`);

--
-- Indices de la tabla `tipo_estado`
--
ALTER TABLE `tipo_estado`
  ADD PRIMARY KEY (`id_estado`);

--
-- Indices de la tabla `tipo_ram`
--
ALTER TABLE `tipo_ram`
  ADD PRIMARY KEY (`id_tipo_ram`);

--
-- Indices de la tabla `t_video`
--
ALTER TABLE `t_video`
  ADD PRIMARY KEY (`id_tarjeta_v`),
  ADD KEY `fk_tvideo_marca` (`id_marca`);

--
-- Indices de la tabla `ubicacion`
--
ALTER TABLE `ubicacion`
  ADD PRIMARY KEY (`id_ubicacion`),
  ADD KEY `fk_ubicacion_departamento` (`id_departamento`);

--
-- Indices de la tabla `ups`
--
ALTER TABLE `ups`
  ADD PRIMARY KEY (`id_ups`),
  ADD KEY `fk_ups_marca` (`id_marca`);

--
-- Indices de la tabla `usuario_sistema`
--
ALTER TABLE `usuario_sistema`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `fk_usuariosistema_empleado` (`id_empleado`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `accesorio`
--
ALTER TABLE `accesorio`
  MODIFY `id_accesorio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de la tabla `categoria_software`
--
ALTER TABLE `categoria_software`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `clasificacion`
--
ALTER TABLE `clasificacion`
  MODIFY `id_clasificacion_cpu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `clasificacion_licencia`
--
ALTER TABLE `clasificacion_licencia`
  MODIFY `id_clasificacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `cpu`
--
ALTER TABLE `cpu`
  MODIFY `id_cpu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=194;

--
-- AUTO_INCREMENT de la tabla `departamento`
--
ALTER TABLE `departamento`
  MODIFY `id_departamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT de la tabla `detalle_cpu_accesorio`
--
ALTER TABLE `detalle_cpu_accesorio`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `detalle_cpu_disco`
--
ALTER TABLE `detalle_cpu_disco`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=174;

--
-- AUTO_INCREMENT de la tabla `detalle_cpu_ip`
--
ALTER TABLE `detalle_cpu_ip`
  MODIFY `id_det_ip` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT de la tabla `detalle_cpu_licencia`
--
ALTER TABLE `detalle_cpu_licencia`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=342;

--
-- AUTO_INCREMENT de la tabla `detalle_cpu_monitor`
--
ALTER TABLE `detalle_cpu_monitor`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT de la tabla `disco`
--
ALTER TABLE `disco`
  MODIFY `id_disco` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `edificio`
--
ALTER TABLE `edificio`
  MODIFY `id_edificio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id_empleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `equipo`
--
ALTER TABLE `equipo`
  MODIFY `id_equipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;

--
-- AUTO_INCREMENT de la tabla `ipv4`
--
ALTER TABLE `ipv4`
  MODIFY `id_ip` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de la tabla `licencia`
--
ALTER TABLE `licencia`
  MODIFY `incremento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT de la tabla `mantenimiento`
--
ALTER TABLE `mantenimiento`
  MODIFY `id_mantenimiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `marca`
--
ALTER TABLE `marca`
  MODIFY `id_marca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT de la tabla `monitor`
--
ALTER TABLE `monitor`
  MODIFY `id_monitor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT de la tabla `procesador`
--
ALTER TABLE `procesador`
  MODIFY `id_procesador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `ram`
--
ALTER TABLE `ram`
  MODIFY `id_ram` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `software`
--
ALTER TABLE `software`
  MODIFY `id_software` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT de la tabla `swt_rt`
--
ALTER TABLE `swt_rt`
  MODIFY `id_swt_rt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT de la tabla `tipo_accesorio`
--
ALTER TABLE `tipo_accesorio`
  MODIFY `id_taccesorio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `tipo_estado`
--
ALTER TABLE `tipo_estado`
  MODIFY `id_estado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `tipo_ram`
--
ALTER TABLE `tipo_ram`
  MODIFY `id_tipo_ram` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `t_video`
--
ALTER TABLE `t_video`
  MODIFY `id_tarjeta_v` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `ubicacion`
--
ALTER TABLE `ubicacion`
  MODIFY `id_ubicacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT de la tabla `ups`
--
ALTER TABLE `ups`
  MODIFY `id_ups` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT de la tabla `usuario_sistema`
--
ALTER TABLE `usuario_sistema`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `accesorio`
--
ALTER TABLE `accesorio`
  ADD CONSTRAINT `fk_accesorio_marca` FOREIGN KEY (`id_marca`) REFERENCES `marca` (`id_marca`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `fk_accesorio_tipoaccesorio` FOREIGN KEY (`id_taccesorio`) REFERENCES `tipo_accesorio` (`id_taccesorio`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Filtros para la tabla `cpu`
--
ALTER TABLE `cpu`
  ADD CONSTRAINT `fk_cpu_clasificacion` FOREIGN KEY (`id_clasificacion`) REFERENCES `clasificacion` (`id_clasificacion_cpu`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `fk_cpu_edificio` FOREIGN KEY (`id_edificio`) REFERENCES `edificio` (`id_edificio`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `fk_cpu_empleado` FOREIGN KEY (`id_empleado`) REFERENCES `empleados` (`id_empleado`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `fk_cpu_estado` FOREIGN KEY (`id_estado`) REFERENCES `tipo_estado` (`id_estado`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `fk_cpu_marca` FOREIGN KEY (`id_marca`) REFERENCES `marca` (`id_marca`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `fk_cpu_procesador` FOREIGN KEY (`id_procesador`) REFERENCES `procesador` (`id_procesador`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `fk_cpu_ram` FOREIGN KEY (`id_ram`) REFERENCES `ram` (`id_ram`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `fk_cpu_tarjetav` FOREIGN KEY (`id_tarjeta_v`) REFERENCES `t_video` (`id_tarjeta_v`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `fk_cpu_ubicacion` FOREIGN KEY (`id_ubicacion`) REFERENCES `ubicacion` (`id_ubicacion`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `fk_cpu_ups` FOREIGN KEY (`id_ups`) REFERENCES `ups` (`id_ups`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `fk_cpu_usuario_sistema` FOREIGN KEY (`modificado_por`) REFERENCES `usuario_sistema` (`id_usuario`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Filtros para la tabla `departamento`
--
ALTER TABLE `departamento`
  ADD CONSTRAINT `fk_departamento_edificio` FOREIGN KEY (`id_edificio`) REFERENCES `edificio` (`id_edificio`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_cpu_disco`
--
ALTER TABLE `detalle_cpu_disco`
  ADD CONSTRAINT `fk_detalle_disco` FOREIGN KEY (`id_disco`) REFERENCES `disco` (`id_disco`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_cpu_ip`
--
ALTER TABLE `detalle_cpu_ip`
  ADD CONSTRAINT `fk_cpu_ip` FOREIGN KEY (`id_ip`) REFERENCES `ipv4` (`id_ip`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_cpu_monitor`
--
ALTER TABLE `detalle_cpu_monitor`
  ADD CONSTRAINT `fk_detalle_monitor` FOREIGN KEY (`id_monitor`) REFERENCES `monitor` (`id_monitor`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD CONSTRAINT `fk_empleados_departamento` FOREIGN KEY (`id_departamento`) REFERENCES `departamento` (`id_departamento`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Filtros para la tabla `licencia`
--
ALTER TABLE `licencia`
  ADD CONSTRAINT `fk_licencia_clasificacion` FOREIGN KEY (`id_clasificacion`) REFERENCES `clasificacion_licencia` (`id_clasificacion`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `fk_licencia_software` FOREIGN KEY (`id_software`) REFERENCES `software` (`id_software`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Filtros para la tabla `mantenimiento`
--
ALTER TABLE `mantenimiento`
  ADD CONSTRAINT `fk_mantenimiento_departamento` FOREIGN KEY (`id_departamento`) REFERENCES `departamento` (`id_departamento`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Filtros para la tabla `monitor`
--
ALTER TABLE `monitor`
  ADD CONSTRAINT `fk_monitor_marca` FOREIGN KEY (`id_marca`) REFERENCES `marca` (`id_marca`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Filtros para la tabla `ram`
--
ALTER TABLE `ram`
  ADD CONSTRAINT `fk_ram_tiporam` FOREIGN KEY (`id_tipo_ram`) REFERENCES `tipo_ram` (`id_tipo_ram`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Filtros para la tabla `software`
--
ALTER TABLE `software`
  ADD CONSTRAINT `fk_software_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categoria_software` (`id_categoria`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `fk_sofware_marca` FOREIGN KEY (`id_marca`) REFERENCES `marca` (`id_marca`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Filtros para la tabla `swt_rt`
--
ALTER TABLE `swt_rt`
  ADD CONSTRAINT `fk_swtrt_depto` FOREIGN KEY (`id_depto`) REFERENCES `departamento` (`id_departamento`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `fk_swtrt_estado` FOREIGN KEY (`id_estado`) REFERENCES `tipo_estado` (`id_estado`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `fk_swtrt_marca` FOREIGN KEY (`id_marca`) REFERENCES `marca` (`id_marca`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Filtros para la tabla `t_video`
--
ALTER TABLE `t_video`
  ADD CONSTRAINT `fk_tvideo_marca` FOREIGN KEY (`id_marca`) REFERENCES `marca` (`id_marca`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Filtros para la tabla `ubicacion`
--
ALTER TABLE `ubicacion`
  ADD CONSTRAINT `fk_ubicacion_departamento` FOREIGN KEY (`id_departamento`) REFERENCES `departamento` (`id_departamento`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ups`
--
ALTER TABLE `ups`
  ADD CONSTRAINT `fk_ups_marca` FOREIGN KEY (`id_marca`) REFERENCES `marca` (`id_marca`) ON DELETE SET NULL ON UPDATE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
