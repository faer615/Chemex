<?php


namespace App\Libraries;


class Data
{
    /**
     * 发行方式
     * @return string[]
     */
    public static function distribution()
    {
        return [
            'u' => '未知',
            'o' => '开源',
            'f' => '免费',
            'b' => '商业授权'
        ];
    }

    /**
     * 性别
     * @return string[]
     */
    public static function genders()
    {
        return [
            '无' => '无',
            '男' => '男',
            '女' => '女'
        ];
    }

    /**
     * 物件
     * @return string[]
     */
    public static function items()
    {
        return [
            'device' => '设备',
            'hardware' => '硬件',
            'software' => '软件'
        ];
    }

    /**
     * 软件标签
     * @return array
     */
    public static function softwareTags()
    {
        return [
            'windows' => [
                'windows',
                'win10',
                'win8'
            ],
            'macos' => [
                'mac',
                'cheetah',
                'puma',
                'jaguar',
                'panther',
                'tiger',
                'leopard',
                'lion',
                'mavericks',
                'yosemite',
                'capitan',
                'sierra',
                'mojave',
                'catalina',
                'bigsur'
            ],
            'linux' => [
                'linux',
                'centos',
                'ubuntu',
                'kali',
                'debian',
                'arch',
                'deepin'
            ],
            'android' => [
                'cupcake',
                'donut',
                'eclair',
                'froyo',
                'gingerbread',
                'honeycomb',
                'icecreansandwich',
                'jellybean',
                'kitkat',
                'lollipop',
                'marshmallow',
                'nougat',
                'oreo',
                'pie'
            ],
            'ios' => [
                'ios'
            ]
        ];
    }
}
