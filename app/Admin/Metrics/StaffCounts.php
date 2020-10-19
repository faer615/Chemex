<?php


namespace App\Admin\Metrics;


use App\Models\StaffRecord;
use Dcat\Admin\Widgets\Metrics\Line;
use Illuminate\Http\Request;

class StaffCounts extends Line
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
        $counts = StaffRecord::all()->count();

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

        $this->title('雇员')
            ->height(120)
            ->appendHtmlAttribute('style', "background:rgba(187,198,28,0.1);");
    }
}
