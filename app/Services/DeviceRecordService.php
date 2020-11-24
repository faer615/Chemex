<?php


namespace App\Services;


use App\Models\DeviceRecord;
use App\Support\Data;

class DeviceRecordService
{
    /**
     * 获取设备的软硬件内容
     * @param $id
     * @return mixed
     */
    public static function related($id)
    {
        $device = DeviceRecord::where('id', $id)
            ->firstOrFail();

        // 获取所有硬件
        $hardware = $device->hardware;
        // 获取所有软件
        $software = $device->software;
        // 获取所有服务程序
        $service = $device->service;

        // 转换软件授权方式的显示内容
        foreach ($software as $item) {
            $item->distribution = Data::distribution()[$item->distribution];
        }

        $data['hardware'] = $hardware;
        $data['software'] = $software;
        $data['service'] = $service;

        return $data;
    }
}
