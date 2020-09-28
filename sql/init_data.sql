/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

DELETE FROM `admin_menu`;
/*!40000 ALTER TABLE `admin_menu` DISABLE KEYS */;
INSERT INTO `admin_menu` (`id`, `parent_id`, `order`, `title`, `icon`, `uri`, `created_at`, `updated_at`) VALUES
	(1, 0, 1, 'Index', 'feather icon-bar-chart-2', '/', NULL, NULL),
	(2, 0, 16, 'Admin', 'feather icon-settings', '/', NULL, NULL),
	(3, 2, 17, 'Users', '', 'auth/users', NULL, NULL),
	(4, 2, 18, 'Roles', '', 'auth/roles', NULL, NULL),
	(5, 2, 19, 'Permission', '', 'auth/permissions', NULL, NULL),
	(6, 2, 20, 'Menu', '', 'auth/menu', NULL, NULL),
	(7, 2, 21, 'Operation log', '', 'auth/logs', NULL, NULL),
	(8, 0, 5, 'Software Management', '', '', NULL, NULL),
	(9, 8, 7, 'Software Categories', '', 'software/categories', NULL, NULL),
	(10, 0, 11, 'Vendor Management', '', '', NULL, NULL),
	(11, 10, 12, 'Vendor Records', '', 'vendor/records', NULL, NULL),
	(12, 8, 6, 'Software Records', '', 'software/records', NULL, NULL),
	(13, 0, 8, 'Hardware Management', '', '', NULL, NULL),
	(14, 13, 10, 'Hardware Categories', '', 'hardware/categories', NULL, NULL),
	(15, 13, 9, 'Hardware Records', '', 'hardware/records', NULL, NULL),
	(16, 0, 2, 'Device Management', '', '', NULL, NULL),
	(17, 16, 4, 'Device Categories', '', 'device/categories', NULL, NULL),
	(18, 0, 13, 'Staff Management', '', '', NULL, NULL),
	(19, 18, 15, 'Staff Departments', '', 'staff/departments', NULL, NULL),
	(20, 18, 14, 'Staff Records', '', 'staff/records', NULL, NULL),
	(21, 16, 3, 'Device Records', '', 'device/records', NULL, NULL),
	(22, 8, 22, 'Software Tracks', '', 'software/tracks', NULL, NULL),
	(23, 13, 23, 'Hardware Tracks', '', 'hardware/tracks', NULL, NULL),
	(24, 16, 24, 'Device Tracks', '', 'device/tracks', NULL, NULL);
/*!40000 ALTER TABLE `admin_menu` ENABLE KEYS */;

DELETE FROM `admin_permissions`;
/*!40000 ALTER TABLE `admin_permissions` DISABLE KEYS */;
INSERT INTO `admin_permissions` (`id`, `name`, `slug`, `http_method`, `http_path`, `order`, `parent_id`, `created_at`, `updated_at`) VALUES
	(1, 'Auth management', 'auth-management', '', '', 1, 0, '2020-09-18 09:45:49', NULL),
	(2, 'Users', 'users', '', '/auth/users*', 2, 1, '2020-09-18 09:45:49', NULL),
	(3, 'Roles', 'roles', '', '/auth/roles*', 3, 1, '2020-09-18 09:45:49', NULL),
	(4, 'Permissions', 'permissions', '', '/auth/permissions*', 4, 1, '2020-09-18 09:45:49', NULL),
	(5, 'Menu', 'menu', '', '/auth/menu*', 5, 1, '2020-09-18 09:45:49', NULL),
	(6, 'Operation log', 'operation-log', '', '/auth/logs*', 6, 1, '2020-09-18 09:45:49', NULL);
/*!40000 ALTER TABLE `admin_permissions` ENABLE KEYS */;

DELETE FROM `admin_permission_menu`;
/*!40000 ALTER TABLE `admin_permission_menu` DISABLE KEYS */;
/*!40000 ALTER TABLE `admin_permission_menu` ENABLE KEYS */;

DELETE FROM `admin_roles`;
/*!40000 ALTER TABLE `admin_roles` DISABLE KEYS */;
INSERT INTO `admin_roles` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
	(1, 'Administrator', 'administrator', '2020-09-18 09:45:49', '2020-09-18 09:45:49');
/*!40000 ALTER TABLE `admin_roles` ENABLE KEYS */;

DELETE FROM `admin_role_menu`;
/*!40000 ALTER TABLE `admin_role_menu` DISABLE KEYS */;
/*!40000 ALTER TABLE `admin_role_menu` ENABLE KEYS */;

