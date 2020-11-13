<?php


namespace App\Services;


use Exception;
use Illuminate\Support\Facades\Artisan;

/**
 * 安装、升级相关
 * Class InstallService
 * @package App\Services
 */
class ConfigService
{
    /**
     * 执行数据库迁移，一般用在升级之后的数据库结构更新动作上
     * @return bool
     */
    public static function migrate()
    {
        try {
            Artisan::call('migrate');
            return true;
        } catch (Exception $exception) {
            return false;
        }
    }

    /**
     * 清理全部已编译的缓存
     * @return bool
     */
    public static function clear()
    {
        try {
            Artisan::call('optimize:clear');
            return true;
        } catch (Exception $exception) {
            return false;
        }
    }
}
