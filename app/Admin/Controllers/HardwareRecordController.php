<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Grid\HardwareTrackAction;
use App\Admin\Repositories\HardwareRecord;
use App\Libraries\TrackHelper;
use App\Models\HardwareCategory;
use App\Models\VendorRecord;
use Dcat\Admin\Controllers\AdminController;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;

class HardwareRecordController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new HardwareRecord(['category', 'vendor']), function (Grid $grid) {
            $grid->column('id');
            $grid->column('qrcode')->qrcode(function () {
                return 'hardware:' . $this->id;
            }, 200, 200);
            $grid->column('name');
            $grid->column('description');
            $grid->column('category.name');
            $grid->column('vendor.name');
            $grid->column('specification');
            $grid->column('sn');
            $grid->column('', admin_trans_label('Owner'))->display(function () {
                return TrackHelper::currentHardwareTrack($this->id);
            });

            $grid->actions([new HardwareTrackAction()]);

            $grid->quickSearch('id', 'name')
                ->placeholder('输入ID或者名称以搜索')
                ->auto(false);
        });
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     *
     * @return Show
     */
    protected function detail($id)
    {
        return Show::make($id, new HardwareRecord(['category', 'vendor']), function (Show $show) {
            $show->field('id');
            $show->field('name');
            $show->field('description');
            $show->field('category.name');
            $show->field('vendor.name');
            $show->field('specification');
            $show->field('sn');
            $show->field('created_at');
            $show->field('updated_at');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new HardwareRecord(), function (Form $form) {
            $form->display('id');
            $form->text('name')->required();
            $form->text('description');
            $form->select('category_id')
                ->options(HardwareCategory::all()
                    ->pluck('name', 'id'))
                ->required();
            $form->select('vendor_id')
                ->options(VendorRecord::all()
                    ->pluck('name', 'id'))
                ->required();
            $form->text('specification')->required();
            $form->text('sn');

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
