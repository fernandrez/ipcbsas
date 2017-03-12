-- phpMyAdmin SQL Dump
-- version 4.0.10.12
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generato il: Mar 25, 2016 alle 16:10
-- Versione del server: 5.5.46
-- Versione PHP: 5.6.17

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ipc`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `almacen`
--

DROP TABLE IF EXISTS `almacen`;
CREATE TABLE IF NOT EXISTS `almacen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cadena_id` int(11) NOT NULL,
  `identificador` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `latitud` double DEFAULT NULL,
  `longitud` double DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'active',
  PRIMARY KEY (`id`),
  KEY `fk_almacen_cadena` (`cadena_id`),
  KEY `fk_almacen_created_by` (`created_by`),
  KEY `fk_almacen_updated_by` (`updated_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dump dei dati per la tabella `almacen`
--

INSERT INTO `almacen` (`id`, `cadena_id`, `identificador`, `latitud`, `longitud`, `created_at`, `updated_at`, `created_by`, `updated_by`, `status`) VALUES
(1, 1, 'Rodriguez Peña', NULL, NULL, '2016-03-07 00:41:57', NULL, 1, NULL, 'active'),
(2, 2, 'Nuñez', NULL, NULL, '2016-03-07 00:41:57', NULL, 1, NULL, 'active'),
(3, 2, 'Rodriguez Peña', NULL, NULL, '2016-03-07 00:41:57', NULL, 1, NULL, 'active'),
(4, 3, 'Guido', NULL, NULL, '2016-03-07 00:41:57', NULL, 1, NULL, 'active'),
(5, 3, 'Cabildo', NULL, NULL, '2016-03-07 00:41:57', NULL, 1, NULL, 'active'),
(6, 5, 'Mataderos', NULL, NULL, '2016-03-07 00:41:58', NULL, 1, NULL, 'active'),
(7, 2, 'Vicente Lopez', NULL, NULL, '2016-03-07 01:07:28', '2016-03-07 01:07:37', 1, 1, 'active'),
(8, 2, 'Cabildo', NULL, NULL, '2016-03-16 23:44:56', NULL, 1, 1, 'active'),
(9, 6, 'Barrio Chino', NULL, NULL, '2016-03-16 23:46:43', NULL, 1, 1, 'active'),
(10, 7, 'Olazabal', NULL, NULL, '2016-03-20 21:09:20', NULL, 1, 1, 'active');

-- --------------------------------------------------------

--
-- Struttura della tabella `auth_assignment`
--

DROP TABLE IF EXISTS `auth_assignment`;
CREATE TABLE IF NOT EXISTS `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dump dei dati per la tabella `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('admin', '1', 1458940222),
('admin', '2', 1458940222);

-- --------------------------------------------------------

--
-- Struttura della tabella `auth_item`
--

DROP TABLE IF EXISTS `auth_item`;
CREATE TABLE IF NOT EXISTS `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dump dei dati per la tabella `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('admin', 1, NULL, NULL, NULL, 1458940222, 1458940222),
('geo-ciudad-borrar', 2, 'geo-ciudad-borrar', NULL, NULL, 1458940222, 1458940222),
('geo-ciudad-crear', 2, 'geo-ciudad-crear', NULL, NULL, 1458940222, 1458940222),
('geo-ciudad-editar', 2, 'geo-ciudad-editar', NULL, NULL, 1458940222, 1458940222),
('geo-ciudad-full-controller-permission', 2, 'geo-ciudad-full-controller-permission', NULL, NULL, 1458940222, 1458940222),
('geo-ciudad-get-ciudades-region', 2, 'geo-ciudad-get-ciudades-region', NULL, NULL, 1458940222, 1458940222),
('geo-ciudad-index', 2, 'geo-ciudad-index', NULL, NULL, 1458940222, 1458940222),
('geo-ciudad-ver', 2, 'geo-ciudad-ver', NULL, NULL, 1458940222, 1458940222),
('geo-default-full-controller-permission', 2, 'geo-default-full-controller-permission', NULL, NULL, 1458940222, 1458940222),
('geo-default-index', 2, 'geo-default-index', NULL, NULL, 1458940222, 1458940222),
('geo-pais-borrar', 2, 'geo-pais-borrar', NULL, NULL, 1458940222, 1458940222),
('geo-pais-crear', 2, 'geo-pais-crear', NULL, NULL, 1458940222, 1458940222),
('geo-pais-editar', 2, 'geo-pais-editar', NULL, NULL, 1458940222, 1458940222),
('geo-pais-full-controller-permission', 2, 'geo-pais-full-controller-permission', NULL, NULL, 1458940222, 1458940222),
('geo-pais-index', 2, 'geo-pais-index', NULL, NULL, 1458940222, 1458940222),
('geo-pais-ver', 2, 'geo-pais-ver', NULL, NULL, 1458940222, 1458940222),
('geo-region-borrar', 2, 'geo-region-borrar', NULL, NULL, 1458940222, 1458940222),
('geo-region-crear', 2, 'geo-region-crear', NULL, NULL, 1458940222, 1458940222),
('geo-region-editar', 2, 'geo-region-editar', NULL, NULL, 1458940222, 1458940222),
('geo-region-full-controller-permission', 2, 'geo-region-full-controller-permission', NULL, NULL, 1458940222, 1458940222),
('geo-region-get-regiones-pais', 2, 'geo-region-get-regiones-pais', NULL, NULL, 1458940222, 1458940222),
('geo-region-index', 2, 'geo-region-index', NULL, NULL, 1458940222, 1458940222),
('geo-region-ver', 2, 'geo-region-ver', NULL, NULL, 1458940222, 1458940222),
('parametros-listado-borrar', 2, 'parametros-listado-borrar', NULL, NULL, 1458940222, 1458940222),
('parametros-listado-crear', 2, 'parametros-listado-crear', NULL, NULL, 1458940222, 1458940222),
('parametros-listado-editar', 2, 'parametros-listado-editar', NULL, NULL, 1458940222, 1458940222),
('parametros-listado-full-controller-permission', 2, 'parametros-listado-full-controller-permission', NULL, NULL, 1458940222, 1458940222),
('parametros-listado-index', 2, 'parametros-listado-index', NULL, NULL, 1458940222, 1458940222),
('parametros-listado-ver', 2, 'parametros-listado-ver', NULL, NULL, 1458940222, 1458940222),
('registro-almacen-create', 2, 'registro-almacen-create', NULL, NULL, 1458940222, 1458940222),
('registro-almacen-delete', 2, 'registro-almacen-delete', NULL, NULL, 1458940222, 1458940222),
('registro-almacen-full-controller-permission', 2, 'registro-almacen-full-controller-permission', NULL, NULL, 1458940222, 1458940222),
('registro-almacen-index', 2, 'registro-almacen-index', NULL, NULL, 1458940222, 1458940222),
('registro-almacen-update', 2, 'registro-almacen-update', NULL, NULL, 1458940222, 1458940222),
('registro-almacen-view', 2, 'registro-almacen-view', NULL, NULL, 1458940222, 1458940222),
('registro-cadena-create', 2, 'registro-cadena-create', NULL, NULL, 1458940222, 1458940222),
('registro-cadena-delete', 2, 'registro-cadena-delete', NULL, NULL, 1458940222, 1458940222),
('registro-cadena-full-controller-permission', 2, 'registro-cadena-full-controller-permission', NULL, NULL, 1458940222, 1458940222),
('registro-cadena-index', 2, 'registro-cadena-index', NULL, NULL, 1458940222, 1458940222),
('registro-cadena-update', 2, 'registro-cadena-update', NULL, NULL, 1458940222, 1458940222),
('registro-cadena-view', 2, 'registro-cadena-view', NULL, NULL, 1458940222, 1458940222),
('registro-categoria-create', 2, 'registro-categoria-create', NULL, NULL, 1458940222, 1458940222),
('registro-categoria-delete', 2, 'registro-categoria-delete', NULL, NULL, 1458940222, 1458940222),
('registro-categoria-full-controller-permission', 2, 'registro-categoria-full-controller-permission', NULL, NULL, 1458940222, 1458940222),
('registro-categoria-index', 2, 'registro-categoria-index', NULL, NULL, 1458940222, 1458940222),
('registro-categoria-update', 2, 'registro-categoria-update', NULL, NULL, 1458940222, 1458940222),
('registro-categoria-view', 2, 'registro-categoria-view', NULL, NULL, 1458940222, 1458940222),
('registro-crud-create', 2, 'registro-crud-create', NULL, NULL, 1458940222, 1458940222),
('registro-crud-delete', 2, 'registro-crud-delete', NULL, NULL, 1458940222, 1458940222),
('registro-crud-full-controller-permission', 2, 'registro-crud-full-controller-permission', NULL, NULL, 1458940222, 1458940222),
('registro-crud-index', 2, 'registro-crud-index', NULL, NULL, 1458940222, 1458940222),
('registro-crud-update', 2, 'registro-crud-update', NULL, NULL, 1458940222, 1458940222),
('registro-crud-view', 2, 'registro-crud-view', NULL, NULL, 1458940222, 1458940222),
('registro-default-chart', 2, 'registro-default-chart', NULL, NULL, 1458940222, 1458940222),
('registro-default-full-controller-permission', 2, 'registro-default-full-controller-permission', NULL, NULL, 1458940222, 1458940222),
('registro-default-index', 2, 'registro-default-index', NULL, NULL, 1458940222, 1458940222),
('user-admin-assignments', 2, 'user-admin-assignments', NULL, NULL, 1458940222, 1458940222),
('user-admin-block', 2, 'user-admin-block', NULL, NULL, 1458940222, 1458940222),
('user-admin-confirm', 2, 'user-admin-confirm', NULL, NULL, 1458940222, 1458940222),
('user-admin-create', 2, 'user-admin-create', NULL, NULL, 1458940222, 1458940222),
('user-admin-delete', 2, 'user-admin-delete', NULL, NULL, 1458940222, 1458940222),
('user-admin-full-controller-permission', 2, 'user-admin-full-controller-permission', NULL, NULL, 1458940222, 1458940222),
('user-admin-index', 2, 'user-admin-index', NULL, NULL, 1458940222, 1458940222),
('user-admin-info', 2, 'user-admin-info', NULL, NULL, 1458940222, 1458940222),
('user-admin-update', 2, 'user-admin-update', NULL, NULL, 1458940222, 1458940222),
('user-admin-update-profile', 2, 'user-admin-update-profile', NULL, NULL, 1458940222, 1458940222);

-- --------------------------------------------------------

--
-- Struttura della tabella `auth_item_child`
--

DROP TABLE IF EXISTS `auth_item_child`;
CREATE TABLE IF NOT EXISTS `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dump dei dati per la tabella `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('geo-ciudad-full-controller-permission', 'geo-ciudad-borrar'),
('geo-ciudad-full-controller-permission', 'geo-ciudad-crear'),
('geo-ciudad-full-controller-permission', 'geo-ciudad-editar'),
('admin', 'geo-ciudad-full-controller-permission'),
('geo-ciudad-full-controller-permission', 'geo-ciudad-get-ciudades-region'),
('geo-ciudad-full-controller-permission', 'geo-ciudad-index'),
('geo-ciudad-full-controller-permission', 'geo-ciudad-ver'),
('admin', 'geo-default-full-controller-permission'),
('geo-default-full-controller-permission', 'geo-default-index'),
('geo-pais-full-controller-permission', 'geo-pais-borrar'),
('geo-pais-full-controller-permission', 'geo-pais-crear'),
('geo-pais-full-controller-permission', 'geo-pais-editar'),
('admin', 'geo-pais-full-controller-permission'),
('geo-pais-full-controller-permission', 'geo-pais-index'),
('geo-pais-full-controller-permission', 'geo-pais-ver'),
('geo-region-full-controller-permission', 'geo-region-borrar'),
('geo-region-full-controller-permission', 'geo-region-crear'),
('geo-region-full-controller-permission', 'geo-region-editar'),
('admin', 'geo-region-full-controller-permission'),
('geo-region-full-controller-permission', 'geo-region-get-regiones-pais'),
('geo-region-full-controller-permission', 'geo-region-index'),
('geo-region-full-controller-permission', 'geo-region-ver'),
('parametros-listado-full-controller-permission', 'parametros-listado-borrar'),
('parametros-listado-full-controller-permission', 'parametros-listado-crear'),
('parametros-listado-full-controller-permission', 'parametros-listado-editar'),
('admin', 'parametros-listado-full-controller-permission'),
('parametros-listado-full-controller-permission', 'parametros-listado-index'),
('parametros-listado-full-controller-permission', 'parametros-listado-ver'),
('registro-almacen-full-controller-permission', 'registro-almacen-create'),
('registro-almacen-full-controller-permission', 'registro-almacen-delete'),
('admin', 'registro-almacen-full-controller-permission'),
('registro-almacen-full-controller-permission', 'registro-almacen-index'),
('registro-almacen-full-controller-permission', 'registro-almacen-update'),
('registro-almacen-full-controller-permission', 'registro-almacen-view'),
('registro-cadena-full-controller-permission', 'registro-cadena-create'),
('registro-cadena-full-controller-permission', 'registro-cadena-delete'),
('admin', 'registro-cadena-full-controller-permission'),
('registro-cadena-full-controller-permission', 'registro-cadena-index'),
('registro-cadena-full-controller-permission', 'registro-cadena-update'),
('registro-cadena-full-controller-permission', 'registro-cadena-view'),
('registro-categoria-full-controller-permission', 'registro-categoria-create'),
('registro-categoria-full-controller-permission', 'registro-categoria-delete'),
('admin', 'registro-categoria-full-controller-permission'),
('registro-categoria-full-controller-permission', 'registro-categoria-index'),
('registro-categoria-full-controller-permission', 'registro-categoria-update'),
('registro-categoria-full-controller-permission', 'registro-categoria-view'),
('registro-crud-full-controller-permission', 'registro-crud-create'),
('registro-crud-full-controller-permission', 'registro-crud-delete'),
('admin', 'registro-crud-full-controller-permission'),
('registro-crud-full-controller-permission', 'registro-crud-index'),
('registro-crud-full-controller-permission', 'registro-crud-update'),
('registro-crud-full-controller-permission', 'registro-crud-view'),
('registro-default-full-controller-permission', 'registro-default-chart'),
('admin', 'registro-default-full-controller-permission'),
('registro-default-full-controller-permission', 'registro-default-index'),
('user-admin-full-controller-permission', 'user-admin-assignments'),
('user-admin-full-controller-permission', 'user-admin-block'),
('user-admin-full-controller-permission', 'user-admin-confirm'),
('user-admin-full-controller-permission', 'user-admin-create'),
('user-admin-full-controller-permission', 'user-admin-delete'),
('admin', 'user-admin-full-controller-permission'),
('user-admin-full-controller-permission', 'user-admin-index'),
('user-admin-full-controller-permission', 'user-admin-info'),
('user-admin-full-controller-permission', 'user-admin-update'),
('user-admin-full-controller-permission', 'user-admin-update-profile');

-- --------------------------------------------------------

--
-- Struttura della tabella `auth_rule`
--

