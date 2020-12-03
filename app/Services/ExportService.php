<?php


namespace App\Services;


use App\Models\DeviceRecord;
use App\Models\SoftwareRecord;
use Dcat\EasyExcel\Excel;

class ExportService
{
    /**
     * 设备履历导出
     * @param $device_id
     * @return mixed
     */
    public static function DeviceHistory($device_id)
    {
        $device = DeviceRecord::where('id', $device_id)->first();
        if (empty($device)) {
            $name = '未知';
        } else {
            $name = $device->name;
        }
        $history = DeviceRecordService::history($device_id);
        return Excel::export($history)->download($name . '履历清单.xlsx');
    }

    /**
     * 设备履历导出
     * @param $software_id
     * @return mixed
     */
    public static function SoftwareHistory($software_id)
    {
        $software = SoftwareRecord::where('id', $software_id)->first();
        if (empty($software)) {
            $name = '未知';
        } else {
            $name = $software->name;
        }
        $history = SoftwareRecordService::history($software_id);
        return Excel::export($history)->download($name . '履历清单.xlsx');
    }
}
