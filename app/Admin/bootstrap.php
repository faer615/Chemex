<?php

/**
 * Dcat-admin - admin builder based on Laravel.
 * @author jqh <https://github.com/jqhph>
 *
 * Bootstraper for Admin.
 *
 * Here you can remove builtin form field:
 *
 * extend custom field:
 * Dcat\Admin\Form::extend('php', PHPEditor::class);
 * Dcat\Admin\Grid\Column::extend('php', PHPEditor::class);
 * Dcat\Admin\Grid\Filter::extend('php', PHPEditor::class);
 *
 * Or require js and css assets:
 * Admin::css('/packages/prettydocs/css/styles.css');
 * Admin::js('/packages/prettydocs/js/main.js');
 *
 */

/**
 * 自定义全局CSS
 */
Admin::style(
    <<<CSS
.main-footer {
    display:none;
}

.navbar{
    margin:0 35px 0 35px;
    height: 70px;
}

.nav-link{
    padding: 0;
}

.empty-data {
        text-align: center;
        color: rgba(0, 0, 0, 0.7);
        display: flex;
        align-items: center;
        justify-content: left;
    }
CSS

);
