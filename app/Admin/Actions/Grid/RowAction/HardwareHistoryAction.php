<?php

namespace App\Admin\Actions\Grid\RowAction;

use App\Services\HardwareRecordService;
use Dcat\Admin\Admin;
use Dcat\Admin\Grid\RowAction;
use Dcat\Admin\Widgets\Modal;

class HardwareHistoryAction extends RowAction
{
    /**
     * @return string
     */
    protected $title = '📃 硬件变动履历';

    public function render()
    {
        if (!Admin::user()->can('hardware.history')) {
            return '你没有权限执行此操作！';
        }

        // 实例化表单类并传递自定义参数
        $id = $this->getKey();

        $data = HardwareRecordService::history($id);

        return Modal::make()
            ->lg()
            ->title($this->getRow()->name . ' 的变动履历')
            ->body(view('history')->with('data', $data))
            ->button($this->title);
    }
}
