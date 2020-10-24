<?php

namespace App\Http\Controllers;

use App\Models\CheckRecord;
use App\Models\CheckTrack;
use App\Models\DeviceRecord;
use App\Models\HardwareRecord;
use App\Models\SoftwareRecord;
use Illuminate\Http\JsonResponse;
use Pour\Base\Uni;

class InfoController extends Controller
{
    /**
     * 移动端扫码查看设备硬件软件详情
     * @param $item_id
     * @return JsonResponse
     */
    public function info($item_id)
    {
        $item_id = base64_decode($item_id);
        $item_class = explode(':', $item_id)[0];
        $item_id = explode(':', $item_id)[1];
        switch ($item_class) {
            case 'device':
                $item = DeviceRecord::where('id', $item_id)
                    ->first();
                break;
            case 'hardware':
                $item = HardwareRecord::where('id', $item_id)
                    ->first();
                break;
            case 'software':
                $item = SoftwareRecord::where('id', $item_id)
                    ->first();
                break;
            default:
                $item = [];
        }
        $return = Uni::rr(200, '查询成功', $item);
        return response()->json($return);
    }

    /**
     * 盘点
     * @param $string
     * @return JsonResponse
     */
    public function check($string)
    {
        $item = explode(':', $string)[0];
        $id = explode(':', $string)[1];
        if (!empty($item) && !empty($id)) {
            $check_record = CheckRecord::where('check_item', $item)
                ->where('status', 0)
                ->first();
            if (empty($check_record)) {
                $return = Uni::rr(404, '没有找到相对应的盘点任务');
                return response()->json($return);
            }
            switch ($item) {
                case 'hardware':
                    $item = HardwareRecord::where('id', $id)->first();
                    break;
                case 'software':
                    $item = SoftwareRecord::where('id', $id)->first();
                    break;
                default:
                    $item = DeviceRecord::where('id', $id)->first();
            }
            if (empty($item)) {
                $return = Uni::rr(404, '没有找到对应的物品');
            } else {
                $check_track = CheckTrack::where('check_id', $check_record->id)
                    ->where('item_id', $item->id)
                    ->first();
                $return = Uni::rr(200, '查询成功', $check_track);
            }
        } else {
            $return = Uni::rr(404, '参数不完整');
        }
        return response()->json($return);
    }

    /**
     * 盘点动作
     * @return JsonResponse
     */
    public function checkDo()
    {
        $track_id = request('track_id') ?? null;
        $check_option = request('option') ?? null;
        if (!$track_id && !$check_option) {
            $user = auth('api')->user();
            $check_track = CheckTrack::where('id', $track_id)->first();
            if (empty($check_track)) {
                $return = Uni::rr(404, '没有找到盘点内容');
            } else {
                $check_track->status = $check_option;
                $check_track->checker = $user->name;
                $check_track->save();
                $return = Uni::rr(200, '操作成功');
            }
        } else {
            $return = Uni::rr(404, '参数不完整');
        }
        return response()->json($return);
    }
}
