<?php

namespace App\Admin\Actions\Grid\RowAction;

use App\Admin\Forms\DeviceTrackForm;
use Dcat\Admin\Admin;
use Dcat\Admin\Grid\RowAction;
use Dcat\Admin\Widgets\Modal;

class DeviceTrackAction extends RowAction
{
    protected $title = '👨‍💼 分配使用者';

    /**
     * 渲染模态框
     * @return Modal|string
     */
    public function render()
    {
        if (!Admin::user()->can('device.track')) {
            return '你没有权限执行此操作！';
        }

        // 实例化表单类并传递自定义参数
        $form = DeviceTrackForm::make()->payload(['id' => $this->getKey()]);

        return Modal::make()
            ->lg()
            ->title('为 ' . $this->getRow()->name . ' 分配使用者')
            ->body($form)
            ->button($this->title);
    }
}
