<?php

namespace App\Admin\Actions\Grid\RowAction;

use App\Models\DeviceTrack;
use App\Models\StaffRecord;
use Dcat\Admin\Actions\Response;
use Dcat\Admin\Admin;
use Dcat\Admin\Grid\RowAction;

class StaffDeleteAction extends RowAction
{
    /**
     * @return string
     */
    protected $title = '🔨 删除雇员';

    /**
     * Handle the action request.
     *
     * @return Response
     */
    public function handle(): Response
    {
        if (!Admin::user()->can('staff.delete')) {
            return $this->response()
                ->error('你没有权限执行此操作！')
                ->refresh();
        }

        $staff = StaffRecord::where('id', $this->getKey())->first();
        if (empty($staff)) {
            return $this->response()
                ->alert()
                ->error('没有此雇员记录！');
        }

        $device_tracks = DeviceTrack::where('staff_id', $staff->id)
            ->get();

        foreach ($device_tracks as $device_track) {
            $device_track->delete();
        }

        $staff->delete();

        return $this->response()
            ->alert()
            ->success('成功删除雇员: ' . $staff->name)
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
