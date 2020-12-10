<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Grid\RowAction\HardwareTrackDisableAction;
use App\Admin\Grid\Displayers\RowActions;
use App\Admin\Repositories\HardwareTrack;
use App\Support\Data;
use DateTime;
use Dcat\Admin\Admin;
use Dcat\Admin\Grid;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Widgets\Alert;

/**
 * @property DateTime deleted_at
 */
class HardwareTrackController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid(): Grid
    {
        return Grid::make(new HardwareTrack(['hardware', 'device']), function (Grid $grid) {
            $grid->model()->where('device_id', '=', 2);
            $grid->column('id');
            $grid->column('hardware.name');
            $grid->column('device.name');
            $grid->column('created_at');
            $grid->column('updated_at');

            $grid->disableCreateButton();
            $grid->disableRowSelector();
            $grid->disableBatchActions();
            $grid->disableViewButton();
            $grid->disableEditButton();
            $grid->disableDeleteButton();

            $grid->actions(function (RowActions $actions) {
                if (Admin::user()->can('hardware.track.disable') && $this->deleted_at == null) {
                    $actions->append(new HardwareTrackDisableAction());
                }
            });

            $grid->filter(function (Grid\Filter $filter) {
                $filter->panel();
                $filter->scope('history', '查看历史归属记录')->onlyTrashed();
            });

            $grid->toolsWithOutline(false);
        });
    }

    /**
     * Make a show builder.
     *
     * @return Alert
     */
    protected function detail(): Alert
    {
        return Data::unsupportedOperationWarning();
    }

    /**
     * Make a form builder.
     *
     * @return Alert
     */
    protected function form(): Alert
    {
        return Data::unsupportedOperationWarning();
    }
}
