<?php
return [
    'labels' => [
        'DeviceRecord' => '设备',
        'Category' => '分类',
        'Vendor' => '制造商',
        'Purchased Channel Id' => '购入途径',
        'Expiration Left Days' => '保固剩余天数',
        'records' => '设备'
    ],
    'fields' => [
        'qrcode' => '二维码',
        'name' => '名称',
        'description' => '描述',
        'category' => [
            'name' => '分类'
        ],
        'vendor' => [
            'name' => '制造商'
        ],
        'channel' => [
            'name' => '购入途径'
        ],
        'sn' => '序列号',
        'mac' => 'MAC',
        'ip' => 'IP',
        'photo' => '照片',
        'owner' => '雇员',
        'department' => '部门',
        'price' => '价格',
        'purchased' => '购入日期',
        'expired' => '过保日期',
        'security_password' => '安全密码',
        'admin_password' => '管理员密码'
    ],
    'options' => [
    ],
];
