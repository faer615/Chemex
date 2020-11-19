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

-- 正在导出表  chemex-dev.admin_extensions 的数据：~2 rows (大约)
/*!40000 ALTER TABLE `admin_extensions` DISABLE KEYS */;
INSERT INTO `admin_extensions` (`id`, `name`, `version`, `is_enabled`, `options`, `created_at`, `updated_at`) VALUES
	(6, 'celaraze.colorful-bar', '1.0.0', 0, NULL, NULL, '2020-11-09 15:51:07'),
	(7, 'celaraze.dcatadmin-menu-switch', '1.0.0', 1, NULL, '2020-11-09 15:55:26', '2020-11-09 15:55:30');
/*!40000 ALTER TABLE `admin_extensions` ENABLE KEYS */;

-- 正在导出表  chemex-dev.admin_extension_histories 的数据：~1 rows (大约)
/*!40000 ALTER TABLE `admin_extension_histories` DISABLE KEYS */;
INSERT INTO `admin_extension_histories` (`id`, `name`, `type`, `version`, `detail`, `created_at`, `updated_at`) VALUES
	(7, 'celaraze.dcatadmin-menu-switch', 1, '1.0.0', 'Initialize extension.', '2020-11-09 15:55:26', '2020-11-09 15:55:26');
/*!40000 ALTER TABLE `admin_extension_histories` ENABLE KEYS */;

-- 正在导出表  chemex-dev.admin_menu 的数据：~32 rows (大约)
/*!40000 ALTER TABLE `admin_menu` DISABLE KEYS */;
INSERT INTO `admin_menu` (`id`, `parent_id`, `order`, `title`, `icon`, `uri`, `extension`, `show`, `created_at`, `updated_at`) VALUES
	(1, 0, 1, 'Index', 'feather icon-bar-chart-2', '/', '', 1, '2020-10-10 15:06:20', '2020-11-09 16:22:51'),
	(8, 0, 6, 'Software Management', 'feather icon-disc', '', '', 1, '2020-10-10 15:06:21', '2020-10-04 10:44:31'),
	(9, 8, 8, 'Software Categories', '', 'software/categories', '', 1, '2020-10-10 15:06:22', '2020-10-04 10:44:31'),
	(11, 0, 25, 'Vendor Records', 'feather icon-zap', 'vendor/records', '', 1, '2020-10-10 15:06:23', '2020-11-18 21:14:55'),
	(12, 8, 7, 'Software Records', '', 'software/records', '', 1, '2020-10-10 15:06:23', '2020-10-04 10:44:31'),
	(13, 0, 10, 'Hardware Management', 'feather icon-server', '', '', 1, '2020-10-10 15:06:24', '2020-10-04 10:44:31'),
	(14, 13, 12, 'Hardware Categories', '', 'hardware/categories', '', 1, '2020-10-10 15:06:24', '2020-10-04 10:44:31'),
	(15, 13, 11, 'Hardware Records', '', 'hardware/records', '', 1, '2020-10-10 15:06:24', '2020-10-04 10:44:31'),
	(16, 0, 2, 'Device Management', 'feather icon-monitor', '', '', 1, '2020-10-10 15:06:25', '2020-10-10 15:06:18'),
	(17, 16, 4, 'Device Categories', '', 'device/categories', '', 1, '2020-10-10 15:06:27', '2020-10-10 15:06:18'),
	(18, 0, 14, 'Staff Management', 'feather icon-user-check', '', '', 1, '2020-10-10 15:06:25', '2020-11-18 21:14:54'),
	(19, 18, 16, 'Staff Departments', '', 'staff/departments', '', 1, '2020-10-10 15:06:27', '2020-11-18 21:14:54'),
	(20, 18, 15, 'Staff Records', '', 'staff/records', '', 1, '2020-10-10 15:06:26', '2020-11-18 21:14:54'),
	(21, 16, 3, 'Device Records', '', 'device/records', '', 1, '2020-10-10 15:06:28', '2020-10-10 15:06:19'),
	(22, 8, 9, 'Software Tracks', '', 'software/tracks', '', 1, '2020-10-10 15:06:28', '2020-10-04 10:44:31'),
	(23, 13, 13, 'Hardware Tracks', '', 'hardware/tracks', '', 1, '2020-10-10 15:06:29', '2020-10-04 10:44:31'),
	(24, 16, 5, 'Device Tracks', '', 'device/tracks', '', 1, '2020-10-10 15:06:29', '2020-10-04 10:44:31'),
	(25, 0, 21, 'Check Management', 'feather icon-check-circle', NULL, '', 1, '2020-10-04 10:22:42', '2020-11-18 21:14:54'),
	(26, 25, 22, 'Check Records', NULL, 'check/records', '', 1, '2020-10-04 10:23:17', '2020-11-18 21:14:55'),
	(27, 25, 23, 'Check Tracks', NULL, 'check/tracks', '', 1, '2020-10-04 10:23:33', '2020-11-18 21:14:55'),
	(28, 0, 17, 'Service Management', 'feather icon-activity', NULL, '', 1, '2020-10-06 21:38:40', '2020-11-18 21:14:54'),
	(29, 28, 18, 'Service Records', NULL, 'service/records', '', 1, '2020-10-06 21:39:02', '2020-11-18 21:14:54'),
	(30, 28, 19, 'Service Tracks', NULL, 'service/tracks', '', 1, '2020-10-06 22:02:15', '2020-11-18 21:14:54'),
	(31, 28, 20, 'Service Issues', NULL, 'service/issues', '', 1, '2020-10-06 23:23:22', '2020-11-18 21:14:54'),
	(53, 0, 24, 'Maintenance Records', 'feather icon-shield', 'maintenance/records', '', 1, '2020-10-10 15:06:15', '2020-11-18 21:14:55'),
	(54, 0, 27, 'Version', 'feather icon-chevrons-down', 'version', '', 1, '2020-10-22 15:05:00', '2020-11-18 21:14:55'),
	(55, 56, 32, 'Menu', NULL, 'auth/menu', '', 1, '2020-11-03 14:22:49', '2020-11-18 21:14:55'),
	(56, 0, 28, 'Settings', NULL, NULL, '', 1, '2020-11-03 14:23:14', '2020-11-18 21:14:55'),
	(57, 56, 29, 'Users', NULL, 'auth/users', '', 1, '2020-11-03 14:25:13', '2020-11-18 21:14:55'),
	(58, 56, 30, 'Roles', NULL, 'auth/roles', '', 1, '2020-11-03 14:25:25', '2020-11-18 21:14:55'),
	(59, 56, 31, 'Permissions', NULL, 'auth/permissions', '', 1, '2020-11-03 14:26:37', '2020-11-18 21:14:55'),
	(60, 0, 26, 'Purchased Channels', 'feather icon-shopping-cart', 'purchased/channels', '', 1, '2020-11-18 21:08:58', '2020-11-18 21:14:55');
