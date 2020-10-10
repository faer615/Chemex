<?php

namespace App\Admin\Actions\Grid;

use App\Models\SoftwareTrack;
use Dcat\Admin\Actions\Response;
use Dcat\Admin\Grid\RowAction;
use Illuminate\Http\Request;

class SoftwareTrackDisableAction extends RowAction
{
    /**
     * @return string
     */
    protected $title = '解除归属';

    /**
     * Handle the action request.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function handle(Request $request)
    {
        $software_track = SoftwareTrack::where('id', $this->getKey())->first();

        if (empty($software_track)) {
            return $this->response()->error('找不到此软件归属记录！');
        }

        $software_track->delete();

        return $this->response()
            ->success('软件归属解除成功！');
    }

    /**
     * @return string|array|void
     */
    public function confirm()
    {
        return ['确认解除与此设备的关联？', '解除后相应的授权数量等将会同步更新'];
    }
}
