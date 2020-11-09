<?php

namespace Celaraze\DcatAdminMenuSwitch;

use Dcat\Admin\Extend\ServiceProvider;

class DcatAdminMenuSwitchServiceProvider extends ServiceProvider
{
    protected $js = [
        'js/index.js',
    ];
    protected $css = [
        'css/index.css',
    ];

    public function register()
    {
        //
    }

    public function init()
    {
        parent::init();

        //

    }

    public function settingForm()
    {
        return new Setting($this);
    }
}
