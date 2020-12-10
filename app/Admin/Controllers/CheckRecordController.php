<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Grid\RowAction\CheckCancelAction;
use App\Admin\Actions\Grid\RowAction\CheckFinishAction;
use App\Admin\Grid\Displayers\RowActions;
use App\Admin\Repositories\CheckRecord;
use App\Models\AdminUser;
use App\Models\CheckTrack;
use App\Models\DeviceRecord;
use App\Models\HardwareRecord;
use App\Models\SoftwareRecord;
use App\Support\Data;
use Dcat\Admin\Admin;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Show;

/**
 * @property  int status
 */
class CheckRecordController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid(): Grid
    {
        return Grid::make(new CheckRecord(['user']), function (Grid $grid) {
            $grid->column('id');
            $grid->column('check_item')->using(Data::items());
            $grid->column('start_time');
            $grid->column('end_time');
            $grid->column('user.name');
            $grid->column('status')->using(Data::checkRecordStatus());

            $grid->disableRowSelector();
            $grid->disableBatchActions();
            $grid->disableEditButton();
            $grid->disableDeleteButton();

            $grid->actions(function (RowActions $actions) {
                if ($this->status == 0) {
                    if (Admin::user()->can('check.finish')) {
                        $actions->append(new CheckFinishAction());
                    }
                    if (Admin::user()->can('check.cancel')) {
                        $actions->append(new CheckCancelAction());
                    }
                }
            });

            $grid->toolsWithOutline(false);
            $grid->enableDialogCreate();
            $grid->export();
        });
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     *
     * @return Show
     */
    protected function detail($id): Show
    {
        return Show::make($id, new CheckRecord(['user']), function (Show $show) {
            $show->field('id');
            $show->field('check_item');
            $show->field('start_time');
            $show->field('end_time');
            $show->field('user.name');
            $show->field('status')->using(Data::checkRecordStatus());
            $show->field('created_at');
            $show->field('updated_at');

            $show->disableEditButton();
            $show->disableDeleteButton();
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form(): Form
    {
        return Form::make(new CheckRecord(), function (Form $form) {
            $form->display('id');
            $form->select('check_item')
                ->options(Data::items())
                ->required();
            $form->datetime('start_time')
                ->required();
            $form->datetime('end_time')
                ->required();
            $form->select('user_id', admin_trans_label('User'))
                ->options(AdminUser::all()
                    ->pluck('name', 'id'))
                ->required();

            $form->display('created_at');
            $form->display('updated_at');

            // 提交回调，为了检测在盘点任务创建时，是否有已存在的盘点任务
            // 如果有，就中止，如果没有，就继续
            $form->submitted(function (Form $form) {
                $check_record = \App\Models\CheckRecord::where('check_item', $form->check_item)
                    ->where('status', 0)
                    ->first();
                if (!empty($check_record)) {
                    return $form->response()
                        ->error('还有未完成的相同盘点内容，请先处理');
                }
            });

            // 保存回调，创建盘点任务的同时，自动生成与之相关的全部盘点追踪记录
            $form->saved(function (Form $form) {
                $check_record = $form->model();
                switch ($check_record->check_item) {
                    case 'hardware':
                        $items = HardwareRecord::all();
                        break;
                    case 'software':
                        $items = SoftwareRecord::all();
                        break;
                    default:
                        $items = DeviceRecord::all();
                }
                foreach ($items as $item) {
                    $check_track = new CheckTrack();
                    $check_track->check_id = $form->getKey();
                    $check_track->item_id = $item->id;
                    $check_track->status = 0;
                    $check_track->checker = 0;
                    $check_track->save();
                }
            });

            $form->disableCreatingCheck();
            $form->disableEditingCheck();
            $form->disableViewCheck();
        });
    }
}
