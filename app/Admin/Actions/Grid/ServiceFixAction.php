<?php

namespace App\Admin\Actions\Grid;

use App\Models\ServiceIssue;
use Dcat\Admin\Actions\Response;
use Dcat\Admin\Grid\RowAction;
use Illuminate\Http\Request;

class ServiceFixAction extends RowAction
{
    /**
     * @return string
     */
    protected $title = '修复问题';

    /**
     * Handle the action request.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function handle(Request $request)
    {
        $service_issue = ServiceIssue::where('id', $this->getKey())->first();

        if (empty($service_issue)) {
            return $this->response()
                ->error('没有找到此异常！');
        } else {
            if ($service_issue->status !== 1) {
                return $this->response()
                    ->warning('不存在异常！');
            }
            $service_issue->status = 2;
            $service_issue->end = date('y-m-d h:i:s', time());
            $service_issue->save();
            return $this->response()
                ->success('已报告为修复此问题！')
                ->refresh();
        }
    }

    /**
     * @return string|array|void
     */
    public function confirm()
    {
        return ['确认已修复异常？'];
    }
}
