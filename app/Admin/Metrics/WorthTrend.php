<?php

namespace App\Admin\Metrics;

use App\Models\DeviceRecord;
use Dcat\Admin\Widgets\Metrics\Line;
use Illuminate\Http\Request;

class WorthTrend extends Line
{
    /**
     * @var string
     */
    protected $label = '资产价值趋势';

    /**
     * 图表默认高度.
     *
     * @var int
     */
    protected $chartHeight = 140;

    /**
     * 处理请求
     *
     * @param Request $request
     *
     * @return mixed|void
     */
    public function handle(Request $request)
    {
        $year = date('Y', time());
        if ($request->get('option') == 'pre_year') {
            $year = (int)$year - 1;
        }
        $from = date('Y-m-d', mktime(0, 0, 0, 1, 1, $year));
        $to = date('Y-m-d', mktime(23, 59, 59, 12, 31, $year));

        $records = DeviceRecord::whereBetween('purchased', [$from, $to])->get();

        $data = [];

        $year_all = 0;

        for ($i = 1; $i <= 12; $i++) {
            $temp = 0;
            foreach ($records as $record) {
                $month = date('m', strtotime($record->purchased));
                if ($i == $month) {
                    if (!empty($record->price)) {
                        $temp += $record->price;
                    }
                }
                // 全年数据，以最后一个月来计算，这里12目的是让循环只执行一次
                if ($i == 12 && !empty($record->price)) {
                    $year_all += $record->price;
                }
            }
            array_push($data, $temp);
        }

        $this->withContent('全年：' . $year_all);
        // 图表数据
        $this->withChart($data);
    }

    /**
     * 设置卡片内容.
     *
     * @param string $content
     *
     * @return WorthTrend
     */
    public function withContent(string $content): WorthTrend
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
     * 设置图表数据.
     *
     * @param array $data
     *
     * @return $this
     */
    public function withChart(array $data): WorthTrend
    {
        $this->chartOptions['tooltip']['x']['show'] = true;
        return $this->chart([
            'series' => [
                [
                    'name' => '价值',
                    'data' => $data,
                ],
            ]
        ]);
    }

    /**
     * 渲染内容，加上图表.
     * TODO 等更新可以删除掉
     *
     * @return string
     */
    public function renderContent(): string
    {
        $content = parent::renderContent();

        return <<<HTML
{$content}
<div class="card-content">
    {$this->renderChart()}
</div>
HTML;
    }

    /**
     * 初始化卡片内容
     *
     * @return void
     */
    protected function init()
    {
        parent::init();

        $this->title($this->label);
        $this->dropdown([
            'current_year' => '今年度',
            'pre_year' => '上年度'
        ]);
    }

    /**
     * 设置图表间距.
     * TODO 等更新可以删除掉
     *
     * @return void
     */
    protected
    function setUpChartMargin()
    {
        if ($this->chartMarginTop !== null) {
            $this->chart->style("margin-top: {$this->chartMarginTop}px;");
        }

        if ($this->chartMarginBottom !== null) {
            $this->chart->style("margin-bottom: {$this->chartMarginBottom}px;");
        }

        $this->chart->style("margin-right: 1px;");
    }

}
