<?php

namespace App\Admin\Actions\Grid\RowAction;

use App\Admin\Forms\MaintenanceFixForm;
use Dcat\Admin\Admin;
use Dcat\Admin\Grid\RowAction;
use Dcat\Admin\Widgets\Modal;

class MaintenanceFixAction extends RowAction
{
    protected $title = '🧱 处理维修';

    /**
     * 渲染模态框
     * @return Modal|string
     */
    public function render()
    {
        if (!Admin::user()->can('maintenance.fix')) {
            return '你没有权限执行此操作！';
        }

        // 实例化表单类并传递自定义参数
        $form = MaintenanceFixForm::make()->payload(['id' => $this->getKey()]);

        return Modal::make()
            ->lg()
            ->title('处理 ' . $this->getRow()->name . ' 的维修结果')
            ->body($form)
            ->button($this->title);
    }
}
