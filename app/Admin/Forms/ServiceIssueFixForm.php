<?php

namespace App\Admin\Forms;

use App\Models\ServiceIssue;
use Dcat\Admin\Admin;
use Dcat\Admin\Contracts\LazyRenderable;
use Dcat\Admin\Traits\LazyWidget;
use Dcat\Admin\Widgets\Form;

class ServiceIssueFixForm extends Form implements LazyRenderable
{
    use LazyWidget;

    /**
     * Handle the form request.
     *
     * @param array $input
     *
     * @return mixed
     */
    public function handle(array $input)
    {
        if (!Admin::user()->can('service.issue.fix')) {
            return $this->response()
                ->error('你没有权限执行此操作！')
                ->refresh();
        }

        // 获取异常id
        $issue_id = $this->payload['id'] ?? null;

        // 获取修复说明
        $description = $input['description'] ?? null;

        // 如果没有盘点id返回错误
        if (!$issue_id) {
            return $this->response()
                ->error('参数错误');
        }

        $service_issue = ServiceIssue::where('id', $issue_id)->first();
        if (empty($service_issue)) {
            return $this->response()
                ->error('没有找到此服务程序异常');
        } else {
            $service_issue->status = 2;
            $service_issue->description = $description;
            $service_issue->checker = Admin::user()->id;
            $service_issue->save();
        }

        return $this->response()
            ->success('服务程序异常处理成功')
            ->refresh();
    }

    /**
     * Build a form here.
     */
    public function form()
    {
        $this->textarea('description', '描述');
    }
}
