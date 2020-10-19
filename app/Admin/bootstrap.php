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

//优化页脚显示，隐藏底部文字
Admin::style(
    <<<CSS
.main-footer {
    display:none;
}
[class*=sidebar-dark-] .navbar-header{
    padding:.35rem 1rem 0;
    height:auto !important;
    background:#1e1e2d;
}
CSS

);

Admin::style(
    <<<CSS
.colorful{
        background: linear-gradient(
        90deg,
        /*transparent,*/
        transparent,
        rgba(168,47,67,0.1),
        rgba(231,72,98,0.1),
        rgba(229,129,67,0.1),
        rgba(246,204,51,0.1),
        rgba(187,198,28,0.1),
        rgba(171,204,208,0.1),
        rgba(19,185,203,0.1),
        rgba(187,133,160,0.1),
        rgba(237,132,193,0.1),
        transparent
        /*transparent*/
        );
    }

/*.main-sidebar{*/
/*        background: linear-gradient(*/
/*        rgba(168,47,67,0.1),*/
/*        rgba(231,72,98,0.1),*/
/*        rgba(229,129,67,0.1),*/
/*        rgba(246,204,51,0.1),*/
/*        rgba(187,198,28,0.1),*/
/*        rgba(171,204,208,0.1),*/
/*        rgba(19,185,203,0.1),*/
/*        rgba(187,133,160,0.1),*/
/*        rgba(237,132,193,0.1)*/
/*        );*/
/*    }*/
CSS
);
