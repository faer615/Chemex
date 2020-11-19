<?php

namespace App\Admin\Actions\Grid\ToolAction;

use App\Admin\Forms\DeviceRecordImportForm;
use Dcat\Admin\Grid\Tools\AbstractTool;
use Dcat\Admin\Widgets\Modal;

class DeviceRecordImportAction extends AbstractTool
{
    /**
     * @return string
     */
    protected $title = '<a class="btn btn-primary" style="color: white;">导入数据</a>';

    public function render()
    {
        return Modal::make()
            ->lg()
            ->body(new DeviceRecordImportForm())
            ->button($this->title);
    }
}
