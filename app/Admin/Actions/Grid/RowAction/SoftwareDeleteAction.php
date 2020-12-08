<?php

namespace App\Admin\Actions\Grid\RowAction;

use App\Models\SoftwareRecord;
use App\Models\SoftwareTrack;
use Dcat\Admin\Actions\Response;
use Dcat\Admin\Admin;
use Dcat\Admin\Grid\RowAction;

class SoftwareDeleteAction extends RowAction
{
    protected $title = '🔨 删除软件';

    /**
     * 处理动作逻辑
     * @return Response
     */
    public function handle(): Response
    {
        if (!Admin::user()->can('software.delete')) {
            return $this->response()
                ->error('你没有权限执行此操作！')
                ->refresh();
        }

        $software = SoftwareRecord::where('id', $this->getKey())->first();
        if (empty($software)) {
            return $this->response()
                ->error('没有此软件记录！');
        }

        $software_tracks = SoftwareTrack::where('software_id', $software->id)
            ->get();

        foreach ($software_tracks as $software_track) {
            $software_track->delete();
        }

        $software->delete();

        return $this->response()
            ->success('成功删除软件: ' . $software->name)
            ->refresh();
    }

    /**
     * 对话框
     * @return string[]
     */
    public function confirm(): array
    {
        return ['确认删除？', '删除的同时将会解除所有与之关联的归属关系'];
    }
}
