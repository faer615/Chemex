<?php


namespace App\Traits;


use App\Admin\Repositories\HardwareTrack;
use App\Admin\Repositories\ServiceTrack;
use App\Admin\Repositories\SoftwareTrack;
use App\Support\Data;
use Dcat\Admin\Grid;

trait HasDeviceRelatedGrid
{
    /**
     * 查看某个设备下面的全部关联硬件&软件&服务程序，并且返回它们的渲染集合
     * @param $device_id
     * @return array
     */
    public static function hasDeviceRelated($device_id): array
    {
        $result = [];
        // 硬件
        $grid = Grid::make(new HardwareTrack(['hardware', 'hardware.category', 'hardware.vendor']), function (Grid $grid) use ($device_id) {
            $grid->model()->where('device_id', '=', $device_id);
            $grid->tableCollapse(false);
            $grid->withBorder();

            $grid->column('id');
            $grid->column('hardware.category.name');
            $grid->column('hardware.name')->link(function () {
                if (!empty($this->hardware)) {
                    return route('hardware.records.show', $this->hardware['id']);
                }
            });
            $grid->column('hardware.specification');
            $grid->column('hardware.sn');
            $grid->column('hardware.vendor.name');

            $grid->disableToolbar();
            $grid->disableBatchActions();
            $grid->disableRowSelector();
            $grid->disableActions();
        });
        $result['hardware'] = $grid;

        // 软件
        $grid = Grid::make(new SoftwareTrack(['software', 'software.category', 'software.vendor']), function (Grid $grid) use ($device_id) {
            $grid->model()->where('device_id', '=', $device_id);
            $grid->tableCollapse(false);
            $grid->withBorder();

            $grid->column('id');
            $grid->column('software.category.name');
            $grid->column('software.name')->link(function () {
                if (!empty($this->software)) {
                    return route('software.records.show', $this->software['id']);
                }
            });
            $grid->column('software.version');
            $grid->column('software.distribution')->using(Data::distribution());
            $grid->column('software.vendor.name');

            $grid->disableToolbar();
            $grid->disableBatchActions();
            $grid->disableRowSelector();
            $grid->disableActions();
        });
        $result['software'] = $grid;

        // 服务程序
        $grid = Grid::make(new ServiceTrack(['service']), function (Grid $grid) use ($device_id) {
            $grid->model()->where('device_id', '=', $device_id);
            $grid->tableCollapse(false);
            $grid->withBorder();

            $grid->column('id');
            $grid->column('service.name')->link(function () {
                if (!empty($this->service)) {
                    return route('service.records.show', $this->service['id']);
                }
            });

            $grid->disableToolbar();
            $grid->disableBatchActions();
            $grid->disableRowSelector();
            $grid->disableActions();
        });
        $result['service'] = $grid;
        return $result;
    }
}
