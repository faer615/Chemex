<?php

namespace App\Admin\Actions\Grid\RowAction;

use App\Models\PartRecord;
use App\Models\PartTrack;
use Dcat\Admin\Actions\Response;
use Dcat\Admin\Admin;
use Dcat\Admin\Grid\RowAction;

class PartDeleteAction extends RowAction
{
    protected $title = '🔨 删除配件';

    /**
     * 处理动作逻辑
     * @return Response
     */
    public function handle(): Response
    {
        if (!Admin::user()->can('part.delete')) {
            return $this->response()
                ->error('你没有权限执行此操作！')
                ->refresh();
        }

        $part = PartRecord::where('id', $this->getKey())->first();
        if (empty($part)) {
            return $this->response()
                ->error('没有此配件记录！');
        }

        $part_tracks = PartTrack::where('part_id', $part->id)
            ->get();

        foreach ($part_tracks as $part_track) {
            $part_track->delete();
        }

        $part->delete();

        return $this->response()
            ->success('成功删除配件: ' . $part->name)
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
