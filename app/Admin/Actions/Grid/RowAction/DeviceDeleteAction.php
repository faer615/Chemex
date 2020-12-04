<?php

namespace App\Admin\Actions\Grid\RowAction;

use App\Models\DeviceRecord;
use App\Models\DeviceTrack;
use App\Models\HardwareTrack;
use App\Models\ServiceTrack;
use App\Models\SoftwareTrack;
use Dcat\Admin\Actions\Response;
use Dcat\Admin\Admin;
use Dcat\Admin\Grid\RowAction;

class DeviceDeleteAction extends RowAction
{
    /**
     * @return string
     */
    protected $title = '🔨 删除设备';

    /**
     * Handle the action request.
     *
     * @return Response
     */
    public function handle(): Response
    {
        if (!Admin::user()->can('device.delete')) {
            return $this->response()
                ->error('你没有权限执行此操作！')
                ->refresh();
        }

        $device = DeviceRecord::where('id', $this->getKey())->first();
        if (empty($device)) {
            return $this->response()
                ->alert()
                ->error('没有此硬件记录！');
        }

        // 软删除设备归属记录
        $device_tracks = DeviceTrack::where('device_id', $device->id)->get();
        foreach ($device_tracks as $device_track) {
            $device_track->delete();
        }

        // 软删除硬件归属记录
        $hardware_tracks = HardwareTrack::where('device_id', $device->id)->get();
        foreach ($hardware_tracks as $hardware_track) {
            $hardware_track->delete();
        }

        // 软删除软件归属记录
        $software_tracks = SoftwareTrack::where('device_id', $device->id)->get();
        foreach ($software_tracks as $software_track) {
            $software_track->delete();
        }

        // 软删除服务归属记录
        $service_tracks = ServiceTrack::where('device_id', $device->id)->get();
        foreach ($service_tracks as $service_track) {
            $service_track->delete();
        }

        $device->delete();

        return $this->response()
            ->alert()
            ->success('成功删除设备: ' . $device->name)
            ->refresh();
    }

    /**
     * @return string|array|void
     */
    public function confirm()
    {
        return ['确认删除？', '删除的同时将会解除所有与之关联的归属关系'];
    }
}
