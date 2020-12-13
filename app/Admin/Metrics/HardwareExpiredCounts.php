<?php


namespace App\Admin\Metrics;


use App\Models\HardwareRecord;
use Closure;
use Dcat\Admin\Grid\LazyRenderable as LazyGrid;
use Dcat\Admin\Traits\LazyWidget;
use Dcat\Admin\Widgets\Card;
use Illuminate\Contracts\Support\Renderable;

class HardwareExpiredCounts extends Card
{
    /**
     * @param string|Closure|Renderable|LazyWidget $content
     *
     * @return HardwareExpiredCounts
     */
    public function content($content): HardwareExpiredCounts
    {
        if ($content instanceof LazyGrid) {
            $content->simple();
        }

        $counts = HardwareRecord::where('expired', '<', date(now()))->count();

        $html = <<<HTML
<div class="info-box" style="background:transparent;margin-bottom: 0;padding: 0;">
    <span class="info-box-icon"><i class="feather icon-server" style="color:rgba(178,68,71,1);"></i></span>
    <div class="info-box-content">
        <span class="info-box-text mt-1">已过保的硬件数量</span>
        <span class="info-box-number">{$counts}</span>
    </div>
</div>
HTML;

        $this->content = $this->formatRenderable($html);
        $this->noPadding();

        return $this;
    }
}
