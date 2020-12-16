<?php


namespace App\Admin\Metrics;


use App\Models\HardwareRecord;
use Closure;
use Dcat\Admin\Grid\LazyRenderable as LazyGrid;
use Dcat\Admin\Traits\LazyWidget;
use Dcat\Admin\Widgets\Card;
use Illuminate\Contracts\Support\Renderable;

class HardwareCounts extends Card
{
    /**
     * @param string|Closure|Renderable|LazyWidget $content
     *
     * @return $this
     */
    public function content($content): HardwareCounts
    {
        if ($content instanceof LazyGrid) {
            $content->simple();
        }
        $counts = HardwareRecord::all()->count();
        $route = route('hardware.records.index');
        $html = <<<HTML
<div class="small-box" style="margin-bottom: 0;background: rgba(33,150,243,0.7);border-radius: .25rem">
  <div class="inner">
    <h3 class="font-grey">{$counts}</h3>
    <p class="font-grey">硬件数量</p>
  </div>
</div>
HTML;

        $this->content = $this->formatRenderable($html);
        $this->noPadding();

        return $this;
    }
}
