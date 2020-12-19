<?php

namespace App\Admin\Forms;

use Dcat\Admin\Widgets\Form;

class ConfigurationForm extends Form
{
    /**
     * Handle the form request.
     *
     * @param array $input
     *
     * @return mixed
     */
    public function handle(array $input)
    {
        admin_setting($input);
        return $this
            ->response()
            ->success('站点配置更新成功！')
            ->refresh();
    }

    /**
     * Build a form here.
     */
    public function form()
    {
        $this->text('site_title')
            ->default(admin_setting('site_title'))
            ->required();
        $this->text('site_logo_text')
            ->default(admin_setting('site_logo_text'))
            ->help('文本LOGO显示的优先度低于图片，当没有上传图片作为LOGO时，此项将生效。')
            ->required();
        $this->image('site_logo')
            ->autoUpload()
            ->default(admin_setting('site_logo'));
        $this->image('site_logo_mini')
            ->autoUpload()
            ->default(admin_setting('site_logo_mini'));
    }
}
