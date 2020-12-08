<?php


namespace App\Services;


use App\Models\HardwareTrack;
use App\Support\Track;

class HardwareRecordService
{
    /**
     * 获取硬件的履历清单
     * @param $id
     * @return array
     */
    public static function history($id): array
    {
        $data = [];

        $single = [
            'type' => '',
            'name' => '',
            'status' => '',
            'style' => '',
            'datetime' => ''
        ];

        $hardware_tracks = HardwareTrack::withTrashed()
            ->where('hardware_id', $id)
            ->get();

        foreach ($hardware_tracks as $hardware_track) {
            $single['type'] = '设备';
            $single['name'] = optional($hardware_track->device)->name;
            $data = Track::itemTrack($single, $hardware_track, $data);
        }

        $datetime = array_column($data, 'datetime');
        array_multisort($datetime, SORT_DESC, $data);

        return $data;
    }
}
