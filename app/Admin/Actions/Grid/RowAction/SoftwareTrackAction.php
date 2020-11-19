<?php

namespace App\Admin\Actions\Grid\RowAction;

use App\Admin\Forms\SoftwareTrackForm;
use Dcat\Admin\Admin;
use Dcat\Admin\Grid\RowAction;
use Dcat\Admin\Widgets\Modal;

class SoftwareTrackAction extends RowAction
{
    /**
     * @return string
     */
    protected $title = '💻 归属到设备';

    public function render()
    {
        if (!Admin::user()->can('software.track')) {
            return '你没有权限执行此操作！';
        }

        // 实例化表单类并传递自定义参数
        $form = SoftwareTrackForm::make()->payload(['id' => $this->getKey()]);

        return Modal::make()
            ->lg()
            ->title('将 ' . $this->getRow()->name . ' 归属到设备')
            ->body($form)
            ->button($this->title);
    }
}