/*!40000 ALTER TABLE `admin_menu` ENABLE KEYS */;

-- 正在导出表  chemex-dev.admin_permissions 的数据：~12 rows (大约)
/*!40000 ALTER TABLE `admin_permissions` DISABLE KEYS */;
INSERT INTO `admin_permissions` (`id`, `name`, `slug`, `http_method`, `http_path`, `order`, `parent_id`, `created_at`, `updated_at`) VALUES
	(1, '认证管理', 'auth-management', '', '', 1, 0, '2020-09-18 09:45:49', '2020-11-18 17:45:54'),
	(2, '管理员管理', 'users', '', '/auth/users*', 2, 1, '2020-09-18 09:45:49', '2020-11-18 17:46:18'),
	(3, '角色管理', 'roles', '', '/auth/roles*', 3, 1, '2020-09-18 09:45:49', '2020-11-18 17:46:10'),
	(4, '权限管理', 'permissions', '', '/auth/permissions*', 4, 1, '2020-09-18 09:45:49', '2020-11-18 17:46:26'),
	(5, '菜单管理', 'menu', '', '/auth/menu*', 5, 1, '2020-09-18 09:45:49', '2020-11-18 17:46:33'),
	(7, '动作', 'device.actions', '', '', 9, 14, '2020-11-19 08:57:47', '2020-11-19 13:32:55'),
	(8, '设备删除', 'device.delete', '', '', 10, 7, '2020-11-19 08:58:10', '2020-11-19 13:24:56'),
	(9, '设备归属', 'device.track', '', '', 11, 7, '2020-11-19 08:58:23', '2020-11-19 13:24:56'),
	(10, '设备归属解除', 'device.track.disable', '', '', 12, 7, '2020-11-19 08:59:02', '2020-11-19 13:24:56'),
	(11, '设备关联信息清单', 'device.related', '', '', 13, 7, '2020-11-19 08:59:54', '2020-11-19 13:24:56'),
	(12, '设备变动履历', 'device.history', '', '', 14, 7, '2020-11-19 09:00:27', '2020-11-19 13:24:56'),
	(13, '设备维护', 'device.maintenance', '', '', 15, 7, '2020-11-19 09:23:03', '2020-11-19 13:24:56'),
	(14, '设备管理', 'device', '', '', 6, 0, '2020-11-19 09:55:45', '2020-11-19 13:11:45'),
	(15, '软件管理', 'software', '', '', 16, 0, '2020-11-19 09:59:31', '2020-11-19 13:24:56'),
	(16, '硬件管理', 'hardware', '', '', 25, 0, '2020-11-19 09:59:57', '2020-11-19 13:35:38'),
	(17, '雇员管理', 'staff', '', '', 34, 0, '2020-11-19 10:00:31', '2020-11-19 13:38:31'),
	(18, '服务程序管理', 'service', '', '', 39, 0, '2020-11-19 10:00:55', '2020-11-19 13:41:34'),
	(19, '盘点管理', 'check', '', '', 48, 0, '2020-11-19 10:01:27', '2020-11-19 13:45:12'),
	(20, '维修记录', 'maintenance', '', '', 56, 0, '2020-11-19 10:01:59', '2020-11-19 14:00:55'),
	(21, '制造商', 'vendor', '', '', 61, 0, '2020-11-19 10:03:42', '2020-11-19 14:02:15'),
	(22, '购入途径', 'purchased', '', '', 64, 0, '2020-11-19 10:04:11', '2020-11-19 14:03:31'),
	(23, '版本信息', 'version', '', '', 65, 0, '2020-11-19 10:04:37', '2020-11-19 14:03:31'),
	(24, '动作', 'software.actions', '', '', 19, 15, '2020-11-19 10:06:25', '2020-11-19 13:35:49'),
	(25, '软件删除', 'software.delete', '', '', 20, 24, '2020-11-19 10:09:16', '2020-11-19 13:35:38'),
	(26, '软件归属', 'software.track', '', '', 21, 24, '2020-11-19 10:09:40', '2020-11-19 13:35:38'),
	(27, '软件归属解除', 'software.track.disable', '', '', 22, 24, '2020-11-19 10:10:02', '2020-11-19 13:35:38'),
	(28, '软件变动履历', 'software.history', '', '', 23, 24, '2020-11-19 10:10:28', '2020-11-19 13:35:38'),
	(29, '软件管理归属', 'software.track.list', '', '', 24, 24, '2020-11-19 10:11:19', '2020-11-19 13:35:38'),
	(30, '动作', 'hardware.actions', '', '', 28, 16, '2020-11-19 10:14:24', '2020-11-19 13:38:37'),
	(31, '硬件删除', 'hardware.delete', '', '', 29, 30, '2020-11-19 10:15:02', '2020-11-19 13:38:31'),
	(32, '硬件归属', 'hardware.track', '', '', 30, 30, '2020-11-19 10:15:12', '2020-11-19 13:38:31'),
	(33, '硬件变动履历', 'hardware.history', '', '', 32, 30, '2020-11-19 10:15:27', '2020-11-19 13:38:31'),
	(34, '硬件维护', 'hardware.maintenance', '', '', 33, 30, '2020-11-19 10:15:44', '2020-11-19 13:38:31'),
	(35, '硬件归属解除', 'hardware.track.disable', '', '', 31, 30, '2020-11-19 10:16:04', '2020-11-19 13:38:31'),
	(36, '动作', 'staff.actions', '', '', 37, 17, '2020-11-19 10:18:46', '2020-11-19 13:41:41'),
	(37, '雇员删除', 'staff.delete', '', '', 38, 36, '2020-11-19 10:18:57', '2020-11-19 13:41:34'),
	(38, '动作', 'service.actions', '', '', 42, 18, '2020-11-19 10:19:54', '2020-11-19 13:45:19'),
	(39, '服务程序删除', 'service.delete', '', '', 43, 38, '2020-11-19 10:20:16', '2020-11-19 13:45:12'),
	(40, '服务程序归属', 'service.track', '', '', 44, 38, '2020-11-19 10:20:26', '2020-11-19 13:45:12'),
	(41, '服务程序报告异常', 'service.issue', '', '', 45, 38, '2020-11-19 10:21:32', '2020-11-19 13:45:12'),
	(42, '服务程序归属解除', 'service.track.disable', '', '', 46, 38, '2020-11-19 10:21:56', '2020-11-19 13:45:12'),
	(43, '服务程序异常修复', 'service.issue.fix', '', '', 47, 38, '2020-11-19 10:22:25', '2020-11-19 13:45:12'),
	(44, '动作', 'check.actions', '', '', 51, 19, '2020-11-19 10:29:48', '2020-11-19 14:01:03'),
	(45, '盘盈', 'check.track.yes', '', '', 52, 44, '2020-11-19 10:30:28', '2020-11-19 14:00:55'),
	(46, '盘亏', 'check.track.no', '', '', 53, 44, '2020-11-19 10:30:39', '2020-11-19 14:00:55'),
	(47, '动作', 'maintenance.actions', '', '', 59, 20, '2020-11-19 10:31:18', '2020-11-19 14:02:22'),
	(48, '维修记录修复', 'maintenance.fix', '', '', 60, 47, '2020-11-19 10:31:43', '2020-11-19 14:02:15'),
	(49, '盘点完成', 'check.finish', '', '', 54, 44, '2020-11-19 10:35:29', '2020-11-19 14:00:55'),
	(50, '盘点取消', 'check.cancel', '', '', 55, 44, '2020-11-19 10:35:38', '2020-11-19 14:00:55'),
	(51, '表单基础：只读', 'device.read-only', 'GET', 'device/tracks*,device/records*,device/categories*', 7, 14, '2020-11-19 13:18:12', '2020-11-19 13:32:26'),
	(52, '表单基础：全部', 'device.all', '', 'device/tracks*,device/tracks/create*,device/records*,device/records/create*,device/categories*,device/categories/create*', 8, 14, '2020-11-19 13:21:28', '2020-11-19 13:32:31'),
	(53, '表单基础：只读', 'software.read-only', 'GET', 'software/tracks*,software/records*,software/categories*', 17, 15, '2020-11-19 13:22:53', '2020-11-19 13:33:29'),
	(54, '表单基础：全部', 'software.all', '', 'software/tracks*,software/tracks/create*,software/records*,software/records/create*,software/categories*,software/categories/create*', 18, 15, '2020-11-19 13:23:56', '2020-11-19 13:34:34'),
	(55, '表单基础：只读', 'hardware.read-only', 'GET', 'hardware/tracks*,hardware/records*,hardware/categories*', 26, 16, '2020-11-19 13:37:36', '2020-11-19 13:37:43'),
	(56, '表单基础：全部', 'hardware.all', '', 'hardware/tracks*,hardware/tracks/create*,hardware/records*,hardware/records/create*,hardware/categories*,hardware/categories/create*', 27, 16, '2020-11-19 13:38:18', '2020-11-19 13:38:31'),
	(57, '表单基础：只读', 'staff.read-only', 'GET', 'staff/records*,staff/departments*', 35, 17, '2020-11-19 13:40:44', '2020-11-19 13:41:34'),
	(58, '表单基础：全部', 'staff.all', '', 'staff/records*,staff/records/create*,staff/departments*,staff/departments/create*', 36, 17, '2020-11-19 13:41:10', '2020-11-19 13:41:34'),
	(59, '表单基础：只读', 'service.read-only', 'GET', 'service/records*,service/tracks*,service/issues*', 40, 18, '2020-11-19 13:44:25', '2020-11-19 13:45:12'),
	(60, '表单基础：全部', 'service.all', '', 'service/records*,service/records/create*,service/tracks*,service/tracks/create*,service/issues*,service/issues/create*', 41, 18, '2020-11-19 13:45:00', '2020-11-19 13:45:12'),
	(61, '表单基础：只读', 'check.read-only', 'GET', 'check/records*,check/tracks*', 49, 19, '2020-11-19 14:00:10', '2020-11-19 14:00:55'),
	(62, '表单基础：全部', 'check.all', '', 'check/records*,check/records/create*,check/tracks*,check/tracks/create*', 50, 19, '2020-11-19 14:00:45', '2020-11-19 14:00:55'),
	(63, '表单基础：只读', 'maintenance.read-only', 'GET', 'maintenance/records*', 57, 20, '2020-11-19 14:01:46', '2020-11-19 14:02:15'),
	(64, '表单基础：全部', 'maintenance.all', '', 'maintenance/records*,maintenance/records/create*', 58, 20, '2020-11-19 14:02:10', '2020-11-19 14:02:15'),
	(65, '表单基础：只读', 'vendor.read-only', 'GET', 'vendor/records*', 62, 21, '2020-11-19 14:03:07', '2020-11-19 14:03:31'),
	(66, '表单基础：全部', 'vendor.all', '', 'vendor/records*,vendor/records/create*', 63, 21, '2020-11-19 14:03:24', '2020-11-19 14:03:31'),
	(67, '表单基础：只读', 'puchased.read-only', 'GET', 'purchased/channels*', 66, 22, '2020-11-19 14:04:08', '2020-11-19 14:04:08'),
	(68, '表单基础：全部', 'purchased.all', '', 'purchased/channels*,purchased/channels/create*', 67, 22, '2020-11-19 14:04:39', '2020-11-19 14:04:39'),
	(69, '表单基础：只读', 'version.read-only', 'GET', 'version', 68, 23, '2020-11-19 14:05:14', '2020-11-19 14:05:14'),
	(70, '动作', 'version.actions', '', '', 69, 23, '2020-11-19 14:05:40', '2020-11-19 14:05:40'),
	(71, '升级', 'version.unzip', '', 'version/unzip*', 70, 23, '2020-11-19 14:06:08', '2020-11-19 14:06:08'),
	(72, '更新数据库结构', 'version.migrate', '', 'version/migrate', 71, 23, '2020-11-19 14:06:39', '2020-11-19 14:06:39');
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

