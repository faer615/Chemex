<?php

namespace App\Admin\Actions\Grid;

use App\Admin\Repositories\SoftwareTrack;
use Dcat\Admin\Actions\Response;
use Dcat\Admin\Grid;
use Dcat\Admin\Grid\RowAction;
use Dcat\Admin\Widgets\Modal;

class SoftwareRelatedAction extends RowAction
{
    /**
     * @return string
     */
    protected $title = '💿 管理归属';

    /**
     * Handle the action request.
     *
     * @return Response|Modal
     */
    public function render()
    {
        $software_id = $this->getKey();

        $grid = Grid::make(new SoftwareTrack(['device']), function (Grid $grid) use ($software_id) {

            $grid->model()->where('software_id', $software_id);

            $grid->column('id');
            $grid->column('device.name', '设备');

            $grid->setActionClass(Grid\Displayers\Actions::class);

            $grid->disableCreateButton();
            $grid->disableRowSelector();
            $grid->disableBatchDelete();
            $grid->disableRefreshButton();
            $grid->disableViewButton();
            $grid->disableEditButton();
            $grid->disableDeleteButton();

            $grid->actions(function (Grid\Displayers\Actions $actions) {
                $actions->append(new SoftwareTrackDisableAction());
            });

            $grid->toolsWithOutline(false);

            $grid->disablePagination();
        });

        // 指定了modal窗体的id，为了能够在解除归属后可以直接取得modal窗体的id来自动弹出
        // 实现连续的解除归属动作，提升用户操作便利性
        return Modal::make()
            ->lg()
            ->id('software-related-modal-' . $this->getKey())
            ->title('管理' . $this->getRow()->name . '归属')
            ->body($grid)
            ->button($this->title);
    }
}
