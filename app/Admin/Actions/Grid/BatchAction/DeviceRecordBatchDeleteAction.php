<?php

namespace App\Admin\Actions\Grid\BatchAction;

use App\Services\DeviceRecordService;
use Dcat\Admin\Actions\Response;
use Dcat\Admin\Grid\BatchAction;

class DeviceRecordBatchDeleteAction extends BatchAction
{
    protected $action;

    protected $title = '🔨 批量删除设备';

    // 确认弹窗信息
    public function confirm(): string
    {
        return '您确定要删除选中的设备吗？';
    }

    // 处理请求
    public function handle(): Response
    {
        // 获取选中的文章ID数组
        $keys = $this->getKey();

        foreach ($keys as $key) {
            DeviceRecordService::deviceDelete($key);
        }

        return $this->response()->success('批量删除设备成功！')->refresh();
    }

    // 设置请求参数
    public function parameters(): array
    {
        return [
            'action' => $this->action,
        ];
    }
}
