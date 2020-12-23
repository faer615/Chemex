<?php

/**
 * Dcat-admin - admin builder based on Laravel.
 * @author jqh <https://github.com/jqhph>
 *
 * Bootstraper for Admin.
 *
 * Here you can remove builtin form field:
 *
 * extend custom field:
 * Dcat\Admin\Form::extend('php', PHPEditor::class);
 * Dcat\Admin\Grid\Column::extend('php', PHPEditor::class);
 * Dcat\Admin\Grid\Filter::extend('php', PHPEditor::class);
 *
 * Or require js and css assets:
 * Admin::css('/packages/prettydocs/css/styles.css');
 * Admin::js('/packages/prettydocs/js/main.js');
 *
 */

use App\Models\AdminUser;
use Dcat\Admin\Layout\Navbar;

/**
 * 处理站点LOGO自定义
 */
if (empty(admin_setting('site_logo'))) {
    $logo = admin_setting('site_logo_text');
} else {
    $logo = config('app.url') . '/uploads/' . admin_setting('site_logo');
    $logo = "<img src='$logo'>";
}

/**
 * 处理站点LOGO-MINI自定义
 */
if (empty(admin_setting('site_logo_mini'))) {
    $logo_mini = admin_setting('site_logo_text');
} else {
    $logo_mini = config('app.url') . '/uploads/' . admin_setting('site_logo_mini');
    $logo_mini = "<img src='$logo_mini'>";
}

if (empty(admin_setting('site_url'))) {
    $site_url = 'http://localhost';
} else {
    $site_url = admin_setting('site_url');
}

/**
 * 复写admin站点配置
 */
config([
    'app.url' => $site_url,

    'admin.title' => admin_setting('site_title'),
    'admin.logo' => $logo,
    'admin.logo-mini' => $logo_mini,

    'filesystems.disks.admin.url' => $site_url . '/uploads'
]);

/**
 * 自定义全局CSS
 */
Admin::style(
    <<<CSS
.main-footer {
    display: none;
}

.navbar{
    margin: 0 35px 0 35px;
    height: 70px;
}

.nav-link{
    padding: 0;
}

.empty-data {
    text-align: center;
    color: rgba(0, 0, 0, 0.7);
    display: flex;
    align-items: center;
    justify-content: left;
}

.font-grey {
    color:white;
}
CSS

);

// 获取当前用户的通知
$user = AdminUser::where('id', auth('admin')->id())->first();
$notifications = [];
if (!empty($user)) {
    $notifications = $user->unreadNotifications;
    $notifications = json_decode($notifications, true);
}

Admin::navbar(function (Navbar $navbar) use ($notifications) {
    $navbar->left(view('nav_left'));
    $navbar->right(view('nav_right')->with('notifications', $notifications));
});
