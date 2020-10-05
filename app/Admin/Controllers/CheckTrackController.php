<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Grid\CheckTrackNoAction;
use App\Admin\Actions\Grid\CheckTrackYesAction;
use App\Admin\Repositories\CheckTrack;
use App\Libraries\Data;
use App\Models\CheckRecord;
use App\Models\DeviceRecord;
use App\Models\HardwareRecord;
use App\Models\SoftwareRecord;
use Dcat\Admin\Controllers\AdminController;
use Dcat\Admin\Grid;

class CheckTrackController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new CheckTrack(['user']), function (Grid $grid) {
            $grid->column('id');
            $grid->column('check_id');
            $grid->column('item_id')->display(function ($item_id) {
                $check = CheckRecord::where('id', $this->check_id)->first();
                if (empty($check)) {
                    return '任务状态异常';
                } else {
                    $check_item = $check->check_item;
                    switch ($check_item) {
                        case 'hardware':
                            $item = HardwareRecord::where('id', $item_id)->first();
                            break;
                        case 'software':
                            $item = SoftwareRecord::where('id', $item_id)->first();
                            break;
                        default:
                            $item = DeviceRecord::where('id', $item_id)->first();
                    }
                    if (empty($item)) {
                        return '物品状态异常';
                    } else {
                        return $item->name;
                    }
                }
            });
            $grid->column('status')->using(Data::checkTrackStatus());
            $grid->column('user.name');
            $grid->column('created_at');
            $grid->column('updated_at');

            $grid->actions([new CheckTrackYesAction(), new CheckTrackNoAction()]);

            $grid->disableRowSelector();
            $grid->disableBatchDelete();
            $grid->disableCreateButton();
            $grid->disableEditButton();
            $grid->disableViewButton();
            $grid->disableDeleteButton();

            $grid->quickSearch('check_id')
                ->placeholder('输入任务ID以筛选')
                ->auto(false);
        });
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     *
     * @return void
     */
    protected function detail($id)
    {
        return;
//        return Show::make($id, new CheckTrack(), function (Show $show) {
//            $show->field('id');
//            $show->field('check_id');
//            $show->field('item_id');
//            $show->field('status');
//            $show->field('checker');
//            $show->field('created_at');
//            $show->field('updated_at');
//
//            $show->disableEditButton();
//            $show->disableDeleteButton();
//        });
    }

    /**
     * Make a form builder.
     *
     * @return void
     */
    protected function form()
    {
        return;
//        return Form::make(new CheckTrack(), function (Form $form) {
//            $form->display('id');
//            $form->text('check_id');
//            $form->text('item_id');
//            $form->text('status');
//            $form->text('checker');
//
//            $form->display('created_at');
//            $form->display('updated_at');
//        });
    }
}