DROP TABLE IF EXISTS `auth_rule`;
CREATE TABLE IF NOT EXISTS `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `cadena`
--

DROP TABLE IF EXISTS `cadena`;
CREATE TABLE IF NOT EXISTS `cadena` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pais_origen` varchar(1023) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'active',
  PRIMARY KEY (`id`),
  KEY `fk_cadena_created_by` (`created_by`),
  KEY `fk_cadena_updated_by` (`updated_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dump dei dati per la tabella `cadena`
--

INSERT INTO `cadena` (`id`, `titulo`, `pais_origen`, `created_at`, `updated_at`, `created_by`, `updated_by`, `status`) VALUES
(1, 'Disco', NULL, '2016-03-07 00:41:57', NULL, 1, NULL, 'active'),
(2, 'Carrefour', NULL, '2016-03-07 00:41:57', NULL, 1, NULL, 'active'),
(3, 'Fruver', NULL, '2016-03-07 00:41:57', NULL, 1, NULL, 'active'),
(4, 'Farmacity', NULL, '2016-03-07 00:41:57', NULL, 1, NULL, 'active'),
(5, 'Chalin', NULL, '2016-03-07 00:41:58', NULL, 1, NULL, 'active'),
(6, 'Casa China', 'China', '2016-03-16 23:46:15', NULL, 1, 1, 'active'),
(7, 'Super Chunghwa', 'China', '2016-03-20 21:08:58', '2016-03-21 11:27:12', 1, 1, 'active');

-- --------------------------------------------------------

--
-- Struttura della tabella `categoria`
--

DROP TABLE IF EXISTS `categoria`;
CREATE TABLE IF NOT EXISTS `categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'active',
  PRIMARY KEY (`id`),
  KEY `fk_categoria_created_by` (`created_by`),
  KEY `fk_categoria_updated_by` (`updated_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=24 ;

--
-- Dump dei dati per la tabella `categoria`
--

INSERT INTO `categoria` (`id`, `titulo`, `descripcion`, `created_at`, `updated_at`, `created_by`, `updated_by`, `status`) VALUES
(1, 'Carnes', 'Pechuga Pollo, Chorizo Gancho, Muslos Pollo, Bondiola, Carre de Cerdo, Carne Picada, Nalga, Bola de Lomo, Fuet, Carne Molida, Carne Molida Tartare, Mix Pollo, Cuadril, Colita de Cuadril, Paleta, Palomita, Roast Beef, Tortuguita, Riñonada, Arañita, Asado', '2016-03-07 00:41:57', '2016-03-07 00:41:58', 1, NULL, 'active'),
(2, 'Cereales', 'Choco Krispis, Honey Graham, Zucaritas', '2016-03-07 00:41:57', '2016-03-07 00:41:57', 1, NULL, 'active'),
(3, 'Enlatados', 'Poroto Lata', '2016-03-07 00:41:57', NULL, 1, NULL, 'active'),
(4, 'Frutas', 'Fresa, Manzana, Naranja, Uva, Aceituna, Damasco, Limon, Banano, Pera, Frutilla', '2016-03-07 00:41:57', '2016-03-07 00:41:58', 1, NULL, 'active'),
(5, 'Galletas', 'Pepitos, Vainillas', '2016-03-07 00:41:57', '2016-03-07 00:41:58', 1, NULL, 'active'),
(6, 'Panes', 'Pan Tajado', '2016-03-07 00:41:57', NULL, 1, NULL, 'active'),
(7, 'Lacteos', 'Crema de Leche, Yogurt, Queso Cheddar, Danbo, Queso Mozzarella, Flan Caramelo, 4 Quesos, Saladix', '2016-03-07 00:41:57', '2016-03-07 00:41:58', 1, NULL, 'active'),
(8, 'Panaderia', 'Medialuna, Rapiditas', '2016-03-07 00:41:57', '2016-03-07 00:41:57', 1, NULL, 'active'),
(9, 'Higiene', 'Papel Higienico, Shampoo, Crema Dental, Cepillo Dental, Enjuague Bucal Plax, Alcohol, Algodon', '2016-03-07 00:41:57', '2016-03-07 00:41:58', 1, NULL, 'active'),
(10, 'Verduras', 'Brocoli, Cebolla, Choclo, Puerro, Tomate, Zanahoria, Papa Negra, Pimiento Rojo, Lechuga Mantecosa, Tomate Cherry, Ajo, Chaucha, Batata, Morron Verde, Pepino, Chocolo, Palta', '2016-03-07 00:41:57', '2016-03-07 00:41:59', 1, NULL, 'active'),
(11, 'Bebidas', 'Nectar', '2016-03-07 00:41:57', NULL, 1, NULL, 'active'),
(12, 'Embutidos', 'Jamon Cocido, Mortadela, Paleta Cocida', '2016-03-07 00:41:57', '2016-03-07 00:41:58', 1, NULL, 'active'),
(13, 'Pasta', 'Tallarin, Tirabuzon, Pamperito, Spaghetti, Coditos, Cabello de Angel, Letras', '2016-03-07 00:41:57', '2016-03-07 00:41:59', 1, NULL, 'active'),
(14, 'Granos', 'Arroz, Lenteja, Garbanzos', '2016-03-07 00:41:57', '2016-03-07 00:41:58', 1, NULL, 'active'),
(15, 'Aceites', 'Aceite de Oliva, Aceite de Girasol', '2016-03-07 00:41:57', '2016-03-07 00:41:57', 1, NULL, 'active'),
(16, 'Aderezos', 'Aceto Balsámico, Sal Fina Corrediza, Azucar', '2016-03-07 00:41:57', '2016-03-07 00:41:58', 1, NULL, 'active'),
(17, 'Licores', 'Cerveza Blanca, Cerveza Rubia', '2016-03-07 00:41:58', '2016-03-07 00:41:58', 1, NULL, 'active'),
(18, 'Detergentes', 'Quitamanchas, Lavandina, Jabon Barra, Suavizante', '2016-03-07 00:41:58', '2016-03-07 00:41:59', 1, NULL, 'active'),
(19, 'Bolsas', 'Bolsas Multiusos Cierre Hermetico', '2016-03-07 00:41:58', NULL, 1, NULL, 'active'),
(20, 'Especias', 'Comino Molido, Oregano Hojas, Romero, Pimienta Blanca Molida, Laurel Hojas', '2016-03-07 00:41:58', '2016-03-07 00:41:58', 1, NULL, 'active'),
(21, 'Te', 'Te Negro, Te Verde', '2016-03-07 00:41:58', '2016-03-07 00:41:58', 1, NULL, 'active'),
(22, 'Dulces', 'Gomitas', '2016-03-09 00:25:53', NULL, 1, 1, 'active'),
(23, 'Tocador', 'Crema Corporal', '2016-03-19 00:12:59', NULL, 1, 1, 'active');

-- --------------------------------------------------------

--
-- Struttura della tabella `ciudad`
--

DROP TABLE IF EXISTS `ciudad`;
CREATE TABLE IF NOT EXISTS `ciudad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pais_id` int(11) NOT NULL,
  `pais_cd` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `region_id` int(11) NOT NULL,
  `region_cd` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'activa',
  PRIMARY KEY (`id`),
  KEY `fk_ciudad_region` (`region_id`),
  KEY `fk_ciudad_pais` (`pais_id`),
  KEY `fk_ciudad_created_by` (`created_by`),
  KEY `fk_ciudad_updated_by` (`updated_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dump dei dati per la tabella `ciudad`
--

INSERT INTO `ciudad` (`id`, `pais_id`, `pais_cd`, `region_id`, `region_cd`, `nombre`, `created_at`, `updated_at`, `created_by`, `updated_by`, `status`) VALUES
(1, 1, 'AR', 1, 'BUE', 'Capital', '2016-01-31 22:49:31', NULL, 1, NULL, 'activa');

-- --------------------------------------------------------

--
-- Struttura della tabella `direccion`
--

DROP TABLE IF EXISTS `direccion`;
CREATE TABLE IF NOT EXISTS `direccion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `via_id` int(11) NOT NULL,
  `numero_via` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `mod_via_id` int(11) DEFAULT NULL,
  `cruce_id` int(11) DEFAULT NULL,
  `numero_cruce` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `mod_cruce_id` int(11) DEFAULT NULL,
  `numero_entrada` int(11) NOT NULL,
  `interior_id` int(11) DEFAULT NULL,
  `numero_interior` int(11) DEFAULT NULL,
  `comentario` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `full` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `full_verbose` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'activa',
  PRIMARY KEY (`id`),
  KEY `fk_via` (`via_id`),
  KEY `fk_cruce` (`cruce_id`),
  KEY `fk_mod_via` (`mod_via_id`),
  KEY `fk_mod_cruce` (`mod_cruce_id`),
  KEY `fk_interior` (`interior_id`),
  KEY `fk_direccion_created_by` (`created_by`),
  KEY `fk_direccion_updated_by` (`updated_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `direccion_parametro`
--

DROP TABLE IF EXISTS `direccion_parametro`;
CREATE TABLE IF NOT EXISTS `direccion_parametro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `codigo` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `titulo` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'activo',
  PRIMARY KEY (`id`),
  UNIQUE KEY `codigo` (`codigo`),
  UNIQUE KEY `titulo` (`titulo`),
  KEY `fk_direccion_parametro_created_by` (`created_by`),
  KEY `fk_direccion_parametro_updated_by` (`updated_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=14 ;

--
-- Dump dei dati per la tabella `direccion_parametro`
--

INSERT INTO `direccion_parametro` (`id`, `tipo`, `codigo`, `titulo`, `descripcion`, `created_at`, `updated_at`, `created_by`, `updated_by`, `status`) VALUES
(1, 'via', 'CL', 'Calle', 'Calle', '2016-01-31 22:49:31', NULL, 1, NULL, 'activo'),
(2, 'via', 'KR', 'Carrera', 'Carrera', '2016-01-31 22:49:31', NULL, 1, NULL, 'activo'),
(3, 'via', 'TR', 'Transversal', 'Transversal', '2016-01-31 22:49:31', NULL, 1, NULL, 'activo'),
(4, 'via', 'DG', 'Diagonal', 'Diagonal', '2016-01-31 22:49:31', NULL, 1, NULL, 'activo'),
(5, 'via', 'CR', 'Circular', 'Circular', '2016-01-31 22:49:31', NULL, 1, NULL, 'activo'),
(6, 'via', 'Via', 'Via', 'Via', '2016-01-31 22:49:31', NULL, 1, NULL, 'activo'),
(7, 'mod', 'S', 'Sur', 'Sur', '2016-01-31 22:49:31', NULL, 1, NULL, 'activo'),
(8, 'mod', 'N', 'Norte', 'Norte', '2016-01-31 22:49:31', NULL, 1, NULL, 'activo'),
(9, 'interior', 'Apt', 'Apartamento', 'Apartamento', '2016-01-31 22:49:31', NULL, 1, NULL, 'activo'),
(10, 'interior', 'Casa', 'Casa', 'Casa', '2016-01-31 22:49:31', NULL, 1, NULL, 'activo'),
(11, 'interior', 'Bod', 'Bodega', 'Bodega', '2016-01-31 22:49:31', NULL, 1, NULL, 'activo'),
(12, 'interior', 'Lote', 'Lote', 'Lote', '2016-01-31 22:49:31', NULL, 1, NULL, 'activo'),
(13, 'interior', 'Int', 'Interior', 'Interior', '2016-01-31 22:49:31', NULL, 1, NULL, 'activo');

-- --------------------------------------------------------

--
-- Struttura della tabella `migration`
--

DROP TABLE IF EXISTS `migration`;
CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1454280508),
('m010306_180000_categorias', 1457311290),
('m010306_180010_almacenes', 1457311290),
('m010306_190000_regcatalm', 1457311290),
('m140209_132017_init', 1454280511),
('m140403_174025_create_account_table', 1454280511),
('m140504_113157_update_tables', 1454280512),
('m140504_130429_create_token_table', 1454280512),
('m140506_102106_rbac_init', 1454280538),
('m140830_171933_fix_ip_field', 1454280512),
('m140830_172703_change_account_table_name', 1454280512),
('m141222_110026_update_ip_field', 1454280512),
('m141222_135246_alter_username_length', 1454280512),
('m150614_103145_update_social_account_table', 1454280512),
('m150623_212711_fix_username_notnull', 1454280512),
('m150812_234523_geo', 1454280557),
('m150820_224900_parametros', 1454280557),
('m160123_230000_reg', 1454280557);

-- --------------------------------------------------------

--
-- Struttura della tabella `pais`
--

DROP TABLE IF EXISTS `pais`;
CREATE TABLE IF NOT EXISTS `pais` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pais_cd` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'activo',
  PRIMARY KEY (`id`),
  KEY `fk_pais_created_by` (`created_by`),
  KEY `fk_pais_updated_by` (`updated_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dump dei dati per la tabella `pais`
--

INSERT INTO `pais` (`id`, `pais_cd`, `nombre`, `created_at`, `updated_at`, `created_by`, `updated_by`, `status`) VALUES
(1, 'AR', 'Argentina', '2016-01-31 22:49:31', NULL, 1, NULL, 'activo');

-- --------------------------------------------------------

--
-- Struttura della tabella `parametro`
--

DROP TABLE IF EXISTS `parametro`;
CREATE TABLE IF NOT EXISTS `parametro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `valor` varchar(1200) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_inicio` datetime NOT NULL,
  `fecha_fin` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'activo',
  PRIMARY KEY (`id`),
  KEY `fk_parametro_created_by` (`created_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `profile`
--

DROP TABLE IF EXISTS `profile`;
CREATE TABLE IF NOT EXISTS `profile` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `public_email` varchar(255) DEFAULT NULL,
  `gravatar_email` varchar(255) DEFAULT NULL,
  `gravatar_id` varchar(32) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `bio` text,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `profile`
--

INSERT INTO `profile` (`user_id`, `name`, `public_email`, `gravatar_email`, `gravatar_id`, `location`, `website`, `bio`) VALUES
(1, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `region`
--

DROP TABLE IF EXISTS `region`;
CREATE TABLE IF NOT EXISTS `region` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pais_id` int(11) NOT NULL,
  `pais_cd` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `region_cd` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'activa',
  PRIMARY KEY (`id`),
  KEY `fk_region_pais` (`pais_id`),
  KEY `fk_region_created_by` (`created_by`),
  KEY `fk_region_updated_by` (`updated_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dump dei dati per la tabella `region`
--

INSERT INTO `region` (`id`, `pais_id`, `pais_cd`, `region_cd`, `nombre`, `created_at`, `updated_at`, `created_by`, `updated_by`, `status`) VALUES
(1, 1, 'AR', 'BUE', 'Buenos Aires', '2016-01-31 22:49:31', NULL, 1, NULL, 'activa');

-- --------------------------------------------------------

--
-- Struttura della tabella `registro`
--

DROP TABLE IF EXISTS `registro`;
CREATE TABLE IF NOT EXISTS `registro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `almacen` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `categoria` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `elemento` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `marca` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descripcion` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fecha` date NOT NULL,
  `cantidad` double NOT NULL,
  `unidad` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `precio` double NOT NULL,
  `precio_unitario` double NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'active',
  `cadena_id` int(11) DEFAULT NULL,
  `almacen_id` int(11) DEFAULT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_registro_created_by` (`created_by`),
  KEY `fk_registro_updated_by` (`updated_by`),
  KEY `fk_registro_cadena` (`cadena_id`),
  KEY `fk_registro_almacen` (`almacen_id`),
  KEY `fk_registro_categoria` (`categoria_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=353 ;

--
-- Dump dei dati per la tabella `registro`
--

INSERT INTO `registro` (`id`, `almacen`, `categoria`, `elemento`, `marca`, `descripcion`, `fecha`, `cantidad`, `unidad`, `precio`, `precio_unitario`, `created_at`, `updated_at`, `created_by`, `updated_by`, `status`, `cadena_id`, `almacen_id`, `categoria_id`) VALUES
(1, 'Disco Rodriguez Peña', 'Carnes', 'Pechuga Pollo', '', '', '2015-12-27', 1, 'kg', 85, 85, '2016-01-31 22:49:31', '2016-03-07 00:41:57', 1, NULL, 'active', 1, 1, 1),
(2, 'Carrefour Nuñez', 'Carnes', 'Chorizo Gancho', '', '', '2016-01-21', 1, 'kg', 75, 75, '2016-01-31 22:49:31', '2016-03-07 00:41:57', 1, NULL, 'active', 2, 2, 1),
(3, 'Carrefour Nuñez', 'Carnes', 'Muslos Pollo', '', '', '2016-01-21', 1, 'kg', 42, 42, '2016-01-31 22:49:31', '2016-03-07 00:41:57', 1, NULL, 'inactive', 2, 2, 1),
(4, 'Carrefour Rodriguez Peña', 'Carnes', 'Bondiola', '', '', '2015-12-30', 1, 'kg', 103, 103, '2016-01-31 22:49:31', '2016-03-07 00:41:57', 1, NULL, 'active', 2, 3, 1),
(5, 'Carrefour Nuñez', 'Carnes', 'Bondiola', '', '', '2016-01-21', 1, 'kg', 114, 114, '2016-01-31 22:49:31', '2016-03-07 00:41:57', 1, NULL, 'inactive', 2, 2, 1),
(6, 'Disco Rodriguez Peña', 'Carnes', 'Bondiola', '', '', '2015-12-30', 1, 'kg', 129.99, 129.99, '2016-01-31 22:49:31', '2016-03-07 00:41:57', 1, NULL, 'active', 1, 1, 1),
(7, 'Carrefour Rodriguez Peña', 'Carnes', 'Carre de Cerdo', '', '', '2015-12-30', 1, 'kg', 115, 115, '2016-01-31 22:49:32', '2016-03-07 00:41:57', 1, NULL, 'active', 2, 3, 1),
(8, 'Disco Rodriguez Peña', 'Carnes', 'Carre de Cerdo', '', '', '2015-12-30', 1, 'kg', 140.39, 140.39, '2016-01-31 22:49:32', '2016-03-07 00:41:57', 1, NULL, 'active', 1, 1, 1),
(9, 'Carrefour Rodriguez Peña', 'Carnes', 'Carne Picada', '', '', '2015-12-30', 1, 'kg', 94.9, 94.9, '2016-01-31 22:49:32', '2016-03-07 00:41:57', 1, NULL, 'active', 2, 3, 1),
(10, 'Disco Rodriguez Peña', 'Carnes', 'Carne Picada', '', '', '2015-12-30', 1, 'kg', 89.9, 89.9, '2016-01-31 22:49:32', '2016-03-07 00:41:57', 1, NULL, 'active', 1, 1, 1),
(11, 'Disco Rodriguez Peña', 'Carnes', 'Nalga', '', '', '2015-12-30', 1, 'kg', 143.99, 143.99, '2016-01-31 22:49:32', '2016-03-07 00:41:57', 1, NULL, 'active', 1, 1, 1),
(12, 'Disco Rodriguez Peña', 'Carnes', 'Bola de Lomo', '', '', '2015-12-30', 1, 'kg', 129.99, 129.99, '2016-01-31 22:49:32', '2016-03-07 00:41:57', 1, NULL, 'active', 1, 1, 1),
(13, 'Disco Rodriguez Peña', 'Cereales', 'Choco Krispis', 'Kellogs', '', '2015-12-27', 0.35, 'kg', 54.1, 154.57142857143, '2016-01-31 22:49:32', '2016-03-07 00:41:57', 1, NULL, 'active', 1, 1, 2),
(14, 'Carrefour Rodriguez Peña', 'Cereales', 'Honey Graham', 'Quaker', '', '2015-12-27', 0.2, 'kg', 30, 150, '2016-01-31 22:49:32', '2016-03-07 00:41:57', 1, NULL, 'active', 2, 3, 2),
(15, 'Carrefour Rodriguez Peña', 'Cereales', 'Zucaritas', 'Kellogs', '', '2015-12-27', 0.3, 'kg', 33.6, 112, '2016-01-31 22:49:32', '2016-03-07 00:41:57', 1, NULL, 'active', 2, 3, 2),
(16, 'Disco Rodriguez Peña', 'Cereales', 'Zucaritas', 'Kellogs', '', '2015-12-27', 0.3, 'kg', 35.25, 117.5, '2016-01-31 22:49:32', '2016-03-07 00:41:57', 1, NULL, 'active', 1, 1, 2),
(17, 'Disco Rodriguez Peña', 'Enlatados', 'Poroto Lata', 'Jumbo', '', '2015-12-27', 1, 'kg', 52, 52, '2016-01-31 22:49:32', '2016-03-07 00:41:57', 1, NULL, 'active', 1, 1, 3),
(18, 'Disco Rodriguez Peña', 'Frutas', 'Fresa', '', '', '2015-12-27', 1, 'kg', 80, 80, '2016-01-31 22:49:32', '2016-03-07 00:41:57', 1, NULL, 'active', 1, 1, 4),
(19, 'Fruver Guido', 'Frutas', 'Manzana', '', '', '2015-12-28', 2, 'kg', 45, 22.5, '2016-01-31 22:49:32', '2016-03-07 00:41:57', 1, NULL, 'active', 3, 4, 4),
(20, 'Fruver Guido', 'Frutas', 'Naranja', '', '', '2015-12-28', 2, 'kg', 25, 12.5, '2016-01-31 22:49:32', '2016-03-07 00:41:57', 1, NULL, 'active', 3, 4, 4),
(21, 'Disco Rodriguez Peña', 'Frutas', 'Uva', '', '', '2015-12-27', 1, 'kg', 50, 50, '2016-01-31 22:49:32', '2016-03-07 00:41:57', 1, NULL, 'active', 1, 1, 4),
(22, 'Carrefour Rodriguez Peña', 'Galletas', 'Pepitos', 'Pepitos', 'Mini', '2015-12-27', 0.15, 'kg', 18, 120, '2016-01-31 22:49:32', '2016-03-07 00:41:57', 1, NULL, 'active', 2, 3, 5),
(23, 'Disco Rodriguez Peña', 'Galletas', 'Pepitos', 'Pepitos', '', '2015-12-27', 0.354, 'kg', 33.85, 95.621468926554, '2016-01-31 22:49:32', '2016-03-07 00:41:57', 1, NULL, 'active', 1, 1, 5),
(24, 'Carrefour Rodriguez Peña', 'Panes', 'Pan Tajado', 'Oroweat', 'Pan Semillas', '2015-12-30', 0.6, 'kg', 57, 95, '2016-01-31 22:49:32', '2016-03-07 00:41:57', 1, NULL, 'active', 2, 3, 6),
(25, 'Disco Rodriguez Peña', 'Panes', 'Pan Tajado', 'Oroweat', 'Pan Semillas', '2015-12-30', 0.6, 'kg', 68.1, 113.5, '2016-01-31 22:49:32', '2016-03-07 00:41:57', 1, NULL, 'active', 1, 1, 6),
(26, 'Carrefour Rodriguez Peña', 'Panes', 'Pan Tajado', 'Oroweat', 'Pan Cereales', '2015-12-30', 0.6, 'kg', 57, 95, '2016-01-31 22:49:32', '2016-03-07 00:41:57', 1, NULL, 'active', 2, 1, 6),
(27, 'Disco Rodriguez Peña', 'Panes', 'Pan Tajado', 'Oroweat', 'Pan Cereales', '2015-12-30', 0.6, 'kg', 68.1, 113.5, '2016-01-31 22:49:32', '2016-03-07 00:41:57', 1, NULL, 'active', 1, 1, 6),
(28, 'Carrefour Rodriguez Peña', 'Panes', 'Pan Tajado', 'Bimbo', 'Liviano', '2015-12-30', 0.4, 'kg', 39, 97.5, '2016-01-31 22:49:32', '2016-03-07 00:41:57', 1, NULL, 'active', 2, 3, 6),
(29, 'Disco Rodriguez Peña', 'Panes', 'Pan Tajado', 'Bimbo', 'Liviano', '2015-12-30', 0.4, 'kg', 39, 97.5, '2016-01-31 22:49:32', '2016-03-07 00:41:57', 1, NULL, 'active', 1, 1, 6),
(30, 'Carrefour Rodriguez Peña', 'Panes', 'Pan Tajado', 'Bimbo', 'Acti Leche', '2015-12-30', 0.4, 'kg', 39, 97.5, '2016-01-31 22:49:32', '2016-03-07 00:41:57', 1, NULL, 'active', 2, 3, 6),
(31, 'Disco Rodriguez Peña', 'Panes', 'Pan Tajado', 'Bimbo', 'Acti Leche', '2015-12-30', 0.4, 'kg', 39, 97.5, '2016-01-31 22:49:32', '2016-03-07 00:41:57', 1, NULL, 'active', 1, 1, 6),
(32, 'Carrefour Rodriguez Peña', 'Lacteos', 'Crema de Leche', 'Carrefour', '', '2015-12-28', 0.2, 'l', 10.25, 51.25, '2016-01-31 22:49:32', '2016-03-07 00:41:57', 1, NULL, 'active', 2, 3, 7),
(33, 'Carrefour Rodriguez Peña', 'Lacteos', 'Leche', 'Carrefour', 'Entera', '2015-12-27', 1, 'l', 10, 10, '2016-01-31 22:49:32', '2016-03-07 00:41:57', 1, NULL, 'active', 2, 3, 7),
(34, 'Carrefour Rodriguez Peña', 'Lacteos', 'Leche', 'La Serenisima', 'Parcialmente Descremada', '2015-12-30', 1, 'l', 15.4, 15.4, '2016-01-31 22:49:32', '2016-03-07 00:41:57', 1, NULL, 'active', 2, 3, 7),
(35, 'Disco Rodriguez Peña ', 'Lacteos', 'Leche', 'La Serenisima', 'Parcialmente Descremada', '2015-12-30', 1, 'l', 15.79, 15.79, '2016-01-31 22:49:32', '2016-03-07 00:41:57', 1, NULL, 'active', 1, 1, 7),
(36, 'Disco Rodriguez Peña', 'Lacteos', 'Leche', 'La Serenisima', 'Entera', '2015-12-27', 1, 'l', 10, 10, '2016-01-31 22:49:32', '2016-03-07 00:41:57', 1, NULL, 'active', 1, 1, 7),
(37, 'Disco Rodriguez Peña', 'Lacteos', 'Yogurt', 'La Serenisima', '', '2015-12-27', 1.3, 'kg', 30, 23.076923076923, '2016-01-31 22:49:32', '2016-03-07 00:41:57', 1, NULL, 'active', 1, 1, 7),
(38, 'Carrefour Rodriguez Peña', 'Panaderia', 'Medialuna', 'Carrefour', '', '2015-12-27', 0.03, 'kg', 23.2, 773.33333333333, '2016-01-31 22:49:32', '2016-03-07 00:41:57', 1, NULL, 'active', 2, 3, 8),
(39, 'Disco Rodriguez Peña', 'Higiene', 'Papel Higienico', 'Elite', 'Ultra Doble Hoja x 18', '2015-12-27', 18, 'm2', 58.65, 3.2583333333333, '2016-01-31 22:49:32', '2016-03-07 00:41:57', 1, NULL, 'active', 1, 1, 9),
(40, 'Disco Rodriguez Peña', 'Higiene', 'Papel Higienico', 'Elite', 'Ultra Doble Hoja x 36', '2015-12-27', 36, 'm2', 110.69, 3.0747222222222, '2016-01-31 22:49:32', '2016-03-07 00:41:57', 1, NULL, 'active', 1, 1, 9),
(41, 'Disco Rodriguez Peña', 'Higiene', 'Shampoo', 'H&S', 'Relax', '2015-12-27', 0.7, 'l', 117.35, 167.64285714286, '2016-01-31 22:49:32', '2016-03-07 00:41:57', 1, NULL, 'active', 1, 1, 9),
(42, 'Disco Rodriguez Peña', 'Higiene', 'Shampoo', 'Pantene', 'Hidro-cauterizacion', '2015-12-27', 0.75, 'l', 102, 136, '2016-01-31 22:49:32', '2016-03-07 00:41:57', 1, NULL, 'active', 1, 1, 9),
(43, 'Carrefour Rodriguez Peña', 'Higiene', 'Shampoo', 'Pantene', 'Hidro-cauterizacion', '2015-12-27', 0.75, 'l', 109, 145.33333333333, '2016-01-31 22:49:32', '2016-03-07 00:41:57', 1, NULL, 'active', 2, 3, 9),
(44, 'Farmacity', 'Higiene', 'Shampoo', 'Pantene', 'Hidro-cauterizacion', '2015-12-27', 0.75, 'l', 117, 156, '2016-01-31 22:49:32', '2016-03-07 00:41:57', 1, NULL, 'active', 4, 3, 9),
(45, 'Disco Rodriguez Peña', 'Verduras', 'Brocoli', '', '', '2015-12-27', 1, 'kg', 35, 35, '2016-01-31 22:49:32', '2016-03-07 00:41:57', 1, NULL, 'active', 1, 1, 10),
(46, 'Disco Rodriguez Peña', 'Verduras', 'Cebolla', '', '', '2015-12-27', 1, 'kg', 18, 18, '2016-01-31 22:49:32', '2016-03-07 00:41:57', 1, NULL, 'active', 1, 1, 10),
(47, 'Fruver Guido', 'Verduras', 'Cebolla', '', '', '2015-12-28', 1, 'kg', 15, 15, '2016-01-31 22:49:32', '2016-03-07 00:41:57', 1, NULL, 'active', 3, 4, 10),
(48, 'Fruver Guido', 'Verduras', 'Choclo', '', '', '2015-12-28', 3, 'und', 20, 6.6666666666667, '2016-01-31 22:49:32', '2016-03-07 00:41:57', 1, NULL, 'active', 3, 4, 10),
(49, 'Disco Rodriguez Peña', 'Verduras', 'Puerro', '', '', '2015-12-27', 0.23, 'kg', 12, 52.173913043478, '2016-01-31 22:49:32', '2016-03-07 00:41:57', 1, NULL, 'active', 1, 1, 10),
(50, 'Disco Rodriguez Peña', 'Verduras', 'Tomate', '', '', '2015-12-27', 1, 'kg', 20, 20, '2016-01-31 22:49:32', '2016-03-07 00:41:57', 1, NULL, 'active', 1, 1, 10),
(51, 'Carrefour Rodriguez Peña', 'Verduras', 'Tomate', '', '', '2015-12-27', 1, 'kg', 25, 25, '2016-01-31 22:49:32', '2016-03-07 00:41:57', 1, NULL, 'active', 2, 3, 10),
(52, 'Fruver Guido', 'Verduras', 'Tomate', '', '', '2015-12-28', 2, 'kg', 20, 10, '2016-01-31 22:49:32', '2016-03-07 00:41:57', 1, NULL, 'active', 3, 4, 10),
(53, 'Disco Rodriguez Peña', 'Verduras', 'Zanahoria', '', '', '2015-12-27', 1, 'kg', 15, 15, '2016-01-31 22:49:32', '2016-03-07 00:41:57', 1, NULL, 'active', 1, 1, 10),
(54, 'Carrefour Nuñez', 'Carnes', 'Fuet', 'Tandil', '', '2016-01-10', 0.15, 'kg', 77, 513.33333333333, '2016-01-31 22:49:32', '2016-03-07 00:41:57', 1, NULL, 'active', 2, 2, 1),
(55, 'Carrefour Nuñez', 'Panaderia', 'Rapiditas', 'Bimbo', '', '2016-01-10', 0.33, 'kg', 40, 121.21212121212, '2016-01-31 22:49:32', '2016-03-07 00:41:57', 1, NULL, 'active', 2, 2, 8),
(57, 'Carrefour Nuñez', 'Carnes', 'Carne Molida', '', '', '2016-01-10', 0.564, 'kg', 21.57, 38.244680851064, '2016-01-31 22:49:32', '2016-03-07 00:41:57', 1, NULL, 'active', 2, 2, 1),
(58, 'Carrefour Nuñez', 'Carnes', 'Muslos Pollo', '', '', '2016-02-01', 1, 'kg', 45, 45, '2016-02-01 13:21:18', '2016-03-07 00:41:57', 1, NULL, 'inactive', 2, 2, 1),
(59, 'Carrefour Nuñez', 'Carnes', 'Muslos Pollo', '', '', '2016-02-10', 1, 'kg', 49, 49, '2016-02-01 13:21:31', '2016-03-07 00:41:57', 1, NULL, 'inactive', 2, 2, 1),
(60, 'Carrefour Nuñez', 'Carnes', 'Muslos Pollo', '', '', '2016-02-16', 1, 'kg', 53, 53, '2016-02-01 13:21:41', '2016-03-07 00:41:57', 1, NULL, '', 2, 2, 1),
(61, 'Carrefour Nuñez', 'Bebidas', 'Nectar', 'Baggio', 'Multifruta', '2016-02-07', 1, 'l', 17.5, 17.5, '2016-02-08 14:40:56', '2016-03-07 00:41:57', 1, NULL, 'active', 2, 2, 11),
(62, 'Carrefour Nuñez', 'Frutas', 'Aceituna', 'Yovinessa', 'Sachet 100g', '2016-02-07', 0.08, 'kg', 10.5, 131.25, '2016-02-08 14:42:53', '2016-03-07 00:41:57', 1, NULL, 'inactive', 2, 2, 4),
(63, 'Carrefour Nuñez', 'Embutidos', 'Jamon Cocido', 'Paladini', '', '2016-02-07', 0.2, 'kg', 34.9, 174.5, '2016-02-08 14:46:18', '2016-03-07 00:41:57', 1, NULL, 'active', 2, 2, 12),
(64, 'Carrefour Nuñez', 'Carnes', 'Carne Molida Tartare', '', '', '2016-01-30', 0.476, 'kg', 47.55, 99.894957983193, '2016-02-08 14:50:30', '2016-03-07 00:41:57', 1, NULL, 'inactive', 2, 2, 1),
(65, 'Carrefour Nuñez', 'Lacteos', 'Queso Cheddar', '', '', '2016-01-30', 0.488, 'kg', 56.61, 116.00409836066, '2016-02-08 14:51:15', '2016-03-07 00:41:57', 1, NULL, 'inactive', 2, 2, 7),
(66, 'Fruver Cabildo', 'Frutas', 'Damasco', '', '', '2016-01-30', 0.29, 'kg', 7.48, 25.793103448276, '2016-02-08 14:53:30', '2016-03-07 00:41:57', 1, NULL, 'active', 3, 5, 4),
(67, 'Fruver Cabildo', 'Verduras', 'Brocoli', '', '', '2016-01-30', 1.08, 'kg', 40.1, 37.12962962963, '2016-02-08 14:53:54', '2016-03-07 00:41:57', 1, NULL, 'inactive', 3, 5, 10),
(68, 'Fruver Cabildo', 'Verduras', 'Tomate', '', '', '2016-01-30', 1.61, 'kg', 20.13, 12.503105590062, '2016-02-08 14:54:14', '2016-03-07 00:41:57', 1, NULL, 'inactive', 3, 5, 10),
(69, 'Fruver Cabildo', 'Frutas', 'Manzana', '', '', '2016-01-30', 0.6, 'kg', 13.5, 22.5, '2016-02-08 14:54:28', '2016-03-07 00:41:57', 1, NULL, 'inactive', 3, 5, 4),
(70, 'Fruver Cabildo', 'Frutas', 'Limon', '', '', '2016-01-30', 0.58, 'kg', 13.05, 22.5, '2016-02-08 14:54:49', '2016-03-07 00:41:57', 1, NULL, 'active', 3, 5, 4),
(71, 'Fruver Cabildo', 'Frutas', 'Banano', '', '', '2016-01-30', 0.59, 'kg', 11.68, 19.796610169492, '2016-02-08 14:56:10', '2016-03-07 00:41:57', 1, NULL, 'inactive', 3, 5, 4),
(72, 'Fruver Cabildo', 'Frutas', 'Pera', '', '', '2016-01-30', 0.225, 'kg', 3.94, 17.511111111111, '2016-02-08 14:56:32', '2016-03-07 00:41:57', 1, NULL, 'active', 3, 5, 4),
(73, 'Fruver Cabildo', 'Frutas', 'Uva', '', '', '2016-01-30', 1.295, 'kg', 32.36, 24.988416988417, '2016-02-08 14:56:46', '2016-03-07 00:41:57', 1, NULL, 'active', 3, 5, 4),
(74, 'Fruver Cabildo', 'Verduras', 'Papa Negra', '', '', '2016-01-30', 3.99, 'kg', 19.91, 4.9899749373434, '2016-02-08 14:57:09', '2016-03-07 00:41:57', 1, NULL, 'inactive', 3, 5, 10),
(75, 'Fruver Cabildo', 'Verduras', 'Cebolla', '', '', '2016-01-30', 1.35, 'kg', 10.79, 7.9925925925926, '2016-02-08 14:57:56', '2016-03-07 00:41:57', 1, NULL, 'inactive', 3, 5, 10),
(76, 'Fruver Cabildo', 'Verduras', 'Pimiento Rojo', '', '', '2016-01-30', 0.27, 'kg', 5.4, 20, '2016-02-08 14:58:32', '2016-03-07 00:41:57', 1, NULL, 'inactive', 3, 5, 10),
(77, 'Fruver Cabildo', 'Verduras', 'Zanahoria', '', '', '2016-01-30', 1.56, 'kg', 27.3, 17.5, '2016-02-08 14:58:51', '2016-03-07 00:41:57', 1, NULL, 'active', 3, 5, 10),
(78, 'Carrefour Nuñez', 'Higiene', 'Crema Dental', 'Colgate', 'Total 70g', '2016-02-08', 0.07, 'kg', 39, 557.14285714286, '2016-02-08 19:42:39', '2016-03-07 00:41:57', 1, NULL, 'active', 2, 2, 9),
(79, 'Carrefour Nuñez', 'Higiene', 'Crema Dental', 'Colgate', 'Total 140g', '2016-02-08', 0.14, 'kg', 69, 492.85714285714, '2016-02-08 19:43:44', '2016-03-07 00:41:57', 1, NULL, 'active', 2, 2, 9),
(80, 'Carrefour Nuñez', 'Higiene', 'Cepillo Dental', 'Pro', '425', '2016-02-08', 1, 'u', 30, 30, '2016-02-08 19:44:12', '2016-03-07 00:41:57', 1, NULL, 'active', 2, 2, 9),
(81, 'Carrefour Nuñez', 'Higiene', 'Enjuague Bucal Plax', 'Colgate', 'White', '2016-02-08', 0.5, 'l', 72, 144, '2016-02-08 19:44:53', '2016-03-07 00:41:57', 1, NULL, 'active', 2, 2, 9),
(82, 'Carrefour Nuñez', 'Higiene', 'Enjuague Bucal Plax', 'Colgate', 'Clasico', '2016-02-08', 0.5, 'l', 75, 150, '2016-02-08 19:45:23', '2016-03-07 00:41:57', 1, NULL, 'active', 2, 2, 9),
(83, 'Carrefour Nuñez', 'Higiene', 'Enjuague Bucal', 'Listerine', 'Menta Verde', '2016-02-08', 0.5, 'l', 91, 182, '2016-02-08 19:47:05', '2016-03-07 00:41:57', 1, NULL, 'active', 2, 2, 9),
(84, 'Carrefour Nuñez', 'Pasta', 'Tallarin', 'Don Vicente', '500g', '2016-02-08', 0.5, 'kg', 30, 60, '2016-02-08 19:48:22', '2016-03-07 00:41:57', 1, NULL, 'active', 2, 2, 13),
(85, 'Carrefour Nuñez', 'Pasta', 'Tirabuzon', 'Matarazzo', '500g', '2016-02-08', 0.5, 'kg', 20, 40, '2016-02-08 19:48:43', '2016-03-07 00:41:57', 1, NULL, 'active', 2, 2, 13),
(86, 'Carrefour Nuñez', 'Pasta', 'Pamperito', 'Matarazzo', '3 Vegetales', '2016-02-08', 0.5, 'kg', 24, 48, '2016-02-08 19:49:11', '2016-03-07 00:41:57', 1, NULL, 'active', 2, 2, 13),
(87, 'Carrefour Nuñez', 'Granos', 'Arroz', 'Carrefour', 'Integral', '2016-02-08', 1, 'kg', 12, 12, '2016-02-08 19:51:26', '2016-03-07 00:41:57', 1, NULL, 'active', 2, 2, 14),
(88, 'Carrefour Nuñez', 'Granos', 'Arroz', 'Carrefour', 'Largo', '2016-02-08', 1, 'kg', 12, 12, '2016-02-08 19:51:41', '2016-03-07 00:41:57', 1, NULL, 'inactive', 2, 2, 14),
(89, 'Carrefour Nuñez', 'Granos', 'Lenteja', 'Carrefour', '400g', '2016-02-08', 0.4, 'kg', 24, 60, '2016-02-08 19:51:59', '2016-03-07 00:41:57', 1, NULL, 'inactive', 2, 2, 14),
(90, 'Carrefour Nuñez', 'Aceites', 'Aceite de Oliva', 'Carrefour', '1l', '2016-02-08', 1, 'l', 110, 110, '2016-02-08 19:52:28', '2016-03-07 00:41:57', 1, NULL, 'inactive', 2, 2, 15),
(91, 'Carrefour Nuñez', 'Aceites', 'Aceite de Oliva', 'La Toscana', '1l', '2016-02-08', 1, 'l', 192, 192, '2016-02-08 19:52:51', '2016-03-07 00:41:57', 1, NULL, 'active', 2, 2, 15),
(92, 'Carrefour Nuñez', 'Aceites', 'Aceite de Girasol', 'La Toscana', '1.5l', '2016-02-08', 1.5, 'l', 18.5, 12.333333333333, '2016-02-08 19:53:13', '2016-03-07 00:41:57', 1, NULL, 'active', 2, 2, 15),
(93, 'Carrefour Nuñez', 'Aderezos', 'Aceto Balsámico', 'Carrefour', '250cc', '2016-02-08', 0.25, 'l', 29, 116, '2016-02-08 19:53:56', '2016-03-07 00:41:57', 1, NULL, 'active', 2, 2, 16),
(94, 'Carrefour Nuñez', 'Aderezos', 'Sal Fina Corrediza', 'Carrefour', '500g', '2016-02-08', 0.5, 'kg', 7, 14, '2016-02-08 20:18:53', '2016-03-07 00:41:57', 1, NULL, 'active', 2, 2, 16),
(95, 'Carrefour Nuñez', 'Aderezos', 'Sal Fina Corrediza', 'Dos Anclas', '500g', '2016-02-08', 0.5, 'kg', 9.5, 19, '2016-02-08 20:19:06', '2016-03-07 00:41:57', 1, NULL, 'active', 2, 2, 16),
(96, 'Carrefour Nuñez', 'Frutas', 'Aceituna', 'Nucete', 'Sachet 100g', '2016-02-08', 0.1, 'kg', 13.5, 135, '2016-02-08 20:20:33', '2016-03-07 00:41:58', 1, NULL, 'active', 2, 2, 4),
(97, 'Carrefour Nuñez', 'Frutas', 'Aceituna', 'Yovinessa', 'Sachet 100g', '2016-02-08', 0.08, 'kg', 11, 137.5, '2016-02-08 20:21:54', '2016-03-07 00:41:58', 1, NULL, 'active', 2, 2, 4),
(98, 'Carrefour Nuñez', 'Frutas', 'Aceituna', 'Castell', 'Premium 220g', '2016-02-08', 0.22, 'kg', 55, 250, '2016-02-08 20:22:50', '2016-03-07 00:41:58', 1, NULL, 'active', 2, 2, 4),
(99, 'Carrefour Nuñez', 'Licores', 'Cerveza Blanca', 'Stella Artois', 'Botella 1l', '2016-02-08', 1, 'l', 36.55, 36.55, '2016-02-08 20:24:04', '2016-03-07 00:41:58', 1, NULL, 'active', 2, 2, 17),
(100, 'Carrefour Nuñez', 'Licores', 'Cerveza Rubia', 'Stella Artois', 'Botella 975cc', '2016-02-08', 0.975, 'l', 47.55, 48.769230769231, '2016-02-08 20:26:59', '2016-03-07 00:41:58', 1, NULL, 'active', 2, 2, 17),
(101, 'Carrefour Nuñez', 'Licores', 'Cerveza Blanca', 'Corona', 'Botella 710cc', '2016-02-08', 0.71, 'l', 54, 76.056338028169, '2016-02-08 20:27:35', '2016-03-07 00:41:58', 1, NULL, 'active', 2, 2, 17),
(102, 'Carrefour Nuñez', 'Frutas', 'Uva', '', '', '2016-02-08', 1, 'kg', 32.99, 32.99, '2016-02-08 20:28:09', '2016-03-07 00:41:58', 1, NULL, 'inactive', 2, 2, 4),
(103, 'Carrefour Nuñez', 'Frutas', 'Frutilla', '', '', '2016-02-08', 1, 'kg', 79.9, 79.9, '2016-02-08 20:28:23', '2016-03-07 00:41:58', 1, NULL, 'active', 2, 2, 4),
(104, 'Carrefour Nuñez', 'Frutas', 'Banano', '', '', '2016-02-08', 1, 'kg', 22.9, 22.9, '2016-02-08 20:29:05', '2016-03-07 00:41:58', 1, NULL, 'inactive', 2, 2, 4),
(105, 'Carrefour Nuñez', 'Frutas', 'Manzana', '', '', '2016-02-08', 1, 'kg', 24.99, 24.99, '2016-02-08 20:29:49', '2016-03-07 00:41:58', 1, NULL, 'active', 2, 2, 4),
(106, 'Carrefour Nuñez', 'Frutas', 'Limon', '', '', '2016-02-08', 1, 'kg', 29.9, 29.9, '2016-02-08 20:31:16', '2016-03-07 00:41:58', 1, NULL, 'active', 2, 2, 4),
(107, 'Carrefour Nuñez', 'Verduras', 'Tomate', '', '', '2016-02-08', 1, 'kg', 29.9, 29.9, '2016-02-08 20:31:29', '2016-03-07 00:41:58', 1, NULL, 'inactive', 2, 2, 10),
(108, 'Carrefour Nuñez', 'Verduras', 'Zanahoria', '', '', '2016-02-08', 1, 'kg', 16.99, 16.99, '2016-02-08 20:32:19', '2016-03-07 00:41:58', 1, NULL, 'inactive', 2, 2, 10),
(109, 'Carrefour Nuñez', 'Verduras', 'Cebolla', '', '', '2016-02-08', 1, 'kg', 13.9, 13.9, '2016-02-08 20:32:27', '2016-03-07 00:41:58', 1, NULL, 'active', 2, 2, 10),
(110, 'Carrefour Nuñez', 'Lacteos', 'Danbo', 'Tremblay', 'Feteado', '2016-02-08', 1, 'kg', 130, 130, '2016-02-08 20:33:21', '2016-03-07 00:41:58', 1, NULL, 'active', 2, 2, 7),
(111, 'Carrefour Nuñez', 'Lacteos', 'Danbo', 'Tremblay', 'Feteado Light', '2016-02-08', 1, 'kg', 127, 127, '2016-02-08 20:33:29', '2016-03-07 00:41:58', 1, NULL, 'active', 2, 2, 7),
(112, 'Carrefour Nuñez', 'Lacteos', 'Danbo', 'La Serenisima', 'Feteado', '2016-02-08', 0.2, 'kg', 41, 205, '2016-02-08 20:34:43', '2016-03-07 00:41:58', 1, NULL, 'active', 2, 2, 7),
(113, 'Carrefour Nuñez', 'Embutidos', 'Mortadela', 'Paladini', '', '2016-02-08', 1, 'kg', 120, 120, '2016-02-08 20:36:35', '2016-03-07 00:41:58', 1, NULL, 'active', 2, 2, 12),
(114, 'Carrefour Nuñez', 'Carnes', 'Carne Molida Tartare', '', '', '2016-02-08', 1, 'kg', 122, 122, '2016-02-08 20:36:52', '2016-03-07 00:41:58', 1, NULL, 'active', 2, 2, 1),
(115, 'Carrefour Nuñez', 'Carnes', 'Mix Pollo', '', '', '2016-02-08', 1, 'kg', 54, 54, '2016-02-08 20:39:34', '2016-03-07 00:41:58', 1, NULL, 'active', 2, 2, 1),
(116, 'Carrefour Nuñez', 'Carnes', 'Cuadril', '', '', '2016-02-08', 1, 'kg', 163, 163, '2016-02-08 20:41:17', '2016-03-07 00:41:58', 1, NULL, 'active', 2, 2, 1),
(117, 'Carrefour Nuñez', 'Carnes', 'Colita de Cuadril', '', '', '2016-02-08', 1, 'kg', 230, 230, '2016-02-08 20:41:33', '2016-03-07 00:41:58', 1, NULL, 'active', 2, 2, 1),
(118, 'Carrefour Nuñez', 'Carnes', 'Bondiola', '', '', '2016-02-08', 1, 'kg', 121, 121, '2016-02-08 20:42:14', '2016-03-07 00:41:58', 1, NULL, 'active', 2, 2, 1),
(119, 'Chalin Mataderos', 'Carnes', 'Bondiola', '', '', '2016-02-06', 1, 'kg', 89.9, 89.9, '2016-02-13 23:29:07', '2016-03-07 00:41:58', 1, NULL, 'inactive', 5, 6, 1),
(120, 'Chalin Mataderos', 'Carnes', 'Bondiola', '', '', '2016-02-13', 1, 'kg', 89.9, 89.9, '2016-02-13 23:29:12', '2016-03-07 00:41:58', 1, NULL, 'active', 5, 6, 1),
(121, 'Chalin Mataderos', 'Carnes', 'Paleta', '', '', '2016-02-13', 1, 'kg', 78.9, 78.9, '2016-02-13 23:29:43', '2016-03-07 00:41:58', 1, NULL, 'active', 5, 6, 1),
(122, 'Chalin Mataderos', 'Carnes', 'Paleta', '', '', '2016-02-06', 1, 'kg', 78.9, 78.9, '2016-02-13 23:29:51', '2016-03-07 00:41:58', 1, NULL, 'inactive', 5, 6, 1),
(123, 'Chalin Mataderos', 'Carnes', 'Palomita', '', '', '2016-02-06', 1, 'kg', 78.9, 78.9, '2016-02-13 23:30:11', '2016-03-07 00:41:58', 1, NULL, 'inactive', 5, 6, 1),
(124, 'Chalin Mataderos', 'Carnes', 'Palomita', '', '', '2016-02-13', 1, 'kg', 78.9, 78.9, '2016-02-13 23:30:16', '2016-03-07 00:41:58', 1, NULL, 'active', 5, 6, 1),
(125, 'Chalin Mataderos', 'Carnes', 'Roast Beef', '', '', '2016-02-13', 1, 'kg', 69.9, 69.9, '2016-02-13 23:30:36', '2016-03-07 00:41:58', 1, NULL, 'active', 5, 6, 1),
(126, 'Chalin Mataderos', 'Carnes', 'Roast Beef', '', '', '2016-02-06', 1, 'kg', 69.9, 69.9, '2016-02-13 23:30:38', '2016-03-07 00:41:58', 1, NULL, 'inactive', 5, 6, 1),
(127, 'Chalin Mataderos', 'Carnes', 'Tortuguita', '', '', '2016-02-06', 1, 'kg', 69.9, 69.9, '2016-02-13 23:30:48', '2016-03-07 00:41:58', 1, NULL, 'inactive', 5, 6, 1),
(128, 'Chalin Mataderos', 'Carnes', 'Tortuguita', '', '', '2016-02-13', 1, 'kg', 69.9, 69.9, '2016-02-13 23:30:50', '2016-03-07 00:41:58', 1, NULL, 'active', 5, 6, 1),
(129, 'Chalin Mataderos', 'Carnes', 'Colita de Cuadril', '', '', '2016-02-13', 1, 'kg', 119.9, 119.9, '2016-02-13 23:31:07', '2016-03-07 00:41:58', 1, NULL, 'active', 5, 6, 1),
(130, 'Chalin Mataderos', 'Carnes', 'Colita de Cuadril', '', '', '2016-02-06', 1, 'kg', 119.9, 119.9, '2016-02-13 23:31:14', '2016-03-07 00:41:58', 1, NULL, 'inactive', 5, 6, 1),
(131, 'Chalin Mataderos', 'Carnes', 'Carne Molida Tartare', '', '', '2016-02-06', 1, 'kg', 59.9, 59.9, '2016-02-13 23:31:51', '2016-03-07 00:41:58', 1, NULL, 'inactive', 5, 6, 1),
(132, 'Chalin Mataderos', 'Carnes', 'Carne Molida Tartare', '', '', '2016-02-13', 1, 'kg', 59.9, 59.9, '2016-02-13 23:31:54', '2016-03-07 00:41:58', 1, NULL, 'active', 5, 6, 1),
(133, 'Chalin Mataderos', 'Carnes', 'Lomo', '', '', '2016-02-13', 1, 'kg', 129.9, 129.9, '2016-02-13 23:32:23', '2016-03-07 00:41:58', 1, NULL, 'active', 5, 6, 1),
(134, 'Chalin Mataderos', 'Carnes', 'Lomo', '', '', '2016-02-06', 1, 'kg', 129.9, 129.9, '2016-02-13 23:32:26', '2016-03-07 00:41:58', 1, NULL, 'inactive', 5, 6, 1),
(135, 'Chalin Mataderos', 'Carnes', 'Cuadril', '', '', '2016-02-06', 1, 'kg', 98.9, 98.9, '2016-02-13 23:34:28', '2016-03-07 00:41:58', 1, NULL, 'inactive', 5, 6, 1),
(136, 'Chalin Mataderos', 'Carnes', 'Cuadril', '', '', '2016-02-13', 1, 'kg', 98.9, 98.9, '2016-02-13 23:34:31', '2016-03-07 00:41:58', 1, NULL, 'active', 5, 6, 1),
(137, 'Chalin Mataderos', 'Carnes', 'Riñonada', '', '', '2016-02-13', 1, 'kg', 98.9, 98.9, '2016-02-13 23:34:42', '2016-03-07 00:41:58', 1, NULL, 'active', 5, 6, 1),
(138, 'Chalin Mataderos', 'Carnes', 'Riñonada', '', '', '2016-02-06', 1, 'kg', 98.9, 98.9, '2016-02-13 23:34:45', '2016-03-07 00:41:58', 1, NULL, 'inactive', 5, 6, 1),
(139, 'Chalin Mataderos', 'Carnes', 'Arañita', '', '', '2016-02-06', 1, 'kg', 89.9, 89.9, '2016-02-13 23:34:59', '2016-03-07 00:41:58', 1, NULL, 'inactive', 5, 6, 1),
(140, 'Chalin Mataderos', 'Carnes', 'Arañita', '', '', '2016-02-13', 1, 'kg', 89.9, 89.9, '2016-02-13 23:35:01', '2016-03-07 00:41:58', 1, NULL, 'active', 5, 6, 1),
(141, 'Chalin Mataderos', 'Carnes', 'Asado', '', '', '2016-02-13', 1, 'kg', 89.9, 89.9, '2016-02-13 23:35:13', '2016-03-07 00:41:58', 1, NULL, 'active', 5, 6, 1),
(142, 'Chalin Mataderos', 'Carnes', 'Asado', '', '', '2016-02-06', 1, 'kg', 89.9, 89.9, '2016-02-13 23:35:16', '2016-03-07 00:41:58', 1, NULL, 'inactive', 5, 6, 1),
(143, 'Chalin Mataderos', 'Carnes', 'Vacío', '', '', '2016-02-06', 1, 'kg', 109.9, 109.9, '2016-02-13 23:36:27', '2016-03-07 00:41:58', 1, NULL, 'inactive', 5, 6, 1),
(144, 'Chalin Mataderos', 'Carnes', 'Vacío', '', '', '2016-02-13', 1, 'kg', 109.9, 109.9, '2016-02-13 23:36:30', '2016-03-07 00:41:58', 1, NULL, 'active', 5, 6, 1),
(145, 'Chalin Mataderos', 'Carnes', 'Tapa de Asado', '', '', '2016-02-13', 1, 'kg', 89.9, 89.9, '2016-02-13 23:37:02', '2016-03-07 00:41:58', 1, NULL, 'active', 5, 6, 1),
(146, 'Chalin Mataderos', 'Carnes', 'Tapa de Asado', '', '', '2016-02-06', 1, 'kg', 89.9, 89.9, '2016-02-13 23:37:04', '2016-03-07 00:41:58', 1, NULL, 'inactive', 5, 6, 1),
(147, 'Chalin Mataderos', 'Carnes', 'Falda en Tira', '', '', '2016-02-06', 1, 'kg', 59.9, 59.9, '2016-02-13 23:37:15', '2016-03-07 00:41:58', 1, NULL, 'inactive', 5, 6, 1),
(148, 'Chalin Mataderos', 'Carnes', 'Falda en Tira', '', '', '2016-02-13', 1, 'kg', 59.9, 59.9, '2016-02-13 23:37:17', '2016-03-07 00:41:58', 1, NULL, 'active', 5, 6, 1),
(149, 'Chalin Mataderos', 'Carnes', 'Matambre', '', '', '2016-02-13', 1, 'kg', 99.9, 99.9, '2016-02-13 23:37:28', '2016-03-07 00:41:58', 1, NULL, 'active', 5, 6, 1),
(150, 'Chalin Mataderos', 'Carnes', 'Matambre', '', '', '2016-02-06', 1, 'kg', 99.9, 99.9, '2016-02-13 23:37:31', '2016-03-07 00:41:58', 1, NULL, 'inactive', 5, 6, 1),
(151, 'Chalin Mataderos', 'Carnes', 'Entraña', '', '', '2016-02-06', 1, 'kg', 109.9, 109.9, '2016-02-13 23:37:53', '2016-03-07 00:41:58', 1, NULL, 'inactive', 5, 6, 1),
(152, 'Chalin Mataderos', 'Carnes', 'Entraña', '', '', '2016-02-13', 1, 'kg', 109.9, 109.9, '2016-02-13 23:37:55', '2016-03-07 00:41:58', 1, NULL, 'active', 5, 6, 1),
(153, 'Chalin Mataderos', 'Carnes', 'Panceta Salada', '', '', '2016-02-13', 1, 'kg', 180, 180, '2016-02-13 23:38:47', '2016-03-07 00:41:58', 1, NULL, 'active', 5, 6, 1),
(154, 'Chalin Mataderos', 'Carnes', 'Panceta Salada', '', '', '2016-02-06', 1, 'kg', 180, 180, '2016-02-13 23:38:50', '2016-03-07 00:41:58', 1, NULL, 'inactive', 5, 6, 1),
(155, 'Chalin Mataderos', 'Carnes', 'Panceta Ahumada', '', '', '2016-02-06', 1, 'kg', 180, 180, '2016-02-13 23:38:56', '2016-03-07 00:41:58', 1, NULL, 'inactive', 5, 6, 1),
(156, 'Chalin Mataderos', 'Carnes', 'Panceta Ahumada', '', '', '2016-02-13', 1, 'kg', 180, 180, '2016-02-13 23:38:58', '2016-03-07 00:41:58', 1, NULL, 'active', 5, 6, 1),
(157, 'Chalin Mataderos', 'Carnes', 'Salamin', '', '', '2016-02-13', 1, 'kg', 119.9, 119.9, '2016-02-13 23:39:27', '2016-03-07 00:41:58', 1, NULL, 'active', 5, 6, 1),
(158, 'Chalin Mataderos', 'Carnes', 'Salamin', '', '', '2016-02-06', 1, 'kg', 119.9, 119.9, '2016-02-13 23:39:29', '2016-03-07 00:41:58', 1, NULL, 'inactive', 5, 6, 1),
(159, 'Chalin Mataderos', 'Carnes', 'Longaniza', '', '', '2016-02-06', 1, 'kg', 119.9, 119.9, '2016-02-13 23:39:36', '2016-03-07 00:41:58', 1, NULL, 'inactive', 5, 6, 1),
(160, 'Chalin Mataderos', 'Carnes', 'Longaniza', '', '', '2016-02-13', 1, 'kg', 119.9, 119.9, '2016-02-13 23:39:38', '2016-03-07 00:41:58', 1, NULL, 'active', 5, 6, 1),
(161, 'Chalin Mataderos', 'Carnes', 'Chorizo Colorado', '', '', '2016-02-13', 1, 'kg', 119.9, 119.9, '2016-02-13 23:39:51', '2016-03-07 00:41:58', 1, NULL, 'active', 5, 6, 1),
(162, 'Chalin Mataderos', 'Carnes', 'Chorizo Colorado', '', '', '2016-02-06', 1, 'kg', 119.9, 119.9, '2016-02-13 23:39:54', '2016-03-07 00:41:58', 1, NULL, 'inactive', 5, 6, 1),
(163, 'Chalin Mataderos', 'Carnes', 'Hamburguesa', '', '', '2016-02-06', 1, 'kg', 64.9, 64.9, '2016-02-13 23:40:22', '2016-03-07 00:41:58', 1, NULL, 'inactive', 5, 6, 1),
(164, 'Chalin Mataderos', 'Carnes', 'Hamburguesa', '', '', '2016-02-13', 1, 'kg', 64.9, 64.9, '2016-02-13 23:40:25', '2016-03-07 00:41:58', 1, NULL, 'active', 5, 6, 1),
(165, 'Chalin Mataderos', 'Carnes', 'Bife Ancho', '', '', '2016-02-13', 1, 'kg', 69.9, 69.9, '2016-02-13 23:42:11', '2016-03-07 00:41:58', 1, NULL, 'active', 5, 6, 1),
(166, 'Chalin Mataderos', 'Carnes', 'Bife Ancho', '', '', '2016-02-06', 1, 'kg', 69.9, 69.9, '2016-02-13 23:42:15', '2016-03-07 00:41:58', 1, NULL, 'inactive', 5, 6, 1),
(167, 'Chalin Mataderos', 'Carnes', 'Bife Angosto', '', '', '2016-02-06', 1, 'kg', 79.9, 79.9, '2016-02-13 23:42:25', '2016-03-07 00:41:58', 1, NULL, 'inactive', 5, 6, 1),
(168, 'Chalin Mataderos', 'Carnes', 'Bife Angosto', '', '', '2016-02-13', 1, 'kg', 79.9, 79.9, '2016-02-13 23:42:27', '2016-03-07 00:41:58', 1, NULL, 'active', 5, 6, 1),
(169, 'Chalin Mataderos', 'Carnes', 'Bife de Chorizo', '', '', '2016-02-13', 1, 'kg', 114.9, 114.9, '2016-02-13 23:42:40', '2016-03-07 00:41:58', 1, NULL, 'active', 5, 6, 1),
(170, 'Chalin Mataderos', 'Carnes', 'Bife de Chorizo', '', '', '2016-02-06', 1, 'kg', 114.9, 114.9, '2016-02-13 23:42:44', '2016-03-07 00:41:58', 1, NULL, 'inactive', 5, 6, 1),
(171, 'Chalin Mataderos', 'Carnes', 'Bife Americano', '', '', '2016-02-06', 1, 'kg', 89.9, 89.9, '2016-02-13 23:43:36', '2016-03-07 00:41:58', 1, NULL, 'inactive', 5, 6, 1),
(172, 'Chalin Mataderos', 'Carnes', 'Bife Americano', '', '', '2016-02-13', 1, 'kg', 89.9, 89.9, '2016-02-13 23:43:38', '2016-03-07 00:41:58', 1, NULL, 'active', 5, 6, 1),
(173, 'Chalin Mataderos', 'Carnes', 'Nalga', '', '', '2016-02-13', 1, 'kg', 104.9, 104.9, '2016-02-13 23:44:36', '2016-03-07 00:41:58', 1, NULL, 'active', 5, 6, 1),
(174, 'Chalin Mataderos', 'Carnes', 'Nalga', '', '', '2016-02-06', 1, 'kg', 104.9, 104.9, '2016-02-13 23:44:39', '2016-03-07 00:41:58', 1, NULL, 'inactive', 5, 6, 1),
(175, 'Chalin Mataderos', 'Carnes', 'Cuadrada', '', '', '2016-02-06', 1, 'kg', 87.9, 87.9, '2016-02-13 23:45:08', '2016-03-07 00:41:58', 1, NULL, 'inactive', 5, 6, 1),
(176, 'Chalin Mataderos', 'Carnes', 'Cuadrada', '', '', '2016-02-13', 1, 'kg', 87.9, 87.9, '2016-02-13 23:45:11', '2016-03-07 00:41:58', 1, NULL, 'active', 5, 6, 1),
(177, 'Chalin Mataderos', 'Carnes', 'Bola de Lomo', '', '', '2015-02-06', 1, 'kg', 84.9, 84.9, '2016-02-13 23:55:22', '2016-03-07 00:41:58', 1, NULL, 'inactive', 5, 6, 1),
(178, 'Chalin Mataderos', 'Carnes', 'Bola de Lomo', '', '', '2016-02-13', 1, 'kg', 84.9, 84.9, '2016-02-13 23:58:38', '2016-03-07 00:41:58', 1, NULL, 'active', 5, 6, 1),
(179, 'Chalin Mataderos', 'Carnes', 'Peceto', '', '', '2016-02-13', 1, 'kg', 119.9, 119.9, '2016-02-13 23:59:17', '2016-03-07 00:41:58', 1, NULL, 'active', 5, 6, 1),
(180, 'Chalin Mataderos', 'Carnes', 'Peceto', '', '', '2016-02-06', 1, 'kg', 119.9, 119.9, '2016-02-13 23:59:21', '2016-03-07 00:41:58', 1, NULL, 'inactive', 5, 6, 1),
(181, 'Chalin Mataderos', 'Carnes', 'Tapa de Nalga', '', '', '2016-02-06', 1, 'kg', 94.9, 94.9, '2016-02-13 23:59:49', '2016-03-07 00:41:58', 1, NULL, 'inactive', 5, 6, 1),
(182, 'Chalin Mataderos', 'Carnes', 'Tapa de Nalga', '', '', '2016-02-13', 1, 'kg', 94.9, 94.9, '2016-02-13 23:59:51', '2016-03-07 00:41:58', 1, NULL, 'active', 5, 6, 1),
(183, 'Chalin Mataderos', 'Carnes', 'Pollo', '', '', '2016-02-13', 1, 'kg', 27.9, 27.9, '2016-02-14 00:00:31', '2016-03-07 00:41:58', 1, NULL, 'active', 5, 6, 1),
(184, 'Chalin Mataderos', 'Carnes', 'Pollo', '', '', '2016-02-06', 1, 'kg', 27.9, 27.9, '2016-02-14 00:00:34', '2016-03-07 00:41:58', 1, NULL, 'inactive', 5, 6, 1),
(185, 'Chalin Mataderos', 'Carnes', 'Trasero de Pollo', '', '', '2016-02-06', 1, 'kg', 33.9, 33.9, '2016-02-14 00:01:32', '2016-03-07 00:41:58', 1, NULL, 'inactive', 5, 6, 1),
(186, 'Chalin Mataderos', 'Carnes', 'Trasero de Pollo', '', '', '2016-02-13', 1, 'kg', 33.9, 33.9, '2016-02-14 00:01:36', '2016-03-07 00:41:58', 1, NULL, 'active', 5, 6, 1),
(187, 'Chalin Mataderos', 'Carnes', 'Pata de Pollo', '', '', '2016-02-13', 1, 'kg', 42.9, 42.9, '2016-02-14 00:01:46', '2016-03-07 00:41:58', 1, NULL, 'active', 5, 6, 1),
(188, 'Chalin Mataderos', 'Carnes', 'Pata de Pollo', '', '', '2016-02-06', 1, 'kg', 42.9, 42.9, '2016-02-14 00:01:48', '2016-03-07 00:41:58', 1, NULL, 'inactive', 5, 6, 1),
(189, 'Chalin Mataderos', 'Carnes', 'Muslo de Pollo', '', '', '2016-02-06', 1, 'kg', 42.9, 42.9, '2016-02-14 00:01:53', '2016-03-07 00:41:58', 1, NULL, 'inactive', 5, 6, 1),
(190, 'Chalin Mataderos', 'Carnes', 'Muslo de Pollo', '', '', '2016-02-13', 1, 'kg', 42.9, 42.9, '2016-02-14 00:01:56', '2016-03-07 00:41:58', 1, NULL, 'active', 5, 6, 1),
(191, 'Chalin Mataderos', 'Carnes', 'Suprema de Pollo', '', '', '2016-02-13', 1, 'kg', 69.9, 69.9, '2016-02-14 00:02:23', '2016-03-07 00:41:58', 1, NULL, 'active', 5, 6, 1),
(192, 'Chalin Mataderos', 'Carnes', 'Suprema de Pollo', '', '', '2016-02-06', 1, 'kg', 69.9, 69.9, '2016-02-14 00:02:25', '2016-03-07 00:41:58', 1, NULL, 'inactive', 5, 6, 1),
(193, 'Chalin Mataderos', 'Carnes', 'Alitas de Pollo', '', '', '2016-02-06', 1, 'kg', 3.9, 3.9, '2016-02-14 00:02:36', '2016-03-07 00:41:58', 1, NULL, 'inactive', 5, 6, 1),
(194, 'Chalin Mataderos', 'Carnes', 'Alitas de Pollo', '', '', '2016-02-13', 1, 'kg', 3.9, 3.9, '2016-02-14 00:02:39', '2016-03-07 00:41:58', 1, NULL, 'active', 5, 6, 1),
(195, 'Chalin Mataderos', 'Carnes', 'Lechon', '', '', '2016-02-13', 1, 'kg', 89.9, 89.9, '2016-02-14 00:03:45', '2016-03-07 00:41:58', 1, NULL, 'active', 5, 6, 1),
(196, 'Chalin Mataderos', 'Carnes', 'Lechon', '', '', '2016-02-06', 1, 'kg', 89.9, 89.9, '2016-02-14 00:03:52', '2016-03-07 00:41:58', 1, NULL, 'inactive', 5, 6, 1),
(197, 'Chalin Mataderos', 'Carnes', 'Chivito', '', '', '2016-02-06', 1, 'kg', 109.9, 109.9, '2016-02-14 00:04:03', '2016-03-07 00:41:58', 1, NULL, 'inactive', 5, 6, 1),
(198, 'Chalin Mataderos', 'Carnes', 'Chivito', '', '', '2016-02-13', 1, 'kg', 109.9, 109.9, '2016-02-14 00:04:06', '2016-03-07 00:41:58', 1, NULL, 'active', 5, 6, 1),
(199, 'Chalin Mataderos', 'Carnes', 'Cordero', '', '', '2016-02-13', 1, 'kg', 94.9, 94.9, '2016-02-14 00:04:16', '2016-03-07 00:41:58', 1, NULL, 'active', 5, 6, 1),
(200, 'Chalin Mataderos', 'Carnes', 'Cordero', '', '', '2016-02-06', 1, 'kg', 94.9, 94.9, '2016-02-14 00:04:28', '2016-03-07 00:41:58', 1, NULL, 'inactive', 5, 6, 1),
(201, 'Chalin Mataderos', 'Carnes', 'Pechito', '', '', '2016-02-06', 1, 'kg', 69.9, 69.9, '2016-02-14 00:09:56', '2016-03-07 00:41:58', 1, NULL, 'inactive', 5, 6, 1),
(202, 'Chalin Mataderos', 'Carnes', 'Pechito', '', '', '2016-02-13', 1, 'kg', 69.9, 69.9, '2016-02-14 00:10:01', '2016-03-07 00:41:58', 1, NULL, 'active', 5, 6, 1),
(203, 'Chalin Mataderos', 'Carnes', 'Carre de Cerdo', '', '', '2016-02-13', 1, 'kg', 64.9, 64.9, '2016-02-14 00:10:25', '2016-03-07 00:41:58', 1, NULL, 'active', 5, 6, 1),
(204, 'Chalin Mataderos', 'Carnes', 'Carre de Cerdo', '', '', '2016-02-06', 1, 'kg', 64.9, 64.9, '2016-02-14 00:10:28', '2016-03-07 00:41:58', 1, NULL, 'inactive', 5, 6, 1),
(205, 'Chalin Mataderos', 'Carnes', 'Chorizo Especial', '', '', '2016-02-06', 1, 'kg', 54.9, 54.9, '2016-02-14 00:12:12', '2016-03-07 00:41:58', 1, NULL, 'inactive', 5, 6, 1),
(206, 'Chalin Mataderos', 'Carnes', 'Chorizo Especial', '', '', '2016-02-13', 1, 'kg', 54.9, 54.9, '2016-02-14 00:12:15', '2016-03-07 00:41:58', 1, NULL, 'active', 5, 6, 1),
(207, 'Chalin Mataderos', 'Carnes', 'Chorizo Puro Cerdo', '', '', '2016-02-13', 1, 'kg', 59.9, 59.9, '2016-02-14 00:12:26', '2016-03-07 00:41:58', 1, NULL, 'active', 5, 6, 1),
(208, 'Chalin Mataderos', 'Carnes', 'Chorizo Puro Cerdo', '', '', '2016-02-06', 1, 'kg', 59.9, 59.9, '2016-02-14 00:12:28', '2016-03-07 00:41:58', 1, NULL, 'inactive', 5, 6, 1),
(209, 'Chalin Mataderos', 'Carnes', 'Morcilla', '', '', '2016-02-06', 1, 'kg', 49.9, 49.9, '2016-02-14 00:12:48', '2016-03-07 00:41:58', 1, NULL, 'inactive', 5, 6, 1),
(210, 'Chalin Mataderos', 'Carnes', 'Morcilla', '', '', '2016-02-13', 1, 'kg', 49.9, 49.9, '2016-02-14 00:12:51', '2016-03-07 00:41:58', 1, NULL, 'active', 5, 6, 1),
(211, 'Chalin Mataderos', 'Carnes', 'Salchicha Criolla', '', '', '2016-02-13', 1, 'kg', 69.9, 69.9, '2016-02-14 00:13:04', '2016-03-07 00:41:58', 1, NULL, 'active', 5, 6, 1),
(212, 'Chalin Mataderos', 'Carnes', 'Salchicha Criolla', '', '', '2016-02-06', 1, 'kg', 69.9, 69.9, '2016-02-14 00:13:06', '2016-03-07 00:41:58', 1, NULL, 'inactive', 5, 6, 1),
(213, 'Chalin Mataderos', 'Carnes', 'Salchicha Viena', '', '', '2016-02-06', 1, 'kg', 59.9, 59.9, '2016-02-14 00:13:21', '2016-03-07 00:41:58', 1, NULL, 'inactive', 5, 6, 1),
(214, 'Chalin Mataderos', 'Carnes', 'Salchicha Viena', '', '', '2016-02-13', 1, 'kg', 59.9, 59.9, '2016-02-14 00:13:24', '2016-03-07 00:41:58', 1, NULL, 'active', 5, 6, 1),
(215, 'Chalin Mataderos', 'Carnes', 'Riñon', '', '', '2016-02-13', 1, 'kg', 61.9, 61.9, '2016-02-14 00:13:55', '2016-03-07 00:41:58', 1, NULL, 'active', 5, 6, 1),
(216, 'Chalin Mataderos', 'Carnes', 'Riñon', '', '', '2016-02-06', 1, 'kg', 61.9, 61.9, '2016-02-14 00:13:59', '2016-03-07 00:41:58', 1, NULL, 'inactive', 5, 6, 1),
(217, 'Chalin Mataderos', 'Carnes', 'Chinchulin', '', '', '2016-02-06', 1, 'kg', 29.9, 29.9, '2016-02-14 00:14:10', '2016-03-07 00:41:58', 1, NULL, 'inactive', 5, 6, 1),
(218, 'Chalin Mataderos', 'Carnes', 'Chinchulin', '', '', '2016-02-13', 1, 'kg', 29.9, 29.9, '2016-02-14 00:14:13', '2016-03-07 00:41:58', 1, NULL, 'active', 5, 6, 1),
(219, 'Chalin Mataderos', 'Carnes', 'Higado', '', '', '2016-02-13', 1, 'kg', 19.9, 19.9, '2016-02-14 00:14:25', '2016-03-07 00:41:58', 1, NULL, 'active', 5, 6, 1),
(220, 'Chalin Mataderos', 'Carnes', 'Higado', '', '', '2016-02-06', 1, 'kg', 19.9, 19.9, '2016-02-14 00:14:28', '2016-03-07 00:41:58', 1, NULL, 'inactive', 5, 6, 1),
(221, 'Chalin Mataderos', 'Carnes', 'Molleja', '', '', '2016-02-06', 1, 'kg', 119.9, 119.9, '2016-02-14 00:14:40', '2016-03-07 00:41:58', 1, NULL, 'inactive', 5, 6, 1),
(222, 'Chalin Mataderos', 'Carnes', 'Molleja', '', '', '2016-02-13', 1, 'kg', 119.9, 119.9, '2016-02-14 00:14:43', '2016-03-07 00:41:58', 1, NULL, 'active', 5, 6, 1),
(223, 'Chalin Mataderos', 'Carnes', 'Mondongo', '', '', '2016-02-13', 1, 'kg', 29.9, 29.9, '2016-02-14 00:15:43', '2016-03-07 00:41:58', 1, NULL, 'active', 5, 6, 1),
(224, 'Chalin Mataderos', 'Carnes', 'Mondongo', '', '', '2016-02-06', 1, 'kg', 29.9, 29.9, '2016-02-14 00:15:45', '2016-03-07 00:41:58', 1, NULL, 'inactive', 5, 6, 1),
(225, 'Chalin Mataderos', 'Carnes', 'Rabo', '', '', '2016-02-06', 1, 'kg', 29.9, 29.9, '2016-02-14 00:15:53', '2016-03-07 00:41:58', 1, NULL, 'inactive', 5, 6, 1),
(226, 'Chalin Mataderos', 'Carnes', 'Rabo', '', '', '2016-02-13', 1, 'kg', 29.9, 29.9, '2016-02-14 00:15:55', '2016-03-07 00:41:58', 1, NULL, 'active', 5, 6, 1),
(227, 'Chalin Mataderos', 'Carnes', 'Corazon', '', '', '2016-02-13', 1, 'kg', 24.9, 24.9, '2016-02-14 00:16:14', '2016-03-07 00:41:58', 1, NULL, 'active', 5, 6, 1),
(228, 'Chalin Mataderos', 'Carnes', 'Corazon', '', '', '2016-02-06', 1, 'kg', 24.9, 24.9, '2016-02-14 00:16:21', '2016-03-07 00:41:58', 1, NULL, 'inactive', 5, 6, 1),
(229, 'Chalin Mataderos', 'Carnes', 'Seso', '', '', '2016-02-06', 1, 'kg', 5, 5, '2016-02-14 00:16:29', '2016-03-07 00:41:58', 1, NULL, 'inactive', 5, 6, 1),
(230, 'Chalin Mataderos', 'Carnes', 'Seso', '', '', '2016-02-13', 1, 'kg', 5, 5, '2016-02-14 00:16:32', '2016-03-07 00:41:58', 1, NULL, 'active', 5, 6, 1),
(231, 'Chalin Mataderos', 'Carnes', 'Chorizo Comun', '', '', '2016-02-13', 1, 'kg', 54.9, 54.9, '2016-02-14 00:17:47', '2016-03-07 00:41:58', 1, NULL, 'active', 5, 6, 1),
(232, 'Chalin Mataderos', 'Carnes', 'Chorizo Comun', '', '', '2016-02-06', 1, 'kg', 54.9, 54.9, '2016-02-14 00:17:49', '2016-03-07 00:41:58', 1, NULL, 'inactive', 5, 6, 1),
(233, 'Carrefour Nuñez', 'Detergentes', 'Quitamanchas', 'Vanish', '450g', '2016-02-13', 0.45, 'kg', 79, 175.55555555556, '2016-02-14 00:36:03', '2016-03-07 00:41:58', 1, NULL, 'active', 2, 2, 18),
(234, 'Carrefour Nuñez', 'Lacteos', 'Leche', 'Armonia', 'Parcialmente Descremada', '2016-02-13', 1, 'l', 11.2, 11.2, '2016-02-14 00:40:13', '2016-03-07 00:41:58', 1, NULL, 'active', 2, 2, 7),
(235, 'Carrefour Nuñez', 'Galletas', 'Vainillas', 'Carrefour', '340g', '2016-02-13', 0.34, 'kg', 22, 64.705882352941, '2016-02-14 00:52:07', '2016-03-07 00:41:58', 1, NULL, 'active', 2, 2, 5),
(236, 'Carrefour Nuñez', 'Bolsas', 'Bolsas Multiusos Cierre Hermetico', 'Separata', '6 unidades', '2016-02-13', 6, 'u', 21, 3.5, '2016-02-14 00:54:05', '2016-03-07 00:41:58', 1, NULL, 'active', 2, 2, 19),
(237, 'Chalin Mataderos', 'Carnes', 'Espinazo', '', '', '2016-02-13', 1, 'kg', 10, 10, '2016-02-14 00:56:17', '2016-03-07 00:41:58', 1, NULL, 'active', 5, 6, 1),
(238, 'Chalin Mataderos', 'Carnes', 'Espinazo', '', '', '2016-02-06', 1, 'kg', 10, 10, '2016-02-14 00:56:20', '2016-03-07 00:41:58', 1, NULL, 'inactive', 5, 6, 1),
(239, 'Carrefour Nuñez', 'Pasta', 'Tirabuzon', 'Lucchetti', '500g', '2016-02-14', 0.5, 'kg', 17.9, 35.8, '2016-02-14 19:38:01', '2016-03-07 00:41:58', 1, NULL, 'active', 2, 2, 13),
(240, 'Carrefour Nuñez', 'Pasta', 'Spaghetti', 'Lucchetti', '500g', '2016-02-14', 0.5, 'kg', 17.9, 35.8, '2016-02-14 19:38:44', '2016-03-07 00:41:58', 1, NULL, 'active', 2, 2, 13),
(241, 'Carrefour Nuñez', 'Granos', 'Lenteja', 'Carrefour', '400g', '2016-02-14', 0.4, 'kg', 24, 60, '2016-02-14 19:39:03', '2016-03-07 00:41:58', 1, NULL, 'active', 2, 2, 14),
(242, 'Carrefour Nuñez', 'Granos', 'Garbanzos', 'Carrefour', '500g', '2016-02-14', 0.5, 'kg', 13, 26, '2016-02-14 19:41:33', '2016-03-07 00:41:58', 1, NULL, 'active', 2, 2, 14),
(243, 'Carrefour Nuñez', 'Embutidos', 'Paleta Cocida', 'Paladini', '', '2016-02-16', 0.2, 'kg', 30, 150, '2016-02-18 13:00:31', '2016-03-07 00:41:58', 1, NULL, 'active', 2, 2, 12),
(244, 'Carrefour Nuñez', 'Higiene', 'Shampoo', 'Pantene', 'Hidro-cauterizacion', '2016-02-16', 0.75, 'l', 115, 153.33333333333, '2016-02-18 13:01:23', '2016-03-07 00:41:58', 1, NULL, 'active', 2, 2, 9),
(245, 'Carrefour Nuñez', 'Lacteos', 'Queso Mozzarella', '', '', '2016-02-16', 0.194, 'kg', 20.37, 105, '2016-02-18 13:03:06', '2016-03-07 00:41:58', 1, NULL, 'active', 2, 2, 7),
(246, 'Carrefour Nuñez', 'Lacteos', 'Queso Cheddar', '', '', '2016-02-16', 0.59, 'kg', 68.44, 116, '2016-02-18 13:03:27', '2016-03-07 00:41:58', 1, NULL, 'active', 2, 2, 7),
(247, 'Carrefour Nuñez', 'Granos', 'Arroz', 'Dos Hermanos', 'Integral', '2016-02-26', 1, 'kg', 15.5, 15.5, '2016-02-27 00:53:09', '2016-03-07 00:41:58', 1, NULL, 'active', 2, 2, 14),
(248, 'Carrefour Nuñez', 'Granos', 'Arroz', 'Carrefour', 'Largo', '2016-02-26', 1, 'kg', 12, 12, '2016-02-27 00:53:25', '2016-03-07 00:41:58', 1, NULL, 'inactive', 2, 2, 14),
(249, 'Carrefour Nuñez', 'Verduras', 'Lechuga Mantecosa', '', '', '2016-02-26', 1, 'kg', 44, 44, '2016-02-27 00:54:29', '2016-03-07 00:41:58', 1, NULL, 'active', 2, 2, 10),
(250, 'Carrefour Nuñez', 'Frutas', 'Banano', '', '', '2016-02-26', 1, 'kg', 24.9018, 24.9018, '2016-02-27 00:55:21', '2016-03-07 00:41:58', 1, NULL, 'active', 2, 2, 4),
(251, 'Carrefour Nuñez', 'Verduras', 'Tomate Cherry', '', '', '2016-02-26', 1, 'kg', 49.8957, 49.8957, '2016-02-27 00:55:53', '2016-03-07 00:41:58', 1, NULL, 'active', 2, 2, 10),
(252, 'Carrefour Nuñez', 'Verduras', 'Tomate', '', '', '2016-02-26', 1, 'kg', 33.9, 33.9, '2016-02-27 00:56:08', '2016-03-07 00:41:58', 1, NULL, 'active', 2, 2, 10),
(253, 'Carrefour Nuñez', 'Frutas', 'Uva', '', '', '2016-02-26', 1, 'kg', 29.99, 29.99, '2016-02-27 00:57:43', '2016-03-07 00:41:58', 1, NULL, 'active', 2, 2, 4),
(254, 'Carrefour Nuñez', 'Verduras', 'Zanahoria', '', '', '2016-02-26', 1, 'kg', 17.9032, 17.9032, '2016-02-27 00:58:16', '2016-03-07 00:41:58', 1, NULL, 'active', 2, 2, 10),
(255, 'Carrefour Nuñez', 'Verduras', 'Ajo', '', '', '2016-02-26', 1, 'kg', 94, 94, '2016-02-27 00:58:49', '2016-03-07 00:41:58', 1, NULL, 'active', 2, 2, 10),
(256, 'Carrefour Nuñez', 'Higiene', 'Alcohol', 'Bialcohol', 'Etilico', '2016-02-26', 0.5, 'l', 28, 56, '2016-02-27 01:00:16', '2016-03-07 00:41:58', 1, NULL, 'active', 2, 2, 9),
(257, 'Carrefour Nuñez', 'Higiene', 'Algodon', 'Estrella', 'Clasico', '2016-02-26', 0.14, 'kg', 26, 185.71428571429, '2016-02-27 01:01:54', '2016-03-07 00:41:58', 1, NULL, 'active', 2, 2, 9),
(258, 'Carrefour Nuñez', 'Higiene', 'Shampoo', 'Dove', 'Reconstruccion Completa', '2016-02-26', 0.75, 'l', 111, 148, '2016-02-27 01:02:19', '2016-03-07 00:41:58', 1, NULL, 'active', 2, 2, 9),
(259, 'Carrefour Nuñez', 'Especias', 'Comino Molido', 'Condiment', '', '2016-02-26', 0.05, 'kg', 11, 220, '2016-02-27 01:05:24', '2016-03-07 00:41:58', 1, NULL, 'active', 2, 2, 20),
(260, 'Carrefour Nuñez', 'Especias', 'Oregano Hojas', 'Condiment', '', '2016-02-26', 0.05, 'kg', 14, 280, '2016-02-27 01:05:47', '2016-03-07 00:41:58', 1, NULL, 'active', 2, 2, 20),
(261, 'Carrefour Nuñez', 'Especias', 'Romero', 'Condiment', '', '2016-02-26', 0.05, 'kg', 12, 240, '2016-02-27 01:06:03', '2016-03-07 00:41:58', 1, NULL, 'active', 2, 2, 20),
(262, 'Carrefour Nuñez', 'Especias', 'Pimienta Blanca Molida', 'Condiment', '', '2016-02-26', 0.05, 'kg', 30, 600, '2016-02-27 01:06:27', '2016-03-07 00:41:58', 1, NULL, 'active', 2, 2, 20),
(263, 'Carrefour Nuñez', 'Especias', 'Laurel Hojas', 'Condiment', '', '2016-02-26', 0.025, 'kg', 13, 520, '2016-02-27 01:06:48', '2016-03-07 00:41:58', 1, NULL, 'active', 2, 2, 20),
(264, 'Carrefour Nuñez', 'Lacteos', 'Yogurt', 'La Serenisima', '', '2016-02-26', 1, 'kg', 24, 24, '2016-02-27 01:09:45', '2016-03-07 00:41:58', 1, NULL, 'active', 2, 2, 7),
(265, 'Carrefour Nuñez', 'Lacteos', 'Flan Caramelo', 'Sancor', '', '2016-02-26', 0.24, 'kg', 14.5, 60.416666666667, '2016-02-27 01:11:33', '2016-03-07 00:41:58', 1, NULL, 'active', 2, 2, 7),
(266, 'Carrefour Nuñez', 'Aderezos', 'Azucar', 'Chango', '', '2016-02-26', 1, 'kg', 10.99, 10.99, '2016-02-27 01:13:01', '2016-03-07 00:41:58', 1, NULL, 'active', 2, 2, 16),
(267, 'Carrefour Nuñez', 'Te', 'Te Negro', 'Taragui', '', '2016-02-26', 0.04, 'kg', 15, 375, '2016-02-27 01:15:08', '2016-03-07 00:41:58', 1, NULL, 'active', 2, 2, 21),
(268, 'Carrefour Nuñez', 'Te', 'Te Verde', 'La Virginia', '', '2016-02-26', 0.04, 'kg', 18, 450, '2016-02-27 01:15:35', '2016-03-07 00:41:58', 1, NULL, 'active', 2, 2, 21),
(269, 'Carrefour Nuñez', 'Detergentes', 'Lavandina', 'Querubin', '58g cl  l', '2016-02-28', 4, 'l', 60, 15, '2016-02-28 15:03:12', '2016-03-07 00:41:58', 1, NULL, 'active', 2, 2, 18),
(270, 'Carrefour Nuñez', 'Detergentes', 'Jabon Barra', 'Gigante', 'x 2', '2016-02-28', 0.4, 'kg', 19, 47.5, '2016-02-28 15:06:44', '2016-03-07 00:41:58', 1, NULL, 'active', 2, 2, 18),
(271, 'Carrefour Nuñez', 'Lacteos', 'Yogurt', 'Yogs', '', '2016-02-29', 0.9, 'kg', 18.5, 20.555555555556, '2016-02-29 23:37:05', '2016-03-07 00:41:58', 1, NULL, 'active', 2, 2, 7),
(272, 'Disco Rodriguez Peña ', 'Lacteos', 'Leche', 'La Serenisima', 'Entera Fe', '2016-02-29', 1, 'l', 16.5, 16.5, '2016-02-29 23:38:10', '2016-03-07 00:41:58', 1, NULL, 'active', 1, 1, 7),
(273, 'Carrefour Nuñez', 'Embutidos', 'Jamon Cocido', 'Cagnoli', '', '2016-02-29', 0.2, 'kg', 38.9, 194.5, '2016-02-29 23:39:27', '2016-03-07 00:41:58', 1, NULL, 'active', 2, 2, 12),
(274, 'Carrefour Nuñez', 'Lacteos', 'Crema de Leche', 'Santa Brigida', '', '2016-02-29', 0.36, 'l', 28, 77.777777777778, '2016-02-29 23:40:13', '2016-03-07 00:41:58', 1, NULL, 'active', 2, 2, 7),
(275, 'Carrefour Nuñez', 'Panes', 'Pan Tajado', 'Oroweat', 'Pan Semillas', '2016-02-29', 0.6, 'kg', 68, 113.33333333333, '2016-02-29 23:41:34', '2016-03-07 00:41:58', 1, NULL, 'active', 2, 2, 6),
(276, 'Carrefour Nuñez', 'Lacteos', '4 Quesos', 'Tholem', '', '2016-02-29', 0.19, 'kg', 28, 147.36842105263, '2016-02-29 23:42:40', '2016-03-07 00:41:58', 1, NULL, 'active', 2, 2, 7),
(277, 'Carrefour Nuñez', 'Lacteos', 'Saladix', 'Arcor', '', '2016-02-29', 0.1, 'kg', 15.5, 155, '2016-02-29 23:43:52', '2016-03-07 00:41:59', 1, NULL, 'active', 2, 2, 7),
(278, 'Fruver Cabildo', 'Verduras', 'Brocoli', '', '', '2016-03-02', 0.815, 'kg', 36.67, 44.993865030675, '2016-03-02 22:53:01', '2016-03-07 00:41:59', 1, NULL, 'active', 3, 5, 10),
(279, 'Fruver Cabildo', 'Verduras', 'Puerro', '', '', '2016-03-02', 0.675, 'kg', 40.49, 59.985185185185, '2016-03-02 22:53:31', '2016-03-07 00:41:59', 1, NULL, 'active', 3, 5, 10),
(280, 'Fruver Cabildo', 'Verduras', 'Chaucha', '', '', '2016-03-02', 0.645, 'kg', 19.34, 29.984496124031, '2016-03-02 22:53:54', '2016-03-07 00:41:59', 1, NULL, 'active', 3, 5, 10),
(281, 'Fruver Cabildo', 'Verduras', 'Lechuga Mantecosa', '', '', '2016-03-02', 0.355, 'kg', 11.71, 32.985915492958, '2016-03-02 22:54:18', '2016-03-07 00:41:59', 1, NULL, 'active', 3, 5, 10),
(282, 'Fruver Cabildo', 'Verduras', 'Cebolla', '', '', '2016-03-02', 0.815, 'kg', 10.19, 12.503067484663, '2016-03-02 22:54:35', '2016-03-07 00:41:59', 1, NULL, 'active', 3, 5, 10),
(283, 'Fruver Cabildo', 'Verduras', 'Papa Negra', '', '', '2016-03-02', 3.285, 'kg', 21.88, 6.6605783866058, '2016-03-02 22:55:05', '2016-03-07 00:41:59', 1, NULL, 'active', 3, 5, 10),
(284, 'Fruver Cabildo', 'Verduras', 'Tomate', '', '', '2016-03-02', 2.39, 'kg', 35.83, 14.991631799163, '2016-03-02 22:55:23', '2016-03-07 00:41:59', 1, NULL, 'active', 3, 5, 10),
(285, 'Fruver Cabildo', 'Verduras', 'Batata', '', '', '2016-03-02', 0.435, 'kg', 6.52, 14.988505747126, '2016-03-02 22:55:48', '2016-03-07 00:41:59', 1, NULL, 'active', 3, 5, 10),
(286, 'Fruver Cabildo', 'Verduras', 'Pimiento Rojo', '', '', '2016-03-02', 0.21, 'kg', 5.25, 25, '2016-03-02 22:56:12', '2016-03-07 00:41:59', 1, NULL, 'active', 3, 5, 10);
INSERT INTO `registro` (`id`, `almacen`, `categoria`, `elemento`, `marca`, `descripcion`, `fecha`, `cantidad`, `unidad`, `precio`, `precio_unitario`, `created_at`, `updated_at`, `created_by`, `updated_by`, `status`, `cadena_id`, `almacen_id`, `categoria_id`) VALUES
(287, 'Fruver Cabildo', 'Verduras', 'Morron Verde', '', '', '2016-03-02', 0.155, 'kg', 2.32, 14.967741935484, '2016-03-02 22:56:54', '2016-03-07 00:41:59', 1, NULL, 'active', 3, 5, 10),
(288, 'Fruver Cabildo', 'Verduras', 'Pepino', '', '', '2016-03-02', 0.78, 'kg', 11.69, 14.987179487179, '2016-03-02 22:57:27', '2016-03-07 00:41:59', 1, NULL, 'active', 3, 5, 10),
(289, 'Fruver Cabildo', 'Verduras', 'Tomate Cherry', '', '', '2016-03-02', 0.68, 'kg', 27.19, 39.985294117647, '2016-03-02 22:57:46', '2016-03-07 00:41:59', 1, NULL, 'active', 3, 5, 10),
(290, 'Fruver Cabildo', 'Verduras', 'Chocolo', '', 'Bandeja x 4', '2016-03-02', 4, 'u', 19.99, 4.9975, '2016-03-02 22:58:16', '2016-03-07 00:41:59', 1, NULL, 'active', 3, 5, 10),
(291, 'Fruver Cabildo', 'Verduras', 'Palta', '', 'Bandeja x 3', '2016-03-02', 3, 'u', 19.99, 6.6633333333333, '2016-03-02 22:59:26', '2016-03-07 00:41:59', 1, NULL, 'active', 3, 5, 10),
(292, 'Fruver Cabildo', 'Frutas', 'Banano', '', '', '2016-03-02', 1.35, 'kg', 33.74, 24.992592592593, '2016-03-02 23:00:36', '2016-03-07 00:41:59', 1, NULL, 'active', 3, 5, 4),
(293, 'Fruver Cabildo', 'Frutas', 'Manzana', '', '', '2016-03-02', 1.265, 'kg', 37.94, 29.99209486166, '2016-03-02 23:00:52', '2016-03-07 00:41:59', 1, NULL, 'active', 3, 5, 4),
(294, 'Carrefour Nuñez', 'Pasta', 'Coditos', 'Lucchetti', '500g', '2016-03-04', 0.5, 'kg', 17.5, 35, '2016-03-04 23:25:55', '2016-03-07 00:41:59', 1, NULL, 'active', 2, 2, 13),
(295, 'Carrefour Nuñez', 'Detergentes', 'Suavizante', 'Comfort', '4l', '2016-03-04', 4, 'l', 125, 31.25, '2016-03-04 23:26:54', '2016-03-07 00:41:59', 1, NULL, 'active', 2, 2, 18),
(296, 'Carrefour Nuñez', 'Pasta', 'Cabello de Angel', 'Lucchetti', '500g', '2016-03-04', 0.5, 'kg', 22, 44, '2016-03-04 23:27:39', '2016-03-07 00:41:59', 1, NULL, 'active', 2, 2, 13),
(297, 'Carrefour Nuñez', 'Pasta', 'Letras', 'Lucchetti', '500g', '2016-03-04', 0.5, 'kg', 17.5, 35, '2016-03-04 23:28:13', '2016-03-07 00:41:59', 1, NULL, 'active', 2, 2, 13),
(298, 'Carrefour Nuñez', 'Granos', 'Arroz', 'Carrefour', 'Largo', '2016-03-04', 1, 'kg', 12, 12, '2016-03-04 23:28:42', '2016-03-07 00:41:59', 1, NULL, 'active', 2, 2, 14),
(299, 'Carrefour Nuñez', 'Aceites', 'Aceite de Oliva', 'Carrefour', '1l', '2016-03-04', 1, 'l', 110, 110, '2016-03-04 23:29:09', '2016-03-07 00:41:59', 1, NULL, 'active', 2, 2, 15),
(300, 'Carrefour Nuñez', 'Higiene', 'Papel Higienico', 'Carrefour', 'Simple x 6', '2016-03-06', 54, 'm2', 50.15, 0.9287037037037, '2016-03-07 01:00:40', NULL, 1, 1, 'active', 2, 2, 9),
(301, 'Carrefour Nuñez', 'Cereales', 'Copos Azucarados', 'Carrefour', '', '2016-03-06', 0.5, 'kg', 29, 58, '2016-03-07 01:02:36', NULL, 1, 1, 'active', 2, 2, 2),
(302, 'Carrefour Nuñez', 'Aderezos', 'Salsa Barbacoa', 'Dos Anclas', '', '2016-03-06', 0.425, 'kg', 45, 105.88235294118, '2016-03-07 01:04:41', NULL, 1, 1, 'active', 2, 2, 16),
(303, 'Carrefour Nuñez', 'Aderezos', 'Salsa Mostaza', 'Savora', '', '2016-03-06', 0.5, 'kg', 22, 44, '2016-03-07 01:05:03', NULL, 1, 1, 'active', 2, 2, 16),
(304, 'Carrefour Vicente Lopez', 'Verduras', 'Pepino', '', '', '2016-03-04', 0.49, 'kg', 16.17, 33, '2016-03-07 01:13:56', '2016-03-07 01:14:45', 1, 1, 'active', 2, 7, 10),
(305, 'Carrefour Vicente Lopez', 'Verduras', 'Pimiento Rojo', '', '', '2016-03-04', 0.512, 'kg', 21.45, 41.89453125, '2016-03-07 01:15:30', NULL, 1, 1, 'active', 2, 7, 10),
(306, 'Carrefour Vicente Lopez', 'Verduras', 'Tomate', '', '', '2016-03-04', 0.84, 'kg', 22.6, 26.904761904762, '2016-03-07 01:16:02', NULL, 1, 1, 'active', 2, 7, 10),
(307, 'Carrefour Vicente Lopez', 'Panaderia', 'Rapiditas', 'Bimbo', '', '2016-02-28', 0.33, 'kg', 51, 154.54545454545, '2016-03-07 01:20:17', NULL, 1, 1, 'active', 2, 7, 8),
(308, 'Carrefour Vicente Lopez', 'Panes', 'Pan Tajado', 'Oroweat', 'Pan Cereales', '2016-02-28', 0.6, 'kg', 67, 111.66666666667, '2016-03-07 01:23:00', NULL, 1, 1, 'active', 2, 7, 6),
(309, 'Carrefour Nuñez', 'Embutidos', 'Jamon Cocido', 'Cagnoli', '', '2016-03-08', 0.2, 'kg', 38.9, 194.5, '2016-03-09 00:23:57', NULL, 1, 1, 'active', 2, 2, 12),
(310, 'Carrefour Nuñez', 'Dulces', 'Gomitas', 'Billiken', 'Citricas', '2016-03-08', 0.2, 'kg', 30, 150, '2016-03-09 00:26:52', NULL, 1, 1, 'active', 2, 2, 22),
(311, 'Carrefour Nuñez', 'Granos', 'Pipas', 'Argensun', 'Girasol', '2016-03-08', 0.018, 'kg', 5.1, 283.33333333333, '2016-03-09 00:28:18', NULL, 1, 1, 'active', 2, 2, 14),
(312, 'Fruver Cabildo', 'Frutas', 'Manzana', '', '', '2016-03-13', 0.525, 'kg', 18.37, 34.990476190476, '2016-03-13 22:16:55', NULL, 1, 1, 'active', 3, 5, 4),
(313, 'Fruver Cabildo', 'Frutas', 'Durazno', '', 'Chico', '2016-03-13', 0.445, 'kg', 11.12, 24.988764044944, '2016-03-13 22:17:30', NULL, 1, 1, 'active', 3, 5, 4),
(314, 'Fruver Cabildo', 'Verduras', 'Chocolo', '', 'Bandeja x 3', '2016-03-13', 3, 'u', 24.99, 8.33, '2016-03-13 22:18:17', '2016-03-13 22:21:48', 1, 1, 'active', 3, 5, 10),
(315, 'Carrefour Nuñez', 'Enlatados', 'Atun', 'Carrefour', 'Aceite', '2016-03-13', 0.17, 'kg', 23, 135.29411764706, '2016-03-13 22:21:08', NULL, 1, 1, 'active', 2, 2, 3),
(316, 'Carrefour Nuñez', 'Detergentes', 'Apresto', 'Claro', '500ml', '2016-03-04', 0.5, 'l', 44, 88, '2016-03-13 22:23:23', NULL, 1, 1, 'active', 2, 2, 18),
(317, 'Carrefour Nuñez', 'Lacteos', 'Queso Parmesano', '', '', '2016-03-13', 0.218, 'kg', 46.65, 213.99082568807, '2016-03-13 22:24:10', NULL, 1, 1, 'active', 2, 2, 7),
(318, 'Carrefour Nuñez', 'Frutas', 'Uva', '', '', '2016-03-13', 3.165, 'kg', 94.92, 29.990521327014, '2016-03-13 22:27:51', NULL, 1, 1, 'active', 2, 2, 4),
(319, 'Carrefour Nuñez', 'Frutas', 'Fresa', '', '', '2016-03-13', 0.398, 'kg', 35.82, 90, '2016-03-13 22:28:57', NULL, 1, 1, 'active', 2, 2, 4),
(320, 'Fruver Cabildo', 'Frutas', 'Uva', '', '', '2016-03-13', 1, 'kg', 34.9, 34.9, '2016-03-15 03:07:17', NULL, 1, 1, 'active', 3, 5, 4),
(321, 'Fruver Cabildo', 'Verduras', 'Palta', '', 'Bandeja x 3', '2016-03-02', 3, 'u', 26.99, 8.9966666666667, '2016-03-15 03:08:08', NULL, 1, 1, 'active', 3, 5, 10),
(322, 'Fruver Cabildo', 'Frutas', 'Naranja', '', '', '2016-03-13', 1, 'kg', 19.99, 19.99, '2016-03-15 03:08:36', NULL, 1, 1, 'active', 3, 5, 4),
(323, 'Fruver Cabildo', 'Frutas', 'Kiwi', '', '', '2016-03-13', 1, 'kg', 44, 44, '2016-03-15 03:10:14', NULL, 1, 1, 'active', 3, 5, 4),
(324, 'Fruver Cabildo', 'Frutas', 'Ciruela', '', '', '2016-03-13', 1, 'kg', 34.99, 34.99, '2016-03-15 03:10:56', NULL, 1, 1, 'active', 3, 5, 4),
(325, 'Fruver Cabildo', 'Frutas', 'Pera', '', '', '2016-03-13', 3, 'kg', 24.99, 8.33, '2016-03-15 03:11:25', '2016-03-15 03:12:19', 1, 1, 'active', 3, 5, 4),
(326, 'Carrefour Vicente Lopez', 'Verduras', 'Tomate', '', '', '2016-03-13', 1, 'kg', 19.99, 19.99, '2016-03-15 03:11:51', NULL, 1, 1, 'active', 2, 7, 10),
(327, 'Fruver Cabildo', 'Frutas', 'Banano', '', '', '2016-03-13', 1, 'kg', 24.99, 24.99, '2016-03-15 03:13:19', NULL, 1, 1, 'active', 3, 5, 4),
(328, 'Carrefour Cabildo', 'Especias', 'Curry', '1854', '25g', '2016-03-16', 0.025, 'kg', 15, 600, '2016-03-16 23:45:54', NULL, 1, 1, 'active', 2, 8, 20),
(329, 'Casa China Barrio Chino', 'Especias', 'Curry', 'Casa China', '140g', '2016-03-16', 0.14, 'kg', 22.4, 160, '2016-03-16 23:48:26', '2016-03-16 23:49:36', 1, 1, 'active', 6, 9, 20),
(331, 'Casa China Barrio Chino', 'Granos', 'Cus Cus', 'Rivoire', '500g', '2016-03-16', 0.5, 'kg', 52, 104, '2016-03-16 23:51:26', '2016-03-16 23:52:04', 1, 1, 'active', 6, 9, 14),
(332, 'Carrefour Nuñez', 'Verduras', 'Tomate Cherry', '', '', '2016-03-18', 1, 'kg', 49.8963, 49.8963, '2016-03-19 00:01:16', NULL, 1, 1, 'active', 2, 2, 10),
(333, 'Carrefour Nuñez', 'Frutas', 'Uva', '', 'Blanca', '2016-03-18', 1.98, 'kg', 75.22, 37.989898989899, '2016-03-19 00:02:18', NULL, 1, 1, 'active', 2, 2, 4),
(334, 'Carrefour Nuñez', 'Frutas', 'Banano', '', '', '2016-03-18', 0.87, 'kg', 13.83, 15.896551724138, '2016-03-19 00:03:22', NULL, 1, 1, 'active', 2, 2, 4),
(335, 'Carrefour Nuñez', 'Pasta', 'Moños', 'Terrabusi', '500g', '2016-03-18', 0.5, 'kg', 15.5, 31, '2016-03-19 00:04:24', NULL, 1, 1, 'active', 2, 2, 13),
(336, 'Carrefour Nuñez', 'Pasta', 'Tallarin', 'Terrabusi', '500g', '2016-03-18', 0.5, 'kg', 13.5, 27, '2016-03-19 00:05:08', NULL, 1, 1, 'active', 2, 2, 13),
(337, 'Carrefour Nuñez', 'Granos', 'Arroz', 'Carrefour', 'Integral', '2016-03-18', 1, 'kg', 12, 12, '2016-03-19 00:05:43', NULL, 1, 1, 'active', 2, 2, 14),
(338, 'Carrefour Nuñez', 'Granos', 'Arroz', 'Carrefour', 'Largo', '2016-03-18', 1, 'kg', 10.5, 10.5, '2016-03-19 00:06:05', NULL, 1, 1, 'active', 2, 2, 14),
(339, 'Carrefour Nuñez', 'Detergentes', 'Lavandina', 'Querubin', '58g cl  l', '2016-03-18', 4, 'l', 58, 14.5, '2016-03-19 00:06:44', NULL, 1, 1, 'active', 2, 2, 18),
(340, 'Carrefour Nuñez', 'Higiene', 'Jabon Baño', 'Campos Verdes', '120g', '2016-03-18', 0.12, 'kg', 8.21, 68.416666666667, '2016-03-19 00:09:12', NULL, 1, 1, 'active', 2, 2, 9),
(341, 'Carrefour Nuñez', 'Tocador', 'Crema Corporal', 'Nivea', '400ml', '2016-03-18', 0.4, 'l', 62, 155, '2016-03-19 00:13:46', NULL, 1, 1, 'active', 2, 2, 23),
(342, 'Carrefour Nuñez', 'Aderezos', 'Pure Tomate', 'Carrefour', '520g', '2016-03-18', 0.52, 'kg', 8.1, 15.576923076923, '2016-03-19 00:15:54', NULL, 1, 1, 'active', 2, 2, 16),
(343, 'Carrefour Nuñez', 'Verduras', 'Champiñones', 'Carrefour', '200g', '2016-03-18', 0.2, 'kg', 33.99, 169.95, '2016-03-19 00:22:12', NULL, 1, 1, 'active', 2, 2, 10),
(344, 'Carrefour Nuñez', 'Frutas', 'Limon', '', 'Taiti', '2016-03-18', 0.125, 'kg', 12.75, 102, '2016-03-19 00:22:51', NULL, 1, 1, 'active', 2, 2, 4),
(345, 'Carrefour Nuñez', 'Higiene', 'Toalla Higienica', 'Kotex', 'x 20', '2016-03-18', 20, 'u', 54, 2.7, '2016-03-19 00:24:29', NULL, 1, 1, 'active', 2, 2, 9),
(346, 'Carrefour Nuñez', 'Higiene', 'Protectores', 'Lady Soft', 'x 20', '2016-03-18', 20, 'u', 14.5, 0.725, '2016-03-19 00:25:56', NULL, 1, 1, 'active', 2, 2, 9),
(347, 'Carrefour Nuñez', 'Detergentes', 'Jabon Polvo', 'Skip', '6kg', '2016-03-20', 6, 'kg', 256, 42.666666666667, '2016-03-20 21:06:36', NULL, 1, 1, 'active', 2, 2, 18),
(348, 'Carrefour Nuñez', 'Detergentes', 'Limpiahornos', 'Mr Musculo', '360cc', '2016-03-20', 0.36, 'l', 28, 77.777777777778, '2016-03-20 21:07:29', NULL, 1, 1, 'active', 2, 2, 18),
(349, 'Super Chunghwa Olazabal', 'Aderezos', 'Miel', 'Las Marias', '500g', '2016-03-20', 0.5, 'kg', 18, 36, '2016-03-20 21:10:15', '2016-03-21 11:28:44', 1, 1, 'active', 7, 10, 16),
(350, 'Super Chunghwa Olazabal', 'Frutas', 'Uva Pasa', '', '200g', '2016-03-20', 0.2, 'kg', 20, 100, '2016-03-20 21:11:27', '2016-03-21 11:28:41', 1, 1, 'active', 7, 10, 4),
(351, 'Carrefour Cabildo', 'Panes', 'Pan Tajado', 'Carrefour', 'Pan Semillas', '2016-03-24', 0.54, 'kg', 37, 68.518518518519, '2016-03-24 22:57:37', NULL, 1, 1, 'active', 2, 8, 6),
(352, 'Carrefour Cabildo', 'Lacteos', 'Queso Azul', 'San Ignacio', '', '2016-03-24', 0.18, 'kg', 27.5, 152.77777777778, '2016-03-24 23:04:08', NULL, 1, 1, 'active', 2, 8, 7);

-- --------------------------------------------------------

--
-- Struttura della tabella `social_account`
--

DROP TABLE IF EXISTS `social_account`;
CREATE TABLE IF NOT EXISTS `social_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `provider` varchar(255) NOT NULL,
  `client_id` varchar(255) NOT NULL,
  `data` text,
  `code` varchar(32) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `account_unique` (`provider`,`client_id`),
  UNIQUE KEY `account_unique_code` (`code`),
  KEY `fk_user_account` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `token`
--

DROP TABLE IF EXISTS `token`;
CREATE TABLE IF NOT EXISTS `token` (
  `user_id` int(11) NOT NULL,
  `code` varchar(32) NOT NULL,
  `created_at` int(11) NOT NULL,
  `type` smallint(6) NOT NULL,
  UNIQUE KEY `token_unique` (`user_id`,`code`,`type`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password_hash` varchar(60) NOT NULL,
  `auth_key` varchar(32) NOT NULL,
  `confirmed_at` int(11) DEFAULT NULL,
  `unconfirmed_email` varchar(255) DEFAULT NULL,
  `blocked_at` int(11) DEFAULT NULL,
  `registration_ip` varchar(45) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `flags` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_unique_email` (`email`),
  UNIQUE KEY `user_unique_username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dump dei dati per la tabella `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password_hash`, `auth_key`, `confirmed_at`, `unconfirmed_email`, `blocked_at`, `registration_ip`, `created_at`, `updated_at`, `flags`) VALUES
(1, 'fernandrez', 'fernandrez@gmail.com', '$2y$10$tkyfyO3vmdgXOpcyYoy6AO5HPMTFhnoeDlahsHU1c6FINuZ3Bh6Fa', '4hN6vlJPSkPhDUFWQ09qEHeINmfzuhle', 1458940222, NULL, NULL, NULL, 1458940222, 1458940222, 0),
(2, 'pelval', 'pelaezdiana@hotmail.com', '$2y$10$2n9LcQbxIkl3A1EoLlzu0.YnSxX8314pckg7m4uUaWlwcG/bQm/We', 'lzau2Xjm91Y1f2bw95NQf4FdMrcBglHB', 1458940222, NULL, NULL, NULL, 1458940222, 1458940222, 0);

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `almacen`
--
ALTER TABLE `almacen`
  ADD CONSTRAINT `fk_almacen_updated_by` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_almacen_cadena` FOREIGN KEY (`cadena_id`) REFERENCES `cadena` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_almacen_created_by` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Limiti per la tabella `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Limiti per la tabella `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `cadena`
--
ALTER TABLE `cadena`
  ADD CONSTRAINT `fk_cadena_updated_by` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_cadena_created_by` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Limiti per la tabella `categoria`
--
ALTER TABLE `categoria`
  ADD CONSTRAINT `fk_categoria_updated_by` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_categoria_created_by` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Limiti per la tabella `ciudad`
--
ALTER TABLE `ciudad`
  ADD CONSTRAINT `fk_ciudad_created_by` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_ciudad_pais` FOREIGN KEY (`pais_id`) REFERENCES `pais` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_ciudad_region` FOREIGN KEY (`region_id`) REFERENCES `region` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_ciudad_updated_by` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Limiti per la tabella `direccion`
--
ALTER TABLE `direccion`
  ADD CONSTRAINT `fk_cruce` FOREIGN KEY (`cruce_id`) REFERENCES `direccion_parametro` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_direccion_created_by` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_direccion_updated_by` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_interior` FOREIGN KEY (`interior_id`) REFERENCES `direccion_parametro` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_mod_cruce` FOREIGN KEY (`mod_cruce_id`) REFERENCES `direccion_parametro` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_mod_via` FOREIGN KEY (`mod_via_id`) REFERENCES `direccion_parametro` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_via` FOREIGN KEY (`via_id`) REFERENCES `direccion_parametro` (`id`) ON DELETE CASCADE;

--
-- Limiti per la tabella `direccion_parametro`
--
ALTER TABLE `direccion_parametro`
  ADD CONSTRAINT `fk_direccion_parametro_created_by` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_direccion_parametro_updated_by` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Limiti per la tabella `pais`
--
ALTER TABLE `pais`
  ADD CONSTRAINT `fk_pais_created_by` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_pais_updated_by` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Limiti per la tabella `parametro`
--
ALTER TABLE `parametro`
  ADD CONSTRAINT `fk_parametro_created_by` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Limiti per la tabella `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `fk_user_profile` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Limiti per la tabella `region`
--
ALTER TABLE `region`
  ADD CONSTRAINT `fk_region_created_by` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_region_pais` FOREIGN KEY (`pais_id`) REFERENCES `pais` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_region_updated_by` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Limiti per la tabella `registro`
--
ALTER TABLE `registro`
  ADD CONSTRAINT `fk_registro_categoria` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_registro_almacen` FOREIGN KEY (`almacen_id`) REFERENCES `almacen` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_registro_cadena` FOREIGN KEY (`cadena_id`) REFERENCES `cadena` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_registro_created_by` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_registro_updated_by` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Limiti per la tabella `social_account`
--
ALTER TABLE `social_account`
  ADD CONSTRAINT `fk_user_account` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Limiti per la tabella `token`
--
ALTER TABLE `token`
  ADD CONSTRAINT `fk_user_token` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
