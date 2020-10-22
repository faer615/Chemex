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

-- 正在导出表  chemex-demo.admin_menu 的数据：~26 rows (大约)
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
	(25, 0, 21, 'Check Management', 'feather icon-check-circle', NULL, '2020-10-04 10:22:42', '2020-10-06 21:39:10'),
	(26, 25, 22, 'Check Records', NULL, 'check/records', '2020-10-04 10:23:17', '2020-10-06 21:39:10'),
	(27, 25, 23, 'Check Tracks', NULL, 'check/tracks', '2020-10-04 10:23:33', '2020-10-06 21:39:10'),
	(28, 0, 19, 'Service Management', 'feather icon-activity', NULL, '2020-10-06 21:38:40', '2020-10-06 21:39:10'),
	(29, 28, 20, 'Service Records', NULL, 'service/records', '2020-10-06 21:39:02', '2020-10-06 21:39:10'),
	(30, 28, 30, 'Service Tracks', NULL, 'service/tracks', '2020-10-06 22:02:15', '2020-10-06 22:02:15'),
	(31, 28, 31, 'Service Issues', NULL, 'service/issues', '2020-10-06 23:23:22', '2020-10-06 23:23:22'),
	(53, 0, 32, 'Maintenance Records', 'feather icon-shield', 'maintenance/records', '2020-10-10 15:06:15', '2020-10-10 15:06:16');
/*!40000 ALTER TABLE `admin_menu` ENABLE KEYS */;

-- 正在导出表  chemex-demo.admin_permissions 的数据：~6 rows (大约)
/*!40000 ALTER TABLE `admin_permissions` DISABLE KEYS */;
INSERT INTO `admin_permissions` (`id`, `name`, `slug`, `http_method`, `http_path`, `order`, `parent_id`, `created_at`, `updated_at`) VALUES
	(1, 'Auth management', 'auth-management', '', '', 1, 0, '2020-09-18 09:45:49', NULL),
	(2, 'Users', 'users', '', '/auth/users*', 2, 1, '2020-09-18 09:45:49', NULL),
	(3, 'Roles', 'roles', '', '/auth/roles*', 3, 1, '2020-09-18 09:45:49', NULL),
	(4, 'Permissions', 'permissions', '', '/auth/permissions*', 4, 1, '2020-09-18 09:45:49', NULL),
	(5, 'Menu', 'menu', '', '/auth/menu*', 5, 1, '2020-09-18 09:45:49', NULL),
	(6, 'Operation log', 'operation-log', '', '/auth/logs*', 6, 1, '2020-09-18 09:45:49', NULL);
/*!40000 ALTER TABLE `admin_permissions` ENABLE KEYS */;

-- 正在导出表  chemex-demo.admin_permission_menu 的数据：~105 rows (大约)
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

-- 正在导出表  chemex-demo.admin_roles 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `admin_roles` DISABLE KEYS */;
INSERT INTO `admin_roles` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
	(1, 'Administrator', 'administrator', '2020-09-18 09:45:49', '2020-09-18 09:45:49');
/*!40000 ALTER TABLE `admin_roles` ENABLE KEYS */;

-- 正在导出表  chemex-demo.admin_role_menu 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `admin_role_menu` DISABLE KEYS */;
/*!40000 ALTER TABLE `admin_role_menu` ENABLE KEYS */;

