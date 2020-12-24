<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Grid\RowAction\MaintenanceAction;
use App\Admin\Actions\Grid\RowAction\PartDeleteAction;
use App\Admin\Actions\Grid\RowAction\PartTrackAction;
use App\Admin\Actions\Grid\ToolAction\PartRecordImportAction;
use App\Admin\Grid\Displayers\RowActions;
use App\Admin\Repositories\PartRecord;
use App\Models\DepreciationRule;
use App\Models\DeviceRecord;
use App\Models\PartCategory;
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
class PartRecordController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid(): Grid
    {
        return Grid::make(new PartRecord(['category', 'vendor', 'device', 'depreciation']), function (Grid $grid) {
            $grid->column('id');
            $grid->column('qrcode')->qrcode(function () {
                return 'part:' . $this->id;
            }, 200, 200);
            $grid->column('asset_number');
            $grid->column('name');
            $grid->column('description');
            $grid->column('category.name');
            $grid->column('vendor.name');
            $grid->column('specification');
            $grid->column('sn');
            $grid->column('', admin_trans_label('Expiration Left Days'))->display(function () {
                return ExpirationService::itemExpirationLeftDaysRender('part', $this->id);
            });
            $grid->actions(function (RowActions $actions) {
                if (Admin::user()->can('part.delete')) {
                    $actions->append(new PartDeleteAction());
                }
                if (Admin::user()->can('part.track')) {
                    $actions->append(new PartTrackAction());
                }
                if (Admin::user()->can('part.maintenance')) {
                    $actions->append(new MaintenanceAction('part'));
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
                new PartRecordImportAction()
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
        return Show::make($id, new PartRecord(['category', 'vendor', 'channel', 'device', 'depreciation']), function (Show $show) {
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
            $show->field('', admin_trans_label('Depreciation Price'))->as(function () {
                $part_record = \App\Models\PartRecord::where('id', $this->id)->first();
                if (!empty($part_record)) {
                    $depreciation_rule_id = Info::getDepreciationRuleId($part_record);
                    return Info::depreciationPrice($this->price, $this->purchased, $depreciation_rule_id);
                }
            });
            $show->field('purchased');
            $show->field('expired');
            $show->field('depreciation.name');
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
        return Form::make(new PartRecord(), function (Form $form) {
            $form->display('id');
            $form->text('name')->required();
            $form->select('category_id', admin_trans_label('Category'))
                ->options(PartCategory::selectOptions())
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
