<?php

namespace Celaraze\DcatAdminMenuSwitch\Http\Controllers;

use Dcat\Admin\Admin;
use Dcat\Admin\Layout\Content;
use Illuminate\Routing\Controller;

class DcatadminMenuSwitchController extends Controller
{
    public function index(Content $content)
    {
        return $content
            ->title('Title')
            ->description('Description')
            ->body(Admin::view('celaraze.dcatadmin-menu-switch::index'));
    }
}
