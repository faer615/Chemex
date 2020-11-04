<?php

namespace App\Admin\Controllers;

use Dcat\Admin\Admin;
use Dcat\Admin\Http\Controllers\AuthController as BaseAuthController;
use Dcat\Admin\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends BaseAuthController
{
    protected $view = 'login';

    /**
     * Update user setting.
     *
     * @return JsonResponse|Response
     */
    public function putSetting()
    {
        $form = $this->settingForm();

        if (config('admin.demo')) {
            return $form->response()->error('演示模式下不允许此修改操作');
        }

        if (!$this->validateCredentialsWhenUpdatingPassword()) {
            $form->responseValidationMessages('old_password', trans('admin.old_password_error'));
        }

        return $form->update(Admin::user()->getKey());
    }
}
