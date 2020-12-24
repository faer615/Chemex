<?php

namespace App\Admin\Controllers;

use App\Admin\Forms\ConfigurationLDAPForm;
use App\Http\Controllers\Controller;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Widgets\Card;

class ConfigurationLDAPController extends Controller
{
    /**
     * 页面
     * @param Content $content
     * @return Content
     */
    public function index(Content $content): Content
    {
        return $content
            ->header('LDAP配置')
            ->description('提供对LDAP的支持')
            ->body(new Card(new ConfigurationLDAPForm()));
    }
}
