<?php

namespace App\Admin\Actions\Grid\RowAction;

use App\Services\SoftwareRecordService;
use Dcat\Admin\Admin;
use Dcat\Admin\Grid\RowAction;
use Dcat\Admin\Widgets\Modal;

class SoftwareHistoryAction extends RowAction
{
    protected $title = '📃 软件变动履历';

    /**
     * 渲染模态框
     * @return Modal|string
     */
    public function render()
    {
        if (!Admin::user()->can('software.history')) {
            return '你没有权限执行此操作！';
        }

        // 实例化表单类并传递自定义参数
        $id = $this->getKey();

        $data = SoftwareRecordService::history($id);

        return Modal::make()
            ->lg()
            ->title($this->getRow()->name . ' 的变动履历')
            ->body(view('history')->with('data', $data))
            ->button($this->title);
    }
}
