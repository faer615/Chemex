<?php

namespace App\Admin\Actions\Grid;

use App\Models\DeviceTrack;
use App\Models\StaffRecord;
use Dcat\Admin\Actions\Response;
use Dcat\Admin\Grid\RowAction;
use Dcat\Admin\Traits\HasPermissions;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class StaffDeleteAction extends RowAction
{
    /**
     * @return string
     */
    protected $title = '🔨 删除雇员';

    /**
     * Handle the action request.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function handle(Request $request)
    {
        $staff = StaffRecord::where('id', $this->getKey())->first();
        if (empty($staff)) {
            return $this->response()->error('没有此雇员记录！');
        }

        $device_tracks = DeviceTrack::where('staff_id', $staff->id)
            ->get();

        foreach ($device_tracks as $device_track) {
            $device_track->delete();
        }

        $staff->delete();

        return $this->response()
            ->success('成功删除雇员: ' . $staff->name)
            ->refresh();
    }

    /**
     * @return string|array|void
     */
    public function confirm()
    {
        return ['确认删除？', '删除的同时将会解除所有与之关联的归属关系'];
    }

    /**
     * @param Model|Authenticatable|HasPermissions|null $user
     *
     * @return bool
     */
    protected function authorize($user): bool
    {
        return true;
    }
}
