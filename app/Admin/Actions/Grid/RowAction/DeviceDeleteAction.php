<?php

namespace App\Admin\Actions\Grid\RowAction;

use App\Models\DeviceRecord;
use App\Models\DeviceTrack;
use App\Models\PartTrack;
use App\Models\ServiceTrack;
use App\Models\SoftwareTrack;
use Dcat\Admin\Actions\Response;
use Dcat\Admin\Admin;
use Dcat\Admin\Grid\RowAction;

class DeviceDeleteAction extends RowAction
{
    protected $title = '🔨 删除设备';

    /**
     * 处理动作逻辑
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
                ->error('没有此配件记录！');
        }

        // 软删除设备归属记录
        $device_tracks = DeviceTrack::where('device_id', $device->id)->get();
        foreach ($device_tracks as $device_track) {
            $device_track->delete();
        }

        // 软删除配件归属记录
        $part_tracks = PartTrack::where('device_id', $device->id)->get();
        foreach ($part_tracks as $part_track) {
            $part_track->delete();
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
            ->success('成功删除设备: ' . $device->name)
            ->refresh();
    }

    /**
     * 对话框
     * @return string[]
     */
    public function confirm(): array
    {
        return ['确认删除？', '删除的同时将会解除所有与之关联的归属关系'];
    }
}