-- 正在导出表  chemex-dev.admin_roles 的数据：~2 rows (大约)
/*!40000 ALTER TABLE `admin_roles` DISABLE KEYS */;
INSERT INTO `admin_roles` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
	(1, '超级管理员', 'administrator', '2020-09-18 09:45:49', '2020-11-18 17:45:16'),
	(2, '观察者', 'observer', '2020-11-19 09:25:18', '2020-11-19 14:09:37');
/*!40000 ALTER TABLE `admin_roles` ENABLE KEYS */;

-- 正在导出表  chemex-dev.admin_role_menu 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `admin_role_menu` DISABLE KEYS */;
/*!40000 ALTER TABLE `admin_role_menu` ENABLE KEYS */;

-- 正在导出表  chemex-dev.admin_role_permissions 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `admin_role_permissions` DISABLE KEYS */;
INSERT INTO `admin_role_permissions` (`role_id`, `permission_id`, `created_at`, `updated_at`) VALUES
	(2, 51, NULL, NULL),
	(2, 53, NULL, NULL),
	(2, 55, NULL, NULL),
	(2, 57, NULL, NULL),
	(2, 59, NULL, NULL),
	(2, 61, NULL, NULL),
	(2, 63, NULL, NULL),
	(2, 65, NULL, NULL),
	(2, 67, NULL, NULL),
	(2, 69, NULL, NULL);
