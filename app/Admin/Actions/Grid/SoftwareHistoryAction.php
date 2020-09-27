<?php

namespace App\Admin\Actions\Grid;

use App\Models\SoftwareTrack;
use Dcat\Admin\Grid\RowAction;
use Dcat\Admin\Widgets\Modal;

class SoftwareHistoryAction extends RowAction
{
    /**
     * @return string
     */
    protected $title = '软件件变动履历';

    public function render()
    {
        // 实例化表单类并传递自定义参数
        $id = $this->getKey();

        $data = [];

        $software_tracks = SoftwareTrack::withTrashed()
            ->where('software_id', $id)
            ->get();

        foreach ($software_tracks as $software_track) {
            $status = '关联了';
            $color = '';
            $single = [
                'type' => '设备',
                'name' => $software_track->device->name,
                'status' => $status,
                'color' => $color,
                'datetime' => json_decode($software_track, true)['created_at']
            ];
            array_push($data, $single);
            if (!empty($software_track->deleted_at)) {
                $status = '解除了';
                $color = 'table-warning';
                $single = [
                    'type' => '设备',
                    'name' => $software_track->device->name,
                    'status' => $status,
                    'color' => $color,
                    'datetime' => json_decode($software_track, true)['deleted_at']
                ];
                array_push($data, $single);
            }
        }

        $datetime = array_column($data, 'datetime');
        array_multisort($datetime, SORT_DESC, $data);

        return Modal::make()
            ->lg()
            ->title($this->getRow()->name . ' 的变动履历')
            ->body(view('software_history')->with('data', $data))
            ->button($this->title);
    }
}
