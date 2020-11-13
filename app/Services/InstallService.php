<?php


namespace App\Services;


use Exception;
use Illuminate\Support\Facades\Artisan;

/**
 * 安装、升级相关
 * Class InstallService
 * @package App\Services
 */
class InstallService
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
}
