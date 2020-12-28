<?php

namespace App\Admin\Actions\Tree;

use App\Admin\Forms\StaffDepartmentImportForm;
use Dcat\Admin\Tree\AbstractTool;
use Dcat\Admin\Widgets\Modal;

class StaffDepartmentImportAction extends AbstractTool
{
    protected $title = '导入';

    /**
     * 渲染模态框
     * @return Modal|string
     */
    public function render()
    {

        return Modal::make()
            ->lg()
            ->body(new StaffDepartmentImportForm())
            ->button("<a class='btn btn-sm btn-success' style='color: white;'><i class='feather icon-package'></i>&nbsp;$this->title</a>");
    }
}
