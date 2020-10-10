<?php

namespace App\Admin\Actions\Grid;

use App\Models\SoftwareTrack;
use Dcat\Admin\Actions\Response;
use Dcat\Admin\Grid\RowAction;

class SoftwareTrackDisableAction extends RowAction
{
    /**
     * @return string
     */
    protected $title = '🔗 解除归属';

    /**
     * Handle the action request.
     *
     * @return Response
     */
    public function handle()
    {
        $software_track = SoftwareTrack::where('id', $this->getKey())->first();
        $software_id = $software_track->software_id;

        if (empty($software_track)) {
            return $this->response()->error('找不到此软件归属记录！');
        }

        $software_track->delete();

        // 判断归属解除后，是否还有剩余和此软件相关的归属关系
        $left_track = SoftwareTrack::where('software_id', $software_id)->get()->count();
        // 如果没有了，就直接跳转到正常的路由
        if ($left_track == 0) {
            return $this->response()
                ->success('软件归属解除成功！')
                ->redirect(route('software.records.index'));
        }
        // 如果还有，则跳转路由的同时带上srmi参数，为了在控制器中直接可以取得模态窗体id来自动弹出
        // srmi = Software Related Modal ID
        return $this->response()
            ->success('软件归属解除成功！')
            ->redirect(route('software.records.index', ['srmi' => $software_id]));
    }

    /**
     * @return string|array|void
     */
    public function confirm()
    {
        return ['确认解除与此设备的关联？', '解除后相应的授权数量等将会同步更新'];
    }
}
