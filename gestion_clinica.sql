-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.4.32-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para gestion_clinica
DROP DATABASE IF EXISTS `gestion_clinica`;
CREATE DATABASE IF NOT EXISTS `gestion_clinica` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `gestion_clinica`;

-- Volcando estructura para tabla gestion_clinica.citas
DROP TABLE IF EXISTS `citas`;
CREATE TABLE IF NOT EXISTS `citas` (
  `cita_id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date DEFAULT NULL,
  `hora` int(11) DEFAULT NULL,
  `estado` varchar(20) DEFAULT NULL,
  `medico_id` int(11) DEFAULT NULL,
  `paciente_id` int(11) DEFAULT NULL,
  `servicio_id` int(11) DEFAULT NULL,
  `id_turno` int(11) DEFAULT NULL,
  `transaccion` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`cita_id`),
  UNIQUE KEY `unica_cita` (`fecha`,`hora`) USING BTREE,
  KEY `servicio_id` (`servicio_id`),
  KEY `citas_ibfk_1` (`paciente_id`),
  KEY `FK_citas_medicos` (`medico_id`),
  KEY `FK_citas_horas` (`hora`),
  KEY `id_turno` (`id_turno`),
  CONSTRAINT `FK_citas_horas` FOREIGN KEY (`hora`) REFERENCES `horas` (`id_hora`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_citas_medicos` FOREIGN KEY (`medico_id`) REFERENCES `medicos` (`usuario_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_citas_pacientes` FOREIGN KEY (`paciente_id`) REFERENCES `pacientes` (`paciente_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `FK_citas_servicios_medicos` FOREIGN KEY (`servicio_id`) REFERENCES `servicios_medicos` (`servicio_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `FK_citas_turno` FOREIGN KEY (`id_turno`) REFERENCES `turno` (`id_turno`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla gestion_clinica.citas: ~2 rows (aproximadamente)
INSERT INTO `citas` (`cita_id`, `fecha`, `hora`, `estado`, `medico_id`, `paciente_id`, `servicio_id`, `id_turno`, `transaccion`) VALUES
	(8, '2024-12-05', 8, 'Agendado', 23, 8, 1, 2, 'No Pagado'),
	(9, '2024-12-03', 8, 'Agendado', 23, 8, 1, 2, 'No Pagado');

-- Volcando estructura para procedimiento gestion_clinica.ConsultarCitas
DROP PROCEDURE IF EXISTS `ConsultarCitas`;
DELIMITER //
CREATE PROCEDURE `ConsultarCitas`()
BEGIN
	SELECT citas.cita_id,
      pacientes.paciente_id,
      usuarios.nombre AS Paciente,
      servicios_medicos.nombre_servicio AS Servicio
      FROM citas
      LEFT JOIN pacientes ON pacientes.paciente_id = citas.paciente_id
      LEFT JOIN servicios_medicos ON servicios_medicos.servicio_id = citas.servicio_id
		LEFT JOIN usuarios ON usuarios.usuario_id = pacientes.usuario_id 
		WHERE citas.estado LIKE 'No Agendada';
END//
DELIMITER ;

-- Volcando estructura para procedimiento gestion_clinica.ConsultarCitasPorPaciente
DROP PROCEDURE IF EXISTS `ConsultarCitasPorPaciente`;
DELIMITER //
CREATE PROCEDURE `ConsultarCitasPorPaciente`(
	IN `_cedula` VARCHAR(50)
)
BEGIN
	SELECT s.nombre_servicio AS Servicio,
	c.fecha AS Fecha,
	h.hora AS Hora,
	c.cita_id,
	u.nombre AS Paciente
	FROM pacientes AS p
	LEFT JOIN citas AS c ON c.paciente_id = p.paciente_id
	LEFT JOIN servicios_medicos AS s ON s.servicio_id = c.servicio_id
	LEFT JOIN usuarios AS u ON u.usuario_id = p.usuario_id
	LEFT JOIN horas AS h ON h.id_hora = c.hora
	WHERE p.cedula LIKE _cedula AND c.estado LIKE 'Agendado';
END//
DELIMITER ;

-- Volcando estructura para procedimiento gestion_clinica.ConsultarHorasDisponibles
DROP PROCEDURE IF EXISTS `ConsultarHorasDisponibles`;
DELIMITER //
CREATE PROCEDURE `ConsultarHorasDisponibles`(
	IN `_id_medico` INT,
	IN `_id_turno` INT,
	IN `_fecha` VARCHAR(50)
)
BEGIN
	SELECT 
	t.turno,
	h.hora,
	h.id_hora
	FROM horas AS h
	LEFT JOIN turno AS t ON t.id_turno = h.id_turno
	LEFT JOIN citas AS c ON c.hora = h.id_hora AND c.medico_id = _id_medico AND c.fecha = _fecha
	WHERE h.id_turno = _id_turno AND c.hora IS NULL;
END//
DELIMITER ;

-- Volcando estructura para procedimiento gestion_clinica.ConsultarMedicoDisponible
DROP PROCEDURE IF EXISTS `ConsultarMedicoDisponible`;
DELIMITER //
CREATE PROCEDURE `ConsultarMedicoDisponible`(
	IN `_turno` INT,
	IN `_dia` DATE
)
BEGIN
	SELECT distinct
	u.usuario_id, 
	u.nombre
	FROM medicos AS m
	LEFT JOIN usuarios AS u ON u.usuario_id = m.usuario_id
	LEFT JOIN horario AS h ON h.id_medico = m.usuario_id
	LEFT JOIN citas AS c ON c.medico_id = m.usuario_id
	WHERE h.id_turno = _turno AND h.dia = _dia;
END//
DELIMITER ;

-- Volcando estructura para procedimiento gestion_clinica.Consultar_Citas_Del_Dia
DROP PROCEDURE IF EXISTS `Consultar_Citas_Del_Dia`;
DELIMITER //
CREATE PROCEDURE `Consultar_Citas_Del_Dia`(
	IN `_medico_id` INT
)
BEGIN
    SELECT 
        pacientes.paciente_id AS paciente_id,
        pacientes.cedula AS Cedula,
        usuarios.nombre AS Paciente,
        citas.hora AS id_hora,
        horas.hora,
        citas.cita_id
    FROM citas
    LEFT JOIN pacientes ON pacientes.paciente_id = citas.paciente_id
    LEFT JOIN usuarios ON usuarios.usuario_id = pacientes.usuario_id
    LEFT JOIN horas ON horas.id_hora = citas.hora
    WHERE citas.medico_id = _medico_id 
	 AND citas.fecha = CURDATE()
	 AND citas.estado = 'Agendado';
END//
DELIMITER ;

-- Volcando estructura para procedimiento gestion_clinica.Consultar_Proximas_Citas
DROP PROCEDURE IF EXISTS `Consultar_Proximas_Citas`;
DELIMITER //
CREATE PROCEDURE `Consultar_Proximas_Citas`(
	IN `_medico_id` INT
)
BEGIN
SELECT 
    pacientes.cedula AS Cedula,
    usuarios.nombre AS Paciente,
    citas.hora AS id_hora,
    horas.hora,
    citas.cita_id
FROM citas
LEFT JOIN pacientes ON pacientes.paciente_id = citas.paciente_id
LEFT JOIN usuarios ON usuarios.usuario_id = pacientes.usuario_id
LEFT JOIN horas ON horas.id_hora = citas.hora
WHERE citas.medico_id = _medico_id 
  AND citas.fecha > CURDATE()
  AND citas.estado = 'Agendado'
ORDER BY citas.fecha ASC, citas.hora ASC;
END//
DELIMITER ;

-- Volcando estructura para tabla gestion_clinica.datos_medicos
DROP TABLE IF EXISTS `datos_medicos`;
CREATE TABLE IF NOT EXISTS `datos_medicos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `paciente_id` int(11) NOT NULL,
  `altura` decimal(5,2) DEFAULT NULL,
  `peso` decimal(5,2) DEFAULT NULL,
  `tipo_sangre` varchar(3) DEFAULT NULL,
  `alergias` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `paciente_id` (`paciente_id`),
  CONSTRAINT `datos_medicos_ibfk_1` FOREIGN KEY (`paciente_id`) REFERENCES `pacientes` (`paciente_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla gestion_clinica.datos_medicos: ~3 rows (aproximadamente)
INSERT INTO `datos_medicos` (`id`, `paciente_id`, `altura`, `peso`, `tipo_sangre`, `alergias`) VALUES
	(19, 8, 120.00, 3.00, 'O+', 'al queso'),
	(20, 8, 120.00, 3.00, 'O+', 'al queso'),
	(21, 8, 120.00, 3.00, 'O+', 'al queso');

-- Volcando estructura para tabla gestion_clinica.diagnosticos
DROP TABLE IF EXISTS `diagnosticos`;
CREATE TABLE IF NOT EXISTS `diagnosticos` (
  `diagnostico_id` int(11) NOT NULL AUTO_INCREMENT,
  `historial_id` int(11) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `fecha_diagnostico` datetime DEFAULT current_timestamp(),
  `paciente_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`diagnostico_id`),
  KEY `historial_id` (`historial_id`),
  KEY `fk_paciente` (`paciente_id`),
  CONSTRAINT `diagnosticos_ibfk_1` FOREIGN KEY (`historial_id`) REFERENCES `historial_clinico` (`historial_id`),
  CONSTRAINT `fk_paciente` FOREIGN KEY (`paciente_id`) REFERENCES `pacientes` (`paciente_id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla gestion_clinica.diagnosticos: ~12 rows (aproximadamente)
INSERT INTO `diagnosticos` (`diagnostico_id`, `historial_id`, `descripcion`, `fecha_diagnostico`, `paciente_id`) VALUES
	(21, 20, 'dolor de muelas', '2024-11-01 02:04:33', 8),
	(22, 21, 'dolor de muelas', '2024-11-06 14:07:25', 8),
	(23, 22, 'dolor de muelas', '2024-11-06 14:08:48', 8),
	(24, 23, 'Dolor de Cabeza,Dolor de garganta', '2024-11-16 20:32:51', 8),
	(25, 24, 'Dolor repentino y severo', '2024-12-02 23:28:44', 8),
	(26, 25, 'Debilidad o cambio súbito en la visión', '2024-12-03 13:40:43', 8),
	(27, 26, 'Debilidad o cambio súbito en la visión', '2024-12-03 14:05:24', 8),
	(28, 27, 'Debilidad o cambio súbito en la visión', '2024-12-03 14:06:00', 8),
	(29, 28, 'Dolor repentino y severo', '2024-12-03 14:09:38', 8),
	(30, 29, 'Dolor repentino y severo', '2024-12-03 14:09:55', 8),
	(31, 30, 'Lesiones graves', '2024-12-03 14:11:44', 8),
	(32, 31, 'Erupciones limitadas', '2024-12-03 14:12:12', 8);

-- Volcando estructura para tabla gestion_clinica.facturas
DROP TABLE IF EXISTS `facturas`;
CREATE TABLE IF NOT EXISTS `facturas` (
  `factura_id` int(11) NOT NULL AUTO_INCREMENT,
  `paciente_id` int(11) DEFAULT NULL,
  `fecha_emision` datetime DEFAULT current_timestamp(),
  `monto` decimal(10,2) DEFAULT NULL,
  `estado` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`factura_id`),
  KEY `paciente_id` (`paciente_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla gestion_clinica.facturas: ~0 rows (aproximadamente)
INSERT INTO `facturas` (`factura_id`, `paciente_id`, `fecha_emision`, `monto`, `estado`) VALUES
	(5, 8, '2024-11-02 19:13:13', 30.00, 'Pagado'),
	(6, 8, '2024-11-28 10:14:15', 30.00, 'Pagado');

-- Volcando estructura para tabla gestion_clinica.historial_clinico
DROP TABLE IF EXISTS `historial_clinico`;
CREATE TABLE IF NOT EXISTS `historial_clinico` (
  `historial_id` int(11) NOT NULL AUTO_INCREMENT,
  `paciente_id` int(11) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`historial_id`),
  KEY `paciente_id` (`paciente_id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla gestion_clinica.historial_clinico: ~12 rows (aproximadamente)
INSERT INTO `historial_clinico` (`historial_id`, `paciente_id`, `fecha_creacion`) VALUES
	(20, 8, '2024-11-01 02:04:33'),
	(21, 8, '2024-11-06 14:07:25'),
	(22, 8, '2024-11-06 14:08:48'),
	(23, 8, '2024-11-16 20:32:51'),
	(24, 8, '2024-12-02 23:28:44'),
	(25, 8, '2024-12-03 13:40:43'),
	(26, 8, '2024-12-03 14:05:24'),
	(27, 8, '2024-12-03 14:06:00'),
	(28, 8, '2024-12-03 14:09:38'),
	(29, 8, '2024-12-03 14:09:55'),
	(30, 8, '2024-12-03 14:11:44'),
	(31, 8, '2024-12-03 14:12:12');

-- Volcando estructura para tabla gestion_clinica.horario
DROP TABLE IF EXISTS `horario`;
CREATE TABLE IF NOT EXISTS `horario` (
  `id_horario` int(11) NOT NULL AUTO_INCREMENT,
  `dia` date DEFAULT NULL,
  `id_medico` int(11) DEFAULT NULL,
  `id_turno` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_horario`),
  UNIQUE KEY `unico_dia_turno` (`id_turno`,`dia`) USING BTREE,
  KEY `id_medico` (`id_medico`),
  KEY `id_turno` (`id_turno`) USING BTREE,
  CONSTRAINT `FK_horario_medicos` FOREIGN KEY (`id_medico`) REFERENCES `medicos` (`usuario_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_horario_turno` FOREIGN KEY (`id_turno`) REFERENCES `turno` (`id_turno`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla gestion_clinica.horario: ~2 rows (aproximadamente)
INSERT INTO `horario` (`id_horario`, `dia`, `id_medico`, `id_turno`) VALUES
	(4, '2024-12-05', 23, 2),
	(5, '2024-12-03', 23, 2);

-- Volcando estructura para tabla gestion_clinica.horas
DROP TABLE IF EXISTS `horas`;
CREATE TABLE IF NOT EXISTS `horas` (
  `id_hora` int(11) NOT NULL AUTO_INCREMENT,
  `hora` varchar(50) DEFAULT NULL,
  `id_turno` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_hora`),
  KEY `id_turno` (`id_turno`),
  CONSTRAINT `FK__turno` FOREIGN KEY (`id_turno`) REFERENCES `turno` (`id_turno`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla gestion_clinica.horas: ~10 rows (aproximadamente)
INSERT INTO `horas` (`id_hora`, `hora`, `id_turno`) VALUES
	(1, '8:00', 1),
	(2, '9:00', 1),
	(3, '10:00', 1),
	(4, '11:00', 1),
	(5, '12:00', 1),
	(6, '1:00', 2),
	(7, '2:00', 2),
	(8, '3:00', 2),
	(9, '4:00', 2),
	(10, '5:00', 2);

-- Volcando estructura para tabla gestion_clinica.insumos
DROP TABLE IF EXISTS `insumos`;
CREATE TABLE IF NOT EXISTS `insumos` (
  `insumo_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `unidad` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`insumo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla gestion_clinica.insumos: ~5 rows (aproximadamente)
INSERT INTO `insumos` (`insumo_id`, `nombre`, `cantidad`, `unidad`) VALUES
	(1, 'Jeringas', 100, 'unidad'),
	(4, 'Mascarillas quirúrgicas', 100, 'unidades'),
	(5, 'Batas desechables', 100, 'unidades'),
	(6, 'Guantes de látex', 100, 'pares'),
	(7, 'Suturas', 20, 'unidades');

-- Volcando estructura para tabla gestion_clinica.medicamentos
DROP TABLE IF EXISTS `medicamentos`;
CREATE TABLE IF NOT EXISTS `medicamentos` (
  `medicamento_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `unidad` varchar(50) DEFAULT NULL,
  `tipo` varchar(50) DEFAULT NULL,
  `tratamiento` varchar(50) DEFAULT NULL,
  `id_padecimiento` int(11) DEFAULT NULL,
  PRIMARY KEY (`medicamento_id`),
  KEY `id_padecimiento` (`id_padecimiento`),
  CONSTRAINT `FK_medicamentos_padecimiento` FOREIGN KEY (`id_padecimiento`) REFERENCES `padecimiento` (`id_padecimiento`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla gestion_clinica.medicamentos: ~40 rows (aproximadamente)
INSERT INTO `medicamentos` (`medicamento_id`, `nombre`, `cantidad`, `unidad`, `tipo`, `tratamiento`, `id_padecimiento`) VALUES
	(1, 'Loratadina', 50, 'mg', 'tableta', '1 tableta cada 12 horas', 3),
	(2, 'Dextrometorfano', 30, 'mg', 'jarabe', '5 ml cada 8 horas', 3),
	(3, 'Oseltamivir', 10, 'mg', 'tableta', '1 tableta cada 12 horas', 4),
	(4, 'Vitamina C', 100, 'mg', 'tableta', '1 tableta diaria', 4),
	(5, 'Ciprofloxacino', 20, 'mg', 'gotas óticas', '2 gotas cada 12 horas', 5),
	(6, 'Naproxeno', 50, 'mg', 'tableta', '1 tableta cada 12 horas', 5),
	(7, 'Benzocaína', 50, 'mg', 'pastillas', '1 pastilla cada 6 horas', 6),
	(8, 'Flurbiprofeno', 20, 'mg', 'pastillas', '1 pastilla cada 8 horas', 6),
	(9, 'Sumatriptán', 10, 'mg', 'tableta', '1 tableta al inicio del dolor', 7),
	(10, 'Naproxeno sódico', 30, 'mg', 'tableta', '1 tableta cada 8 horas', 7),
	(11, 'Metamizol', 100, 'mg', 'tableta', '1 tableta cada 12 horas', 8),
	(12, 'Dipirona', 50, 'mg', 'tableta', '1 tableta cada 8 horas', 8),
	(13, 'Hidrocortisona', 10, 'mg', 'crema', 'Aplicar cada 8 horas', 9),
	(14, 'Calamina', 20, 'mg', 'loción', 'Aplicar cada 12 horas', 9),
	(15, 'Metoclopramida', 50, 'mg', 'tableta', '1 tableta cada 8 horas', 10),
	(16, 'Dimenhidrinato', 20, 'mg', 'tableta', '1 tableta cada 8 horas', 10),
	(17, 'Lidocaína', 10, 'mg', 'inyección', 'Según necesidad', 11),
	(18, 'Diclofenaco', 20, 'mg', 'inyección', 'Según indicación', 11),
	(19, 'Tramadol', 50, 'mg', 'tableta', '1 tableta según emergencia', 12),
	(20, 'Oxicodona', 10, 'mg', 'tableta', '1 tableta según emergencia', 12),
	(21, 'Cinarizina', 25, 'mg', 'tableta', '1 tableta cada 12 horas', 13),
	(22, 'Escopolamina', 10, 'mg', 'parche', '1 parche cada 72 horas', 13),
	(23, 'Dexametasona', 10, 'mg', 'tableta', '1 tableta diaria', 14),
	(24, 'Atorvastatina', 20, 'mg', 'tableta', '1 tableta diaria', 14),
	(25, 'Ambroxol', 30, 'mg', 'jarabe', '5 ml cada 8 horas', 3),
	(26, 'Acyclovir', 200, 'mg', 'tableta', '1 tableta cada 6 horas', 4),
	(27, 'Amoxicilina', 500, 'mg', 'tableta', '1 tableta cada 8 horas', 6),
	(28, 'Ibuprofeno', 200, 'mg', 'tableta', '1 tableta cada 6 horas', 5),
	(29, 'Clorfenamina', 4, 'mg', 'tableta', '1 tableta cada 8 horas', 3),
	(30, 'Ketorolaco', 10, 'mg', 'tableta', '1 tableta cada 6 horas', 7),
	(31, 'Salbutamol', 100, 'mcg', 'inhalador', '2 inhalaciones cada 6 horas', 4),
	(32, 'Carbamazepina', 200, 'mg', 'tableta', '1 tableta cada 12 horas', 7),
	(33, 'Clotrimazol', 10, 'mg', 'crema', 'Aplicar 2 veces al día', 9),
	(34, 'Eritromicina', 250, 'mg', 'tableta', '1 tableta cada 6 horas', 6),
	(35, 'Domperidona', 10, 'mg', 'tableta', '1 tableta cada 8 horas', 10),
	(36, 'Furosemida', 40, 'mg', 'tableta', '1 tableta diaria', 14),
	(37, 'Betametasona', 4, 'mg', 'tableta', '1 tableta cada 12 horas', 9),
	(38, 'Ranitidina', 150, 'mg', 'tableta', '1 tableta cada 12 horas', 10),
	(39, 'Clonazepam', 2, 'mg', 'tableta', '1 tableta antes de dormir', 13),
	(40, 'Fenitoína', 100, 'mg', 'tableta', '1 tableta cada 12 horas', 7);

-- Volcando estructura para tabla gestion_clinica.medicos
DROP TABLE IF EXISTS `medicos`;
CREATE TABLE IF NOT EXISTS `medicos` (
  `medico_id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) DEFAULT NULL,
  `especialidad` int(11) DEFAULT NULL,
  `no_licencia_medica` varchar(100) DEFAULT NULL,
  `anio_experiencia` int(11) DEFAULT NULL,
  `institucion` varchar(100) DEFAULT NULL,
  `fecha_registro` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`medico_id`),
  KEY `especialidad` (`especialidad`),
  KEY `medicos_ibfk_1` (`usuario_id`),
  CONSTRAINT `FK_medicos_servicios_medicos` FOREIGN KEY (`especialidad`) REFERENCES `servicios_medicos` (`servicio_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `medicos_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`usuario_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla gestion_clinica.medicos: ~3 rows (aproximadamente)
INSERT INTO `medicos` (`medico_id`, `usuario_id`, `especialidad`, `no_licencia_medica`, `anio_experiencia`, `institucion`, `fecha_registro`) VALUES
	(5, 16, 1, '2020-1236', 7, 'Universidad Interamericana de Panamá', '2024-10-29 22:22:54'),
	(9, 22, 1, '2021-1234', 18, 'Universidad Interamericana de Panamá', '2024-12-03 14:54:24'),
	(10, 23, 1, '2021-1234', 20, 'Universidad Interamericana de Panamá', '2024-12-03 17:44:32');

-- Volcando estructura para procedimiento gestion_clinica.PacienteConsultarCita
DROP PROCEDURE IF EXISTS `PacienteConsultarCita`;
DELIMITER //
CREATE PROCEDURE `PacienteConsultarCita`(
	IN `_usuario_id` INT
)
BEGIN
	SELECT 
	sub.Especialidad,
	sub.Fecha,
	sub.Hora,
	u.nombre AS Medico,
	sub.cita_id
	FROM (
		SELECT 
		s.nombre_servicio AS "Especialidad",
		c.fecha AS Fecha,
		c.hora AS Hora,
		c.medico_id,
		c.cita_id
		FROM citas AS c
		LEFT JOIN servicios_medicos AS s ON s.servicio_id = c.servicio_id
		WHERE c.paciente_id = _usuario_id AND c.estado LIKE "Agendada"
	)AS sub
	LEFT JOIN medicos AS m ON m.usuario_id = sub.medico_id
	LEFT JOIN usuarios AS u ON u.usuario_id = sub.medico_id;
END//
DELIMITER ;

-- Volcando estructura para procedimiento gestion_clinica.PacienteConsultarCitas
DROP PROCEDURE IF EXISTS `PacienteConsultarCitas`;
DELIMITER //
CREATE PROCEDURE `PacienteConsultarCitas`(
	IN `_usuario_id` INT
)
BEGIN
	SELECT 
	sub.Especialidad,
	sub.Fecha,
	sub.Hora,
	sub.hora,
	u.nombre AS Medico,
	sub.cita_id
	FROM (
		SELECT 
		s.nombre_servicio AS "Especialidad",
		c.fecha AS Fecha,
		h.hora AS Hora,
		c.medico_id,
		c.cita_id
		FROM usuarios AS u
		LEFT JOIN pacientes AS p ON p.usuario_id = u.usuario_id
		LEFT JOIN citas AS c ON c.paciente_id = p.paciente_id
		LEFT JOIN servicios_medicos AS s ON s.servicio_id = c.servicio_id
		LEFT JOIN horas AS h ON h.id_hora = c.hora
		WHERE u.usuario_id = _usuario_id AND c.estado LIKE "Agendado"
	)AS sub
	LEFT JOIN medicos AS m ON m.usuario_id = sub.medico_id
	LEFT JOIN usuarios AS u ON u.usuario_id = sub.medico_id;
END//
DELIMITER ;

-- Volcando estructura para tabla gestion_clinica.pacientes
DROP TABLE IF EXISTS `pacientes`;
CREATE TABLE IF NOT EXISTS `pacientes` (
  `paciente_id` int(11) NOT NULL AUTO_INCREMENT,
  `cedula` varchar(50) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `genero` varchar(10) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `fecha_registro` datetime DEFAULT current_timestamp(),
  `usuario_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`paciente_id`),
  KEY `usuario_id` (`usuario_id`),
  CONSTRAINT `FK_pacientes_usuarios` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`usuario_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla gestion_clinica.pacientes: ~0 rows (aproximadamente)
INSERT INTO `pacientes` (`paciente_id`, `cedula`, `fecha_nacimiento`, `genero`, `telefono`, `direccion`, `fecha_registro`, `usuario_id`) VALUES
	(8, '8-974-110', '2001-06-13', 'masculino', '61744815', 'El Valle San Isidro Sector 2', '2024-10-31 19:16:06', 13);

-- Volcando estructura para tabla gestion_clinica.padecimiento
DROP TABLE IF EXISTS `padecimiento`;
CREATE TABLE IF NOT EXISTS `padecimiento` (
  `id_padecimiento` int(11) NOT NULL AUTO_INCREMENT,
  `padecimiento` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_padecimiento`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla gestion_clinica.padecimiento: ~14 rows (aproximadamente)
INSERT INTO `padecimiento` (`id_padecimiento`, `padecimiento`) VALUES
	(1, 'Dolor de Cabeza'),
	(2, 'Dolor de garganta'),
	(3, 'Resfriados'),
	(4, 'Gripe'),
	(5, 'Dolores de oído'),
	(6, 'Dolores de garganta'),
	(7, 'Cefaleas (migrañas)'),
	(8, 'Fiebres bajas'),
	(9, 'Erupciones limitadas'),
	(10, 'Vómitos severos y persistentes'),
	(11, 'Lesiones graves'),
	(12, 'Dolor repentino y severo'),
	(13, 'Mareo'),
	(14, 'Debilidad o cambio súbito en la visión');

-- Volcando estructura para tabla gestion_clinica.recetas
DROP TABLE IF EXISTS `recetas`;
CREATE TABLE IF NOT EXISTS `recetas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `paciente_id` int(11) NOT NULL,
  `medicamento` varchar(100) DEFAULT NULL,
  `tratamiento` text DEFAULT NULL,
  `fecha_prescripcion` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `paciente_id` (`paciente_id`),
  CONSTRAINT `recetas_ibfk_1` FOREIGN KEY (`paciente_id`) REFERENCES `pacientes` (`paciente_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla gestion_clinica.recetas: ~12 rows (aproximadamente)
INSERT INTO `recetas` (`id`, `paciente_id`, `medicamento`, `tratamiento`, `fecha_prescripcion`) VALUES
	(13, 8, 'panadol', 'una cada 8 horas', '2024-11-01 07:04:33'),
	(14, 8, 'panadol', '1 cada 8 horas', '2024-11-06 19:07:25'),
	(15, 8, 'panadol', '1 cada 8 horas', '2024-11-06 19:08:48'),
	(16, 8, 'Panadol', '1 cada 4 horas', '2024-11-17 01:32:51'),
	(17, 8, 'Tramadol, Oxicodona', '1 tableta según emergencia, 1 tableta según emergencia', '2024-12-03 04:28:44'),
	(18, 8, 'Dexametasona', '1 tableta diaria', '2024-12-03 18:40:43'),
	(19, 8, 'Atorvastatina', '1 tableta diaria', '2024-12-03 19:05:24'),
	(20, 8, 'Atorvastatina', '1 tableta diaria', '2024-12-03 19:06:00'),
	(21, 8, 'Tramadol', '1 tableta según emergencia', '2024-12-03 19:09:38'),
	(22, 8, 'Tramadol', '1 tableta según emergencia', '2024-12-03 19:09:55'),
	(23, 8, 'Lidocaína', 'Según necesidad', '2024-12-03 19:11:44'),
	(24, 8, 'Calamina', 'Aplicar cada 12 horas', '2024-12-03 19:12:12');

-- Volcando estructura para procedimiento gestion_clinica.RegistrarPaciente
DROP PROCEDURE IF EXISTS `RegistrarPaciente`;
DELIMITER //
CREATE PROCEDURE `RegistrarPaciente`(
	IN `_nombre` VARCHAR(50),
	IN `_email` VARCHAR(50),
	IN `_contrasena` VARCHAR(255),
	IN `_cedula` VARCHAR(50),
	IN `_fecha_nacimiento` VARCHAR(50),
	IN `_genero` VARCHAR(50),
	IN `_telefono` VARCHAR(50),
	IN `_direccion` VARCHAR(50)
)
BEGIN
	DECLARE ultimo_id INT;
	INSERT INTO usuarios (nombre, email, contrasena, rol) 
	VALUES(_nombre, _email, _contrasena, 'Paciente');
	
	SET ultimo_id = LAST_INSERT_ID();
	
	INSERT INTO pacientes (cedula, fecha_nacimiento, genero, telefono, direccion, usuario_id)
	VALUES(_cedula, _fecha_nacimiento, _genero, _telefono, _direccion, ultimo_id);
END//
DELIMITER ;

-- Volcando estructura para tabla gestion_clinica.roles
DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `rol` varchar(50) NOT NULL,
  PRIMARY KEY (`rol`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla gestion_clinica.roles: ~10 rows (aproximadamente)
INSERT INTO `roles` (`rol`) VALUES
	('Administrador'),
	('Apoyo'),
	('Emergencias'),
	('Enfermería'),
	('Farmacéuticos'),
	('Limpieza y Mantenimiento'),
	('Médico'),
	('Paciente'),
	('Recepcionista'),
	('Recursos Humanos');

-- Volcando estructura para tabla gestion_clinica.servicios_medicos
DROP TABLE IF EXISTS `servicios_medicos`;
CREATE TABLE IF NOT EXISTS `servicios_medicos` (
  `servicio_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_servicio` varchar(100) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `costo` double DEFAULT NULL,
  PRIMARY KEY (`servicio_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla gestion_clinica.servicios_medicos: ~2 rows (aproximadamente)
INSERT INTO `servicios_medicos` (`servicio_id`, `nombre_servicio`, `descripcion`, `costo`) VALUES
	(1, 'Medicina General', NULL, 30),
	(2, 'Laboratorio', NULL, 50);

-- Volcando estructura para procedimiento gestion_clinica.SolicitarCita
DROP PROCEDURE IF EXISTS `SolicitarCita`;
DELIMITER //
CREATE PROCEDURE `SolicitarCita`(
	IN `_fecha` DATE,
	IN `_estado` VARCHAR(50),
	IN `_paciente_id` INT,
	IN `_servicio_id` INT,
	IN `_id_turno` INT
)
BEGIN
	-- Verificar que no haya más de 5 citas para la misma fecha
    IF (SELECT COUNT(*) 
        FROM Citas
        WHERE fecha = _fecha) < 5 THEN

        -- Si hay menos de 5 citas, insertamos la nueva cita
        INSERT INTO Citas (fecha, estado, paciente_id, servicio_id, id_turno)
        VALUES (_fecha, _estado, _paciente_id, _servicio_id, _id_turno);
    ELSE
        -- Si ya hay 5 citas, no hacer nada (o devolver un mensaje de error, si es necesario)
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'El máximo de 5 citas para este día ya ha sido alcanzado';
    END IF;
END//
DELIMITER ;

-- Volcando estructura para tabla gestion_clinica.turno
DROP TABLE IF EXISTS `turno`;
CREATE TABLE IF NOT EXISTS `turno` (
  `id_turno` int(11) NOT NULL AUTO_INCREMENT,
  `turno` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_turno`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla gestion_clinica.turno: ~2 rows (aproximadamente)
INSERT INTO `turno` (`id_turno`, `turno`) VALUES
	(1, '8-12'),
	(2, '1-5');

-- Volcando estructura para tabla gestion_clinica.usuarios
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `usuario_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `contrasena` varchar(255) DEFAULT NULL,
  `rol` varchar(50) DEFAULT NULL,
  `restablecer` text DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`usuario_id`),
  UNIQUE KEY `email` (`email`),
  KEY `FK_usuarios_roles` (`rol`),
  CONSTRAINT `FK_usuarios_roles` FOREIGN KEY (`rol`) REFERENCES `roles` (`rol`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla gestion_clinica.usuarios: ~7 rows (aproximadamente)
INSERT INTO `usuarios` (`usuario_id`, `nombre`, `email`, `contrasena`, `rol`, `restablecer`, `fecha_creacion`) VALUES
	(4, 'Pedrito', 'didiervillalaz04@gmail.com', '$2y$10$RzmqVBekNoYqP8X5ZUHKDOTRm6ovyShL9oIa.aYjcCKjetYCKRkQG', 'Administrador', NULL, '2024-10-09 01:44:47'),
	(13, 'Alberto', 'carv2012@gmail.com', '$2y$10$7b1EnmHLFZomz7wxJ9v8/u1sNPWhahQQ4z9i/y0T1xXAny6qJ0Hsu', 'Paciente', NULL, '2024-10-31 19:16:06'),
	(14, 'Luis', 'luismurcia0106@gmail.com', '$2y$10$wfC05QY.gONYAYbndQSCeOPKs9UkdcCtKSVwM/TgRoVGiELlDKoPO', 'Administrador', NULL, '2024-11-02 20:07:30'),
	(16, 'Carlos Alberto', 'carv2011@gmail.com', '$2y$10$V4XMD3n8vuTmPYowXjnqT.iXKMgflVEzpNfn.ouHl9Q3TzDtehXjq', 'Médico', '8ebda540cbcc4d7336496819a46a1b68', '2024-11-09 16:08:57'),
	(18, 'Jaider Rico', 'jaider.rico@gmail.com', '$2y$10$G9Pp6s7xiTkiq8XgSfjojulie4lR21ur88ko07PKYA2LikgqkQw1q', 'Recepcionista', NULL, '2024-11-09 16:26:07'),
	(22, 'Jorge Murillo', 'jorge.murillo@gmail.com', '$2y$10$0VGD9GObOzxx662XaP9Og.n0RamJbnRLkScRIOBhev02p8D3mHiey', 'Médico', '6f4922f45568161a8cdf4ad2299f6d23', '2024-12-03 14:53:41'),
	(23, 'Jose Macre', 'macremoises@gmail.com', '$2y$10$I3kP8iyha72X/mNPjG2gt.aa5SO1f7EW2DxdXZKfsd0uqv8r0mX.2', 'Médico', NULL, '2024-12-03 15:03:55');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
