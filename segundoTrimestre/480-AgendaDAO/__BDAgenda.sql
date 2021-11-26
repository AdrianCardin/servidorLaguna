SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
CREATE DATABASE IF NOT EXISTS agenda DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE agenda;

DROP TABLE IF EXISTS categoria;
CREATE TABLE IF NOT EXISTS categoria (
                                         id int(11) NOT NULL AUTO_INCREMENT,
                                         nombre varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
                                         PRIMARY KEY (id)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

TRUNCATE TABLE categoria;
INSERT INTO categoria (id, nombre) VALUES
                                       (1, 'Familiares'),
                                       (2, 'Amigos'),
                                       (3, 'Trabajo'),
                                       (4, 'Otros'),
                                       (8, 'Estudios');

DROP TABLE IF EXISTS persona;
CREATE TABLE IF NOT EXISTS persona (
                                       id int(11) NOT NULL AUTO_INCREMENT,
                                       nombre varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
                                       apellidos varchar(80) DEFAULT NULL,
                                       telefono varchar(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
                                       estrella tinyint(1) NOT NULL DEFAULT 0,
                                       categoriaId int(11) NOT NULL,
                                       PRIMARY KEY (id),
                                       KEY fk_categoriaIdIdx (categoriaId)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

TRUNCATE TABLE persona;
INSERT INTO persona (id, nombre, apellidos, telefono, estrella, categoriaId) VALUES
                                                                                 (1, 'Joseph', 'Smith', '600111222', 0, 3),
                                                                                 (3, 'Jose', 'Pérez Pi', '611222333', 0, 1),
                                                                                 (4, 'Cristina', 'Muñoz', '644999444', 1, 8),
                                                                                 (5, 'Laura', 'García', '666777888', 1, 2),
                                                                                 (6, 'Menganito', 'Mengánez', '699888777', 0, 3),
                                                                                 (13, 'Felipe', 'Fernández Ferrero', '684698462', 1, 3);

DROP TABLE IF EXISTS usuario;
CREATE TABLE IF NOT EXISTS usuario (
                                       id int(11) NOT NULL AUTO_INCREMENT,
                                       identificador varchar(40) COLLATE utf8_spanish_ci NOT NULL,
                                       contrasenna varchar(80) COLLATE utf8_spanish_ci NOT NULL,
                                       codigoCookie varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
                                       caducidadCodigoCookie timestamp NULL DEFAULT NULL,
                                       tipoUsuario int(11) NOT NULL,
                                       nombre varchar(50) COLLATE utf8_spanish_ci NOT NULL,
                                       apellidos varchar(50) COLLATE utf8_spanish_ci NOT NULL,
                                       PRIMARY KEY (id)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

TRUNCATE TABLE usuario;
INSERT INTO usuario (id, identificador, contrasenna, codigoCookie, caducidadCodigoCookie, tipoUsuario, nombre, apellidos) VALUES
                                                                                                                              (1, 'jlopez', 'j', NULL, NULL, 1, 'José', 'López'),
                                                                                                                              (2, 'mgarcia', 'm', NULL, NULL, 2, 'María', 'García'),
                                                                                                                              (3, 'fpi', 'f', NULL, NULL, 0, 'Felipe', 'Pi');


ALTER TABLE persona
    ADD CONSTRAINT fk_categoriaId FOREIGN KEY (categoriaId) REFERENCES categoria (id) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;