<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Grid\RowAction\HardwareDeleteAction;
use App\Admin\Actions\Grid\RowAction\HardwareTrackAction;
use App\Admin\Actions\Grid\RowAction\MaintenanceAction;
use App\Admin\Actions\Grid\ToolAction\HardwareRecordImportAction;
use App\Admin\Grid\Displayers\RowActions;
use App\Admin\Repositories\HardwareRecord;
use App\Models\DepreciationRule;
use App\Models\DeviceRecord;
use App\Models\HardwareCategory;
use App\Models\PurchasedChannel;
use App\Models\VendorRecord;
use App\Services\ExpirationService;
use App\Support\Info;
use Dcat\Admin\Admin;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Show;

/**
 * @property DeviceRecord device
 * @property int id
 * @property double price
 * @property string purchased
 */
class HardwareRecordController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid(): Grid
    {
        return Grid::make(new HardwareRecord(['category', 'vendor', 'device', 'depreciation']), function (Grid $grid) {
            $grid->column('id');
            $grid->column('qrcode')->qrcode(function () {
                return base64_encode('hardware:' . $this->id);
            }, 200, 200);
            $grid->column('asset_number');
            $grid->column('name');
            $grid->column('description');
            $grid->column('category.name');
            $grid->column('vendor.name');
            $grid->column('specification');
            $grid->column('sn');
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
                if (Admin::user()->can('hardware.maintenance')) {
                    $actions->append(new MaintenanceAction('hardware'));
                }
            });
            $grid->column('device.name')->link(function () {
                if (!empty($this->device)) {
                    return route('device.records.show', $this->device['id']);
                }
            });
            $grid->column('depreciation.name');

            $grid->quickSearch('id', 'name', 'description', 'category.name', 'vendor.name', 'specification', 'sn', 'device.name')
                ->placeholder('尝试搜索一下')
                ->auto(false);

            $grid->enableDialogCreate();
            $grid->disableRowSelector();
            $grid->disableDeleteButton();
            $grid->disableBatchActions();

            $grid->tools([
                new HardwareRecordImportAction()
            ]);

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
    protected function detail($id): Show
    {
        return Show::make($id, new HardwareRecord(['category', 'vendor', 'channel', 'device', 'depreciation']), function (Show $show) {
            $show->field('id');
            $show->field('name');
            $show->field('asset_number');
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
            $show->field('depreciation.name');
            $show->field('', admin_trans_label('Depreciation Price'))->as(function () {
                $hardware_record = \App\Models\HardwareRecord::where('id', $this->id)->first();
                if (!empty($hardware_record)) {
                    $depreciation_rule_id = Info::getDepreciationRuleId($hardware_record);
                    return Info::depreciationPrice($this->price, $this->purchased, $depreciation_rule_id);
                }
            });
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
    protected function form(): Form
    {
        return Form::make(new HardwareRecord(), function (Form $form) {
            $form->display('id');
            $form->text('name')->required();
            $form->select('category_id', admin_trans_label('Category'))
                ->options(HardwareCategory::all()
                    ->pluck('name', 'id'))
                ->required();
            $form->text('specification')->required();
            $form->select('vendor_id', admin_trans_label('Vendor'))
                ->options(VendorRecord::all()
                    ->pluck('name', 'id'))
                ->required();
            $form->divider();
            $form->text('asset_number');
            $form->text('description');
            $form->select('purchased_channel_id', admin_trans_label('Purchased Channel Id'))
                ->options(PurchasedChannel::all()
                    ->pluck('name', 'id'));
            $form->text('sn');
            $form->currency('price');
            $form->date('purchased');
            $form->date('expired');
            $form->select('depreciation_rule_id', admin_trans_label('Depreciation Rule Id'))
                ->options(DepreciationRule::all()
                    ->pluck('name', 'id'));

            $form->display('created_at');
            $form->display('updated_at');

            $form->disableDeleteButton();

            $form->disableCreatingCheck();
            $form->disableEditingCheck();
            $form->disableViewCheck();
        });
    }
}
