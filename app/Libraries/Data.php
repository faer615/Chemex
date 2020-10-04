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
     * 盘点任务状态
     * @return string[]
     */
    public static function checkRecordStatus()
    {
        return [
            0 => '进行',
            1 => '完成',
            2 => '中止'
        ];
    }

    /**
     * 盘点追踪状态
     * @return string[]
     */
    public static function checkTrackStatus()
    {
        return [
            0 => '未盘点',
            1 => '盘盈',
            2 => '盘亏'
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
