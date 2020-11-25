<?php

namespace App\Admin\Forms;

use App\Models\DeviceCategory;
use App\Models\DeviceRecord;
use App\Models\PurchasedChannel;
use App\Models\VendorRecord;
use Box\Spout\Common\Exception\IOException;
use Box\Spout\Common\Exception\UnsupportedTypeException;
use Dcat\Admin\Widgets\Form;
use Dcat\EasyExcel\Excel;
use Exception;
use League\Flysystem\FileNotFoundException;

class DeviceRecordImportForm extends Form
{
    /**
     * Handle the form request.
     *
     * @param array $input
     *
     * @return mixed
     */
    public function handle(array $input)
    {
        $file = $input['file'];
        $file_path = storage_path('app/public/' . $file);
        try {
            $rows = Excel::import($file_path)->first()->toArray();
            foreach ($rows as $row) {
                try {
                    if (!empty($row['名称']) && !empty($row['分类']) && !empty($row['制造商'])) {
                        $category = DeviceCategory::where('name', $row['分类'])->first();
                        $vendor = VendorRecord::where('name', $row['制造商'])->first();
                        if (!empty($category) && !empty($vendor)) {
                            $device_records = new DeviceRecord();
                            $device_records->name = $row['名称'];
                            $device_records->category_id = $category->id;
                            $device_records->vendor_id = $vendor->id;
                            $device_records->sn = $row['序列号'];
                            $device_records->mac = $row['MAC'];
                            $device_records->ip = $row['IP'];

                            if (!empty($row['价格'])) {
                                $device_records->price = $row['价格'];
                            }
                            if (!empty($row['购入日期'])) {
                                $device_records->purchased = $row['购入日期'];
                            }
                            if (!empty($row['过保日期'])) {
                                $device_records->expired = $row['过保日期'];
                            }
                            $purchased_channel = PurchasedChannel::where('name', $row['购入途径'])->first();
                            if (!empty($purchased_channel)) {
                                $device_records->purchased_channel_id = $purchased_channel->id;
                            }

                            $device_records->save();
                        }
                    }
                } catch (Exception $exception) {
                    continue;
                }
            }
            $return = $this
                ->response()
                ->success('文件导入成功！')
                ->refresh();
        } catch (IOException $e) {
            $return = $this
                ->response()
                ->error('文件读写失败：' . $e->getMessage());
        } catch (UnsupportedTypeException $e) {
            $return = $this
                ->response()
                ->error('不支持的文件类型：' . $e->getMessage());
        } catch (FileNotFoundException $e) {
            $return = $this
                ->response()
                ->error('文件不存在：' . $e->getMessage());
        }

        return $return;
    }

    /**
     * Build a form here.
     */
    public function form()
    {
        $this->file('file', '表格文件')
            ->accept('xls,xlsx,csv')
            ->autoUpload()
            ->required()
            ->help('导入支持xls、xlsx、csv文件，且表格头必须使用【名称，描述，分类，制造商，序列号，MAC，IP，价格，购入日期，过保日期，购入途径】。');
    }
}
