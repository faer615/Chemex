<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin_menu')->insert([
            'id' => 1,
            'parent_id' => 0,
            'order' => 1,
            'title' => 'Index',
            'icon' => 'feather icon-bar-chart-2',
            'uri' => '/'
        ]);
        DB::table('admin_menu')->insert([
            'id' => 2,
            'parent_id' => 0,
            'order' => 16,
            'title' => 'Admin',
            'icon' => 'feather icon-settings',
            'uri' => '/'
        ]);
        DB::table('admin_menu')->insert([
            'id' => 3,
            'parent_id' => 2,
            'order' => 17,
            'title' => 'Users',
            'icon' => '',
            'uri' => 'auth/users'
        ]);
        DB::table('admin_menu')->insert([
            'id' => 4,
            'parent_id' => 2,
            'order' => 18,
            'title' => 'Roles',
            'icon' => '',
            'uri' => 'auth/roles'
        ]);
        DB::table('admin_menu')->insert([
            'id' => 5,
            'parent_id' => 2,
            'order' => 19,
            'title' => 'Permission',
            'icon' => '',
            'uri' => 'auth/permissions'
        ]);
        DB::table('admin_menu')->insert([
            'id' => 6,
            'parent_id' => 2,
            'order' => 20,
            'title' => 'Menu',
            'icon' => '',
            'uri' => 'auth/menu'
        ]);
        DB::table('admin_menu')->insert([
            'id' => 7,
            'parent_id' => 2,
            'order' => 21,
            'title' => 'Operation log',
            'icon' => '',
            'uri' => 'auth/logs'
        ]);
        DB::table('admin_menu')->insert([
            'id' => 8,
            'parent_id' => 0,
            'order' => 5,
            'title' => 'Software Management',
            'icon' => '',
            'uri' => ''
        ]);
        DB::table('admin_menu')->insert([
            'id' => 9,
            'parent_id' => 8,
            'order' => 7,
            'title' => 'Software Categories',
            'icon' => '',
            'uri' => 'software/categories'
        ]);
        DB::table('admin_menu')->insert([
            'id' => 10,
            'parent_id' => 0,
            'order' => 11,
            'title' => 'Vendor Management',
            'icon' => '',
            'uri' => ''
        ]);
        DB::table('admin_menu')->insert([
            'id' => 11,
            'parent_id' => 10,
            'order' => 12,
            'title' => 'Vendor Records',
            'icon' => '',
            'uri' => 'vendor/records'
        ]);
        DB::table('admin_menu')->insert([
            'id' => 12,
            'parent_id' => 8,
            'order' => 6,
            'title' => 'Software Records',
            'icon' => '',
            'uri' => 'software/records'
        ]);
        DB::table('admin_menu')->insert([
            'id' => 13,
            'parent_id' => 0,
            'order' => 8,
            'title' => 'Hardware Management',
            'icon' => '',
            'uri' => ''
        ]);
        DB::table('admin_menu')->insert([
            'id' => 14,
            'parent_id' => 13,
            'order' => 10,
            'title' => 'Hardware Categories',
            'icon' => '',
            'uri' => 'hardware/categories'
        ]);
        DB::table('admin_menu')->insert([
            'id' => 15,
            'parent_id' => 13,
            'order' => 9,
            'title' => 'Hardware Records',
            'icon' => '',
            'uri' => 'hardware/records'
        ]);
        DB::table('admin_menu')->insert([
            'id' => 16,
            'parent_id' => 0,
            'order' => 2,
            'title' => 'Device Management',
            'icon' => '',
            'uri' => ''
        ]);
        DB::table('admin_menu')->insert([
            'id' => 17,
            'parent_id' => 16,
            'order' => 4,
            'title' => 'Device Categories',
            'icon' => '',
            'uri' => 'device/categories'
        ]);
        DB::table('admin_menu')->insert([
            'id' => 18,
            'parent_id' => 0,
            'order' => 13,
            'title' => 'Staff Management',
            'icon' => '',
            'uri' => ''
        ]);
        DB::table('admin_menu')->insert([
            'id' => 19,
            'parent_id' => 18,
            'order' => 15,
            'title' => 'Staff Departments',
            'icon' => '',
            'uri' => 'staff/departments'
        ]);
        DB::table('admin_menu')->insert([
            'id' => 20,
            'parent_id' => 18,
            'order' => 14,
            'title' => 'Staff Records',
            'icon' => '',
            'uri' => 'staff/records'
        ]);
        DB::table('admin_menu')->insert([
            'id' => 21,
            'parent_id' => 16,
            'order' => 3,
            'title' => 'Device Records',
            'icon' => '',
            'uri' => 'device/records'
        ]);
        DB::table('admin_menu')->insert([
            'id' => 22,
            'parent_id' => 8,
            'order' => 22,
            'title' => 'Software Tracks',
            'icon' => '',
            'uri' => 'software/tracks'
        ]);
        DB::table('admin_menu')->insert([
            'id' => 23,
            'parent_id' => 13,
            'order' => 23,
            'title' => 'Hardware Tracks',
            'icon' => '',
            'uri' => 'hardware/tracks'
        ]);
        DB::table('admin_menu')->insert([
            'id' => 24,
            'parent_id' => 16,
            'order' => 24,
            'title' => 'Device Tracks',
            'icon' => '',
            'uri' => 'device/tracks'
        ]);
    }
}