DELETE FROM `admin_role_permissions`;
/*!40000 ALTER TABLE `admin_role_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `admin_role_permissions` ENABLE KEYS */;

DELETE FROM `admin_role_users`;
/*!40000 ALTER TABLE `admin_role_users` DISABLE KEYS */;
INSERT INTO `admin_role_users` (`role_id`, `user_id`, `created_at`, `updated_at`) VALUES
	(1, 1, NULL, NULL);
/*!40000 ALTER TABLE `admin_role_users` ENABLE KEYS */;

DELETE FROM `admin_users`;
/*!40000 ALTER TABLE `admin_users` DISABLE KEYS */;
INSERT INTO `admin_users` (`id`, `username`, `password`, `name`, `avatar`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'admin', '$2y$10$HDCg7qVNYFBsJrreft4SMOCznLgNKpZmAQPEVy1XdrDETJxDpbZZS', 'Administrator', NULL, NULL, '2020-09-18 09:45:49', '2020-09-18 09:45:49');
/*!40000 ALTER TABLE `admin_users` ENABLE KEYS */;

DELETE FROM `device_categories`;
/*!40000 ALTER TABLE `device_categories` DISABLE KEYS */;
INSERT INTO `device_categories` (`id`, `name`, `description`, `creator`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, '笔记本', NULL, NULL, NULL, '2020-09-24 08:28:32', '2020-09-24 08:28:32'),
	(2, '台式机', NULL, NULL, NULL, '2020-09-24 08:28:36', '2020-09-24 08:28:36');
/*!40000 ALTER TABLE `device_categories` ENABLE KEYS */;

