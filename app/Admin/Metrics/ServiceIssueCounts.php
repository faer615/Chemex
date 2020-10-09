<?php


namespace App\Admin\Metrics;


use App\Models\ServiceIssue;
use App\Models\ServiceRecord;
use Dcat\Admin\Widgets\Metrics\Line;
use Illuminate\Http\Request;

class ServiceIssueCounts extends Line
{
    /**
     * 处理请求
     *
     * @param Request $request
     *
     * @return mixed|void
     */
    public function handle(Request $request)
    {
        $counts = 0;
        $services = ServiceRecord::all();
        foreach ($services as $service) {
            $service_issue = ServiceIssue::where('service_id', $service->id)
                ->where('status', 1)
                ->first();
            if (!empty($service_issue)) {
                $counts++;
            }
        }

        $this->withContent($counts);
    }

    /**
     * 设置卡片内容.
     *
     * @param string $content
     *
     * @return $this
     */
    public function withContent($content)
    {
        return $this->content(
            <<<HTML
<div class="d-flex justify-content-between align-items-center mt-1" style="margin-bottom: 2px">
    <h2 class="ml-1 font-lg-1">{$content}</h2>
</div>
HTML
        );
    }

    /**
     * 初始化卡片内容
     *
     * @return void
     */
    protected function init()
    {
        parent::init();

        $this->title('异常服务')->height(120);
    }
}
