<?php
return [
    'labels' => [
        'HardwareRecord' => '硬件',
        'Owner' => '所属设备',
        'Category' => '分类',
        'Vendor' => '制造商',
        'Purchased Channel Id' => '购入途径',
        'Expiration Left Days' => '保固剩余天数',
        'records' => '硬件',
        'Depreciation Rule Id' => '折旧规则',
        'Depreciation Price' => '折旧价格'
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
        'device' => [
            'name' => '所属设备'
        ],
        'specification' => '规格',
        'sn' => '序列号',
        'price' => '价格',
        'purchased' => '购入日期',
        'expired' => '过保日期',
        'depreciation' => [
            'name' => '折旧规则'
        ]
    ],
    'options' => [
    ],
];
