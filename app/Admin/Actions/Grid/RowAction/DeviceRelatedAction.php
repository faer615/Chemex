<?php

namespace App\Admin\Actions\Grid\RowAction;

use App\Services\DeviceRecordService;
use Dcat\Admin\Admin;
use Dcat\Admin\Grid\RowAction;
use Dcat\Admin\Widgets\Modal;

class DeviceRelatedAction extends RowAction
{
    /**
     * @return string
     */
    protected $title = '📝 设备关联信息清单';

    public function render()
    {
        if (!Admin::user()->can('device.history')) {
            return '你没有权限执行此操作！';
        }

        // 实例化表单类并传递自定义参数
        $id = $this->getKey();

        $data = DeviceRecordService::related($id);

        return Modal::make()
            ->lg()
            ->title($this->getRow()->name . ' 的软硬件清单')
            ->body(view('device_records.related')->with('data', $data))
            ->button($this->title);
    }
}
