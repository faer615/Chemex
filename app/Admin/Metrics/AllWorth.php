<?php


namespace App\Admin\Metrics;


use Closure;
use Dcat\Admin\Grid\LazyRenderable as LazyGrid;
use Dcat\Admin\Traits\LazyWidget;
use Dcat\Admin\Widgets\Card;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\DB;

class AllWorth extends Card
{
    /**
     * @param string|Closure|Renderable|LazyWidget $content
     *
     * @return AllWorth
     */
    public function content($content): AllWorth
    {
        if ($content instanceof LazyGrid) {
            $content->simple();
        }
        $device = DB::select('SELECT SUM(price) as total from device_records WHERE deleted_at IS NULL');
        $device = $device[0]->total;
        if (empty($device)) {
            $device = 0;
        }
        $hardware = DB::select('SELECT SUM(price) as total from hardware_records WHERE deleted_at IS NULL');
        $hardware = $hardware[0]->total;
        if (empty($hardware)) {
            $hardware = 0;
        }
        $software = DB::select('SELECT SUM(price) as total from software_records WHERE deleted_at IS NULL');
        $software = $software[0]->total;
        if (empty($software)) {
            $software = 0;
        }
        $total = $device + $hardware + $software;
        $html = <<<HTML
<div class="small-box" style="margin-bottom: 0;background: rgba(34,34,51,0.7);border-radius: .25rem">
  <div class="inner">
    <h3 class="font-grey">{$total}</h3>
    <p class="font-grey">资产总价值</p>
  </div>
  <div class="icon">
    <i class="feather icon-dollar-sign" style="color: rgba(44,44,67,1);"></i>
  </div>
  <a class="small-box-footer">
    <i class="feather icon-info"></i>
  </a>
</div>
HTML;

        $this->content = $this->formatRenderable($html);
        $this->noPadding();

        return $this;
    }
}
