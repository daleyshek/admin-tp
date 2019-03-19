<?php

use Illuminate\Database\Seeder;
use App\Models\Permission;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $roles = [
            ['user','用户','App用户'],
            ['member','会员','VIP会员'],
            ['admin','管理员','后台系统管理员'],
            ['store_manager','店长','店铺管理员'],
            ['store_employee','店员','店铺成员'],
        ];

        foreach($roles as $r){
            $t = new Role();
            $t->name = $r[0];
            $t->display_name = $r[1];
            $t->description = $r[2];
            $t->save();
        }

        $adminLoginP = Permission::where('name','admin-login')->first();
        $userGroupP = Permission::where('name','user-group')->first();
        $userConfigP = Permission::where('name','user-config')->first();
        $storeLoginP = Permission::where('name','store-login')->first();

        $admin = Role::where('name','admin')->first();
        $admin->attachPermission($adminLoginP);
        $admin->attachPermission($userGroupP);
        $admin->attachPermission($userConfigP);
        $admin->attachPermission($storeLoginP);


        $storeManager = Role::where('name','store_manager')->first();
        $storeManager->attachPermission($storeLoginP);
        

        $storeEmployee = Role::where('name','store_employee')->first();
        $storeEmployee->attachPermission($storeLoginP);
    }
}
