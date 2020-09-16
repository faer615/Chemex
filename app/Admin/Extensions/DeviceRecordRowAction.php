<?php


namespace App\Admin\Extensions;

use Dcat\Admin\Grid\RowAction;

class DeviceRecordRowAction extends RowAction
{
    /**
     * 返回字段标题
     *
     * @return string
     */
    public function title()
    {
        return '分配用户';
    }

    public function html()
    {
        // 获取当前行数据ID
        $id = $this->getKey();

        // 这里需要添加一个class, 和上面script方法对应
        $this->setHtmlAttribute(['data-id' => $id, 'class' => 'grid-check-row']);

        return parent::html();
    }

    /**
     * 添加JS
     *
     * @return string
     */
    protected function script()
    {
        return <<<JS
$('.grid-check-row').on('click', function () {

    // Your code.
    console.log($(this).data('id'));

});
JS;
    }
}
