-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.1.28-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win32
-- HeidiSQL Versión:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para ambiental
CREATE DATABASE IF NOT EXISTS `ambiental` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `ambiental`;

-- Volcando estructura para tabla ambiental.menus
DROP TABLE IF EXISTS `menus`;
CREATE TABLE IF NOT EXISTS `menus` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `item` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `orden` int(11) NOT NULL,
  `depende_de` int(11) NOT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permiso_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `target` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `usu_alta_id` int(10) unsigned NOT NULL,
  `usu_mod_id` int(10) unsigned NOT NULL,
  `activo` int(11) DEFAULT NULL,
  `imagen` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `menus_usu_alta_id_foreign` (`usu_alta_id`),
  KEY `menus_usu_mod_id_foreign` (`usu_mod_id`),
  CONSTRAINT `menus_usu_alta_id_foreign` FOREIGN KEY (`usu_alta_id`) REFERENCES `users` (`id`),
  CONSTRAINT `menus_usu_mod_id_foreign` FOREIGN KEY (`usu_mod_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla ambiental.menus: ~6 rows (aproximadamente)
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT INTO `menus` (`id`, `item`, `orden`, `depende_de`, `link`, `permiso_id`, `target`, `created_at`, `updated_at`, `deleted_at`, `usu_alta_id`, `usu_mod_id`, `activo`, `imagen`) VALUES
	(1, 'padre', 1, 0, 'home', 'home', 'home', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 1, 1, 1, NULL),
	(2, 'Herramientas', 1010101, 1, 'home', 'home', 'home', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 1, 1, 1, ' glyphicon glyphicon-wrench'),
	(3, 'Seguridad', 1020101, 2, 'home', 'home', 'home', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 1, 1, 1, 'fa fa-caret-right'),
	(4, 'Permisos', 1020201, 3, 'permissions.permission.index', 'home', 'home', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 1, 1, 1, 'fa fa-caret-right'),
	(5, 'Grupos Permisos', 1020301, 3, 'permission_groups.permission_group.index', 'home', 'home', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 1, 1, 1, 'fa fa-caret-right'),
	(6, 'Roles', 1020401, 3, 'roles.role.index', 'home', 'home', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 1, 1, 1, 'fa fa-caret-right'),
	(7, 'Usarios', 1020501, 3, 'users.user.index', 'home', 'home', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 1, 1, 1, 'fa fa-caret-right');
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;

-- Volcando estructura para tabla ambiental.migrations
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla ambiental.migrations: ~8 rows (aproximadamente)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2016_09_28_102718_create_roles_table', 2),
	(4, '2016_09_28_105445_create_permissions_table', 2),
	(5, '2016_09_28_105544_create_permission_role_table', 2),
	(6, '2016_09_28_105545_create_permission_groups_table', 2),
	(7, '2016_09_28_105644_create_permission_group_role_table', 2),
	(8, '2016_09_28_105744_create_permission_permission_group_table', 2),
	(9, '2016_09_28_105855_create_role_user_table', 2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Volcando estructura para tabla ambiental.password_resets
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla ambiental.password_resets: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Volcando estructura para tabla ambiental.permissions
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla ambiental.permissions: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` (`id`, `slug`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'users.user.index', 'users.user.index', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(2, 'users.user.create', 'users.user.create', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(3, 'users.user.show', 'users.user.show', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(4, 'users.user.edit', 'users.user.edit', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(5, 'users.user.store', 'users.user.store', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(6, 'users.user.update', 'users.user.update', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(7, 'users.user.destroy', 'users.user.destroy', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(8, 'permissions.permission.index', 'permissions.permission.index', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(9, 'permissions.permission.create', 'permissions.permission.create', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(10, 'permissions.permission.show', 'permissions.permission.show', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(11, 'permissions.permission.edit', 'permissions.permission.edit', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(12, 'permissions.permission.store', 'permissions.permission.store', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(13, 'permissions.permission.update', 'permissions.permission.update', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(14, 'permissions.permission.destroy', 'permissions.permission.destroy', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(15, 'roles.role.index', 'roles.role.index', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(16, 'roles.role.create', 'roles.role.create', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(17, 'roles.role.show', 'roles.role.show', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(18, 'roles.role.edit', 'roles.role.edit', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(19, 'roles.role.store', 'roles.role.store', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(20, 'roles.role.update', 'roles.role.update', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(21, 'roles.role.destroy', 'roles.role.destroy', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(22, 'permission_groups.permission_group.index', 'permission_groups.permission_group.index', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(23, 'permission_groups.permission_group.create', 'permission_groups.permission_group.create', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(24, 'permission_groups.permission_group.show', 'permission_groups.permission_group.show', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(25, 'permission_groups.permission_group.edit', 'permission_groups.permission_group.edit', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(26, 'permission_groups.permission_group.store', 'permission_groups.permission_group.store', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(27, 'permission_groups.permission_group.update', 'permission_groups.permission_group.update', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(28, 'permission_groups.permission_group.destroy', 'permission_groups.permission_group.destroy', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(29, 'menus.menu.index', 'menus.menu.index', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(30, 'menus.menu.create', 'menus.menu.create', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(31, 'menus.menu.show', 'menus.menu.show', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(32, 'menus.menu.edit', 'menus.menu.edit', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(33, 'menus.menu.store', 'menus.menu.store', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(34, 'menus.menu.update', 'menus.menu.update', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(35, 'menus.menu.destroy', 'menus.menu.destroy', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(36, 'permission_groups.permission_group.addPermission', 'permission_groups.permission_group.addPermission', NULL, NULL),
	(37, 'seguridad', 'seguridad', '0000-00-00 00:00:00', NULL),
	(38, 'users.user.editPerfil', 'users.user.editPerfil', NULL, NULL),
	(39, 'users.user.addRol', 'users.user.addRol', NULL, NULL),
	(40, 'users.user.lessRol', 'users.user.lessRol', NULL, NULL);
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;

-- Volcando estructura para tabla ambiental.permission_groups
DROP TABLE IF EXISTS `permission_groups`;
CREATE TABLE IF NOT EXISTS `permission_groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `module` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla ambiental.permission_groups: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `permission_groups` DISABLE KEYS */;
INSERT INTO `permission_groups` (`id`, `name`, `module`, `created_at`, `updated_at`) VALUES
	(1, 'superusuario', 'superusuario', '2017-12-31 19:15:58', '2018-01-02 17:01:17');
/*!40000 ALTER TABLE `permission_groups` ENABLE KEYS */;

-- Volcando estructura para tabla ambiental.permission_group_role
DROP TABLE IF EXISTS `permission_group_role`;
CREATE TABLE IF NOT EXISTS `permission_group_role` (
  `permission_group_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_group_id`,`role_id`),
  KEY `permission_group_role_role_id_foreign` (`role_id`),
  CONSTRAINT `permission_group_role_permission_group_id_foreign` FOREIGN KEY (`permission_group_id`) REFERENCES `permission_groups` (`id`) ON DELETE CASCADE,
  CONSTRAINT `permission_group_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla ambiental.permission_group_role: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `permission_group_role` DISABLE KEYS */;
INSERT INTO `permission_group_role` (`permission_group_id`, `role_id`) VALUES
	(1, 1);
/*!40000 ALTER TABLE `permission_group_role` ENABLE KEYS */;

-- Volcando estructura para tabla ambiental.permission_permission_group
DROP TABLE IF EXISTS `permission_permission_group`;
CREATE TABLE IF NOT EXISTS `permission_permission_group` (
  `permission_id` int(10) unsigned NOT NULL,
  `permission_group_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`permission_group_id`),
  KEY `ppg_permission_group_id` (`permission_group_id`),
  CONSTRAINT `ppg_permission_group_id` FOREIGN KEY (`permission_group_id`) REFERENCES `permission_groups` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ppg_permission_id` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla ambiental.permission_permission_group: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `permission_permission_group` DISABLE KEYS */;
INSERT INTO `permission_permission_group` (`permission_id`, `permission_group_id`) VALUES
	(1, 1),
	(2, 1),
	(3, 1),
	(4, 1),
	(5, 1),
	(6, 1),
	(7, 1),
	(8, 1),
	(9, 1),
	(10, 1),
	(11, 1),
	(12, 1),
	(13, 1),
	(14, 1),
	(15, 1),
	(16, 1),
	(17, 1),
	(18, 1),
	(19, 1),
	(20, 1),
	(21, 1),
	(22, 1),
	(23, 1),
	(24, 1),
	(25, 1),
	(26, 1),
	(27, 1),
	(28, 1),
	(29, 1),
	(30, 1),
	(31, 1),
	(32, 1),
	(33, 1),
	(34, 1),
	(35, 1),
	(36, 1),
	(37, 1),
	(38, 1),
	(39, 1),
	(40, 1);
/*!40000 ALTER TABLE `permission_permission_group` ENABLE KEYS */;

-- Volcando estructura para tabla ambiental.permission_role
DROP TABLE IF EXISTS `permission_role`;
CREATE TABLE IF NOT EXISTS `permission_role` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `permission_role_role_id_foreign` (`role_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla ambiental.permission_role: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `permission_role` DISABLE KEYS */;
INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
	(1, 1),
	(37, 1);
/*!40000 ALTER TABLE `permission_role` ENABLE KEYS */;

-- Volcando estructura para tabla ambiental.roles
DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla ambiental.roles: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `slug`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'superadmin', 'Superadmin', '2017-12-29 16:47:08', '2017-12-29 20:46:26'),
	(2, 'admin', 'Admin', '2017-12-29 17:06:29', '2017-12-29 17:06:29');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

-- Volcando estructura para tabla ambiental.role_user
DROP TABLE IF EXISTS `role_user`;
CREATE TABLE IF NOT EXISTS `role_user` (
  `role_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`user_id`),
  KEY `role_user_user_id_foreign` (`user_id`),
  CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla ambiental.role_user: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `role_user` DISABLE KEYS */;
INSERT INTO `role_user` (`role_id`, `user_id`) VALUES
	(1, 1);
/*!40000 ALTER TABLE `role_user` ENABLE KEYS */;

-- Volcando estructura para tabla ambiental.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla ambiental.users: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'admin', 'fillinares@yahoo.com.mx', '$2y$10$jsBbOqdGJI3xr2EC.sNpEOwAeYiXygEhZXpNv2CZcs/emyFENWxna', 'omPnGE9HLklenBLcJZIx7tx8MqZgoMo9EJeewr6tzNF2gOl6oCE9ZtdZnezt', '2017-12-29 02:15:22', '2017-12-29 02:15:22'),
	(2, 'linares82', 'linares82@gmail.com', '$2y$10$slg1DrL7skfYpwi71V9I1uTHzwvefUeAhO2KprAYuAfyhhxuGZ0Tm', 'vg4mhFcDHbinXkXuYyUhL1LeDLKTWYe5JKt0qAvYJSC7VdMhV4vIJcmFIHjC', '2018-01-02 15:51:56', '2018-01-02 19:40:41');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
