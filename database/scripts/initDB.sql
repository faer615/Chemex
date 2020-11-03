-- --------------------------------------------------------
-- 主机:                           212.64.81.233
-- 服务器版本:                        10.2.30-MariaDB - MariaDB Server
-- 服务器操作系统:                      Linux
-- HeidiSQL 版本:                  11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- 正在导出表  chemex-dev.admin_extensions 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `admin_extensions` DISABLE KEYS */;
/*!40000 ALTER TABLE `admin_extensions` ENABLE KEYS */;

-- 正在导出表  chemex-dev.admin_extension_histories 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `admin_extension_histories` DISABLE KEYS */;
/*!40000 ALTER TABLE `admin_extension_histories` ENABLE KEYS */;

-- 正在导出表  chemex-dev.admin_menu 的数据：~27 rows (大约)
/*!40000 ALTER TABLE `admin_menu` DISABLE KEYS */;
INSERT INTO `admin_menu` (`id`, `parent_id`, `order`, `title`, `icon`, `uri`, `created_at`, `updated_at`) VALUES
	(1, 0, 1, 'Index', 'feather icon-bar-chart-2', '/', '2020-10-10 15:06:20', '2020-10-10 15:06:20'),
	(8, 0, 6, 'Software Management', 'feather icon-disc', '', '2020-10-10 15:06:21', '2020-10-04 10:44:31'),
	(9, 8, 8, 'Software Categories', '', 'software/categories', '2020-10-10 15:06:22', '2020-10-04 10:44:31'),
	(10, 0, 14, 'Vendor Management', 'feather icon-zap', '', '2020-10-10 15:06:22', '2020-10-04 10:44:31'),
	(11, 10, 15, 'Vendor Records', '', 'vendor/records', '2020-10-10 15:06:23', '2020-10-04 10:44:31'),
	(12, 8, 7, 'Software Records', '', 'software/records', '2020-10-10 15:06:23', '2020-10-04 10:44:31'),
	(13, 0, 10, 'Hardware Management', 'feather icon-server', '', '2020-10-10 15:06:24', '2020-10-04 10:44:31'),
	(14, 13, 12, 'Hardware Categories', '', 'hardware/categories', '2020-10-10 15:06:24', '2020-10-04 10:44:31'),
	(15, 13, 11, 'Hardware Records', '', 'hardware/records', '2020-10-10 15:06:24', '2020-10-04 10:44:31'),
	(16, 0, 2, 'Device Management', 'feather icon-monitor', '', '2020-10-10 15:06:25', '2020-10-10 15:06:18'),
	(17, 16, 4, 'Device Categories', '', 'device/categories', '2020-10-10 15:06:27', '2020-10-10 15:06:18'),
	(18, 0, 16, 'Staff Management', 'feather icon-user-check', '', '2020-10-10 15:06:25', '2020-10-04 10:44:31'),
	(19, 18, 18, 'Staff Departments', '', 'staff/departments', '2020-10-10 15:06:27', '2020-10-04 10:44:31'),
	(20, 18, 17, 'Staff Records', '', 'staff/records', '2020-10-10 15:06:26', '2020-10-04 10:44:31'),
	(21, 16, 3, 'Device Records', '', 'device/records', '2020-10-10 15:06:28', '2020-10-10 15:06:19'),
	(22, 8, 9, 'Software Tracks', '', 'software/tracks', '2020-10-10 15:06:28', '2020-10-04 10:44:31'),
	(23, 13, 13, 'Hardware Tracks', '', 'hardware/tracks', '2020-10-10 15:06:29', '2020-10-04 10:44:31'),
	(24, 16, 5, 'Device Tracks', '', 'device/tracks', '2020-10-10 15:06:29', '2020-10-04 10:44:31'),
	(25, 0, 23, 'Check Management', 'feather icon-check-circle', NULL, '2020-10-04 10:22:42', '2020-11-03 14:23:24'),
	(26, 25, 24, 'Check Records', NULL, 'check/records', '2020-10-04 10:23:17', '2020-11-03 14:23:24'),
	(27, 25, 25, 'Check Tracks', NULL, 'check/tracks', '2020-10-04 10:23:33', '2020-11-03 14:23:24'),
	(28, 0, 19, 'Service Management', 'feather icon-activity', NULL, '2020-10-06 21:38:40', '2020-10-06 21:39:10'),
	(29, 28, 20, 'Service Records', NULL, 'service/records', '2020-10-06 21:39:02', '2020-10-06 21:39:10'),
	(30, 28, 21, 'Service Tracks', NULL, 'service/tracks', '2020-10-06 22:02:15', '2020-11-03 14:23:24'),
	(31, 28, 22, 'Service Issues', NULL, 'service/issues', '2020-10-06 23:23:22', '2020-11-03 14:23:24'),
	(53, 0, 26, 'Maintenance Records', 'feather icon-shield', 'maintenance/records', '2020-10-10 15:06:15', '2020-11-03 14:23:24'),
	(54, 0, 27, 'Update', 'feather icon-chevrons-down', 'update', '2020-10-22 15:05:00', '2020-11-03 14:23:24'),
	(55, 56, 32, 'Menu', NULL, 'auth/menu', '2020-11-03 14:22:49', '2020-11-03 14:27:25'),
	(56, 0, 28, 'Settings', NULL, NULL, '2020-11-03 14:23:14', '2020-11-03 14:24:27'),
	(57, 56, 29, 'Users', NULL, 'auth/users', '2020-11-03 14:25:13', '2020-11-03 14:27:25'),
	(58, 56, 30, 'Roles', NULL, 'auth/roles', '2020-11-03 14:25:25', '2020-11-03 14:27:25'),
	(59, 56, 31, 'Permissions', NULL, 'auth/permissions', '2020-11-03 14:26:37', '2020-11-03 14:27:25');
