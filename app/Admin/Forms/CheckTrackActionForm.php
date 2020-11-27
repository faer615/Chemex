<?php

namespace App\Admin\Forms;

use App\Models\CheckTrack;
use Dcat\Admin\Admin;
use Dcat\Admin\Contracts\LazyRenderable;
use Dcat\Admin\Traits\LazyWidget;
use Dcat\Admin\Widgets\Form;

class CheckTrackActionForm extends Form implements LazyRenderable
{
    use LazyWidget;

    /**
     * Handle the form request.
     *
     * @param array $input
     *
     * @return mixed
     */
    public function handle(array $input)
    {
        if (!Admin::user()->can('check.track')) {
            return $this->response()
                ->error('你没有权限执行此操作！')
                ->refresh();
        }

        // 获取盘点id
        $track_id = $this->payload['id'] ?? null;

        // 获取盘点状态
        $status = $input['status'] ?? null;

        // 获取盘点说明
        $description = $input['description'] ?? null;

        // 如果没有盘点id返回错误
        if (!$track_id || !$status) {
            return $this->response()->alert()->error('参数错误');
        }

        $check_track = CheckTrack::where('id', $track_id)->first();
        if (empty($check_track)) {
            return $this->response()
                ->alert()
                ->error('没有找到此盘点追踪');
        } else {
            $check_track->status = $status;
            $check_track->description = $description;
            $check_track->checker = Admin::user()->id;
            $check_track->save();
        }

        return $this->response()->alert()->success('盘点操作成功')->refresh();
    }

    /**
     * Build a form here.
     */
    public function form()
    {
        $this->radio('status', '盘点状态')
            ->options([1 => '盘到啦', 2 => '没盘道'])
            ->default(1)
            ->required();
        $this->text('description', '描述');
    }
}
