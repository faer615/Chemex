<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Services\ConfigService;
use App\Support\System;
use App\Support\Version;
use Dcat\Admin\Layout\Column;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Layout\Row;
use Dcat\Admin\Widgets\Card;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Http;
use Pour\Base\Uni;
use ZipArchive;

class VersionController extends Controller
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
        $version = Version::list()['kenya'];

        return $content
            ->header('版本')
            ->description('列出了与咖啡壶相关的版本信息')
            ->body(function (Row $row) use ($res, $data, $description, $version) {
                $row->column(3, function (Column $column) use ($res, $data, $description) {
                    $column->row(new Card(view('update')->with('data', $data)));
                    $column->row(new Card(view('version_buttons')));
                });
                $row->column(9, function (Column $column) use ($res, $data, $description, $version) {
                    $column->row(new Card($version['name'], $version['description']));
                    $column->row(new Card($data['new'] . '更新说明', $description));
                });
            });
    }

    /**
     * 解压缩文件
     * @return array|JsonResponse
     */
    public function unzip()
    {
        $download_url = request('url');
        try {
            if (copy(trim($download_url), base_path() . '/public/' . basename($download_url))) {
                $file = base_path() . '/public/' . basename($download_url);
                $out_path = base_path();
                $zip = new ZipArchive();
                $openRes = $zip->open($file);
                if ($openRes === TRUE) {
                    $zip->extractTo($out_path);
                    $zip->close();
                    Artisan::call('migrate');
                    $return = Uni::rr(200, '更新成功，请刷新页面');
                } else {
                    $return = Uni::rr(500, '更新包读取失败，可能已经损坏');
                }
            } else {
                $return = Uni::rr(500, '更新文件下载失败');
            }
        } catch (Exception $exception) {
            $return = Uni::rr(500, $exception);
        }
        return response()->json($return);
    }

    /**
     * 更新数据库结构
     * @return JsonResponse
     */
    public function migrate()
    {
        $result = ConfigService::migrate();
        if ($result) {
            $return = Uni::rr(200, '更新数据库结构成功');
        } else {
            $return = Uni::rr(500, '更新数据库结构失败');
        }
        return response()->json($return);
    }

    /**
     * 清理全部缓存
     * @return JsonResponse
     */
    public function clear()
    {
        $result = ConfigService::clear();
        if ($result) {
            $return = Uni::rr(200, '缓存清理成功');
        } else {
            $return = Uni::rr(500, '缓存清理失败');
        }
        return response()->json($return);
    }
}
