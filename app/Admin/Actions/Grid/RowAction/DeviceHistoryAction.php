<?php

namespace App\Admin\Actions\Grid\RowAction;

use App\Models\DeviceTrack;
use App\Models\HardwareTrack;
use App\Models\SoftwareTrack;
use App\Services\DeviceRecordService;
use Dcat\Admin\Admin;
use Dcat\Admin\Grid\RowAction;
use Dcat\Admin\Widgets\Modal;

class DeviceHistoryAction extends RowAction
{
    /**
     * @return string
     */
    protected $title = '📃 设备变动履历';

    public function render()
    {
        if (!Admin::user()->can('device.history')) {
            return '你没有权限执行此操作！';
        }

        // 实例化表单类并传递自定义参数
        $id = $this->getKey();

        $data = DeviceRecordService::history($id);

        return Modal::make()
            ->lg()
            ->title($this->getRow()->name . ' 的变动履历')
            ->body(view('history')->with('data', $data))
            ->button($this->title);
    }
}
