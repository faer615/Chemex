<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Dcat\Admin\Layout\Column;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Layout\Row;
use Dcat\Admin\Widgets\Card;

class ToolAndroidAppController extends Controller
{
    /**
     * 页面
     * @param Content $content
     * @return Content
     */
    public function index(Content $content): Content
    {
        return $content
            ->header('Android客户端')
            ->description('用于移动端查询、盘点的Android工具')
            ->body(function (Row $row) {
                $row->column(12, function (Column $column) {
                    $column->row(new Card('下载地址', view('tool_android_app.download')));
                });
            });
    }
}
