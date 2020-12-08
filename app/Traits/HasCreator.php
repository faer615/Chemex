<?php


namespace App\Traits;


use Dcat\Admin\Admin;

trait HasCreator
{
    /**
     * 为模型增加特定字段用于保存创建人
     * @param $model
     */
    public static function hasCreator($model)
    {
        $admin_user = Admin::user();
        $jwt_user = auth('api')->user();
        if (empty($admin_user) && !empty($jwt_user)) {
            $name = $jwt_user->name;
        } elseif (!empty($admin_user) && empty($jwt_user)) {
            $name = $admin_user->name;
        } else {
            $name = '未知';
        }
        $model->creator = $name;
    }
}