/*!40000 ALTER TABLE `admin_menu` ENABLE KEYS */;

-- 正在导出表  chemex-dev.admin_permissions 的数据：~6 rows (大约)
/*!40000 ALTER TABLE `admin_permissions` DISABLE KEYS */;
INSERT INTO `admin_permissions` (`id`, `name`, `slug`, `http_method`, `http_path`, `order`, `parent_id`, `created_at`, `updated_at`) VALUES
	(1, 'Auth management', 'auth-management', '', '', 1, 0, '2020-09-18 09:45:49', NULL),
	(2, 'Users', 'users', '', '/auth/users*', 2, 1, '2020-09-18 09:45:49', NULL),
	(3, 'Roles', 'roles', '', '/auth/roles*', 3, 1, '2020-09-18 09:45:49', NULL),
	(4, 'Permissions', 'permissions', '', '/auth/permissions*', 4, 1, '2020-09-18 09:45:49', NULL),
	(5, 'Menu', 'menu', '', '/auth/menu*', 5, 1, '2020-09-18 09:45:49', NULL),
	(6, 'Operation log', 'operation-log', '', '/auth/logs*', 6, 1, '2020-09-18 09:45:49', NULL);
/*!40000 ALTER TABLE `admin_permissions` ENABLE KEYS */;

