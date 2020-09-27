<?php

namespace App\Admin\Actions\Grid;

use App\Models\HardwareTrack;
use Dcat\Admin\Grid\RowAction;
use Dcat\Admin\Widgets\Modal;

class HardwareHistoryAction extends RowAction
{
    /**
     * @return string
     */
    protected $title = '硬件变动履历';

    public function render()
    {
        // 实例化表单类并传递自定义参数
        $id = $this->getKey();

        $data = [];

        $hardware_tracks = HardwareTrack::withTrashed()
            ->where('hardware_id', $id)
            ->get();

        foreach ($hardware_tracks as $hardware_track) {
            $status = '关联了';
            $color = '';
            $single = [
                'type' => '设备',
                'name' => $hardware_track->device->name,
                'status' => $status,
                'color' => $color,
                'datetime' => json_decode($hardware_track, true)['created_at']
            ];
            array_push($data, $single);
            if (!empty($hardware_track->deleted_at)) {
                $status = '解除了';
                $color = 'table-warning';
                $single = [
                    'type' => '设备',
                    'name' => $hardware_track->device->name,
                    'status' => $status,
                    'color' => $color,
                    'datetime' => json_decode($hardware_track, true)['deleted_at']
                ];
                array_push($data, $single);
            }
        }

        $datetime = array_column($data, 'datetime');
        array_multisort($datetime, SORT_DESC, $data);

        return Modal::make()
            ->lg()
            ->title($this->getRow()->name . ' 的变动履历')
            ->body(view('hardware_history')->with('data', $data))
            ->button($this->title);
    }
}
