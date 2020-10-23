<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Support\System;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Layout\Row;
use Dcat\Admin\Widgets\Card;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;
use Pour\Base\Uni;

class UpdateController extends Controller
{
    /**
     * 页面
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        $response = Http::get('https://famio.cn/api/chemex/check')->json();
        if (!empty($response)) {
            $new = $response['version'];
        } else {
            $new = '0.0.0';
        }
        $res = System::diffVersion(config('admin.chemex_version'), $new, '.');
        $data['old'] = config('admin.chemex_version');
        $data['new'] = $new;
        $data['res'] = $res;
        $data['url'] = $response['download_url'];

        $description = $response['description'];

        return $content
            ->header('更新')
            ->description('使应用保持最新')
            ->body(function (Row $row) use ($data, $description) {
                $row->column(2, new Card(view('update')->with('data', $data)));
                $row->column(10, new Card($data['new'] . '更新说明', $description));
            });
    }

    /**
     * 解压缩文件
     * @return array|JsonResponse
     */
    public function unzip()
    {
        $download_url = request('url');
        if (copy(trim($download_url), base_path() . '/public/' . basename($download_url))) {
            $filename = basename($download_url);
            $path = base_path();
            if (file_exists($filename)) {
                try {
                    $resource = zip_open($filename);
                    while ($zip = zip_read($resource)) {
                        if (zip_entry_open($resource, $zip)) {
                            $file_content = zip_entry_name($zip);
                            $file_name = substr($file_content, strrpos($file_content, '/'));

                            if (!is_dir($file_name) && $file_name) {
                                $file_size = zip_entry_filesize($zip);
                                $file = zip_entry_read($zip, $file_size);
                                file_put_contents($path . '/' . $file_name, $file);
                                zip_entry_close($zip);
                            }
                        }
                    }
                    zip_close($resource);
                    $return = Uni::rr(200, '更新成功');
                } catch (Exception $exception) {
                    $return = Uni::rr(500, $exception);
                }
            } else {
                $return = Uni::rr(500, '更新文件写入失败');
            }
        } else {
            $return = Uni::rr(500, '更新文件下载失败');
        }
        return response()->json($return);
    }
}
