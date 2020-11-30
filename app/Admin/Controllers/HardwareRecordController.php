<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Grid\RowAction\HardwareDeleteAction;
use App\Admin\Actions\Grid\RowAction\HardwareHistoryAction;
use App\Admin\Actions\Grid\RowAction\HardwareTrackAction;
use App\Admin\Actions\Grid\RowAction\MaintenanceAction;
use App\Admin\Grid\Displayers\RowActions;
use App\Admin\Repositories\HardwareRecord;
use App\Models\DeviceRecord;
use App\Models\HardwareCategory;
use App\Models\PurchasedChannel;
use App\Models\VendorRecord;
use App\Services\ExpirationService;
use App\Support\Track;
use Dcat\Admin\Admin;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Show;

/**
 * @property  DeviceRecord device
 * @property  int id
 */
class HardwareRecordController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new HardwareRecord(['category', 'vendor', 'device']), function (Grid $grid) {
            $grid->column('id');
            $grid->column('qrcode')->qrcode(function () {
                return base64_encode('hardware:' . $this->id);
            }, 200, 200);
            $grid->column('name');
            $grid->column('description');
            $grid->column('category.name');
            $grid->column('vendor.name');
            $grid->column('specification');
            $grid->column('sn');
            $grid->column('', admin_trans_label('Owner'))->display(function () {
                return Track::currentHardwareTrack($this->id);
            });
            $grid->column('', admin_trans_label('Expiration Left Days'))->display(function () {
                return ExpirationService::itemExpirationLeftDaysRender('hardware', $this->id);
            });
            $grid->actions(function (RowActions $actions) {
                if (Admin::user()->can('hardware.delete')) {
                    $actions->append(new HardwareDeleteAction());
                }
                if (Admin::user()->can('hardware.track')) {
                    $actions->append(new HardwareTrackAction());
                }
                if (Admin::user()->can('hardware.history')) {
                    $actions->append(new HardwareHistoryAction());
                }
                if (Admin::user()->can('hardware.maintenance')) {
                    $actions->append(new MaintenanceAction('hardware'));
                }
            });
            $grid->column('device.name')->link(function () {
                return route('device.records.show', $this->device['id']);
            });

            $grid->quickSearch('id', 'name')
                ->placeholder('输入ID或者名称以搜索')
                ->auto(false);

            $grid->enableDialogCreate();
            $grid->disableRowSelector();
            $grid->disableDeleteButton();
            $grid->disableBatchActions();

            $grid->toolsWithOutline(false);
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
    protected function detail($id)
    {
        return Show::make($id, new HardwareRecord(['category', 'vendor', 'channel', 'device']), function (Show $show) {
            $show->field('id');
            $show->field('name');
            $show->field('description');
            $show->field('category.name');
            $show->field('vendor.name');
            $show->field('channel.name');
            $show->field('device.name');
            $show->field('specification');
            $show->field('sn');
            $show->field('price');
            $show->field('purchased');
            $show->field('expired');
            $show->field('created_at');
            $show->field('updated_at');

            $show->disableDeleteButton();
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
            $form->select('category_id', admin_trans_label('Category'))
                ->options(HardwareCategory::all()
                    ->pluck('name', 'id'))
                ->required();
            $form->select('vendor_id', admin_trans_label('Vendor'))
                ->options(VendorRecord::all()
                    ->pluck('name', 'id'))
                ->required();
            $form->select('purchased_channel_id', admin_trans_label('Purchased Channel Id'))
                ->options(PurchasedChannel::all()
                    ->pluck('name', 'id'));
            $form->text('specification')->required();
            $form->text('sn');
            $form->currency('price');
            $form->date('purchased');
            $form->date('expired');

            $form->display('created_at');
            $form->display('updated_at');

            $form->disableDeleteButton();
        });
    }
}
