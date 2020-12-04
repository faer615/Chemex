<?php


namespace App\Services;


use App\Models\SoftwareTrack;

class SoftwareRecordService
{
    /**
     * 获取软件的履历清单
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

        $software_tracks = SoftwareTrack::withTrashed()
            ->where('software_id', $id)
            ->get();

        foreach ($software_tracks as $software_track) {
            $single['type'] = '设备';
            $single['name'] = optional($software_track->device)->name;
            $single['status'] = '+';
            $single['datetime'] = json_decode($software_track, true)['created_at'];
            array_push($data, $single);
            if (!empty($software_track->deleted_at)) {
                $single['status'] = '-';
                $single['datetime'] = json_decode($software_track, true)['deleted_at'];
                array_push($data, $single);
            }
        }

        $datetime = array_column($data, 'datetime');
        array_multisort($datetime, SORT_DESC, $data);

        return $data;
    }
}