-- 正在导出表  chemex-dev.admin_permission_menu 的数据：~105 rows (大约)
/*!40000 ALTER TABLE `admin_permission_menu` DISABLE KEYS */;
INSERT INTO `admin_permission_menu` (`permission_id`, `menu_id`, `created_at`, `updated_at`) VALUES
	(2, 32, NULL, NULL),
	(2, 33, NULL, NULL),
	(2, 34, NULL, NULL),
	(2, 35, NULL, NULL),
	(2, 36, NULL, NULL),
	(2, 37, NULL, NULL),
	(2, 38, NULL, NULL),
	(2, 39, NULL, NULL),
	(2, 40, NULL, NULL),
	(2, 41, NULL, NULL),
	(2, 42, NULL, NULL),
	(2, 43, NULL, NULL),
	(2, 44, NULL, NULL),
	(2, 45, NULL, NULL),
	(2, 46, NULL, NULL),
	(2, 47, NULL, NULL),
	(2, 48, NULL, NULL),
	(2, 49, NULL, NULL),
	(2, 50, NULL, NULL),
	(2, 51, NULL, NULL),
	(2, 52, NULL, NULL),
	(3, 32, NULL, NULL),
	(3, 33, NULL, NULL),
	(3, 34, NULL, NULL),
	(3, 35, NULL, NULL),
	(3, 36, NULL, NULL),
	(3, 37, NULL, NULL),
	(3, 38, NULL, NULL),
	(3, 39, NULL, NULL),
	(3, 40, NULL, NULL),
	(3, 41, NULL, NULL),
	(3, 42, NULL, NULL),
	(3, 43, NULL, NULL),
	(3, 44, NULL, NULL),
	(3, 45, NULL, NULL),
	(3, 46, NULL, NULL),
	(3, 47, NULL, NULL),
	(3, 48, NULL, NULL),
	(3, 49, NULL, NULL),
	(3, 50, NULL, NULL),
	(3, 51, NULL, NULL),
	(3, 52, NULL, NULL),
	(4, 32, NULL, NULL),
	(4, 33, NULL, NULL),
	(4, 34, NULL, NULL),
	(4, 35, NULL, NULL),
	(4, 36, NULL, NULL),
	(4, 37, NULL, NULL),
	(4, 38, NULL, NULL),
	(4, 39, NULL, NULL),
	(4, 40, NULL, NULL),
	(4, 41, NULL, NULL),
	(4, 42, NULL, NULL),
	(4, 43, NULL, NULL),
	(4, 44, NULL, NULL),
	(4, 45, NULL, NULL),
	(4, 46, NULL, NULL),
	(4, 47, NULL, NULL),
	(4, 48, NULL, NULL),
	(4, 49, NULL, NULL),
	(4, 50, NULL, NULL),
	(4, 51, NULL, NULL),
	(4, 52, NULL, NULL),
	(5, 32, NULL, NULL),
	(5, 33, NULL, NULL),
	(5, 34, NULL, NULL),
	(5, 35, NULL, NULL),
	(5, 36, NULL, NULL),
	(5, 37, NULL, NULL),
	(5, 38, NULL, NULL),
	(5, 39, NULL, NULL),
	(5, 40, NULL, NULL),
	(5, 41, NULL, NULL),
	(5, 42, NULL, NULL),
	(5, 43, NULL, NULL),
	(5, 44, NULL, NULL),
	(5, 45, NULL, NULL),
	(5, 46, NULL, NULL),
	(5, 47, NULL, NULL),
	(5, 48, NULL, NULL),
	(5, 49, NULL, NULL),
	(5, 50, NULL, NULL),
	(5, 51, NULL, NULL),
	(5, 52, NULL, NULL),
	(6, 32, NULL, NULL),
	(6, 33, NULL, NULL),
	(6, 34, NULL, NULL),
	(6, 35, NULL, NULL),
	(6, 36, NULL, NULL),
	(6, 37, NULL, NULL),
	(6, 38, NULL, NULL),
	(6, 39, NULL, NULL),
	(6, 40, NULL, NULL),
	(6, 41, NULL, NULL),
	(6, 42, NULL, NULL),
	(6, 43, NULL, NULL),
	(6, 44, NULL, NULL),
	(6, 45, NULL, NULL),
	(6, 46, NULL, NULL),
	(6, 47, NULL, NULL),
	(6, 48, NULL, NULL),
	(6, 49, NULL, NULL),
	(6, 50, NULL, NULL),
	(6, 51, NULL, NULL),
	(6, 52, NULL, NULL);
/*!40000 ALTER TABLE `admin_permission_menu` ENABLE KEYS */;

-- 正在导出表  chemex-dev.admin_roles 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `admin_roles` DISABLE KEYS */;
INSERT INTO `admin_roles` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
	(1, 'Administrator', 'administrator', '2020-09-18 09:45:49', '2020-09-18 09:45:49');
/*!40000 ALTER TABLE `admin_roles` ENABLE KEYS */;

-- 正在导出表  chemex-dev.admin_role_menu 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `admin_role_menu` DISABLE KEYS */;
/*!40000 ALTER TABLE `admin_role_menu` ENABLE KEYS */;

-- 正在导出表  chemex-dev.admin_role_permissions 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `admin_role_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `admin_role_permissions` ENABLE KEYS */;

-- 正在导出表  chemex-dev.admin_role_users 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `admin_role_users` DISABLE KEYS */;
INSERT INTO `admin_role_users` (`role_id`, `user_id`, `created_at`, `updated_at`) VALUES
	(1, 1, NULL, NULL);
/*!40000 ALTER TABLE `admin_role_users` ENABLE KEYS */;

-- 正在导出表  chemex-dev.admin_settings 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `admin_settings` DISABLE KEYS */;
/*!40000 ALTER TABLE `admin_settings` ENABLE KEYS */;

-- 正在导出表  chemex-dev.admin_users 的数据：~2 rows (大约)
/*!40000 ALTER TABLE `admin_users` DISABLE KEYS */;
INSERT INTO `admin_users` (`id`, `username`, `password`, `name`, `avatar`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'admin', '$2y$10$0FABOJldsayevR1lGRlHSuIEVANwUN0NQ56VPZC6AMMHy3GsTL1nm', 'Administrator', NULL, '9FYVEHFWRSn4i5CC4QVw6DnHfc0xyPqwBJXwDEsamQqI6o7N76hezUMEVP6z', '2020-09-18 09:45:49', '2020-10-12 19:30:10'),
	(2, 'test_user1', '$2y$10$LkfJ2s63BGHYpYGU.D5JFuym6x9oE2z34JhFkqbtvSgZJQGm05Aoe', '测试用户1', NULL, NULL, '2020-10-04 23:40:28', '2020-10-04 23:40:28');
/*!40000 ALTER TABLE `admin_users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
