<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
            'id' => 100,
            'name' => 'admin',
            'mobile' => '18888888888',
            'password' => bcrypt('123456'),
            'avatar' => \App\Models\User::getDefaultAvatar(),
            'status' => 1,
        ])
        ->attachRole(\App\Models\Role::where('name','admin')->first());

        \App\Models\User::create([
            'id' => 101,
            'name' => 'store',
            'mobile' => '16666666666',
            'password' => bcrypt('123456'),
            'avatar' => \App\Models\User::getDefaultAvatar(),
            'status' => 1,
        ])
        ->attachRole(\App\Models\Role::where('name','store_manager')->first());

        // 生成测试用户200条
        factory(\App\Models\User::class, 200)->create();
    }
}
