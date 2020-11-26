<?php


namespace App\Services;


use App\Models\DeviceRecord;

/**
 * 检测记录是否过期（比如保固时间）
 * Class ExpirationService
 * @package App\Services
 */
class ExpirationService
{
    /**
     * 30天内即将过期的设备
     * @return int
     */
    public static function deviceCounts()
    {
        $result = 0;
        $devices = DeviceRecord::where('expired', '!=', null)->get();
        foreach ($devices as $device) {
            $expired = strtotime($device->expired);
            if (time() < $expired && $expired < (time() + 60 * 60 * 24 * 30)) {
                $result++;
            }
        }
        return $result;
    }

    /**
     * 判断设备维保剩余天数
     * @param $id
     * @return string
     */
    public static function deviceExpirationLeftDays($id)
    {
        $device = DeviceRecord::where('id', $id)->first();
        $day = 0;
        if ($device) {
            $expired = strtotime($device->expired);
            $now = time();
            $diff = $expired - $now;
            if ($diff <= 0) {
                $day = 0;
            } else {
                $day = $diff / 60 / 60 / 24;
                $day = ceil($day);
            }
        }
        return (int)$day;
    }
}
