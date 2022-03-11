<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert(['id'=>1,'name'=>'sv','memo'=>'スーパーバイザー']);
        DB::table('roles')->insert(['id'=>2,'name'=>'clerk','memo'=>'店員']);
    }
}