-- 正在导出表  chemex-demo.admin_role_permissions 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `admin_role_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `admin_role_permissions` ENABLE KEYS */;

-- 正在导出表  chemex-demo.admin_role_users 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `admin_role_users` DISABLE KEYS */;
INSERT INTO `admin_role_users` (`role_id`, `user_id`, `created_at`, `updated_at`) VALUES
	(1, 1, NULL, NULL);
/*!40000 ALTER TABLE `admin_role_users` ENABLE KEYS */;

-- 正在导出表  chemex-demo.admin_users 的数据：~2 rows (大约)
/*!40000 ALTER TABLE `admin_users` DISABLE KEYS */;
INSERT INTO `admin_users` (`id`, `username`, `password`, `name`, `avatar`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'admin', '$2y$10$0FABOJldsayevR1lGRlHSuIEVANwUN0NQ56VPZC6AMMHy3GsTL1nm', 'Administrator', NULL, 'fUaMhbBTyy5Nn2Cmegb2aiA12wXJJdhV1Lj7VT76xQ9gh1rssUQFTef6SZSU', '2020-09-18 09:45:49', '2020-10-12 19:30:10'),
	(2, 'test_user1', '$2y$10$LkfJ2s63BGHYpYGU.D5JFuym6x9oE2z34JhFkqbtvSgZJQGm05Aoe', '测试用户1', NULL, NULL, '2020-10-04 23:40:28', '2020-10-04 23:40:28');
/*!40000 ALTER TABLE `admin_users` ENABLE KEYS */;

-- 正在导出表  chemex-demo.check_records 的数据：~3 rows (大约)
/*!40000 ALTER TABLE `check_records` DISABLE KEYS */;
INSERT INTO `check_records` (`id`, `check_item`, `start_time`, `end_time`, `user_id`, `status`, `creator`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(10, 'device', '2020-10-05 00:03:53', '2020-10-05 00:03:54', 2, 2, 'Administrator', NULL, '2020-10-05 00:03:57', '2020-10-05 00:20:41'),
	(11, 'hardware', '2020-10-05 08:59:35', '2020-10-05 08:59:35', 2, 1, 'Administrator', NULL, '2020-10-05 08:59:37', '2020-10-05 20:09:29'),
	(12, 'device', '2020-10-08 16:01:11', '2020-10-09 16:01:15', 1, 0, 'Administrator', NULL, '2020-10-08 16:01:51', '2020-10-08 16:01:51');
/*!40000 ALTER TABLE `check_records` ENABLE KEYS */;

-- 正在导出表  chemex-demo.check_tracks 的数据：~7 rows (大约)
/*!40000 ALTER TABLE `check_tracks` DISABLE KEYS */;
INSERT INTO `check_tracks` (`id`, `check_id`, `item_id`, `status`, `checker`, `creator`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(4, 10, 4, 1, 1, 'Administrator', '2020-10-05 00:20:41', '2020-10-05 00:03:57', '2020-10-05 00:20:41'),
	(5, 10, 5, 0, 0, 'Administrator', '2020-10-05 00:20:41', '2020-10-05 00:03:57', '2020-10-05 00:20:41'),
	(6, 10, 6, 0, 0, 'Administrator', '2020-10-05 00:20:41', '2020-10-05 00:03:57', '2020-10-05 00:20:41'),
	(7, 11, 4, 1, 1, 'Administrator', NULL, '2020-10-05 08:59:37', '2020-10-20 17:42:51'),
	(8, 12, 4, 2, 1, 'Administrator', NULL, '2020-10-08 16:01:51', '2020-10-09 09:38:13'),
	(9, 12, 5, 1, 1, 'Administrator', NULL, '2020-10-08 16:01:51', '2020-10-08 16:02:29'),
	(10, 12, 6, 2, 1, 'Administrator', NULL, '2020-10-08 16:01:51', '2020-10-21 15:13:54');
/*!40000 ALTER TABLE `check_tracks` ENABLE KEYS */;

-- 正在导出表  chemex-demo.device_categories 的数据：~5 rows (大约)
/*!40000 ALTER TABLE `device_categories` DISABLE KEYS */;
INSERT INTO `device_categories` (`id`, `name`, `description`, `creator`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(3, '台式机', '11111111111111', 'Administrator', NULL, '2020-10-04 23:04:52', '2020-10-09 17:06:01'),
	(4, '笔记本', NULL, 'Administrator', NULL, '2020-10-04 23:04:56', '2020-10-04 23:04:56'),
	(5, '服务器', NULL, 'Administrator', NULL, '2020-10-14 16:06:40', '2020-10-14 16:06:40'),
	(6, '组装机', '1', 'Administrator', NULL, '2020-10-21 11:06:24', '2020-10-21 11:06:24'),
	(7, '打印机', NULL, 'Administrator', NULL, '2020-10-21 15:07:56', '2020-10-21 15:07:56');
/*!40000 ALTER TABLE `device_categories` ENABLE KEYS */;

-- 正在导出表  chemex-demo.device_records 的数据：~6 rows (大约)
/*!40000 ALTER TABLE `device_records` DISABLE KEYS */;
INSERT INTO `device_records` (`id`, `name`, `description`, `category_id`, `vendor_id`, `sn`, `mac`, `ip`, `photo`, `ssh_username`, `ssh_password`, `ssh_port`, `creator`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(4, 'PC-1', NULL, 3, 1, NULL, NULL, '127.0.0.0', 'images/516467cbe48ffc70011e0fd8d0f35026.png', 'root', 'cm9vdA==', '22', 'Administrator', '2020-10-21 16:22:15', '2020-10-04 23:05:06', '2020-10-21 16:22:15'),
	(5, 'PC-2', NULL, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Administrator', '2020-10-21 16:22:12', '2020-10-04 23:05:14', '2020-10-21 16:22:12'),
	(6, 'NB-1', NULL, 4, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Administrator', NULL, '2020-10-04 23:05:20', '2020-10-04 23:05:20'),
	(7, 'test', 'CPU: 内存', 5, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Administrator', NULL, '2020-10-14 16:07:11', '2020-10-14 16:07:11'),
	(8, 'PC-100', '1', 6, 1, '11111111', NULL, '192.168.1.1', NULL, NULL, NULL, NULL, 'Administrator', NULL, '2020-10-21 11:09:18', '2020-10-21 11:09:18'),
	(9, '啊实打实的', '阿斯顿', 3, 1, 'qweqw', NULL, NULL, NULL, NULL, NULL, NULL, 'Administrator', '2020-10-21 16:22:08', '2020-10-21 14:24:37', '2020-10-21 16:22:08');
/*!40000 ALTER TABLE `device_records` ENABLE KEYS */;

-- 正在导出表  chemex-demo.device_tracks 的数据：~6 rows (大约)
/*!40000 ALTER TABLE `device_tracks` DISABLE KEYS */;
INSERT INTO `device_tracks` (`id`, `device_id`, `staff_id`, `creator`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(2, 4, 1, 'Administrator', '2020-10-19 17:53:07', '2020-10-08 15:58:28', '2020-10-19 17:53:07'),
	(3, 4, 2, 'Administrator', '2020-10-20 14:07:30', '2020-10-08 15:58:42', '2020-10-20 14:07:30'),
	(4, 4, 3, 'Administrator', NULL, '2020-10-08 15:59:01', '2020-10-08 15:59:01'),
	(5, 5, 3, 'Administrator', NULL, '2020-10-08 15:59:11', '2020-10-08 15:59:11'),
	(6, 8, 5, 'Administrator', NULL, '2020-10-21 11:12:18', '2020-10-21 11:12:18'),
	(7, 9, 5, 'Administrator', NULL, '2020-10-21 14:24:50', '2020-10-21 14:24:50');
/*!40000 ALTER TABLE `device_tracks` ENABLE KEYS */;

-- 正在导出表  chemex-demo.failed_jobs 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

-- 正在导出表  chemex-demo.hardware_categories 的数据：~5 rows (大约)
/*!40000 ALTER TABLE `hardware_categories` DISABLE KEYS */;
INSERT INTO `hardware_categories` (`id`, `name`, `description`, `creator`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(3, '硬盘', NULL, 'Administrator', NULL, '2020-10-04 10:50:57', '2020-10-04 10:50:57'),
	(4, '固态硬盘', NULL, 'Administrator', NULL, '2020-10-04 10:51:14', '2020-10-04 10:51:14'),
	(5, '内存', NULL, 'Administrator', NULL, '2020-10-04 10:51:26', '2020-10-04 10:51:26'),
	(6, 'USB网卡', NULL, 'Administrator', NULL, '2020-10-04 10:51:38', '2020-10-04 10:51:38'),
	(7, 'PCI-E网卡', NULL, 'Administrator', NULL, '2020-10-04 10:51:46', '2020-10-04 10:51:46');
/*!40000 ALTER TABLE `hardware_categories` ENABLE KEYS */;

-- 正在导出表  chemex-demo.hardware_records 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `hardware_records` DISABLE KEYS */;
INSERT INTO `hardware_records` (`id`, `name`, `description`, `category_id`, `vendor_id`, `specification`, `sn`, `creator`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(4, 'SN720', NULL, 3, 3, '500G', NULL, 'Administrator', NULL, '2020-10-05 08:55:28', '2020-10-05 08:55:28');
/*!40000 ALTER TABLE `hardware_records` ENABLE KEYS */;

-- 正在导出表  chemex-demo.hardware_tracks 的数据：~2 rows (大约)
/*!40000 ALTER TABLE `hardware_tracks` DISABLE KEYS */;
INSERT INTO `hardware_tracks` (`id`, `hardware_id`, `device_id`, `creator`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(4, 4, 4, 'Administrator', NULL, '2020-10-10 13:42:51', '2020-10-10 13:42:51'),
	(5, 4, 5, 'Administrator', NULL, '2020-10-13 16:38:13', '2020-10-13 16:38:13');
/*!40000 ALTER TABLE `hardware_tracks` ENABLE KEYS */;

-- 正在导出表  chemex-demo.maintenance_records 的数据：~3 rows (大约)
/*!40000 ALTER TABLE `maintenance_records` DISABLE KEYS */;
INSERT INTO `maintenance_records` (`id`, `item`, `item_id`, `ng_description`, `ok_description`, `ng_time`, `ok_time`, `status`, `creator`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, 'device', 4, '电源故障了', '修好了', '2020-10-10 15:37:50', '2020-10-10 16:01:55', 1, 'Administrator', NULL, '2020-10-10 15:39:46', '2020-10-10 16:01:56'),
	(2, 'device', 4, '主板爆容', '修好了', '2020-10-10 16:41:42', '2020-10-10 16:42:05', 1, 'Administrator', NULL, '2020-10-10 16:41:50', '2020-10-10 16:42:12'),
	(3, 'device', 8, '显示器被砸坏了', '显示器坏了', '2020-10-21 11:12:43', '2020-10-21 11:14:12', 1, 'Administrator', NULL, '2020-10-21 11:12:44', '2020-10-21 11:14:14');
/*!40000 ALTER TABLE `maintenance_records` ENABLE KEYS */;

-- 正在导出表  chemex-demo.service_issues 的数据：~10 rows (大约)
/*!40000 ALTER TABLE `service_issues` DISABLE KEYS */;
INSERT INTO `service_issues` (`id`, `service_id`, `issue`, `status`, `start`, `end`, `creator`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, 1, '电源故障', 2, '2020-10-06 23:40:46', '2020-10-07 07:07:17', 'Administrator', NULL, '2020-10-06 23:40:48', '2020-10-07 19:07:17'),
	(2, 1, '网线脱落', 2, '2020-10-07 19:58:22', '2020-10-07 08:00:04', 'Administrator', NULL, '2020-10-07 19:58:23', '2020-10-07 20:00:04'),
	(3, 5, 'I/O阻塞', 2, '2020-10-07 20:22:23', '2020-10-20 03:50:32', 'Administrator', NULL, '2020-10-07 20:22:24', '2020-10-20 15:50:32'),
	(4, 4, '数据读取异常缓慢', 2, '2020-10-07 20:23:37', '2020-10-07 08:23:44', 'Administrator', NULL, '2020-10-07 20:23:38', '2020-10-07 20:23:44'),
	(5, 2, '网络丢包', 2, '2020-10-06 20:24:03', '2020-10-20 05:42:44', 'Administrator', NULL, '2020-10-07 20:24:05', '2020-10-20 17:42:44'),
	(6, 6, '存储区域配额已满', 2, '2020-10-07 20:24:55', '2020-10-07 08:25:15', 'Administrator', NULL, '2020-10-07 20:24:56', '2020-10-07 20:25:15'),
	(7, 7, '部分用户无法连接打印机', 2, '2020-10-07 20:25:30', '2020-10-07 08:25:39', 'Administrator', NULL, '2020-10-07 20:25:31', '2020-10-07 20:25:39'),
	(8, 7, '打印延迟较大', 2, '2020-10-07 20:25:50', '2020-10-15 02:00:07', 'Administrator', NULL, '2020-10-07 20:25:50', '2020-10-15 14:00:07'),
	(9, 7, '打印服务器丢包严重', 2, '2020-10-07 20:26:05', '2020-10-21 12:58:06', 'Administrator', NULL, '2020-10-07 20:26:05', '2020-10-21 12:58:06'),
	(10, 1, 'I/O阻塞', 2, '2020-10-08 18:52:24', '2020-10-21 12:58:10', 'Administrator', NULL, '2020-10-08 18:52:30', '2020-10-21 12:58:10');
/*!40000 ALTER TABLE `service_issues` ENABLE KEYS */;

-- 正在导出表  chemex-demo.service_records 的数据：~7 rows (大约)
/*!40000 ALTER TABLE `service_records` DISABLE KEYS */;
INSERT INTO `service_records` (`id`, `name`, `description`, `status`, `creator`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, 'AD服务', NULL, 0, 'Administrator', NULL, '2020-10-06 21:50:55', '2020-10-21 12:57:30'),
	(2, 'MES 服务', NULL, 0, 'Administrator', NULL, '2020-10-07 19:26:44', '2020-10-20 14:09:31'),
	(3, 'ERP 服务', NULL, 0, 'Administrator', NULL, '2020-10-07 19:26:48', '2020-10-20 17:21:12'),
	(4, 'ERP DB 服务', NULL, 0, 'Administrator', NULL, '2020-10-07 19:26:54', '2020-10-21 12:58:36'),
	(5, 'Redis 缓存服务', NULL, 0, 'Administrator', NULL, '2020-10-07 20:22:10', '2020-10-21 12:58:37'),
	(6, 'FileServer 文件共享服务', NULL, 0, 'Administrator', NULL, '2020-10-07 20:24:40', '2020-10-20 14:09:29'),
	(7, '打印服务', NULL, 1, 'Administrator', NULL, '2020-10-07 20:25:10', '2020-10-21 13:34:49');
/*!40000 ALTER TABLE `service_records` ENABLE KEYS */;

-- 正在导出表  chemex-demo.service_tracks 的数据：~7 rows (大约)
/*!40000 ALTER TABLE `service_tracks` DISABLE KEYS */;
INSERT INTO `service_tracks` (`id`, `service_id`, `device_id`, `creator`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, 1, 4, 'Administrator', '2020-10-19 17:50:56', '2020-10-06 22:59:53', '2020-10-19 17:50:56'),
	(2, 1, 5, 'Administrator', NULL, '2020-10-07 20:24:10', '2020-10-07 20:24:10'),
	(3, 2, 4, 'Administrator', NULL, '2020-10-07 20:24:13', '2020-10-07 20:24:13'),
	(4, 3, 5, 'Administrator', NULL, '2020-10-07 20:24:17', '2020-10-07 20:24:17'),
	(5, 4, 6, 'Administrator', NULL, '2020-10-07 20:24:20', '2020-10-07 20:24:20'),
	(6, 5, 4, 'Administrator', NULL, '2020-10-07 20:24:23', '2020-10-07 20:24:23'),
	(7, 1, 4, 'Administrator', NULL, '2020-10-19 17:51:14', '2020-10-19 17:51:14');
/*!40000 ALTER TABLE `service_tracks` ENABLE KEYS */;

-- 正在导出表  chemex-demo.software_categories 的数据：~4 rows (大约)
/*!40000 ALTER TABLE `software_categories` DISABLE KEYS */;
INSERT INTO `software_categories` (`id`, `name`, `description`, `creator`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(3, '操作系统', NULL, 'Administrator', NULL, '2020-10-04 10:52:05', '2020-10-04 10:52:05'),
	(4, '办公应用', NULL, 'Administrator', NULL, '2020-10-04 10:52:11', '2020-10-04 10:52:11'),
	(5, '媒体工具', NULL, 'Administrator', NULL, '2020-10-04 10:52:17', '2020-10-04 10:52:17'),
	(6, '绘制工具', NULL, 'Administrator', NULL, '2020-10-04 10:52:24', '2020-10-04 10:52:24');
/*!40000 ALTER TABLE `software_categories` ENABLE KEYS */;

-- 正在导出表  chemex-demo.software_records 的数据：~3 rows (大约)
/*!40000 ALTER TABLE `software_records` DISABLE KEYS */;
INSERT INTO `software_records` (`id`, `name`, `description`, `category_id`, `version`, `vendor_id`, `price`, `purchased`, `expired`, `distribution`, `sn`, `counts`, `creator`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(3, '签证申请', '我感觉有时候，其实我们不大理解文档的意思，如补充文档。', 3, '1', 1, 11, '2020-10-29', '2020-11-07', 'u', NULL, 1, 'Administrator', '2020-10-20 00:19:39', '2020-10-09 09:53:14', '2020-10-09 11:15:52'),
	(4, '11', NULL, 3, '1.0', 4, 0, '2020-10-09', '2020-10-09', 'o', NULL, 3, 'Administrator', NULL, '2020-10-09 17:07:50', '2020-10-09 17:07:50'),
	(5, 'fg', 'dfg', 3, 'dfg', 1, 0, '2020-10-19', '2020-10-19', 'u', 'dfg', 1, 'Administrator', NULL, '2020-10-19 17:54:01', '2020-10-19 17:54:01');
/*!40000 ALTER TABLE `software_records` ENABLE KEYS */;

-- 正在导出表  chemex-demo.software_tracks 的数据：~24 rows (大约)
/*!40000 ALTER TABLE `software_tracks` DISABLE KEYS */;
INSERT INTO `software_tracks` (`id`, `software_id`, `device_id`, `creator`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(3, 3, 4, 'Administrator', '2020-10-09 11:15:52', '2020-10-09 09:53:27', '2020-10-09 11:15:52'),
	(4, 4, 5, 'Administrator', '2020-10-10 09:25:25', '2020-10-10 09:09:33', '2020-10-10 09:25:25'),
	(5, 4, 4, 'Administrator', '2020-10-10 09:25:39', '2020-10-10 09:12:58', '2020-10-10 09:25:39'),
	(6, 4, 4, 'Administrator', '2020-10-10 10:03:17', '2020-10-10 09:27:45', '2020-10-10 10:03:17'),
	(7, 4, 5, 'Administrator', '2020-10-10 09:57:01', '2020-10-10 09:27:50', '2020-10-10 09:57:01'),
	(8, 4, 4, 'Administrator', '2020-10-10 10:36:21', '2020-10-10 10:05:02', '2020-10-10 10:36:21'),
	(9, 4, 5, 'Administrator', '2020-10-10 10:07:39', '2020-10-10 10:05:07', '2020-10-10 10:07:39'),
	(10, 4, 4, 'Administrator', '2020-10-10 10:57:07', '2020-10-10 10:52:57', '2020-10-10 10:57:07'),
	(11, 4, 5, 'Administrator', '2020-10-10 10:53:11', '2020-10-10 10:53:02', '2020-10-10 10:53:11'),
	(12, 4, 4, 'Administrator', '2020-10-10 11:11:41', '2020-10-10 11:09:17', '2020-10-10 11:11:41'),
	(13, 4, 5, 'Administrator', '2020-10-10 11:10:44', '2020-10-10 11:09:22', '2020-10-10 11:10:44'),
	(14, 4, 6, 'Administrator', '2020-10-10 11:09:32', '2020-10-10 11:09:27', '2020-10-10 11:09:32'),
	(15, 4, 4, 'Administrator', '2020-10-10 11:21:19', '2020-10-10 11:15:26', '2020-10-10 11:21:19'),
	(16, 4, 5, 'Administrator', '2020-10-10 11:16:02', '2020-10-10 11:15:34', '2020-10-10 11:16:02'),
	(17, 4, 6, 'Administrator', '2020-10-10 11:15:49', '2020-10-10 11:15:39', '2020-10-10 11:15:49'),
	(18, 4, 4, 'Administrator', '2020-10-10 11:39:54', '2020-10-10 11:35:18', '2020-10-10 11:39:54'),
	(19, 4, 5, 'Administrator', '2020-10-10 11:37:37', '2020-10-10 11:35:24', '2020-10-10 11:37:37'),
	(20, 4, 6, 'Administrator', '2020-10-10 11:35:41', '2020-10-10 11:35:28', '2020-10-10 11:35:41'),
	(21, 4, 5, 'Administrator', '2020-10-10 11:39:50', '2020-10-10 11:38:59', '2020-10-10 11:39:50'),
	(22, 4, 6, 'Administrator', '2020-10-10 11:39:13', '2020-10-10 11:39:07', '2020-10-10 11:39:13'),
	(23, 4, 4, 'Administrator', '2020-10-10 11:40:26', '2020-10-10 11:40:10', '2020-10-10 11:40:26'),
	(24, 4, 5, 'Administrator', '2020-10-10 11:40:29', '2020-10-10 11:40:15', '2020-10-10 11:40:29'),
	(25, 4, 6, 'Administrator', '2020-10-10 11:40:32', '2020-10-10 11:40:20', '2020-10-10 11:40:32'),
	(26, 4, 5, 'Administrator', NULL, '2020-10-10 13:42:35', '2020-10-10 13:42:35');
/*!40000 ALTER TABLE `software_tracks` ENABLE KEYS */;

-- 正在导出表  chemex-demo.staff_departments 的数据：~5 rows (大约)
/*!40000 ALTER TABLE `staff_departments` DISABLE KEYS */;
INSERT INTO `staff_departments` (`id`, `name`, `description`, `parent_id`, `creator`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(3, '行政部', NULL, NULL, 'Administrator', NULL, '2020-10-04 10:49:36', '2020-10-04 10:49:36'),
	(4, '销售部', NULL, NULL, 'Administrator', NULL, '2020-10-04 10:49:43', '2020-10-04 10:49:43'),
	(5, '信息部', NULL, NULL, 'Administrator', NULL, '2020-10-04 10:49:47', '2020-10-04 10:49:47'),
	(6, '销售一课', NULL, 4, 'Administrator', NULL, '2020-10-04 10:49:57', '2020-10-04 10:49:57'),
	(7, '销售二课', NULL, 4, 'Administrator', NULL, '2020-10-04 10:50:04', '2020-10-04 10:50:04');
/*!40000 ALTER TABLE `staff_departments` ENABLE KEYS */;

-- 正在导出表  chemex-demo.staff_records 的数据：~5 rows (大约)
/*!40000 ALTER TABLE `staff_records` DISABLE KEYS */;
INSERT INTO `staff_records` (`id`, `name`, `department_id`, `gender`, `title`, `mobile`, `email`, `creator`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, '张三', 3, '男', NULL, NULL, NULL, 'Administrator', NULL, '2020-10-04 10:50:17', '2020-10-09 11:03:09'),
	(2, '李四', 5, '男', NULL, NULL, NULL, 'Administrator', NULL, '2020-10-04 10:50:26', '2020-10-04 10:50:26'),
	(3, '小红', 6, '女', NULL, NULL, NULL, 'Administrator', NULL, '2020-10-04 10:50:34', '2020-10-04 10:50:34'),
	(4, '小绿', 7, '男', NULL, NULL, NULL, 'Administrator', NULL, '2020-10-04 10:50:43', '2020-10-08 14:47:30'),
	(5, '王五', 3, '男', '专业拉线搬砖', NULL, NULL, 'Administrator', NULL, '2020-10-21 11:10:04', '2020-10-21 11:10:04');
/*!40000 ALTER TABLE `staff_records` ENABLE KEYS */;

-- 正在导出表  chemex-demo.vendor_records 的数据：~6 rows (大约)
/*!40000 ALTER TABLE `vendor_records` DISABLE KEYS */;
INSERT INTO `vendor_records` (`id`, `name`, `description`, `location`, `creator`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, '微软', NULL, NULL, 'Administrator', NULL, '2020-10-04 10:48:52', '2020-10-04 10:48:52'),
	(2, '苹果', NULL, NULL, 'Administrator', NULL, '2020-10-04 10:48:57', '2020-10-04 10:48:57'),
	(3, 'DELL', NULL, NULL, 'Administrator', NULL, '2020-10-04 10:49:02', '2020-10-04 10:49:02'),
	(4, '金士顿', NULL, NULL, 'Administrator', NULL, '2020-10-04 10:49:07', '2020-10-04 10:49:07'),
	(5, '华硕', NULL, NULL, 'Administrator', NULL, '2020-10-04 10:49:11', '2020-10-04 10:49:11'),
	(6, '微星', NULL, NULL, 'Administrator', NULL, '2020-10-04 10:49:15', '2020-10-04 10:49:15');
/*!40000 ALTER TABLE `vendor_records` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
