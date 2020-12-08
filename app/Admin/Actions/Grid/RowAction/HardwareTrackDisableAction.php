<?php

namespace App\Admin\Actions\Grid\RowAction;

use App\Models\HardwareTrack;
use Dcat\Admin\Actions\Response;
use Dcat\Admin\Admin;
use Dcat\Admin\Grid\RowAction;

class HardwareTrackDisableAction extends RowAction
{
    protected $title = '🔗 解除归属';

    /**
     * 处理动作逻辑
     * @return Response
     */
    public function handle(): Response
    {
        if (!Admin::user()->can('hardware.track.disable')) {
            return $this->response()
                ->error('你没有权限执行此操作！')
                ->refresh();
        }

        $hardware_track = HardwareTrack::where('id', $this->getKey())->first();

        if (empty($hardware_track)) {
            return $this->response()
                ->error('找不到此硬件归属记录！');
        }

        $hardware_track->delete();

        return $this->response()
            ->success('硬件归属解除成功！')
            ->refresh();
    }

    /**
     * 对话框
     * @return string[]
     */
    public function confirm()
    {
        return ['确认解除与此设备的关联？'];
    }
}
