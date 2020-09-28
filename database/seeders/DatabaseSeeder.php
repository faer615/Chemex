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
        // 初始化菜单
        DB::unprepared(file_get_contents(base_path('sql/create_tables.sql')));

        // 初始化数据
        DB::unprepared(file_get_contents(base_path('sql/init_data.sql')));
    }
}
