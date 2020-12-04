<?php


namespace App\Services;


use App\Models\DeviceRecord;
use App\Models\DeviceTrack;
use App\Models\HardwareTrack;
use App\Models\SoftwareTrack;
use App\Support\Data;

class DeviceRecordService
{
    /**
     * 获取设备的软硬件内容
     * @param $id
     * @return mixed
     */
    public static function related($id): array
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

    /**
     * 获取设备的履历清单
     * @param $id
     * @return array
     */
    public static function history($id): array
    {
        $data = [];

        $single = [
            'type' => '',
            'name' => '',
            'status' => '',
            'style' => '',
            'datetime' => ''
        ];

        // 处理设备使用者变动履历
        $device_tracks = DeviceTrack::withTrashed()
            ->where('device_id', $id)
            ->get();
        foreach ($device_tracks as $device_track) {
            $single['type'] = '用户';
            $device = $device_track->staff()->withTrashed()->first();
            $single['name'] = $device->name . ' - ' . $device_track->staff()
                    ->withTrashed()
                    ->first()
                    ->department()
                    ->withTrashed()
                    ->first()
                    ->name;
            $single['status'] = '+';
            $single['datetime'] = json_decode($device_track, true)['created_at'];
            array_push($data, $single);
            if (!empty($device_track->deleted_at)) {
                $single['status'] = '-';
                $single['datetime'] = json_decode($device_track, true)['deleted_at'];
                array_push($data, $single);
            }
        }

        // 处理设备硬件变动履历
        $hardware_tracks = HardwareTrack::withTrashed()
            ->where('device_id', $id)
            ->get();
        foreach ($hardware_tracks as $hardware_track) {
            $single['type'] = '硬件';
            $hardware = $hardware_track->hardware()->withTrashed()->first();
            $single['name'] = $hardware->name . ' - ' . $hardware->specification;
            $single['status'] = '+';
            $single['datetime'] = json_decode($hardware_track, true)['created_at'];
            array_push($data, $single);
            if (!empty($hardware_track->deleted_at)) {
                $single['status'] = '-';
                $single['datetime'] = json_decode($hardware_track, true)['deleted_at'];
                array_push($data, $single);
            }
        }

        // 处理设备软件变动履历
        $software_tracks = SoftwareTrack::withTrashed()
            ->where('device_id', $id)
            ->get();
        foreach ($software_tracks as $software_track) {
            $single['type'] = '软件';
            $software = $software_track->software()->withTrashed()->first();
            $single['name'] = $software->name . ' ' . $software->version;
            $single['status'] = '+';
            $single['datetime'] = json_decode($software_track, true)['created_at'];
            array_push($data, $single);
            if (!empty($software_track->deleted_at)) {
                $single['status'] = '-';
                $single['datetime'] = json_decode($software_track, true)['deleted_at'];
                array_push($data, $single);
            }
        }

        $datetime = array_column($data, 'datetime');
        array_multisort($datetime, SORT_DESC, $data);

        return $data;
    }
}
