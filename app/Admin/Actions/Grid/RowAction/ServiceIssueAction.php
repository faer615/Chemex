<?php

namespace App\Admin\Actions\Grid\RowAction;

use App\Admin\Forms\ServiceIssueForm;
use Dcat\Admin\Admin;
use Dcat\Admin\Grid\RowAction;
use Dcat\Admin\Widgets\Modal;

class ServiceIssueAction extends RowAction
{
    /**
     * @return string
     */
    protected $title = '❓ 报告异常';

    public function render()
    {
        if (!Admin::user()->can('service.issue')) {
            return '你没有权限执行此操作！';
        }

        // 实例化表单类并传递自定义参数
        $form = ServiceIssueForm::make()->payload(['id' => $this->getKey()]);

        return Modal::make()
            ->lg()
            ->title('报告 ' . $this->getRow()->name . ' 发生的异常')
            ->body($form)
            ->button($this->title);
    }
}
