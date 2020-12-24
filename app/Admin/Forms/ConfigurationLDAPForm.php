<?php

namespace App\Admin\Forms;

use Dcat\Admin\Widgets\Form;

class ConfigurationLDAPForm extends Form
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
            ->success('LDAP配置更新成功！')
            ->refresh();
    }

    /**
     * Build a form here.
     */
    public function form()
    {
        $this->switch('ad_enabled')
            ->default(admin_setting('ad_enabled'));
        $this->text('ad_host_primary')
            ->help('域控主机的域名地址或者ip地址。')
            ->required()
            ->default(admin_setting('ad_host_primary'));
        $this->text('ad_host_secondary')
            ->help('域控主机的域名地址或者ip地址，这是一个备用地址，如果主域控无法连接，将自动选择备域控。')
            ->default(admin_setting('ad_host_secondary'));
        $this->number('ad_port_primary')
            ->help('主域控服务的端口号')
            ->max(65535)
            ->required()
            ->default(admin_setting('ad_port_primary'));
        $this->number('ad_port_secondary')
            ->help('备域控服务的端口号')
            ->max(65535)
            ->default(admin_setting('ad_port_secondary'));
        $this->text('ad_base_dn')
            ->help('域控的起始域名，格式请按照 dc=corp,dc=acme,dc=org 填写。')
            ->required()
            ->default(admin_setting('ad_base_dn'));
        $this->text('ad_username')
            ->required()
            ->default(admin_setting('ad_username'));
        $this->password('ad_password')
            ->required()
            ->default(admin_setting('ad_password'));
        $this->switch('ad_use_ssl')
            ->default(admin_setting('ad_use_ssl'));
        $this->switch('ad_use_tls')
            ->default(admin_setting('ad_use_tls'));
    }
}
