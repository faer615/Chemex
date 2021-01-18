<?php


namespace App\Support;


use Exception;
use Illuminate\Support\Facades\Http;

class System
{
    /**
     * 检查WebSSH服务是否启动
     * @param $url
     * @return int|mixed
     */
    public static function checkWebSSHServiceStatus($url): int
    {
        try {
            $response = Http::get($url);
            return $response->status();
        } catch (Exception $e) {
            return $e->getCode();
        }
    }

    /**
     * 检查WebSSH服务是否被安装
     * @return int
     */
    public static function checkWebSSHServiceInstalled(): int
    {
        $result = exec('which wssh', $outputs);
        if (empty($result)) {
            return 0;
        } else {
            return 1;
        }
    }

    /**
     * 从Gitee获取最新发行版本
     * @return string|null
     */
    public static function getLatestVersionFromGitee(): ?string
    {
        $response = Http::get('https://gitee.com/api/v5/repos/celaraze/Chemex/tags')->json();
        if (empty($response)) {
            return null;
        }
        $version = $response[count($response) - 1]['name'];
        $remote_version = str_replace('v', '', $version);
        $local_version = config('admin.chemex_version');
        $result = self::diffVersion($local_version, $remote_version);

        if ($result === -1) {
            return $version;
        } else {
            return null;
        }
    }

    /**
     * 比较两个语义化版本的大小
     * -1 表示有新版本，0 表示版本相同 ，1 表示本地版本比远程版本新
     * @param $old
     * @param $new
     * @param string $delimiter
     * @return int
     */
    public static function diffVersion($old, $new, $delimiter = '.'): int
    {
        $old = explode($delimiter, $old);
        $new = explode($delimiter, $new);
        $res = (int)$old[0] <=> (int)$new[0];
        if ($res == 0) {
            $res = (int)$old[1] <=> (int)$new[1];
            if ($res == 0) {
                return (int)$old[2] <=> (int)$new[2];
            }
            return $res;
        }
        return $res;
    }
}