/*!40000 ALTER TABLE `admin_role_permissions` ENABLE KEYS */;

-- 正在导出表  chemex-dev.admin_role_users 的数据：~1 rows (大约)
/*!40000 ALTER TABLE `admin_role_users` DISABLE KEYS */;
INSERT INTO `admin_role_users` (`role_id`, `user_id`, `created_at`, `updated_at`) VALUES
	(1, 1, NULL, NULL);
/*!40000 ALTER TABLE `admin_role_users` ENABLE KEYS */;

-- 正在导出表  chemex-dev.admin_settings 的数据：~1 rows (大约)
/*!40000 ALTER TABLE `admin_settings` DISABLE KEYS */;
INSERT INTO `admin_settings` (`slug`, `value`, `created_at`, `updated_at`) VALUES
	('celaraze:dcatadmin-menu-switch', '[0,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,0,1,1,0,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1]', '2020-11-09 16:22:52', '2020-11-09 16:23:06'),
	('dcat-admin:operation-log', '{"except":[],"allowed_methods":[],"secret_fields":[]}', '2020-11-04 15:19:51', '2020-11-04 15:19:51');
/*!40000 ALTER TABLE `admin_settings` ENABLE KEYS */;

-- 正在导出表  chemex-dev.admin_users 的数据：~1 rows (大约)
/*!40000 ALTER TABLE `admin_users` DISABLE KEYS */;
INSERT INTO `admin_users` (`id`, `username`, `password`, `name`, `avatar`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'admin', '$2y$10$o8FynnBipv2n6h2tFPjl9.i43zTz4BwNE8gpecvoQBB1JftH4sorS', 'Administrator', NULL, '9FYVEHFWRSn4i5CC4QVw6DnHfc0xyPqwBJXwDEsamQqI6o7N76hezUMEVP6z', '2020-09-18 09:45:49', '2020-11-18 17:45:36');
/*!40000 ALTER TABLE `admin_users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
