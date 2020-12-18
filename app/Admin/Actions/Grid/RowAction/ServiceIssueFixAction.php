<?php

namespace App\Admin\Actions\Grid\RowAction;

use App\Admin\Forms\ServiceIssueFixForm;
use Dcat\Admin\Admin;
use Dcat\Admin\Grid\RowAction;
use Dcat\Admin\Widgets\Modal;

class ServiceIssueFixAction extends RowAction
{
    protected $title = '🔧 修复故障';

    /**
     * 渲染模态框
     * @return Modal|string
     */
    public function render()
    {
        if (!Admin::user()->can('service.issue.fix')) {
            return '你没有权限执行此操作！';
        }

        // 实例化表单类并传递自定义参数
        $form = ServiceIssueFixForm::make()->payload(['id' => $this->getKey()]);

        return Modal::make()
            ->lg()
            ->title('处理服务故障')
            ->body($form)
            ->button($this->title);
    }
}
