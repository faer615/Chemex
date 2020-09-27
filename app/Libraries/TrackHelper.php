<?php


namespace App\Libraries;


use App\Models\DeviceTrack;
use App\Models\HardwareTrack;
use App\Models\SoftwareRecord;
use App\Models\SoftwareTrack;

class TrackHelper
{
    /**
     * 获取设备当前最新的使用者
     * @param $device_id
     * @return string
     */
    public static function currentDeviceTrackStaff($device_id)
    {
        $device_track = DeviceTrack::where('device_id', $device_id)
            ->first();
        if (empty($device_track)) {
            return 0;
        } else {
            $staff = $device_track->staff;
            if (empty($staff)) {
                return -1;
            } else {
                return $staff->id;
            }
        }
    }

    public static function currentDeviceTrackDepartment()
    {

    }

    /**
     * 获取硬件当前归属的设备
     * @param $hardware_id
     * @return string
     */
    public static function currentHardwareTrack($hardware_id)
    {
        $hardware_track = HardwareTrack::where('hardware_id', $hardware_id)
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

    /**
     * 获取软件当前剩余授权数量
     * @param $software_id
     * @return int|string
     */
    public static function leftSoftwareCounts($software_id)
    {
        $software = SoftwareRecord::where('id', $software_id)
            ->first();
        if (empty($software)) {
            return '软件状态异常';
        }
        $software_tracks = SoftwareTrack::where('software_id', $software_id)
            ->get();
        $used = count($software_tracks);
        if ($software->counts == -1) {
            return '不受限';
        } else {
            return $software->counts - $used;
        }
    }
}
