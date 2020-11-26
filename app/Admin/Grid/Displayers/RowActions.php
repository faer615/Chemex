<?php


namespace App\Admin\Grid\Displayers;


use Dcat\Admin\Grid\Displayers\DropdownActions;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class RowActions extends DropdownActions
{
    /**
     * @param array $callbacks
     * @return Factory|View
     */
    public function display(array $callbacks = [])
    {
        $this->resetDefaultActions();

        $this->call($callbacks);

        $this->prependDefaultActions();

        $default = $this->default;

        // 判断行操作按钮是否启用了查看
        // 如果有就返回按钮，如果无就返回空
        if (isset($default[0])) {
            $view = $default[0];
            unset($default[0]);
        } else {
            $view = '';
        }

        // 判断行操作按钮是否启用了编辑
        // 如果有就返回按钮，如果无就返回空
        if (isset($default[1])) {
            $edit = $default[1];
            unset($default[1]);
        } else {
            $edit = '';
        }

        $actions = [
            'view' => $view,
            'edit' => $edit,
            'default' => $this->default,
            'custom' => $this->appends,
            'selector' => ".{$this->grid->getRowName()}-checkbox",
        ];

        return view('grid.row-actions', $actions);
    }
}
