<?php

namespace App\Admin\Actions\Grid\RowAction;

use App\Models\HardwareRecord;
use App\Models\HardwareTrack;
use Dcat\Admin\Actions\Response;
use Dcat\Admin\Grid\RowAction;

class HardwareDeleteAction extends RowAction
{
    /**
     * @return string
     */
    protected $title = '🔨 删除硬件';

    /**
     * Handle the action request.
     *
     * @return Response
     */
    public function handle()
    {
        $hardware = HardwareRecord::where('id', $this->getKey())->first();
        if (empty($hardware)) {
            return $this->response()
                ->alert()
                ->error('没有此硬件记录！');
        }

        $hardware_tracks = HardwareTrack::where('hardware_id', $hardware->id)
            ->get();

        foreach ($hardware_tracks as $hardware_track) {
            $hardware_track->delete();
        }

        $hardware->delete();

        return $this->response()
            ->alert()
            ->success('成功删除硬件: ' . $hardware->name)
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
