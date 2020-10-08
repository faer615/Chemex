<?php


namespace App\Libraries;


use Exception;
use Illuminate\Support\Facades\Http;

class System
{
    /**
     * 检查WebSSH服务是否启动
     * @param $url
     * @return int|mixed
     */
    public static function checkWebSSHServiceStatus($url)
    {
        try {
            $response = Http::get($url);
            return $response->status();
        } catch (Exception $e) {
            return $e->getCode();
        }
    }
}
