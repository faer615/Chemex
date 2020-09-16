<?php


namespace App\Libraries;


use App\Models\DeviceTrack;
use App\Models\HardwareTrack;

class TrackHelper
{
    /**
     * 获取设备当前最新的使用者
     * @param $device_id
     * @return string
     */
    static function currentDeviceTrack($device_id)
    {
        $device_track = DeviceTrack::where('device_id', $device_id)
            ->where('deleted_at', null)
            ->first();
        if (empty($device_track)) {
            return '闲置';
        } else {
            $staff = $device_track->staff;
            if (empty($staff)) {
                return '雇员失踪';
            } else {
                return $staff->name;
            }
        }
    }

    /**
     * 获取硬件当前归属的设备
     * @param $hardware_id
     * @return string
     */
    static function currentHardwareTrack($hardware_id)
    {
        $hardware_track = HardwareTrack::where('hardware_id', $hardware_id)
            ->where('deleted_at', null)
            ->first();
        if (empty($hardware_track)) {
            return '闲置';
        } else {
            $device = $hardware_track->device;
            if (empty($device)) {
                return '设备失踪';
            } else {
                return $device->name;
            }
        }
    }
}
