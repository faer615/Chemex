<?php

namespace App\Admin\Actions\Grid\RowAction;

use App\Models\DeviceTrack;
use Dcat\Admin\Actions\Response;
use Dcat\Admin\Admin;
use Dcat\Admin\Grid\RowAction;

class DeviceTrackDisableAction extends RowAction
{
    /**
     * @return string
     */
    protected $title = '🔗 解除归属';

    /**
     * Handle the action request.
     *
     * @return Response
     */
    public function handle(): Response
    {
        if (!Admin::user()->can('device.track.disable')) {
            return $this->response()
                ->error('你没有权限执行此操作！')
                ->refresh();
        }

        $device_track = DeviceTrack::where('id', $this->getKey())->first();

        if (empty($device_track)) {
            return $this->response()
                ->error('找不到此设备归属记录！');
        }

        $device_track->delete();

        return $this->response()
            ->success('设备归属解除成功！')
            ->refresh();
    }

    /**
     * @return string|array|void
     */
    public function confirm()
    {
        return ['确认解除与此雇员的关联？'];
    }
}
