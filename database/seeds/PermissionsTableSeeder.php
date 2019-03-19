<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            ['admin-login','后台系统登陆','允许登陆后台管理系统'],
            ['store-login','店铺系统登陆','允许登陆店铺管理系统'],
            ['user-group','权限分组','允许给其他用户分配权限'],
            ['user-config','人员配置', '允许配置后台人员参数'],
        ];

        foreach($permissions as $p){
            $t = new \App\Models\Permission();
            $t->name = $p[0];
            $t->display_name = $p[1];
            $t->description = $p[2];
            $t->save();
        }
    }
}
