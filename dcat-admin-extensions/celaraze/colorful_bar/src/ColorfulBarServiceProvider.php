<?php

namespace Celaraze\ColorfulBar;

use Dcat\Admin\Admin;
use Dcat\Admin\Extend\ServiceProvider;

class ColorfulBarServiceProvider extends ServiceProvider
{
    protected $type = self::TYPE_THEME;

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
        Admin::baseCss($this->formatAssetFiles($this->css));
    }
}
