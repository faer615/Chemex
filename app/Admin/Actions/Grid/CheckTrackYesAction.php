<?php

namespace App\Admin\Actions\Grid;

use App\Models\CheckTrack;
use Dcat\Admin\Actions\Response;
use Dcat\Admin\Admin;
use Dcat\Admin\Grid\RowAction;
use Dcat\Admin\Traits\HasPermissions;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class CheckTrackYesAction extends RowAction
{
    /**
     * @return string
     */
    protected $title = '🏴 盘盈';

    /**
     * Handle the action request.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function handle(Request $request)
    {
        $check_track = CheckTrack::where('id', $this->getKey())->first();
        if (empty($check_track)) {
            return $this->response()
                ->error('没有找到此盘点追踪');
        } else {
            $check_track->status = 1;
            $check_track->checker = Admin::user()->id;
            $check_track->save();
            return $this->response()
                ->success('已盘盈')
                ->refresh();
        }
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
