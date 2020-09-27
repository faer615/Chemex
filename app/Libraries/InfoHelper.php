<?php


namespace App\Libraries;


use App\Models\SoftwareTrack;
use App\Models\StaffRecord;

class InfoHelper
{
    /**
     * 雇员id换取name
     * @param $staff_id
     * @return string
     */
    public static function staffIdToName($staff_id)
    {
        $staff = StaffRecord::where('id', $staff_id)
            ->first();
        if (empty($staff)) {
            return '雇员失踪';
        }
        return $staff->name;
    }

    /**
     * 雇员id换取部门name
     * @param $staff_id
     * @return mixed
     */
    public static function staffIdToDepartmentName($staff_id)
    {
        $staff = StaffRecord::where('id', $staff_id)
            ->first();
        if (!empty($staff)) {
            return $staff->department->name;
        }
    }

    /**
     * 设备id获取操作系统标识
     * @param $device_id
     * @return string
     */
    public static function getOSTag($device_id)
    {
        $software_tracks = SoftwareTrack::where('device_id', $device_id)
            ->get();
        foreach ($software_tracks as $software_track) {
            if (strstr($software_track->name, 'win') != false) {
                return 'windows';
            }
            if (strstr($software_track->name, 'linux') != false) {
                return 'linux';
            }
            if (strstr($software_track->name, 'macos') != false) {
                return 'macos';
            }
            if (strstr($software_track->name, 'android') != false) {
                return 'android';
            }
            if (strstr($software_track->name, 'ios') != false) {
                return 'windows';
            }
            return '';
        }
    }
}
