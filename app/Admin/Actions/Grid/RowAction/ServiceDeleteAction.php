<?php

namespace App\Admin\Actions\Grid\RowAction;

use App\Models\ServiceRecord;
use App\Models\ServiceTrack;
use Dcat\Admin\Actions\Response;
use Dcat\Admin\Admin;
use Dcat\Admin\Grid\RowAction;

class ServiceDeleteAction extends RowAction
{
    /**
     * @return string
     */
    protected $title = '🔨 删除服务';

    /**
     * Handle the action request.
     *
     * @return Response
     */
    public function handle()
    {
        if (!Admin::user()->can('service.delete')) {
            return $this->response()
                ->error('你没有权限执行此操作！')
                ->refresh();
        }

        $service = ServiceRecord::where('id', $this->getKey())->first();
        if (empty($service)) {
            return $this->response()
                ->alert()
                ->error('没有此服务记录！');
        }

        $service_tracks = ServiceTrack::where('service_id', $service->id)
            ->get();

        foreach ($service_tracks as $service_track) {
            $service_track->delete();
        }

        $service->delete();

        return $this->response()
            ->alert()
            ->success('成功删除服务: ' . $service->name)
            ->refresh();
    }

    /**
     * @return string|array|void
     */
    public function confirm()
    {
        return ['确认删除？', '删除的同时将会解除所有与之关联的归属关系'];
    }
}
