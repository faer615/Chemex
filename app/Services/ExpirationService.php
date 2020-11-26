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

    //TODO
    public static function deviceExpirationStatus($id)
    {
        $device = DeviceRecord::where('id', $id)->first();
        if ($device) {
            $expired = strtotime($device->expired);

        } else {
            return '设备失效';
        }
    }
}
