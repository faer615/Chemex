<?php

namespace App\Admin\Actions\Grid;

use App\Admin\Forms\SoftwareTrackForm;
use Dcat\Admin\Grid\RowAction;
use Dcat\Admin\Widgets\Modal;

class SoftwareTrackAction extends RowAction
{
    /**
     * @return string
     */
    protected $title = '归属设备';

    public function render()
    {
        // 实例化表单类并传递自定义参数
        $form = SoftwareTrackForm::make()->payload(['id' => $this->getKey()]);

        return Modal::make()
            ->lg()
            ->title('将 ' . $this->getRow()->name . ' 归属到设备')
            ->body($form)
            ->button($this->title);
    }
}
