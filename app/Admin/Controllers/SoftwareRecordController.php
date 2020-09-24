<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Grid\SoftwareTrackAction;
use App\Admin\Repositories\SoftwareRecord;
use App\Libraries\Data;
use App\Libraries\TrackHelper;
use App\Models\SoftwareCategory;
use App\Models\VendorRecord;
use Dcat\Admin\Controllers\AdminController;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;

class SoftwareRecordController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new SoftwareRecord(['category', 'vendor']), function (Grid $grid) {
            $grid->column('id');
            $grid->column('qrcode')->qrcode(function () {
                return base64_encode('software:' . $this->id);
            }, 200, 200);
            $grid->column('name');
//            $grid->column('description');
            $grid->column('category.name');
            $grid->column('version');
            $grid->column('vendor.name');
            $grid->column('price');
            $grid->column('purchased');
            $grid->column('expired');
            $grid->column('distribution')->using(Data::distribution());
            $grid->column('counts');
            $grid->column('', admin_trans_label('Left Counts'))->display(function () {
                return TrackHelper::leftSoftwareCounts($this->id);
            });

            $grid->actions([new SoftwareTrackAction()]);

            $grid->quickSearch('id', 'name')
                ->placeholder('输入ID或者名称以搜索')
                ->auto(false);

            $grid->enableDialogCreate();
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
        return Show::make($id, new SoftwareRecord(['category', 'vendor']), function (Show $show) {
            $show->field('id');
            $show->field('name');
            $show->field('description');
            $show->field('category.name');
            $show->field('version');
            $show->field('vendor.name');
            $show->field('price');
            $show->field('purchased');
            $show->field('expired');
            $show->field('distribution')->using(Data::distribution());
            $show->field('counts');
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
        return Form::make(new SoftwareRecord(), function (Form $form) {
            $form->display('id');
            $form->text('name')->required();
            $form->text('description');
            $form->select('category_id', admin_trans_label('Category'))
                ->options(SoftwareCategory::all()->pluck('name', 'id'))
                ->required();
            $form->text('version')->required();
            $form->select('vendor_id', admin_trans_label('Vendor'))
                ->options(VendorRecord::all()->pluck('name', 'id'))
                ->required();
            $form->currency('price');
            $form->date('purchased');
            $form->date('expired');
            $form->select('distribution')
                ->options(Data::distribution())
                ->default('u')
                ->required();
            $form->text('sn');
            $form->number('counts')
                ->min(-1)
                ->default(1)
                ->required()
                ->help('"-1"表示无限制。');
            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
