-- phpMyAdmin SQL Dump
-- version 3.5.8.1deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 29-11-2013 a las 13:29:02
-- Versión del servidor: 5.5.34-0ubuntu0.13.04.1
-- Versión de PHP: 5.4.9-4ubuntu2.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `NA`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `config`
--

CREATE TABLE IF NOT EXISTS `config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(100) NOT NULL,
  `company_email` varchar(100) NOT NULL,
  `company_email_subject` varchar(120) NOT NULL,
  `version` varchar(30) NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `config`
--

INSERT INTO `config` (`id`, `company_name`, `company_email`, `company_email_subject`, `version`, `last_update`) VALUES
(1, 'La Sante Farmacia', 'info@lasante.com.ar', 'La Sante Farmacia', '1.1', '2013-04-09 10:55:36');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `config_secret`
--

CREATE TABLE IF NOT EXISTS `config_secret` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number_of_admin_licenses` int(11) NOT NULL,
  `number_of_user_licenses` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `config_secret`
--

INSERT INTO `config_secret` (`id`, `number_of_admin_licenses`, `number_of_user_licenses`) VALUES
(1, 1, 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Fields`
--

CREATE TABLE IF NOT EXISTS `Fields` (
  `idCampo` varchar(50) NOT NULL,
  `nombreEnForm` varchar(50) NOT NULL,
  `campoFisico` varchar(50) NOT NULL,
  `display` varchar(50) NOT NULL,
  `width` varchar(50) DEFAULT NULL,
  `sortable` varchar(10) NOT NULL,
  `align` varchar(20) NOT NULL,
  `onlyNum` char(1) NOT NULL,
  `maxLenght` varchar(4) NOT NULL,
  `TipoCampo` varchar(20) NOT NULL,
  `sql` varchar(8000) DEFAULT NULL,
  PRIMARY KEY (`idCampo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Fields`
--

INSERT INTO `Fields` (`idCampo`, `nombreEnForm`, `campoFisico`, `display`, `width`, `sortable`, `align`, `onlyNum`, `maxLenght`, `TipoCampo`, `sql`) VALUES
('Fields.align', 'align', 'Fields.align', 'Align', '100', 'true', 'left', '', '', 'text', ''),
('Fields.campoFisico', 'campoFisico', 'Fields.campoFisico', 'Campo fisico', '100', 'true', 'left', '', '', 'text', ''),
('Fields.display', 'display', 'Fields.display', 'Display', '100', 'true', 'left', '', '', 'text', ''),
('Fields.idCampo', 'idCampo', 'Fields.idCampo', 'Id', '100', 'true', 'left', '', '', 'text', ''),
('Fields.maxLenght', 'maxLenght', 'Fields.maxLenght', 'Max Lenght', '100', 'true', 'left', '', '', 'text', ''),
('Fields.nombreEnForm', 'nombreEnForm', 'Fields.nombreEnForm', 'Nombre en formulario', '100', 'true', 'left', '', '', 'text', ''),
('Fields.onlyNum', 'onlyNum', 'Fields.onlyNum', 'Solo numeros', '100', 'true', 'left', '', '', 'text', ''),
('Fields.sortable', 'sortable', 'Fields.sortable', 'Sortable', '100', 'true', 'left', '', '', 'text', ''),
('Fields.sql', 'sql', 'Fields.sql', 'sql', '100', 'true', 'left', '', '', 'text', ''),
('Fields.TipoCampo', 'TipoCampo', 'Fields.TipoCampo', 'Tipo de campo', '100', 'true', 'left', '', '', 'text', ''),
('Fields.width', 'width', 'Fields.width', 'Width', '100', 'true', 'left', '', '', 'text', ''),
('group.description', 'description', 'group.description', 'description', '200', 'true', 'left', '', '', 'text', ''),
('group.id', 'id', 'group.id', 'id', '50', 'true', 'left', '', '', 'text', ''),
('group.name', 'name', 'group.name', 'name', '100', 'true', 'left', '', '', 'text', ''),
('menu.id', 'id', 'menu.id', 'id', '20', 'true', 'left', '', '', 'text', NULL),
('menu.idParent', 'idParent', 'menu.idParent', 'idParent', '100', 'true', 'left', '', '', 'text', NULL),
('menu.id_org', 'id_org', 'menu.id_org', 'id general', '20', 'true', 'left', '', '', 'text', NULL),
('menu.link', 'link', 'menu.link', 'link', '100', 'true', '', '', '', 'text', NULL),
('menu.name', 'name', 'menu.name', 'Name', '100', 'true', 'left', '', '', 'text', NULL),
('menu.type', 'type', 'menu.type', 'Type', '100', 'true', 'left', '', '', 'text', NULL),
('module.from', 'from', 'module.from', 'From', '100', 'true', 'left', '', '', 'text', ''),
('module.idModulo', 'idModulo', 'module.idModulo', 'Module Id', '100', 'true', 'left', '', '', 'text', ''),
('module.tableBase', 'tableBase', 'module.tableBase', 'Tabla Master', '100', 'true', 'left', '', '', 'text', ''),
('moduleFields.hide', 'hide', 'moduleFields.hide', 'hide', '100', 'true', 'left', '', '', 'text', ''),
('moduleFields.idCampo', 'idCampo', 'moduleFields.idCampo', 'Id del campo', '100', 'true', 'left', '', '', 'text', ''),
('moduleFields.idModulo', 'idModulo', 'moduleFields.idModulo', 'Id del modulo', '100', 'true', 'left', '', '', 'select', 'SELECT `IdModulo` as id,`IdModulo` as valor FROM `module`'),
('moduleFields.Orden', 'Orden', 'moduleFields.Orden', 'Orden', '100', 'true', 'left', '', '', 'text', ''),
('moduleFields.Scope', 'Scope', 'moduleFields.Scope', 'Scope', '100', 'true', 'left', '', '', 'select', 'SELECT ''GR'',''GR - Grilla'' UNION SELECT ''ED'',''ED - Editar''  UNION SELECT ''NR'',''NR - Nuevo Registro''  UNION SELECT ''PK'',''PK - Primary Key'''),
('resource.idModulo', 'idModulo', 'resource.idModulo', 'Id Modulo', '100', 'true', 'left', '', '', 'select', 'SELECT `IdModulo` as id,`IdModulo` as valor FROM `module`');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `group`
--

CREATE TABLE IF NOT EXISTS `group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `description` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Volcado de datos para la tabla `group`
--

INSERT INTO `group` (`id`, `name`, `description`) VALUES
(1, 'root', 'Total access'),
(2, 'Administrator', 'Full access'),
(3, 'Usuario normal ', 'Usuarios en puestos de trabajo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `group_paperwork`
--

CREATE TABLE IF NOT EXISTS `group_paperwork` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` varchar(150) NOT NULL,
  `paperwork_member` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `group_paperwork`
--

INSERT INTO `group_paperwork` (`id`, `name`, `description`, `paperwork_member`) VALUES
(3, 'Todos', 'todos', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `group_permission`
--

CREATE TABLE IF NOT EXISTS `group_permission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_action` int(11) DEFAULT NULL,
  `id_group` int(11) DEFAULT NULL,
  `id_resource` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=489 ;

--
-- Volcado de datos para la tabla `group_permission`
--

INSERT INTO `group_permission` (`id`, `id_action`, `id_group`, `id_resource`) VALUES
(1, 1, 1, 1),
(2, 1, 1, 2),
(3, 1, 1, 3),
(4, 1, 1, 4),
(5, 1, 1, 5),
(6, 1, 1, 6),
(7, 1, 1, 7),
(8, 1, 1, 8),
(9, 1, 1, 9),
(10, 1, 1, 10),
(11, 1, 1, 11),
(12, 1, 1, 12),
(13, 1, 1, 13),
(14, 1, 1, 14),
(15, 1, 1, 15),
(16, 1, 1, 16),
(17, 1, 1, 17),
(18, 1, 1, 18),
(19, 1, 1, 19),
(20, 1, 1, 20),
(21, 1, 1, 21),
(22, 1, 1, 22),
(23, 1, 1, 23),
(24, 1, 1, 24),
(25, 1, 1, 25),
(26, 1, 1, 26),
(213, 1, 2, 1),
(214, 1, 2, 2),
(215, 1, 2, 3),
(216, 1, 2, 4),
(217, 1, 2, 5),
(218, 1, 2, 6),
(219, 1, 2, 7),
(220, 1, 2, 8),
(221, 1, 2, 9),
(222, 1, 2, 10),
(223, 1, 2, 11),
(224, 1, 2, 12),
(225, 1, 2, 13),
(226, 1, 2, 14),
(227, 0, 2, 15),
(228, 0, 2, 16),
(229, 1, 2, 17),
(230, 1, 2, 18),
(231, 1, 2, 19),
(232, 1, 2, 20),
(233, 1, 2, 21),
(234, 1, 2, 22),
(235, 1, 2, 23),
(236, 1, 2, 24),
(237, 1, 2, 25),
(238, 1, 2, 26),
(244, 0, 3, 1),
(245, 0, 3, 2),
(246, 0, 3, 3),
(247, 0, 3, 4),
(248, 0, 3, 5),
(249, 0, 3, 6),
(250, 0, 3, 7),
(251, 0, 3, 8),
(252, 0, 3, 9),
(253, 0, 3, 10),
(254, 0, 3, 11),
(255, 0, 3, 12),
(256, 0, 3, 13),
(257, 0, 3, 14),
(258, 0, 3, 15),
(259, 0, 3, 16),
(260, 0, 3, 17),
(261, 0, 3, 18),
(262, 0, 3, 19),
(263, 0, 3, 20),
(264, 0, 3, 21),
(265, 0, 3, 22),
(266, 0, 3, 23),
(267, 0, 3, 24),
(268, 1, 3, 25),
(269, 1, 3, 26),
(270, 1, 1, 27),
(271, 1, 1, 28),
(272, 1, 1, 29),
(476, 1, 1, 30),
(477, 1, 1, 31),
(478, 1, 1, 32),
(479, 1, 1, 33),
(480, 1, 1, 34),
(481, 1, 1, 35),
(482, 1, 1, 36),
(483, 1, 1, 37),
(484, 1, 1, 38),
(485, 1, 1, 39),
(486, 1, 1, 40),
(487, 1, 1, 41),
(488, 1, 1, 42);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Includes`
--

CREATE TABLE IF NOT EXISTS `Includes` (
  `IdModulo` varchar(50) NOT NULL,
  `Path` varchar(800) NOT NULL,
  `Type` varchar(10) NOT NULL,
  `Orden` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Includes`
--

INSERT INTO `Includes` (`IdModulo`, `Path`, `Type`, `Orden`) VALUES
('group_list', 'themes/default/modules/group_list/configs/default.conf.php', 'php', 24),
('group_list', 'themes/default/modules/group_list/css/default.css', 'css', 25),
('group_list', 'themes/default/modules/group_list/js/group_list.js.php', 'js', 26),
('group_list', 'themes/default/modules/group_list/js/group_list_fancybox.js', 'js', 27),
('user_list', 'themes/default/modules/user_list/configs/default.conf.php', 'php', 24),
('user_list', 'themes/default/modules/user_list/css/default.css', 'css', 25),
('user_list', 'themes/default/modules/user_list/css/flexigrid.css', 'css', 26),
('user_list', 'themes/default/modules/user_list/js/user_list.js', 'js', 27),
('user_list', 'themes/default/modules/user_list/js/user_list_fancybox.js', 'js', 28),
('group_permission', 'themes/default/modules/group_permission/configs/default.conf.php', 'php', 24),
('group_permission', 'themes/default/modules/group_permission/libs/default.php', 'php', 25),
('group_permission', 'themes/default/modules/group_permission/css/default.css', 'css', 26),
('group_permission', 'themes/default/modules/group_permission/js/group_permission.js', 'js', 27),
('section_list', 'themes/default/modules/section_list/configs/default.conf.php', 'php', 24),
('section_list', 'themes/default/modules/section_list/css/default.css', 'css', 25),
('section_list', 'themes/default/modules/section_list/js/section_list.js', 'js', 26),
('section_list', 'themes/default/modules/section_list/js/section_list_fancybox.js', 'js', 27),
('logout_form', 'themes/default/modules/logout_form/configs/default.conf.php', 'php', 24),
('logout_form', 'themes/default/modules/logout_form/css/default.css', 'css', 25),
('logout_form', 'themes/default/modules/logout_form/js/logout_form.js', 'js', 26),
('logout_form', 'themes/default/modules/logout_form/js/logout_form_fancybox.js', 'js', 27),
('build_module', 'themes/default/modules/build_module/configs/default.conf.php', 'php', 24),
('build_module', 'themes/default/modules/build_module/css/default.css', 'css', 25),
('module_list', 'themes/default/modules/build_module/configs/default.conf.php', 'php', 24),
('module_list', 'themes/default/modules/build_module/css/default.css', 'css', 25),
('module_list', 'themes/default/js/generic_list_generator.js.php', 'js', 26),
('module_list', 'themes/default/js/generic_fancybox.js', 'js', 27),
('module_list', 'libs/js/jquery.json.js', 'js', 28),
('module_list', 'libs/js/jquery.base64.js', 'js', 29),
('GENERIC', 'libs/js/ajquery1.8.2.min.js', 'js', 1),
('GENERIC', 'libs/js/bjquery-ui.custom.min.js', 'js', 2),
('GENERIC', 'libs/js/jixedbar.0.5.js', 'js', 3),
('GENERIC', 'libs/js/jquery.ajax_chat.js', 'js', 4),
('GENERIC', 'libs/js/jquery.calculator.min.js', 'js', 5),
('GENERIC', 'libs/js/ldatePicker.js', 'js', 6),
('GENERIC', 'libs/js/zdefault.js', 'js', 7),
('GENERIC', 'themes/default/configs/default.conf.php', 'php', 8),
('GENERIC', 'themes/default/libs/logout_form.php', 'php', 9),
('GENERIC', 'themes/default/libs/sysinfo.class.php', 'php', 10),
('GENERIC', 'themes/default/css/chat.css', 'css', 11),
('GENERIC', 'themes/default/css/datePicker.css', 'css', 12),
('GENERIC', 'themes/default/css/default.css', 'css', 13),
('GENERIC', 'themes/default/css/fancybox.css', 'css', 14),
('GENERIC', 'themes/default/css/flexigrid.css', 'css', 15),
('GENERIC', 'themes/default/css/jx.bar.css', 'css', 16),
('GENERIC', 'themes/default/css/reset.css', 'css', 17),
('GENERIC', 'themes/default/css/screen.css', 'css', 18),
('GENERIC', 'themes/default/js/a_highcharts.js', 'js', 19),
('GENERIC', 'themes/default/js/default_theme.js', 'js', 20),
('GENERIC', 'themes/default/js/exporting.js', 'js', 21),
('GENERIC', 'themes/default/js/flexigrid.js', 'js', 22),
('GENERIC', 'themes/default/js/jquery.fancybox.js', 'js', 23),
('fields_list', 'themes/default/modules/build_module/configs/default.conf.php', 'php', 24),
('fields_list', 'themes/default/modules/build_module/css/default.css', 'css', 25),
('fields_list', 'themes/default/js/generic_list_generator.js.php', 'js', 26),
('fields_list', 'themes/default/js/generic_fancybox.js', 'js', 27),
('fields_list', 'libs/js/jquery.json.js', 'js', 28),
('fields_list', 'libs/js/jquery.base64.js', 'js', 29),
('moduleFields_list', 'themes/default/modules/build_module/configs/default.conf.php', 'php', 24),
('moduleFields_list', 'themes/default/modules/build_module/css/default.css', 'css', 25),
('moduleFields_list', 'themes/default/js/generic_list_generator.js.php', 'js', 26),
('moduleFields_list', 'themes/default/js/generic_fancybox.js', 'js', 27),
('moduleFields_list', 'libs/js/jquery.json.js', 'js', 28),
('moduleFields_list', 'libs/js/jquery.base64.js', 'js', 29),
('menu_list', 'themes/default/js/generic_list_generator.js.php', 'js', 26),
('menu_list', 'themes/default/js/generic_fancybox.js', 'js', 27),
('menu_list', 'themes/default/modules/build_module/configs/default.conf.php', 'php', 24),
('menu_list', 'themes/default/modules/build_module/css/default.css', 'css', 25),
('menu_list', 'libs/js/jquery.json.js', 'js', 28),
('menu_list', 'libs/js/jquery.base64.js', 'js', 29);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `log`
--

CREATE TABLE IF NOT EXISTS `log` (
  `table_name` varchar(64) NOT NULL,
  `lastmodified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`table_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `log`
--

INSERT INTO `log` (`table_name`, `lastmodified`) VALUES
('tickets', '2013-09-23 14:48:54');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login_logout`
--

CREATE TABLE IF NOT EXISTS `login_logout` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `in_out` varchar(5) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `reason` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2421 ;

--
-- Volcado de datos para la tabla `login_logout`
--

INSERT INTO `login_logout` (`id`, `id_user`, `in_out`, `timestamp`, `reason`) VALUES
(2301, 1, 'out', '2013-06-09 12:33:09', 'SALIR DEL SISTEMA'),
(2302, 2, 'in', '2013-06-09 12:33:13', 'login'),
(2303, 2, 'out', '2013-06-09 12:33:17', 'SALIR DEL SISTEMA'),
(2304, 1, 'in', '2013-06-09 12:33:21', 'login'),
(2305, 1, 'in', '2013-06-09 14:00:11', 'login'),
(2306, 1, 'in', '2013-06-09 16:25:19', 'login'),
(2307, 2, 'in', '2013-06-09 17:59:29', 'login'),
(2308, 2, 'out', '2013-06-09 18:02:33', 'SALIR DEL SISTEMA'),
(2309, 1, 'in', '2013-06-09 18:02:36', 'login'),
(2310, 1, 'out', '2013-06-09 18:07:38', 'SALIR DEL SISTEMA'),
(2311, 2, 'in', '2013-06-09 18:07:44', 'login'),
(2312, 1, 'in', '2013-06-09 19:28:50', 'login'),
(2313, 1, 'in', '2013-06-09 20:43:44', 'login'),
(2314, 1, 'in', '2013-06-10 01:23:11', 'login'),
(2315, 1, 'in', '2013-06-10 04:35:35', 'login'),
(2316, 1, 'in', '2013-06-10 15:21:06', 'login'),
(2317, 1, 'in', '2013-06-10 18:47:54', 'login'),
(2318, 1, 'in', '2013-06-10 21:14:22', 'login'),
(2319, 1, 'in', '2013-06-11 01:59:56', 'login'),
(2320, 1, 'in', '2013-06-24 19:17:06', 'login'),
(2321, 1, 'in', '2013-06-24 21:01:58', 'login'),
(2322, 1, 'in', '2013-07-15 02:07:54', 'login'),
(2323, 2, 'in', '2013-08-13 19:12:34', 'login'),
(2324, 1, 'in', '2013-08-26 18:39:02', 'login'),
(2325, 1, 'in', '2013-08-26 18:39:11', 'login'),
(2326, 1, 'in', '2013-08-26 18:39:18', 'login'),
(2327, 1, 'in', '2013-08-26 18:39:30', 'login'),
(2328, 1, 'in', '2013-08-26 18:39:38', 'login'),
(2329, 1, 'in', '2013-08-26 18:39:49', 'login'),
(2330, 1, 'in', '2013-08-26 18:40:04', 'login'),
(2331, 1, 'in', '2013-08-26 18:40:12', 'login'),
(2332, 1, 'in', '2013-08-27 22:44:48', 'login'),
(2333, 1, 'in', '2013-08-27 22:44:56', 'login'),
(2334, 1, 'in', '2013-08-27 22:45:17', 'login'),
(2335, 1, 'in', '2013-08-28 01:12:13', 'login'),
(2336, 1, 'in', '2013-08-28 01:12:47', 'login'),
(2337, 1, 'in', '2013-08-28 01:13:13', 'login'),
(2338, 1, 'in', '2013-08-28 01:13:21', 'login'),
(2339, 1, 'in', '2013-08-28 01:13:42', 'login'),
(2340, 1, 'in', '2013-08-28 01:19:02', 'login'),
(2341, 1, 'in', '2013-09-02 15:06:44', 'login'),
(2342, 1, 'in', '2013-09-02 19:11:57', 'login'),
(2343, 1, 'in', '2013-09-10 12:54:26', 'login'),
(2344, 1, 'in', '2013-09-10 12:54:34', 'login'),
(2345, 1, 'in', '2013-09-10 18:00:27', 'login'),
(2346, 1, 'in', '2013-09-10 19:55:36', 'login'),
(2347, 1, 'in', '2013-09-11 14:44:31', 'login'),
(2348, 1, 'in', '2013-09-16 14:26:35', 'login'),
(2349, 1, 'in', '2013-09-16 19:00:14', 'login'),
(2350, 1, 'in', '2013-09-17 12:05:27', 'login'),
(2351, 1, 'in', '2013-09-17 12:05:36', 'login'),
(2352, 1, 'in', '2013-09-17 13:31:57', 'login'),
(2353, 1, 'in', '2013-09-17 17:49:26', 'login'),
(2354, 1, 'in', '2013-09-18 14:36:13', 'login'),
(2355, 1, 'in', '2013-09-18 16:10:27', 'login'),
(2356, 1, 'in', '2013-09-20 15:48:45', 'login'),
(2357, 1, 'in', '2013-09-20 19:32:37', 'login'),
(2358, 1, 'in', '2013-09-23 11:48:39', 'login'),
(2359, 1, 'in', '2013-09-30 12:16:34', 'login'),
(2360, 1, 'in', '2013-10-01 12:45:12', 'login'),
(2361, 1, 'in', '2013-10-01 14:24:10', 'login'),
(2362, 1, 'in', '2013-10-01 17:19:29', 'login'),
(2363, 1, 'in', '2013-10-02 12:08:30', 'login'),
(2364, 1, 'in', '2013-10-02 15:17:44', 'login'),
(2365, 1, 'in', '2013-10-03 12:04:13', 'login'),
(2366, 1, 'in', '2013-10-03 13:55:39', 'login'),
(2367, 1, 'in', '2013-10-03 15:18:45', 'login'),
(2368, 1, 'in', '2013-10-03 17:01:44', 'login'),
(2369, 1, 'in', '2013-10-03 17:02:04', 'login'),
(2370, 1, 'in', '2013-10-03 17:04:09', 'login'),
(2371, 1, 'in', '2013-10-03 17:04:41', 'login'),
(2372, 1, 'in', '2013-10-04 12:20:27', 'login'),
(2373, 1, 'in', '2013-10-04 13:33:54', 'login'),
(2374, 1, 'in', '2013-10-04 19:29:46', 'login'),
(2375, 1, 'in', '2013-10-07 11:54:04', 'login'),
(2376, 1, 'in', '2013-10-07 11:58:12', 'login'),
(2377, 1, 'in', '2013-10-08 19:49:14', 'login'),
(2378, 1, 'in', '2013-10-09 13:30:07', 'login'),
(2379, 1, 'in', '2013-10-09 14:42:05', 'login'),
(2380, 1, 'in', '2013-10-09 17:34:11', 'login'),
(2381, 1, 'in', '2013-10-09 18:42:01', 'login'),
(2382, 1, 'in', '2013-10-09 19:31:41', 'login'),
(2383, 1, 'in', '2013-10-10 11:44:37', 'login'),
(2384, 1, 'in', '2013-10-10 13:31:18', 'login'),
(2385, 1, 'in', '2013-10-10 15:08:54', 'login'),
(2386, 1, 'in', '2013-10-10 15:46:13', 'login'),
(2387, 1, 'in', '2013-10-10 19:11:42', 'login'),
(2388, 1, 'in', '2013-10-11 11:56:01', 'login'),
(2389, 1, 'in', '2013-10-11 13:09:25', 'login'),
(2390, 1, 'in', '2013-10-11 16:15:32', 'login'),
(2391, 1, 'in', '2013-10-11 18:00:58', 'login'),
(2392, 1, 'in', '2013-10-11 18:43:21', 'login'),
(2393, 1, 'in', '2013-10-15 12:30:23', 'login'),
(2394, 1, 'in', '2013-10-15 15:28:09', 'login'),
(2395, 1, 'in', '2013-10-16 12:16:00', 'login'),
(2396, 1, 'in', '2013-10-16 13:50:51', 'login'),
(2397, 1, 'in', '2013-10-16 15:24:48', 'login'),
(2398, 1, 'in', '2013-10-16 18:00:53', 'login'),
(2399, 1, 'in', '2013-10-18 12:47:53', 'login'),
(2400, 1, 'in', '2013-10-18 13:44:01', 'login'),
(2401, 1, 'in', '2013-10-18 19:10:30', 'login'),
(2402, 1, 'in', '2013-10-23 13:37:03', 'login'),
(2403, 1, 'in', '2013-10-23 16:05:03', 'login'),
(2404, 1, 'in', '2013-10-23 17:06:13', 'login'),
(2405, 1, 'in', '2013-10-24 11:59:00', 'login'),
(2406, 1, 'in', '2013-10-24 12:00:28', 'login'),
(2407, 1, 'in', '2013-10-24 12:20:48', 'login'),
(2408, 1, 'in', '2013-11-01 13:25:44', 'login'),
(2409, 1, 'in', '2013-11-08 13:42:15', 'login'),
(2410, 1, 'in', '2013-11-08 15:30:03', 'login'),
(2411, 1, 'in', '2013-11-12 14:35:59', 'login'),
(2412, 1, 'in', '2013-11-12 15:23:36', 'login'),
(2413, 1, 'in', '2013-11-12 16:24:57', 'login'),
(2414, 1, 'in', '2013-11-13 12:41:34', 'login'),
(2415, 1, 'in', '2013-11-14 12:26:59', 'login'),
(2416, 1, 'in', '2013-11-14 15:36:02', 'login'),
(2417, 1, 'in', '2013-11-14 18:28:12', 'login'),
(2418, 1, 'in', '2013-11-14 19:40:13', 'login'),
(2419, 1, 'in', '2013-11-15 12:44:47', 'login'),
(2420, 1, 'in', '2013-11-15 13:12:15', 'login');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logout_form`
--

CREATE TABLE IF NOT EXISTS `logout_form` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `logout_form`
--

INSERT INTO `logout_form` (`id`, `name`) VALUES
(3, 'SALIR DEL SISTEMA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `membership`
--

CREATE TABLE IF NOT EXISTS `membership` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `id_group` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=139 ;

--
-- Volcado de datos para la tabla `membership`
--

INSERT INTO `membership` (`id`, `id_user`, `id_group`) VALUES
(1, 1, 1),
(3, 3, 3),
(4, 4, 3),
(5, 5, 2),
(6, 6, 3),
(7, 7, 3),
(8, 8, 3),
(9, 9, 3),
(10, 10, 3),
(11, 11, 3),
(12, 12, 2),
(13, 13, 3),
(14, 14, 2),
(15, 15, 2),
(16, 16, 2),
(17, 17, 2),
(24, 2, 2),
(25, 3, 3),
(26, 4, 3),
(27, 5, 3),
(28, 6, 3),
(29, 7, 3),
(30, 8, 3),
(31, 9, 3),
(32, 10, 3),
(33, 11, 3),
(34, 12, 2),
(35, 13, 3),
(36, 14, 3),
(37, 15, 3),
(38, 16, 3),
(39, 17, 3),
(40, 18, 3),
(41, 19, 3),
(42, 20, 3),
(43, 21, 3),
(44, 22, 3),
(45, 23, 3),
(46, 24, 3),
(47, 25, 3),
(48, 26, 3),
(49, 27, 3),
(50, 28, 3),
(51, 29, 3),
(52, 30, 3),
(53, 31, 3),
(54, 32, 3),
(55, 33, 3),
(56, 34, 3),
(57, 35, 3),
(58, 36, 2),
(59, 37, 3),
(60, 38, 3),
(61, 39, 3),
(62, 40, 3),
(63, 41, 3),
(64, 42, 3),
(65, 43, 3),
(66, 44, 3),
(67, 45, 3),
(68, 46, 3),
(69, 47, 3),
(70, 48, 3),
(71, 49, 3),
(72, 50, 3),
(73, 51, 3),
(74, 52, 3),
(75, 53, 3),
(76, 54, 3),
(77, 55, 3),
(78, 56, 3),
(79, 57, 3),
(80, 58, 3),
(81, 59, 3),
(82, 60, 3),
(83, 61, 3),
(84, 62, 3),
(85, 63, 3),
(86, 64, 3),
(87, 65, 3),
(88, 66, 3),
(89, 67, 3),
(90, 68, 3),
(91, 69, 3),
(92, 70, 3),
(93, 71, 3),
(94, 72, 3),
(95, 73, 3),
(96, 74, 3),
(97, 75, 3),
(98, 76, 3),
(99, 77, 3),
(100, 78, 3),
(101, 79, 3),
(102, 80, 3),
(103, 81, 3),
(104, 82, 3),
(105, 83, 3),
(106, 84, 3),
(107, 85, 3),
(108, 86, 3),
(109, 87, 3),
(110, 88, 3),
(111, 89, 3),
(112, 90, 3),
(113, 91, 3),
(114, 92, 3),
(115, 93, 3),
(116, 94, 3),
(117, 95, 3),
(118, 96, 3),
(119, 97, 3),
(123, 101, 3),
(124, 102, 3),
(125, 103, 3),
(126, 104, 3),
(127, 105, 3),
(128, 106, 3),
(130, 108, 3),
(131, 107, 3),
(132, 108, 3),
(133, 109, 3),
(134, 110, 3),
(135, 111, 3),
(136, 112, 14),
(137, 113, 3),
(138, 114, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `id_org` int(11) NOT NULL AUTO_INCREMENT,
  `id` varchar(40) NOT NULL DEFAULT '',
  `idParent` varchar(40) DEFAULT NULL,
  `link` varchar(250) DEFAULT NULL,
  `name` varchar(250) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_org`,`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=43 ;

--
-- Volcado de datos para la tabla `menu`
--

INSERT INTO `menu` (`id_org`, `id`, `idParent`, `link`, `name`, `type`) VALUES
(1, 'sys', '', 'sys', 'System', '0'),
(2, 'report', '', 'report', 'Report', '0'),
(3, 'client', '', 'client', 'Client', '0'),
(4, 'sms', '', 'sms', 'Sms', '0'),
(5, 'system_info', 'sys', 'system_info', 'System Info', '1'),
(6, 'network', 'sys', 'network', 'Network', '1'),
(7, 'user_management', 'sys', 'user_management', 'User Management', '1'),
(8, 'group_list', 'user_management', 'group_list', 'Group List', '2'),
(9, 'user_list', 'user_management', 'user_list', 'User List', '2'),
(10, 'group_permission', 'user_management', 'group_permission', 'Group Permission', '2'),
(11, 'section_list', 'user_management', 'section_list', 'Section List', '2'),
(12, 'machine_list', 'sys', 'machine_list', 'Machine List', '1'),
(13, 'shutdown', 'sys', 'shutdown', 'Shutdown', '1'),
(14, 'sms_server', 'sys', 'sms_server', 'Sms Server', '1'),
(15, 'sip_server', 'sys', 'sip_server', 'Sip Server', '1'),
(16, 'backup', 'sys', 'backup', 'backup', '1'),
(17, 'ticket_list', 'report', 'ticket_list', 'Ticket List', '1'),
(18, 'sms_out_report', 'report', 'sms_out_report', 'Sms Report', '1'),
(19, 'login_logout', 'report', 'login_logout', 'Login/logout', '1'),
(20, 'graphic_report', 'report', 'graphic_report', 'Graphic Report', '1'),
(21, 'sms_send', 'sms', 'sms_send', 'Send Sms', '1'),
(22, 'sms_outbox', 'sms', 'sms_outbox', 'Sms Outbox', '1'),
(23, 'client_list', 'client', 'client_list', 'Client List', '1'),
(24, 'media_management', 'sys', 'media_management', 'Media Management', '1'),
(25, 'customer_care', '', 'customer_care', 'Customer Care Center', '0'),
(26, 'customer_list', 'customer_care', 'customer_list', 'Customer List', '1'),
(27, 'paperwork', 'user_management	', 'paperwork', 'PaperWork', '2'),
(28, 'developer', '', 'developer', 'Developer', '0'),
(29, 'build_module', 'developer', 'build_module', 'Build Module', '1'),
(30, 'logout_form', 'user_management', 'logout_form', 'Logout Form', '2'),
(31, 'touch_terminal', 'sys', 'touch_terminal', 'Touch Terminal', '1'),
(32, 'terminal_theme', 'touch_terminal', 'terminal_theme', 'Terminal Theme', '2'),
(33, 'paperwork', 'touch_terminal', 'paperwork', 'Paper Work', '2'),
(34, 'operator_panel', 'mng', 'operator_panel', 'Operator Panel', '1'),
(35, 'mng', NULL, 'mng', 'mng', '0'),
(36, 'extras', NULL, 'extras', 'extras', '0'),
(37, 'downloads', 'extras', 'downloads', 'downloads', '1'),
(38, 'group_paperwork', 'touch_terminal', 'group_paperwork', 'Group Paperwork', '2'),
(39, 'module_list', 'build_module', 'module_list', 'Modules', '2'),
(40, 'menu_list', 'build_module', 'menu_list', 'Menues', '2'),
(41, 'fields_list', 'build_module', 'fields_list', 'Fields', '2'),
(42, 'moduleFields_list', 'build_module', 'moduleFields_list', 'Module - Fields', '2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `module`
--

CREATE TABLE IF NOT EXISTS `module` (
  `IdModulo` varchar(50) NOT NULL,
  `From` varchar(8000) DEFAULT NULL,
  `TableBase` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`IdModulo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `module`
--

INSERT INTO `module` (`IdModulo`, `From`, `TableBase`) VALUES
('fields_list', '', 'Fields'),
('group_list', '', 'group'),
('menu_list', '', 'menu'),
('moduleFields_list', '', 'moduleFields'),
('module_list', NULL, 'module'),
('resource_list', NULL, 'resource');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `moduleFields`
--

CREATE TABLE IF NOT EXISTS `moduleFields` (
  `idModulo` varchar(50) NOT NULL,
  `idCampo` varchar(50) NOT NULL,
  `Orden` int(11) NOT NULL,
  `Scope` varchar(10) NOT NULL,
  `hide` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `moduleFields`
--

INSERT INTO `moduleFields` (`idModulo`, `idCampo`, `Orden`, `Scope`, `hide`) VALUES
('fields_list', 'Fields.align', 7, 'GR', 'false'),
('fields_list', 'Fields.align', 7, 'NR', 'false'),
('fields_list', 'Fields.campoFisico', 3, 'GR', 'false'),
('fields_list', 'Fields.campoFisico', 3, 'NR', 'false'),
('fields_list', 'Fields.display', 4, 'GR', 'false'),
('fields_list', 'Fields.display', 4, 'NR', 'false'),
('fields_list', 'Fields.idCampo', 1, 'NR', 'false'),
('fields_list', 'Fields.maxLenght', 9, 'GR', 'false'),
('fields_list', 'Fields.maxLenght', 9, 'NR', 'false'),
('fields_list', 'Fields.nombreEnForm', 2, 'GR', 'false'),
('fields_list', 'Fields.nombreEnForm', 2, 'NR', 'false'),
('fields_list', 'Fields.onlyNum', 8, 'GR', 'false'),
('fields_list', 'Fields.onlyNum', 8, 'NR', 'false'),
('fields_list', 'Fields.sortable', 6, 'GR', 'false'),
('fields_list', 'Fields.sortable', 6, 'NR', 'false'),
('fields_list', 'Fields.TipoCampo', 10, 'GR', 'false'),
('fields_list', 'Fields.TipoCampo', 10, 'NR', 'false'),
('fields_list', 'Fields.width', 5, 'GR', 'false'),
('fields_list', 'Fields.width', 5, 'NR', 'false'),
('group_list', 'group.description', 2, 'GR', 'false'),
('group_list', 'group.id', 0, 'GR', 'true'),
('group_list', 'group.name', 1, 'GR', 'false'),
('moduleFields_list', 'moduleFields.idCampo', 2, 'GR', 'false'),
('moduleFields_list', 'moduleFields.idModulo', 1, 'GR', 'false'),
('moduleFields_list', 'moduleFields.Orden', 5, 'GR', 'false'),
('moduleFields_list', 'moduleFields.Scope', 4, 'GR', 'false'),
('module_list', 'module.from', 1, 'ED', ''),
('module_list', 'module.from', 1, 'NR', ''),
('module_list', 'module.from', 2, 'GR', 'false'),
('module_list', 'module.idModulo', 0, 'PK', ''),
('module_list', 'module.idModulo', 0, 'ED', ''),
('module_list', 'module.idModulo', 0, 'NR', ''),
('module_list', 'module.idModulo', 1, 'GR', 'false'),
('module_list', 'module.tableBase', 2, 'ED', ''),
('module_list', 'module.tableBase', 2, 'NR', ''),
('module_list', 'module.tableBase', 3, 'GR', 'false'),
('moduleFields_list', 'moduleFields.idModulo', 1, 'NR', 'false'),
('moduleFields_list', 'moduleFields.idCampo', 2, 'NR', 'false'),
('moduleFields_list', 'moduleFields.Orden', 5, 'NR', 'false'),
('moduleFields_list', 'moduleFields.Scope', 4, 'NR', 'false'),
('moduleFields_list', 'moduleFields.idCampo', 2, 'ED', 'false'),
('moduleFields_list', 'moduleFields.idModulo', 1, 'ED', 'false'),
('moduleFields_list', 'moduleFields.Orden', 5, 'ED', 'false'),
('moduleFields_list', 'moduleFields.Scope', 4, 'ED', 'false'),
('moduleFields_list', 'moduleFields.idModulo', 1, 'PK', 'false'),
('moduleFields_list', 'moduleFields.idCampo', 2, 'PK', 'false'),
('moduleFields_list', 'moduleFields.Scope', 4, 'PK', 'false'),
('fields_list', 'Fields.idCampo', 1, 'GR', 'false'),
('fields_list', 'Fields.idCampo', 0, 'PK', 'false'),
('fields_list', 'Fields.sql', 11, 'GR', 'false'),
('fields_list', 'Fields.sql', 11, 'NR', 'false'),
('menu_list', 'menu.id', 2, 'GR', 'false'),
('menu_list', 'menu.idParent', 3, 'GR', 'false'),
('menu_list', 'menu.link', 4, 'GR', 'false'),
('menu_list', 'menu.name', 5, 'GR', 'false'),
('menu_list', 'menu.type', 6, 'GR', 'false'),
('menu_list', 'menu.id_org', 0, 'PK', 'true'),
('fields_list', 'Fields.idCampo', 1, 'ED', 'false'),
('fields_list', 'Fields.nombreEnForm', 2, 'ED', 'false'),
('fields_list', 'Fields.campoFisico', 3, 'ED', 'false'),
('fields_list', 'Fields.display', 4, 'ED', 'false'),
('fields_list', 'Fields.width', 5, 'ED', 'false'),
('fields_list', 'Fields.sortable', 6, 'ED', 'false'),
('fields_list', 'Fields.align', 7, 'ED', 'false'),
('fields_list', 'Fields.onlyNum', 8, 'ED', 'false'),
('fields_list', 'Fields.maxLenght', 9, 'ED', 'false'),
('fields_list', 'Fields.TipoCampo', 10, 'ED', 'false'),
('fields_list', 'Fields.sql', 11, 'ED', 'false'),
('menu_list', 'menu.id', 2, 'NR', 'false'),
('menu_list', 'menu.idParent', 3, 'NR', 'false'),
('menu_list', 'menu.link', 4, 'NR', 'false'),
('menu_list', 'menu.name', 5, 'NR', 'false'),
('menu_list', 'menu.type', 6, 'NR', 'false');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paperwork`
--

CREATE TABLE IF NOT EXISTS `paperwork` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_machine` int(11) NOT NULL,
  `Id_order` int(11) NOT NULL,
  `id_parent` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` varchar(200) NOT NULL,
  `priority` int(11) NOT NULL DEFAULT '0',
  `title` varchar(5) NOT NULL,
  `reset_counter` int(11) NOT NULL,
  `nr_of_tickets` int(11) NOT NULL,
  `count` int(11) NOT NULL,
  `max_waiting` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `paperwork`
--

INSERT INTO `paperwork` (`id`, `id_machine`, `Id_order`, `id_parent`, `name`, `description`, `priority`, `title`, `reset_counter`, `nr_of_tickets`, `count`, `max_waiting`) VALUES
(1, 1, 1, 0, 'Turnos', 'turnos', 1, 'R', 0, 1, 0, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resource`
--

CREATE TABLE IF NOT EXISTS `resource` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) DEFAULT NULL,
  `description` varchar(120) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=43 ;

--
-- Volcado de datos para la tabla `resource`
--

INSERT INTO `resource` (`id`, `name`, `description`) VALUES
(1, 'sys', 'System'),
(2, 'report', 'Report'),
(3, 'client', 'Client'),
(4, 'sms', 'Sms'),
(5, 'system_info', 'System Info'),
(6, 'network', 'Network'),
(7, 'user_management', 'User Management'),
(8, 'group_list', 'Group List'),
(9, 'user_list', 'User List'),
(10, 'group_permission', 'Group Permission'),
(11, 'section_list', 'Section List'),
(12, 'machine_list', 'Machine List'),
(13, 'shutdown', 'Shutdown'),
(14, 'sms_server', 'Sms Server'),
(15, 'sip_server', 'Sip Server'),
(16, 'backup', 'Backup'),
(17, 'ticket_list', 'Ticket List'),
(18, 'sms_out_report', 'Sms Report'),
(19, 'login_logout', 'Login/logout'),
(20, 'graphic_report', 'Graphic Report'),
(21, 'sms_send', 'Send Sms'),
(22, 'sms_outbox', 'Sms Outbox'),
(23, 'client_list', 'Client List'),
(24, 'media_management', 'Media Management'),
(25, 'customer_care', 'Customer Care Center'),
(26, 'customer_list', 'Customer List'),
(27, 'paperwork', 'PaperWork'),
(28, 'developer', 'Developer'),
(29, 'build_module', 'Build Module'),
(30, 'logout_form', 'Logout Form'),
(31, 'touch_terminal', 'Touch Terminal'),
(32, 'terminal_theme', 'Therminal Theme'),
(33, 'paperwork', 'Paper Work'),
(34, 'operator_panel', 'Operator Panel'),
(35, 'mng', 'Mng'),
(36, 'extras', 'Extras'),
(37, 'downloads', 'Downloads'),
(38, 'group_paperwork', 'Group Paperwork'),
(39, 'module_list', 'Modules'),
(40, 'menu_list', 'Menues'),
(41, 'fields_list', 'Fields'),
(42, 'moduleFields_list', 'Module - Fields');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `section`
--

CREATE TABLE IF NOT EXISTS `section` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  `code` varchar(10) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `header2speech` varchar(200) NOT NULL,
  `location2speech` varchar(100) DEFAULT NULL,
  `text_sms` varchar(170) DEFAULT NULL,
  `footer_sms` varchar(80) DEFAULT NULL,
  `email_content` text NOT NULL,
  `id_machine` varchar(30) NOT NULL DEFAULT '1',
  `id_waiting_room` varchar(10) NOT NULL,
  `location` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Volcado de datos para la tabla `section`
--

INSERT INTO `section` (`id`, `name`, `title`, `code`, `status`, `header2speech`, `location2speech`, `text_sms`, `footer_sms`, `email_content`, `id_machine`, `id_waiting_room`, `location`) VALUES
(4, 'Consultorio 04', '', '4', 1, 'su atencion por favor.', 'dirijase al consultorio numero cuatro. gracias.', 'testing sms electroturno', 'gracias por elegirnos!', '', '5', '2', 'primer piso'),
(3, 'Consultorio 03', '', '3', 1, 'su atencion por favor.', 'dirijase al consultorio numero tres. gracias.', 'testing sms electroturno', 'gracias por elegirnos!', '', '2', '1', 'planta baja'),
(2, 'Consultorio 02', '', '2', 1, 'su atencion por favor.', 'dirijase al consultorio numero dos. gracias.', 'testing sms electroturno', 'gracias por elegirnos!', '', '2', '1', 'planta baja'),
(1, 'Consultorio 01', '', '1', 1, 'su atencion por favor.', 'dirijase al consultorio numero uno. gracias.', 'testing sms electroturno', 'gracias por elegirnos!', '', '2', '1', 'planta baja'),
(5, 'Consultorio 05', '', '5', 1, 'su atencion por favor.', 'dirijase al consultorio numero cinco. gracias.', 'testing sms electroturno', 'gracias por elegirnos!', '', '5', '2', 'primer piso'),
(11, 'Consultorio 06', '', '6', 1, 'su atencion por favor.', 'dirijase al consultorio numero seis. gracias', '', '', '', '5', '2', 'primer piso'),
(12, 'Consultorio 07', '', '7', 1, 'su atencion por favor', 'dirijase al consultorio numero siete. gracias.', '', '', '', '6', '3', 'primer piso'),
(13, 'Consultorio 08', '', '8', 1, 'su atencion por favor.', 'dirijase al consultorio numero ocho. gracias.', '', '', '', '6', '3', 'primer piso'),
(14, 'Consultorio 09', '', '9', 1, 'su atencion por favor.', 'dirijase al consultorio numero nueve. gracias.', '', '', '', '7', '4', 'primer piso'),
(15, 'Consultorio 10', '', '10', 1, 'su atencion por favor.', 'dirijase al consultorio numero diez. gracias.', '', '', '', '7', '4', 'primer piso'),
(16, 'Consultorio 11', '', '11', 1, 'su atencion por favor.', 'dirijase al consultorio numero once. gracias.', '', '', '', '8', '5', 'segundo piso'),
(17, 'Consultorio 12', '', '12', 1, 'su atencion por favor.', 'dirijase al consultorio numero doce. gracias.', '', '', '', '8', '5', 'segundo piso'),
(18, 'Consultorio 13', '', '13', 1, 'su atencion por favor.', 'dirijase al consultorio numero trece. gracias.', '', '', '', '8', '5', 'segundo piso'),
(19, 'Consultorio 14', '', '14', 1, 'su atencion por favor.', 'dirijase al consultorio numero catorce. gracias.', '', '', '', '8', '5', 'segundo piso');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `internal_id` varchar(150) NOT NULL,
  `login` varchar(30) DEFAULT NULL,
  `name` varchar(25) DEFAULT NULL,
  `surname` varchar(30) DEFAULT NULL,
  `md5_password` varchar(50) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `description` varchar(50) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `extension_number` int(11) DEFAULT NULL,
  `lang` varchar(10) DEFAULT NULL,
  `theme` varchar(10) DEFAULT NULL,
  `id_section` varchar(200) NOT NULL,
  `status` varchar(10) DEFAULT '0',
  `nr_ticket_before_sendsms` int(11) DEFAULT NULL,
  `active` int(11) DEFAULT NULL,
  `able_to_choose_section` int(2) NOT NULL,
  `ticket_selection` varchar(15) NOT NULL,
  `chat_status` varchar(255) NOT NULL DEFAULT 'offline',
  `offlineshift` int(11) NOT NULL,
  `multiuser` int(11) NOT NULL DEFAULT '0' COMMENT '1/0',
  `group_paperwork` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='esto es por ejemplo: un cajero del banco' AUTO_INCREMENT=115 ;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `internal_id`, `login`, `name`, `surname`, `md5_password`, `email`, `description`, `telephone`, `extension_number`, `lang`, `theme`, `id_section`, `status`, `nr_ticket_before_sendsms`, `active`, `able_to_choose_section`, `ticket_selection`, `chat_status`, `offlineshift`, `multiuser`, `group_paperwork`) VALUES
(1, '', 'root', 'root', 'Root', '4da91ad4012f95dc46df57ccfbb7729f', 'admin@admin.com', 'Admin', '47235004', 111, 'es', 'default', '2', '1', 0, 1, 0, 'simple', 'online', 0, 1, '1,2'),
(2, '', 'admin', 'Administrador', 'Admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@admin.com', 'Administrador', '', 0, 'es', 'default', '1', '1', 0, 1, 0, 'simple', 'offline', 0, 1, '3'),
(114, '', 'usuario', 'usuario', 'usuario', 'f8032d5cae3de20fcec887f395ec9a6a', 'usuario@usuario.com', 'usuario', '1234', 123, 'es', 'default', '1', '', 0, 1, 0, 'simple', 'offline', 0, 0, '3');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
