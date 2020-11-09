<?php

namespace Celaraze\DcatAdminMenuSwitch;

use App\Models\AdminMenu;
use Dcat\Admin\Extend\Setting as Form;

class Setting extends Form
{
    public function form()
    {
        $menus = AdminMenu::all();
        foreach ($menus as $menu) {
            $this->switch($menu->id, $menu->title)->value($menu->show);
        }
    }

    protected function formatInput(array $input)
    {
        $values = $input;
        foreach ($values as $key => $value) {
            $menu = AdminMenu::where('id', $key)->first();
            if (!empty($menu)) {
                $menu->show = $value;
                $menu->save();
            }
        }

        return $input;
    }
}
