<?php


namespace App\Services;


use App\Models\DeviceRecord;
use App\Models\HardwareRecord;
use App\Models\SoftwareRecord;

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
     * 判断物品维保剩余天数后返回 HTML 渲染体
     * @param $item_type
     * @param $id
     * @return string
     */
    public static function itemExpirationLeftDaysRender($item_type, $id)
    {
        $days = ExpirationService::itemExpirationLeftDays($item_type, $id);
        if ($days <= 0) {
            return "<span class='badge badge-pill badge-dark'>过保</span>";
        } elseif ($days <= 7 && $days > 0) {
            return "<span class='badge badge-pill badge-danger'>$days</span>";
        } elseif ($days <= 30 && $days > 7) {
            return "<span class='badge badge-pill badge-warning'>$days</span>";
        } else {
            return "<span class='badge badge-pill badge-success'>$days</span>";
        }
    }

    /**
     * 判断物品维保剩余天数
     * @param $item_type
     * @param $id
     * @return string
     */
    public static function itemExpirationLeftDays($item_type, $id)
    {
        $item = null;
        switch ($item_type) {
            case 'hardware':
                $item = HardwareRecord::where('id', $id)->first();
                break;
            case 'software':
                $item = SoftwareRecord::where('id', $id)->first();
                break;
            default:
                $item = DeviceRecord::where('id', $id)->first();
        }
        $day = 0;
        if ($item) {
            $expired = strtotime($item->expired);
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