DELETE FROM `device_records`;
/*!40000 ALTER TABLE `device_records` DISABLE KEYS */;
INSERT INTO `device_records` (`id`, `name`, `description`, `category_id`, `vendor_id`, `sn`, `mac`, `ip`, `photo`, `creator`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, 'PC-00001', NULL, 2, 2, 'DDD-A12319231', NULL, '192.168.1.12', 'images/6715ef80607acca796aaafd6a8136028.jpg', 'Administrator', NULL, '2020-09-24 08:29:49', '2020-09-28 15:04:32'),
	(2, 'SERVER-A1', NULL, 2, 2, 'DDD-A12319231', 'FF-FF-FF-FF-FF-FF', '192.168.1.2', NULL, NULL, NULL, '2020-09-24 14:28:46', '2020-09-24 14:28:46'),
	(3, 'FAMIO-X', NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2020-09-28 14:35:55', '2020-09-28 14:35:55');
/*!40000 ALTER TABLE `device_records` ENABLE KEYS */;

DELETE FROM `device_tracks`;
/*!40000 ALTER TABLE `device_tracks` DISABLE KEYS */;
INSERT INTO `device_tracks` (`id`, `device_id`, `staff_id`, `creator`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, '', NULL, '2020-09-24 08:37:57', '2020-09-24 08:37:57');
/*!40000 ALTER TABLE `device_tracks` ENABLE KEYS */;

DELETE FROM `failed_jobs`;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

DELETE FROM `hardware_categories`;
/*!40000 ALTER TABLE `hardware_categories` DISABLE KEYS */;
INSERT INTO `hardware_categories` (`id`, `name`, `description`, `creator`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, '固态硬盘', NULL, NULL, NULL, '2020-09-24 08:19:43', '2020-09-24 08:19:43'),
	(2, '内存', NULL, NULL, NULL, '2020-09-24 08:19:53', '2020-09-24 08:19:53');
/*!40000 ALTER TABLE `hardware_categories` ENABLE KEYS */;

DELETE FROM `hardware_records`;
/*!40000 ALTER TABLE `hardware_records` DISABLE KEYS */;
INSERT INTO `hardware_records` (`id`, `name`, `description`, `category_id`, `vendor_id`, `specification`, `sn`, `creator`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, 'Fury', NULL, 2, 4, 'DDR4 2400', NULL, NULL, NULL, '2020-09-24 08:23:34', '2020-09-24 09:18:59'),
	(2, 'SN720', NULL, 1, 2, '500G', NULL, NULL, NULL, '2020-09-24 08:26:02', '2020-09-24 08:26:02'),
	(3, 'Fury', NULL, 2, 4, 'DDR4 2400', NULL, NULL, NULL, '2020-09-24 09:19:46', '2020-09-24 09:19:46');
/*!40000 ALTER TABLE `hardware_records` ENABLE KEYS */;

DELETE FROM `hardware_tracks`;
/*!40000 ALTER TABLE `hardware_tracks` DISABLE KEYS */;
INSERT INTO `hardware_tracks` (`id`, `hardware_id`, `device_id`, `creator`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, NULL, '2020-09-27 13:38:02', '2020-09-24 08:47:30', '2020-09-24 08:47:30'),
	(2, 2, 1, NULL, NULL, '2020-09-24 08:47:42', '2020-09-24 08:47:42'),
	(3, 3, 1, NULL, NULL, '2020-09-24 09:20:01', '2020-09-24 09:20:01');
/*!40000 ALTER TABLE `hardware_tracks` ENABLE KEYS */;

DELETE FROM `software_categories`;
/*!40000 ALTER TABLE `software_categories` DISABLE KEYS */;
INSERT INTO `software_categories` (`id`, `name`, `description`, `creator`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, '办公应用', NULL, NULL, NULL, '2020-09-24 08:27:04', '2020-09-24 08:27:04'),
	(2, '操作系统', NULL, NULL, NULL, '2020-09-24 08:27:09', '2020-09-24 08:27:09');
/*!40000 ALTER TABLE `software_categories` ENABLE KEYS */;

DELETE FROM `software_records`;
/*!40000 ALTER TABLE `software_records` DISABLE KEYS */;
INSERT INTO `software_records` (`id`, `name`, `description`, `category_id`, `version`, `vendor_id`, `price`, `purchased`, `expired`, `distribution`, `sn`, `counts`, `creator`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, 'Office 2019', NULL, 1, 'Business', 1, 1500, '2020-09-24', '2020-09-24', 'b', NULL, 5, '1', NULL, '2020-09-24 08:27:44', '2020-09-24 08:27:44'),
	(2, 'Windows 10', NULL, 2, 'Pro', 1, 2000, '2020-09-24', '2020-09-24', 'b', NULL, 1, '1', NULL, '2020-09-24 08:28:09', '2020-09-24 08:28:09');
/*!40000 ALTER TABLE `software_records` ENABLE KEYS */;

DELETE FROM `software_tracks`;
/*!40000 ALTER TABLE `software_tracks` DISABLE KEYS */;
INSERT INTO `software_tracks` (`id`, `software_id`, `device_id`, `creator`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, NULL, '2020-09-27 14:44:31', '2020-09-24 08:33:59', '2020-09-24 08:33:59'),
	(2, 2, 1, NULL, NULL, '2020-09-24 08:59:42', '2020-09-24 08:59:42');
/*!40000 ALTER TABLE `software_tracks` ENABLE KEYS */;

DELETE FROM `staff_departments`;
/*!40000 ALTER TABLE `staff_departments` DISABLE KEYS */;
INSERT INTO `staff_departments` (`id`, `name`, `description`, `parent_id`, `creator`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, '行政部', NULL, NULL, NULL, NULL, '2020-09-24 08:37:11', '2020-09-24 08:37:11'),
	(2, '财务部', NULL, NULL, NULL, NULL, '2020-09-24 08:37:16', '2020-09-24 08:37:16');
/*!40000 ALTER TABLE `staff_departments` ENABLE KEYS */;

DELETE FROM `staff_records`;
/*!40000 ALTER TABLE `staff_records` DISABLE KEYS */;
INSERT INTO `staff_records` (`id`, `name`, `department_id`, `gender`, `title`, `mobile`, `email`, `creator`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, '张三', 1, '男', NULL, NULL, NULL, NULL, NULL, '2020-09-24 08:37:50', '2020-09-24 08:37:50');
/*!40000 ALTER TABLE `staff_records` ENABLE KEYS */;

DELETE FROM `vendor_records`;
/*!40000 ALTER TABLE `vendor_records` DISABLE KEYS */;
INSERT INTO `vendor_records` (`id`, `name`, `description`, `location`, `creator`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, '微软', '计算机软硬件制造商', '美国', NULL, NULL, '2020-09-24 08:19:03', '2020-09-24 08:19:03'),
	(2, 'DELL', '计算机硬件制造商', '美国', NULL, NULL, '2020-09-24 08:19:12', '2020-09-24 08:19:12'),
	(3, 'Adobe', NULL, NULL, NULL, NULL, '2020-09-24 09:17:56', '2020-09-24 09:17:56'),
	(4, '金士顿', NULL, NULL, NULL, NULL, '2020-09-24 09:18:03', '2020-09-24 09:18:03'),
	(5, '西部数据', NULL, NULL, NULL, NULL, '2020-09-24 09:18:13', '2020-09-24 09:18:13');
/*!40000 ALTER TABLE `vendor_records` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
